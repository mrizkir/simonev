@include('layouts.dore.l_header')

<body id="app-container" class="menu-default show-spinner">
    <nav class="navbar fixed-top">
        <div class="d-flex align-items-center navbar-left">
            <a href="#" class="menu-button d-none d-md-block">
                <svg class="main" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 17">
                    <rect x="0.48" y="0.5" width="7" height="1" />
                    <rect x="0.48" y="7.5" width="7" height="1" />
                    <rect x="0.48" y="15.5" width="7" height="1" />
                </svg>
                <svg class="sub" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17">
                    <rect x="1.56" y="0.5" width="16" height="1" />
                    <rect x="1.56" y="7.5" width="16" height="1" />
                    <rect x="1.56" y="15.5" width="16" height="1" />
                </svg>
            </a>

            <a href="#" class="menu-button-mobile d-xs-block d-sm-block d-md-none">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 17">
                    <rect x="0.5" y="0.5" width="25" height="1" />
                    <rect x="0.5" y="7.5" width="25" height="1" />
                    <rect x="0.5" y="15.5" width="25" height="1" />
                </svg>
            </a>
        </div>
        <a class="navbar-logo" href="{!!route('frontend.index')!!}">
            {{config('app.name')}}
        </a>
        <div class="navbar-right">
            <div class="header-icons d-inline-block align-middle">
                <div class="d-none d-md-inline-block align-text-bottom mr-3">
                    <div class="custom-switch custom-switch-primary-inverse custom-switch-small pl-1"
                        data-toggle="tooltip" data-placement="left" title="Dark Mode">
                        <input class="custom-switch-input" id="switchDark" type="checkbox" checked>
                        <label class="custom-switch-btn" for="switchDark"></label>
                    </div>
                </div>
                <button class="header-icon btn btn-empty d-none d-sm-inline-block" type="button" id="fullScreenButton">
                    <i class="simple-icon-size-fullscreen"></i>
                    <i class="simple-icon-size-actual"></i>
                </button>
            </div>
            <div class="user d-inline-block">
                <button class="btn btn-empty p-0" type="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <span class="name">{{Auth::user()->username}}</span>
                    <span>
                        <img alt="Profile Picture" src="img/profile-pic-l.jpg" alt="{{Auth::user()->username}}" />
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu-right mt-3">
                    <a class="dropdown-item" href="{!!route('login')!!}">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="sidebar">
        <div class="main-menu">
            <div class="scroll">
                <ul class="list-unstyled">
                    <li>
                        <a href="#dashboard">
                            <i class="iconsminds-shop-4"></i>
                            <span>DASHBOARD</span>
                        </a>
                    </li>
                    <li>
                        <a href="#master">
                            <i class="iconsminds-digital-drawing"></i> MASTER
                        </a>
                    </li>
                    <li>
                        <a href="#rka">
                            <i class="iconsminds-digital-drawing"></i> RKA
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="sub-menu">
            <div class="scroll">
                <ul class="list-unstyled" data-link="dashboard">
                    <li>
                        <a href="#">
                            <i class="simple-icon-pie-chart"></i>
                            <span class="d-inline-block">RINGKASAN DATA</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="simple-icon-pie-chart"></i>
                            <span class="d-inline-block">REALISASI OPD MURNI</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="simple-icon-pie-chart"></i>
                            <span class="d-inline-block">REALISAS OPD P</span>
                        </a>
                    </li>
                </ul>
                <ul class="list-unstyled" data-link="master">
                    <li>
                        <a href="#">
                            <p class="list-item-heading mb-1 color-theme-1">FUNGSIONAL</p>
                        </a>
                    </li>
                    <div class="separator mb-5"></div>
                    <li>
                        <a href="{{route('kelompokurusan.index')}}">
                            <i class="simple-icon-size-actual"></i>
                            <span class="d-inline-block">KELOMPOK URUSAN</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('urusan.index')}}">
                            <i class="simple-icon-puzzle"></i>
                            <span class="d-inline-block">URUSAN</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('organisasi.index')}}">
                            <i class="simple-icon-layers"></i>
                            <span class="d-inline-block">ORGANISASI</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('suborganisasi.index')}}">
                            <i class="simple-icon-credit-card"></i>
                            <span class="d-inline-block">UNIT KERJA</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('program.index')}}">
                            <i class="simple-icon-disc"></i>
                            <span class="d-inline-block">PROGRAM</span>
                        </a>
                    </li>
                    {{-- <li>
                        <a href="{{route('rkakegiatanmurni.index')}}">
                    <i class="iconsminds-coins"></i>
                    <span class="d-inline-block">PAGU DANA</span>
                    </a>
                    </li> --}}
                    <li>
                        <a href="#">
                            <p class="list-item-heading mb-1 color-theme-1">REKENING</p>
                        </a>
                    </li>
                    <div class="separator mb-5"></div>
                    <li>
                        <a href="{{route('rkakegiatanmurni.index')}}">
                            <i class="simple-icon-list"></i>
                            <span class="d-inline-block">TRANSAKSI</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('rkakegiatanmurni.index')}}">
                            <i class="simple-icon-puzzle"></i>
                            <span class="d-inline-block">KELOMPOK</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('rkakegiatanmurni.index')}}">
                            <i class="simple-icon-layers"></i>
                            <span class="d-inline-block">JENIS</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('rkakegiatanmurni.index')}}">
                            <i class="simple-icon-list"></i>
                            <span class="d-inline-block">RINCIAN</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('rkakegiatanmurni.index')}}">
                            <i class="simple-icon-credit-card"></i>
                            <span class="d-inline-block">OBJEK</span>
                        </a>
                    </li>
                    <li>
                        <p class="list-item-heading mb-1 color-theme-1">PEGAWAI</p>
                    </li>
                    <div class="separator mb-5"></div>
                    <li>
                        <a href="{{route('rkakegiatanmurni.index')}}">
                            <i class="simple-icon-people"></i>
                            <span class="d-inline-block">ASN</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <p class="list-item-heading mb-1 color-theme-1">LAIN - LAIN</p>
                        </a>
                    </li>
                    <div class="separator mb-5"></div>
                    <li>
                        <a href="{{route('rkakegiatanmurni.index')}}">
                            <i class="simple-icon-size-actual"></i>
                            <span class="d-inline-block">JENIS PELAKSANAAN</span>
                        </a>
                    </li>
                </ul>
                <ul class="list-unstyled" data-link="rka">
                    <li>
                        <a href="{{route('rkakegiatanmurni.index')}}">
                            <i class="simple-icon-credit-card"></i>
                            <span class="d-inline-block">KEGIATAN MURNI</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>@yield('page_header')</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="{!!route('frontend.index')!!}">HOME</a>
                            </li>
                            @yield('page_breadcrumb')
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
        </div>
    </main>
    @include('layouts.dore.l_footer')