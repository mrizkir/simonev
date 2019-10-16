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
            RENCANA TARGET FISIK
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
                            TAMBAH RENCANA TARGET FISIK
                        </h2>
                        <div class="separator mb-3"></div>
                        {!! Form::open(['action'=>['RKA\RKAKegiatanMurniController@store3',$rka->RKAID],'method'=>'post','class'=>'form-horizontal','id'=>'frmrencanatargetfisik','name'=>'frmrencanatargetfisik'])!!}                                                          
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">RINCIAN KEGIATAN :</label> 
                                <div class="col-md-9">
                                    {{Form::select('RKARincID', $daftar_uraian,null,['class'=>'form-control select','id'=>'RKARincID'])}}
                                </div>
                            </div>                               
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">PAGU RINCIAN:</label>
                                <div class="col-md-9">
                                    <p class="form-control-static" id="pPaguRincian">0</p>  
                                </div>                            
                            </div>                            
                            <div class="form-group row">
                                {{Form::label('bulan1','JANUARI:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('bulan[]', 0, ['class'=>'form-control','id'=>'bulan1'])}}
                                </div>
                            </div>	
                            <div class="form-group row">
                                {{Form::label('bulan2','FEBRUARI:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('bulan[]', 0, ['class'=>'form-control','id'=>'bulan2'])}}
                                </div>
                            </div>	
                            <div class="form-group row">
                                {{Form::label('bulan3','MARET:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('bulan[]', 0, ['class'=>'form-control','id'=>'bulan3'])}}
                                </div>
                            </div>	
                            <div class="form-group row">
                                {{Form::label('bulan4','APRIL:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('bulan[]', 0, ['class'=>'form-control','id'=>'bulan4'])}}
                                </div>
                            </div>	
                            <div class="form-group row">
                                {{Form::label('bulan5','MEI:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('bulan[]', 0, ['class'=>'form-control','id'=>'bulan5'])}}
                                </div>
                            </div>	
                            <div class="form-group row">
                                {{Form::label('bulan6','JUNI:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('bulan[]', 0, ['class'=>'form-control','id'=>'bulan6'])}}
                                </div>
                            </div>	
                            <div class="form-group row">
                                {{Form::label('bulan7','JULI:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('bulan[]', 0, ['class'=>'form-control','id'=>'bulan7'])}}
                                </div>
                            </div>	
                            <div class="form-group row">
                                {{Form::label('bulan8','AGUSTUS:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('bulan[]', 0, ['class'=>'form-control','id'=>'bulan8'])}}
                                </div>
                            </div>	
                            <div class="form-group row">
                                {{Form::label('bulan9','SEPTEMBER:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('bulan[]', 0, ['class'=>'form-control','id'=>'bulan9'])}}
                                </div>
                            </div>	
                            <div class="form-group row">
                                {{Form::label('bulan10','OKTOBER:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('bulan[]', 0, ['class'=>'form-control','id'=>'bulan10'])}}
                                </div>
                            </div>	
                            <div class="form-group row">
                                {{Form::label('bulan11','NOVEMBER:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('bulan[]', 0, ['class'=>'form-control','id'=>'bulan11'])}}
                                </div>
                            </div>	                            
                            <div class="form-group row">
                                {{Form::label('bulan12','DESEMBER:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('bulan[]', 0, ['class'=>'form-control','id'=>'bulan12'])}}
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
    AutoNumeric.multiple(['#bulan1','#bulan2','#bulan3','#bulan4','#bulan5','#bulan6','#bulan7','#bulan8','#bulan9','#bulan10','#bulan11','#bulan12'],{
                                        allowDecimalPadding: false,
                                        decimalCharacter: ",",
                                        digitGroupSeparator: ".",
                                        unformatOnSubmit: true,
                                        showWarnings:false,
                                        modifyValueOnWheel:false
                                    });

    $('#frmrencanatargetfisik').validate({
        rules: {
            RKARincID : {
                required : true
            },                   
            'bulan[]' : {
                required: true,
            }
        },
        messages : {
            RKARincID : {
                required: "Mohon untuk di pilih rincian kegiatan Nama Uraian.",                
            },
            'bulan[]' : {
                required: "Mohon untuk di isi rencana target fisik seluruh bulan.",                
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
                new AutoNumeric ('#pPaguRincian'); 
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