<div class="menu">
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
                        <i class="iconsminds-air-balloon-1"></i> RKA
                    </a>
                </li>
                <li>
                    <a href="#setting">
                        <i class="iconsminds-air-balloon-1"></i> SETTINGS
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="sub-menu">
        <div class="scroll">
            <ul class="list-unstyled" data-link="dashboard">
                <li>
                    <a href="{{route('dashboard.index')}}">
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
            <ul class="list-unstyled" data-link="master" id="master">
                <li>
                    <a href="#" data-toggle="collapse" data-target="#collapseAuthorization" aria-expanded="true"
                        aria-controls="collapseAuthorization" class="rotate-arrow-icon opacity-50">
                        <i class="simple-icon-arrow-down"></i> <span class="d-inline-block">FUNGSIONAL</span>
                    </a>
                    <div id="collapseAuthorization" class="collapse show">
                        <ul class="list-unstyled inner-level-menu">
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
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#" data-toggle="collapse" data-target="#collapseRekening" aria-expanded="true"
                        aria-controls="collapseRekening" class="rotate-arrow-icon opacity-50">
                        <i class="simple-icon-arrow-down"></i> <span class="d-inline-block">REKENING</span>
                    </a>
                    <div id="collapseRekening" class="collapse show">
                        <ul class="list-unstyled inner-level-menu">
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
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#" data-toggle="collapse" data-target="#collapseProfile" aria-expanded="true"
                        aria-controls="collapseProfile" class="rotate-arrow-icon opacity-50">
                        <i class="simple-icon-arrow-down"></i> <span class="d-inline-block">PEGAWAI</span>
                    </a>
                    <div id="collapseProfile" class="collapse show">
                        <ul class="list-unstyled inner-level-menu">
                            <li>
                                <a href="{{route('rkakegiatanmurni.index')}}">
                                    <i class="simple-icon-people"></i>
                                    <span class="d-inline-block">ASN</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#" data-toggle="collapse" data-target="#collapseBlog" aria-expanded="true"
                        aria-controls="collapseBlog" class="rotate-arrow-icon opacity-50">
                        <i class="simple-icon-arrow-down"></i> <span class="d-inline-block">LAIN - LAIN</span>
                    </a>
                    <div id="collapseBlog" class="collapse show">
                        <ul class="list-unstyled inner-level-menu">
                            <li>
                                <a href="{{route('rkakegiatanmurni.index')}}">
                                    <i class="simple-icon-size-actual"></i>
                                    <span class="d-inline-block">JENIS PELAKSANAAN</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
            <ul class="list-unstyled" data-link="rka">
                <li>
                    <a href="{{route('roles.index')}}">
                        <i class="simple-icon-picture"></i>
                        <span class="d-inline-block">KEGIATAN MURNI</span>
                    </a>
                </li>
            </ul>
            <ul class="list-unstyled" data-link="setting">
                <li>
                    <a href="{{route('roles.index')}}">
                        <i class="simple-icon-picture"></i>
                        <span class="d-inline-block">ROLES</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('permissions.index')}}">
                        <i class="simple-icon-credit-card"></i>
                        <span class="d-inline-block">PERMISSIONS</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('users.index')}}">
                        <i class="simple-icon-credit-card"></i>
                        <span class="d-inline-block">USER</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('usersbapelitbang.index')}}">
                        <i class="simple-icon-credit-card"></i>
                        <span class="d-inline-block">USER BAPELITBANG</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('usersopd.index')}}">
                        <i class="simple-icon-credit-card"></i>
                        <span class="d-inline-block">USER OPD</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>