<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\UserProfile;
use Illuminate\Support\Str;
use Laravel\Cashier\Billable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use App\Notifications\PasswordResetNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{   
    use Billable;
    use Notifiable;
    use SoftDeletes,HasApiTokens;

    protected $NumberOfTrialDays = 7;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'trial_ends_at'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    

    public function profile(){
        return $this->hasOne(UserProfile::class); 
    }

    public function posts(){
        return $this->hasMany(Post::class,'user_id','id');
    }


    public function devices(){
        return $this->hasMany(Device::class);
    }

    public function activateTrial(){

        if(!$this->trial_ends_at){
            $this->trial_ends_at = now()->addDays($this->NumberOfTrialDays)->format('Y-m-d H:i:s');
            $this->save();
        }

        return $this;

    }

    public function latest_subscription()
    {
        return $this->subscriptions()->latest()->first(); 
    }

    public function active_subscription($type = 'normal')
    {
        $sub=$this->subscriptions()->where(function($q){
            $q->whereDate('trial_ends_at','>',now());
        })->orWhere(function($q){
            $q->whereDate('ends_at','>',now());
        });
        
        if($sub = $sub->latest()->first()){
            if($type == 'boolean'){
                return true;
            }
            return $sub;
        }
        return false;
    }

    public function trialDate()
    {
        $sub=$this->subscriptions()->latest()->first();
        if ($sub && $sub->trial_ends_at ) {
            return $sub;
        }
        return false;
    }

    // subscriptions trial has ended
    public function isTrialActive()
    {
        $sub=$this->subscriptions()->latest()->first();
        if ($sub && $sub->trial_ends_at && Carbon::parse($sub->trial_ends_at)->lt(now()) ) {
            return false;
        }
        return true;
    }

}
