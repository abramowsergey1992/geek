@extends('layouts.layout')

 

@section('content')
    <h1>Reset password:</h1>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <label class="form-item">
            <span class="form-item__title">Email</span>
            <input  required name="email" placeholder=""  value="{{ old('email') }}" type="email" >
            @error('email')
                <span class="form-item__error">{{ $message }}</span> 
            @enderror
        </label>

        <!-- Password -->
        <label class="form-item">
            <span class="form-item__title">Password</span>
            <input required name="password" placeholder=""   autocomplete="new-password"  value="" type="password" >
            @error('password')
                <span class="form-item__error">{{ $message }}</span> 
            @enderror
        </label>

        <!-- Confirm Password -->
         <label class="form-item">
            <span class="form-item__title">Confirm Password</span>
            <input required name="password_confirmation" placeholder=""   autocomplete="new-password"  value="" type="password" >
            @error('password_confirmation')
                <span class="form-item__error">{{ $message }}</span> 
            @enderror
        </label> 

        <div class="flex items-center   mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
