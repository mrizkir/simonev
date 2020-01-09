<template>
<div class="content-wrapper">
	<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark">
                        <i class="nav-icon fas fa-money-check-alt"></i>
                        RINCIAN
                    </h1>
                </div>
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><router-link to="/">HOME</router-link></li>
                        <li class="breadcrumb-item">MASTER</li>
                        <li class="breadcrumb-item">REKENING</li>
                        <li class="breadcrumb-item active">RINCIAN</li>
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
                                <i class="fas fa-plus"></i> Tambah Rincian
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
                                    <label class="col-sm-3 col-form-label">JENIS</label>
                                    <div class="col-sm-9" id="divJnsID">
                                        <v-select 
                                            v-model="form.JnsID" 
                                            placeholder="PILIH JENIS" 
                                            :options="daftar_jenis" 
                                            :reduce="daftar_jenis => daftar_jenis.code">
                                        </v-select>
                                        <div class="text-danger" v-if="!$v.form.JnsID.required">* wajib dipilih</div>
                                    </div>
                                </div>
								<div class="form-group row">
                                    <label class="col-sm-3 col-form-label">KODE RINCIAN</label>
                                    <div class="col-sm-9">
										<vue-autonumeric 
											v-model.trim="form.Kd_Rek_4" 
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
											v-bind:class="{'is-invalid': $v.form.Kd_Rek_4.$error, 'is-valid': $v.form.Kd_Rek_4.$dirty && !$v.form.Kd_Rek_4.$invalid}">
										</vue-autonumeric>
										<div class="text-danger" v-if="$v.form.Kd_Rek_4.$error">* wajib isi</div>
                                    </div>
								 </div>								
								<div class="form-group row">
                                    <label class="col-sm-3 col-form-label">NAMA RINCIAN</label>
                                    <div class="col-sm-9">
										<input type="text" v-model="form.ObyNm" class="form-control" v-bind:class="{'is-invalid': $v.form.ObyNm.$error, 'is-valid': $v.form.ObyNm.$dirty && !$v.form.ObyNm.$invalid}">
										<div class="text-danger" v-if="$v.form.ObyNm.$error">* wajib isi</div>
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
                                <i class="fas fa-plus"></i> Ubah Rincian
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
                                    <label class="col-sm-3 col-form-label">JENIS</label>
                                    <div class="col-sm-9" id="divJnsID">
                                        <v-select 
                                            v-model="form.JnsID" 
                                            placeholder="PILIH JENIS" 
                                            :options="daftar_jenis" 
                                            :reduce="daftar_jenis => daftar_jenis.code">
                                        </v-select>
                                        <div class="text-danger" v-if="!$v.form.JnsID.required">* wajib dipilih</div>
                                    </div>
                                </div>                       
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">KODE RINCIAN</label>
                                    <div class="col-sm-9">
										<vue-autonumeric 
											v-model.trim="form.Kd_Rek_4" 
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
											v-bind:class="{'is-invalid': $v.form.Kd_Rek_4.$error, 'is-valid': $v.form.Kd_Rek_4.$dirty && !$v.form.Kd_Rek_4.$invalid}">
										</vue-autonumeric>
										<div class="text-danger" v-if="$v.form.Kd_Rek_4.$error">* wajib isi</div>
                                    </div>
								 </div>								
								<div class="form-group row">
                                    <label class="col-sm-3 col-form-label">NAMA RINCIAN</label>
                                    <div class="col-sm-9">
										<input type="text" v-model="form.ObyNm" class="form-control" v-bind:class="{'is-invalid': $v.form.ObyNm.$error, 'is-valid': $v.form.ObyNm.$dirty && !$v.form.ObyNm.$invalid}">
										<div class="text-danger" v-if="$v.form.ObyNm.$error">* wajib isi</div>
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
                            <h3 class="card-title"><i class="fas fa-eye"></i> DETAIL RINCIAN</h3>
                            <div class="card-tools">                                 
                                <button type="button" class="btn btn-tool" v-on:click.prevent="proc('create',null)">
                                    <i class="fas fa-plus"></i>
                                </button>                                
                                <button type="button" class="btn btn-tool" v-on:click.prevent="proc('edit',rincian.detail)">
                                    <i class="fas fa-edit"></i>
                                </button>                                
                                <button type="button" class="btn btn-tool text-danger" v-on:click.prevent="proc('destroy',rincian.detail)">
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
                                                <p class="form-control-static">{{rincian.detail.JnsID}}</p>
                                            </div>                            
                                        </div>  
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label"><strong>KODE RINCIAN: </strong></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{rincian.detail.kode_rek4}}</p>
                                            </div>                            
                                        </div>                          
                                        
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label"><strong>NAMA RINCIAN: </strong></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{rincian.detail.ObyNm}}</p>
                                            </div>                            
                                        </div>
                                    </div>      
                                </div>
                                <div class="col-md-6">
                                    <div class="form-horizontal">
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label"><strong>KETERANGAN: </strong></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{rincian.detail.Descr}}</p>
                                            </div>                            
                                        </div> 
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label"><strong>DI BUAT: </strong></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{rincian.detail.created_at|formatTanggal}}</p>
                                            </div>                            
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label"><strong>DI UBAH: </strong></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{rincian.detail.updated_at|formatTanggal}}</p>
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
                                            <option value="kode_rek4" :selected="cmbKriteria=='kode_rek4'">KODE RINCIAN</option>
                                            <option value="ObyNm" :selected="cmbKriteria=='ObyNm'">NAMA RINCIAN</option>
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
                        <div class="card-body table-responsive p-0" v-if="daftar_rincian.data.length">
                            <table class="table table-striped table-hover mb-2">
                                <thead>
                                    <tr>
                                        <th width="55">NO</th>
                                        <th width="150">
                                            KODE RINCIAN
                                        </th> 
                                        <th>
                                            NAMA RINCIAN
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
                                    <tr v-for="(item,index) in daftar_rincian.data" v-bind:key="item.ObyID">
                                        <td>{{daftar_rincian.from+index}}</td>
                                        <td>{{item.kode_rek4}}</td>
                                        <td>{{item.ObyNm}}</td>    
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
                        <div class="card-footer" v-if="daftar_rincian.data.length">                            
                            <pagination :data="daftar_rincian" @pagination-change-page="populateData" align="center" :show-disabled="true" :limit="8">
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
import VueAutonumeric from 'vue-autonumeric';

