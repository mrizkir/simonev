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
<link rel="stylesheet" href="{!!asset('css/vendor/select2.min.css')!!}" />
<link rel="stylesheet" href="{!!asset('css/vendor/select2-bootstrap.min.css')!!}" />
@endsection
@section('page_content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="mb-4">
                    <i class="simple-icon-plus"></i>
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
                        {{Form::label('RKPDID','RKPD',['class'=>'col-sm-2 col-form-label'])}}
                        <div class="col-sm-10">
                            {{Form::select('RKPDID', $daftar_rkpd, null, ['class'=>'form-control select'])}}
                            <small class="form-text text-muted">Daftar kegiatan ini berasal dari PEMBAHASAN RKPD MURNI. Abaikan bila kegiatan yang di inputkan tidak terdaftar di RKPD</small>
                        </div>
                    </div>
                    <h6>DATA KEGIATAN</h6>
                    <div class="separator mb-5"></div>
                    <div class="form-group row">
                        {{Form::label('KgtID','Kegiatan',['class'=>'col-sm-2 col-form-label'])}}
                        <div class="col-sm-10">
                            {{Form::select('KgtID', $daftar_rkpd, null, ['class'=>'form-control select'])}}
                            <small class="form-text text-muted">Daftar kegiatan ini berasal dari Master Kegiatan (tmKgt) Atau saat RKPD dipilih berasal dari tabel trRKPD. Bila kosong, barangkali sudah di inputkan.</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        {{Form::label('PaguDana1','Pagu Dana:',['class'=>'col-sm-2 col-form-label'])}}
                        <div class="col-sm-10">
                            {{Form::text('PaguDana1','',['class'=>'form-control','placeholder'=>'Pagu Dana'])}}
                            <small class="form-text text-muted">Nilai Pagu berasal dari Pembahasan RKPD Murni. Bisa diganti bila tidak sesuai dengan di E-Budgeting.</small>
                        </div>
                    </div>
                    <h6>PENGAMPU KEGIATAN</h6>
                    <div class="separator mb-5"></div>
                    <div class="form-group row">
                        {{Form::label('nip_pa','Pengguna Anggaran:',['class'=>'col-sm-2 col-form-label'])}}
                        <div class="col-sm-10">
                            {{Form::select('nip_pa', $daftar_pa, null, ['class'=>'form-control'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{Form::label('nip_kpa','Kuasa Pengguna Anggaran:',['class'=>'col-sm-2 col-form-label'])}}
                        <div class="col-sm-10">
                            {{Form::select('nip_kpa', $daftar_kpa, null, ['class'=>'form-control'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{Form::label('nip_ppk','PPK:',['class'=>'col-sm-2 col-form-label'])}}
                        <div class="col-sm-10">
                            {{Form::select('nip_ppk', $daftar_ppk, null, ['class'=>'form-control'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{Form::label('nip_pptk','PPTK:',['class'=>'col-sm-2 col-form-label'])}}
                        <div class="col-sm-10">
                            {{Form::select('nip_pptk', $daftar_pptk, null, ['class'=>'form-control'])}}
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
</div>   
@endsection
@section('page_asset_js')
<script src="{!!asset('js/vendor/jquery.validate/jquery.validate.min.js')!!}"></script>
<script src="{!!asset('js/vendor/jquery.validate/additional-methods.min.js')!!}"></script>
<script src="{!!asset('js/vendor/autoNumeric.min.js')!!}"></script>
<script src="{!!asset('js/vendor/select2.full.js')!!}"></script>
@endsection
@section('page_custom_js')
<script type="text/javascript">
$(document).ready(function () {
    AutoNumeric.multiple(['#PaguDana1'],{
                                        allowDecimalPadding: false,
                                        decimalCharacter: ",",
                                        digitGroupSeparator: ".",
                                        unformatOnSubmit: true,
                                        showWarnings:false,
                                        modifyValueOnWheel:false
                                    });
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
    $(document).on('change','#PrgID',function(ev) {
        ev.preventDefault();
        PrgID=$(this).val();        
        $.ajax({
            type:'post',
            url: url_current_page +'/filter',
            dataType: 'json',
            data: {
                "_token": token,
                "PrgID": PrgID,
                'create':0
            },
            success:function(result)
            {   
                var daftar_rkpd = result.daftar_rkpd;
                var listitems='<option></option>';
                $.each(daftar_rkpd,function(key,value){
                    listitems+='<option value="' + key + '">'+value+'</option>';                    
                });
                $('#RKPDID').html(listitems);

                var daftar_kegiatan = result.daftar_kegiatan;
                var listitems='<option></option>';
                $.each(daftar_kegiatan,function(key,value){
                    listitems+='<option value="' + key + '">'+value+'</option>';                    
                });
                $('#KgtID').html(listitems);
            },
            error:function(xhr, status, error)
            {   
                console.log(parseMessageAjaxEror(xhr, status, error));                           
            },
        });
    });
    $(document).on('change','#RKPDID',function(ev) {
        ev.preventDefault();
        RKPDID=$(this).val();        
        $.ajax({
            type:'post',
            url: url_current_page +'/filter',
            dataType: 'json',
            data: {
                "_token": token,
                "RKPDID": RKPDID,
                'create':0
            },
            success:function(result)
            { 
                var daftar_kegiatan = result.daftar_kegiatan;
                var listitems='<option></option>';
                $.each(daftar_kegiatan,function(key,value){
                    listitems+='<option value="' + key + '">'+value+'</option>';                    
                });
                $('#KgtID').html(listitems);
                AutoNumeric.getAutoNumericElement('#PaguDana1').set(result.NilaiUsulan2);
            },
            error:function(xhr, status, error)
            {   
                console.log(parseMessageAjaxEror(xhr, status, error));                           
            },
        });
    });
    $('#frmdata').validate({
        rules: {
            PrgID : {
                required: true,
            },
            KgtID : {
                required: true,
            },
            PaguDana1 : {
                required: true,
            }
        },
        messages : {
            PrgID : {
                required: "Mohon untuk di pilih nama program.",                
            },
            KgtID : {
                required: "Mohon untuk di pilih nama kegiatan.",                
            },
            PaguDana1 : {
                required: "Mohon untuk di isi pagu dana kegiatan.",                
            }
        }      
    });   
});
</script>
@endsection