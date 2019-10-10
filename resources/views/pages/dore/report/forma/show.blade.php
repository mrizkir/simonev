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
@section('page_breadcrumb')
<li class="breadcrumb-item">RKA</li>
<li class="breadcrumb-item">KEGIATAN MURNI</li>
<li class="breadcrumb-item active" aria-current="page">DETAIL</li>
@endsection
@section('page_header_button')
@include('pages.dore.report.forma.toprightbutton')
@endsection
@section('page_header_display')   
<ul class="nav nav-tabs separator-tabs ml-0 mb-5" role="tablist">
    <li class="nav-item">
        <a class="nav-link{!!($filters['changetab']=='ringkasan-tab')?' active':''!!}" id="ringkasan-tab" data-toggle="tab" href="#ringkasan" role="tab" aria-controls="ringkasan" aria-selected="true">
            RINGKASAN
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link{!!($filters['changetab']=='data-kegiatan-tab')?' active':''!!}" id="data-kegiatan-tab" data-toggle="tab" href="#data-kegiatan" role="tab" aria-controls="data-kegiatan" aria-selected="false">
            DATA KEGIATAN
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link{!!($filters['changetab']=='data-uraian-tab')?' active':''!!}" id="data-uraian-tab" data-toggle="tab" href="#data-uraian" role="tab" aria-controls="data-uraian" aria-selected="false">
            URAIAN
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link{!!($filters['changetab']=='data-realisasi-tab')?' active':''!!}" id="data-realisasi-tab" data-toggle="tab" href="#data-realisasi" role="tab" aria-controls="data-uraian" aria-selected="false">
            REALISASI
        </a>
    </li>
