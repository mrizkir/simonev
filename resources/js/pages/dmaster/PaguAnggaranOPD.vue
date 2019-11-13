<template>
<div class="content-wrapper">
	<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <i class="nav-icon fas fa-money-check-alt"></i>
                        PAGU ANGGARAN OPD / SKPD
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><router-link to="/">HOME</router-link></li>
                        <li class="breadcrumb-item">MASTER</li>
                        <li class="breadcrumb-item">DATA DASAR</li>
                        <li class="breadcrumb-item active">PAGU ANGGARAN OPD / SKPD</li>
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
                                <i class="fas fa-plus"></i> Tambah Pagu Anggaran OPD / SKPD
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
                                    <label class="col-sm-3 col-form-label">OPD / SKPD</label>
                                    <div class="col-sm-9" id="divOrgID">
                                        <select2 
                                            id="OrgID" 
                                            name="OrgID" 
                                            v-model="form.OrgID" 
                                            :options="daftar_opd" 
                                            :settings="{
                                                theme:'bootstrap',
                                                placeholder:'PILIH OPD / SKPD'
                                            }">
                                        </select2>
                                        <div class="text-danger" v-if="!$v.form.OrgID.required">* wajib dipilih</div>
                                    </div>
                                </div>
								<div class="form-group row">
                                    <label class="col-sm-3 col-form-label">PAGU ANGGARAN APBD</label>
                                    <div class="col-sm-9">
										<vue-autonumeric 
											v-model.trim="form.Jumlah1" 
											v-on:input="$v.form.$touch"
											:options="{
												minimumValue: '0',
												decimalCharacter: ',',
												digitGroupSeparator: '.',
												emptyInputBehavior:0,
												unformatOnSubmit: true 
											}" 
											class="form-control" 
											v-bind:class="{'is-invalid': $v.form.Jumlah1.$error, 'is-valid': $v.form.Jumlah1.$dirty && !$v.form.Jumlah1.$invalid}">
										</vue-autonumeric>
										<div class="text-danger" v-if="$v.form.Jumlah1.$error">* wajib isi</div>
                                    </div>
								 </div>								
								<div class="form-group row">
                                    <label class="col-sm-3 col-form-label">PAGU ANGGARAN APBDP</label>
                                    <div class="col-sm-9">
										<vue-autonumeric 
											v-model.trim="form.Jumlah2" 
											v-on:input="$v.form.$touch"
											:options="{
												minimumValue: '0',
												decimalCharacter: ',',
												digitGroupSeparator: '.',
												emptyInputBehavior:0,
												unformatOnSubmit: true 
											}" 
											class="form-control" 
											v-bind:class="{'is-invalid': $v.form.Jumlah2.$error, 'is-valid': $v.form.Jumlah1.$dirty && !$v.form.Jumlah1.$invalid}">
										</vue-autonumeric>
										<div class="text-danger" v-if="$v.form.Jumlah2.$error">* wajib isi</div>
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
                                <i class="fas fa-plus"></i> Ubah Pagu Anggaran OPD / SKPD
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
                                    <label class="col-sm-3 col-form-label">OPD / SKPD</label>
                                    <div class="col-sm-9">
                                        <p class="form-control-static">{{form.OrgNm}}</p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">PAGU ANGGARAN APBD</label>
                                    <div class="col-sm-9">
                                        <vue-autonumeric 
                                            v-model.trim="form.Jumlah1" 
                                            v-on:input="$v.form.$touch"
                                            :options="{
                                                minimumValue: '0',
                                                decimalCharacter: ',',
                                                digitGroupSeparator: '.',
                                                emptyInputBehavior:0,
                                                unformatOnSubmit: true 
                                            }" 
                                            class="form-control" 
                                            v-bind:class="{'is-invalid': $v.form.Jumlah1.$error, 'is-valid': $v.form.Jumlah1.$dirty && !$v.form.Jumlah1.$invalid}">
                                        </vue-autonumeric>
                                        <div class="text-danger" v-if="$v.form.Jumlah1.$error">* wajib isi</div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">PAGU ANGGARAN APBDP</label>
                                    <div class="col-sm-9">
                                       <vue-autonumeric 
											v-model.trim="form.Jumlah2" 
											v-on:input="$v.form.$touch"
											:options="{
												minimumValue: '0',
												decimalCharacter: ',',
												digitGroupSeparator: '.',
                                                emptyInputBehavior:0,
												unformatOnSubmit: true 
											}" 
											class="form-control" 
											v-bind:class="{'is-invalid': $v.form.Jumlah2.$error, 'is-valid': $v.form.Jumlah1.$dirty && !$v.form.Jumlah1.$invalid}">
										</vue-autonumeric>
										<div class="text-danger" v-if="$v.form.Jumlah2.$error">* wajib isi</div>
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
                            <h3 class="card-title"><i class="fas fa-eye"></i> DETAIL PAGU ANGGARAN</h3>
                            <div class="card-tools">                                 
                                <button type="button" class="btn btn-tool" v-on:click.prevent="proc('create',null)">
                                    <i class="fas fa-plus"></i>
                                </button>                                
                                <button type="button" class="btn btn-tool" v-on:click.prevent="proc('edit',paguanggaranopd.detail)">
                                    <i class="fas fa-edit"></i>
                                </button>                                
                                <button type="button" class="btn btn-tool text-danger" v-on:click.prevent="proc('destroy',paguanggaranopd.detail)">
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
                                                <p class="form-control-static">{{paguanggaranopd.detail.PaguAnggaranOPDID}}</p>
                                            </div>                            
                                        </div>  
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label"><strong>KODE OPD / SKPD: </strong></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{paguanggaranopd.detail.kode_organisasi}}</p>
                                            </div>                            
                                        </div>                          
                                        
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label"><strong>NAMA OPD / SKPD: </strong></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{paguanggaranopd.detail.OrgNm}}</p>
                                            </div>                            
                                        </div>
                                    </div>      
                                </div>
                                <div class="col-md-6">
                                    <div class="form-horizontal">
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label"><strong>PAGU DANA APBD: </strong></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{paguanggaranopd.detail.Jumlah1|formatUang}}</p>
                                            </div>                            
                                        </div>  
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label"><strong>PAGU DANA APBDP: </strong></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{paguanggaranopd.detail.Jumlah2|formatUang}}</p>
                                            </div>                            
                                        </div>                          
                                        
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label"><strong>DI BUAT / DI UBAH: </strong></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{paguanggaranopd.detail.created_at|formatTanggal}} / {{paguanggaranopd.detail.updated_at|formatTanggal}}</p>
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
                                            <option value="kode_organisasi" :selected="cmbKriteria=='kode_organisasi'">KODE OPD / SKPD</option>
                                            <option value="OrgNm" :selected="cmbKriteria=='OrgNm'">NAMA OPD / SKPD</option>
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
                        <div class="card-body table-responsive p-0" v-if="daftar_paguanggaran.data.length">
                            <table class="table table-striped table-hover mb-2">
                                <thead>
                                    <tr>
                                        <th width="55">NO</th>
                                        <th width="120">
                                            KODE OPD  
                                        </th> 
                                        <th>
                                            NAMA OPD  
                                        </th> 
                                        <th width="100">
                                            APBD  
                                        </th> 
                                        <th width="100">
                                            APBDP  
                                        </th> 
                                        <th width="100">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>  
                                    <tr v-for="(item,index) in daftar_paguanggaran.data" v-bind:key="item.PaguAnggaranOPDID">
                                        <td>{{daftar_paguanggaran.from+index}}</td>
                                        <td>{{item.kode_organisasi}}</td>
                                        <td>{{item.OrgNm}}</td>    
                                        <td>{{item.Jumlah1|formatUang}}</td>
                                        <td>{{item.Jumlah2|formatUang}}</td>
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
                        <div class="card-footer" v-if="daftar_paguanggaran.data.length">                            
                            <pagination :data="daftar_paguanggaran" @pagination-change-page="populateData" align="center" :show-disabled="true" :limit="8">
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
            paguanggaranopd:{
                kriteria:'',
                isikriteria:'',
                detail:null
            },
            daftar_paguanggaran:{
                data:{}
            }, 
            api_message:'',
            
            //field form search
            cmbKriteria:'OrgNm',
            txtKriteria:'',

            //form
			daftar_opd: [{id:'',text:'PILIH OPD / SKPD'}],
			form: {				
                PaguAnggaranOPDID:'',
                OrgID: '',
                OrgNm: '',
				Jumlah1: 0,
				Jumlah2: 0,
				Descr:'',
			}
		}
	},
	methods: 
    {		  
		fetchOPD ()
        {            
            axios.get('/api/v1/master/paguanggaranopd/create',{
                headers:{
                    'Authorization': window.laravel.api_token,
                }
            })
            .then(response => {      
                var daftar_opd = [];
                $.each(response.data,function(key,value){
                    daftar_opd.push({
                        id:key,
                        text:value
                    });
                });                
                this.daftar_opd=daftar_opd;                 
            })
            .catch(response => {
                this.api_message = response;
            });
        },
        populateData(page=1)
        {           
            axios.get('/api/v1/master/paguanggaranopd?page='+page,{
                headers:{
                    'Authorization': window.laravel.api_token,
                }
            })
            .then(response => {                                        
                this.paguanggaranopd=response.data; 
                this.daftar_paguanggaran = this.paguanggaranopd.daftar_paguanggaran;
                if(typeof(this.paguanggaranopd.search) !== 'undefined' && this.paguanggaranopd.search !== null)
                {
                    this.cmbKriteria = this.paguanggaranopd.search.kriteria;
                    this.txtKriteria = this.paguanggaranopd.search.isikriteria;
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
                    this.fetchOPD();
                break;
                case 'show' :
                    this.pid = pid;
                    this.paguanggaranopd.detail = item;
                break;
                case 'edit' :
                    this.pid = pid;
                    this.form.PaguAnggaranOPDID=item.PaguAnggaranOPDID;
                    axios.get('/api/v1/master/paguanggaranopd/'+this.form.PaguAnggaranOPDID,{
                        headers:{
                            'Authorization': window.laravel.api_token,
                        }
                    })
                    .then(response => {                                        
                        this.form.OrgNm='['+response.data.kode_organisasi+'] '+response.data.OrgNm;    
                    })
                    .catch(response => {
                        this.api_message = response;
                    }); 
                    this.form.OrgID=item.OrgID;
                    this.form.Jumlah1=item.Jumlah1;
                    this.form.Jumlah2=item.Jumlah2;
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
                            axios.post('/api/v1/master/paguanggaranopd/'+item.PaguAnggaranOPDID,{
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
				axios.post('/api/v1/master/paguanggaranopd',{
                    'OrgID':this.form.OrgID,
                    'Jumlah1':this.form.Jumlah1,
                    'Jumlah2':this.form.Jumlah2,
                    'Descr':this.form.Descr,
                },{
                    headers:{
                        'Authorization': window.laravel.api_token,
                    },
                })
                .then(response => {                          
                    this.$swal({
                        title: '<i class="fas fa-spin fa-spinner"></i>',
                        text: "Menyimpan Data Pagu Anggaran OPD / SKPD",
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
                axios.post('/api/v1/master/paguanggaranopd/'+this.form.PaguAnggaranOPDID,{
                    '_method':'PUT',
                    'Jumlah1':this.form.Jumlah1,
                    'Jumlah2':this.form.Jumlah2,
                    'Descr':this.form.Descr,
                },{
                    headers:{
                        'Authorization': window.laravel.api_token,
                    },
                })
                .then(response => {                          
                    this.$swal({
                        title: '<i class="fas fa-spin fa-spinner"></i>',
                        text: "Mengubah Data Pagu Anggaran OPD / SKPD",
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
            this.PaguAnggaranOPDID='';
            this.form.OrgID='';
            this.form.OrgNm='';
            this.form.Jumlah1=0;
            this.form.Jumlah2=0;
            this.form.Descr='';
        },
	},
	validations: {
		form: {
			OrgID: {
				required
			},
			Jumlah1: {
				required
			},
			Jumlah2: {
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