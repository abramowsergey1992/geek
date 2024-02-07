@extends('layouts.layout')

 

@section('head')
<title>Login page | ActQA</title>
@endsection 
@section('content')
<div class="login-form">
    <h1>Login</h1>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label class="form-item">
            <span class="form-item__title">Login</span>
            <input  required name="login" placeholder=""  value="{{ old('login') }}" type="text" >
            @error('login')
                <span class="form-item__error">{{ $message }}</span> 
            @enderror
        </label>
        <label class="form-item">
            <span class="form-item__title">Password</span>
            <input required name="password" placeholder=""   autocomplete="current-password"  value="" type="password" >
            @error('password')
                <span class="form-item__error">{{ $message }}</span> 
            @enderror
        </label>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded  border-gray-30 text-indigo-600 shadow-sm focus:ring-indigo-500 " name="remember">
                <span class="ms-2 text-sm text-gray-600  ">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center  mt-4">
            <!-- @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600     rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2  " href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif -->

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form></div>
@endsection