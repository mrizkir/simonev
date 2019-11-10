<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">	
	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">
  	<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    	<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
			</li>
			<li class="nav-item d-none d-sm-inline-block">
				<a href="{{route('login')}}" class="nav-link">LOGIN</a>
			</li>			
    	</ul>
    	<ul class="navbar-nav ml-auto">	
			<li class="nav-item">
				<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
					class="fas fa-th-large"></i>
				</a>
			</li>
		</ul>
  	</nav>

	<aside class="main-sidebar sidebar-dark-primary elevation-4">
		<router-link to="/" class="brand-link">  
			<span class="brand-text font-weight-light">{{ config('app.name', 'SIMONEV') }}</span>
		</router-link>
		<div class="sidebar">
			<div class="user-panel mt-3 pb-3 mb-3 d-flex">
				<div class="image">
					<img alt="Guest" src="{{asset('storage/images/users/no_photo.png')}}" />
				</div>
				<div class="info">
					<a href="#" class="d-block">Guest</a>
				</div>
			</div>
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">			
					<li class="nav-item">
						<router-link to="/" class="nav-link active">
							<i class="nav-icon fas fa-tachometer-alt"></i>
							<p>
								DASHBOARD
							</p>
						</router-link>						
					</li>
				</ul>
			</nav>
		</div>
  	</aside>
	<router-view></router-view>	
	<footer class="main-footer">
		<div class="float-right d-none d-sm-inline">
			{{ config('app.name', 'SIMONEV') }}
		</div>
		<strong>TIM IT BAPELITBANG Kab. Bintan</strong> All rights reserved.
	</footer>
</div>
<script>
  	window.laravel={'csrfToken':'{{csrf_token()}}'};
</script>
<script src="{{ asset('js/manifest.js')}}"></script>
<script src="{{ asset('js/vendor.js') }}" defer></script>
<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>