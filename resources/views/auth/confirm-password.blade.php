@extends('layouts.layout')

 

@section('content')
    <h1>Сonfirm password:</h1>
    <div class="mb-4 text-sm text-gray-600 ">

        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <label class="form-item">
            <span class="form-item__title">Password</span>
            <input required name="password" placeholder=""   autocomplete="current-password"  value="" type="password" >
            @error('password')
                <span class="form-item__error">{{ $message }}</span> 
            @enderror
        </label>
  

        <div class="flex  mt-4">
            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
@endsection
