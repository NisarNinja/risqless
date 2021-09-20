<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\User;

class Post extends Model
{
    use SoftDeletes;

    public function user(){
        return $this->belongsTo(User::class,'user_id','id')->with('profile');
    }
    
}
