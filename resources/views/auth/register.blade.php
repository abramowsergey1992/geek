@extends('layouts.layout')

 

@section('content')
    <h1>Register:</h1>
    <form method="POST" action="{{ route('register') }}">
        @csrf
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
         <label class="form-item">
            <span class="form-item__title">Login</span>
            <input  required name="login" placeholder=""  value="{{ old('login') }}" type="text" >
            @error('login')
                <span class="form-item__error">{{ $message }}</span> 
            @enderror
        </label>
         <label class="form-item">
            <span class="form-item__title">First Name</span>
            <input  required name="first_name" placeholder=""  value="{{ old('first_name') }}" type="text" >
            @error('first_name')
                <span class="form-item__error">{{ $message }}</span> 
            @enderror
        </label>
         <label class="form-item">
            <span class="form-item__title">Last Name</span>
            <input  required name="last_name" placeholder=""  value="{{ old('last_name') }}" type="text" >
            @error('last_name')
                <span class="form-item__error">{{ $message }}</span> 
            @enderror
        </label>
         <label class="form-item">
            <span class="form-item__title">Birth Day</span>
            <input  required name="birthday" placeholder=""  value="{{ old('birthday') }}" type="text" >
            @error('birthday')
                <span class="form-item__error">{{ $message }}</span> 
            @enderror
        </label>
         <label class="form-item">
            <span class="form-item__title">Phone</span>
            <input  required name="phone" placeholder=""  value="{{ old('phone') }}" type="text" >
            @error('phone')
                <span class="form-item__error">{{ $message }}</span> 
            @enderror
        </label>
         <label class="form-item">
            <span class="form-item__title">Role</span>
            <select name="role">
                <option value="student">Student</option>
                <option value="administrator">Administrator</option>
            </select>
             @error('role')
                <span class="form-item__error">{{ $message }}</span> 
            @enderror
        </label>
         <label class="form-item">
            <span class="form-item__title">Email</span>
            <input  required name="email" placeholder=""  value="{{ old('email') }}" type="email" >
            @error('email')
                <span class="form-item__error">{{ $message }}</span> 
            @enderror
        </label>
<!-- 
         <label class="form-item">
            <span class="form-item__title">Name</span>
            <input  required name="email" placeholder=""  value="{{ old('name') }}" type="text" >
            @error('name')
                <span class="form-item__error">{{ $message }}</span> 
            @enderror
        </label> -->
        <label class="form-item">
            <span class="form-item__title">Password</span>
            <input required name="password" placeholder=""   autocomplete="new-password"  value="" type="password" >
            @error('password')
                <span class="form-item__error">{{ $message }}</span> 
            @enderror
        </label>
        <label class="form-item">
            <span class="form-item__title">Confirm Password </span>
            <input required name="password_confirmation" placeholder=""   autocomplete="new-password"  value="" type="password" >
            @error('password_confirmation')
                <span class="form-item__error">{{ $message }}</span> 
            @enderror
        </label>

 


        <div class="flex items-center   mt-4">
            <a class="underline text-sm text-gray-600  hover:text-gray-900   rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 " href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
@endsection