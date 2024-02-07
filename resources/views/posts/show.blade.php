@extends('layouts.layout')

 
@section('head')
<title>{{$post->title}} | ActQA</title>
@endsection 

@section('content')

<div class="post">
<h1>{{$post->title}}</h1>


@if($post->draft) 
	<div class="post__draft">Is Draft</div>
		@endif
	@php

 
@endphp
		@can('post-crud', '1',$post->user_id)
	<div class="actions-btns-row">
                                <a  class="btn-edit" href="{{ route('posts.edit', $post->id) }}">
                                    <svg  viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="m18 10-4-4m4 4 3-3-4-4-3 3m4 4-1 1m-3-5-6 6v4h4l2.5-2.5m5.5.5v6h-8M10 4H4v16h3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
</a>
                    
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                    onsubmit="return confirm('{{ trans('Are You Sure ? ') }}');"
                                    style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn-delete"
                                        value="Delete">
                                        <svg   viewBox="0 -0.5 21 21" xmlns="http://www.w3.org/2000/svg"><path d="M7.35 16h2.1V8h-2.1v8Zm4.2 0h2.1V8h-2.1v8Zm-6.3 2h10.5V6H5.25v12Zm2.1-14h6.3V2h-6.3v2Zm8.4 0V0H5.25v4H0v2h3.15v14h14.7V6H21V4h-5.25Z" fill="currentColor" fill-rule="evenodd"/></svg>
                                    </button>
                                </form>
                            </div>
@endcan
	<div  class="post__img">
		<img  src="{{ asset('storage/images/'.$post->photo) }}" alt="">
	</div> 
	<div class="post__data">{{$post->delay}}</div>
	<div class="post__content"><div class="post__content-time"></div> {!!$post->content!!}</div>
 <a  class="post__autor" href="{{ route('students.show', $post->user_id) }}">
											<img src="{{ asset('storage/images/'.$post->avatar) }}" alt="">
											{{ $post->first_name }} {{ $post->last_name }}
										</a>
</div>

 
@endsection