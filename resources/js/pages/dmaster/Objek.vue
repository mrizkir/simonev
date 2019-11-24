<template>
<div class="content-wrapper">
	<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <i class="nav-icon fas fa-money-check-alt"></i>
                        OBJEK
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><router-link to="/">HOME</router-link></li>
                        <li class="breadcrumb-item">MASTER</li>
                        <li class="breadcrumb-item">REKENING</li>
                        <li class="breadcrumb-item active">OBJEK</li>
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
                                <i class="fas fa-plus"></i> Tambah Objek
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
                                    <label class="col-sm-3 col-form-label">RINCIAN</label>
                                    <div class="col-sm-9" id="divObyID">
                                        <select2 
                                            id="ObyID" 
                                            name="ObyID" 
                                            v-model="form.ObyID" 
                                            :options="daftar_rincian" 
                                            :settings="{
                                                theme:'bootstrap',
                                                placeholder:'PILIH RINCIAN'
                                            }">
                                        </select2>
                                        <div class="text-danger" v-if="!$v.form.ObyID.required">* wajib dipilih</div>
                                    </div>
                                </div>
								<div class="form-group row">
                                    <label class="col-sm-3 col-form-label">KODE OBJEK</label>
                                    <div class="col-sm-9">
										<vue-autonumeric 
											v-model.trim="form.Kd_Rek_5" 
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
											v-bind:class="{'is-invalid': $v.form.Kd_Rek_5.$error, 'is-valid': $v.form.Kd_Rek_5.$dirty && !$v.form.Kd_Rek_5.$invalid}">
										</vue-autonumeric>
										<div class="text-danger" v-if="$v.form.Kd_Rek_5.$error">* wajib isi</div>
                                    </div>
								 </div>								
								<div class="form-group row">
                                    <label class="col-sm-3 col-form-label">NAMA OBJEK</label>
                                    <div class="col-sm-9">
										<input type="text" v-model="form.RObyNm" class="form-control" v-bind:class="{'is-invalid': $v.form.RObyNm.$error, 'is-valid': $v.form.RObyNm.$dirty && !$v.form.RObyNm.$invalid}">
										<div class="text-danger" v-if="$v.form.RObyNm.$error">* wajib isi</div>
                                    </div>
								</div>
								<div class="form-group row">
                                    <label class="col-sm-3 col-form-label">KETERANGAN</label>
                                    <div class="col-sm-9">
                                        <textarea type="text" name="Descr" id="Descr" v-model="form.Descr" class="form-control" row="4">
                                        </textarea>
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
            <div class="row" v-if="pid=='edit'">
                <div class="col-12">
                    <!-- Horizontal Form -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-plus"></i> Ubah Objek
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" v-on:click.prevent="proc('default',null)">
                                    <i class="fas fa-times"></i>
                                </button>                                
                            </div>
                        </div>
                        <form class="form-horizontal" @submit.prevent="updateData">
                            <div class="card-body">         
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">RINCIAN</label>
                                    <div class="col-sm-9" id="divObyID">
                                        <select2 
                                            id="ObyID" 
                                            name="ObyID" 
                                            v-model="form.ObyID" 
                                            :options="daftar_rincian" 
                                            :settings="{
                                                theme:'bootstrap',
                                                placeholder:'PILIH RINCIAN'
                                            }">
                                        </select2>
                                        <div class="text-danger" v-if="!$v.form.ObyID.required">* wajib dipilih</div>
                                    </div>
                                </div>                       
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">KODE OBJEK</label>
                                    <div class="col-sm-9">
										<vue-autonumeric 
											v-model.trim="form.Kd_Rek_5" 
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
											v-bind:class="{'is-invalid': $v.form.Kd_Rek_5.$error, 'is-valid': $v.form.Kd_Rek_5.$dirty && !$v.form.Kd_Rek_5.$invalid}">
										</vue-autonumeric>
										<div class="text-danger" v-if="$v.form.Kd_Rek_5.$error">* wajib isi</div>
                                    </div>
								 </div>								
								<div class="form-group row">
                                    <label class="col-sm-3 col-form-label">NAMA OBJEK</label>
                                    <div class="col-sm-9">
										<input type="text" v-model="form.RObyNm" class="form-control" v-bind:class="{'is-invalid': $v.form.RObyNm.$error, 'is-valid': $v.form.RObyNm.$dirty && !$v.form.RObyNm.$invalid}">
										<div class="text-danger" v-if="$v.form.RObyNm.$error">* wajib isi</div>
                                    </div>
								</div>
								<div class="form-group row">
                                    <label class="col-sm-3 col-form-label">KETERANGAN</label>
                                    <div class="col-sm-9">
                                        <textarea type="text" name="Descr" id="Descr" v-model="form.Descr" class="form-control" row="4">
                                        </textarea>
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
            <div class="row" v-if="pid=='show'">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-eye"></i> DETAIL OBJEK</h3>
                            <div class="card-tools">                                 
                                <button type="button" class="btn btn-tool" v-on:click.prevent="proc('create',null)">
                                    <i class="fas fa-plus"></i>
                                </button>                                
                                <button type="button" class="btn btn-tool" v-on:click.prevent="proc('edit',objek.detail)">
                                    <i class="fas fa-edit"></i>
                                </button>                                
                                <button type="button" class="btn btn-tool text-danger" v-on:click.prevent="proc('destroy',objek.detail)">
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
                                                <p class="form-control-static">{{objek.detail.ObyID}}</p>
                                            </div>                            
                                        </div>  
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label"><strong>KODE OBJEK: </strong></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{objek.detail.kode_rek5}}</p>
                                            </div>                            
                                        </div>                          
                                        
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label"><strong>NAMA OBJEK: </strong></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{objek.detail.RObyNm}}</p>
                                            </div>                            
                                        </div>
                                    </div>      
                                </div>
                                <div class="col-md-6">
                                    <div class="form-horizontal">
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label"><strong>KETERANGAN: </strong></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{objek.detail.Descr}}</p>
                                            </div>                            
                                        </div> 
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label"><strong>DI BUAT: </strong></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{objek.detail.created_at|formatTanggal}}</p>
                                            </div>                            
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label"><strong>DI UBAH: </strong></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{objek.detail.updated_at|formatTanggal}}</p>
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
                            <h3 class="card-title"><i class="fas fa-search"></i> PENCARIAN</h3>                            
                        </div>
                        <form class="form-horizontal" @submit.prevent="search">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">KRITERIA</label>
                                    <div class="col-sm-10">
                                        <select name="cmbKriteria" id="cmbKriteria" class="form-control" v-model="cmbKriteria">
                                            <option value="kode_rek5" :selected="cmbKriteria=='kode_rek5'">KODE OBJEK</option>
                                            <option value="RObyNm" :selected="cmbKriteria=='RObyNm'">NAMA OBJEK</option>
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
                        <div class="card-body table-responsive p-0" v-if="daftar_objek.data.length">
                            <table class="table table-striped table-hover mb-2">
                                <thead>
                                    <tr>
                                        <th width="55">NO</th>
                                        <th width="150">
                                            KODE OBJEK
                                        </th> 
                                        <th>
                                            NAMA OBJEK
                                        </th> 
                                        <th width="100">
                                            KET.  
                                        </th>                                       
                                        <th width="100">
                                            TA  
                                        </th>                                       
                                        <th width="100">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>  
                                    <tr v-for="(item,index) in daftar_objek.data" v-bind:key="item.RObyID">
                                        <td>{{daftar_objek.from+index}}</td>
                                        <td>{{item.kode_rek5}}</td>
                                        <td>{{item.RObyNm}}</td>    
                                        <td>{{item.Descr}}</td>
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
                                                    <a class="dropdown-item" href="#" v-on:click.prevent="proc('edit',item)">
                                                        <i class="fas fa-edit"></i> UBAH
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
                        <div class="card-footer" v-if="daftar_objek.data.length">                            
                            <pagination :data="daftar_objek" @pagination-change-page="populateData" align="center" :show-disabled="true" :limit="8">
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
import Select2 from 'v-select2-component';
import VueAutonumeric from 'vue-autonumeric';

