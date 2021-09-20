<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\PasswordResetNotification;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Str;
use App\Models\UserProfile;
use App\Models\Post;
use Laravel\Cashier\Billable;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable
{   
    use Billable;
    use Notifiable;
    use SoftDeletes,HasApiTokens;

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

}
