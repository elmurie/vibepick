<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
            <!-- script backend -->
        <script src="{{ asset('js/back.js')}}" defer></script>
        


        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        {{-- Toastr stylesheet --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <header>
                <nav>
                    <div class="container d-flex space-between align-center">
                        <a class="logo" href="{{url('/')}}"><img src="storage/img/logo_pick.png" alt="VibePick Logo"></a>
                        <div class="layout-top-nav">
                            <ul class="d-flex space-between">
                                <!-- Authentication Links -->
                                @guest
                                    <li>
                                        <a href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                    @if (Route::has('register'))
                                        <li>
                                            <a href="{{ route('register') }}">{{ __('Register') }}</a>
                                        </li>
                                    @endif
                                @else
                                    <li class="d-flex space-between">
                                        
                                        <div>
                                            @if (@isset($user))
                                                <a href="{{ route('admin.users.show') }}">
                                                    {{ __('Profilo Personale') }}
                                                </a>
                                            @endif
                                                <a href="{{ route('admin.home') }}">
                                                    {{ __('Dashboard') }}
                                                </a>
                                            
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                        <div>
                                            <a href="#">
                                                {{ Auth::user()->firstname }}
                                            </a>
                                        </div>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
            <main class="py-4">
                @yield('content')
            </main>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js" integrity="sha512-ubuT8Z88WxezgSqf3RLuNi5lmjstiJcyezx34yIU2gAHonIi27Na7atqzUZCOoY4CExaoFumzOsFQ2Ch+I/HCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        @if (Session::has('record_updated'))
                <script>
                    toastr.options = {
                    "positionClass": "toast-bottom-right",
                    }
                    toastr.success("{!!Session::get('record_updated')!!}");
                </script>
        @endif
    </body>
    
    <footer>
        
    </footer>
</html>
