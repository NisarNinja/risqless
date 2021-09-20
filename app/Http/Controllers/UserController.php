<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreUser;
use App\Mail\PasswordSentEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\UserProfile;
use App\User;
use Mail;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        if($request->ajax()){
            $user = $user->newQuery()->with(['profile'])->where('role','customer');
            // dd($user);
            return Datatables::of($user)
                ->addColumn('action', function ($user) {
                    return view('admin.actions.actions_user',compact('user'));
                    })
                ->addColumn('name', function ($user) {
                    $token = 1;
                    return view('admin.actions.actions_user',compact('user','token'));
                    })
                ->addColumn('verification', function ($user) {
                        if($user->phone_verified_at != Null){
                            return '<b>Verified at: </b>'.$user->phone_verified_at;
                        }else{
                            return '<b>Not Verified Yet!</b>';
                        }
                    })
                ->editColumn('id', 'ID: {{$id}}')
                ->rawColumns(['verification','name'])
                ->make(true);
        }
       return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {   
        if ($request['photo']){
            $originalImage= $request->file('photo');
            $request['picture'] = $request->file('photo')->store('public/storage');
            $request['picture'] = Storage::url($request['picture']);
            $request['picture'] = asset($request['picture']);
            // $filename = $request->file('photo')->hashName();
            $file_path = $request['picture']; 
        }
        else{
            $file_path = asset('images/profileavatar.png');
        }
        
        $password = Str::random(8);
        $hash_password = Hash::make($password);
        
        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $hash_password;
        if($request->make_admin){
            $user->role = 'admin';
        }else{
            $user->role = 'customer';
        }
        $user->save();

        Mail::to($user)->send(new PasswordSentEmail($password));

        if($user){
            $profile = new UserProfile([
                'user_id' => $user->id,
                'address'  => $request->address,
                'city'  => $request->city,
                'country'   => $request->country,
                'phone' =>  $request->phone,
                'photo' => $file_path,
                'dob' => $request->dob,
                'gender' => $request->gender,
            ]);

            $profile = $user->profile()->save($profile);
            if($profile){
                Session::flash('message', 'User Created Successfully!'); 
                Session::flash('alert-class', 'alert-success');
                return redirect('admin/users');  
            }      
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with(['profile'])->where('id',$id)->first();
        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $user = User::with(['profile'])->where('id',$id)->latest()->first();
        // dd($user->profile->image);
        return view('admin.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $password = Str::random(8);
        $hash_password = Hash::make($password);

        $user = User::find($id);
        $profile = UserProfile::where('user_id' ,$id)->first();

        if($request->hasFile('photo')){
            // storing image
            $originalImage= $request->file('photo');
            $request['picture'] = $request->file('photo')->store('public/storage');
            $request['picture'] = Storage::url($request['picture']);
            $request['picture'] = asset($request['picture']);
            // $filename = $request->file('photo')->hashName();
            
            $profile->photo     = $request['picture'];
        } 
        
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $hash_password;
        $user->role = 'customer';
        $user->save();

        Mail::to($user)->send(new PasswordSentEmail($password));

        if($user){

                $profile->address   = $request->address;
                $profile->city      = $request->city;
                $profile->country   = $request->country;
                $profile->phone     = $request->phone;
                $profile->dob     =  $request->dob;
                $profile->gender     =  $request->gender;
                $profile->save();

            // $profile = $user->profile()->save($profile);
            if($profile){
                Session::flash('message', 'User Updated Successfully!'); 
                Session::flash('alert-class', 'alert-success');
                return redirect('admin/users'); 
            }      
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id)->forceDelete();
        $profile = UserProfile::where('user_id',$id)->forceDelete();
        if($user){
            return view('admin.user.index');
        }
    }
}
