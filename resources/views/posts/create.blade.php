@extends('layouts.layout')

 
@section('head')
<title>Создать  пост | ActQA</title>
@endsection 

@section('content')

<h1>Создать пост</h1>


        <form method="POST" enctype="multipart/form-data"  action="{{ route('posts.store') }}">
            @csrf
            <label class="form-item">
                <span class="form-item__title">Заголовок</span>
                <input name="title" placeholder=""  value="{{ old('title') }}" type="text" >
                @error('title')
                    <span class="form-item__error">{{ $message }}</span> 
                @enderror
            </label>
            <label class="form-item">
                <span class="form-item__title">Описание</span>
                <div class="textarea" >
                <textarea  name="description"  maxlength="100"  placeholder=""  value="" >{{ old('description') }}</textarea>
                <div class="textarea__counter"></div>
            </div>
                @error('description')
                    <span class="form-item__error">{{ $message }}</span> 
                @enderror
            </label>
            <label class="form-item">
                <span class="form-item__title">Текст</span>
                <div class="textarea" >
                <textarea class="editor" maxlength="1000" name="content" placeholder=""  value="" >{{ old('content') }}</textarea>
                   <div class="textarea__counter"></div>
            </div>
                @error('content')
                    <span class="form-item__error">{{ $message }}</span> 
                @enderror
            </label>
            <div class="form-item">
                <span class="form-item__title">Фото</span>
                <div class="input-file-row">
                    <label class="input-file">
                        <input type="file" name="photo" value=""  accept="image/*">		
                        <span>Выбрать файл</span>
                    </label>
                    <div class="input-file-list"></div>  
                </div>
                @error('photo')
                    <span class="form-item__error">{{ $message }}</span> 
                @enderror
            </label>
            <label class="form-item">
                <span class="form-item__title">Дата публикации</span>
                <input  class="datepicker" name="delay" placeholder=""  value="{{ old('delay') }}" type="text" >
                @error('delay')
                    <span class="form-item__error">{{ $message }}</span> 
                @enderror
            </label>
            <label class="form-item">
                <span class="toogle">
                <span class="form-item__title">Черновик</span> 
                <span class="toogle__indicator"><input 
                type="checkbox" value="0" name='draft'></span>
                </span>
                @error('draft')
                    <span class="form-item__error">{{ $message }}</span> 
                @enderror
            </label>
     
            <x-primary-button type="submit">
            Создать
            </x-primary-button>

        </form>

@endsection