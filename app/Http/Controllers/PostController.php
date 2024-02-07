<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;
use DB;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

use Image;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Carbon;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function apiIndex(Request $request)
    {
        if($request->get('sort')!=null){
            $sort=$request->get('sort');
        }else{
            $sort='desc';
        }
     
         $posts = Post::where('draft', '==', 0)->where('delay', '<=', now())->orderBy('delay',  $sort)->paginate(6);
        return   $posts;
    }


    public function home()
    {   
        $posts = Post::paginate(6);
        return view('posts.home', compact('posts'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()

    {          

         if (! Gate::allows('is-admin')) {
            abort(403);
        }
        $posts = Post::latest()->paginate(15);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! Gate::allows('is-auth')) {
            abort(403);
        }
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          if (! Gate::allows('is-auth')) {
            abort(403);
        }
        $request->validate([
            'title' => 'required|string|max:40',
            'photo' => [
        'required', 'extensions:jpg,png',
        File::image()->max(2 * 1024)
    ],
            'description' => 'required|string|max:100',
            'content' => 'required|string|max:1000',
            'draft' => 'boolean',
    
            'delay' => 'required' 
        ]);

        $fileName ='';
        if ($request->hasFile('photo')) {
            $fileName = time() . '.' . $request->photo->extension();
            $request->photo->storeAs('public/images', $fileName);
        }
        Post::create([
            'title' => $request->title,
            'user_id' => Auth::user()->id,
            'photo' =>   $fileName ,
            'description' => $request->description,
            'content' => $request->content,
             'delay' => Carbon::createFromFormat('d.m.Y H:i', $request->delay)->format('Y-m-d H:i'),
            'draft' => $request->draft,
        ]);
      

        return redirect()->route('posts.index')->with('status', 'Post Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {  
    $post = DB::table('posts')
      ->join('users', 'users.id', '=', 'posts.user_id')
      ->select('posts.*', 'users.first_name','users.last_name','users.avatar')
      ->where('posts.id', $id)
      ->get();
         return view('posts.show', ['post'=>$post[0]]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {   
         
       if (! Gate::allows('post-crud',$post->user_id,$post->user_id)) {
            abort(403);
        }
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
            if (! Gate::allows('post-crud',$post->user_id,$post->user_id)) {
            abort(403);
        }
        $request->validate([
            'title' => 'required|string|max:40',
            'description' => 'required|string|max:100',
            'content' => 'required|string|max:1000',
            'draft' => 'boolean',
            'delay' => 'required'
        ]);

        $fileName = '';
     
        if ($request->hasFile('photo')) {
          $fileName = time() . '.' . $request->photo->extension();
          $request->photo->storeAs('public/images', $fileName);
          if ($post->photo) {
            Storage::delete('public/images/' . $post->photo);
          }
        } else {
          $fileName = $post->photo;
        }
        $post->content = $request->content;
        $post->title = $request->title;
        $post->photo = $fileName;
        $post->description =  $request->description;
        $post->delay = Carbon::createFromFormat('d.m.Y H:i', $request->delay)->format('Y-m-d H:i');
        $post->draft = $request->draft;
     
        $post->save();

        return redirect()->route('posts.index')->with('status', 'Post Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
         if (! Gate::allows('post-crud',$post->user_id,$post->user_id)) {
            abort(403);
        } 
       $post->delete();

        return redirect()->route('posts.home')->with('status', 'Post Delete Successfully');
    }
}
