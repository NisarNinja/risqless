<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   

        $trial_ends_at = $this->trial_ends_at;

        if($trial_ends_at){
            if(now()->gte(Carbon::parse($trial_ends_at))){
                // Expired
                $is_trial_active = false;
            }else{
                $is_trial_active = true;
            }
        }else{
            $is_trial_active = false;
        }

        // Check if Subscription is active or not
        $is_subscription_active = $this->active_subscription();

        $array = parent::toArray($request);
        $array['is_subscription_active'] = $is_subscription_active ? true : false;
        $array['latest_subscription_date'] = $is_subscription_active ? $is_subscription_active->created_at : '';
        $array['is_trial_active'] = $this->isTrialActive();
        $array['trial_ends_at'] = $this->trialDate() ? Carbon::parse($this->trialDate()->trial_ends_at)->format('Y-m-d h:i') : false;
        // dd($this->subscriptions);
        // transform user subscriptions
        $array['subscriptions'] =$this->subscriptions()->latest()->get()->transform(function($item, $key) {
            return [
                'id' => $item->stripe_id,
                'subscription_start_date' => $item->created_at? Carbon::parse($item->created_at)->format('Y-m-d h:i') : null,
                'subscription_end_date' => $item->ends_at? Carbon::parse($item->ends_at)->format('Y-m-d h:i') : null,
                'trial_end_date' => $item->trial_ends_at? Carbon::parse($item->trial_ends_at)->format('Y-m-d h:i') : null,
                'next_payment_date' => Carbon::parse($item->trial_ends_at ?? $item->ends_at)->addMonth(1)->format('Y-m-d h:i')
            ];
        });
        return $array;
    }
}
