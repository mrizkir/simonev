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