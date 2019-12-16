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
                        <li class="breadcrumb-item active">TAMBAH RINCIAN KEGIATAN</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>  
    <!-- Main content -->
    <section class="content" v-if="detailkegiatan.hasOwnProperty('RKAID') && datarekening.hasOwnProperty('code')">
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
                <div class="col-12">
                    <!-- Horizontal Form -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-plus"></i> TAMBAH RINCIAN KEGIATAN BARU
                            </h3>
                            <div class="card-tools">
                                <router-link to="/apbdmurni/uraian" class="btn btn-tool">
                                    <i class="fas fa-times"></i>
                                </router-link>                                
                            </div>       
                        </div>
                        <form class="form-horizontal" @submit.prevent="saveData">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">NAMA REKENING: </label>
                                    <div class="col-md-9">
                                        <p class="form-control-static">{{datarekening.label}}</p>
                                    </div>                            
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">NAMA URAIAN</label>
                                    <div class="col-sm-9">
										<input type="text" v-model="form.nama_uraian" class="form-control" v-bind:class="{'is-invalid': $v.form.nama_uraian.$error, 'is-valid': $v.form.nama_uraian.$dirty && !$v.form.nama_uraian.$invalid}">
										<div class="text-danger" v-if="$v.form.nama_uraian.$error">* wajib isi</div>
                                    </div>
								</div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">VOLUME / NAMA SATUAN</label>
                                    <div class="col-sm-3">
										<vue-autonumeric 
											v-model.trim="form.volume" 
											v-on:input="$v.form.$touch"
											:options="{
												allowDecimalPadding: false,
                                                minimumValue:0,
                                                maximumValue:99999999999999999,
                                                numericPos:true,
                                                decimalPlaces : 0,
                                                digitGroupSeparator : '',
                                                showWarnings:false,
                                                unformatOnSubmit: true,
                                                modifyValueOnWheel:false
											}" 
											class="form-control" 
											v-bind:class="{'is-invalid': $v.form.volume.$error, 'is-valid': $v.form.volume.$dirty && !$v.form.volume.$invalid}">
										</vue-autonumeric>
										<div class="text-danger" v-if="$v.form.volume.$error">* wajib isi</div>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" v-model="form.satuan" class="form-control" v-bind:class="{'is-invalid': $v.form.satuan.$error, 'is-valid': $v.form.satuan.$dirty && !$v.form.satuan.$invalid}">
										<div class="text-danger" v-if="$v.form.satuan.$error">* wajib isi</div>
                                    </div>
                                </div>	
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">HARGA SATUAN</label>
                                    <div class="col-sm-9">
                                       <vue-autonumeric 
											v-model.trim="form.harga_satuan" 
											v-on:input="$v.form.$touch"
											:options="{
												minimumValue: '0',
												decimalCharacter: ',',
												digitGroupSeparator: '.',
                                                emptyInputBehavior:0,
												unformatOnSubmit: true 
											}" 
											class="form-control" 
											v-bind:class="{'is-invalid': $v.form.harga_satuan.$error, 'is-valid': $v.form.harga_satuan.$dirty && !$v.form.harga_satuan.$invalid}">
										</vue-autonumeric>
										<div class="text-danger" v-if="$v.form.harga_satuan.$error">* wajib isi</div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">PAGU URAIAN</label>
                                    <div class="col-sm-9">
                                       <vue-autonumeric 
											v-model.trim="form.pagu_uraian1" 
											v-on:input="$v.form.$touch"
											:options="{
												minimumValue: '0',
												decimalCharacter: ',',
												digitGroupSeparator: '.',
                                                emptyInputBehavior:0,
												unformatOnSubmit: true 
											}" 
											class="form-control" 
											v-bind:class="{'is-invalid': $v.form.pagu_uraian1.$error, 'is-valid': $v.form.pagu_uraian1.$dirty && !$v.form.pagu_uraian1.$invalid}">
										</vue-autonumeric>
                                        <span class="form-text text-muted">(Harga Satuan * Volume)</span>
										<div class="text-danger" v-if="$v.form.pagu_uraian1.$error">* wajib isi</div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">JENIS PELAKSANAAN</label>
                                    <div class="col-sm-9">
                                        <v-select 
                                            v-model="form.JenisPelaksanaanID" 
                                            :reduce="daftar_jenispelaksanaan => daftar_jenispelaksanaan.code"
                                            placeholder="SILAHKAN PILIH JENIS PELAKSANAAN" 
                                            :options="daftar_jenispelaksanaan">
                                        </v-select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        &nbsp;
                                    </div>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-info" :disabled="$v.form.$error">Simpan</button>                                        
                                    </div>                                    
                                </div>
                            </div>
                        </form>
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
        this.datarekening = page.datarekening;   
    },
    mounted()
    {
        this.$v.$reset();
        this.fetchJenisPelaksanaan();
    },
    data: function() 
	{
		return {
            pid:'default',
            api_message:'',

            datarekening:'',
            detailkegiatan:'',

             //form			
            daftar_jenispelaksanaan: [],           
			form: {		
                nama_uraian:'',
                volume:'',		                                
                satuan:'',		                                
                harga_satuan:'',		                                
                pagu_uraian1: '',
                JenisPelaksanaanID: ''
            }
        }
    },
    methods: 
    {	
        fetchJenisPelaksanaan()
        {
            axios.get('/api/v1/apbdmurni/create2',{
                headers:{
                    'Authorization': window.laravel.api_token,
                }
            })
            .then(response => {             
                var daftar_jenispelaksanaan = [];
                $.each(response.data,function(key,value){
                    daftar_jenispelaksanaan.push({
                        code:key,
                        label:value
                    });
                });                
                this.daftar_jenispelaksanaan=daftar_jenispelaksanaan;    
            })
            .catch(response => {
                this.api_message = response;
            });
        },
        saveData() 
		{	
            this.$v.form.$touch();    
            if(this.$v.$invalid == false)
            { 
                var page = this.$store.getters.getPage('apbdmurni');                
				axios.post('/api/v1/apbdmurni/store2',{
                    'RKAID':this.detailkegiatan.RKAID,
                    'RObyID':this.datarekening.code,
                    'nama_uraian':this.form.nama_uraian,
                    'volume':this.form.volume,
                    'satuan':this.form.satuan,
                    'RKPDID':this.form.RKPDID,
                    'harga_satuan':this.form.harga_satuan,
                    'pagu_uraian1':this.form.pagu_uraian1,
                    'JenisPelaksanaanID':this.form.JenisPelaksanaanID,
                },{
                    headers:{
                        'Authorization': window.laravel.api_token,
                    },
                })
                .then(response => {                          
                    this.$swal({
                        title: '<i class="fas fa-spin fa-spinner"></i>',
                        text: "Menyimpan Data Rincian Kegiatan berhasil dilakukan",
                        showCancelButton: false,
                        showConfirmButton: false,
                        showCloseButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                    });              
                    setTimeout(() => {
                        this.clearform();     
                        var page = this.$store.getters.getPage('apbdmurni');
                        page.datarekening = '';                        
                        this.$store.commit('replacePage',page);         
                        this.$swal.close();          
                        this.$router.push('/apbdmurni/uraian');                          
                    }, 1500);             
                })
                .catch(error => {
                    this.api_message = error.response.data.message;
                });			
			}        
        },
        clearform ()
        {   
            this.form.nama_uraian='';
            this.form.volume=0;
            this.form.satuan='';
            this.form.harga_satuan=0;
            this.form.pagu_uraian1=0;
            this.form.JenisPelaksanaanID='';               
        },
    },
    validations: {
		form: {
			nama_uraian: {
				required
			},
			volume: {
				required
			},
			satuan: {
				required
			},
			harga_satuan: {
				required
			},
			pagu_uraian1: {
				required
			},
		}
	},
	components: 
	{
        'v-select': vSelect,
        'vue-autonumeric':VueAutonumeric,
    }
}
</script>