</ul>
@endsection
@section('page_asset_css')
<link rel="stylesheet" href="{!!asset('css/vendor/select2.min.css')!!}" />
<link rel="stylesheet" href="{!!asset('css/vendor/select2-bootstrap.min.css')!!}" />
<link rel="stylesheet" href="{!!asset('js/vendor/sweetalert2/sweetalert2.min.css')!!}" />
@endsection
@section('page_content')
<div class="tab-content">
    <div class="tab-pane fade{!!($filters['changetab']=='ringkasan-tab')?' show active':''!!}" id="ringkasan" role="tabpanel" aria-labelledby="ringkasan-tab">
        <div class="row">
            <div class="col-12">                
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-2">
                            <i class="simple-icon-screen-tablet"></i>
                            DATA KEGIATAN
                        </h2>
                        <div class="separator mb-3"></div>
                        <div class="row">                     
                            <div class="col-md-6">
                                <form>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>RKAID: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">{{$rka->RKAID}}</p>
                                        </div>                            
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>OPD / SKPD: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">[{{$rka->kode_organisasi}}] {{$rka->OrgNm}}</p>
                                        </div>                            
                                    </div>                             
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>UNIT KERJA: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">[{{$rka->kode_suborganisasi}}] {{$rka->SOrgNm}}</p>
                                        </div>                            
                                    </div>                             
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>URUSAN: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">[{{$rka->kode_urusan}}] {{$rka->Nm_Bidang}}</p>
                                        </div>                            
                                    </div>                             
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>PROGRAM: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">[{{$rka->kode_program}}] {{$rka->PrgNm}}</p>
                                        </div>                            
                                    </div>                             
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>KEGIATAN: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">
                                                [{{$rka->kode_kegiatan}}] {{$rka->KgtNm}} 
                                                <span class="badge badge-pill badge-primary mb-1">[{{$rka->sifat_kegiatan}}]</span>
                                            </p>
                                        </div>                            
                                    </div>             
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>PAGU DANA: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">{{Helper::formatUang($rka->PaguDana1)}}</p>
                                        </div>                            
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <form>           
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>SUMBER DANA: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">{{$rka->Nm_SumberDana}}</p>
                                        </div>                            
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>CAPAIAN PROGRAM: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">{{$rka->tk_capaian}} {{$rka->capaian_program}}</p>
                                        </div>                            
                                    </div>                        
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>OUTPUT (KELUARAN): </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">{{$rka->tk_keluaran}} {{$rka->keluaran}}</p>
                                        </div>                            
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>OUTCOME (HASIL): </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">{{$rka->tk_hasil}} {{$rka->hasil}}</p>
                                        </div>                            
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>LOKASI: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">{{$rka->lokasi_kegiatan}} {{$rka->hasil}}</p>
                                        </div>                            
                                    </div>                                    
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>TGL. BUAT: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">{{Helper::tanggal('d/m/Y H:m',$rka->created_at)}}</p>
                                        </div>                            
                                    </div>    
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>TGL. UBAH: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">{{Helper::tanggal('d/m/Y H:m',$rka->updated_at)}}</p>
                                        </div>                            
                                    </div>    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade{!!($filters['changetab']=='data-kegiatan-tab')?' show active':''!!}" id="data-kegiatan" role="tabpanel" aria-labelledby="data-kegiatan-tab">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['action'=>['RKA\RKAKegiatanMurniController@update',$rka->RKAID],'method'=>'put','class'=>'form-horizontal','id'=>'frminformasitambahan','name'=>'frminformasitambahan'])!!}                              
                            <fieldset>
                                <legend>LOKASI KEGIATAN</legend>
                                <div class="form-group row">
                                    {{Form::label('lokasi_kegiatan','Lokasi:',['class'=>'col-sm-2 col-form-label'])}}
                                    <div class="col-sm-10">
                                        {{Form::text('lokasi_kegiatan',$rka['lokasi_kegiatan'],['class'=>'form-control','placeholder'=>'Lokasi Kegiatan'])}}
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>SUMBER DANA</legend>
                                <div class="form-group row">
                                    {{Form::label('SumberDanaID','Sumber Dana:',['class'=>'col-sm-2 col-form-label'])}}
                                    <div class="col-sm-10">
                                        {{Form::select('SumberDanaID', $sumber_dana, $rka['SumberDanaID'],['class'=>'form-control select','id'=>'SumberDanaID'])}}
                                    </div>
                                </div>
                            </fieldset>  
                            <fieldset>
                                <legend>INDIKATOR DAN TOLAK UKUR KINERJA BELANJA LANGSUNG</legend>
                                <div class="form-group row">
                                    {{Form::label('capaian_program','Capaian Program:',['class'=>'col-sm-2 col-form-label'])}}
                                    <div class="col-sm-10">
                                        {{Form::text('capaian_program',$rka['capaian_program'],['class'=>'form-control','placeholder'=>'Capaian Program'])}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{Form::label('tk_capaian','Target Kinerja Capaian (%):',['class'=>'col-sm-2 col-form-label'])}}
                                    <div class="col-sm-10">
                                        {{Form::text('tk_capaian',$rka['tk_capaian'],['class'=>'form-control','placeholder'=>'Target Kinerja Capaian (%)'])}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{Form::label('masukan','Masukan:',['class'=>'col-sm-2 col-form-label'])}}
                                    <div class="col-sm-10">
                                        {{Form::text('masukan',$rka['masukan'],['class'=>'form-control','placeholder'=>'Masukan'])}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{Form::label('keluaran','Keluaran:',['class'=>'col-sm-2 col-form-label'])}}
                                    <div class="col-sm-10">
                                        {{Form::text('keluaran',$rka['keluaran'],['class'=>'form-control','placeholder'=>'Keluaran (Output)'])}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{Form::label('tk_keluaran','Target Kinerja Keluaran:',['class'=>'col-sm-2 col-form-label'])}}
                                    <div class="col-sm-10">
                                        {{Form::text('tk_keluaran',$rka['tk_keluaran'],['class'=>'form-control','placeholder'=>'Target Kinerja Keluaran (Output)'])}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{Form::label('hasil','Hasil:',['class'=>'col-sm-2 col-form-label'])}}
                                    <div class="col-sm-10">
                                        {{Form::text('hasil',$rka['hasil'],['class'=>'form-control','placeholder'=>'Outcome Kegiatan (Hasil)'])}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{Form::label('tk_hasil','Target Kinerja Hasil:',['class'=>'col-sm-2 col-form-label'])}}
                                    <div class="col-sm-10">
                                        {{Form::text('tk_hasil',$rka['tk_hasil'],['class'=>'form-control','placeholder'=>'Target Kinerja Outcome Kegiatan (Hasil)'])}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{Form::label('ksk','Kelompok Sasaran Kegiatan:',['class'=>'col-sm-2 col-form-label'])}}
                                    <div class="col-sm-10">
                                        {{Form::text('ksk',$rka['ksk'],['class'=>'form-control','placeholder'=>'Kelompok Sasaran Kegiatan'])}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{Form::label('sifat_kegiatan','Sifat Kegiatan:',['class'=>'col-sm-2 col-form-label'])}}
                                    <div class="col-sm-10">
                                        {{Form::select('sifat_kegiatan', ['baru'=>'BARU','lanjutan'=>'LANJUTAN'],$rka['sifat_kegiatan'],['class'=>'form-control'])}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{Form::label('waktu_pelaksanaan','Waktu Pelaksanaan:',['class'=>'col-sm-2 col-form-label'])}}
                                    <div class="col-sm-10">
                                        {{Form::text('waktu_pelaksanaan',$rka['waktu_pelaksanaan'],['class'=>'form-control','placeholder'=>'Waktu Pelaksanaan'])}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{Form::label('Descr','Keterangan:',['class'=>'col-sm-2 col-form-label'])}}
                                    <div class="col-sm-10">
                                        {{Form::textarea('Descr',$rka['Descr'],['class'=>'form-control','placeholder'=>'Keterangan','rows'=>3])}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{Form::label('',$rka[''],['class'=>'col-sm-2 col-form-label'])}}
                                    <div class="col-sm-10">
                                        {{ Form::button('SIMPAN', ['type' => 'submit', 'class' => 'btn btn-primary btn-sm default'] ) }}
                                    </div>
                                </div>
                            </fieldset>                             
                        {!! Form::close()!!}  
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade{!!($filters['changetab']=='data-uraian-tab')?' show active':''!!}" id="data-uraian" role="tabpanel" aria-labelledby="data-uraian-tab">
        @include('pages.dore.report.forma.datatableuraian')
    </div>
    <div class="tab-pane fade{!!($filters['changetab']=='data-realisasi-tab')?' show active':''!!}" id="data-realisasi" role="tabpanel" aria-labelledby="data-realisasi-tab">
        <div class="row">
            <div class="col-12 mb-3" id="divfilter">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-4">
                            <i class="iconsminds-filter-2"></i>
                            FILTER
                        </h4>
                        {!! Form::open(['action'=>'RKA\RKAKegiatanMurniController@filter','method'=>'post','id'=>'frmfilter','name'=>'frmfilter'])!!}                                
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">RINCIAN KEGIATAN :</label> 
                                <div class="col-md-10">
                                    {{Form::select('RKARincID', $daftar_uraian,$filters['RKARincID'],['class'=>'form-control select','id'=>'RKARincID'])}}
                                </div>
                            </div>                           
                        {!! Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
        <div id="datatablerealisasi">
            @include('pages.dore.report.forma.datatablerealisasi')
        </div>
    </div>
</div>    
@endsection
@section('page_asset_js')
<script src="{!!asset('js/vendor/jquery.validate/jquery.validate.min.js')!!}"></script>
<script src="{!!asset('js/vendor/jquery.validate/additional-methods.min.js')!!}"></script>
<script src="{!!asset('js/vendor/AutoNumeric.min.js')!!}"></script>
<script src="{!!asset('js/vendor/select2.full.js')!!}"></script>
<script src="{!!asset('js/vendor/sweetalert2/sweetalert2.min.js')!!}"></script>
@endsection
@section('page_custom_js')
<script src="{!!asset('rkakegiatan.js')!!}"></script>
<script type="text/javascript">
$(document).ready(function () {
    $("#SumberDanaID.select").select2({
        theme: "bootstrap",
        placeholder: "PILIH SUMBER DANA",
        allowClear:true        
    });
    $("#RKARincID.select").select2({
        theme: "bootstrap",
        placeholder: "PILIH RINCIAN KEGIATAN",
        allowClear:true        
    });
    $('#frminformasitambahan').validate({
        rules: {
            lokasi_kegiatan : {
                required: true,
            },
            SumberDanaID : {
                required: true,
            },
            capaian_program : {
                required: true,
            },
            tk_capaian : {
                required: true,
            },
            masukan : {
                required: true,
            },
            keluaran : {
                required: true,
            },
            tk_keluaran : {
                required: true,
            },
            hasil : {
                required: true,
            },
            tk_hasil : {
                required: true,
            },
            ksk : {
                required: true,
            },
            waktu_pelaksanaan : {
                required: true,
            }
        },
        messages : {
            lokasi_kegiatan : {
                required: "Mohon untuk di pilih lokasi kegiatan.",                
            },
            SumberDanaID : {
                required: "Mohon untuk di pilih sumber dana.",                
            },
            capaian_program : {
                required: "Mohon untuk di isi capaian program.",                
            },
            tk_capaian : {
                required: "Mohon untuk di isi tingkat capaian program.",                
            },
            masukan : {
                required: "Mohon untuk di isi tingkat masukan.",                
            },
            keluaran : {
                required: "Mohon untuk di isi keluaran (output) kegiatan.",                
            },
            tk_keluaran : {
                required: "Mohon untuk di isi tingkat keluaran (output) kegiatan.",                
            },
            hasil : {
                required: "Mohon untuk di isi hasil (outcome) kegiatan.",                
            },
            tk_hasil : {
                required: "Mohon untuk di isi tingkat hasil (outcome) kegiatan.",                
            },
            ksk : {
                required: "Mohon untuk di isi kelompok sasaran kegiatan.",                
            },
            waktu_pelaksanaan : {
                required: "Mohon untuk di isi waktu pelaksanaan.",                
            }
        }      
    });   
    $(document).on("change","#RKARincID", function(ev){
        ev.preventDefault();
        $.ajax({
            type:'post',
            url: url_current_page +'/changerekening',
            dataType: 'json',
            data: {                
                "_token": token,
                "RKARincID": $('#RKARincID').val(),
                "pid": 'realisasi',
            },
            success:function(result)
            { 
                console.log(result);
                $('#datatablerealisasi').html(result.datatable);
            },
            error:function(xhr, status, error){
                console.log('ERROR');
                console.log(parseMessageAjaxEror(xhr, status, error));                           
            },
        }); 
    });    
});
</script>
@endsection