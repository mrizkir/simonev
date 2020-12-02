<template>
   <BelanjaPerubahanLayout :temporaryleftsidebar="true">
       <template v-slot:system-bar>
            Tahun Anggaran: {{$store.getters['uifront/getTahunAnggaran']}} | Bulan Realisasi:{{$store.getters['uifront/getNamaBulan']}}
        </template>
       <ModuleHeader>
           <template v-slot:icon>
                mdi-graph
            </template>
            <template v-slot:name>
                FORM B UNIT KERJA PERUBAHAN
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
                    Laporan Form B Unit Kerja Rencana Kegiatan dan Anggaran (RKA) OPD APBD Perubahan   s.d <strong>BULAN {{$store.getters['uifront/getNamaBulan']}} T.A {{$store.getters['uifront/getTahunAnggaran']}}</strong>
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
                            <v-autocomplete 
                                :items="daftar_unitkerja" 
                                v-model="SOrgID_Selected"
                                label="UNIT KERJA" 
                                item-text="SOrgNm" 
                                item-value="SOrgID">                                        
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
                    <v-alert type="info">
                        Catatan: Nilai realisasi keuangan dan fisik dihitung akumulasi s.d <strong>BULAN {{$store.getters['uifront/getNamaBulan']}} T.A {{$store.getters['uifront/getTahunAnggaran']}}</strong>
                    </v-alert>
                </v-col>
                <v-col cols="12">
                    <v-data-table
                        :headers="headers"
                        :items="datatable"
                        :search="search"
                        item-key="FormBPerubahanID"                        
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
                                <tr v-for="(item) in items" v-bind:key="item.FormBPerubahanID" v-bind:class="{'indigo lighten-4 font-weight-bold':isProgram(item)}">
                                    <td>{{item.kode}}</td>
                                    <td>{{item.nama}}</td>
                                    <td class="text-right">{{item.pagu_dana2|formatUang}}</td>
                                    <td class="text-right">{{item.bobot2}}</td>                                    
                                    <td class="text-right">{{item.fisik_target2}}</td>                                    
                                    <td class="text-right">{{item.fisik_realisasi2}}</td>                                    
                                    <td class="text-right">{{item.fisik_ttb2}}</td>                                    
                                    <td class="text-right">{{item.keuangan_target2|formatUang}}</td>                                    
                                    <td class="text-right">{{item.keuangan_target_persen_2}}</td>                                    
                                    <td class="text-right">{{item.keuangan_realisasi2|formatUang}}</td>                                    
                                    <td class="text-right">{{item.keuangan_realisasi_persen_2}}</td>                                    
                                    <td class="text-right">{{item.keuangan_ttb2}}</td>                                    
                                    <td class="text-left">{{item.lokasi}}</td>                        
                                    <td class="text-right">{{item.sisa_anggaran|formatUang}}</td>                 
                                    <td class="text-right">{{item.sisa_anggaran_persen}}</td> 
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="orange font-weight-bold dark">
                                    <td colspan="2" class="text-right">TOTAL</td>
                                    <td class="text-right">{{total_data.totalPaguUnit|formatUang}}</td>
                                    <td class="text-right">{{total_data.totalPersenBobot}}</td>
                                    <td class="text-right">{{total_data.totalPersenTargetFisik}}</td>
                                    <td class="text-right">{{total_data.totalPersenRealisasiFisik}}</td>
                                    <td class="text-right">{{total_data.total_ttb_fisik}}</td>

                                    <td class="text-right">{{total_data.totalTargetKeuanganKeseluruhan|formatUang}}</td>                                    
                                    <td class="text-right">{{total_data.totalPersenTargetKeuangan}}</td>
                                    <td class="text-right">{{total_data.totalRealisasiKeuanganKeseluruhan|formatUang}}</td>
                                    <td class="text-right">{{total_data.totalPersenRealisasiKeuangan}}</td>
                                    <td class="text-right">{{total_data.total_ttb_keuangan}}</td>
                                    <td class="text-center"></td>
                                    <td class="text-right">{{total_data.totalSisaAnggaran|formatUang}}</td>
                                    <td class="text-right">{{total_data.totalPersenSisaAnggaran}}</td>
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
        <template v-slot:filtersidebar>
            <Filter2 v-on:changeBulanRealisasi="changeBulanRealisasi" ref="filter2" />	
        </template>
   </BelanjaPerubahanLayout>
