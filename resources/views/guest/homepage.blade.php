<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Vibepick Guest</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="{{asset("css/front.css")}}">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
</head>
<body>
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
	<div id="app">
        
    </div>
	<script src="{{asset("js/front.js")}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js" integrity="sha512-ubuT8Z88WxezgSqf3RLuNi5lmjstiJcyezx34yIU2gAHonIi27Na7atqzUZCOoY4CExaoFumzOsFQ2Ch+I/HCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        @if (Session::has('review_added'))
                <script>
                    toastr.options = {
                    "positionClass": "toast-bottom-right",
                    }
                    toastr.success("{!!Session::get('review_added')!!}");
                </script>
        @endif
        @if (Session::has('message_sent'))
                <script>
                    toastr.options = {
                    "positionClass": "toast-bottom-right",
                    }
                    toastr.success("{!!Session::get('message_sent')!!}");
                </script>
        @endif
</body>
</html>