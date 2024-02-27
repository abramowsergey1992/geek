<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use Image;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{

    public function api_index(Request $request)
    {
        $users = User::latest()->paginate(10);
        return response()->json($users, 200);
    }
    public function api_show(Request $request)
    {
        $user = User::find($request->id);
        if ($user === null) {
            return response()->json([
                'status' => 'error',
                'message' => 'User Not Found',
            ], 404);
        } else {
            return response()->json($user, 200);
        }
    }
    public function api_update(Request $request)
    {
        if ($request->user()->id === $request->id || $request->user()->role == "administrator") {

            try {
                $validate = Validator::make(
                    $request->all(),
                    [
                        'login' => ['string', 'max:255', Rule::unique('users')->ignore($request->id)],
                        'first_name' => ['string', 'max:255'],
                        'role' => ['string', 'max:255'],
                        'last_name' => ['string', 'max:255'],
                        'birthday' => ['string', 'max:255'],
                        'phone' => ['string', 'max:255', Rule::unique('users')->ignore($request->id)],
                        'email' => ['string', 'lowercase', 'max:255', Rule::unique('users')->ignore($request->id)],
                        'password' => [Rules\Password::defaults()],
                    ]
                );

                if ($validate->fails()) {
                    return response()->json([
                        'status' => false,
                        'message' => 'validation error',
                        'errors' => $validate->errors()
                    ], 401);
                }
                $user =  User::find($request->id);
                $fileName = 0;
                if ($request->hasFile('avatar')) {
                    $fileName = time() . '.' . $request->avatar->extension();
                    $request->avatar->storeAs('public/images', $fileName);
                    if ($user->avatar != '') {
                        Storage::delete('public/images/' . $user->avatar);
                    }
                }
                if ($fileName) {
                    $user->avatar = $fileName;
                }


                if ($request->first_name) {
                    $user->first_name = $request->first_name;
                }
                if ($request->last_name) {
                    $user->last_name = $request->last_name;
                }
                // if ($request->phone) {
                //     $user->phone = $request->phone;
                // }
                if ($request->email) {
                    $user->email = $request->email;
                }
                if ($request->login) {
                    $user->login = $request->login;
                }
                if ($request->password) {
                    $user->password = $request->password;
                }
                if ($request->role) {
                    $user->role = $request->role;
                }
                if ($request->birthday) {
                    $user->birthday
                        = Carbon::createFromFormat('d.m.Y', $request->birthday)->format('Y-m-d');
                }


                $user->save();

                return response()->json([
                    'status' => true,
                    'message' => 'User Updated In Successfully',
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
                        'login' => ['required', 'string', 'max:255', 'unique:' . User::class],
                        'first_name' => ['required', 'string', 'max:255'],
                        'role' => ['required', 'string', 'max:255'],
                        'last_name' => ['required', 'string', 'max:255'],
                        'birthday' => ['required', 'string', 'max:255'],
                        'phone' => ['required', 'string', 'max:255', 'unique:' . User::class],
                        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                        'password' => ['required', Rules\Password::defaults()],
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
                if ($request->hasFile('avatar')) {
                    $fileName = time() . '.' . $request->avatar->extension();
                    $request->avatar->storeAs('public/images', $fileName);
                }


                User::create([

                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'birthday' => Carbon::createFromFormat('d.m.Y', $request->birthday)->format('Y-m-d'),
                    'avatar' => $fileName,
                    'phone' => $request->phone,
                    'role' => $request->role,
                    'email' => $request->email,
                    'login' => $request->login,
                    'password' => Hash::make($request->password),
                ]);
                return response()->json([
                    'status' => true,
                    'message' => 'User Create In Successfully',
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

        if ($request->user()->role == "administrator") {
            $user = User::find($request->id);
            if ($user === null) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User Not Found',
                ], 404);
            } else {
                $user->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'User Deleted In Successfully',
                ], 200);
            }
        } else {
            return response()->json([
                'status' => "error",
                'message' => 'Insufficient permissions to delete',
            ], 401);
        }
    }


    public function api_login(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'login' => 'required',
                    'password' => 'required'
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if (!Auth::attempt($request->only(['login', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Login & Password does not match with our record.',
                ], 401);
            }
            $user = User::where('login', $request->login)->first();
            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
        // $request->authenticate();

        // $request->session()->regenerate();


    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Gate::allows('is-admin')) {
            abort(403);
        }
        $users = User::latest()->paginate(10);
        return view('students.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Gate::allows('is-admin')) {
            abort(403);
        }
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Gate::allows('is-admin')) {
            abort(403);
        }
        $request->validate([
            'login' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'first_name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'birthday' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', Rules\Password::defaults()],
        ]);
        $fileName = '';
        if ($request->hasFile('avatar')) {
            $fileName = time() . '.' . $request->avatar->extension();
            $request->avatar->storeAs('public/images', $fileName);
        }


        $user = User::create([

            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'birthday' => Carbon::createFromFormat('d.m.Y', $request->birthday)->format('Y-m-d'),
            'avatar' => $fileName,
            'phone' => $request->phone,
            'role' => $request->role,
            'email' => $request->email,
            'login' => $request->login,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('students.index')->with('status', 'Student Created Successfully');
    }



    /**
     * Display the specified resource.
     */

    public function profile()
    {
        if (!Auth::check()) {
            abort(403);
        }
        return view('students.profile', ['user' => User::find(Auth::user()->id), 'posts' => Post::where("user_id", Auth::user()->id)->get()]);
    }

    public function show(string $id)
    {
        return view('students.show', ['user' => User::find($id), 'posts' => Post::where('delay', '<=', now())->where('draft', '==', 0)->where("user_id", $id)->get()]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!Gate::allows('user-crud', $id, $id)) {
            abort(403);
        }
        $user = User::find($id);
        return view('students.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!Gate::allows('user-crud', $id, $id)) {
            abort(403);
        }
        $request->validate([
            'login' => ['required', 'string', 'max:255', 'unique:' .  Rule::unique('users')->ignore($id)],
            'first_name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'birthday' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255', 'unique:' .  Rule::unique('users')->ignore($id)],
            'email' => ['required', 'string', 'lowercase',  'max:255', Rule::unique('users')->ignore($id)],
            'password' => ['required', Rules\Password::defaults()],
        ]);
        $user =  User::find($id);
        $fileName = '';
        if ($request->hasFile('avatar')) {
            $fileName = time() . '.' . $request->avatar->extension();
            $request->avatar->storeAs('public/images', $fileName);
            if ($user->avatar != '') {
                Storage::delete('public/images/' . $user->avatar);
            }
        } else {
            if ($request->delete_photo == 1) {
                Storage::delete('public/images/' . $user->avatar);
                $fileName = 'no-avatar.jpg';
            } else {
                $fileName = $user->avatar;
            }
        }
        $user->avatar = $fileName;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        // $user->phone = $request->phone;
        $user->email = $request->email;
        $user->login = $request->login;
        $user->password = $request->password;
        $user->role = $request->role;
        $user->birthday = Carbon::createFromFormat('d.m.Y', $request->birthday)->format('Y-m-d');

        $user->save();

        return redirect($request->url_previous)->with('status', 'Student Updatet Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Gate::allows('is-admin')) {
            abort(403);
        }
        User::find($id)->delete();

        return redirect()->route('students.index')->with('status', 'User delete successfully');
    }
}
