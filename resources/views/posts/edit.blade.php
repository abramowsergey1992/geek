@extends('layouts.layout')

 @section('head')
<title>Редактировать  пост | ActQA</title>
@endsection 

@section('content')
<h1>Редактировать пост</h1>


        <form method="POST" enctype="multipart/form-data"  action="{{ route('posts.update',$post->id) }}">
                        @csrf
                        @method('put')
            <label class="form-item">
                <span class="form-item__title">Заголовок</span>
                <input name="title" placeholder=""  value="{{ old('title', $post->title) }}" type="text" >
                @error('title')
                    <span class="form-item__error">{{ $message }}</span> 
                @enderror
            </label>
            <label class="form-item">
                <span class="form-item__title">Описание</span>
                <div class="textarea" ><textarea maxlength="100"   name="description" placeholder=""  value="" >{{ old('description',$post->description) }}</textarea>
                 <div class="textarea__counter"></div>
            </div> @error('description')
                    <span class="form-item__error">{{ $message }}</span> 
                @enderror
            </label>
            <label class="form-item">
                <span class="form-item__title">Текст</span>
                <div class="textarea" > <textarea class="editor" maxlength="1000"  name="content" placeholder=""  value="{{ old('content') }}" >{{ old('content',$post->content) }}</textarea>
                 <div class="textarea__counter"></div>
            </div> @error('content')
                    <span class="form-item__error">{{ $message }}</span> 
                @enderror
            </label>
            <div class="form-item">
                <span class="form-item__title">Фото</span>
                <div class="input-file-row">
                    <label class="input-file">
                        <input type="file" name="photo"   accept="image/*">		
                         <span>Выбрать файл</span>
                    </label>
                    <div class="input-file-list">
                        <div class="input-file-list-item">
                            <img class="input-file-list-img" src="{{ asset('storage/images/'.$post->photo) }}">
                            <span class="input-file-list-name">{{ $post->photo}}</span>
                            <a href="#" class="input-file-list-remove"></a></div>
                    </div>
                @error('photo')
                    <span class="form-item__error">{{ $message }}</span> 
                @enderror
            </label>
            <label class="form-item">
                <span class="form-item__title">Дата публикации</span>
                <input class="datepicker" name="delay" placeholder=""  value="{{ \Carbon\Carbon::parse($post->delay)->format('d.m.Y H:i')  ?? old('delay')}} " type="text" >
                @error('delay')
                    <span class="form-item__error">{{ $message }}</span> 
                @enderror
            </label>
            <label class="form-item">
                <span class="toogle">
                <span class="form-item__title">Черновик </span> <span class="toogle__indicator">
                <input     
                @if($post->draft == 0)
                checked
                @endif
                 type="checkbox" value="0" name='draft'></span>
                </span>
                @error('draft')
                    <span class="form-item__error">{{ $message }}</span> 
                @enderror
            </label>
     
            <x-primary-button type="submit">
                Сохранить
            </x-primary-button>

        </form>

@endsection