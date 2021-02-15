<template>
   <EvaluasiRenjaLayout :temporaryleftsidebar="true">
       <template v-slot:system-bar>
            Tahun Anggaran: {{$store.getters['uifront/getTahunAnggaran']}} | Bulan Realisasi:{{$store.getters['uifront/getNamaBulan']}}
        </template>
       <ModuleHeader>
           <template v-slot:icon>
                mdi-graph
            </template>
            <template v-slot:name>
                EVALUASI RENJA MURNI
            </template>
            <template v-slot:breadcrumbs>
                <v-breadcrumbs :items="breadcrumbs" class="pa-0">
                    <template v-slot:divider>
                        <v-icon>mdi-chevron-right</v-icon>
                    </template>
                </v-breadcrumbs>
            </template>
            <template v-slot:desc>
                <v-alert                                        
                    color="cyan"
                    border="left"                    
                    colored-border
                    type="info"
                    >
                    Laporan Evaluasi RENJA (Rencana Kerja Perangkat Daerah) Murni
                </v-alert>
            </template>
        </ModuleHeader>
        <v-container fluid>    
            <v-row class="mb-4" no-gutters>
                <v-col cols="12">
                    <v-card>
                        <v-card-title>
                            FILTER
                        </v-card-title>
                        <v-card-text>
                            <v-autocomplete 
                                :items="daftar_opd" 
                                v-model="OrgID_Selected"
                                label="OPD / SKPD" 
                                item-text="OrgNm" 
                                item-value="OrgID">                                        
                            </v-autocomplete>                                                                           
                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>
            <v-row class="mb-4" no-gutters>
                <v-col cols="12">
                    <v-card>
                        <v-card-text>
                            <v-text-field
                                v-model="search"
                                append-icon="mdi-database-search"
                                label="Search"
                                single-line
                                hide-details
                            ></v-text-field>
                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>
             <v-row class="mb-4" no-gutters>
                <v-col cols="12">
                    <v-data-table
                        :headers="headers"
                        :items="datatable"
                        :search="search"
                        item-key="EvaluasiRenjaMurniID"                        
                        dense                        
                        :single-expand="true"
                        class="elevation-1"
                        :loading="datatableLoading"
                        loading-text="Loading... Please wait"
                        :disable-pagination="true"
                        :hide-default-footer="true">
                    >
                        <template v-slot:top>
                            <v-toolbar flat color="white">
                                <v-toolbar-title>DAFTAR KEGIATAN</v-toolbar-title>
                                <v-divider
                                    class="mx-4"
                                    inset
                                    vertical
                                ></v-divider>
                                <v-spacer></v-spacer>
                                <v-btn 
                                    color="primary" 
                                    fab 
                                    small
                                    @click.stop="printtoexcel"
                                    :loading="btnLoading"
                                    :disabled="btnLoading||datatableLoaded">
                                    <v-icon>mdi-printer</v-icon>
                                </v-btn>
                            </v-toolbar>
                        </template>                  
                        <template v-slot:body="{ items }">
                            <tbody>
                                <tr v-for="(item) in items" v-bind:key="item.FormBMurniID" v-bind:class="{'indigo lighten-4 font-weight-bold':isProgram(item)}">
                                    <td>{{item.kode}}</td>
                                    <td>{{item.nama}}</td>
                                    <td class="text-right">{{item.indikator_kinerja}}</td>
                                    <td class="text-right">{{item.target_kinerja}}</td>                                    
                                    <td class="text-right">{{item.fisik_target1}}</td>                                                                        
                                    <td class="text-right">{{item.pagu_dana1|formatUang}}</td> 

                                    <td class="text-right">{{item.fisik_tw_1}}</td>                                                                                                         
                                    <td class="text-right">{{item.keuangan_tw_1|formatUang}}</td>   

                                    <td class="text-right">{{item.fisik_tw_2}}</td>                                                                                                         
                                    <td class="text-right">{{item.keuangan_tw_2|formatUang}}</td>                

                                    <td class="text-right">{{item.fisik_tw_3}}</td>                                                                                                         
                                    <td class="text-right">{{item.keuangan_tw_3|formatUang}}</td>                                                                                                         

                                    <td class="text-right">{{item.fisik_tw_4}}</td>                                                                                                         
                                    <td class="text-right">{{item.keuangan_tw_4|formatUang}}</td>                                                                                                         
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="orange font-weight-bold dark">
                                    <td colspan="4" class="text-right">TOTAL</td>  
                                    <td class="text-right">{{total_data.totalPersenTargetFisik}}</td>         
                                    <td class="text-right">{{total_data.totalPaguOPD|formatUang}}</td>                            
                                    <td class="text-right">{{total_data.totalFisikTW1}}</td>         
                                    <td class="text-right">{{total_data.totalKeuanganTW1|formatUang}}</td>                            
                                    <td class="text-right">{{total_data.totalFisikTW2}}</td>         
                                    <td class="text-right">{{total_data.totalKeuanganTW2|formatUang}}</td>                            
                                    <td class="text-right">{{total_data.totalFisikTW3}}</td>                                             
                                    <td class="text-right">{{total_data.totalKeuanganTW3|formatUang}}</td>                                                                
                                    <td class="text-right">{{total_data.totalFisikTW4}}</td>                                             
                                    <td class="text-right">{{total_data.totalKeuanganTW4|formatUang}}</td>                                                                
                                </tr>
                            </tfoot>
                        </template>    
                        <template v-slot:no-data>                                                                                                           
                            Belum ada kegiatan.
                        </template>                 
                    </v-data-table>
                </v-col>
            </v-row>              
        </v-container>
   </EvaluasiRenjaLayout>