export default {
	mounted()
	{
		this.proc ('default');   
	},
	data: function() 
	{
		return {
            pid:'default',
            objek:{
                kriteria:'',
                isikriteria:'',
                detail:null
            },
            daftar_objek:{
                data:{}
            }, 
            api_message:'',           

            //field form search
            cmbKriteria:'RObyNm',
            txtKriteria:'',

            //form			
            daftar_rincian: [{id:'',text:'PILIH RINCIAN'}],
			form: {		
                RObyID:'',
                ObyID:'',		                                
                Kd_Rek_5: '',
                RObyNm: '',				
				Descr:'',
			}
		}
	},
	methods: 
    {	
        fetchObjek ()
        {            
            axios.get('/api/v1/master/objek/create',{
                headers:{
                    'Authorization': window.laravel.api_token,
                }
            })
            .then(response => {             
                var daftar_rincian = [];
                $.each(response.data,function(key,value){
                    daftar_rincian.push({
                        id:key,
                        text:value
                    });
                });                
                this.daftar_rincian=daftar_rincian;                 
            })
            .catch(response => {
                this.api_message = response;
            });
        },
        search()
        {
            axios.post('/api/v1/master/objek/search',{
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
                        text: "Melakukan pencarian data Rekening Objek",
                        showCancelButton: false,
                        showConfirmButton: false,
                        showCloseButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                    });              
                    setTimeout(() => {
                        this.objek=response.data; 
                        this.daftar_objek = this.objek.daftar_objek;
                        if(typeof(this.objek.search) !== 'undefined' && this.objek.search !== null)
                        {
                            this.cmbKriteria = this.objek.search.kriteria;
                            this.txtKriteria = this.objek.search.isikriteria;
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
            axios.post('/api/v1/master/objek/search',{
                    'action':'reset',
                },{
                    headers:{
                        'Authorization': window.laravel.api_token,
                    },
                })
                .then(response => {                 
                    this.$swal({
                        title: '<i class="fas fa-spin fa-spinner"></i>',
                        text: "Reset pencarian data Rekening Objek",
                        showCancelButton: false,
                        showConfirmButton: false,
                        showCloseButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                    });              
                    setTimeout(() => {
                        this.objek=response.data; 
                        this.daftar_objek = this.objek.daftar_objek;                
                        this.cmbKriteria = 'RObyNm';
                        this.txtKriteria = '';      
                        this.$swal.close();
                    }, 1500);                                              
                })
                .catch(error => {
                    this.api_message = error.response.data.message;
                });			   
        },
        populateData(page=1)
        {           
            axios.get('/api/v1/master/objek?page='+page,{
                headers:{
                    'Authorization': window.laravel.api_token,
                }
            })
            .then(response => {                                        
                this.objek=response.data; 
                this.daftar_objek = this.objek.daftar_objek;    
                 if(typeof(this.objek.search) !== 'undefined' && this.objek.search !== null)
                {
                    this.cmbKriteria = this.objek.search.kriteria;
                    this.txtKriteria = this.objek.search.isikriteria;
                }                          
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
                    this.fetchObjek();                
                break;
                case 'show' :
                    this.pid = pid;
                    this.objek.detail = item;
                break;
                case 'edit' :
                    this.pid = pid;
                    this.fetchObjek();
                    this.form.RObyID=item.RObyID;                   
                    this.form.ObyID=item.ObyID;                                       
                    this.form.Kd_Rek_5=item.Kd_Rek_5;
                    this.form.RObyNm=item.RObyNm;
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
                            axios.post('/api/v1/master/objek/'+item.RObyID,{
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
                    this.populateData();
                    this.clearform();
            }
        },
		saveData() 
		{	
			this.$v.form.$touch();
            if(this.$v.$invalid == false)
            { 
				axios.post('/api/v1/master/objek',{
                    'ObyID':this.form.ObyID,
                    'Kd_Rek_5':this.form.Kd_Rek_5,
                    'RObyNm':this.form.RObyNm,
                    'Descr':this.form.Descr,
                },{
                    headers:{
                        'Authorization': window.laravel.api_token,
                    },
                })
                .then(response => {                          
                    this.$swal({
                        title: '<i class="fas fa-spin fa-spinner"></i>',
                        text: "Menyimpan Data Objek berhasil dilakukan",
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
        updateData() 
		{
            this.$v.form.$touch();
            if(this.$v.$invalid == false)
            { 
                axios.post('/api/v1/master/objek/'+this.form.RObyID,{
                    '_method':'PUT',
                    'ObyID':this.form.ObyID,
                    'Kd_Rek_5':this.form.Kd_Rek_5,
                    'RObyNm':this.form.RObyNm,
                    'Descr':this.form.Descr,
                },{
                    headers:{
                        'Authorization': window.laravel.api_token,
                    },
                })
                .then(response => {                          
                    this.$swal({
                        title: '<i class="fas fa-spin fa-spinner"></i>',
                        text: "Mengubah Data Objek berhasil dilakukan",
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
            this.RObyID='';
            this.ObyID='';            
            this.form.Kd_Rek_5='';
            this.form.RObyNm='';           
            this.form.Descr='';           
        },
	},
	validations: {
		form: {
            ObyID: {
				required
			},
			Kd_Rek_5: {
				required
			},
			RObyNm: {
				required
			},			
		}
	},
	components: 
	{
        'pagination': Pagination,
        'select2':Select2,
        'vue-autonumeric':VueAutonumeric,
    }
}
</script>