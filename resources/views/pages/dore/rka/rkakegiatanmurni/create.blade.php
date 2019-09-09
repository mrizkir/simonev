@extends('layouts.dore.l_main')
@section('page_title')
    RKA KEGIATAN MURNI
@endsection
@section('page_header')
    <h1>
        <i class="simple-icon-bag"></i>
        RKA KEGIATAN MURNI 
    </h1>    
@endsection
@section('page_header_button')
<div class="text-zero top-right-button-container">    
    <div class="btn-group">
        <button type="button"
            class="btn btn-sm btn-outline-primary dropdown-toggle dropdown-toggle-split top-right-button top-right-button-single default"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="simple-icon-menu"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{!!route('rkakegiatanmurni.index')!!}" title="Tutup Halaman ini">
                <i class="simple-icon-close"></i> CLOSE
            </a>
        </div>
    </div>
</div>
@endsection
@section('page_header_display')
<div class="mb-2">
    <a class="btn pt-0 pl-0 d-inline-block d-md-none" data-toggle="collapse" href="#displayOptions" role="button"
        aria-expanded="true" aria-controls="displayOptions">
        Display Options
        <i class="simple-icon-arrow-down align-middle"></i>
    </a>
    <div class="collapse dont-collapse-sm" id="displayOptions">
        <div class="d-block d-md-inline-block">
            &nbsp;
        </div>
        <div class="float-md-right">            
            
        </div>
    </div>
</div>
<div class="separator mb-5"></div>
@endsection
@section('page_breadcrumb')
<li class="breadcrumb-item">RKA</li>
<li class="breadcrumb-item" aria-current="page">
    <a href="{!!route('rkakegiatanmurni.index')!!}"> KEGIATAN MURNI</a>
