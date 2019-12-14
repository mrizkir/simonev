<template>
<div class="content-wrapper">
	<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <i class="nav-icon fas fa-money-check-alt"></i>
                        KELOMPOK
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><router-link to="/">HOME</router-link></li>
                        <li class="breadcrumb-item">MASTER</li>
                        <li class="breadcrumb-item">REKENING</li>
                        <li class="breadcrumb-item active">KELOMPOK</li>
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
                                <i class="fas fa-plus"></i> Tambah Kelompok
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
                                    <label class="col-sm-3 col-form-label">TRANSAKSI</label>
                                    <div class="col-sm-9" id="divStrID">
                                        <v-select 
                                            v-model="form.StrID" 
                                            placeholder="PILIH TRANSAKSI" 
                                            :options="daftar_transaksi" 
                                            :reduce="daftar_transaksi => daftar_transaksi.code">
                                        </v-select>
                                        <div class="text-danger" v-if="!$v.form.StrID.required">* wajib dipilih</div>
                                    </div>
                                </div>
								<div class="form-group row">
                                    <label class="col-sm-3 col-form-label">KODE KELOMPOK</label>
                                    <div class="col-sm-9">
										<vue-autonumeric 
											v-model.trim="form.Kd_Rek_2" 
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
											v-bind:class="{'is-invalid': $v.form.Kd_Rek_2.$error, 'is-valid': $v.form.Kd_Rek_2.$dirty && !$v.form.Kd_Rek_2.$invalid}">
										</vue-autonumeric>
										<div class="text-danger" v-if="$v.form.Kd_Rek_2.$error">* wajib isi</div>
                                    </div>
								 </div>								
								<div class="form-group row">
                                    <label class="col-sm-3 col-form-label">NAMA KELOMPOK</label>
                                    <div class="col-sm-9">
										<input type="text" v-model="form.KlpNm" class="form-control" v-bind:class="{'is-invalid': $v.form.KlpNm.$error, 'is-valid': $v.form.KlpNm.$dirty && !$v.form.KlpNm.$invalid}">
										<div class="text-danger" v-if="$v.form.KlpNm.$error">* wajib isi</div>
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
                                <i class="fas fa-plus"></i> Ubah Kelompok
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
                                    <label class="col-sm-3 col-form-label">TRANSAKSI</label>
                                    <div class="col-sm-9" id="divStrID">                                        
                                        <v-select 
                                            v-model="form.StrID" 
                                            placeholder="PILIH TRANSAKSI" 
                                            :options="daftar_transaksi" 
                                            :reduce="daftar_transaksi => daftar_transaksi.code">
                                        </v-select>
                                        <div class="text-danger" v-if="!$v.form.StrID.required">* wajib dipilih</div>
                                    </div>
                                </div>                       
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">KODE KELOMPOK</label>
                                    <div class="col-sm-9">
										<vue-autonumeric 
											v-model.trim="form.Kd_Rek_2" 
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
											v-bind:class="{'is-invalid': $v.form.Kd_Rek_2.$error, 'is-valid': $v.form.Kd_Rek_2.$dirty && !$v.form.Kd_Rek_2.$invalid}">
										</vue-autonumeric>
										<div class="text-danger" v-if="$v.form.Kd_Rek_2.$error">* wajib isi</div>
                                    </div>
								 </div>								
								<div class="form-group row">
                                    <label class="col-sm-3 col-form-label">NAMA KELOMPOK</label>
                                    <div class="col-sm-9">
										<input type="text" v-model="form.KlpNm" class="form-control" v-bind:class="{'is-invalid': $v.form.KlpNm.$error, 'is-valid': $v.form.KlpNm.$dirty && !$v.form.KlpNm.$invalid}">
										<div class="text-danger" v-if="$v.form.KlpNm.$error">* wajib isi</div>
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
                            <h3 class="card-title"><i class="fas fa-eye"></i> DETAIL KELOMPOK</h3>
                            <div class="card-tools">                                 
                                <button type="button" class="btn btn-tool" v-on:click.prevent="proc('create',null)">
                                    <i class="fas fa-plus"></i>
                                </button>                                
                                <button type="button" class="btn btn-tool" v-on:click.prevent="proc('edit',kelompok.detail)">
                                    <i class="fas fa-edit"></i>
                                </button>                                
                                <button type="button" class="btn btn-tool text-danger" v-on:click.prevent="proc('destroy',kelompok.detail)">
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
                                                <p class="form-control-static">{{kelompok.detail.StrID}}</p>
                                            </div>                            
                                        </div>  
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label"><strong>KODE KELOMPOK: </strong></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{kelompok.detail.kode_rek2}}</p>
                                            </div>                            
                                        </div>                          
                                        
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label"><strong>NAMA KELOMPOK: </strong></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{kelompok.detail.KlpNm}}</p>
                                            </div>                            
                                        </div>
                                    </div>      
                                </div>
                                <div class="col-md-6">
                                    <div class="form-horizontal">
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label"><strong>KETERANGAN: </strong></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{kelompok.detail.Descr}}</p>
                                            </div>                            
                                        </div> 
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label"><strong>DI BUAT: </strong></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{kelompok.detail.created_at|formatTanggal}}</p>
                                            </div>                            
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label"><strong>DI UBAH: </strong></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{kelompok.detail.updated_at|formatTanggal}}</p>
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
                        <div class="card-body table-responsive p-0" v-if="daftar_kelompok.data.length">
                            <table class="table table-striped table-hover mb-2">
                                <thead>
                                    <tr>
                                        <th width="55">NO</th>
                                        <th width="150">
                                            KODE KELOMPOK
                                        </th> 
                                        <th>
                                            NAMA KELOMPOK
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
                                    <tr v-for="(item,index) in daftar_kelompok.data" v-bind:key="item.KlpID">
                                        <td>{{daftar_kelompok.from+index}}</td>
                                        <td>{{item.kode_rek2}}</td>
                                        <td>{{item.KlpNm}}</td>    
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
                        <div class="card-footer" v-if="daftar_kelompok.data.length">                            
                            <pagination :data="daftar_kelompok" @pagination-change-page="populateData" align="center" :show-disabled="true" :limit="8">
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
            kelompok:{
                kriteria:'',
                isikriteria:'',
                detail:null
            },
            daftar_kelompok:{
                data:{}
            }, 
            api_message:'',           
       
            //form			
            daftar_transaksi: {},
			form: {		
                KlpID:'',		
                StrID:'',                
                Kd_Rek_2: '',
                KlpNm: '',				
				Descr:'',
			}
		}
	},
	methods: 
    {	
        fetchTransaksi ()
        {            
            axios.get('/api/v1/master/kelompok/create',{
                headers:{
                    'Authorization': window.laravel.api_token,
                }
            })
            .then(response => {             
                var daftar_transaksi = [];
                $.each(response.data,function(key,value){
                    daftar_transaksi.push({
                        code:key,
                        label:value
                    });
                });                
                this.daftar_transaksi=daftar_transaksi;                 
            })
            .catch(response => {
                this.api_message = response;
            });
        },
        populateData(page=1)
        {           
            axios.get('/api/v1/master/kelompok?page='+page,{
                headers:{
                    'Authorization': window.laravel.api_token,
                }
            })
            .then(response => {                                        
                this.kelompok=response.data; 
                this.daftar_kelompok = this.kelompok.daftar_kelompok;                           
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
                    this.fetchTransaksi();                
                break;
                case 'show' :
                    this.pid = pid;
                    this.kelompok.detail = item;
                break;
                case 'edit' :
                    this.pid = pid;
                    this.fetchTransaksi();
                    this.form.KlpID=item.KlpID;                   
                    this.form.StrID=item.StrID;                   
                    this.form.Kd_Rek_2=item.Kd_Rek_2;
                    this.form.KlpNm=item.KlpNm;
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
                            axios.post('/api/v1/master/kelompok/'+item.KlpID,{
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
				axios.post('/api/v1/master/kelompok',{
                    'StrID':this.form.StrID,
                    'Kd_Rek_2':this.form.Kd_Rek_2,
                    'KlpNm':this.form.KlpNm,
                    'Descr':this.form.Descr,
                },{
                    headers:{
                        'Authorization': window.laravel.api_token,
                    },
                })
                .then(response => {                          
                    this.$swal({
                        title: '<i class="fas fa-spin fa-spinner"></i>',
                        text: "Menyimpan Data Kelompok berhasil dilakukan",
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
                axios.post('/api/v1/master/kelompok/'+this.form.KlpID,{
                    '_method':'PUT',
                    'StrID':this.form.StrID,
                    'Kd_Rek_2':this.form.Kd_Rek_2,
                    'KlpNm':this.form.KlpNm,
                    'Descr':this.form.Descr,
                },{
                    headers:{
                        'Authorization': window.laravel.api_token,
                    },
                })
                .then(response => {                          
                    this.$swal({
                        title: '<i class="fas fa-spin fa-spinner"></i>',
                        text: "Mengubah Data Kelompok berhasil dilakukan",
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
            this.KlpID='';
            this.StrID='';
            this.form.Kd_Rek_2='';
            this.form.KlpNm='';           
            this.form.Descr='';           
        },
	},
	validations: {
		form: {
            StrID: {
				required
			},
			Kd_Rek_2: {
				required
			},
			KlpNm: {
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