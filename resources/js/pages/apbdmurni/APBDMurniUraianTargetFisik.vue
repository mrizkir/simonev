<template>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark">
                        <i class="nav-icon fas fa-cart-arrow-down"></i>
                        APBD MURNI
                    </h1>
                </div>
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><router-link to="/">HOME</router-link></li>
                        <li class="breadcrumb-item"><router-link to="/apbdmurni">APBD MURNI</router-link></li>
                        <li class="breadcrumb-item"><router-link to="/apbdmurni/uraian">URAIAN</router-link></li>
                        <li class="breadcrumb-item active">RENCANA TARGET FISIK</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>  
    <!-- Main content -->
    <section class="content" v-if="detailkegiatan.hasOwnProperty('RKAID')">
        <div class="container-fluid">
            <div class="row" v-if="api_message">
                <div class="col-md-12">
                    <!-- /.card-header -->
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                        {{api_message}} 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-eye"></i> DATA KEGIATAN</h3>
                            <div class="card-tools">                                 
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">                                      
                                <div class="col-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label"><strong>RKAID: </strong></label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">{{detailkegiatan.RKAID}}</p>
                                        </div>                            
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label"><strong>OPD / SKPD: </strong></label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">[{{detailkegiatan.kode_organisasi}}] {{detailkegiatan.OrgNm}}</p>
                                        </div>                            
                                    </div>                             
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label"><strong>UNIT KERJA: </strong></label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">[{{detailkegiatan.kode_suborganisasi}}] {{detailkegiatan.SOrgNm}}</p>
                                        </div>                            
                                    </div>     
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label"><strong>PROGRAM: </strong></label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">[{{detailkegiatan.kode_program}}] {{detailkegiatan.PrgNm}}</p>
                                        </div>                            
                                    </div>       
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label"><strong>KEGIATAN: </strong></label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">
                                                [{{detailkegiatan.kode_kegiatan}}] {{detailkegiatan.KgtNm}} 
                                                <span class="badge badge-pill badge-primary mb-1">[{{detailkegiatan.sifat_kegiatan1}}]</span>
                                            </p>
                                        </div>                            
                                    </div>             
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label"><strong>PAGU DANA: </strong></label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">{{detailkegiatan.PaguDana1|formatUang}}</p>
                                        </div>                            
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
            <div class="row" v-if="pid=='create'">
				<div class="col-12">
                    <!-- Horizontal Form -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-plus"></i> TAMBAH TARGET FISIK
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" v-on:click.prevent="proc('default',null)">
                                    <i class="fas fa-times"></i>
                                </button>                                                
                            </div>       
                        </div>
                        <form class="form-horizontal" @submit.prevent="saveData">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">RINCIAN KEGIATAN :</label> 
                                    <div class="col-md-9">
                                        
                                    </div>
                                </div>   
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">BULAN JANUARI :</label> 
                                    <div class="col-md-9">
                                        <vue-autonumeric 
											v-model.trim="form.targetfisik[0]" 
											v-on:input="$v.form.$touch"
											:options="{
												allowDecimalPadding: false,
                                                minimumValue:0,
                                                maximumValue:100,
                                                numericPos:true,
                                                decimalPlaces : 0,
                                                digitGroupSeparator : '',
                                                showWarnings:false,
                                                unformatOnSubmit: true,
                                                modifyValueOnWheel:false
											}" 
											class="form-control" 
											v-bind:class="{'is-invalid': $v.form.targetfisik.$error, 'is-valid': $v.form.targetfisik.$dirty && !$v.form.targetfisik.$invalid}">
										</vue-autonumeric>
										<div class="text-danger" v-if="$v.form.targetfisik.$error">* wajib isi target fisik bulan januari</div>
                                    </div>
                                </div>   
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">BULAN FEBRUARI :</label> 
                                    <div class="col-md-9">
                                        <vue-autonumeric 
											v-model.trim="form.targetfisik[1]" 
											v-on:input="$v.form.$touch"
											:options="{
												allowDecimalPadding: false,
                                                minimumValue:0,
                                                maximumValue:100,
                                                numericPos:true,
                                                decimalPlaces : 0,
                                                digitGroupSeparator : '',
                                                showWarnings:false,
                                                unformatOnSubmit: true,
                                                modifyValueOnWheel:false
											}" 
											class="form-control" 
											v-bind:class="{'is-invalid': $v.form.targetfisik.$error, 'is-valid': $v.form.targetfisik.$dirty && !$v.form.targetfisik.$invalid}">
										</vue-autonumeric>
										<div class="text-danger" v-if="$v.form.targetfisik.$error">* wajib isi target fisik bulan januari</div>
                                    </div>
                                </div>   
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">BULAN MARET :</label> 
                                    <div class="col-md-9">
                                        <vue-autonumeric 
											v-model.trim="form.targetfisik[2]" 
											v-on:input="$v.form.$touch"
											:options="{
												allowDecimalPadding: false,
                                                minimumValue:0,
                                                maximumValue:100,
                                                numericPos:true,
                                                decimalPlaces : 0,
                                                digitGroupSeparator : '',
                                                showWarnings:false,
                                                unformatOnSubmit: true,
                                                modifyValueOnWheel:false
											}" 
											class="form-control" 
											v-bind:class="{'is-invalid': $v.form.targetfisik.$error, 'is-valid': $v.form.targetfisik.$dirty && !$v.form.targetfisik.$invalid}">
										</vue-autonumeric>
										<div class="text-danger" v-if="$v.form.targetfisik.$error">* wajib isi target fisik bulan januari</div>
                                    </div>
                                </div>   
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">BULAN APRIL :</label> 
                                    <div class="col-md-9">
                                        <vue-autonumeric 
											v-model.trim="form.targetfisik[3]" 
											v-on:input="$v.form.$touch"
											:options="{
												allowDecimalPadding: false,
                                                minimumValue:0,
                                                maximumValue:100,
                                                numericPos:true,
                                                decimalPlaces : 0,
                                                digitGroupSeparator : '',
                                                showWarnings:false,
                                                unformatOnSubmit: true,
                                                modifyValueOnWheel:false
											}" 
											class="form-control" 
											v-bind:class="{'is-invalid': $v.form.targetfisik.$error, 'is-valid': $v.form.targetfisik.$dirty && !$v.form.targetfisik.$invalid}">
										</vue-autonumeric>
										<div class="text-danger" v-if="$v.form.targetfisik.$error">* wajib isi target fisik bulan januari</div>
                                    </div>
                                </div>   
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">BULAN MEI :</label> 
                                    <div class="col-md-9">
                                        <vue-autonumeric 
											v-model.trim="form.targetfisik[4]" 
											v-on:input="$v.form.$touch"
											:options="{
												allowDecimalPadding: false,
                                                minimumValue:0,
                                                maximumValue:100,
                                                numericPos:true,
                                                decimalPlaces : 0,
                                                digitGroupSeparator : '',
                                                showWarnings:false,
                                                unformatOnSubmit: true,
                                                modifyValueOnWheel:false
											}" 
											class="form-control" 
											v-bind:class="{'is-invalid': $v.form.targetfisik.$error, 'is-valid': $v.form.targetfisik.$dirty && !$v.form.targetfisik.$invalid}">
										</vue-autonumeric>
										<div class="text-danger" v-if="$v.form.targetfisik.$error">* wajib isi target fisik bulan januari</div>
                                    </div>
                                </div>   
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">BULAN JUNI :</label> 
                                    <div class="col-md-9">
                                        <vue-autonumeric 
											v-model.trim="form.targetfisik[5]" 
											v-on:input="$v.form.$touch"
											:options="{
												allowDecimalPadding: false,
                                                minimumValue:0,
                                                maximumValue:100,
                                                numericPos:true,
                                                decimalPlaces : 0,
                                                digitGroupSeparator : '',
                                                showWarnings:false,
                                                unformatOnSubmit: true,
                                                modifyValueOnWheel:false
											}" 
											class="form-control" 
											v-bind:class="{'is-invalid': $v.form.targetfisik.$error, 'is-valid': $v.form.targetfisik.$dirty && !$v.form.targetfisik.$invalid}">
										</vue-autonumeric>
										<div class="text-danger" v-if="$v.form.targetfisik.$error">* wajib isi target fisik bulan januari</div>
                                    </div>
                                </div>   
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">BULAN JULI :</label> 
                                    <div class="col-md-9">
                                        <vue-autonumeric 
											v-model.trim="form.targetfisik[6]" 
											v-on:input="$v.form.$touch"
											:options="{
												allowDecimalPadding: false,
                                                minimumValue:0,
                                                maximumValue:100,
                                                numericPos:true,
                                                decimalPlaces : 0,
                                                digitGroupSeparator : '',
                                                showWarnings:false,
                                                unformatOnSubmit: true,
                                                modifyValueOnWheel:false
											}" 
											class="form-control" 
											v-bind:class="{'is-invalid': $v.form.targetfisik.$error, 'is-valid': $v.form.targetfisik.$dirty && !$v.form.targetfisik.$invalid}">
										</vue-autonumeric>
										<div class="text-danger" v-if="$v.form.targetfisik.$error">* wajib isi target fisik bulan januari</div>
                                    </div>
                                </div>   
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">BULAN AGUSTUS :</label> 
                                    <div class="col-md-9">
                                        <vue-autonumeric 
											v-model.trim="form.targetfisik[7]" 
											v-on:input="$v.form.$touch"
											:options="{
												allowDecimalPadding: false,
                                                minimumValue:0,
                                                maximumValue:100,
                                                numericPos:true,
                                                decimalPlaces : 0,
                                                digitGroupSeparator : '',
                                                showWarnings:false,
                                                unformatOnSubmit: true,
                                                modifyValueOnWheel:false
											}" 
											class="form-control" 
											v-bind:class="{'is-invalid': $v.form.targetfisik.$error, 'is-valid': $v.form.targetfisik.$dirty && !$v.form.targetfisik.$invalid}">
										</vue-autonumeric>
										<div class="text-danger" v-if="$v.form.targetfisik.$error">* wajib isi target fisik bulan januari</div>
                                    </div>
                                </div>                                   
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">BULAN SEPTEMBER :</label> 
                                    <div class="col-md-9">
                                        <vue-autonumeric 
											v-model.trim="form.targetfisik[8]" 
											v-on:input="$v.form.$touch"
											:options="{
												allowDecimalPadding: false,
                                                minimumValue:0,
                                                maximumValue:100,
                                                numericPos:true,
                                                decimalPlaces : 0,
                                                digitGroupSeparator : '',
                                                showWarnings:false,
                                                unformatOnSubmit: true,
                                                modifyValueOnWheel:false
											}" 
											class="form-control" 
											v-bind:class="{'is-invalid': $v.form.targetfisik.$error, 'is-valid': $v.form.targetfisik.$dirty && !$v.form.targetfisik.$invalid}">
										</vue-autonumeric>
										<div class="text-danger" v-if="$v.form.targetfisik.$error">* wajib isi target fisik bulan januari</div>
                                    </div>
                                </div>                                   
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">BULAN OKTOBER :</label> 
                                    <div class="col-md-9">
                                        <vue-autonumeric 
											v-model.trim="form.targetfisik[9]" 
											v-on:input="$v.form.$touch"
											:options="{
												allowDecimalPadding: false,
                                                minimumValue:0,
                                                maximumValue:100,
                                                numericPos:true,
                                                decimalPlaces : 0,
                                                digitGroupSeparator : '',
                                                showWarnings:false,
                                                unformatOnSubmit: true,
                                                modifyValueOnWheel:false
											}" 
											class="form-control" 
											v-bind:class="{'is-invalid': $v.form.targetfisik.$error, 'is-valid': $v.form.targetfisik.$dirty && !$v.form.targetfisik.$invalid}">
										</vue-autonumeric>
										<div class="text-danger" v-if="$v.form.targetfisik.$error">* wajib isi target fisik bulan januari</div>
                                    </div>
                                </div>                                   
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">BULAN NOVEMBER :</label> 
                                    <div class="col-md-9">
                                        <vue-autonumeric 
											v-model.trim="form.targetfisik[10]" 
											v-on:input="$v.form.$touch"
											:options="{
												allowDecimalPadding: false,
                                                minimumValue:0,
                                                maximumValue:100,
                                                numericPos:true,
                                                decimalPlaces : 0,
                                                digitGroupSeparator : '',
                                                showWarnings:false,
                                                unformatOnSubmit: true,
                                                modifyValueOnWheel:false
											}" 
											class="form-control" 
											v-bind:class="{'is-invalid': $v.form.targetfisik.$error, 'is-valid': $v.form.targetfisik.$dirty && !$v.form.targetfisik.$invalid}">
										</vue-autonumeric>
										<div class="text-danger" v-if="$v.form.targetfisik.$error">* wajib isi target fisik bulan januari</div>
                                    </div>
                                </div>                                                                   
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">BULAN DESEMBER :</label> 
                                    <div class="col-md-9">
                                        <vue-autonumeric 
											v-model.trim="form.targetfisik[11]" 
											v-on:input="$v.form.$touch"
											:options="{
												allowDecimalPadding: false,
                                                minimumValue:0,
                                                maximumValue:100,
                                                numericPos:true,
                                                decimalPlaces : 0,
                                                digitGroupSeparator : '',
                                                showWarnings:false,
                                                unformatOnSubmit: true,
                                                modifyValueOnWheel:false
											}" 
											class="form-control" 
											v-bind:class="{'is-invalid': $v.form.targetfisik.$error, 'is-valid': $v.form.targetfisik.$dirty && !$v.form.targetfisik.$invalid}">
										</vue-autonumeric>
										<div class="text-danger" v-if="$v.form.targetfisik.$error">* wajib isi target fisik bulan januari</div>
                                    </div>
                                </div>                 
                            </div>
                        </form>
                    </div>
				</div>
            </div>
            <div class="row" v-if="pid=='default'">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-list-ol"></i>  DAFTAR RENCANA TARGET FISIK
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" v-on:click.prevent="proc('create')" title="Tambah Rencana Target Fisik">
                                    <i class="fas fa-plus"></i>
                                </button>                                
                                <router-link to="/apbdmurni/uraian" class="btn btn-tool">
                                    <i class="fas fa-times"></i>
                                </router-link>                                
                            </div>       
                        </div>
                        <div class="card-body table-responsive p-0" v-if="daftar_targetfisik.data.length">
                            <table class="table table-striped table-hover mb-2">
                                <thead>
                                    <tr>
                                        <th width="55">REKENING</th>    
                                        <th  width="250">
                                            NAMA URAIAN
                                        </th>
                                        <th width="55">1</th>                    
                                        <th width="55">2</th>                    
                                        <th width="55">3</th>                    
                                        <th width="55">4</th>                    
                                        <th width="55">5</th>                    
                                        <th width="55">6</th>                    
                                        <th width="55">7</th>                    
                                        <th width="55">8</th>                    
                                        <th width="55">9</th>                    
                                        <th width="55">10</th>                    
                                        <th width="55">11</th>                    
                                        <th width="55">12</th>                    
                                        <th  width="80">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>  

                                </tbody>
                            </table>
                        </div>         
                        <div class="card-body table-responsive" v-else>                            
                            <div class="alert alert-info alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-info"></i> Info!</h5>
                                Belum ada data yang bisa ditampilkan.
                            </div>
                        </div>              
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content" v-else>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- /.card-header -->
                    <div class="alert alert-danger alert-dismissible">
                        <router-link to="/apbdmurni" class="close">
                            <i class="fas fa-times"></i>
                        </router-link>
                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                        Mohon di pilih terlebih dahulu kegiatan !!!                         
                    </div>
                </div>
            </div>
        </div>
    </section>   
