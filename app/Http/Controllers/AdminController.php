<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Mail\PasswordSentEmail;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUser;
use App\Models\UserProfile;
use App\Models\User;
use Mail;

class AdminController extends Controller
{
  	public function index(){

  		// $user_id = auth()->user()->id;
  		// $profile = UserProfile::find($user_id);

    	return view('admin.dashboard');
    }

    public function edit(Request $request,$id)
    {
    	// return dd($id);
        $user = User::with(['profile'])->where('id',$id)->latest()->first();
        return view('admin.edit',compact('user'));
    }

     public function update(StoreUser $request, $id)
    {
        // $validator = Validator::make($request->all(), [ 
        //     'name' => 'required', 
        //     'username' => 'required|unique:users', 
        //     'email' => 'required|email:rfc|unique:users,username,'.auth()->user()->id.',id', 
        //     'password' => 'required', 
        //     'phone' => 'required|unique:user_profiles,phone,'.auth()->user()->id.',user_id',  
        // ]);
        // if ($validator->fails()) { 
        //     return redirect()
        //                 ->back()
        //                 ->withErrors($validator)
        //                 ->withInput();            
        // }

        // $password = $request->password;
        // $hash_password = Hash::make($password);

        $user = User::find($id);

        if($request->hasFile('photo')){
            // storing image
            $originalImage= $request->file('photo');
            $request['picture'] = $request->file('photo')->store('public/storage');
            $request['picture'] = Storage::url($request['picture']);
            $request['picture'] = asset($request['picture']);
            $filename = $request->file('photo')->hashName();

        }
        else{
            $filename = $user->profile->photo;
        } 
        
        $user->name = $request->name;
        // $user->username = $request->username;
        $user->email = $request->email;
        // $user->password = $hash_password;
        $user->role = 'admin';
        $user->save();

        // Mail::to($user)->send(new PasswordSentEmail($password));

        if($user){

            $profile = UserProfile::where('user_id' ,$id)->first();

                $profile->address   = $request->address;
                $profile->city      = $request->city;
                $profile->country   = $request->country;
                $profile->phone     = $request->phone;
                $profile->photo     = $request['picture'] ;
                $profile->save();

            // $profile = $user->profile()->save($profile);
            if($profile){
                Session::flash('message', 'Account Settings Updated Successfully!'); 
                Session::flash('alert-class', 'alert-success');
                return redirect('admin/dashboard'); 
            }      
        }
    }
}
