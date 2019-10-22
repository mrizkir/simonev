@extends('layouts.dore.l_main')
@section('page_title')
    RINGKASAN DATA
@endsection
@section('page_header')
<h1>
    <i class="simple-icon-chart"></i>
    RINGKASAN DATA
</h1>
@endsection
@section('page_header_display')
<div class="separator mb-5"></div>
@endsection
@section('page_breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">RINGKASAN DATA</li>
@endsection
@section('page_asset_css')
<link rel="stylesheet" href="{!!asset('css/vendor/owl.carousel.min.css')!!}" />
@endsection
@section('page_content')
<div class="row">
    <div class="col-md-12">
        <div class="icon-cards-row">
            <div class="owl-container">
                <div class="owl-carousel dashboard-numbers">
                    <a href="#" class="card">
                        <div class="card-body text-center">
                            <i class="iconsminds-clock"></i>
                            <p class="card-text mb-0">Jumlah Kegiatan</p>
                            <p class="lead text-center">16</p>
                        </div>
                    </a>
                    <a href="#" class="card">
                        <div class="card-body text-center">
                            <i class="iconsminds-basket-coins"></i>
                            <p class="card-text mb-0">Jumlah Pagu Dana</p>
                            <p class="lead text-center">32</p>
                        </div>
                    </a>

                    <a href="#" class="card">
                        <div class="card-body text-center">
                            <i class="iconsminds-arrow-refresh"></i>
                            <p class="card-text mb-0">Jumlah Realisasi</p>
                            <p class="lead text-center">2</p>
                        </div>
                    </a>

                    <a href="#" class="card">
                        <div class="card-body text-center">
                            <i class="iconsminds-mail-read"></i>
                            <p class="card-text mb-0">Sisa Anggaran</p>
                            <p class="lead text-center">25</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page_asset_js')
<script src="{!!asset('js/vendor/owl.carousel.min.js')!!}"></script>
@endsection