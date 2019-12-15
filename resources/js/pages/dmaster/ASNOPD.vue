<template>
<div class="content-wrapper">
	<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <i class="nav-icon fas fa-user-friends"></i>
                        ASN OPD
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><router-link to="/">HOME</router-link></li>
                        <li class="breadcrumb-item">MASTER</li>
                        <li class="breadcrumb-item">PEGAWAI</li>
                        <li class="breadcrumb-item active">ASN OPD</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>  
	<!-- Main content -->
    <section class="content">
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
			<div class="row" v-if="pid=='create'">
				<div class="col-12">
                    <!-- Horizontal Form -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-plus"></i> Tambah ASN ke OPD
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
                                    <label class="col-md-2 col-form-label"><strong>OPD / SKPD: </strong></label>
                                    <div class="col-md-10">
                                        <p class="form-control-static">
                                            <strong>{{this.form.OrgNm}}</strong>
                                        </p>
                                    </div>                            
                                </div> 									
								<div class="form-group row">
                                    <label class="col-sm-2 col-form-label">NAMA ASN</label>
                                    <div class="col-sm-10">									
                                        <v-select 
                                            v-model="form.ASNID" 
                                            v-on:input="$v.form.$touch" 
                                            placeholder="PILIH ASN" 
                                            :options="daftar_asn" 
                                            :reduce="daftar_asn => daftar_asn.code" 
                                            v-bind:class="{'is-invalid': $v.form.ASNID.$error, 'is-valid': $v.form.ASNID.$dirty && !$v.form.ASNID.$invalid}">
                                        </v-select>
                                        <div class="text-danger" v-if="$v.form.ASNID.$error">* wajib isi</div>
                                    </div>
								</div>                                			
								<div class="form-group row">
                                    <label class="col-sm-2 col-form-label">JENIS JABATAN</label>
                                    <div class="col-sm-10">
										<select 
                                            class="form-control" 
                                            v-model="form.Jenis_Jabatan" 
                                            v-on:input="$v.form.$touch"
                                            v-bind:class="{'is-invalid': $v.form.Jenis_Jabatan.$error, 'is-valid': $v.form.Jenis_Jabatan.$dirty && !$v.form.Jenis_Jabatan.$invalid}">
                                            <option value=''>DAFTAR JENIS JABATAN</option>
                                            <option value='pa'>PENGGUNA ANGGARAN</option>
                                            <option value='kpa'>KUASA PENGGUNA ANGGARAN</option>
                                            <option value='ppk'>PEJABAT PEMBUAT KOMITMEN</option>
                                            <option value='pptk'>PEJABAT PELAKSANA TEKNIS KEGIATAN</option>
                                        </select>
                                        <div class="text-danger" v-if="$v.form.Jenis_Jabatan.$error">* wajib isi</div>
                                    </div>
								 </div>
								<div class="form-group row">
                                    <label class="col-sm-2 col-form-label">KETERANGAN</label>
                                    <div class="col-sm-10">
                                        <textarea type="text" name="Descr" id="Descr" v-model="form.Descr" class="form-control" row="4">
                                        </textarea>
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
            <div class="row" v-if="pid=='show'">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-eye"></i> DETAIL ASN</h3>
                            <div class="card-tools">                                 
                                <button type="button" class="btn btn-tool" v-on:click.prevent="proc('create',null)">
                                    <i class="fas fa-plus"></i>
                                </button>                                
                                <button type="button" class="btn btn-tool text-danger" v-on:click.prevent="proc('destroy',asnopd.detail)">
                                    <i class="fas fa-trash-alt"></i>
                                </button>      
                                <button type="button" class="btn btn-tool" v-on:click.prevent="proc('default',null)">
                                    <i class="fas fa-times"></i>
                                </button>                                                
                            </div>                            
                        </div>
                        <div class="card-body">
                            <div class="row">                                      
                                <div class="col-md-6">
                                    <div class="form-horizontal">
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label"><strong>ID: </strong></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{asnopd.detail.ASNID}}</p>
                                            </div>                            
                                        </div>  
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label"><strong>NIP ASN: </strong></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{asnopd.detail.NIP_ASN}}</p>
                                            </div>                            
                                        </div>                          
                                        
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label"><strong>NAMA ASN: </strong></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{asnopd.detail.Nm_ASN}}</p>
                                            </div>                            
                                        </div>
                                    </div>      
                                </div>
                                <div class="col-md-6">
                                    <div class="form-horizontal">
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label"><strong>JENIS JABATAN: </strong></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{asnopd.detail.Jenis_Jabatan.toUpperCase()}}</p>
                                            </div>                            
                                        </div> 
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label"><strong>KETERANGAN: </strong></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{asnopd.detail.Descr}}</p>
                                            </div>                            
                                        </div> 
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label"><strong>DI BUAT / DI UBAH: </strong></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{asnopd.detail.created_at|formatTanggal}} / {{asnopd.detail.updated_at|formatTanggal}}</p>
                                            </div>                            
                                        </div>                                        
                                    </div>      
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" v-if="pid=='default'">  
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-bookmark"></i> FILTER</h3>                            
                        </div>
                        <form class="form-horizontal" @submit.prevent="filter">
                            <div class="card-body">
                                <div class="form-group row" id="divOrgID">
                                    <label class="col-sm-2 col-form-label">OPD / SKPD</label>
                                    <div class="col-sm-10">
                                        <v-select 
                                            v-model="OrgID" 
                                            placeholder="PILIH OPD / SKPD" 
                                            :options="daftar_opd" 
                                            :reduce="daftar_opd => daftar_opd.code" 
                                            @input="filter">
                                        </v-select>                                        
                                    </div>
                                </div>                               
                            </div>
                        </form>
                    </div>
                </div> 
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-search"></i> PENCARIAN</h3>                            
                        </div>
                        <form class="form-horizontal" @submit.prevent="search">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">KRITERIA</label>
                                    <div class="col-sm-10">
                                        <select name="cmbKriteria" id="cmbKriteria" class="form-control" v-model="cmbKriteria">
                                            <option value="NIP_ASN" :selected="cmbKriteria=='NIP_ASN'">NIP ASN</option>
                                            <option value="Nm_ASN" :selected="cmbKriteria=='Nm_ASN'">NAMA ASN</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">ISI KRITERIA</label>
                                    <div class="col-sm-10">
                                        <input name="txtKriteria" id="txtKriteria" type="text" class="form-control" v-model="txtKriteria">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-2">&nbsp;</div>
                                    <div class="col-md-10">
                                        <button type="button" class="btn bg-gradient-info btn-xs" v-on:click.prevent="search">
                                            <i class="fas fa-search"></i> Cari
                                        </button>      
                                        <a id="btnReset" href="#" title="Reset Pencarian" class="btn btn-default btn-xs" v-on:click.prevent="resetpencarian">
                                            <b><i class="icon-reset"></i></b> Reset
                                        </a>                           
                                    </div>
                                </div> 
                            </div>
                        </form>
                    </div>
                </div>            
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" v-on:click.prevent="proc('create')">
                                    <i class="fas fa-plus"></i>
                                </button>                                
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0" v-if="daftar_asnopd.data.length">
                            <table class="table table-striped table-hover mb-2">
                                <thead>
                                    <tr>
                                        <th width="55">NO</th>
                                        <th width="150">
                                            NIP ASN
                                        </th> 
                                        <th>
                                            NAMA ASN
                                        </th> 
                                        <th scope="col">JABATAN</th>                                      
                                        <th width="100">
                                            TA  
                                        </th>                                       
                                        <th width="100">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>  
                                    <tr v-for="(item,index) in daftar_asnopd.data" v-bind:key="item.RiwayatJabatanASNID">
                                        <td>{{daftar_asnopd.from+index}}</td>
                                        <td>{{item.NIP_ASN}}</td>
                                        <td>{{item.Nm_ASN}}</td>    
                                        <td>{{item.Jenis_Jabatan.toUpperCase()}}</td>
                                        <td>{{item.TA}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-wrench"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="#" v-on:click.prevent="proc('show',item)">
                                                        <i class="fas fa-eye"></i> DETAIL
                                                    </a>                                                    
                                                    <a class="dropdown-item" v-on:click.prevent="proc('destroy',item)" href="#">
                                                        <i class="fas fa-trash-alt"></i> HAPUS
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
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
                        <div class="card-footer" v-if="daftar_asnopd.data.length">                            
                            <pagination :data="daftar_asnopd" @pagination-change-page="populateData" align="center" :show-disabled="true" :limit="8">
                                <span slot="prev-nav">&lt; Prev</span>
	                            <span slot="next-nav">Next &gt;</span>
                            </pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>	
</div>
</template>
<script>
import Pagination from 'laravel-vue-pagination';
import { required} from 'vuelidate/lib/validators';
import vSelect from 'vue-select';

export default {
	mounted()
	{
		this.proc ('default');   
	},
	data: function() 
	{
		return {
            pid:'default',
            asnopd:{
                kriteria:'',
                isikriteria:'',
                detail:null
            },
            daftar_asnopd:{
                data:{}
            }, 
            api_message:'',           

            //field form search & filter
            OrgID:'',
            daftar_opd: [],
            cmbKriteria:'Nm_ASN',
            txtKriteria:'',

            //form			
            daftar_asn: [],
			form: {				
                RiwayatJabatanASNID:'',
                OrgID:'',
                OrgNm:'',
                ASNID:'',
                Jenis_Jabatan:'',
			}
		}
	},
	methods: 
    {	
        fetchASN ()
        {            
            axios.get('/api/v1/master/asnopd/create',{
                headers:{
                    'Authorization': window.laravel.api_token,
                }
            })
            .then(response => {     
                var daftar_asn = [];
                $.each(response.data.daftar_asn,function(key,value){
                    daftar_asn.push({
                        code:key,
                        label:value
                    });
                });                
                this.daftar_asn=daftar_asn;
                this.form.OrgNm=response.data.organisasi.OrgNm;                 
            })
            .catch(response => {
                this.api_message = response;
            });
        },
        fetchOPD ()
        {            
            axios.get('/api/v1/master/organisasi/daftaropd',{
                headers:{
                    'Authorization': window.laravel.api_token,
                }
            })
            .then(response => {     
                var daftar_opd = [];
                $.each(response.data,function(key,value){
                    daftar_opd.push({
                        code:key,
                        label:value
                    });
                });                
                this.daftar_opd=daftar_opd;                 
            })
            .catch(response => {
                this.api_message = response;
            });
        },
        search()
        {
            axios.post('/api/v1/master/asnopd/search',{
                    'cmbKriteria':this.cmbKriteria,
                    'txtKriteria':this.txtKriteria,
                    'action':'search',
                },{
                    headers:{
                        'Authorization': window.laravel.api_token,
                    },
                })
                .then(response => {      
                    this.$swal({
                        title: '<i class="fas fa-spin fa-spinner"></i>',
                        text: "Melakukan pencarian data ASN",
                        showCancelButton: false,
                        showConfirmButton: false,
                        showCloseButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                    });   
                    setTimeout(() => {
                        this.asnopd=response.data; 
                        this.daftar_asnopd = this.asnopd.daftar_asnopd;
                        if(typeof(this.asnopd.search) !== 'undefined' && this.asnopd.search !== null)
                        {
                            this.cmbKriteria = this.asnopd.search.kriteria;
                            this.txtKriteria = this.asnopd.search.isikriteria;
                        }   
                        this.$swal.close();
                    }, 1500);
                })
                .catch(error => {
                    this.api_message = error.response.data.message;
                });			   
        },       
        resetpencarian()
        {
            axios.post('/api/v1/master/asnopd/search',{
                    'action':'reset',
                },{
                    headers:{
                        'Authorization': window.laravel.api_token,
                    },
                })
                .then(response => {                          
                    this.asnopd=response.data; 
                    this.daftar_asnopd = this.asnopd.daftar_asnopd;                
                    this.cmbKriteria = 'Nm_ASN';
                    this.txtKriteria = '';                       
                })
                .catch(error => {
                    this.api_message = error.response.data.message;
                });			   
        },  
        filter ()
        {               
            axios.post('/api/v1/master/asnopd/filter',{
                    'OrgID':this.OrgID,
                },{
                    headers:{
                        'Authorization': window.laravel.api_token,
                    },
                })
                .then(response => {            
                    this.$swal({
                        title: '<i class="fas fa-spin fa-spinner"></i>',
                        text: "Melakukan filter data ASN berdasarkan OPD / SKPD",
                        showCancelButton: false,
                        showConfirmButton: false,
                        showCloseButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                    });  
                    setTimeout(() => {
                        this.asnopd=response.data; 
                        this.daftar_asnopd = this.asnopd.daftar_asnopd;
                        this.$swal.close();
                    },1500);
                })
                .catch(error => {
                    this.api_message = error.response.data.message;
                });	
            
        }, 
        populateData(page=1)
        {           
            axios.get('/api/v1/master/asnopd?page='+page,{
                headers:{
                    'Authorization': window.laravel.api_token,
                }
            })
            .then(response => {               
                this.asnopd=response.data; 
                this.OrgID=this.asnopd.filters.OrgID;
                this.daftar_asnopd = this.asnopd.daftar_asnopd;                           
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
                    if (this.OrgID == '')
                    {
                        this.pid = 'default'; 
                        this.$swal({
                            title: 'Pilih OPD',
                            text: "Mohon dipilih OPD / SKPD di Filter",
                            type: 'warning',
                        }).then(function() {
                            this.$swal.close();
                        });                       
                    }
                    else
                    {
                        this.pid = pid;  
                        this.fetchASN();     
                        this.form.OrgID=this.OrgID;             
                    }
                break;
                case 'show' :
                    this.pid = pid;
                    this.asnopd.detail = item;
                break;
                case 'edit' :
                    this.pid = pid;
                    this.form.ASNID=item.ASNID;                   
                    this.form.NIP_ASN=item.NIP_ASN;
                    this.form.Nm_ASN=item.Nm_ASN;
                    this.form.Descr=item.Descr;
                break;
                case 'destroy':
                    var self = this;
                    this.$swal({
                        title: 'Yakin mau menghapus?',
                        text: "Anda tidak bisa mengembalikan data ini",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus ini!',
                        cancelButtonText: 'Tidak, Batalkan!',
                        buttonsStyling: true
                    }).then(function (isConfirm){
                        if(isConfirm.value === true) 
                        {
                            axios.post('/api/v1/master/asnopd/'+item.RiwayatJabatanASNID,{
                                '_method':'DELETE',
                            },{
                                headers:{
                                    'Authorization': window.laravel.api_token,
                                },
                            })
                            .then(response => {                                                          
                                self.proc('default');                                                                    
                            })
                            .catch(response => {
                                self.api_message = response;                               
                            });                                  
                        }
                    });     
                                 
                break;
                default :
                    this.pid = pid;
                    this.fetchOPD();       
                    this.populateData();
                    this.clearform();
            }
        },
		saveData() 
		{	
			this.$v.form.$touch();
            if(this.$v.$invalid == false)
            { 
				axios.post('/api/v1/master/asnopd',{
                    'OrgID':this.form.OrgID,
                    'ASNID':this.form.ASNID,
                    'Jenis_Jabatan':this.form.Jenis_Jabatan,
                },{
                    headers:{
                        'Authorization': window.laravel.api_token,
                    },
                })
                .then(response => {                          
                    this.$swal({
                        title: '<i class="fas fa-spin fa-spinner"></i>',
                        text: "Menyimpan Data ASN ke OPD berhasil dilakukan",
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
                        this.proc('default');    
                    }, 1500);             
                })
                .catch(error => {
                    this.api_message = error.response.data.message;
                });			
			}
        },        
        clearform ()
        {
            this.form.ASNID='';
            this.form.Jenis_Jabatan='';           
        },
	},
	validations: {
		form: {
			ASNID: {
				required
			},			
			Jenis_Jabatan: {
				required
			},			
		}
	},
	components: 
	{
        'pagination': Pagination,
        'v-select': vSelect,
    }
}
</script>