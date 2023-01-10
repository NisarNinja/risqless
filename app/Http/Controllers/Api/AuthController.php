<?php
namespace App\Http\Controllers\Api;

use Auth;
use Mail;
use Socialite;
use \Stripe\Stripe;
use App\Models\User;
use App\Models\Device;
use Stripe\Subscription;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
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
    public function login(Request $request)
    {

        $response=[];
        $response["header"]["return_flag"]="X";
        $response["header"]["error_detail"]="";
        $response["header"]["errors"] = [];
        $response["data"]= (object) array();

         $rules = [
            'email'=>'required|email',
            // 'password' => 'required|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        ];
        $messages=[
             'email.required'=>'Email is Required',
             'email.email'=>'Email format is invalid',
             'password.required'=>'Password is required',
             'password.min'=>'Password Minimum Length should be 6',
             'password.regex'=>'Password must contain at least one lowercase , one uppercase, one number and one symbol',
        ];
        $validator = Validator::make($request->all(), $rules,$messages);
        if ($validator->fails()) {
           $response["header"]["error_detail"]="validation error";
           $response["header"]["errors"] = $validator->messages();
        }
        else
        {

            $credentials = ['email' => $request->email, 'password' => $request->password];

            $user = User::where('email',$request->email)->first();

            if (auth()->attempt($credentials)) {

            $this->storeDevice($request->device_id,$user);

            $response["header"]["return_flag"]="true";
            $response["data"] = new UserResource($user);

            }else{
                $response["header"]["error_detail"]="Credentials are invalid";
            }
        }
        return response()->json($response);
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

    public function storeLeadInHubspot(Request $request){

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
        $response = json_decode($response);

        if (curl_errno($ch)) {

            print_r(curl_error($ch));
            exit;
        }
        curl_close ($ch);
        // End Storing Contacts in Hubspot

        return response()->json($response);
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

        $response=[];
         $response["header"]["return_flag"]="X";
         $response["header"]["error_detail"]="";
        $response["header"]["errors"] = [];
         $response["data"]= (object) array();
        $rules = [
            'fname' => 'required',
            'lname' => 'required',
            'company' => 'required',
            'email'=>'required|email|unique:users',
            'password' => 'required|confirmed|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        ];
        $messages=[
             'fname.required' => 'First Name is Required',
             'lname.required' => 'Last Name is Required',
             'company.required' => 'Company Name is Required',
             'email.required'=>'Email is Required',
             'email.email'=>'Email format is invalid',
             'email.unique'=>'Email already exists',
             'password.required'=>'Password is required',
             'password.min'=>'Password Minimum Length should be 6',
             'password.confirmed'=>'Password does not match',
             'password.regex'=>'Password must contain at least one lowercase , one uppercase, one number and one symbol',
        ];


        $validator = Validator::make($request->all(), $rules,$messages);
        if ($validator->fails()) {
           $response["header"]["return_flag"]="X";
           $response["header"]["error_detail"]="validation error";
           $response["header"]["errors"] = $validator->messages();
        }
        else
        {
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
            $responsee = curl_exec($ch);
            if (curl_errno($ch)) {

                print_r(curl_error($ch));
                exit;
            }
            curl_close ($ch);
            $name = trim($request->input('fname')) . ' ' . trim($request->input('lname'));
            $user = User::create([
                'name' => $name,
                'email' => strtolower($request->input('email')),
                'password' => bcrypt($request->input('password')),
                'role' => 'subscriber',
                'company' => $request->input('company'),
            ]);

            $user->activateTrial();

            $email_data = array(
                'name' => $request->input('fname'),
                'email' => $request->input('email'),
            );
            Mail::send('email.welcome_email', $email_data, function ($message) use ($email_data) {
                $message->to($email_data['email'], $email_data['name'])
                    ->subject('Welcome to Risqless');
            });
           $response["header"]["return_flag"]="true";
           $response["data"]= new UserResource($user);
        }
        return response()->json($response);
    }

    
    public function signupWithTrial(Request $request)
    {

        $response=[];
         $response["header"]["return_flag"]="X";
         $response["header"]["error_detail"]="";
        $response["header"]["errors"] = [];
         $response["data"]= (object) array();
        $rules = [
            'fname' => 'required',
            'lname' => 'required',
            'company' => 'required',
            'email'=>'required|email|unique:users',
            'password' => 'required|confirmed|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'payment_method' => 'required',
        ];
        $messages=[
             'fname.required' => 'First Name is Required',
             'lname.required' => 'Last Name is Required',
             'company.required' => 'Company Name is Required',
             'email.required'=>'Email is Required',
             'email.email'=>'Email format is invalid',
             'email.unique'=>'Email already exists',
             'password.required'=>'Password is required',
             'password.min'=>'Password Minimum Length should be 6',
             'password.confirmed'=>'Password does not match',
             'password.regex'=>'Password must contain at least one lowercase , one uppercase, one number and one symbol',
        ];


        $validator = Validator::make($request->all(), $rules,$messages);
        if ($validator->fails()) {
           $response["header"]["return_flag"]="X";
           $response["header"]["error_detail"]="validation error";
           $response["header"]["errors"] = $validator->messages();
        }
        else
        {
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
            $responsee = curl_exec($ch);
            if (curl_errno($ch)) {

                print_r(curl_error($ch));
                exit;
            }
            curl_close ($ch);
            $name = trim($request->input('fname')) . ' ' . trim($request->input('lname'));
            $user = User::create([
                'name' => $name,
                'email' => strtolower($request->input('email')),
                'password' => bcrypt($request->input('password')),
                'role' => 'subscriber',
                'company' => $request->input('company'),
            ]);

            $res_=$this->startSubscription($request,$user);

            // if res header is not 1, then return $res
            if ($res_["header"]["return_flag"] == "X") {
                return $res_;
            }

            $email_data = array(
                'name' => $request->input('fname'),
                'email' => $request->input('email'),
            );
            Mail::send('email.welcome_email', $email_data, function ($message) use ($email_data) {
                $message->to($email_data['email'], $email_data['name'])
                    ->subject('Welcome to Risqless');
            });
           $response["header"]["return_flag"]="true";
           $response["data"]= new UserResource($user);
        }
        return response()->json($response);
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
    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function googleLogin(Request $request)
    {

        $response=[];
        $response["header"]["return_flag"]="X";
        $response["header"]["error_detail"]="";
        $response["header"]["errors"] = [];
        $response["data"]= (object) array();
        $rules = [
            'name' => 'required',
            'email'=>'required|email',
            'google_id'=>'required',
        ];
        $messages=[
             'name.required' => 'Name is Required',
             'email.required'=>'Email is Required',
             'email.email'=>'Email format is invalid',
             'google_id.required'=>'Google ID is required',
        ];
        $validator = Validator::make($request->all(), $rules,$messages);
        if ($validator->fails()) {
           $response["header"]["return_flag"]="X";
           $response["header"]["error_detail"]="validation error";
           $response["header"]["errors"] = $validator->messages();
        }
        else{

            $existingUser = User::where('email', $request->email)->first();
            if($existingUser){

                $this->storeDevice($request->device_id,$existingUser);
                $response["header"]["return_flag"]="true";
                $response["data"]= new UserResource($existingUser);
            } else {
                // create a new user
                $newUser                  = new User;
                $newUser->name            = $request->name;
                $newUser->email           = $request->email;
                $newUser->google_id       = $request->google_id;
                $newUser->avatar          = $request->avatar;
                $newUser->avatar_original = $request->avatar_original;
                $newUser->role            = 'subscriber';

                $newUser->save();

                $newUser->activateTrial();

                $this->storeDevice($request->device_id,$newUser);

                // Storing Contacts in Hubspot
                $name = explode(" ", $request->name);
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
                $response["header"]["return_flag"]="true";
                $response["data"]= new UserResource($newUser);
            }
        }
        return response()->json($response);
    }



    /**
     *
     *
     * @param      \Illuminate\Http\Request  $request  The request
     *
     * @return     <type>                    ( description_of_the_return_value )
     */
    public function loginWithFacebook(Request $request)
    {

        $response=[];
        $response["header"]["return_flag"]="X";
        $response["header"]["error_detail"]="";
        $response["header"]["errors"] = [];
        $response["data"]= (object) array();
        $rules = [
            'name' => 'required',
            'email'=>'required|email',
            'facebook_id'=>'required',
        ];
        $messages=[
             'name.required' => 'Name is Required',
             'email.required'=>'Email is Required',
             'email.email'=>'Email format is invalid',
             'facebook_id.required'=>'Facebook ID is required',
        ];
        $validator = Validator::make($request->all(), $rules,$messages);
        if ($validator->fails()) {
           $response["header"]["return_flag"]="X";
           $response["header"]["error_detail"]="validation error";
           $response["header"]["errors"] = $validator->messages();
        }
        else{

            $existingUser = User::where('email', $request->email)->first();

            if($existingUser){
                // add user device if doesn't exist already
                $this->storeDevice($request->device_id,$existingUser);

                $response["header"]["return_flag"]="true";
                $response["data"]= new UserResource($existingUser);
            }else{
                $createUser = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'fb_id' => $request->facebook_id,
                    'avatar'=>$request->avatar,
                    'original_avatar'=>$request->original_avatar,
                    'role' => 'subscriber',
                ]);

                $createUser->activateTrial();
                $this->storeDevice($request->device_id,$createUser);

                $name = explode(" ", $request->name);
                $fname = $name[0];
                $lname = $name[1];
                $arr = array(
                    'properties' => array(
                        array(
                            'property' => 'email',
                            'value' => $request->email
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
                $response["header"]["return_flag"]="true";
                $response["data"]= new UserResource($existingUser);
            }
        }
        return response()->json($response);
    }

    public function appleLogin(Request $request)
    {

        $response=[];
        $response["header"]["return_flag"]="X";
        $response["header"]["error_detail"]="";
        $response["header"]["errors"] = [];
        $response["data"]= (object) array();
        $rules = [
            'name' => 'required',
            'email'=>'required|email',
            'apple_id'=>'required',
        ];
        $messages=[
             'name.required' => 'Name is Required',
             'email.required'=>'Email is Required',
             'email.email'=>'Email format is invalid',
             'apple_id.required'=>'Apple ID is required',
        ];
        $validator = Validator::make($request->all(), $rules,$messages);
        if ($validator->fails()) {
           $response["header"]["return_flag"]="X";
           $response["header"]["error_detail"]="validation error";
           $response["header"]["errors"] = $validator->messages();
        }
        else{

            $existingUser = User::where('email', $request->email)->first();

            if($existingUser){
                // add user device if doesn't exist already
                $this->storeDevice($request->device_id,$existingUser);

                $response["header"]["return_flag"]="true";
                $response["data"]= new UserResource($existingUser);
            }else{
                $createUser = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'fb_id' => $request->facebook_id,
                    'avatar'=>$request->avatar,
                    'original_avatar'=>$request->original_avatar,
                    'role' => 'subscriber',
                ]);

                $createUser->activateTrial();

                $this->storeDevice($request->device_id,$createUser);

                $name = explode(" ", $request->name);
                $fname = $name[0];
                $lname = $name[1];
                $arr = array(
                    'properties' => array(
                        array(
                            'property' => 'email',
                            'value' => $request->email
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
                /* $response = */ curl_exec($ch);
                if (curl_errno($ch)) {

                    print_r(curl_error($ch));
                    exit;
                }
                curl_close ($ch);
                $response["header"]["return_flag"]="true";
                $response["data"]= new UserResource($existingUser);
            }
        }
        return response()->json($response);
    }

    /**
     * Stores a device.
     *
     * @param      <type>  $device  The device
     * @param      <type>  $user    The user
     */
    public function storeDevice($device,$user = null){

        if($device){
            $user = $user ?? auth()->user();
            $user->devices()->firstOrCreate([
                'device_id' => $device
            ]);
        }

    }

    public function activateTrial(Request $request){

        $user = User::where('id',$request->user_id)->first();

        if($user){
            $user = $user->activateTrial();
        }

       $response["header"]["return_flag"]="1";
       $response["header"]["error_detail"]="";
       $response["header"]["errors"] = (Object)[];

       $response['data'] = new UserResource($user);

       return $response;

    }

    /**
     * processSubscription
     *
     * @param Request $request
     * @return void
     */
    public function processSubscription(Request $request)
    {
        return $this->startSubscription($request,auth()->user());
    }

    public function startSubscription(Request $request,$user=null)
    {
        if ($request->payment_method) {
            
            $hc=new HomeController;
            
            if (count($hc->retrievePlans())) {
                $plan= $hc->retrievePlans()[0]->id ;
                $user = $user;
                $paymentMethod = $request->payment_method;
         
                try {
                    $user->createOrGetStripeCustomer();
                    $user->addPaymentMethod($paymentMethod);
                    $user->newSubscription('default', $plan)->trialDays(30)->create($paymentMethod, [
                        'email' => $user->email,
                    ]);
         
                } catch (\Exception $e) {
                    $response["header"]["return_flag"]="X";
                    $response["header"]["error_detail"]='Error creating subscription. ' . $e->getMessage();
                    $response["header"]["errors"] = (Object)[];

                    return $response;

                }
            
                $this->fcm(
                    $this->getUserDevices($user->id),
                    'Congratulations',
                    'You are successfully subscribed to the trial plan'
                );
        
                $response["header"]["return_flag"]="1";
                $response["header"]["error_detail"]='Congratulations,You are successfully subscribed to the trial plan';
                $response["header"]["errors"] = (Object)[];
            }else{
                $response["header"]["return_flag"]="X";
                $response["header"]["error_detail"]='No plans found.';
                $response["header"]["errors"] = (Object)[];
            }
        } else {
            
            $response["header"]["return_flag"]="X";
            $response["header"]["error_detail"]='Payment Token is required.';
            $response["header"]["errors"] = (Object)[];
        }
        
        return $response;
    }

    // Overiding the Trait Method
    public function sendResetLinkEmail(Request $request)
    {

        $validator =  Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $response=[];
        $response["header"]["return_flag"]="X";
        $response["header"]["error_detail"]="";
        $response["header"]["errors"] = (object)[];

        if ($validator->fails()) {
           $response["header"]["return_flag"]="X";
           $response["header"]["error_detail"]="validation error";
           $response["header"]["errors"] = $validator->messages();

           return $response;
        }

        $user = User::where('email',$request->only('email'))->first();
        if(!$user){

           $response["header"]["return_flag"]="X";
           $response["header"]["error_detail"]="validation error";
           $response["header"]["errors"] = [
            'email' => "Email doesn't exists."
           ];

        }

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $reset_link = Password::broker()->sendResetLink(
            $request->only('email')
        );

        $response["header"]["return_flag"] = "1";
        $response["header"]["error_detail"] = "You will get recovery e-mail shortly.";
        $response["header"]["errors"] = (object)[];

        return $response;

    }

    /**
     * cancelSubscription
     *
     * @param Request $request
     * @return void
     */
    public function cancelSubscription(Request $request){
        $user=User::where('id',$request->user_id)->first();
        if ($user->active_subscription()) {
            $user->active_subscription()->cancel();

            $response["header"]["return_flag"]="1";
            $response["header"]["error_detail"]='Your subscription has been cancelled';
            $response["header"]["errors"] = (Object)[];
            
        } else {
            $response["header"]["return_flag"]="X";
            $response["header"]["error_detail"]='No active subscription found.';
            $response["header"]["errors"] = (Object)[];
        }
        return response()->json($response);
    }
    
    /**
     * socialAuthenticate
     *
     * @param Request $request
     * @return void
     */
    public function socialAuthenticate(Request $request){

        $validator = Validator::make($request->all(), [
            'provider'           => 'required|string',
            'access_token'   => 'required|string',
            'device_id'   => 'required|string',
            'fb_user_id' => 'required_if:provider,==,facebook',
        ]);

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->getMessages() as $key => $value){
                $errors[$key] = $value[0];
            }

            $error_res["header"]["return_flag"]="X";
            $error_res["header"]["error_detail"]='Validation error';
            $error_res["header"]["errors"] = $errors;

            return response()->json($error_res);
        }

        $res=$this->getUserInfo($request->access_token,$request->provider,$request);
        
        if (isset($res['data']) && isset($res['data']['email']) ) {
            $user_data = $this->createNewUser($res['data'],$request->provider);
            
            /* $device = Device::where('user_id',$user_data['user']->id)->where('device_id',$request->device_id)->first();
            if(!$device && $request->device_id){
                Device::create([
                    'user_id' => $user_data['user']->id,
                    'device_id' => $request->device_id,
                ]);
            } */

            $response["header"]["return_flag"]="1";
            $response["header"]["error_detail"]='Signup Successfull';
            $response["header"]["errors"] = (Object)[];
            $response["data"]= new UserResource($user_data['user']);

        } else {
            $response["header"]["return_flag"]="X";
            $response["header"]["error_detail"]='Something went wrong';
            $response["header"]["errors"] = (Object)[];

        }

        return response()->json($response);
    }  
    
    /**
     * createNewUser
     *
     * @param [type] $social_user
     * @param [type] $provider
     * @return void
     */
    public function createNewUser($social_user,$provider){
        $user = User::where(['email' => $social_user['email']])->first();
        if(!$user){
            $name = trim($social_user['first_name'] ?? '') . ' ' . trim($social_user['last_name'] ?? '');
            $user = User::forceCreate([
                'name' => $name,
                'email'             => $social_user['email'] ?? '',
                'original_avatar'     => $social_user['image'] ?? '',
                'password'          => bcrypt(Str::random(10)),
                'role'              => 'subscriber',
                'email_verified_at' => now(),
                'provider'          => $provider,
            ]);
        }

        \Auth::login($user);
        $success['user'] =  $user;
        return $success;
    } 

    /**
     * getUserInfo
     *
     * @param [type] $access_token
     * @param [type] $provider
     * @return void
     */
    public function getUserInfo($access_token,$provider,$request)
    {
        $curl = curl_init();

        if ($provider == 'google') {
            $curl_url="https://oauth2.googleapis.com/tokeninfo?id_token=".$access_token;
            $curl_header=[
                "Accept: application/json",
                "Content-Type: application/json",
            ];
        } else if($provider == 'facebook') {
            $curl_url="https://graph.facebook.com/".$request->fb_user_id."?fields=id,first_name,last_name,email,picture&access_token=".$access_token;
            $curl_header=[
                "Accept: application/json",
                "Content-Type: application/json",
            ];
        }
        
        curl_setopt_array($curl, [
            CURLOPT_URL => $curl_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => $curl_header,
        ]);

        $social_user = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            $res=array(
                "success"=>false,
                "error"=>"cURL Error #:" . $err
            );
        } else {
            if ($provider == 'google') {
                $social_user =json_decode($social_user);
                $response=[
                    'first_name'        => $social_user->given_name ?? '',
                    'last_name'         => $social_user->family_name ?? '',
                    'email'             => $social_user->email ?? '',
                    'image'             => $social_user->picture ?? '',
                ];
            } else if($provider == 'facebook') {
                $social_user =json_decode($social_user);
                $response=[
                    'first_name'        => $social_user->first_name ?? '',
                    'last_name'         => $social_user->last_name ?? '',
                    'email'             => $social_user->email ?? '',
                    'image'             => $social_user->picture->data->url ?? '',
                ];
            }
            
            $res=array(
                "success"=>true,
                "data"=>$response
            );
        }
        
        return $res;
    }

    /**
     * remove_account
     *
     * @param Request $request
     * @return void
     */
    public function remove_account(Request $request)
    {
        $user=User::where('id',$request->user_id)->first();
        if ($request->user_id && $user) {
            $user->delete();

            $response["header"]["return_flag"]="1";
            $response["header"]["error_detail"]='Account has been removed';
            $response["header"]["errors"] = (Object)[];
        } else {
            $response["header"]["return_flag"]="X";
            $response["header"]["error_detail"]='User Not found';
            $response["header"]["errors"] = (Object)[];
        }
        
        return response()->json($response);
    }
    
    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $user=User::where('id',$request->user_id)->first();
        if ($request->user_id && $user) {

            $response["header"]["return_flag"]="1";
            $response["header"]["error_detail"]='Account has been removed';
            $response["header"]["errors"] = (Object)[];
            $response["data"] = new UserResource($user);
        } else {
            $response["header"]["return_flag"]="X";
            $response["header"]["error_detail"]='Unautheticated';
            $response["header"]["errors"] = (Object)[];
        }
        
        return response()->json($response);
    }
}
