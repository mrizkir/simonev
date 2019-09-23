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
        <a class="nav-link" id="third-tab" data-toggle="tab" href="#third" role="tab" aria-controls="third" aria-selected="false">
            Questions(5)
        </a>
    </li>
</ul>
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
                        {!! Form::open(['action'=>['RKA\RKAKegiatanMurniController@update',$rka->RKAID],'method'=>'put','class'=>'form-horizontal','id'=>'frminformastambahan','name'=>'frminformastambahan'])!!}                              
                            <fieldset>
                                <legend>LOKASI KEGIATAN</legend>
                                <div class="form-group row">
                                    {{Form::label('lokasi_kegiatan','Lokasi:',['class'=>'col-sm-2 col-form-label'])}}
                                    <div class="col-sm-10">
                                        {{Form::text('lokasi_kegiatan','',['class'=>'form-control','placeholder'=>'Lokasi Kegiatan'])}}
                                    </div>
                                </div>
                            </fieldset>  
                            <fieldset>
                                <legend>DANA</legend>
                                <div class="form-group row">
                                    {{Form::label('SumberDanaID','Sumber Dana:',['class'=>'col-sm-2 col-form-label'])}}
                                    <div class="col-sm-10">
                                        {{Form::select('SumberDanaID', $sumber_dana, '',['class'=>'form-control','id'=>'SumberDanaID'])}}
                                    </div>
                                </div>
                            </fieldset>  
                            <fieldset>
                                <legend>INDIKATOR DAN TOLAK UKUR KINERJA BELANJA LANGSUNG</legend>
                                <div class="form-group row">
                                    {{Form::label('capaian_program','Capaian Program:',['class'=>'col-sm-2 col-form-label'])}}
                                    <div class="col-sm-10">
                                        {{Form::text('capaian_program','',['class'=>'form-control','placeholder'=>'Capaian Program'])}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{Form::label('tk_capaian','Target Kinerja Capaian (%):',['class'=>'col-sm-2 col-form-label'])}}
                                    <div class="col-sm-10">
                                        {{Form::text('tk_capaian','',['class'=>'form-control','placeholder'=>'Target Kinerja Capaian (%)'])}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{Form::label('masukan','Masukan:',['class'=>'col-sm-2 col-form-label'])}}
                                    <div class="col-sm-10">
                                        {{Form::text('masukan','',['class'=>'form-control','placeholder'=>'Masukan'])}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{Form::label('keluaran','Keluaran:',['class'=>'col-sm-2 col-form-label'])}}
                                    <div class="col-sm-10">
                                        {{Form::text('keluaran','',['class'=>'form-control','placeholder'=>'Keluaran (Output)'])}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{Form::label('tk_keluaran','Target Kinerja Keluaran:',['class'=>'col-sm-2 col-form-label'])}}
                                    <div class="col-sm-10">
                                        {{Form::text('tk_keluaran','',['class'=>'form-control','placeholder'=>'Target Kinerja Keluaran (Output)'])}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{Form::label('hasil','Hasil:',['class'=>'col-sm-2 col-form-label'])}}
                                    <div class="col-sm-10">
                                        {{Form::text('hasil','',['class'=>'form-control','placeholder'=>'Outcome Kegiatan (Hasil)'])}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{Form::label('tk_hasil','Target Kinerja Hasil:',['class'=>'col-sm-2 col-form-label'])}}
                                    <div class="col-sm-10">
                                        {{Form::text('tk_hasil','',['class'=>'form-control','placeholder'=>'Target Kinerja Outcome Kegiatan (Hasil)'])}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{Form::label('ksk','Kelompok Sasaran Kegiatan:',['class'=>'col-sm-2 col-form-label'])}}
                                    <div class="col-sm-10">
                                        {{Form::text('ksk','',['class'=>'form-control','placeholder'=>'Kelompok Sasaran Kegiatan'])}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{Form::label('sifat_kegiatan','Sifat Kegiatan:',['class'=>'col-sm-2 col-form-label'])}}
                                    <div class="col-sm-10">
                                        {{Form::text('sifat_kegiatan','',['class'=>'form-control','placeholder'=>'Sifat Kegiatan'])}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{Form::label('waktu_pelaksanaan','Waktu Pelaksanaan:',['class'=>'col-sm-2 col-form-label'])}}
                                    <div class="col-sm-10">
                                        {{Form::text('waktu_pelaksanaan','',['class'=>'form-control','placeholder'=>'Waktu Pelaksanaan'])}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{Form::label('','',['class'=>'col-sm-2 col-form-label'])}}
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
    </div>
    <div class="tab-pane fade" id="third" role="tabpanel" aria-labelledby="third-tab">
        3
    </div>
</div>
@endsection
@section('page_asset_js')
<script src="{!!asset('js/vendor/jquery.validate/jquery.validate.min.js')!!}"></script>
<script src="{!!asset('js/vendor/jquery.validate/additional-methods.min.js')!!}"></script>
<script src="{!!asset('js/vendor/AutoNumeric.min.js')!!}"></script>
@endsection