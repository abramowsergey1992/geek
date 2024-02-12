@extends('layouts.layout')

@section('head')
<title>Посты | ActQA</title>
@endsection 

@section('content')
<h1>Список постов</h1>
    <div class="">
        @if (session()->has('status'))

            <div class="flex justify-center items-center">
                <p class="ml-3 text-sm font-bold text-green-600">{{ session()->get('status') }}</p>
            </div>
        @endif

        <div class="mt-1 mb-4">
             <a class="btn" href="{{ route('posts.create') }}">+ Добавить пост</a>
        </div>
        <div class="table-overfolow">
            <table class="table-list">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Заголовок</th>
                        <th>Черновик</th>
                        <th>Дата публикации</th>
                        <th>Обновленно</th>
                        <th>Дата создания</th>
                        <th></th>
            
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                    <tr class="post-row">
                        <td>{{ $post->id }}</td>
                        <td>
                            <a  class="post-row__link" href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></td>
                        <td>
                            @if ($post->draft  == 1)
                            Да
                            @endif
                        </td>
                        <td>{{ $post->delay }}</td>
                        <td>{{ $post->updated_at }}</td>
                        <td>{{ $post->created_at }}</td>
                        <td>
                            
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
                        </td>
                        
                    </tr>
                    @empty
                        <td colspan="7"  ><b>Постов нет</b></td>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $posts->links() }}
    </div>
@endsection