</li>
<li class="breadcrumb-item active" aria-current="page">TAMBAH DATA</li>
@endsection
@section('page_asset_css')
<link rel="stylesheet" href="{!!asset('css/vendor/jquery.contextMenu.min.css')!!}" />
<link rel="stylesheet" href="{!!asset('css/vendor/select2.min.css')!!}" />
<link rel="stylesheet" href="{!!asset('css/vendor/select2-bootstrap.min.css')!!}" />
@endsection
@section('page_content')
<div class="content">
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="mb-4">
                <i class="simple-icon-note"></i>
                TAMBAH DATA
            </h4>
            <div class="separator mb-5"></div>
            {!! Form::open(['action'=>'RKA\RKAKegiatanMurniController@store','method'=>'post','class'=>'form-horizontal','id'=>'frmdata','name'=>'frmdata'])!!}                              
                <div class="form-group row">
                    {{Form::label('PrgID','Program',['class'=>'col-sm-2 col-form-label'])}}
                    <div class="col-sm-10">
                        {{Form::select('PrgID', $daftar_program, null, ['class'=>'form-control select'])}}
                    </div>
                </div>
                <div class="form-group row">
                    {{Form::label('KgtID','Kegiatan',['class'=>'col-sm-2 col-form-label'])}}
                    <div class="col-sm-10">
                        {{Form::select('KgtID', $daftar_kegiatan, null, ['class'=>'form-control select'])}}
                        <small class="form-text text-muted">Daftar kegiatan ini berasal dari PEMBAHASAN RKPD MURNI</small>
                    </div>
                </div>
                <h6>DATA KEGIATAN</h6>
                <div class="separator mb-5"></div>
                <div class="form-group row">
                    {{Form::label('kodekegiatan','Kode Kegiatan:',['class'=>'col-sm-2 col-form-label'])}}
                    <div class="col-sm-10">
                        {{Form::text('kodekegiatan','',['class'=>'form-control','placeholder'=>'Kode Kegiatan'])}}
                    </div>
                </div>
                <div class="form-group row">
                    {{Form::label('namakegiatan','Nama Kegiatan:',['class'=>'col-sm-2 col-form-label'])}}
                    <div class="col-sm-10">
                        {{Form::text('namakegiatan','',['class'=>'form-control','placeholder'=>'Nama Kegiatan'])}}
                    </div>
                </div>
                <div class="form-group row">
                    {{Form::label('targetkinerjamasukan','Target Kinerja Masukan:',['class'=>'col-sm-2 col-form-label'])}}
                    <div class="col-sm-10">
                        {{Form::text('targetkinerjamasukan','',['class'=>'form-control','placeholder'=>'Target Kinerja Masukan'])}}
                    </div>
                </div>
                <h6>PENGAMPU KEGIATAN</h6>
                <div class="separator mb-5"></div>
                <div class="form-group row">
                    {{Form::label('penggunaanggaran','Pengguna Anggaran:',['class'=>'col-sm-2 col-form-label'])}}
                    <div class="col-sm-10">
                        {{Form::select('targetkinerjamasukan', ['L' => 'Large', 'S' => 'Small'], null, ['class'=>'form-control','placeholder' => 'Pick a size...'])}}
                    </div>
                </div>
                <div class="form-group row">
                    {{Form::label('kuasapenggunaanggaran','Kuasa Pengguna Anggaran:',['class'=>'col-sm-2 col-form-label'])}}
                    <div class="col-sm-10">
                        {{Form::select('kuasapenggunaanggaran', ['L' => 'Large', 'S' => 'Small'], null, ['class'=>'form-control','placeholder' => 'Pick a size...'])}}
                    </div>
                </div>
                <div class="form-group row">
                    {{Form::label('ppk','PPK:',['class'=>'col-sm-2 col-form-label'])}}
                    <div class="col-sm-10">
                        {{Form::select('ppk', ['L' => 'Large', 'S' => 'Small'], null, ['class'=>'form-control','placeholder' => 'Pick a size...'])}}
                    </div>
                </div>
                <div class="form-group row">
                    {{Form::label('pptk','PPTK:',['class'=>'col-sm-2 col-form-label'])}}
                    <div class="col-sm-10">
                        {{Form::select('pptk', ['L' => 'Large', 'S' => 'Small'], null, ['class'=>'form-control','placeholder' => 'Pick a size...'])}}
                    </div>
                </div>
                <div class="form-group row">
                    {{Form::label('','',['class'=>'col-sm-2 col-form-label'])}}
                    <div class="col-sm-10">
                        {{ Form::button('SIMPAN', ['type' => 'submit', 'class' => 'btn btn-primary btn-sm default'] ) }}
                    </div>
                </div>
            {!! Form::close()!!}
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="mb-4">
                <i class="simple-icon-note"></i>
                INFORMASI TAMBAHAN KEGIATAN
            </h5>
            <div class="separator mb-5"></div>
            {!! Form::open(['action'=>'RKA\RKAKegiatanMurniController@store','method'=>'post','class'=>'form-horizontal','id'=>'frmdata','name'=>'frmdata'])!!}                              
                <div class="form-group row">
                    {{Form::label('program','Program',['class'=>'col-sm-2 col-form-label'])}}
                    <div class="col-sm-10">
                        {{Form::select('size', ['L' => 'Large', 'S' => 'Small'], null, ['class'=>'form-control','placeholder' => 'Pick a size...'])}}
                    </div>
                </div>
                <h6>LOKASI KEGIATAN</h6>
                <div class="separator mb-5"></div>
                <div class="form-group row">
                    {{Form::label('lokasi','Lokasi:',['class'=>'col-sm-2 col-form-label'])}}
                    <div class="col-sm-10">
                        {{Form::text('lokasi','',['class'=>'form-control','placeholder'=>'Kode Kegiatan'])}}
                    </div>
                </div>
                <h6>DANA</h6>
                <div class="separator mb-5"></div>
                <div class="form-group row">
                    {{Form::label('sumberdana','Sumber Dana:',['class'=>'col-sm-2 col-form-label'])}}
                    <div class="col-sm-10">
                        {{Form::select('sumberdana', ['L' => 'Large', 'S' => 'Small'], null, ['class'=>'form-control','placeholder' => 'Pick a size...'])}}
                    </div>
                </div>
                <h6>INDIKATOR DAN TOLAK UKUR KINERJA BELANJA LANGSUNG</h6>
                <div class="separator mb-5"></div>
                <div class="form-group row">
                    {{Form::label('capaianprogram','Capaian Program:',['class'=>'col-sm-2 col-form-label'])}}
                    <div class="col-sm-10">
                        {{Form::textarea('capaianprogram','',['class'=>'form-control','placeholder'=>'Capaian Program','rows'=>3])}}
                    </div>
                </div>
                <div class="form-group row">
                    {{Form::label('targetkinerja','Target Kinerja Capaian (%):',['class'=>'col-sm-2 col-form-label'])}}
                    <div class="col-sm-10">
                        {{Form::text('targetkinerja','',['class'=>'form-control','placeholder'=>'Target Kinerja'])}}
                    </div>
                </div>
                <div class="form-group row">
                    {{Form::label('masukan','Masukan:',['class'=>'col-sm-2 col-form-label'])}}
                    <div class="col-sm-10">
                        {{Form::textarea('masukan','',['class'=>'form-control','placeholder'=>'Masukan','rows'=>3])}}
                    </div>
                </div>
                <div class="form-group row">
                    {{Form::label('keluaran','Keluaran:',['class'=>'col-sm-2 col-form-label'])}}
                    <div class="col-sm-10">
                        {{Form::textarea('keluaran','',['class'=>'form-control','placeholder'=>'Keluaran','rows'=>3])}}
                    </div>
                </div>
                <div class="form-group row">
                    {{Form::label('targetkinerjakeluaran','Target Kinerja Keluaran:',['class'=>'col-sm-2 col-form-label'])}}
                    <div class="col-sm-10">
                        {{Form::textarea('targetkinerjakeluaran','',['class'=>'form-control','placeholder'=>'Keluaran','rows'=>3])}}
                    </div>
                </div>
                <div class="form-group row">
                    {{Form::label('hasil','Hasil:',['class'=>'col-sm-2 col-form-label'])}}
                    <div class="col-sm-10">
                        {{Form::textarea('hasil','',['class'=>'form-control','placeholder'=>'Hasil','rows'=>3])}}
                    </div>
                </div>
                <div class="form-group row">
                    {{Form::label('targetkinerjahasil','Target Kinerja Hasil:',['class'=>'col-sm-2 col-form-label'])}}
                    <div class="col-sm-10">
                        {{Form::textarea('targetkinerjahasil','',['class'=>'form-control','placeholder'=>'Target Kinerja Hasil','rows'=>3])}}
                    </div>
                </div>
                <div class="form-group row">
                    {{Form::label('sifatkegiatan','Sifat Kegiatan:',['class'=>'col-sm-2 col-form-label'])}}
                    <div class="col-sm-10">
                        {{Form::select('sifatkegiatan', ['L' => 'Large', 'S' => 'Small'], null, ['class'=>'form-control','placeholder' => 'Sifat Kegiatan'])}}
                    </div>
                </div>
                <div class="form-group row">
                        {{Form::label('waktupelaksanaan','Waktu Pelaksanaan:',['class'=>'col-sm-2 col-form-label'])}}
                        <div class="col-sm-10">
                            {{Form::text('targetkinerjahasil','',['class'=>'form-control','placeholder'=>'Waktu Pelaksanaan'])}}
                        </div>
                    </div>
                <div class="form-group row">
                    {{Form::label('','',['class'=>'col-sm-2 col-form-label'])}}
                    <div class="col-sm-10">
                        {{ Form::button('SIMPAN', ['type' => 'submit', 'class' => 'btn btn-primary btn-sm default'] ) }}
                    </div>
                </div>
            {!! Form::close()!!}
        </div>
    </div>
</div>   
@endsection
@section('page_asset_js')
<script src="{!!asset('js/vendor/jquery-validation/jquery.validate.min.js')!!}"></script>
<script src="{!!asset('js/vendor/jquery-validation/additional-methods.min.js')!!}"></script>
<script src="{!!asset('js/vendor/jquery.contextMenu.min.js')!!}"></script>
<script src="{!!asset('js/vendor/select2.full.js')!!}"></script>
@endsection
@section('page_custom_js')
<script type="text/javascript">
$(document).ready(function () {
    $("#PrgID.select").select({
        theme: "bootstrap",
        placeholder: "PILIH PROGRAM",
        allowClear:true        
    });
    $("#KgtID.select").select({
        theme: "bootstrap",
        placeholder: "PILIH KEGIATAN",
        allowClear:true        
    });
    $('#frmdata').validate({
        rules: {
            replaceit : {
                required: true,
                minlength: 2
            }
        },
        messages : {
            replaceit : {
                required: "Mohon untuk di isi karena ini diperlukan.",
                minlength: "Mohon di isi minimal 2 karakter atau lebih."
            }
        }      
    });   
});
</script>
@endsection