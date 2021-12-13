<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Vibepick Guest</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="{{asset("css/front.css")}}">
</head>
<body>
	<header>
		<nav>
			<div class="container d-flex space-between align-center">

				{{-- logo --}}                       
				<a  class="logo" href="{{url('/')}}">
					<img src="storage/img/logo_pick.png" alt="VibePick Logo">
				</a>
				

				{{-- link --}}
				@guest
					<div>
						<ul class="d-flex gap">
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
						<ul class="d-flex gap">
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
						<ul class="d-flex gap">
							<li>
								<a href="#">
									{{ Auth::user()->firstname }}
								</a>
							</li>
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
		</nav>
	</header>
	<div id="app">
        
    </div>
	<script src="{{asset("js/front.js")}}"></script>
</body>
</html>