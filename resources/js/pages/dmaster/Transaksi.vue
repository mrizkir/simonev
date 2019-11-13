<template>
<div class="content-wrapper">
	<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <i class="nav-icon fas fa-money-check-alt"></i>
                        TRANSAKSI
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><router-link to="/">HOME</router-link></li>
                        <li class="breadcrumb-item">MASTER</li>
                        <li class="breadcrumb-item">REKENING</li>
                        <li class="breadcrumb-item active">TRANSAKSI</li>
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
                                <i class="fas fa-plus"></i> Tambah Transaksi
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
                                    <label class="col-sm-3 col-form-label">KODE TRANSAKSI</label>
                                    <div class="col-sm-9">
										<vue-autonumeric 
											v-model.trim="form.Kd_Rek_1" 
											v-on:input="$v.form.$touch"
											:options="{
												allowDecimalPadding: false,
                                                minimumValue:0,
                                                maximumValue:2,
                                                numericPos:true,
                                                decimalPlaces : 0,
                                                digitGroupSeparator : '',
                                                showWarnings:false,
                                                unformatOnSubmit: true,
                                                modifyValueOnWheel:false
											}" 
											class="form-control" 
											v-bind:class="{'is-invalid': $v.form.Kd_Rek_1.$error, 'is-valid': $v.form.Kd_Rek_1.$dirty && !$v.form.Kd_Rek_1.$invalid}">
										</vue-autonumeric>
										<div class="text-danger" v-if="$v.form.Kd_Rek_1.$error">* wajib isi</div>
                                    </div>
								 </div>								
								<div class="form-group row">
                                    <label class="col-sm-3 col-form-label">NAMA TRANSAKSI</label>
                                    <div class="col-sm-9">
										<input type="text" v-model="form.StrNm" class="form-control" v-bind:class="{'is-invalid': $v.form.StrNm.$error, 'is-valid': $v.form.StrNm.$dirty && !$v.form.StrNm.$invalid}">
										<div class="text-danger" v-if="$v.form.StrNm.$error">* wajib isi</div>
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
                                <i class="fas fa-plus"></i> Ubah Transaksi
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
                                    <label class="col-sm-3 col-form-label">KODE TRANSAKSI</label>
                                    <div class="col-sm-9">
										<vue-autonumeric 
											v-model.trim="form.Kd_Rek_1" 
											v-on:input="$v.form.$touch"
											:options="{
												allowDecimalPadding: false,
                                                minimumValue:0,
                                                maximumValue:99999999999,
                                                numericPos:true,
                                                decimalPlaces : 0,
                                                digitGroupSeparator : '',
                                                showWarnings:false,
                                                unformatOnSubmit: true,
                                                modifyValueOnWheel:false
											}" 
											class="form-control" 
											v-bind:class="{'is-invalid': $v.form.Kd_Rek_1.$error, 'is-valid': $v.form.Kd_Rek_1.$dirty && !$v.form.Kd_Rek_1.$invalid}">
										</vue-autonumeric>
										<div class="text-danger" v-if="$v.form.Kd_Rek_1.$error">* wajib isi</div>
                                    </div>
								 </div>								
								<div class="form-group row">
                                    <label class="col-sm-3 col-form-label">NAMA TRANSAKSI</label>
                                    <div class="col-sm-9">
										<input type="text" v-model="form.StrNm" class="form-control" v-bind:class="{'is-invalid': $v.form.StrNm.$error, 'is-valid': $v.form.StrNm.$dirty && !$v.form.StrNm.$invalid}">
										<div class="text-danger" v-if="$v.form.StrNm.$error">* wajib isi</div>
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
                            <h3 class="card-title"><i class="fas fa-eye"></i> DETAIL TRANSAKSI</h3>
                            <div class="card-tools">                                 
                                <button type="button" class="btn btn-tool" v-on:click.prevent="proc('create',null)">
                                    <i class="fas fa-plus"></i>
                                </button>                                
                                <button type="button" class="btn btn-tool" v-on:click.prevent="proc('edit',transaksi.detail)">
                                    <i class="fas fa-edit"></i>
                                </button>                                
                                <button type="button" class="btn btn-tool text-danger" v-on:click.prevent="proc('destroy',transaksi.detail)">
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
                                                <p class="form-control-static">{{transaksi.detail.StrID}}</p>
                                            </div>                            
                                        </div>  
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label"><strong>KODE TRANSAKSI: </strong></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{transaksi.detail.Kd_Rek_1}}</p>
                                            </div>                            
                                        </div>                          
                                        
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label"><strong>NAMA TRANSAKSI: </strong></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{transaksi.detail.StrNm}}</p>
                                            </div>                            
                                        </div>
                                    </div>      
                                </div>
                                <div class="col-md-6">
                                    <div class="form-horizontal">
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label"><strong>KETERANGAN: </strong></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{transaksi.detail.Descr}}</p>
                                            </div>                            
                                        </div> 
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label"><strong>DI BUAT: </strong></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{transaksi.detail.created_at|formatTanggal}}</p>
                                            </div>                            
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label"><strong>DI UBAH: </strong></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{transaksi.detail.updated_at|formatTanggal}}</p>
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
                            <h3 class="card-title"></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" v-on:click.prevent="proc('create')">
                                    <i class="fas fa-plus"></i>
                                </button>                                
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0" v-if="daftar_transaksi.data.length">
                            <table class="table table-striped table-hover mb-2">
                                <thead>
                                    <tr>
                                        <th width="55">NO</th>
                                        <th width="150">
                                            KODE TRANSAKSI
                                        </th> 
                                        <th>
                                            NAMA TRANSAKSI
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
                                    <tr v-for="(item,index) in daftar_transaksi.data" v-bind:key="item.StrID">
                                        <td>{{daftar_transaksi.from+index}}</td>
                                        <td>{{item.Kd_Rek_1}}</td>
                                        <td>{{item.StrNm}}</td>    
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
                        <div class="card-footer" v-if="daftar_transaksi.data.length">                            
                            <pagination :data="daftar_transaksi" @pagination-change-page="populateData" align="center" :show-disabled="true" :limit="8">
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
            transaksi:{
                kriteria:'',
                isikriteria:'',
                detail:null
            },
            daftar_transaksi:{
                data:{}
            }, 
            api_message:'',           
       
            //form			
			form: {				
                StrID:'',
                Kd_Rek_1: '',
                StrNm: '',				
				Descr:'',
			}
		}
	},
	methods: 
    {	
        populateData(page=1)
        {           
            axios.get('/api/v1/master/transaksi?page='+page,{
                headers:{
                    'Authorization': window.laravel.api_token,
                }
            })
            .then(response => {                                        
                this.transaksi=response.data; 
                this.daftar_transaksi = this.transaksi.daftar_transaksi;                           
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
                break;
                case 'show' :
                    this.pid = pid;
                    this.transaksi.detail = item;
                break;
                case 'edit' :
                    this.pid = pid;
                    this.form.StrID=item.StrID;                   
                    this.form.Kd_Rek_1=item.Kd_Rek_1;
                    this.form.StrNm=item.StrNm;
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
                            axios.post('/api/v1/master/transaksi/'+item.StrID,{
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
				axios.post('/api/v1/master/transaksi',{
                    'Kd_Rek_1':this.form.Kd_Rek_1,
                    'StrNm':this.form.StrNm,
                    'Descr':this.form.Descr,
                },{
                    headers:{
                        'Authorization': window.laravel.api_token,
                    },
                })
                .then(response => {                          
                    this.$swal({
                        title: '<i class="fas fa-spin fa-spinner"></i>',
                        text: "Menyimpan Data Transaksi berhasil dilakukan",
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
                axios.post('/api/v1/master/transaksi/'+this.form.StrID,{
                    '_method':'PUT',
                    'Kd_Rek_1':this.form.Kd_Rek_1,
                    'StrNm':this.form.StrNm,
                    'Descr':this.form.Descr,
                },{
                    headers:{
                        'Authorization': window.laravel.api_token,
                    },
                })
                .then(response => {                          
                    this.$swal({
                        title: '<i class="fas fa-spin fa-spinner"></i>',
                        text: "Mengubah Data Transaksi berhasil dilakukan",
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
            this.StrID='';
            this.form.Kd_Rek_1='';
            this.form.StrNm='';           
            this.form.Descr='';           
        },
	},
	validations: {
		form: {
			Kd_Rek_1: {
				required
			},
			StrNm: {
				required
			},			
		}
	},
	components: 
	{
        'pagination': Pagination,
        'vue-autonumeric':VueAutonumeric,
    }
}
</script>