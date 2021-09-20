<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Cashier;
use \Stripe\Stripe;
use Illuminate\Support\Carbon;
use Mail;

class SubscriptionController extends Controller
{
    public function __construct() {
       $this->middleware('auth');
   }

   public function processSubscription(Request $request)
   {

       $user = Auth::user();

       $paymentMethod = $request->input('payment_method');

       $user->createOrGetStripeCustomer();

       $user->addPaymentMethod($paymentMethod);
       $plan = $request->input('plan');
       try {

           $user->newSubscription('default', $plan)->trialDays(7)->create($paymentMethod, [
               'email' => $user->email,
           ]);


       } catch (\Exception $e) {
           return back()->withErrors(['message' => 'Error creating subscription. ' . $e->getMessage()]);
       }
      
      session()->flash('message', 'Congratulations! Your are successfully subscribed to the trial plan');
      session()->flash('alert-class', 'alert-success border border-success');

      // Send Push Notification
      $this->fcm(
        $this->getUserDevices($user->id),
        'Congratulations',
        'Your are successfully subscribed to the trial plan'
      );

      //Sending Welcome Email
            // email data
            $email_data = array(
                'name' => $user->name,
                'email' => $user->email,
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

   public function cancelSubscription(Request $request)
   {
      $user = Auth::user();
      $user->subscription('default')->cancel();

      return redirect()->route('about-us');
   }

   public function resumeSubscription(Request $request)
   {
      $user = Auth::user();
      $user->subscription('default')->resume();

      session()->flash('resume', 'Congratulations! Your are successfully resume to your plan');

      return redirect()->route('about-us');
   }

   public function cancelTrial(Request $request)
   {
      $user = Auth::user();
      $user->subscription('default')->endTrial();

      return redirect()->route('about-us');
   }
}
