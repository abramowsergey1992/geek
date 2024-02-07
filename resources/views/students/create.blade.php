@extends('layouts.layout')

 @section('head')
<title>Create Student | ActQA</title>
@endsection 

@section('content')
    <h1>Create Student:</h1>
    <form enctype="multipart/form-data" method="POST" action="{{ route('students.store') }}">
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
		<div class="columns-2">
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
            <input  required name="birthday" class="birthday"  placeholder=""  value="{{ old('birthday') }}" type="text" >
            @error('birthday')
                <span class="form-item__error">{{ $message }}</span> 
            @enderror
        </label>
         <label class="form-item">
            <span class="form-item__title">Phone</span>
            <input  required name="phone" placeholder="" class="_mask-phone" value="{{ old('phone') }}" type="text" >
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
            <input required name="password" placeholder=""   autocomplete="new-password"  value="" type="text" >
            @error('password')
                <span class="form-item__error">{{ $message }}</span> 
            @enderror
        </label>

 
		</div>
<div class="form-item">
                <span class="form-item__title">Avatar</span>
                <div class="input-file-row">
                    <label class="input-file">
                        <input type="file" name="avatar" value=""  accept="image/*">		
                        <span>Select file</span>
                    </label>
                    <div class="input-file-list">
                        
                    </div>
                </div>
                @error('avatar')
                    <span class="form-item__error">{{ $message }}</span> 
                @enderror
            </div>
        <div class="flex items-center   mt-4">
      
            <x-primary-button class="ms-4">
                {{ __('Create') }}
            </x-primary-button>
        </div>
    </form>
@endsection