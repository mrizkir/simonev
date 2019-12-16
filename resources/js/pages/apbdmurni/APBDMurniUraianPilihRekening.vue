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
                        <li class="breadcrumb-item active">PILIH REKENING</li>
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
                <div class="col-12">
                    <!-- Horizontal Form -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-plus"></i> PILIH REKENING
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
                                    <label class="col-sm-2 col-form-label">TRANSAKSI</label>
                                    <div class="col-sm-10">
                                        <v-select 
                                            v-model="form.StrID" 
                                            :reduce="daftar_transaksi => daftar_transaksi.code" 
                                            placeholder="PILIH TRANSAKSI" 
                                            :options="daftar_transaksi"
                                            @input="changeTransaksi('StrID')">
                                        </v-select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">KELOMPOK</label>
                                    <div class="col-sm-10">
                                        <v-select 
                                            v-model="form.KlpID" 
                                            :reduce="daftar_kelompok => daftar_kelompok.code" 
                                            placeholder="PILIH KELOMPOK" 
                                            :options="daftar_kelompok"
                                            @input="changeTransaksi('KlpID')">
                                        </v-select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">JENIS</label>
                                    <div class="col-sm-10">
                                        <v-select 
                                            v-model="form.JnsID" 
                                            :reduce="daftar_jenis => daftar_jenis.code" 
                                            placeholder="PILIH JENIS" 
                                            :options="daftar_jenis"
                                            @input="changeTransaksi('JnsID')">
                                        </v-select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">RINCIAN</label>
                                    <div class="col-sm-10">
                                        <v-select 
                                            v-model="form.ObyID" 
                                            :reduce="daftar_rincian => daftar_rincian.code" 
                                            placeholder="PILIH RINCIAN" 
                                            :options="daftar_rincian"
                                            @input="changeTransaksi('ObyID')">
                                        </v-select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">OBJEK</label>
                                    <div class="col-sm-10">
                                        <v-select 
                                            v-model="form.SObyID" 
                                            placeholder="PILIH OBJEK" 
                                            :options="daftar_obyek"
                                            @input="changeTransaksi('SObyID')">
                                        </v-select>
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
export default {
    created ()
    {
        var page = this.$store.getters.getPage('apbdmurni');
        this.detailkegiatan = page.detailkegiatan;                
    },
    mounted()
    {
        this.fetchTransaksi();
    },
    data: function() 
	{
		return {
            pid:'default',
            api_message:'',

            detailkegiatan:'',
            daftar_rincian:{
                data:{}
            },
            //form
            daftar_transaksi: [],            
            daftar_kelompok: [],            
            daftar_jenis: [],            
            daftar_rincian: [],            
            daftar_obyek: [],            
            form: {		
                StrID:'',                
                KlpID:'',                
                JnsID:'',                
                ObyID:'',                
                SObyID:'',                
            },
            
        }
    },
    methods: 
    {	
        fetchTransaksi ()
        {  
            axios.get('/api/v1/apbdmurni/create1',{
                headers:{
                    'Authorization': window.laravel.api_token,
                }
            })
            .then(response => {             
                var daftar_transaksi = [];
                $.each(response.data.daftar_transaksi,function(key,value){
                    daftar_transaksi.push({
                        code:key,
                        label:value
                    });
                });                
                this.daftar_transaksi=daftar_transaksi;                 
                
                this.daftar_kelompok = [];                
                this.daftar_jenis=[];                       
                this.daftar_rincian=[];                 
                this.daftar_obyek=[];                                                         
            })
            .catch(response => {
                this.api_message = response;
            });
        },
        changeTransaksi (pid)
        {       
            switch(pid)
            {
                case 'StrID':
                    this.form.KlpID ='';
                    this.form.JnsID ='';
                    this.form.ObyID ='';
                    this.form.SObyID ='';
                    axios.post('/api/v1/apbdmurni/changerekening',
                        {
                            'pid':'transaksi',
                            'StrID':this.form.StrID
                        },
                        {
                            headers:{
                                'Authorization': window.laravel.api_token,
                            }
                        }
                    )
                    .then(response => {                                                                
                        var daftar_kelompok = [];
                        $.each(response.data.daftar_kelompok,function(key,value){
                            daftar_kelompok.push({
                                code:key,
                                label:value
                            });
                        });               
                        this.daftar_kelompok=daftar_kelompok;  
                        this.daftar_jenis=[];                       
                        this.daftar_rincian=[];                 
                        this.daftar_obyek=[];      
                    })
                    .catch(response => {
                        this.api_message = response;
                    });
                break;
                case 'KlpID':            
                    this.form.JnsID ='';
                    this.form.ObyID ='';
                    this.form.SObyID ='';            
                    axios.post('/api/v1/apbdmurni/changerekening',
                        {
                            'pid':'kelompok',
                            'KlpID':this.form.KlpID
                        },
                        {
                            headers:{
                                'Authorization': window.laravel.api_token,
                            }
                        }
                    )
                    .then(response => {                                                                
                        var daftar_jenis = [];
                        $.each(response.data.daftar_jenis,function(key,value){
                            daftar_jenis.push({
                                code:key,
                                label:value
                            });
                        });               
                        this.daftar_jenis=daftar_jenis;  
                        this.daftar_rincian=[];                 
                        this.daftar_obyek=[];      
                    })
                    .catch(response => {
                        this.api_message = response;
                    });
                break;
                case 'JnsID':            
                    this.form.ObyID ='';
                    this.form.SObyID ='';            
                    axios.post('/api/v1/apbdmurni/changerekening',
                        {
                            'pid':'jenis',
                            'JnsID':this.form.JnsID
                        },
                        {
                            headers:{
                                'Authorization': window.laravel.api_token,
                            }
                        }
                    )
                    .then(response => {                                                                
                        var daftar_rincian = [];
                        $.each(response.data.daftar_rincian,function(key,value){
                            daftar_rincian.push({
                                code:key,
                                label:value
                            });
                        });               
                        this.daftar_rincian=daftar_rincian;  
                        this.daftar_obyek=[];      
                    })
                    .catch(response => {
                        this.api_message = response;
                    });
                break;
                case 'ObyID':            
                    this.form.SObyID ='';            
                    axios.post('/api/v1/apbdmurni/changerekening',
                        {
                            'pid':'rincian',
                            'ObyID':this.form.ObyID
                        },
                        {
                            headers:{
                                'Authorization': window.laravel.api_token,
                            }
                        }
                    )
                    .then(response => {                                                                
                        var daftar_obyek = [];
                        $.each(response.data.daftar_obyek,function(key,value){
                            daftar_obyek.push({
                                code:key,
                                label:value
                            });
                        });              
                        this.daftar_obyek=daftar_obyek;
                    })
                    .catch(response => {
                        this.api_message = response;
                    });
                break;
                case 'SObyID':
                    var page = this.$store.getters.getPage('apbdmurni');
                    page.datarekening = this.form.SObyID;                        
                    this.$store.commit('replacePage',page);
                    page = this.$store.getters.getPage('apbdmurni');
                    this.$router.push('/apbdmurni/uraian/create');
                break;
            }               
       
        },
    },
	components: 
	{
        'v-select': vSelect,
    }
}
</script>