export default {
	mounted()
	{
        window.$('#liDMaster').addClass('menu-open');
        window.$('#linkDMaster').addClass('active');        
		this.proc ('default');   
	},
	data: function() 
	{
		return {
            pid:'default',
            rincian:{
                kriteria:'',
                isikriteria:'',
                detail:null
            },
            daftar_rincian:{
                data:{}
            }, 
            api_message:'',           

            //field form search
            cmbKriteria:'ObyNm',
            txtKriteria:'',

            //form			
            daftar_jenis:{},
			form: {		
                ObyID:'',
                JnsID:'',		                                
                Kd_Rek_4: '',
                ObyNm: '',				
				Descr:'',
			}
		}
	},
	methods: 
    {	
        fetchJenis ()
        {            
            axios.get('/api/v1/master/rincian/create',{
                headers:{
                    'Authorization': window.laravel.api_token,
                }
            })
            .then(response => {             
                var daftar_jenis = [];
                $.each(response.data,function(key,value){
                    daftar_jenis.push({
                        code:key,
                        label:value
                    });
                });                
                this.daftar_jenis=daftar_jenis;                 
            })
            .catch(response => {
                this.api_message = response;
            });
        },
        search()
        {
            axios.post('/api/v1/master/rincian/search',{
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
                        text: "Melakukan pencarian data Rekening Rincian",
                        showCancelButton: false,
                        showConfirmButton: false,
                        showCloseButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                    });              
                    setTimeout(() => {
                        this.rincian=response.data; 
                        this.daftar_rincian = this.rincian.daftar_rincian;
                        if(typeof(this.rincian.search) !== 'undefined' && this.rincian.search !== null)
                        {
                            this.cmbKriteria = this.rincian.search.kriteria;
                            this.txtKriteria = this.rincian.search.isikriteria;
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
            axios.post('/api/v1/master/rincian/search',{
                    'action':'reset',
                },{
                    headers:{
                        'Authorization': window.laravel.api_token,
                    },
                })
                .then(response => {                 
                    this.$swal({
                        title: '<i class="fas fa-spin fa-spinner"></i>',
                        text: "Reset pencarian data Rekening Rincian",
                        showCancelButton: false,
                        showConfirmButton: false,
                        showCloseButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                    });              
                    setTimeout(() => {
                        this.rincian=response.data; 
                        this.daftar_rincian = this.rincian.daftar_rincian;                
                        this.cmbKriteria = 'ObyNm';
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
            axios.get('/api/v1/master/rincian?page='+page,{
                headers:{
                    'Authorization': window.laravel.api_token,
                }
            })
            .then(response => {                                        
                this.rincian=response.data; 
                this.daftar_rincian = this.rincian.daftar_rincian;    
                 if(typeof(this.rincian.search) !== 'undefined' && this.rincian.search !== null)
                {
                    this.cmbKriteria = this.rincian.search.kriteria;
                    this.txtKriteria = this.rincian.search.isikriteria;
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
                    this.fetchJenis();                
                break;
                case 'show' :
                    this.pid = pid;
                    this.rincian.detail = item;
                break;
                case 'edit' :
                    this.pid = pid;
                    this.fetchJenis();
                    this.form.ObyID=item.ObyID;                   
                    this.form.JnsID=item.JnsID;                                       
                    this.form.Kd_Rek_4=item.Kd_Rek_4;
                    this.form.ObyNm=item.ObyNm;
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
                            axios.post('/api/v1/master/rincian/'+item.ObyID,{
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
				axios.post('/api/v1/master/rincian',{
                    'JnsID':this.form.JnsID,
                    'Kd_Rek_4':this.form.Kd_Rek_4,
                    'ObyNm':this.form.ObyNm,
                    'Descr':this.form.Descr,
                },{
                    headers:{
                        'Authorization': window.laravel.api_token,
                    },
                })
                .then(response => {                          
                    this.$swal({
                        title: '<i class="fas fa-spin fa-spinner"></i>',
                        text: "Menyimpan Data Rincian berhasil dilakukan",
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
                axios.post('/api/v1/master/rincian/'+this.form.ObyID,{
                    '_method':'PUT',
                    'JnsID':this.form.JnsID,
                    'Kd_Rek_4':this.form.Kd_Rek_4,
                    'ObyNm':this.form.ObyNm,
                    'Descr':this.form.Descr,
                },{
                    headers:{
                        'Authorization': window.laravel.api_token,
                    },
                })
                .then(response => {                          
                    this.$swal({
                        title: '<i class="fas fa-spin fa-spinner"></i>',
                        text: "Mengubah Data Rincian berhasil dilakukan",
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
            this.ObyID='';
            this.JnsID='';            
            this.form.Kd_Rek_4='';
            this.form.ObyNm='';           
            this.form.Descr='';           
        },
	},
	validations: {
		form: {
            JnsID: {
				required
			},
			Kd_Rek_4: {
				required
			},
			ObyNm: {
				required
			},			
		}
	},
	components: 
	{
        'pagination': Pagination,
        'v-select': vSelect,
        'vue-autonumeric':VueAutonumeric,
    }
}
</script>