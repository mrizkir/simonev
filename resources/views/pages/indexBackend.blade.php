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
				<a href="{{route('logout')}}" class="nav-link">LOGOUT</a>
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
		<a href="index3.html" class="brand-link">  
			<span class="brand-text font-weight-light">{{ config('app.name', 'SIMONEV') }}</span>
		</a>
		<div class="sidebar">
			<div class="user-panel mt-3 pb-3 mb-3 d-flex">
				<div class="image">
                    <img src="{{asset(Auth::user()->foto)}}" alt="{{Auth::user()->username}}" />
				</div>
				<div class="info">
					<a href="#" class="d-block">{{Auth::user()->username}}</a>
				</div>
			</div>
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">			
					<li class="nav-item">
						<router-link to="/" class="nav-link">
							<i class="nav-icon fas fa-tachometer-alt"></i>
							<p>
								DASHBOARD
							</p>
						</router-link>						
					</li>
					<li class="nav-item">
						<router-link to="/formvalidation" class="nav-link">
							<i class="nav-icon fas fa-tachometer-alt"></i>
							<p>
								TEST
							</p>
						</router-link>						
					</li>
					<li class="nav-item has-treeview">
						<a href="#" class="nav-link">
						  	<i class="nav-icon fas fa-tree"></i>
						  	<p>
								MASTER
								<i class="fas fa-angle-left right"></i>
						  	</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
							  	<router-link to="/dmaster/paguanggaranopd" class="nav-link">
									<i class="fas fa-circle nav-icon"></i>
									<p>PAGU DANA</p>
							  	</router-link>
							</li>							
						</ul>
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
  	window.laravel={'csrfToken':'{{csrf_token()}}',
	  				'api_token':'Bearer {{Auth::user()->api_token}}'};
	
</script>
<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>