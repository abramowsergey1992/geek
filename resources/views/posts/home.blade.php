@extends('layouts.layout')

 

@section('content')
<h1>Лента постов</h1>
    <div class="">
        @if (session()->has('status'))
            <div class="flex justify-center items-center">
                <p class="ml-3 text-sm font-bold text-green-600">{{ session()->get('status') }}</p>
            </div>
        @endif
		<div class="posts-head">
            <a class="btn" href="{{ route('posts.create') }}">{{ __('Добавить пост') }}</a>
            <div class="posts-filters">
                    <button class="home-sort" sort="desc">
                        <div class="home-sort__icon">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="home-sort__text">Сортировка</div>
                    </button>
            </div>
		</div>
		<div class="post-grid _ajax">

         </div>
        </div>
        <div class="pagination"></div>
    </div>
@endsection