</div>
</template>
<script>
import vSelect from 'vue-select';
import { required} from 'vuelidate/lib/validators';
import VueAutonumeric from 'vue-autonumeric';
export default {
    created ()
    {
        var page = this.$store.getters.getPage('apbdmurni');
        this.detailkegiatan = page.detailkegiatan;             
    },
    mounted()
    {
        this.proc('default');   
    },
    data: function() 
	{
		return {
            pid:'default',
            api_message:'',

            detailkegiatan:'',
            daftar_targetfisik:{
                data:{}
            },
            //form			
            daftar_bulan: [],           
			form: {		
               targetfisik:[]
            }
        }
    },
    methods: 
    {	
        populateData(page=1)
        {           
            axios.get('/api/v1/apbdmurni/uraian/targetfisik/'+this.detailkegiatan.RKAID,{
                headers:{
                    'Authorization': window.laravel.api_token,
                }
            })
            .then(response => {                                        
                console.log(response.data);                
            })
            .catch(response => {
                this.api_message = response;
            }); 
        },
        proc (pid,item=null) 
        { 
            this.$v.$reset();
            switch (pid)
            {
                case 'create' :
                    this.pid = pid;                    
                    axios.get('/api/v1/apbdmurni/create3/'+this.detailkegiatan.RKAID,{
                        headers:{
                            'Authorization': window.laravel.api_token,
                        }
                    })
                    .then(response => {                                        
                        console.log(response.data);                
                    })
                    .catch(response => {
                        this.api_message = response;
                    }); 
                break;
                default :
                    this.pid = pid;
                    this.populateData();
                    this.clearform();
            }
        },
        saveData() 
		{	
            this.$v.form.$touch();    
            if(this.$v.$invalid == false)
            { 
                
			}        
        },
        clearform ()
        {   
                      
        },
    },
    validations: {
		form:{
            targetfisik: {
                required
            }
        }
	},
	components: 
	{
        'vue-autonumeric':VueAutonumeric,
    }
}
</script>