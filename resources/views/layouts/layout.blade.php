<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

            
        @yield('head')

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<!-- 
        <script>
        tinymce.init({
            selector: 'textarea.editor', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'powerpaste advcode table lists checklist',
            toolbar: 'undo redo | blocks| bold italic | bullist numlist checklist | code | table'
        });
        </script> -->

        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <!-- Scripts -->
        @vite(['resources/css/app.scss', 'resources/js/app.js'])
    </head>
 
<body>

        <div class="layout">
            <header class="header">
                <div class="inner">
                    <div class="header__row">
         
                      <ul class="main-menu">
                            <li>
                                <a href="/"  class="
                                @if(Request::path() === '/')
_active
 @endif ">Главная</a>
                            </li>
                            <li>
                                <a href="{{ route('about') }}"  class="
                                @if(Request::path() === 'about')
_active
 @endif " >О нас</a>
                            </li>
@can('is-admin')
                            <li>
                                <a href="{{ route('posts.index') }}"  class="
                                @if(Request::path() === 'posts')
_active
 @endif "">Посты</a>
                            </li>
                            <li>
                                <a href="{{ route('students.index') }}"  class="
                                @if(Request::path() === 'students')
_active
 @endif ">Пользователи</a>
                            </li>
                    @endcan
                            <li>
                                 @if (Route::has('login'))
                        
                                @auth
                                    <a href="{{ route('students.show',Auth::user()->id) }}" class="toolbar__link 
                                    @if(Request::path() === 'students/'.Auth::user()->id)
                                        _active
                                    @endif">Профиль</a>
                                    <ul>
                                        <li> 
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <a href="{{ route('logout') }}"  onclick="event.preventDefault();
                                                                    this.closest('form').submit();">Выйти</a>

                                            </form>
                                        </li>
                                    </ul> 
                                     @endauth
                                @endif
                                @if (!Auth::check())
                                    <a href="{{ route('login') }}" class="toolbar__link">Войти</a>
                                    <!-- <span class="divider">/</span>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="toolbar__link">Register</a>
                                    @endif -->
                            
                            
                                 @endif
                            </li>
                        </ul>
                     </div>
                </div>
                    <!-- <div class="toolbar">
                        @if (Route::has('login'))
                        
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="toolbar__link">My profile</a>
                                @else
                                    <a href="{{ route('login') }}" class="toolbar__link">Log in</a>
                                    <span class="divider">/</span>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="toolbar__link">Register</a>
                                    @endif
                                @endauth
                            
                        @endif
                    </div> -->
                  
               
            </header>
            <main>
                <div class="inner">
                    @yield('content')
                </div>
            </main>
            <footer class="footer">
                <div class="inner">
                    <div class="footer__copy">
                    Все права защещены ⓒ {{ now()->year }}, Action Group
                    </div>
                </div>
            </footer>
        </div>        <script>
    //         if( document.querySelector( 'textarea.editor' )){
    // ClassicEditor
    //     .create( document.querySelector( 'textarea.editor' ) )
    //     .catch( error => {
    //         console.error( error );
    //     } );}
</script>
</body>
 
</html>
