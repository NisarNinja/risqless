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
        $array['is_subscription_active'] = $is_subscription_active ?? false;
        $array['latest_subscription_date'] = $is_subscription_active ? $is_subscription_active->created_at : '';
        $array['is_trial_active'] = $this->isTrialActive();
        $array['trial_ends_at'] = $this->trialDate() ? Carbon::parse($this->trialDate()->trial_ends_at)->format('Y-m-d h:i') : false;

        return $array;
    }
}
