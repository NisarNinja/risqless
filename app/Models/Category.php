<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use App\Models\Place;
// use App\Service;

class Category extends Model
{
	use SoftDeletes;
	
    protected $guarded = [];

    public function children(){
    	return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function parent(){
    	return $this->belongTo(Category::class, 'parent_id', 'id');
    }

    public function places(){
    	return $this->hasMany(Place::class,'category_id','id')->with(['rating','photos'])->withCount('rating');

    }

    public function services(){
        return $this->hasMany(Service::class,'category_id','id')->with(['rating','photos'])->withCount('rating');
    }

    public function popular(){
        return $this->belongsToMany(Category::class,'category_users');
    }
}
