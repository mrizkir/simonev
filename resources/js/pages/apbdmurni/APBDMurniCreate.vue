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
                        <li class="breadcrumb-item active">TAMBAH KEGIATAN BARU</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>  
    <!-- Main content -->
    <section class="content" v-if="SOrgIDSelected">
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
                    <!-- Horizontal Form -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-plus"></i> Tambah Kegiatan Baru
                            </h3>
                            <div class="card-tools">
                                <router-link to="/apbdmurni" class="btn btn-tool">
                                    <i class="fas fa-times"></i>
                                </router-link>                                
                            </div>       
                        </div>
                        <form class="form-horizontal" @submit.prevent="saveData">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">PROGRAM</label>
                                    <div class="col-sm-10">
                                        <v-select 
                                            v-model="form.PrgID" 
                                            :reduce="daftar_program => daftar_program.code"
                                            v-on:input="$v.form.$touch" 
                                            placeholder="SILAHKAN PILIH PROGRAM" 
                                            :options="daftar_program" 
                                            @input="fetchKegiatan" 
                                            v-bind:class="{'is-invalid': $v.form.PrgID.$error, 'is-valid': $v.form.PrgID.$dirty && !$v.form.PrgID.$invalid}">
                                        </v-select>
                                        <div class="text-danger" v-if="$v.form.PrgID.$error">* wajib isi</div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">RKPD</label>
                                    <div class="col-sm-10">
                                        <v-select 
                                            v-model="form.RKPDID" 
                                            :reduce="daftar_rkpd => daftar_rkpd.code"
                                            placeholder="SILAHKAN PILIH RKPD" 
                                            :options="daftar_rkpd" 
                                            @input="fetchRKPD">
                                        </v-select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">KEGIATAN</label>
                                    <div class="col-sm-10">
                                        <v-select 
                                            v-model="form.KgtID" 
                                            :reduce="daftar_kegiatan => daftar_kegiatan.code"
                                            v-on:input="$v.form.$touch" 
                                            placeholder="SILAHKAN PILIH KEGIATAN" 
                                            :options="daftar_kegiatan" 
                                            v-bind:class="{'is-invalid': $v.form.KgtID.$error, 'is-valid': $v.form.KgtID.$dirty && !$v.form.KgtID.$invalid}">
                                        </v-select>
                                        <div class="text-danger" v-if="$v.form.KgtID.$error">* wajib isi</div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">PAGU DANA</label>
                                    <div class="col-sm-10">
										<vue-autonumeric 
											v-model.trim="form.PaguDana1" 
											v-on:input="$v.form.$touch"
											:options="{
												minimumValue: '0',
												decimalCharacter: ',',
												digitGroupSeparator: '.',
												emptyInputBehavior:0,
												unformatOnSubmit: true 
											}" 
											class="form-control" 
											v-bind:class="{'is-invalid': $v.form.PaguDana1.$error, 'is-valid': $v.form.PaguDana1.$dirty && !$v.form.PaguDana1.$invalid}">
										</vue-autonumeric>
										<div class="text-danger" v-if="$v.form.PaguDana1.$error">* wajib isi</div>
                                    </div>
                                </div>		
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">PA</label>
                                    <div class="col-sm-10">
                                        <v-select 
                                            v-model="form.nip_pa" 
                                            :reduce="daftar_pa => daftar_pa.code" 
                                            placeholder="SILAHKAN PILIH KPA (PENGGUNA ANGGARAN)" 
                                            :options="daftar_pa">
                                        </v-select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">KPA</label>
                                    <div class="col-sm-10">
                                        <v-select 
                                            v-model="form.nip_kpa" 
                                            :reduce="daftar_ppk => daftar_kpa.code" 
                                            placeholder="SILAHKAN PILIH KPA (KUASA PENGGUNA ANGGARAN)" 
                                            :options="daftar_kpa">
                                        </v-select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">PPK</label>
                                    <div class="col-sm-10">
                                        <v-select 
                                            placeholder="SILAHKAN PILIH PPK (PEJABAT PEMBUAT KOMITMEN)" 
                                            v-model="form.nip_ppk" 
                                            :reduce="daftar_ppk => daftar_ppk.code" 
                                            :options="daftar_ppk">
                                        </v-select>
                                    </div>
                                </div>                               
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">PPTK</label>
                                    <div class="col-sm-10">
                                        <v-select 
                                            v-model="form.nip_pptk" 
                                            :reduce="daftar_pptk => daftar_pptk.code"
                                            placeholder="SILAHKAN PILIH PPTK (PEJABAT PELAKSANA TEKNIS KEGIATAN)" 
                                            :options="daftar_pptk">
                                        </v-select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="form-group row">
                                    <div class="col-sm-2">
                                        &nbsp;
                                    </div>
                                    <div class="col-sm-10">
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
                        Mohon untuk dipilih Unit Kerja !!!
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</template>
<script>
import { required} from 'vuelidate/lib/validators';
import VueAutonumeric from 'vue-autonumeric';
import vSelect from 'vue-select';

