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
<li class="breadcrumb-item active" aria-current="page">TAMBAH RENCANA</li>
@endsection
@section('page_header_button')
@include('pages.dore.rka.rkakegiatanmurni.toprightbutton')
@endsection
@section('page_header_display')   
<ul class="nav nav-tabs separator-tabs ml-0 mb-5" role="tablist">  
    <li class="nav-item">
        <a class="nav-link active" id="data-uraian-tab" data-toggle="tab" href="#data-uraian" role="tab" aria-controls="data-uraian" aria-selected="true">
            RENCANA TARGET FISIK & ANGGARAN KAS
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
                            TAMBAH RENCANA TARGET FISIK DAN ANGGARAN KAS
                        </h2>
                        <div class="separator mb-3"></div>
                        {!! Form::open(['action'=>['RKA\RKAKegiatanMurniController@store4',$rka->RKAID],'method'=>'post','class'=>'form-horizontal','id'=>'frmrencanatargetfisik','name'=>'frmrencanatargetfisik'])!!}                                                                                      
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label"><strong>RINCIAN KEGIATAN: </strong></label>
                                <div class="col-md-10">
                                    <p class="form-control-static"></p>
                                </div>                            
                            </div>                               
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">PAGU RINCIAN:</label>
                                <div class="col-md-9">
                                    <p class="form-control-static" id="pPaguRincian">0</p>  
                                </div>                            
                            </div>                            
                            <div class="form-group row">
                                {{Form::label('bulan_fisik1','RENCANA FISIK BULAN JANUARI:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('bulan_fisik[]', 0, ['class'=>'form-control','id'=>'bulan_fisik1'])}}
                                </div>
                            </div>	
                            <div class="form-group row">
                                {{Form::label('bulan1','RENCANA ANGGARAN KAS BULAN JANUARI:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('bulan_anggaran[]', 0, ['class'=>'form-control','id'=>'bulan_anggaran1'])}}
                                </div>
                            </div>	
                            <div class="form-group row">
                                {{Form::label('bulan_fisik2','RENCANA FISIK BULAN FEBRUARI:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('bulan_fisik[]', 0, ['class'=>'form-control','id'=>'bulan_fisik2'])}}
                                </div>
                            </div>	
                            <div class="form-group row">
                                {{Form::label('bulan2','RENCANA ANGGARAN KAS FEBRUARI:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('bulan_anggaran[]', 0, ['class'=>'form-control','id'=>'bulan_anggaran2'])}}
                                </div>
                            </div>
                            <div class="form-group row">
                                {{Form::label('bulan_fisik3','RENCANA FISIK BULAN MARET:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('bulan_fisik[]', 0, ['class'=>'form-control','id'=>'bulan_fisik3'])}}
                                </div>
                            </div>	
                            <div class="form-group row">
                                {{Form::label('bulan3','RENCANA ANGGARAN KAS MARET:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('bulan_anggaran[]', 0, ['class'=>'form-control','id'=>'bulan_anggaran3'])}}
                                </div>
                            </div>
                            <div class="form-group row">
                                {{Form::label('bulan_fisik4','RENCANA FISIK BULAN APRIL:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('bulan_fisik[]', 0, ['class'=>'form-control','id'=>'bulan_fisik4'])}}
                                </div>
                            </div>	
                            <div class="form-group row">
                                {{Form::label('bulan4','RENCANA ANGGARAN KAS APRIL:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('bulan_anggaran[]', 0, ['class'=>'form-control','id'=>'bulan_anggaran4'])}}
                                </div>
                            </div>
                            <div class="form-group row">
                                {{Form::label('bulan_fisik5','RENCANA FISIK BULAN MEI:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('bulan_fisik[]', 0, ['class'=>'form-control','id'=>'bulan_fisik5'])}}
                                </div>
                            </div>	
                            <div class="form-group row">
                                {{Form::label('bulan5','RENCANA ANGGARAN KAS MEI:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('bulan_anggaran[]', 0, ['class'=>'form-control','id'=>'bulan_anggaran5'])}}
                                </div>
                            </div>
                            <div class="form-group row">
                                {{Form::label('bulan_fisik6','RENCANA FISIK BULAN JUNI:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('bulan_fisik[]', 0, ['class'=>'form-control','id'=>'bulan_fisik6'])}}
                                </div>
                            </div>
                            <div class="form-group row">
                                {{Form::label('bulan6','RENCANA ANGGARAN KAS JUNI:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('bulan_anggaran[]', 0, ['class'=>'form-control','id'=>'bulan_anggaran6'])}}
                                </div>
                            </div>                            
                            <div class="form-group row">
                                {{Form::label('bulan_fisik7','RENCANA FISIK BULAN JULI:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('bulan_fisik[]', 0, ['class'=>'form-control','id'=>'bulan_fisik7'])}}
                                </div>
                            </div>	
                            <div class="form-group row">
                                {{Form::label('bulan7','RENCANA ANGGARAN KAS JULI:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('bulan_anggaran[]', 0, ['class'=>'form-control','id'=>'bulan_anggaran7'])}}
                                </div>
                            </div>
                            <div class="form-group row">
                                {{Form::label('bulan_fisik8','RENCANA FISIK BULAN AGUSTUS:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('bulan_fisik[]', 0, ['class'=>'form-control','id'=>'bulan_fisik8'])}}
                                </div>
                            </div>	
                            <div class="form-group row">
                                {{Form::label('bulan8','RENCANA ANGGARAN KAS AGUSTUS:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('bulan_anggaran[]', 0, ['class'=>'form-control','id'=>'bulan_anggaran8'])}}
                                </div>
                            </div>
                            <div class="form-group row">
                                {{Form::label('bulan_fisik9','RENCANA FISIK BULAN SEPTEMBER:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('bulan_fisik[]', 0, ['class'=>'form-control','id'=>'bulan_fisik9'])}}
                                </div>
                            </div>	
                            <div class="form-group row">
                                {{Form::label('bulan9','RENCANA ANGGARAN KAS SEPTEMBER:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('bulan_anggaran[]', 0, ['class'=>'form-control','id'=>'bulan_anggaran9'])}}
                                </div>
                            </div>	
                            <div class="form-group row">
                                {{Form::label('bulan_fisik10','RENCANA FISIK BULAN OKTOBER:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('bulan_fisik[]', 0, ['class'=>'form-control','id'=>'bulan_fisik10'])}}
                                </div>
                            </div>	
                            <div class="form-group row">
                                {{Form::label('bulan10','RENCANA ANGGARAN KAS OKTOBER:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('bulan_anggaran[]', 0, ['class'=>'form-control','id'=>'bulan_anggaran10'])}}
                                </div>
                            </div>	
                            <div class="form-group row">
                                {{Form::label('bulan_fisik11','RENCANA FISIK BULAN NOVEMBER:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('bulan_fisik[]', 0, ['class'=>'form-control','id'=>'bulan_fisik11'])}}
                                </div>
                            </div>	     
                            <div class="form-group row">
                                {{Form::label('bulan11','RENCANA ANGGARAN KAS NOVEMBER:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('bulan_anggaran[]', 0, ['class'=>'form-control','id'=>'bulan_anggaran11'])}}
                                </div>
                            </div>                       
                            <div class="form-group row">
                                {{Form::label('bulan_fisik12','RENCANA FISIK BULAN DESEMBER:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('bulan_fisik[]', 0, ['class'=>'form-control','id'=>'bulan_fisik12'])}}
                                </div>
                            </div>	
                            <div class="form-group row">
                                {{Form::label('bulan12','RENCANA ANGGARAN KAS DESEMBER:',['class'=>'col-md-3 col-form-label'])}}
                                <div class="col-md-9">
                                    {{Form::text('bulan_anggaran[]', 0, ['class'=>'form-control','id'=>'bulan_anggaran12'])}}
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
    AutoNumeric.multiple(['#bulan_fisik1','#bulan_fisik2','#bulan_fisik3','#bulan_fisik4','#bulan_fisik5','#bulan_fisik6','#bulan_fisik7','#bulan_fisik8','#bulan_fisik9','#bulan_fisik10','#bulan_fisik11','#bulan_fisik12'],{
                                        allowDecimalPadding: false,
                                        decimalCharacter: ",",
                                        digitGroupSeparator: ".",
                                        unformatOnSubmit: true,
                                        showWarnings:false,
                                        modifyValueOnWheel:false
                                    });

    AutoNumeric.multiple(['#bulan_anggaran1','#bulan_anggaran2','#bulan_anggaran3','#bulan_anggaran4','#bulan_anggaran5','#bulan_anggaran6','#bulan_anggaran7','#bulan_anggaran8','#bulan_anggaran9','#bulan_anggaran10','#bulan_anggaran11','#bulan_anggaran12'],{
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
            'bulan_fisik[]' : {
                required: true,
            },                   
            'bulan_anggaran[]' : {
                required: true,
            }
        },
        messages : {
            RKARincID : {
                required: "Mohon untuk di pilih rincian kegiatan Nama Uraian.",                
            },
            'bulan_fisik[]' : {
                required: "Mohon untuk di isi rencana target fisik seluruh bulan.",                
            },
            'bulan_anggaran[]' : {
                required: "Mohon untuk di isi rencana target anggaran kas seluruh bulan.",                
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