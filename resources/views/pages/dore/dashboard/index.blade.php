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
@php
    $jumlah_kegiatan = \DB::table('s_targetkinerja_opd')
                        ->where('TA',HelperKegiatan::getTahunAnggaran())
                        ->where('bulan',$bulan_realisasi)
                        ->sum('jumlah_kegiatan1');

    $pagudana=\DB::table('s_targetkinerja_opd')
                ->where('TA',HelperKegiatan::getTahunAnggaran())
                ->where('bulan',$bulan_realisasi)
                ->sum('pagudinas1');

    $realisasi=\DB::table('s_targetkinerja_opd')
                ->where('TA',HelperKegiatan::getTahunAnggaran())
                ->where('bulan',$bulan_realisasi)
                ->sum('realisasi_keuangan1');
    
    $sisa_anggaran=$pagudana-$realisasi;
    
@endphp     
<div class="row">
    <div class="col-md-12">
        <div class="icon-cards-row">
            <div class="owl-container">
                <div class="owl-carousel dashboard-numbers">
                    <a href="#" class="card">
                        <div class="card-body text-center">
                            <i class="iconsminds-clock"></i>
                            <p class="card-text mb-0">Jumlah Kegiatan</p>
                            <p class="lead text-center">{{$jumlah_kegiatan}}</p>
                        </div>
                    </a>
                    <a href="#" class="card">
                        <div class="card-body text-center">
                            <i class="iconsminds-basket-coins"></i>
                            <p class="card-text mb-0">Jumlah Pagu Dana</p>
                            <p class="lead text-center">{{Helper::formatUang($pagudana)}}</p>
                        </div>
                    </a>

                    <a href="#" class="card">
                        <div class="card-body text-center">
                            <i class="iconsminds-arrow-refresh"></i>
                            <p class="card-text mb-0">Jumlah Realisasi</p>
                            <p class="lead text-center">{{Helper::formatUang($realisasi)}}</p>
                        </div>
                    </a>

                    <a href="#" class="card">
                        <div class="card-body text-center">
                            <i class="iconsminds-mail-read"></i>
                            <p class="card-text mb-0">Sisa Anggaran</p>
                            <p class="lead text-center">{{Helper::formatUang($sisa_anggaran)}}</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-6 col-xl-3">  
        <div class="card">    
            <div class="card-body">             
                <h6 class="card-title">Persentase Target Keuangan</h6>                    
                <div id="divPersentaseTargetKeuangan" style="width: 250px; height: 250px"></div>                   
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-6 col-xl-3">  
        <div class="card">    
            <div class="card-body">             
                <h6 class="card-title">Persentase Capaian Keuangan</h6>                    
                <div id="divPersentaseCapaianKeuangan" style="width: 250px; height: 250px"></div>                   
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-6 col-xl-3">  
        <div class="card">    
            <div class="card-body">             
                <h6 class="card-title">Persentase Target Fisik</h6>                    
                <div id="divPersentaseTargetFisik" style="width: 250px; height: 250px"></div>                   
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-6 col-xl-3">  
        <div class="card">    
            <div class="card-body">             
                <h6 class="card-title">Persentase Realisasi Fisik</h6>                    
                <div id="divPersentaseRealisasiFisik" style="width: 250px; height: 250px"></div>                   
            </div>
        </div>
    </div>
</div>
@endsection
@section('page_asset_js')
<script src="{!!asset('js/vendor/owl.carousel.min.js')!!}"></script>
<script src="{!!asset('js/vendor/echarts.min.js')!!}"></script>
@endsection
@section('page_custom_js')
<script type="text/javascript">  
var divPersentaseTargetKeuangan = echarts.init(document.getElementById('divPersentaseTargetKeuangan'));
var option = {
    tooltip : {
        formatter: "{a} <br/>{b} : {c}%"
    },
    series: [
        {
            name: '',
            type: 'gauge',
            center: ['50%', '60%'],
            radius: '100%', 
            detail: {formatter:'{value}'},
            data: [{value: 70.5, name: ''}]
        }
    ]
};
divPersentaseTargetKeuangan.setOption(option);

var divPersentaseCapaianKeuangan = echarts.init(document.getElementById('divPersentaseCapaianKeuangan'));
var option = {
    tooltip : {
        formatter: "{a} <br/>{b} : {c}%"
    },
    series: [
        {
            name: '',
            type: 'gauge',
            center: ['50%', '60%'],
            radius: '100%', 
            detail: {formatter:'{value}'},
            data: [{value: 40.5, name: ''}]
        }
    ]
};
divPersentaseCapaianKeuangan.setOption(option);

var divPersentaseTargetFisik = echarts.init(document.getElementById('divPersentaseTargetFisik'));
var option = {
    tooltip : {
        formatter: "{a} <br/>{b} : {c}%"
    },
    series: [
        {
            name: '',
            type: 'gauge',
            center: ['50%', '60%'],
            radius: '100%', 
            detail: {formatter:'{value}'},
            data: [{value: 14.5, name: ''}]
        }
    ]
};
divPersentaseTargetFisik.setOption(option);

var divPersentaseRealisasiFisik = echarts.init(document.getElementById('divPersentaseRealisasiFisik'));
var option = {
    tooltip : {
        formatter: "{a} <br/>{b} : {c}%"
    },
    series: [
        {
            name: '',
            type: 'gauge',
            center: ['50%', '60%'],
            radius: '100%', 
            detail: {formatter:'{value}'},
            data: [{value: 54.5, name: ''}]
        }
    ]
};
divPersentaseRealisasiFisik.setOption(option);
</script>
@endsection
