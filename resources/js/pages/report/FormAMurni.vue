<template>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark">
                        <i class="nav-icon fas fa-sticky-note"></i>
                        LAPORAN FORM A MURNI
                    </h1>
                </div>
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><router-link to="/">HOME</router-link></li>
                        <li class="breadcrumb-item">
                            LAPORAN
                        </li>
                        <li class="breadcrumb-item active">FORM A MURNI</li>
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
            <div class="row" v-if="pid=='show'">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-bookmark"></i> FILTER</h3>                            
                        </div>
                        <div class="card-body">
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
                    </div>
                </div> 
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" v-on:click.prevent="proc('default',null)">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0" v-html="html_generated"></div>
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
                        <div class="card-body table-responsive p-0" v-if="daftar_apbdmurni.data.length">
                            <table class="table table-striped table-hover mb-2 table-condensed">
                                <thead>
                                    <tr>
                                        <th width="55">NO</th>                                      
                                        <th width="120">
                                            KODE KEGIATAN
                                        </th> 
                                        <th>
                                            NAMA KEGIATAN  
                                        </th>                                       
                                        <th width="80">
                                            PAGU KEGIATAN  
                                        </th>                                       
                                        <th width="80">
                                            PAGU URAIAN  
                                        </th>                                       
                                        <th width="80">
                                            REALISASI  
                                        </th>                                       
                                        <th width="70">
                                            FISIK(%)  
                                        </th>                                       
                                        <th width="70">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>  
                                    <tr v-for="(item,index) in daftar_apbdmurni.data" v-bind:key="item.RKAID">
                                        <td>{{daftar_apbdmurni.from+index}}</td>
                                        <td>{{item.kode_kegiatan}}</td>    
                                        <td>{{item.KgtNm}}</td>
                                        <td>{{item.PaguDana1|formatUang}}</td>
                                        <td>{{item.TotalPaguUraian1|formatUang}}</td>
                                        <td>{{item.TotalRealisasi1|formatUang}}</td>
                                        <td>{{item.TotalFisik1}}</td>                                            
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-wrench"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="#" v-on:click.prevent="proc('show',item)">
                                                        <i class="fas fa-eye"></i> DETAIL
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
                        <div class="card-footer" v-if="daftar_apbdmurni.data.length">                            
                            <pagination :data="daftar_apbdmurni" @pagination-change-page="populateData" align="center" :show-disabled="true" :limit="8">
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
import vSelect from 'vue-select';

export default {
    mounted()
	{       
        //inisialisasi data halaman
        var d = new Date();
        var bulan = d.getMonth()+1;
        this.$store.commit('addToPages',{
                name:'reportformamurni',
                OrgID:'',
                OrgNm:'',
                SOrgID:'',
                SOrgNm:'',
                no_bulan:bulan,
                RKAID:'',
                datarekening:{},
                datauraian:{},
                detailkegiatan:{}
        });
		this.proc ('default');   
	},
    data: function() 
	{
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
            var page = this.$store.getters.getPage('reportformamurni');
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
            var page = this.$store.getters.getPage('reportformamurni');
            page.SOrgID=this.SOrgID;
            page.SOrgNm=this.SOrgNm.label;
            this.$store.commit('replacePage',page);

            this.populateData();
        },
        populateData(page=1)
        {           
            axios.get('/api/v1/apbdmurni?page='+page,{
                headers:{
                    'Authorization': window.laravel.api_token,
                    'OrgID':this.OrgID.code,
                    'SOrgID':this.SOrgID.code,
                }
            })
            .then(response => {        
                this.apbdmurni=response.data; 
                this.daftar_apbdmurni = this.apbdmurni.daftar_apbdmurni;                                      
            })
            .catch(response => {
                this.api_message = response;
            });             
        },
        changeBulan ()
        {
            this.html_generated='';
            var page = this.$store.getters.getPage('reportformamurni');
            page.no_bulan=this.no_bulan;
            this.$store.commit('replacePage',page);

            this.generateReport();
        },
        generateReport()
        {
            var page = this.$store.getters.getPage('reportformamurni');
            axios.post('/api/v1/report/formamurni',{
                'RKAID':page.RKAID,
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
                case 'show' :
                    this.pid = pid;
                    this.html_generated='';
                    var daftar_bulan = this.$store.getters.getConfig(0);
                    this.daftar_bulan=daftar_bulan;   

                    var page = this.$store.getters.getPage('reportformamurni');
                    page.RKAID = item.RKAID;
                    
                    this.no_bulan=page.no_bulan; 

                    this.$store.commit('replacePage',page);
                    this.generateReport();
                break;
                default :
                    this.pid = pid;
                    this.fetchOPD();           
                    this.OrgID=this.$store.getters.getAtributeValueOfPage('reportformamurni','OrgID');      
                    this.OrgNm=this.$store.getters.getAtributeValueOfPage('reportformamurni','OrgNm');      
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
                        this.SOrgID=this.$store.getters.getAtributeValueOfPage('reportformamurni','SOrgID');      
                        this.SOrgNm=this.$store.getters.getAtributeValueOfPage('reportformamurni','SOrgNm');    
                    }               
                    this.populateData();              
            }
        },
    },
    components: 
	{
        'pagination': Pagination,
        'v-select': vSelect,
    }
}
</script>