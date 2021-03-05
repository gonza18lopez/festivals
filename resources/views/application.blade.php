<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		@auth
		<meta name="api-token" content="{{ auth()->user()->api_token }}">
		@endauth

		<title>Laravel</title>

		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

		<link rel="stylesheet" href="{{ mix('css/app.css') }}">
	</head>

	<body class="antialiased">
		<nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
			<a class="navbar-brand" href="#">Festival Test</a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="{{ route('home') }}">Home</a>
					</li>

					@can('join festival')
					<li class="nav-item">
						<a class="nav-link" href="{{ route('tour') }}">Tour</a>
					</li>
					@endcan
				</ul>

				@if (Route::has('login'))
				<ul class="navbar-nav ml-auto">
					@auth
					<li class="nav-item">
						<a class="nav-link" href="{{ url('/logout') }}">Logout</a>
					</li>
					@else
					<li class="nav-item">
						<a class="nav-link" href="{{ route('login') }}">Log In</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="{{ route('register') }}">Register</a>
					</li>
					@endauth
				</ul>
				@endif
			</div>
		</nav>

		<main class="container">
			@yield('content')
		</main>

		<script src="{{ mix('js/app.js') }}"></script>
		@stack('scripts')
	</body>
</html>
