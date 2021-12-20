<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
            <!-- script backend -->
        <script src="{{ asset('js/back.js')}}" defer></script>
        


        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">

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
                                            <a href="{{ route('register') }}">{{ __('Registrati') }}</a>
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
                        <div id="myLinksMobile">
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
                <div class="box-footer">
                    <div class="box-logo-footer">
                        <img src="{{asset('storage/img/logo_pick_white.png')}}" alt="">
                    </div>
                    <div>| Copyright &copy; VibePick 2021</div>
                </div>
            </footer>
        </div>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js" integrity="sha512-ubuT8Z88WxezgSqf3RLuNi5lmjstiJcyezx34yIU2gAHonIi27Na7atqzUZCOoY4CExaoFumzOsFQ2Ch+I/HCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script >
            var reviews = {num :"{{count($reviews)}}"};
            var messages = {num :"{{count($messages)}}"};
            var myChart = document.getElementById('myChart').getContext('2d');
            let maxDataValue = parseInt(reviews.num) + 2 ;
            var massPopChart = new Chart(myChart, {
                type: 'bar',
                data: {
                    labels:['N. Recensioni', 'N. Messaggi'],
                    datasets:[{
                        label: 'Statistiche',
                        data:[
                            reviews.num,
                            messages.num,
                        ],  
                        backgroundColor: ['#20d754cc', '#f9d608cc'],
                        borderColor:['#ffffff'],                       
                        borderWidth:2,
                        barPercentage: 0.4,
                    }],
                },
                options: {
                    plugins: {  // 'legend' now within object 'plugins 
                        legend: {
                            labels: {
                            color: 'white',  // not 'fontColor:' anymore
                            }
                        }
                    },
                    maintainAspectRatio: false,
                    scales:{
                        y:{
                            stacked:true,
                            grid:{
                                display: true,
                                color: "rgb(255,255,255)"
                            },
                            ticks: {
                            color: "white",
                            beginAtZero: true,
                            scale: 15
                            },
                            suggestedMax: maxDataValue
                        },
                        x: {
                            grid:{
                                display: true,
                                color: "rgb(255,255,255)"
                            },
                            ticks: {
                            color: "white",
                            beginAtZero: true
                            }
                        }
                    }
                },
            });


            //seconda statistica 
            var ctx = document.getElementById('userChart').getContext('2d');

            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!!json_encode($chart->date)!!},
                    datasets: [
                        {
                            label : 'Voti',
                            data: {!!json_encode($chart->voti)!!},
                            borderColor: "#20d754cc",
                            fill: true,
                            tension: 0.01,
                        },
                    ]
                },
                options: {

                },
            });

            //terza stats

            var terza = document.getElementById('newChart').getContext('2d');

            var nuovo = new Chart(terza, {
                type: 'line',
                data: {
                    labels: {!!json_encode($reviewsMonth->mesi)!!},
                    datasets: [
                        {
                            label : 'Numero Recensioni 2021',
                            data: {!!json_encode($reviewsMonth->tot)!!},
                            borderColor: "#20d754cc",
                            fill: true,
                            tension: 0.01,
                        },
                    ]
                },
                options: {

                },
            });

             //quarta stats
            var quarta = document.getElementById('newerChart').getContext('2d');

            var nuova = new Chart(quarta, {
                type: 'line',
                data: {
                    labels: {!!json_encode($messagesMonth->mesi)!!},
                    datasets: [
                        {
                            label : 'Numero Messaggi 2021',
                            data: {!!json_encode($messagesMonth->tot)!!},
                            borderColor: "#20d754cc",
                            fill: true,
                            tension: 0.01,
                        },
                    ]
                },
                options: {

                },
            });

        </script>
        @if (Session::has('record_updated'))
                <script>
                    toastr.options = {
                    "positionClass": "toast-bottom-right",
                    }
                    toastr.success("{!!Session::get('record_updated')!!}");
                </script>
        @endif
    </body>
</html>