</template>
<script>
import BelanjaPerubahanLayout from '@/views/layouts/BelanjaPerubahanLayout';
import ModuleHeader from '@/components/ModuleHeader';
import Filter2 from '@/components/sidebar/FilterMode2';
export default {
    name:'FormBUnitKerjaPerubahan',
    created ()
    {
        this.breadcrumbs = [
            {
                text:'HOME',
                disabled:false,
                href:'/dashboard/'+this.$store.getters['auth/AccessToken']
            },
            {
                text:'BELANJA PERUBAHAN',
                disabled:false,
                href:'/belanjaperubahan'
            },
            {
                text:'LAPORAN',
                disabled:false,
                href:'#'
            },
            {
                text:'FORM B UNIT KERJA',
                disabled:true,
                href:'#'
            }
        ];
        this.$store.dispatch('uiadmin/addToPages',{
            name:'formbunitkerjaperubahan',
            OrgID_Selected:'',
            SOrgID_Selected:'',
        })
    },
    mounted()
    {
        this.fetchOPD(); 
        var OrgID_Selected=this.$store.getters['uiadmin/AtributeValueOfPage']('formbunitkerjaperubahan','OrgID_Selected');  
        var SOrgID_Selected=this.$store.getters['uiadmin/AtributeValueOfPage']('formbunitkerjaperubahan','SOrgID_Selected');  
        if (OrgID_Selected.length > 0) 
        {
            this.OrgID_Selected = OrgID_Selected;            
            this.SOrgID_Selected = SOrgID_Selected;            
        }          
        
        if (SOrgID_Selected.length>0) 
        {
            this.OrgID_Selected = OrgID_Selected;            
            this.SOrgID_Selected = SOrgID_Selected;            

            this.firstloading=false;
            this.$refs.filter2.setFirstTimeLoading(this.firstloading);
        }        
    },
    data ()
    {
        return {
            bulan_realisasi:null,
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
                { text: 'PAGU DANA (RP)', value: 'pagu_dana2',align:'end',width:100,sortable:false },   
                { text: 'BOBOT (%)', value: 'bobot2',align:'end',width:100,sortable:false },   
                
                { text: 'TARGET FISIK (%)', value: 'fisik_target2',align:'end',width:100,sortable:false },   
                { text: 'REALISASI FISIK (%)', value: 'fisik_realisasi2',align:'end',width:100,sortable:false},                   
                { text: 'TTB FISIK (%)', value: 'fisik_ttb2',align:'end',width:100,sortable:false},                   

                { text: 'TARGET KEUANGAN (RP)', value: 'keuangan_target2',align:'end',width:100,sortable:false },   
                { text: '(%)', value: 'keuangan_target_persen_2',align:'end',width:100,sortable:false },   
                { text: 'REALISASI KEUANGAN (RP)', value: 'keuangan_realisasi2',align:'end',width:100,sortable:false },   
                { text: '(%)', value: 'keuangan_realisasi_persen_2',align:'end',width:100,sortable:false },   
                { text: 'TTB KEUANGAN (%)', value: 'keuangan_ttb2',align:'end',width:100,sortable:false },   
                
                { text: 'LOKASI', value: 'lokasi',align:'left',width:100,sortable:false },
                
                { text: 'SISA ANGGARAN (RP)', value: 'sisa_anggaran',align:'end',width:100,sortable:false },   
                { text: '(%)', value: 'sisa_anggaran_persen',align:'end',width:100,sortable:false },   
                
            ],
            total_data:{
                'totalPaguUnit':0,
                'totalTargetKeuanganKeseluruhan':0,
                'totalRealisasiKeuanganKeseluruhan':0,
                'totalPersenTargetFisik':0,
                'totalPersenRealisasiFisik':0,
                'totalPersenTargetKeuangan':0,
                'totalPersenRealisasiKeuangan':0,
                'totalSisaAnggaran':0,
                'totalPersenSisaAnggaran':0,
            },
            //filter form
            daftar_opd:[],
            OrgID_Selected : '',
            
            daftar_unitkerja:[],
            SOrgID_Selected : '',

            //Organisasi
            DataOPD: null,
            DataUnitKerja: null,
        }
        
    },
    methods :{
        changeBulanRealisasi (bulan)
        {
            this.bulan_realisasi=bulan;
        },
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
        loadunitkerja:async function ()
        {
            await this.$ajax.get('/dmaster/opd/'+this.OrgID_Selected+'/unitkerja',              
                {
                    headers:{
                        Authorization:this.$store.getters['auth/Token']
                    }
                }
            ).then(({data})=>{       
                this.DataOPD = data.organisasi;
                this.daftar_unitkerja = data.unitkerja;
                this.datatableLoaded=true;
            });      
        },              
        loaddatakegiatan:async function ()
        {
            this.datatableLoading=true;
            await this.$ajax.post('/report/formbunitkerjaperubahan',
                {
                    tahun:this.$store.getters['uifront/getTahunAnggaran'],                       
                    no_bulan:this.$store.getters['uifront/getBulanRealisasi'],                       
                    SOrgID:this.SOrgID_Selected,                       
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
            await this.$ajax.post('/report/formbunitkerjaperubahan/printtoexcel',
                {
                    tahun:this.$store.getters['uifront/getTahunAnggaran'],                       
                    no_bulan:this.$store.getters['uifront/getBulanRealisasi'],                       
                    SOrgID:this.SOrgID_Selected,                       
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

                link.setAttribute('download', 'form_b_'+Date.now()+'.xlsx');
                document.body.appendChild(link);
                link.click();                     
                this.btnLoading=false;
            }).catch(()=>{
                this.btnLoading=false;
            });     
        }
    },
    components:{
        BelanjaPerubahanLayout,
        ModuleHeader,
        Filter2
    },
    computed: {
       
    },
    watch:{
        OrgID_Selected (val)
        {   
            var page = this.$store.getters['uiadmin/Page']('formbunitkerjaperubahan');
            if (this.firstloading == true && val.length > 0 )
            {
                page.OrgID_Selected = val;
                this.$store.dispatch('uiadmin/updatePage',page);
                this.loadunitkerja();

            }
            else if (this.firstloading == false && val.length > 0 )
            {
                page.OrgID_Selected = val;
                this.$store.dispatch('uiadmin/updatePage',page);
                this.loadunitkerja();

                this.datatableLoaded=false;
                this.datatable=[];
            }
        },
        SOrgID_Selected (val)
        {   
            var page = this.$store.getters['uiadmin/Page']('formbunitkerjaperubahan');
            
            if (this.firstloading == false && val.length > 0 )
            {
                this.datatableLoaded=false;                
            }
            page.SOrgID_Selected = val;
            this.$store.dispatch('uiadmin/updatePage',page);
            this.loaddatakegiatan();            
        },
        bulan_realisasi()
        {
            if (!this.firstloading)
            {   
                this.loaddatakegiatan();                
            }            
        }, 
    }
}
</script>