export default {
    created ()
    {
        var page = this.$store.getters.getPage('apbdmurni');
        this.SOrgIDSelected = page.SOrgID.code.length > 0;        
    },
    mounted()
    {
        this.$v.$reset();
        this.fetchData();
    },
    data: function() 
	{
		return {
            SOrgIDSelected:false,
            api_message:'',          

            //form			
            daftar_program: [],
            daftar_rkpd: [],
            daftar_kegiatan: [],
            daftar_pa: [],
            daftar_kpa: [],
            daftar_ppk: [],
            daftar_pptk: [],
			form: {		
                RKAID:'',
                PrgID:'',		                                
                RKPDID:'',		                                
                KgtID: '',
                PaguDana1: '',	
                nip_kpa:'',			
                nip_pa:'',			
                nip_ppk:'',			
                nip_pptk:'',			
				Descr:'',
			},            

        }
    },
    methods: 
    {	
        fetchData ()
        {  
            axios.get('/api/v1/apbdmurni/create',{
                headers:{
                    'Authorization': window.laravel.api_token,
                }
            })
            .then(response => {             
                var daftar_program = [];
                $.each(response.data.daftar_program,function(key,value){
                    daftar_program.push({
                        code:key,
                        label:value
                    });
                });                
                this.daftar_program=daftar_program;                 
                
                var daftar_pa = [];
                $.each(response.data.daftar_pa,function(key,value){
                    daftar_pa.push({
                        code:key,
                        label:value
                    });
                });                
                this.daftar_pa=daftar_pa;                 
                
                var daftar_kpa = [];
                $.each(response.data.daftar_kpa,function(key,value){
                    daftar_kpa.push({
                        code:key,
                        label:value
                    });
                });                
                this.daftar_kpa=daftar_kpa;                 
                
                var daftar_ppk = [];
                $.each(response.data.daftar_ppk,function(key,value){
                    daftar_ppk.push({
                        code:key,
                        label:value
                    });
                });                
                this.daftar_ppk=daftar_ppk;                 
                
                var daftar_pptk = [];
                $.each(response.data.daftar_pptk,function(key,value){
                    daftar_pptk.push({
                        code:key,
                        label:value
                    });
                });                
                this.daftar_pptk=daftar_pptk;                 
            })
            .catch(response => {
                this.api_message = response;
            });
        },
        fetchRKPD ()
        {  
            this.form.KgtID='';
            axios.post('/api/v1/apbdmurni/filter',{
                    'RKPDID':this.form.RKPDID,
                    'create':0,
                },{
                    headers:{
                        'Authorization': window.laravel.api_token,
                    },
                })
                .then(response => {      
                    this.$swal({
                        title: '<i class="fas fa-spin fa-spinner"></i>',
                        text: "Melakukan pencarian kegiatan di RKPD",
                        showCancelButton: false,
                        showConfirmButton: false,
                        showCloseButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                    });   
                    setTimeout(() => {                        
                        var daftar_kegiatan = [];
                        $.each(response.data.daftar_kegiatan,function(key,value){
                            daftar_kegiatan.push({
                                code:key,
                                label:value
                            });
                        });                
                        this.daftar_kegiatan=daftar_kegiatan;
                        this.form.PaguDana1=response.data.NilaiUsulan2;
                        this.$swal.close();
                    }, 1500);
                })
                .catch(error => {
                    this.api_message = error.response.data.message;
                });	
        },
        fetchKegiatan ()
        {  
            this.form.RKPDID='';
            this.form.KgtID='';
            axios.post('/api/v1/apbdmurni/filter',{
                    'PrgID':this.form.PrgID,
                    'create':0,
                },{
                    headers:{
                        'Authorization': window.laravel.api_token,
                    },
                })
                .then(response => {      
                    this.$swal({
                        title: '<i class="fas fa-spin fa-spinner"></i>',
                        text: "Melakukan pencarian kegiatan di RKPD dan Master Kegiatan",
                        showCancelButton: false,
                        showConfirmButton: false,
                        showCloseButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                    });   
                    setTimeout(() => {
                        var daftar_rkpd = [];
                        $.each(response.data.daftar_rkpd,function(key,value){
                            daftar_rkpd.push({
                                code:key,
                                label:value
                            });
                        });                
                        this.daftar_rkpd=daftar_rkpd;
                        
                        var daftar_kegiatan = [];
                        $.each(response.data.daftar_kegiatan,function(key,value){
                            daftar_kegiatan.push({
                                code:key,
                                label:value
                            });
                        });                
                        this.daftar_kegiatan=daftar_kegiatan;
                        this.$swal.close();
                    }, 1500);
                })
                .catch(error => {
                    this.api_message = error.response.data.message;
                });		
        },
        saveData() 
		{	
            this.$v.form.$touch();    
            if(this.$v.$invalid == false)
            { 
                var page = this.$store.getters.getPage('apbdmurni');                
				axios.post('/api/v1/apbdmurni',{
                    'OrgID':page.OrgID.code,
                    'SOrgID':page.SOrgID.code,
                    'PrgID':this.form.PrgID,
                    'KgtID':this.form.KgtID,
                    'RKPDID':this.form.RKPDID,
                    'PaguDana1':this.form.PaguDana1,
                    'nip_pa':this.form.nip_pa,
                    'nip_kpa':this.form.nip_kpa,
                    'nip_ppk':this.form.nip_ppk,
                    'nip_pptk':this.form.nip_pptk,
                    'Descr':this.form.Descr,
                },{
                    headers:{
                        'Authorization': window.laravel.api_token,
                    },
                })
                .then(response => {                          
                    this.$swal({
                        title: '<i class="fas fa-spin fa-spinner"></i>',
                        text: "Menyimpan Data Kegiatan berhasil dilakukan",
                        showCancelButton: false,
                        showConfirmButton: false,
                        showCloseButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                    });              
                    setTimeout(() => {
                        this.clearform();              
                        this.$swal.close();          
                        this.$router.push('/apbdmurni');                          
                    }, 1500);             
                })
                .catch(error => {
                    this.api_message = error.response.data.message;
                });			
			}        
        },
        clearform ()
        {   
            this.form.PrgID='';
            this.form.KgtID='';
            this.form.RKPDID='';
            this.form.PaguDana1='';
            this.form.nip_pa='';
            this.form.nip_kpa='';
            this.form.nip_ppk='';
            this.form.nip_pptk='';
            this.form.Descr='';          
        },
        
    },
    validations: {
		form: {
			PrgID: {
				required
			},
			KgtID: {
				required
			},
			PaguDana1: {
				required
			},
		}
	},
	components: 
	{
        'vue-autonumeric':VueAutonumeric,
        'v-select': vSelect,
    }
}
</script>