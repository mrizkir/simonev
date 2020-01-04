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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"></h3>
                            <div class="card-tools">
                                
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0" v-html="html_generated"></div>
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
    mounted()
	{       
        //inisialisasi data halaman
        var d = new Date();
        var bulan = d.getMonth()+1;
        this.$store.commit('addToPages',{
                name:'reportformbmurni',
                OrgID:'',
                OrgNm:'',
                no_bulan:bulan,
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
            
            //field form search & filter
            OrgID:'',
            OrgNm:'',
            daftar_opd: [],
            
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
        filter ()
        {           
            var page = this.$store.getters.getPage('reportformbmurni');
            page.OrgID=this.OrgID;
            page.OrgNm=this.OrgNm.label;
            this.$store.commit('replacePage',page);

            this.generateReport();
        },
        changeBulan ()
        {
            this.html_generated='';
            var page = this.$store.getters.getPage('reportformbmurni');
            page.no_bulan=this.no_bulan;
            this.$store.commit('replacePage',page);

            this.generateReport();
        },
        generateReport()
        {
            var page = this.$store.getters.getPage('reportformbmurni');
            axios.post('/api/v1/report/formbmurni',{
                'OrgID':page.OrgID.code,
                'no_bulan':page.no_bulan,
            },{
                headers:{
                    'Authorization': window.laravel.api_token,
                }
            })
            .then(response => {     
                this.html_generated=response.data.generated_html;                     
            })
            .catch(response => {
                this.api_message = response;
            });           
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
                    
                    var daftar_bulan = this.$store.getters.getConfig(0);
                    this.daftar_bulan=daftar_bulan;   
                    this.no_bulan=this.$store.getters.getAtributeValueOfPage('reportformbmurni','no_bulan');                    

                    if (this.OrgID!='')
                    {                                
                        this.generateReport(); 
                    }            
            }
        },
    },
    components: 
	{
        'v-select': vSelect,
    }
}
</script>