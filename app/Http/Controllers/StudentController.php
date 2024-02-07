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
use Illuminate\Support\Facades\Hash;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
       public function index()
    {
        $users = User::latest()->paginate(10);
        return view('students.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'login' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'birthday' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', Rules\Password::defaults()],
        ]);
         $fileName ='';
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

 

    public function get(string $id)
    {   
        return User::find($id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('students.show', ['user' => User::find($id),'posts'=> Post::where('delay', '<=', now())->where('draft', '==', 0)->where("user_id",$id)->get()]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('students.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
     
        $request->validate([
            'login' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'birthday' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'password' => ['required', Rules\Password::defaults()],
        ]);
        $user =  User::find($id);
        $fileName ='';
        if ($request->hasFile('avatar')) {
          $fileName = time() . '.' . $request->avatar->extension();
          $request->avatar->storeAs('public/images', $fileName);
          if ($user->avatar !='') {
            Storage::delete('public/images/' . $user->avatar);
          }
        } else {
          $fileName = $user->avatar;
        }
        $user->avatar = $fileName;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->login = $request->login;
        $user->password = $request->password;
        $user->role = $request->role;
        $user->birthday = Carbon::createFromFormat('d.m.Y', $request->birthday)->format('Y-m-d');
       
        $user->save();

         return redirect()->route('students.index')->with('status', 'Student Updatet Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

       User::find($id)->delete();

        return redirect()->route('students.index')->with('status', 'User delete successfully');
    }
}
