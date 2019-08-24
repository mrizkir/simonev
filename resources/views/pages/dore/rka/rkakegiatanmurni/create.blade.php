@extends('layouts.dore.l_main')
@section('page_title')
    RKAKEGIATANMURNI
@endsection
@section('page_header')
    <i class="icon-database-refresh position-left"></i>
    <span class="text-semibold"> 
        RKAKEGIATANMURNI TAHUN PENYERAPAN {{config('simonev.tahun_penyerapan')}}
    </span>
@endsection
@section('page_info')
    @include('pages.dore.rka.rkakegiatanmurni.info')
@endsection
@section('page_breadcrumb')
    <li><a href="{!!route('rkakegiatanmurni.index')!!}">RKAKEGIATANMURNI</a></li>
    <li class="active">TAMBAH DATA</li>
@endsection
@section('page_content')
<div class="content">
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="mb-4">
                <i class="simple-icon-note"></i>
                TAMBAH DATA
            </h5>
            <div class="separator mb-5"></div>
            {!! Form::open(['action'=>'RKA\RKAKegiatanMurniController@store','method'=>'post','class'=>'form-horizontal','id'=>'frmdata','name'=>'frmdata'])!!}                              
                <div class="form-group row">
                    {{Form::label('program','Program',['class'=>'col-sm-2 col-form-label'])}}
                    <div class="col-sm-10">
                        {{Form::select('size', ['L' => 'Large', 'S' => 'Small'], null, ['class'=>'form-control','placeholder' => 'Pick a size...'])}}
                    </div>
                </div>
                <h6>DATA KEGIATAN</h6>
                <div class="separator mb-5"></div>
                <div class="form-group row">
                    {{Form::label('program','Program:',['class'=>'col-sm-2 col-form-label'])}}
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
<script src="{!!asset('themes/limitless/assets/js/jquery-validation/jquery.validate.min.js')!!}"></script>
<script src="{!!asset('themes/limitless/assets/js/jquery-validation/additional-methods.min.js')!!}"></script>
@endsection
@section('page_custom_js')
<script type="text/javascript">
$(document).ready(function () {
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