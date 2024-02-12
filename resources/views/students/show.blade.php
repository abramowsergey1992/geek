@extends('layouts.layout')

 
  @section('head')
<title>{{$user->first_name}} {{$user->last_name}} | ActQA</title>
@endsection 
@section('content')
<h1>{{$user->first_name}} {{$user->last_name}}</h1>
<div class="user">
	<div class="user__row">
		<div class="user__left">
			<img src="{{ asset('storage/images/'.$user->avatar) }}" alt="">
		</div>
		<div class="user__right">
	
		@can('user-crud', '1',$user->user_id)
		            <a class="btn" style="margin-bottom:40px;display: inline-block;" href="{{ route('posts.create') }}">{{ __('+ Добавить пост') }}</a>

<div class="actions-btns-row">
											<!--  -->
											<a  class="btn-student-edit btn-edit" href="{{ route('students.edit', $user->id) }}">
												<svg  viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="m18 10-4-4m4 4 3-3-4-4-3 3m4 4-1 1m-3-5-6 6v4h4l2.5-2.5m5.5.5v6h-8M10 4H4v16h3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
											</a>
								
											<form action="{{ route('students.destroy', $user->id) }}" method="POST"
												onsubmit="return confirm('{{ trans('are You Sure ? ') }}');"
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
			<ul class="user__details">
				<li>
					<b>Логин</b>: {{$user->login}}
				</li>
				<li>
					<b>Имя</b>: {{$user->first_name}}
				</li>
				<li>
					<b>Фамилия</b>: {{$user->last_name}}
				</li>
				<li>
					<b>Роль</b>: {{$user->role}}
				</li>
				<li>
					<b>День рождения</b>: {{$user->birthday}}
				</li>
				<li>
					<b>Телефон</b>: <a href="tel:{{$user->phone}}">{{$user->phone}}</a>
				</li>
				<li>
					<b>Email</b>:	<a href="mailto:{{$user->email}}">{{$user->email}}</a>
				</li>
			</ul>
		</div>
	</div>
</div>
	<h2>Посты пользователя:</h2>
	<div class="post-grid">
                    @forelse ($posts as $post)
                    <div class="post-preview">
						<div class="post-preview__img-wrap">
							<img  src="{{ asset('storage/images/'.$post->photo) }}" alt="">	
						</div>
                       
						 <a  class="post-preview__link" href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
					    <p>{{$post->description}}</p>
						<div class="post-preview__date">{{ \Carbon\Carbon::parse($post->delay)->format('d.m.Y H:i')  }}</div>	
                    </div>
                    @empty
						<p>Post not found</p>
                    @endforelse
         </div>



@endsection