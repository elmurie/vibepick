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

                        {{-- logo --}}                       
                        <a  class="logo" href="{{url('/')}}">
                            <img src="{{asset('storage/img/logo_pick.png')}}" alt="VibePick Logo">
                        </a>
                        {{-- link --}}
                        <div id="myLinks">
                            @guest
                            <div>
                                <ul class="d-flex align-center">
                                    <li>
                                        <a href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                    @if (Route::has('register'))
                                        <li>
                                            <a href="{{ route('register') }}">{{ __('Register') }}</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>                           
                            @else
                            {{-- link --}}
                            <div>
                                <ul class="d-flex align-center">
                                @if (@isset($user))
                                    <li>
                                        <a href="{{ route('admin.users.show') }}">
                                            {{ __('Profilo') }}
                                        </a>
                                    </li>
                                @endif
                                    <li>
                                        <a href="{{ route('admin.home') }}">
                                            {{ __('Dashboard') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            
                            <div>
                                <ul class="d-flex align-center">
                                    {{-- <li>
                                        <a href="#">
                                            {{ Auth::user()->firstname }}
                                        </a>
                                    </li> --}}
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                    </li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </ul>
                            </div>
                            @endguest
                        </div>
                        <div class="menu-btn">
                            <div class="menu-btn_burger"></div>
                        </div>
                    </div>
                </nav>
            </header>
            <main>
                @yield('content')
            </main>
            <footer>
                <div>
                    | Copyright &copy; VibePick 2021
                </div>
            </footer>
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
            <footer>
                
            </footer>
    </body>
</html>
