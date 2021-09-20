<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Post;
use Laravel\Cashier\Cashier;
use \Stripe\Stripe;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {   
        $plans = $this->retrievePlans();
        $user = new User;
        $intent = $user->createSetupIntent();

        return view('user.pages.home', [ 
            'intent' => $intent,
            'plans' => $plans,
        ]);
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

    public function about_us(Request $request)
    {
        $plans = $this->retrievePlans();
        $user = Auth::user();

        $trial_ends_at = false;
        $trail_expired = false;
        $ends_at = false;
        $intent = null;

        if(Auth::check()){
           if($user->subscription('default') !== null ){

              if($user->subscription('default')->onTrial() == null)
                $trail_expired = true;

            }
            else if($user->subscription('default') !== null && $user->subscription('default')->onTrial() && !$user->subscription('default')->onGracePeriod()){
            $days_left = new Carbon($user->subscription('default')->trial_ends_at);
            $now = Carbon::now();
            $trial_ends_at = $days_left->diffInDays($now);
        }

            if ( $user->subscription('default') !== null && $user->subscription('default')->onGracePeriod()) {

                $ends_at = $user->subscription('default')->asStripeSubscription()->current_period_end;
                $ends_at = new Carbon($ends_at);
                $now = Carbon::now();
                $ends_at = $ends_at->diffInDays($now);

            }
            $intent = $user->createSetupIntent();
        }

        return view('user.pages.about-us', [
           'user'=>$user,
           'intent' =>$intent,
           'plans' => $plans,
           'trial_ends_at' => $trial_ends_at,
           'trail_expired' => $trail_expired,
           'ends_at'=>$ends_at,
       ]);

    }

    public function fileData($request){

        $user = User::find($request->query('user_id') ?? $request->user_id ?? auth()->id());
        $posts = $user->posts()->get();
        $plans = $this->retrievePlans();

        $trial_ends_at = false;
        $ends_at = false;
        $third_party_login = false;
        $intent = null;

        if($user->subscription('default') !== null && $user->subscription('default')->onTrial() && !$user->subscription('default')->onGracePeriod()){
            $days_left = new Carbon($user->subscription('default')->trial_ends_at);
            $now = Carbon::now();
            $trial_ends_at = $days_left->diffInDays($now);
        }

        if ( !empty($user->subscription('default')) && $user->subscription('default')->onGracePeriod()) {
                $ends_at = $user->subscription('default')->asStripeSubscription()->current_period_end;
                $ends_at = new Carbon($ends_at);
                $now = Carbon::now();
                $ends_at = $ends_at->diffInDays($now);

        }  
              
        if($user->google_id !==null || $user->fb_id !== null){

          if($user->stripe_id == null || $user->card_brand == null || $user->subscription('default') == null){

            $third_party_login = true;
            $intent = $user->createSetupIntent();
         
          }

        }

        return [
           'user'=>$user,
           'intent' =>$intent,
           'plans' => $plans,
           'posts' => $posts,
           'trial_ends_at' => $trial_ends_at,
           'ends_at'=>$ends_at,
           'third_party_login' => $third_party_login,
       ];
            
    }

    public function fileAPI(Request $request)
    {
        $data = $this->fileData($request);

        return view('user.pages.file_api', $data);
    }

    public function file(Request $request)
    {
        $data = $this->fileData($request);
        return view('user.pages.file', $data);
    }

    public function card_details(Request $request)
    {
        $user = User::find(auth()->id());
        $plans = $this->retrievePlans();
        $intent = $user->createSetupIntent();

        return view('user.pages.card_details', [
           'user'=>$user,
           'intent' =>$intent,
           'plans' => $plans,
       ]);
    }
}
