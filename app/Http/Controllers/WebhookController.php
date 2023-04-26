<?php
  
namespace App\Http\Controllers;

use Stripe\Event;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\SubscriptionFailed;
use Laravel\Cashier\Subscription;
use Illuminate\Support\Facades\Mail;
use Laravel\Cashier\SubscriptionItem;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;

class WebhookController extends CashierController
{
    /**
     * Handle a Stripe webhook call.
     *
     * @param  Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleWebhook(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->server('HTTP_STRIPE_SIGNATURE');

        try {
            createLog('stripe_webhook',$request->all());
            $event = Event::constructFrom(
                json_decode($payload, true),
                $sigHeader,
                'whsec_fo80m7c6kYG2EuT1sQlHzfartTkfuZJh'
            );

            // Handle the relevant webhook events
            switch ($event->type) {
                case 'invoice.paid':
                    $this->handleInvoicePaid($event->data->object);
                    break;
                case 'invoice.payment_failed':
                    $this->handleInvoicePaymentFailed($event->data->object);
                    break;
                case 'customer.subscription.updated':
                    $this->handleSubscriptionUpdated($event->data->object);
                    break;
                default:
                    // Unsupported event
                    break;
            }

            return $this->successMethod();
        } catch (\Exception $e) {
            // Invalid payload or signature
            // return $this->failureMethod();
            createLog('stripe_webhook_exception',$e);
        }
    }

    /**
     * Handle the invoice.payment_failed event.
     *
     * @param  \Stripe\Invoice $invoice
     * @return void
     */
    public function handleInvoicePaymentFailed($invoice)
    {
        // Retrieve the relevant user
        $user = User::where('stripe_id',$invoice->customer)->firstOrFail();

        // Retrieve the subscription associated with the invoice
        $subscription = $user->latest_subscription();

        // Cancel the subscription
        // $subscription->cancel();

        try {
            $data=[
                'base_url' =>url('/'),
                "customer_name" => $user->name,
                "subject"       => "Subscription Payment Failed"
            ];
            // Send email notification to user
            Mail::to($user->email)->send(new SubscriptionFailed($data));
        } catch (\Exception $e) {
            createLog('stripe_webhook_mail_exception',$e);
        }
    }

    /**
     * Handle the invoice.paid event.
     *
     * @param  \Stripe\Invoice $invoice
     * @return void
     */
    public function handleInvoicePaid($invoice)
    {
        try {
            // Retrieve the relevant user
            $user = User::where('stripe_id', $invoice->customer)->firstOrFail();

            // Retrieve the subscription associated with the invoice
            $subscription = $user->subscriptions()->where('stripe_id', $invoice->subscription)->firstOrFail();

            // Update the subscription to the next billing period
            $subscription->update([
                'stripe_status' => $subscription->asStripeSubscription()->status,
                'trial_ends_at'=>null,
                'ends_at' => Carbon::createFromTimestamp($subscription->asStripeSubscription()->current_period_end)
            ]);
        } catch (\Exception $e) {
            // Invalid payload or signature
            // return $this->failureMethod();
            createLog('stripe_invoice_paid_exception',$e);
        }
    }

    /**
     * Handle the customer.subscription.updated event.
     *
     * @param  \Stripe\Subscription $subscription
     * @return void
     */
    protected function handleSubscriptionUpdated($subscription)
    {
        // Retrieve the relevant subscription
        $user = User::where('stripe_id', $subscription->customer)->firstOrFail();
        $sub = $user->subscriptions->where('stripe_id', $subscription->id)->first();

        // Update the subscription
        $sub->stripe_status = $subscription->status;
        $sub->ends_at = $subscription->current_period_end ? Carbon::createFromTimestamp($subscription->current_period_end) : null;
        $sub->save();
    }

}