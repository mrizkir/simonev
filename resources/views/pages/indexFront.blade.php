<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>@yield('page_title')</title>	
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">	
	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">
	<!-- Navbar -->
  	<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    	<!-- Left navbar links -->
    	<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
			</li>
			<li class="nav-item d-none d-sm-inline-block">
				<a href="index3.html" class="nav-link">Home</a>
			</li>			
    	</ul>
    	<!-- Right navbar links -->
    	<ul class="navbar-nav ml-auto">	
			<li class="nav-item">
				<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
					class="fas fa-th-large"></i>
				</a>
			</li>
		</ul>
  	</nav>
  	<!-- /.navbar -->	

	<!-- Main Sidebar Container -->
	<aside class="main-sidebar sidebar-dark-primary elevation-4">
		<!-- Brand Logo -->
		<a href="index3.html" class="brand-link">  
			<span class="brand-text font-weight-light">{{ config('app.name', 'SIMONEV') }}</span>
		</a>
		<!-- Sidebar -->
		<div class="sidebar">
			<!-- Sidebar user panel (optional) -->
			<div class="user-panel mt-3 pb-3 mb-3 d-flex">
				<div class="image">
					<img alt="Guest" src="{{asset('storage/images/users/no_photo.png')}}" />
				</div>
				<div class="info">
					<a href="#" class="d-block">Guest</a>
				</div>
			</div>
			<!-- Sidebar Menu -->
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">			
					<li class="nav-item">
						<a href="#" class="nav-link active">
							<i class="nav-icon fas fa-tachometer-alt"></i>
							<p>
								DASHBOARD
							</p>
						</a>           
					</li>
				</ul>
			</nav>
			<!-- /.sidebar-menu -->
		</div>
    <!-- /.sidebar -->
  	</aside>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 text-dark">Starter Page</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">Starter Page</li>
						</ol>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<!-- Main content -->
		<div class="content">
			<div class="container-fluid">        
				<router-view></router-view>
			</div>
		</div>
		<!-- /.content -->
	</div>
 	<!-- /.content-wrapper -->
	<!-- Main Footer -->
	<footer class="main-footer">
		<div class="float-right d-none d-sm-inline">
			{{ config('app.name', 'SIMONEV') }}
		</div>
		<strong>TIM IT BAPELITBANG Kab. Bintan</strong> All rights reserved.
	</footer>
</div>
<!-- Scripts -->
<script>
  	window.laravel={'csrfToken':'{{csrf_token()}}'};
</script>
<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>