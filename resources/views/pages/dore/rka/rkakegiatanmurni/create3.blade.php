@extends('layouts.dore.l_main')
@section('page_title')
    APBD MURNI
@endsection
@section('page_header')
    <h1>
        <i class="simple-icon-bag"></i>
        APBD MURNI 
    </h1>    
@endsection
@section('page_breadcrumb')
<li class="breadcrumb-item">RKA</li>
<li class="breadcrumb-item">
    <a href="{{route('rkakegiatanmurni.show',['uuid'=>$rka->RKAID])}}" title="Detail Kegiatan">
        DETAIL KEGIATAN MURNI
    </a>    
</li>
<li class="breadcrumb-item active" aria-current="page">TAMBAH REALISASI</li>
@endsection
@section('page_header_button')
@include('pages.dore.rka.rkakegiatanmurni.toprightbutton')
@endsection
@section('page_header_display')   
<ul class="nav nav-tabs separator-tabs ml-0 mb-5" role="tablist">  
    <li class="nav-item">
        <a class="nav-link active" id="data-uraian-tab" data-toggle="tab" href="#data-uraian" role="tab" aria-controls="data-uraian" aria-selected="true">
            REALISASI
        </a>
    </li>
</ul>
@endsection
@section('page_asset_css')
<link rel="stylesheet" href="{!!asset('css/vendor/select2.min.css')!!}" />
<link rel="stylesheet" href="{!!asset('css/vendor/select2-bootstrap.min.css')!!}" />
@endsection
@section('page_content')
<div class="tab-content">
    <div class="tab-pane fade show active" id="data-uraian" role="tabpanel" aria-labelledby="data-uraian-tab">        
        <div class="row">            
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="mb-2">
                            <i class="simple-icon-screen-tablet"></i>
                            DATA KEGIATAN
                        </h2>
                        <div class="separator mb-3"></div>
                        <div class="row">                     
                            <div class="col-12">
                                <form>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label"><strong>RKAID: </strong></label>
                                        <div class="col-md-10">
                                            <p class="form-control-static">{{$rka->RKAID}}</p>
                                        </div>                            
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label"><strong>KEGIATAN: </strong></label>
                                        <div class="col-md-10">
                                            <p class="form-control-static">{{$rka->KgtNm}}</p>
                                        </div>                            
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label"><strong>PAGU DANA: </strong></label>
                                        <div class="col-md-10">
                                            <p class="form-control-static">{{Helper::formatUang($rka->PaguDana1)}}</p>
                                        </div>                            
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-2">
                            <i class="simple-icon-plus"></i>
                            TAMBAH REALIASI
                        </h2>
                        <div class="separator mb-3"></div>
                        {!! Form::open(['action'=>['RKA\RKAKegiatanMurniController@store3',$rka->RKAID],'method'=>'post','class'=>'form-horizontal','id'=>'frmuraian','name'=>'frmuraian'])!!}                                                          
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">RINCIAN KEGIATAN :</label> 
                                <div class="col-md-9">
                                    {{Form::select('RKARincID', $daftar_uraian,null,['class'=>'form-control select','id'=>'RKARincID'])}}
                                </div>
                            </div>   
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">BULAN REALISASI :</label> 
                                <div class="col-md-9">
                                    {{Form::select('bulan', [],'none',['class'=>'form-control select','id'=>'bulan'])}}
                                </div>
                            </div> 	
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">PAGU RINCIAN:</label>
                                <div class="col-md-9">
                                    <p class="form-control-static" id="pPaguRincian">0</p>  
                                </div>                            
                            </div>	
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">SISA PAGU RINCIAN:</label>
                                <div class="col-md-9">
                                    <p class="form-control-static" id="pSisaPaguRincian">0</p>  
                                </div>                            
                            </div>	
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">RENCANA ANGGGARAN KAS:</label>
                                <div class="col-md-9">
                                    <p class="form-control-static" id="pRencanaAnggaranKas">0</p>  
                                </div>                            
                            </div>	
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" id="pRencanaTargetFisik">RENCANA TARGET FISIK:</label>
                                <div class="col-md-9">
                                    <p class="form-control-static">0</p>
                                </div>                            
                            </div>	
                            <div class="form-group row">
                                {{Form::label('realisasi1','REALISASI / SP2D:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('realisasi1', '', ['class'=>'form-control'])}}
                                </div>
                            </div>	
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">SISA FISIK:</label>
                                <div class="col-md-9">
                                    <p class="form-control-static">0</p>
                                </div>                            
                            </div>                         
                            <div class="form-group row">
                                {{Form::label('fisik1','FISIK:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('fisik1', '', ['class'=>'form-control'])}}
                                </div>
                            </div>   		
                            <div class="form-group row">
                                {{Form::label('Descr','Keterangan:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::textarea('Descr','',['class'=>'form-control','placeholder'=>'Keterangan','rows'=>3])}}
                                </div>
                            </div>
                            <div class="form-group row">
                                {{Form::label('','',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{ Form::button('SIMPAN', ['type' => 'submit', 'class' => 'btn btn-primary btn-sm default'] ) }}
                                    <a href="{!!route('rkakegiatanmurni.show',['uuid'=>$rka->RKAID])!!}" class="btn btn-light default" role="button" aria-pressed="true">
                                        KEMBALI
                                    </a>
                                </div>
                            </div>
                        {!! Form::close()!!} 
                    </div>
                </div>
            </div>            
        </div>
    </div>
</div>    
@endsection
@section('page_asset_js')
<script src="{!!asset('js/vendor/jquery.validate/jquery.validate.min.js')!!}"></script>
<script src="{!!asset('js/vendor/jquery.validate/additional-methods.min.js')!!}"></script>
<script src="{!!asset('js/vendor/autoNumeric.min.js')!!}"></script>
@endsection
@section('page_custom_js')
<script src="{!!asset('rkakegiatan.js')!!}"></script>
<script type="text/javascript">
$(document).ready(function () {  
    AutoNumeric.multiple(['#realisasi1'],{
                                        allowDecimalPadding: false,
                                        decimalCharacter: ",",
                                        digitGroupSeparator: ".",
                                        unformatOnSubmit: true,
                                        showWarnings:false,
                                        modifyValueOnWheel:false
                                    });

    AutoNumeric.multiple(['#fisik1'], {
                                        allowDecimalPadding: false,
                                        minimumValue:0.00,
                                        maximumValue:100.00,
                                        numericPos:true,
                                        decimalPlaces : 2,
                                        digitGroupSeparator : '',
                                        showWarnings:false,
                                        unformatOnSubmit: true,
                                        modifyValueOnWheel:false
                                    });
    $('#frmuraian').validate({
        rules: {
            RKARincID : {
                required : true
            },            
            bulan : {
                valueNotEquals : 'none'
            },            
            realisasi1 : {
                required: true,
            },            
            fisik1 : {
                required: true,
            }
        },
        messages : {
            RKARincID : {
                required: "Mohon untuk di pilih rincian kegiatan Nama Uraian.",                
            },
            bulan : {
                valueNotEquals: "Mohon untuk di pilih bulan realisasi.",                
            },
            realisasi1 : {
                required: "Mohon untuk di isi realisasi Rincian Uraian bulan ini.",                
            },
            fisik1 : {
                required: "Mohon untuk di isi fisik.",                
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
                "pid": 'tambahrealisasi',
            },
            success:function(result)
            { 
                console.log(result);              
                $('#pPaguRincian').html(result.pagu_uraian1);         
                $('#pSisaPaguRincian').html(result.sisa_pagu_rincian);      

                var daftar_bulan = result.bulan;
                var listitems='';
                $.each(daftar_bulan,function(key,value){
                    listitems+='<option value="' + key + '">'+value+'</option>';                    
                });
                $('#bulan').html(listitems);

                new AutoNumeric ('#pPaguRincian'); 
                new AutoNumeric ('#pSisaPaguRincian');                                 
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