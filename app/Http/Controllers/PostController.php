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
use Illuminate\Support\Facades\Validator;
use Image;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Carbon;

class PostController extends Controller
{
    public function api_index(Request $request)
    {
        if ($request->get('sort') != null) {
            $sort = $request->get('sort');
        } else {
            $sort = 'desc';
        }

        $posts = Post::where('draft', '==', 0)->where('delay', '<=', now())->orderBy('delay',  $sort)->paginate(6);
        return response()->json($posts, 200);
    }
    public function api_show(Request $request)
    {
        $post = Post::find($request->id);
        if ($post === null) {
            return response()->json([
                'status' => 'error',
                'message' => 'Post Not Found',
            ], 404);
        } else {
            return response()->json($post, 200);
        }
    }
    public function api_update(Request $request)
    {
        $post = Post::find($request->id);
        if ($post === null) {
            return response()->json([
                'status' => 'error',
                'message' => 'Post Not Found',
            ], 404);
        }
        if ($post->user_id == $request->user()->id || $request->user()->role == "administrator") {

            try {
                $validate = Validator::make(
                    $request->all(),
                    [
                        'title' => 'string|max:40',
                        'photo' => [
                            'extensions:jpg,png',
                            File::image()->max(2 * 1024)
                        ],
                        'description' => 'string|max:100',
                        'content' => 'string|max:1000',
                        'draft' => 'boolean',
                        'delay' => 'date|after_or_equal:now'
                    ]
                );

                if ($validate->fails()) {
                    return response()->json([
                        'status' => false,
                        'message' => 'validation error',
                        'errors' => $validate->errors()
                    ], 401);
                }

                $fileName = '';
                if ($request->hasFile('photo')) {
                    $fileName = time() . '.' . $request->photo->extension();
                    $request->photo->storeAs('public/images', $fileName);
                }
                $draft = $request->draft;
                if ($draft == null) {
                    $draft = 0;
                }

                if ($fileName) {
                    $post->photo = $fileName;
                }
                if ($request->title) {
                    $post->title = $request->title;
                }
                if ($request->description) {
                    $post->description = $request->description;
                }
                if ($request->content) {
                    $post->content = $request->content;
                }
                if ($request->delay) {
                    $post->delay = Carbon::createFromFormat('d.m.Y H:i', $request->delay)->format('Y-m-d H:i');
                }

                $post->draft = $draft;


                $post->save();

                return response()->json([
                    'status' => true,
                    'message' => 'Post Updated In Successfully',
                ], 200);
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => false,
                    'message' => $th->getMessage()
                ], 500);
            }
        } else {
            return response()->json([
                'status' => "error",
                'message' => 'Insufficient permissions to update',
            ], 401);
        }


        // return redirect()->route('students.index')->with('status', 'Student Created Successfully');
    }
    public function api_create(Request $request)
    {
        if ($request->user()->role == "administrator") {
            try {
                $validate = Validator::make(
                    $request->all(),
                    [
                        'title' => 'string',
                        'photo' => [
                            'nullable',
                            'extensions:png',
                            File::image()->max(2 * 1024)
                        ],
                        'description' => 'nullable|string|max:100',
                        'content' => 'nullable|string|max:1000',
                        'draft' => 'boolean',
                        'delay' => 'required|date|after_or_equal:now'
                    ]
                );

                if ($validate->fails()) {
                    return response()->json([
                        'status' => false,
                        'message' => 'validation error',
                        'errors' => $validate->errors()
                    ], 401);
                }


                $fileName = '';
                if ($request->hasFile('photo')) {
                    $fileName = time() . '.' . $request->photo->extension();
                    $request->photo->storeAs('public/images', $fileName);
                }
                $draft = $request->draft;
                if ($draft == null) {
                    $draft = 0;
                }
                Post::create([
                    'title' => $request->title,
                    'user_id' => $request->user()->id,
                    'photo' =>   $fileName,
                    'description' => $request->description,
                    'content' => $request->content,
                    'delay' => Carbon::createFromFormat('d.m.Y H:i', $request->delay)->format('Y-m-d H:i'),
                    // 'draft'  => $draft,
                ]);

                return response()->json([
                    'status' => true,
                    'message' => 'Post Create In Successfully',
                ], 200);
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => false,
                    'message' => $th->getMessage()
                ], 500);
            }
        } else {
            return response()->json([
                'status' => "error",
                'message' => 'Insufficient permissions to create',
            ], 401);
        }


        return redirect()->route('students.index')->with('status', 'Student Created Successfully');
    }
    public function api_delete(Request $request)
    {
        $post = Post::find($request->id);
        if ($post === null) {
            return response()->json([
                'status' => 'error',
                'message' => 'Post Not Found',
            ], 404);
        }
        if ($post->user_id == $request->user()->id || $request->user()->role == "administrator") {


            $post->delete();
            return response()->json([
                'status' => true,
                'message' => 'Post Deleted In Successfully',
            ], 200);
        } else {
            return response()->json([
                'status' => "error",
                'message' => 'Insufficient permissions to delete',
            ], 401);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function apiIndex(Request $request)
    {
        if ($request->get('sort') != null) {
            $sort = $request->get('sort');
        } else {
            $sort = 'desc';
        }

        $posts = Post::where('draft', '==', 0)->where('delay', '<=', now())->orderBy('delay',  $sort)->paginate(6);
        return   $posts;
    }
    /**
     * Display a listing of the resource.
     */
    public function getPost(string $id)
    {

        $post = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->select('posts.*', 'users.first_name', 'users.last_name', 'users.avatar')
            ->where('posts.id', $id)->first();



        //               if (! Gate::allows('post-crud',$post->user_id,$post->user_id)) {
        //                    return   "Нет доступа";   
        //    }
        return   $post;
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

        if (!Gate::allows('is-admin')) {
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
        if (!Gate::allows('is-auth')) {
            abort(403);
        }
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Gate::allows('is-auth')) {
            abort(403);
        }
        $request->validate(
            [
                'title' => 'required|string',
                'photo' =>  [
                    'nullable',
                    'extensions:png',
                    File::image()->max(2 * 1024)
                ],
                'description' => 'nullable|string|max:100',
                'content' => 'nullable|string|max:1000',
                'draft' => 'boolean',

                'delay' => 'required|date|after_or_equal:now'
            ],
            [
                'delay.after_or_equal' => 'Ошибка!',
            ]
        );

        $fileName = 'no-photo.jpg';
        if ($request->hasFile('photo')) {
            $fileName = time() . '.' . $request->photo->extension();
            $request->photo->storeAs('public/images', $fileName);
        }
        $post = Post::create([
            'title' => $request->title,
            'user_id' => Auth::user()->id,
            'photo' =>   $fileName,
            'description' => $request->description,
            'content' => $request->content,
            'delay' => Carbon::createFromFormat('d.m.Y H:i', $request->delay)->format('Y-m-d H:i'),
            // 'draft' => $request->draft,
        ]);


        return redirect()->route('posts.show', $post->id)->with('status', 'Пост создан успешно');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->select('posts.*', 'users.first_name', 'users.last_name', 'users.avatar')
            ->where('posts.id', $id)
            ->get();
        return view('posts.show', ['post' => $post[0]]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {

        if (!Auth::check()) {
            abort(403);
        }
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if (!Gate::allows('post-crud', $post->user_id, $post->user_id)) {
            abort(403);
        }
        $request->validate([
            'title' => 'required|string|max:40',
            'description' => 'required|string|max:100',
            'content' => 'required|string|max:1000',
            'draft' => 'boolean',
            'delay' => 'required|date'
        ]);

        $fileName = '';

        if ($request->hasFile('photo')) {
            $fileName = time() . '.' . $request->photo->extension();
            $request->photo->storeAs('public/images', $fileName);
            if ($post->photo) {
                Storage::delete('public/images/' . $post->photo);
            }
        } else {
            if ($request->delete_photo == 1) {
                $fileName = $post->photo;
                // $fileName = 'no-photo.jpg';
                // Storage::delete('public/images/' . $post->photo);
            } else {
                $fileName = $post->photo;
            }
        }
        $post->content = $request->content;
        $post->title = $request->title;
        $post->photo = $fileName;
        $post->description =  $request->description;
        $post->delay = Carbon::createFromFormat('d.m.Y H:i', $request->delay)->format('Y-m-d H:i');
        $post->draft = $request->draft;

        $post->save();

        return redirect()->route('posts.show', $post->id)->with('status', 'Пост Обновлен Успешно');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (!Gate::allows('post-crud', $post->user_id, $post->user_id)) {
            abort(403);
        }
        $post->delete();

        return redirect()->route('posts.profile')->with('status', 'Пост Удален Успешно');
    }
}
