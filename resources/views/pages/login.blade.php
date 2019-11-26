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
    <title>{{ config('app.name', 'SIMONEV') }} - LOGIN</title>
</head>
<body class="hold-transition login-page">
<div class="login-box" id="app">
    <div class="login-logo">
        <a  href="{{route('frontend.index')}}"><b>{{ config('app.name', 'SIMONEV') }}</b></a>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Masukan username dan password:</p>
            {!! Form::open(['url'=>route('login'),'method'=>'post','id'=>'frmlogin','name'=>'frmlogin','class'=>'tooltip-label-bottom',])!!}
                <div class="form-group">
                    <label for="username">Username</label>
                    {{Form::text('username',old('username'),['class'=>'form-control','placeholder'=>'Masukan Username'])}}
                </div>
                <div class="form-group">
                    <label for="username">Password</label>
                    {{Form::password('password',['class'=>'form-control','placeholder'=>'Masukan Password'])}}
                </div>
                <div class="form-group">
                    <label for="username">TAHUN ANGGARAN</label>
                    {{Form::select('TACd', \App\Models\DMaster\TAModel::pluck('TACd','TACd'), config('simonev.tahun_anggaran'), ['placeholder' => 'PILIH TAHUN ANGGARAN','class'=>'form-control'])}}
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <a href="#">&nbsp;</a>
                    <button class="btn btn-primary btn-lg btn-shadow" type="submit">LOGIN</button>
                </div>
                @if ($errors->has('username'))
                <br>
                <div class="alert alert-danger">
                    <strong>Login Gagal!</strong> Username atau password salah.
                </div>
                @endif
            {!! Form::close()!!}
        </div>
    </div>
</div>
<script src="{{ asset('js/app.js') }}" defer></script>
<script>
window.localStorage.removeItem('vuex');
</script>
</body>
</html>