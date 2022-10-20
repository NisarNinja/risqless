<?php 
namespace App\Http\Controllers\AuthUser;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Password;
use Socialite;
use Auth;
use Laravel\Cashier\Cashier;
use \Stripe\Stripe;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Mail;

class UserLoginController extends Controller
{  
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/file-upload';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function show_login_form()
    {
        return view('user.pages.login');
    }
    public function process_login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
         

        $credentials = $request->except(['_token']);

        $user = User::where('email',$request->email)->first();

        if (auth()->attempt($credentials)) {

            return redirect()->route('file');

        }else{
            session()->flash('error', 'Email/Password is incorrect!');
            session()->flash('alert-class', 'alert-danger');
            return redirect()->back();
        }
    }

    public function checkEmail(Request $request){
        $email = $request->input('email');
        $isExists = User::where('email',$email)->first();
        if($isExists){
            return response()->json(array("exists" => true));
        }else{
            return response()->json(array("exists" => false));
        }
    }

    public function retrievePlans() {
       $key = \config('services.stripe.secret');
       $stripe = new \Stripe\StripeClient($key);
       $plansraw = $stripe->plans->all();
       $plans = $plansraw->data;
       
       foreach($plans as $plan) {
           $prod = $stripe->products->retrieve(
               $plan->product,[]
           );
           $plan->product = $prod;
       }
       return $plans;
   }

    public function show_signup_form()
    {   
        $plans = $this->retrievePlans();
        $user = new User;
        $intent = $user->createSetupIntent();
        return view('user.pages.register', [ 
            'intent' => $intent,
            'plans' => $plans,
        ]);
    }
    public function process_signup(Request $request)
    {   
        $rules = [
            'fname' => 'required',
            'lname' => 'required',
        ];

        $customMessages = [
            'fname.required' => 'First name is required',
            'lname.required' => 'Last name is required',
        ];

        $this->validate($request, $rules, $customMessages);

        // Storing Contacts in Hubspot
        $arr = array(
            'properties' => array(
                array(
                    'property' => 'email',
                    'value' => $request->input('email')
                ),
                array(
                    'property' => 'firstname',
                    'value' => $request->input('fname')
                ),
                array(
                    'property' => 'lastname',
                    'value' => $request->input('lname')
                ),
            )
        );
        $post_json = json_encode($arr);
        
        $hapikey = "d18e851d-d8e1-451c-b4b6-6dfd135aeca3";
        $endpoint = 'https://api.hubapi.com/contacts/v1/contact?hapikey=' . $hapikey;

        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_json);
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        if (curl_errno($ch)) {

            print_r(curl_error($ch));
            exit;
        }
        curl_close ($ch);
        // End Storing Contacts in Hubspot

        $name = trim($request->input('fname')) . ' ' . trim($request->input('lname'));

        $user = User::create([
            'name' => $name,
            'email' => strtolower($request->input('email')),
            'password' => bcrypt($request->input('password')),
            'role' => 'subscriber',
        ]);

        // creating stripe subscription trial
        $paymentMethod = $request->input('payment_method');
        $user->createOrGetStripeCustomer();
        $user->addPaymentMethod($paymentMethod);
        $plan = $request->input('plan');
        try {
           $user->newSubscription('default', $plan)->trialDays(7)->create($paymentMethod, [
               'email' => $user->email,
           ]);
        } catch (\Exception $e) {
           return back()->withErrors(['subscription_error' => 'Error creating subscription. ' . $e->getMessage()]);
        }
        // end creating stripe subscription trial

        session()->flash('message', 'Congratulations! Your account is created successfully.');
        session()->flash('alert-class', 'alert-success border border-success');

        Auth::login($user);
        
        //Sending Welcome Email
            // email data
            $email_data = array(
                'name' => $request->input('fname'),
                'email' => $request->input('email'),
            );

            // send email with the template
            Mail::send('email.welcome_email', $email_data, function ($message) use ($email_data) {
                $message->to($email_data['email'], $email_data['name'])
                    ->subject('Welcome to Risqless')
                    ->from('info@risqless.ai', 'Risqless');
            });
            //End Sending Welcome Email

        return redirect()->route('file');
    }
    public function logout()
    {
        \Auth::logout();

        // return redirect(\URL::previous());

        return redirect()->route('home');
    }

    public function show_forget_password_form()
    {
        return view('user.pages.forget-password');
    }
    public function process_forget_password(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
            );

        return $status === Password::RESET_LINK_SENT
                        ? back()->with(['status' => __($status)])
                        : back()->withErrors(['email' => __($status)]);
    }
    
    public function show_reset_form(Request $request)
    {
        $token = $request->token;
        $email = $request->email;
        return view('user.pages.reset-password',['token'=>$token,'email'=> $email]);
    }

    public function process_reset_password(Request $request)
    {

         $rules = [
            'token' => 'required',
            'email' => 'required|email',
            // 'password' => ['required', 
            //    'min:6', 
            //    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/', 
            //    'confirmed',
            //    'required_with:password_confirmation',
            //    'same:password_confirmation'],
            // 'password_confirmation' => 'min:6'
        ];

        $customMessages = [
            'password.regex' => 'Password must contain at least one lowercase , one uppercase, one number and one symbol.'
        ];

        $this->validate($request, $rules, $customMessages);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) use ($request) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status == Password::PASSWORD_RESET
                ? redirect()->route('user.show.login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
    }

    // Google Login 
    /**
  * Redirect the user to the Google authentication page.
  *
  * @return \Illuminate\Http\Response
  */
    public function redirectToProvider(Request $request)
    {
        return Socialite::driver('google')->redirect();
    }
    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
        } catch (InvalidStateException $e) {
            $user = Socialite::driver('google')->stateless()->user();
        }

        // $user = Socialite::driver('google')->user();
        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();

        if($existingUser){
            // log them in
            auth()->login($existingUser, true);
        } else {
            // create a new user
            $newUser                  = new User;
            $newUser->name            = $user->name;
            $newUser->email           = $user->email;
            $newUser->google_id       = $user->id;
            $newUser->avatar          = $user->avatar;
            $newUser->avatar_original = $user->avatar_original;
            $newUser->role            = 'subscriber';

            $newUser->save();

            // Storing Contacts in Hubspot
            $name = explode(" ", $user->name);
            $fname = $name[0];
            $lname = $name[1];

            $arr = array(
                'properties' => array(
                    array(
                        'property' => 'email',
                        'value' => $newUser->email
                    ),
                    array(
                        'property' => 'firstname',
                        'value' => $fname
                    ),
                    array(
                        'property' => 'lastname',
                        'value' => $lname
                    ),
                    array(
                        'property' => 'phone',
                        'value' => '555-1212'
                    )
                )
            );
            $post_json = json_encode($arr);
            
            $hapikey = "d18e851d-d8e1-451c-b4b6-6dfd135aeca3";
            $endpoint = 'https://api.hubapi.com/contacts/v1/contact?hapikey=' . $hapikey;


            $ch = curl_init();
            
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_json);
            curl_setopt($ch, CURLOPT_URL, $endpoint);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);

            if (curl_errno($ch)) {

                print_r(curl_error($ch));
                exit;
            }

            curl_close ($ch);
            // End Storing Contacts in Hubspot

            auth()->login($newUser, true);

            session()->forget(['payment_method', 'plan']);
        }
        return redirect()->to('/file');
    }


    // Facebook Login
    public function facebookRedirect(Request $request)
    {
        return Socialite::driver('facebook')->with(['redirect_uri' => route('facebook.callback')])->redirect();
    }

    public function loginWithFacebook()
    {
    
        $user = Socialite::driver('facebook')->stateless()->user();
        
        if($user == null){
            $user = Socialite::driver('facebook')->user();
        }

        try {

    
            // $user = Socialite::driver('facebook')->user();
            $facebook_id = $user->getId();
            
            $existingUser = User::where('email', $user->email)->first();
        
            if($existingUser !== null){
                Auth::login($existingUser);
                return redirect('/file');
            }else{

                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'fb_id' => $facebook_id,
                    'role' => 'subscriber',
                    // 'password' => encrypt('admin@123')
                    // 'trial_ends_at' => Carbon::now()->addDays(7),
                ]);

                // Storing Contacts in Hubspot
                $name = explode(" ", $user->name);
                $fname = $name[0];
                $lname = $name[1];

                $arr = array(
                    'properties' => array(
                        array(
                            'property' => 'email',
                            'value' => $user->email
                        ),
                        array(
                            'property' => 'firstname',
                            'value' => $fname
                        ),
                        array(
                            'property' => 'lastname',
                            'value' => $lname
                        ),
                        array(
                            'property' => 'phone',
                            'value' => '555-1212'
                        )
                    )
                );
                $post_json = json_encode($arr);
                

                $hapikey = "d18e851d-d8e1-451c-b4b6-6dfd135aeca3";
                $endpoint = 'https://api.hubapi.com/contacts/v1/contact?hapikey=' . $hapikey;


                $ch = curl_init();
                
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_json);
                curl_setopt($ch, CURLOPT_URL, $endpoint);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);

                if (curl_errno($ch)) {

                    print_r(curl_error($ch));
                    exit;
                }

                curl_close ($ch);
                // End Storing Contacts in Hubspot

                Auth::login($createUser);

                session()->forget(['payment_method', 'plan']);
            // return "hello world";    

                return redirect('/file');
            }
    
        } catch (\Exception $exception) {
            // dd($exception->getMessage());
            
        }
    }
}
