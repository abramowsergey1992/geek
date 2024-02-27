@extends('layouts.layout')

@section('head')
<title>Добавить студента | ActQA</title>
@endsection

@section('content')
<h1>Добавить студента:</h1>
<form enctype="multipart/form-data" method="POST" action="{{ route('students.store') }}">
    @csrf
    <input type="hidden" name="url_previous" value=" {{URL::previous()}}">

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
            <span class="form-item__title">Логин</span>
            <input required name="login" placeholder="" value="{{ old('login') }}" type="text">
            @error('login')
            <span class="form-item__error">{{ $message }}</span>
            @enderror
        </label>
        <label class="form-item">
            <span class="form-item__title">Имя</span>
            <input required name="first_name" placeholder="" value="{{ old('first_name') }}" type="text">
            @error('first_name')
            <span class="form-item__error">{{ $message }}</span>
            @enderror
        </label>
        <label class="form-item">
            <span class="form-item__title">Фамилия</span>
            <input required name="last_name" placeholder="" value="{{ old('last_name') }}" type="text">
            @error('last_name')
            <span class="form-item__error">{{ $message }}</span>
            @enderror
        </label>
        <label class="form-item">
            <span class="form-item__title">Дата рождения</span>
            <input required name="birthday" class="birthday" placeholder="" value="{{ old('birthday') }}" type="text">
            @error('birthday')
            <span class="form-item__error">{{ $message }}</span>
            @enderror
        </label>
        <label class="form-item">
            <span class="form-item__title">Phone</span>
            <input required name="phone" placeholder="" class="_mask-phone" value="{{ old('phone') }}" type="text">
            @error('phone')
            <span class="form-item__error">{{ $message }}</span>
            @enderror
        </label>

        <label class="form-item">
            <span class="form-item__title">Роль</span>
            <select name="role">
                <option value="student">Студент</option>
                <option value="administrator">Администратор</option>
            </select>
            @error('role')
            <span class="form-item__error">{{ $message }}</span>
            @enderror
        </label>
        <label class="form-item">
            <span class="form-item__title">Email</span>
            <input required name="email" placeholder="" value="{{ old('email') }}" type="email">
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
            <span class="form-item__title">Пароль</span>
            <input required name="password" placeholder="" autocomplete="new-password" value="" type="text">
            @error('password')
            <span class="form-item__error">{{ $message }}</span>
            @enderror
        </label>


    </div>
    <div class="form-item">
        <span class="form-item__title">Аватар</span>
        <div class="input-file-row">
            <label class="input-file">
                <input type="file" name="avatar" value="" accept="image/*">
                <span>Выберите файл</span>
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
            {{ __('Создать') }}
        </x-primary-button>
    </div>
</form>
@endsection