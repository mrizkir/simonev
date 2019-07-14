@include('layouts.limitless.l_header')
<body>
<div class="navbar navbar-inverse bg-blue-300 navbar-lg">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{route('dashboard.index')}}">{{config('app.name')}}</a>
        <ul class="nav navbar-nav pull-right visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>
    <div class="navbar-collapse collapse" id="navbar-mobile">   
        <p class="navbar-text">
            <a href="#">
                <span class="label bg-success-400">
                    Saat ini Anda berada di Tahun Perencanaan {{HelperKegiatan::getTahunPerencanaan()}} dan Penyerapan Anggaran Tahun {{HelperKegiatan::getTahunPenyerapan()}}
                </span>
            </a>
        </p>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown dropdown-user visible">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img src="#" alt="Guest">
                    <span>GUEST</span>
                    <i class="caret"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">                                      
                    <li class="divider"></li>                    
                    <li>                       
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="icon-switch2"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->
<!-- Second navbar -->
<!-- Second navbar -->
<div class="navbar navbar-inverse bg-blue-800 navbar-xs" id="navbar-second">
    <ul class="nav navbar-nav no-border visible-xs-block">
        <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>
    </ul>
    <div class="navbar-collapse collapse" id="navbar-second-toggle">
        <ul class="nav navbar-nav">            
            <li class="active">
                <a href="/index.php?page=Home">
                    <i class="icon-display4 position-left"></i> 
                    <span>DASHBOARD</span>											
                </a>                                        
            </li>  
            <li>
                <a href="/index.php?page=LaporanRealisasiMurni">
                    <i class="icon-book3 position-left"></i> 
                    <span>LAPORAN REALISASI OPD MURNI</span>											
                </a>                                        
            </li>  
            
        </ul>
    </div>
</div>
<!-- /second navbar -->
<!-- Page header -->
<div class="page-header page-header-default border-bottom border-bottom-primary" style="border-top: 1px solid #ddd; border-left: 1px solid #ddd; border-right: 1px solid #ddd;">
    <div class="page-header-content">
        <div class="page-title">
            <h4>
                @yield('page_header')
                @yield('page_info')
            </h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb breadcrumb-caret position-right">
            <li><a href="{!!route('dashboard.index')!!}">HOME</a></li>            
            @yield('page_breadcrumb') 
        </ul>
        @yield('page_breadcrumbelement') 
        @yield('page_headerelement')   
    </div>
</div>
<!-- /page header -->
<div class="page-container">    
    <div class="page-content">
        @yield('page_sidebar')
        <div class="content-wrapper">
            @include('layouts.limitless.l_formmessages') 
            @yield('page_content')
        </div>        
    </div>    
</div>
<!-- Footer -->
<div class="footer text-muted">
    {{config('app.name')}} Powered by <a href="http://bintankab.go.id">TIM IT KAB. BINTAN</a>
</div>           
@include('layouts.limitless.l_footer')