</template>
<script>
import EvaluasiRenjaLayout from '@/views/layouts/EvaluasiRenjaLayout';
import ModuleHeader from '@/components/ModuleHeader';
export default {
    name:'EvaluasiRenjaMurni',
    created ()
    {
        this.breadcrumbs = [
            {
                text:'HOME',
                disabled:false,
                href:'/dashboard/'+this.$store.getters['auth/AccessToken']
            },
            {
                text:'EVALUASI RENJA',
                disabled:false,
                href:'#'
            },
            {
                text:'MURNI',
                disabled:true,
                href:'#'
            }
        ];

        this.$store.dispatch('uiadmin/addToPages',{
            name:'evaluasirenjamurni',
            OrgID_Selected:'',            
        })
    },
    mounted()
    {
        this.fetchOPD(); 
        var OrgID_Selected=this.$store.getters['uiadmin/AtributeValueOfPage']('evaluasirenjamurni','OrgID_Selected');          
        if (OrgID_Selected.length > 0) 
        {
            this.OrgID_Selected = OrgID_Selected;                               
        }          
        this.firstloading=false;
    },
    data ()
    {
        return {
            firstloading:true,
            expanded:[],
            search:'',
            btnLoading:false,
            datatableLoading:false,
            datatableLoaded:true,
            datatable:[],
            headers: [                        
                { text: 'KODE', value: 'kode',width:80,sortable:false },   
                { text: 'PROGRAM/KEGIATAN', value: 'nama',width:300,sortable:false },   
                { text: 'INDIKATOR KINERJA', value: 'indikator_kinerja',align:'end',width:200,sortable:false },   
                { text: 'TARGET KINERJA (RPJMD)', value: 'target_kinerja',align:'end',width:100,sortable:false },   
                
                { text: 'TARGET FISIK (%)', value: 'fisik_target1',align:'end',width:100,sortable:false },   
                { text: 'TARGET ANGGARAN', value: 'pagu_dana1',align:'end',width:100,sortable:false},                                                      

                { text: 'REALISASI FISIK TW I', value: 'fisik_tw_1',align:'end',width:100,sortable:false },   
                { text: 'REALISASI ANGGARAN TW II', value: 'keuangan_tw_1',align:'end',width:100,sortable:false },   
                { text: 'REALISASI FISIK TW II', value: 'fisik_tw_2',align:'end',width:100,sortable:false },   
                { text: 'REALISASI ANGGARAN TW II', value: 'keuangan_tw_2',align:'end',width:100,sortable:false },   
                { text: 'REALISASI FISIK TW III', value: 'fisik_tw_3',align:'end',width:100,sortable:false },   
                { text: 'REALISASI ANGGARAN TW III', value: 'keuangan_tw_3',align:'end',width:100,sortable:false },   
                { text: 'REALISASI FISIK TW IV', value: 'fisik_tw_4',align:'end',width:100,sortable:false },   
                { text: 'REALISASI ANGGARAN TW IV', value: 'keuangan_tw_4',align:'end',width:100,sortable:false },   
                  
                
            ],
            total_data:{
                'totalPaguOPD':0,                                
                'totalPersenTargetFisik':0,
                'totalFisikTW1':0,
                'totalKeuanganTW1':0,
                'totalFisikTW2':0,
                'totalKeuanganTW2':0,
                'totalFisikTW3':0,
                'totalKeuanganTW3':0,
                'totalFisikTW4':0,
                'totalKeuanganTW4':0,
            },
            //filter form
            daftar_opd:[],
            OrgID_Selected : '',
            
            //Organisasi
            DataOPD: null,
            DataUnitKerja: null,
        }
        
    },
    methods :{
        fetchOPD: async function ()
        {
            await this.$ajax.post('/dmaster/opd',
                {
                    tahun:this.$store.getters['uifront/getTahunAnggaran'],                       
                },
                {
                    headers:{
                        Authorization:this.$store.getters['auth/Token']
                    }
                }
            ).then(({data,status})=>{
                if (status==200)
                {
                    this.daftar_opd = data.opd;   
                    this.datatableLoaded=true;     
                }
            });
        },             
        loaddatakegiatan:async function ()
        {
            this.datatableLoading=true;
            await this.$ajax.post('/report/evaluasirenjamurni',
                {
                    tahun:this.$store.getters['uifront/getTahunAnggaran'],                                           
                    OrgID:this.OrgID_Selected,                       
                },
                {
                    headers:{
                        Authorization:this.$store.getters['auth/Token']
                    }
                }
            ).then(({data})=>{              
                this.DataUnitKerja = data.unitkerja;
                this.datatable = data.rka;    
                this.total_data=data.total_data;            
                this.datatableLoaded = false;
                this.datatableLoading=false;                
            });        
        },
        isProgram(item)
        {
            return (item.RKAID == null || item.RKAID == '');            
        },
        printtoexcel:async function ()
        {
            this.btnLoading=true;
            await this.$ajax.post('/report/evaluasirenjamurni/printtoexcel',
                {
                    tahun:this.$store.getters['uifront/getTahunAnggaran'],                                           
                    OrgID:this.OrgID_Selected,                       
                },
                {
                    headers:{
                        Authorization:this.$store.getters['auth/Token']
                    },
                    responseType:'arraybuffer'
                }
            ).then(({data})=>{              
                const url = window.URL.createObjectURL(new Blob([data]));
                const link = document.createElement('a');
                link.href = url;

                link.setAttribute('download', 'evaluasi_renja_murni_'+Date.now()+'.xlsx');
                document.body.appendChild(link);
                link.click();                     
                this.btnLoading=false;
            }).catch(()=>{
                this.btnLoading=false;
            });     
        }
    },    
    computed: {
       
    },
    watch:{
        OrgID_Selected (val)
        {   
            var page = this.$store.getters['uiadmin/Page']('evaluasirenjamurni');
            if (this.firstloading == true && val.length > 0 )
            {
                page.OrgID_Selected = val;
                this.$store.dispatch('uiadmin/updatePage',page);
                this.loaddatakegiatan();

            }
            else if (this.firstloading == false && val.length > 0 )
            {
                page.OrgID_Selected = val;
                this.$store.dispatch('uiadmin/updatePage',page);
                this.loaddatakegiatan();
                this.datatableLoaded=false;
                
            }
        },
    },
    components:{
        EvaluasiRenjaLayout,
        ModuleHeader,
    },
}
</script>