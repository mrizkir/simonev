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
		<router-link to="/" class="brand-link">  
			<span class="brand-text font-weight-light">{{ config('app.name', 'SIMONEV') }}</span>
		</router-link>
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
						<router-link to="/" class="nav-link" @click.native="changeMenuItem">
							<i class="nav-icon fas fa-tachometer-alt"></i>
							<p>
								DASHBOARD
							</p>
						</router-link>						
					</li>
					<li class="nav-item has-treeview" id="liDMaster">
						<a href="#" class="nav-link" id="linkDMaster">
						  	<i class="nav-icon fas fa-tree"></i>
						  	<p>
								MASTER
								<i class="fas fa-angle-left right"></i>
						  	</p>
						</a>
						<ul class="nav nav-treeview" id="ulDMaster">
							<li class="nav-header">DATA DASAR</li>
							<li class="nav-item">
							  	<router-link to="/dmaster/kelompokurusan" class="nav-link" @click.native="changeMenuItem">
									<i class="fas fa-circle nav-icon text-warning"></i>
									<p>KELOMPOK URUSAN</p>
							  	</router-link>
							  	<router-link to="/dmaster/urusan" class="nav-link" @click.native="changeMenuItem">
									<i class="fas fa-circle nav-icon text-warning"></i>
									<p>URUSAN</p>
								</router-link>
								<router-link to="/dmaster/organisasi" class="nav-link" @click.native="changeMenuItem">
									<i class="fas fa-circle nav-icon text-warning"></i>
									<p>ORGANISASI</p>
							  	</router-link>
								<router-link to="/dmaster/unitkerja" class="nav-link" @click.native="changeMenuItem">
									<i class="fas fa-circle nav-icon text-warning"></i>
									<p>UNIT KERJA</p>
							  	</router-link>
								<router-link to="/dmaster/program" class="nav-link" @click.native="changeMenuItem">
									<i class="fas fa-circle nav-icon text-warning"></i>
									<p>PROGRAM</p>
							  	</router-link>
								<router-link to="/dmaster/programkegiatan" class="nav-link" @click.native="changeMenuItem">
									<i class="fas fa-circle nav-icon text-warning"></i>
									<p>KEGIATAN</p>
								</router-link>
							</li>
							<li class="nav-header">REKENING</li>
							<li class="nav-item">
							  	<router-link to="/dmaster/transaksi" class="nav-link" @click.native="changeMenuItem">
									<i class="fas fa-circle nav-icon text-warning"></i>
									<p>TRANSAKSI</p>
							  	</router-link>
							</li>							
							<li class="nav-item">
							  	<router-link to="/dmaster/kelompok" class="nav-link" @click.native="changeMenuItem">
									<i class="fas fa-circle nav-icon text-warning"></i>
									<p>KELOMPOK</p>
							  	</router-link>
							</li>							
							<li class="nav-item">
							  	<router-link to="/dmaster/jenis" class="nav-link" @click.native="changeMenuItem">
									<i class="fas fa-circle nav-icon text-warning"></i>
									<p>JENIS</p>
							  	</router-link>
							</li>							
							<li class="nav-item">
							  	<router-link to="/dmaster/rincian" class="nav-link" @click.native="changeMenuItem">
									<i class="fas fa-circle nav-icon text-warning"></i>
									<p>RINCIAN</p>
							  	</router-link>
							</li>							
							<li class="nav-item">
							  	<router-link to="/dmaster/objek" class="nav-link" @click.native="changeMenuItem">
									<i class="fas fa-circle nav-icon text-warning"></i>
									<p>OBJEK</p>
							  	</router-link>
							</li>
							<li class="nav-header">PEGAWAI</li>
							<li class="nav-item">
							  	<router-link to="/dmaster/asn" class="nav-link" @click.native="changeMenuItem">
									<i class="fas fa-circle nav-icon text-warning"></i>
									<p>ASN</p>
							  	</router-link>
							</li>								
							<li class="nav-item">
							  	<router-link to="/dmaster/asnopd" class="nav-link" @click.native="changeMenuItem">
									<i class="fas fa-circle nav-icon text-warning"></i>
									<p>ASN OPD</p>
							  	</router-link>
							</li>								
							<li class="nav-header">LAIN-LAIN</li>
							<li class="nav-item">
							  	<router-link to="/dmaster/jenispelaksanaan" class="nav-link" @click.native="changeMenuItem">
									<i class="fas fa-circle nav-icon text-warning"></i>
									<p>JENIS PELAKSANAAN</p>
							  	</router-link>
							  	<router-link to="/dmaster/paguanggaranopd" class="nav-link" @click.native="changeMenuItem">
									<i class="fas fa-circle nav-icon text-warning"></i>
									<p>PAGU DANA OPD</p>
							  	</router-link>
							</li>							
						</ul>
					</li>
					<apbdmurnidetailmenu/>
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
<script src="{{ asset('js/manifest.js')}}"></script>
<script src="{{ asset('js/vendor.js') }}" defer></script>
<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>