<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StorePost;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){

            $post = Post::with(['user:id,name'])->get();
            return Datatables::of($post)
                ->addColumn('action', function ($post) {
                    return view('admin.actions.actions_post',compact('post'));
                    })
                // ->addColumn('user_name', function ($post) {
                //     return $post->user->name;
                //     })
                ->addColumn('topic', function ($post) {
                    $token = 1;
                    return view('admin.actions.actions_post',compact('post','token'));
                    })
                ->addColumn('image', function ($post) {
                        if($post->image != Null){
                            return '<img src="'.$post->image.'" width="50%" class="img-thumbnail">';
                        }
                        else{
                            return 'No Image!';
                        }
                    })
                ->editColumn('id', 'ID: {{$id}}')
                ->rawColumns(['image','topic'])
                ->make(true);
        }
       return view('admin.post.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::pluck('name','id');
        return view('admin.post.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        //storing image
        $post = new Post;
        if ($request['photo']){
            
            $request['picture'] = $request->file('photo')->store('public/storage');
            $request['picture'] = Storage::url($request['picture']);
            $request['picture'] = asset($request['picture']);
            // $filename = $request->file('photo')->hashName();
            $post->image = $request['picture'];
        }

        
        $post->user_id = $request->user_id;
        $post->setAttribute('slug', $request->topic);
        $post->excerpt = $request->excerpt;
        $post->topic = $request->topic;
        $post->description = $request->description;
        $post->tags = $request->tags;
        $post->save();

        if($post){
            Session::flash('message', 'Post Created Successfully!'); 
            Session::flash('alert-class', 'alert-success');
            return redirect('admin/posts');
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
        
        $post = Post::find($id);
        return view('admin.post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $post = Post::find($id);
        $user = User::pluck('name','id');
        return view('admin.post.edit',compact('post','user'));
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
        $post = Post::find($id);
         if($request->hasFile('photo')){
            //storing image
            
            $request['picture'] = $request->file('photo')->store('public/storage');
            $request['picture'] = Storage::url($request['picture']);
            $request['picture'] = asset($request['picture']);
            // $filename = $request->file('photo')->hashName();
            $post->image = $request['picture'];
         }

        $post->user_id = $request->user_id;
        $post->excerpt = $request->excerpt;
        $post->topic = $request->topic;
        $post->description = $request->description;
        $post->tags = $request->tags;
        $post->save();

        if($post){
            Session::flash('message', 'Post Updated Successfully!'); 
            Session::flash('alert-class', 'alert-success');
            return redirect('admin/posts');
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
        $post = Post::find($id)->forceDelete();
        if($post){
            return view('admin.post.index');
        }
    }
}
