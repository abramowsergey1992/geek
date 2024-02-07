@extends('layouts.layout')

 
@section('head')
<title>Create  Post | ActQA</title>
@endsection 

@section('content')

<h1>Create Post</h1>


        <form method="POST" enctype="multipart/form-data"  action="{{ route('posts.store') }}">
            @csrf
            <label class="form-item">
                <span class="form-item__title">Title</span>
                <input name="title" placeholder=""  value="{{ old('title') }}" type="text" >
                @error('title')
                    <span class="form-item__error">{{ $message }}</span> 
                @enderror
            </label>
            <label class="form-item">
                <span class="form-item__title">Description</span>
                <div class="textarea" >
                <textarea  name="description"  maxlength="100"  placeholder=""  value="" >{{ old('description') }}</textarea>
                <div class="textarea__counter"></div>
            </div>
                @error('description')
                    <span class="form-item__error">{{ $message }}</span> 
                @enderror
            </label>
            <label class="form-item">
                <span class="form-item__title">Content</span>
                <div class="textarea" >
                <textarea class="editor" maxlength="1000" name="content" placeholder=""  value="" >{{ old('content') }}</textarea>
                   <div class="textarea__counter"></div>
            </div>
                @error('content')
                    <span class="form-item__error">{{ $message }}</span> 
                @enderror
            </label>
            <div class="form-item">
                <span class="form-item__title">Photo</span>
                <div class="input-file-row">
                    <label class="input-file">
                        <input type="file" name="photo" value=""  accept="image/*">		
                        <span>Select file</span>
                    </label>
                    <div class="input-file-list"></div>  
                </div>
                @error('photo')
                    <span class="form-item__error">{{ $message }}</span> 
                @enderror
            </label>
            <label class="form-item">
                <span class="form-item__title">Delay</span>
                <input  class="datepicker" name="delay" placeholder=""  value="{{ old('delay') }}" type="text" >
                @error('delay')
                    <span class="form-item__error">{{ $message }}</span> 
                @enderror
            </label>
            <label class="form-item">
                <span class="toogle">
                <span class="form-item__title">Post is draft </span> 
                <span class="toogle__indicator"><input 
                type="checkbox" value="0" name='draft'></span>
                </span>
                @error('draft')
                    <span class="form-item__error">{{ $message }}</span> 
                @enderror
            </label>
     
            <x-primary-button type="submit">
                Submit
            </x-primary-button>

        </form>

@endsection