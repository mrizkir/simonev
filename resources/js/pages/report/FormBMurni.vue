<template>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark">
                        <i class="nav-icon fas fa-sticky-note"></i>
                        LAPORAN FORM B MURNI
                    </h1>
                </div>
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><router-link to="/">HOME</router-link></li>
                        <li class="breadcrumb-item">
                            LAPORAN
                        </li>
                        <li class="breadcrumb-item active">FORM B MURNI</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>  
    <!-- Main content -->
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
                                            @input="fetchUnitKerja">
                                        </v-select>
                                    </div>
                                </div>                               
                                <div class="form-group row" id="divSOrgID">
                                    <label class="col-sm-2 col-form-label">UNIT KERJA</label>
                                    <div class="col-sm-10">
                                        <v-select 
                                            v-model="SOrgID" 
                                            placeholder="PILIH UNIT KERJA" 
                                            :options="daftar_unitkerja"
                                            @input="filter">
                                        </v-select>
                                    </div>
                                </div>           
                                <div class="form-group row" id="divNoBulan">
                                    <label class="col-sm-2 col-form-label">BULAN</label>
                                    <div class="col-sm-10">   
                                        <v-select 
                                            v-model="no_bulan" 
                                            placeholder="PILIH BULAN" 
                                            :reduce="daftar_bulan => daftar_bulan.code"
                                            :options="daftar_bulan"
                                            @input="changeBulan">
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
</div>
</template>
<script>
import VueAutonumeric from 'vue-autonumeric';
import Pagination from 'laravel-vue-pagination';
import vSelect from 'vue-select';

export default {
    mounted()
	{       
        //inisialisasi data halaman
        var d = new Date();
        var bulan = d.getMonth()+1;
        this.$store.commit('addToPages',{
                name:'reportformbmurni',
                OrgID:'',
                OrgNm:'',
                SOrgID:'',
                SOrgNm:'',
                no_bulan:bulan,
                datarekening:{},
                datauraian:{},
                detailkegiatan:{}
        });
		this.proc ('default');   
	},
    data: function() 
	{
        //inisialisasi data halaman
        var d = new Date();
        var bulan = d.getMonth()+1;
		return {
            pid:'default',
            api_message:'',

            daftar_apbdmurni:{
                data:{}
            },
            //field form search & filter
            OrgID:'',
            OrgNm:'',
            SOrgID:'',
            SOrgNm:'',
            daftar_opd: [],
            daftar_unitkerja: [],
            
            //show detail
            no_bulan:bulan,
            daftar_bulan:[],
            html_generated:'',
            

        }
    },
    methods: 
    {        
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
        fetchUnitKerja()
        {           
            var page = this.$store.getters.getPage('reportformbmurni');
            page.OrgID=this.OrgID;
            page.OrgNm=this.OrgID.label;
            page.SOrgID='';
            page.SOrgNm='';
            this.$store.commit('replacePage',page);

            axios.get('/api/v1/master/suborganisasi/daftarunitkerja/'+this.OrgID.code,{
                headers:{
                    'Authorization': window.laravel.api_token,
                }
            })
            .then(response => {     
                var daftar_unitkerja = [];
                $.each(response.data,function(key,value){
                    daftar_unitkerja.push({
                        code:key,
                        label:value
                    });
                });                
                this.daftar_unitkerja=daftar_unitkerja;                            
            })
            .catch(response => {
                this.api_message = response;
            });
            this.populateData();
        },
        filter ()
        {           
            var page = this.$store.getters.getPage('reportformbmurni');
            page.SOrgID=this.SOrgID;
            page.SOrgNm=this.SOrgNm.label;
            this.$store.commit('replacePage',page);

            this.populateData();
        },
        changeBulan ()
        {
            this.html_generated='';
            var page = this.$store.getters.getPage('reportformbmurni');
            page.no_bulan=this.no_bulan;
            this.$store.commit('replacePage',page);

            this.generateReport();
        },
        populateData(page=1)
        {           
            
        },
        proc (pid,item=null) 
        {           
            switch (pid)
            {
                default :
                    this.pid = pid;
                    this.fetchOPD();           
                    this.OrgID=this.$store.getters.getAtributeValueOfPage('reportformbmurni','OrgID');      
                    this.OrgNm=this.$store.getters.getAtributeValueOfPage('reportformbmurni','OrgNm');      
                    if (this.OrgID!='')
                    {                                
                        axios.get('/api/v1/master/suborganisasi/daftarunitkerja/'+this.OrgID.code,{
                            headers:{
                                'Authorization': window.laravel.api_token,
                            }
                        })
                        .then(response => {     
                            var daftar_unitkerja = [];
                            $.each(response.data,function(key,value){
                                daftar_unitkerja.push({
                                    code:key,
                                    label:value
                                });
                            });                
                            this.daftar_unitkerja=daftar_unitkerja;                            
                        })
                        .catch(response => {
                            this.api_message = response;
                        });                
                        this.SOrgID=this.$store.getters.getAtributeValueOfPage('reportformbmurni','SOrgID');      
                        this.SOrgNm=this.$store.getters.getAtributeValueOfPage('reportformbmurni','SOrgNm');    
                    }  
                    var daftar_bulan = this.$store.getters.getConfig(0);
                    this.daftar_bulan=daftar_bulan;              
                    this.populateData();              
            }
        },
    },
    components: 
	{
        'vue-autonumeric':VueAutonumeric,
        'pagination': Pagination,
        'v-select': vSelect,
    }
}
</script>