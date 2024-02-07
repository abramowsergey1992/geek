@extends('layouts.layout')

 

@section('content')
    <h1>Forgot your password:</h1>
    <div class="mb-4 text-sm text-gray-600  ">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <label class="form-item">
            <span class="form-item__title">Email</span>
            <input  required name="email" placeholder=""  value="{{ old('email') }}" type="email" >
            @error('email')
                <span class="form-item__error">{{ $message }}</span> 
            @enderror
        </label>

        <div class="flex items-center  mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
@endsection
