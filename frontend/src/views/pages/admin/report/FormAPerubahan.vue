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
                FORM A PERUBAHAN
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
                    Laporan Form A Rencana Kegiatan dan Anggaran (RKA) OPD / Unit Kerja APBD Perubahan s.d <strong>BULAN {{$store.getters['uifront/getNamaBulan']}} T.A {{$store.getters['uifront/getTahunAnggaran']}}</strong>
                </v-alert>
            </template>
        </ModuleHeader>
        <v-container fluid v-if="formadetail"> 
            <v-row class="mb-4" no-gutters>
                <v-col xs="12" sm="12" md="12">
                    <v-card>
                        <v-card-text>
                            <v-row no-gutters>
                                <v-col xs="12" sm="6" md="6">
                                    <v-card flat>
                                        <v-card-title>RKAID :</v-card-title>
                                        <v-card-subtitle>
                                            {{datakegiatan.RKAID}}
                                        </v-card-subtitle>                                        
                                    </v-card>
                                </v-col>
                                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>                                
                            </v-row>
                            <v-row no-gutters>
                                <v-col xs="12" sm="6" md="6">
                                    <v-card flat>
                                        <v-card-title>KODE KEGIATAN :</v-card-title>
                                        <v-card-subtitle>
                                            {{datakegiatan.kode}}
                                        </v-card-subtitle>                                        
                                    </v-card>
                                </v-col>
                                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>                                
                            </v-row>
                            <v-row no-gutters>
                                <v-col xs="12" sm="6" md="6">
                                    <v-card flat>
                                        <v-card-title>NAMA KEGIATAN :</v-card-title>
                                        <v-card-subtitle>
                                            {{datakegiatan.nama}}
                                        </v-card-subtitle>                                        
                                    </v-card>
                                </v-col>
                                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>                                
                            </v-row>
                        </v-card-text>
                    </v-card>            
                </v-col>
            </v-row>
            <v-row class="mb-4" no-gutters>
                <v-col xs="12" sm="12" md="12">
                    <v-bottom-navigation color="purple lighten-1">                        
                        <v-btn                             
                            @click.stop="printtoexcel"
                            :loading="btnLoading"
                            :disabled="btnLoading">
                            <v-icon>mdi-printer</v-icon>
                        </v-btn>
                        <v-btn @click.stop="exitforma"> 
                            <span>Keluar</span>
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                    </v-bottom-navigation>
                </v-col>
            </v-row>            
            <v-row class="mb-4" no-gutters>
                <v-col xs="12" sm="12" md="12">
                    <v-alert type="info">
                        Catatan: Nilai realisasi keuangan dan fisik dihitung akumulasi s.d <strong>BULAN {{$store.getters['uifront/getNamaBulan']}} T.A {{$store.getters['uifront/getTahunAnggaran']}}</strong>
                    </v-alert>
                    <v-data-table
                        :headers="headersdetail"
                        :items="datatabledetail"
                        :search="search"
                        item-key="FormAPerubahanDetailID"                        
                        dense                        
                        :single-expand="true"
                        class="elevation-1"
                        :loading="datatableLoading"
                        loading-text="Loading... Please wait"
                        :disable-pagination="true"
                        :hide-default-footer="true">
                    >
                        <template v-slot:body="{ items }">
                            <tbody>
                                <tr v-for="(item) in items" v-bind:key="item.FormBPerubahanID" :class="[colorRowFormA(item.tingkat)]">                                    
                                    <td>{{item.kode}}</td>                                    
                                    <td>{{item.nama_uraian}}</td>                                    
                                    <td class="text-right">{{item.totalPaguDana|formatUang}}</td>      

                                    <td class="text-right" v-if="item.tingkat==1 || item.tingkat==2">
                                        &nbsp;
                                    </td>                                    
                                    <td class="text-right" v-else>
                                        {{item.persen_bobot|makeLookPrecision}}
                                    </td>                    

                                    <td class="text-right" v-if="item.tingkat==1 || item.tingkat==2">
                                        &nbsp;
                                    </td>                                    
                                    <td class="text-right" v-else>
                                        {{item.persen_rata2_fisik|makeLookPrecision}}
                                    </td>                    

                                    <td class="text-right" v-if="item.tingkat==1 || item.tingkat==2">
                                        &nbsp;
                                    </td>                                    
                                    <td class="text-right" v-else>
                                        {{item.persen_tertimbang_fisik|makeLookPrecision}}
                                    </td>                    

                                    <td class="text-right" v-if="item.tingkat==1 || item.tingkat==2">
                                        &nbsp;
                                    </td>                                    
                                    <td class="text-right" v-else>
                                        {{item.total_target|formatUang}}
                                    </td>                    

                                    <td class="text-right" v-if="item.tingkat==1 || item.tingkat==2">
                                        &nbsp;
                                    </td>                                    
                                    <td class="text-right" v-else>
                                        {{item.total_realisasi|formatUang}}
                                    </td>                    

                                    <td class="text-right" v-if="item.tingkat==1 || item.tingkat==2">
                                        &nbsp;
                                    </td>                                    
                                    <td class="text-right" v-else>
                                        {{item.persen_realisasi|makeLookPrecision}}
                                    </td>                   

                                    <td class="text-right" v-if="item.tingkat==1 || item.tingkat==2">
                                        &nbsp;
                                    </td>                                    
                                    <td class="text-right" v-else>
                                        {{item.persen_tertimbang_realisasi|makeLookPrecision}}
                                    </td>                    

                                    <td class="text-right" v-if="item.tingkat==1 || item.tingkat==2">
                                        &nbsp;
                                    </td>                                    
                                    <td class="text-right" v-else>
                                        {{item.sisa_anggaran|formatUang}}
                                    </td>                                                        
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="orange font-weight-bold dark">
                                    <td colspan="2" class="text-right">TOTAL</td>
                                    <td class="text-right">{{total_forma.totalPaguDana|formatUang}}</td>                                    
                                    <td class="text-right">{{total_forma.totalPersenBobot|makeLookPrecision}}</td>                                    
                                    <td class="text-right">{{total_forma.totalRealisasiFisik|makeLookPrecision}}</td>                                    
                                    <td class="text-right">{{total_forma.totalPersenTertimbangFisikSatuKegiatan|makeLookPrecision}}</td>                                    
                                    <td class="text-right">{{total_forma.totalTargetSatuKegiatan|formatUang}}</td>                                    
                                    <td class="text-right">{{total_forma.totalRealisasiSatuKegiatan|formatUang}}</td>                                    
                                    <td class="text-right">{{total_forma.total_persen_rata2_realisasi|makeLookPrecision}}</td>                                    
                                    <td class="text-right">{{total_forma.totalPersenTertimbangRealisasiSatuKegiatan|makeLookPrecision}}</td>                                    
                                    <td class="text-right">{{total_forma.sisa_anggaran|formatUang}}</td>                                    
                                </tr>
                            </tfoot>
                        </template>
                    </v-data-table>
                </v-col>
            </v-row>
        </v-container>
        <v-container fluid v-else>    
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
                    <v-data-table
                        :headers="headers"
                        :items="datatable"
                        :search="search"
                        item-key="FormAPerubahanID"                        
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
                            </v-toolbar>
                        </template>                  
                        <template v-slot:body="{ items }">
                            <tbody>
                                <tr v-for="(item) in items" v-bind:key="item.FormBPerubahanID" v-bind:class="{'indigo lighten-4 font-weight-bold':isProgram(item)}">                                    
                                    <td v-if="isProgram(item)">
                                        {{item.kode}}
                                    </td>
                                    <td v-else>
                                        <v-btn color="primary" @click.stop="viewitem(item)" text link dense>
                                            {{item.kode}}
                                        </v-btn>
                                    </td>
                                    <td>{{item.nama}}</td>
                                    <td class="text-right">{{item.pagu_dana2|formatUang}}</td>                                                                      
                                    <td class="text-right">{{item.fisik_target2|makeLookPrecision}}</td>                                    
                                    <td class="text-right">{{item.fisik_realisasi2|makeLookPrecision}}</td>                                                                        
                                    <td class="text-right">{{item.keuangan_target2|formatUang}}</td>                                                                        
                                    <td class="text-right">{{item.keuangan_realisasi2|formatUang}}</td>                                 
                                    <td class="text-right">{{item.keuangan_realisasi_persen_2|makeLookPrecision}}</td>                                 
                                    <td class="text-right">{{item.sisa_anggaran|formatUang}}</td>                                                    
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="orange font-weight-bold dark">
                                    <td colspan="2" class="text-right">TOTAL</td>
                                    <td class="text-right">{{total_data.totalPaguUnit|formatUang}}</td>                                    
                                    <td class="text-right">{{total_data.totalPersenTargetFisik|makeLookPrecision}}</td>
                                    <td class="text-right">{{total_data.totalPersenRealisasiFisik|makeLookPrecision}}</td>                                    
                                    <td class="text-right">{{total_data.totalTargetKeuanganKeseluruhan|formatUang}}</td>                                                                        
                                    <td class="text-right">{{total_data.totalRealisasiKeuanganKeseluruhan|formatUang}}</td>                                    
                                    <td class="text-right">{{total_data.totalPersenTargetKeuangan|makeLookPrecision}}</td>                                    
                                    <td class="text-right">{{total_data.totalSisaAnggaran|formatUang}}</td>                                    
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
    name:'FormAPerubahan',
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
                text:'FORM A',
                disabled:true,
                href:'#'
            }
        ];
        this.$store.dispatch('uiadmin/addToPages',{
            name:'formaperubahan',
            OrgID_Selected:'',
            SOrgID_Selected:'',
            datakegiatan:[],
            formadetail:false,
        })        
    },
    mounted()
    {
        this.formadetail=this.$store.getters['uiadmin/AtributeValueOfPage']('formaperubahan','formadetail');  
        if (this.formadetail)
        {
            this.initalizeforma(); 
            this.firstloading=false;
            this.$refs.filter2.setFirstTimeLoading(this.firstloading);           
        }
        else
        {
            this.fetchOPD(); 
            var OrgID_Selected=this.$store.getters['uiadmin/AtributeValueOfPage']('formaperubahan','OrgID_Selected');  
            var SOrgID_Selected=this.$store.getters['uiadmin/AtributeValueOfPage']('formaperubahan','SOrgID_Selected');  
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
        }        
    },
    data ()
    {
        return {
            bulan_realisasi:null,
            datakegiatan:[],
            formadetail:false,
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
                
                { text: 'TARGET FISIK (%)', value: 'fisik_target2',align:'end',width:100,sortable:false },   
                { text: 'REALISASI FISIK (%)', value: 'fisik_realisasi2',align:'end',width:100,sortable:false},                                   

                { text: 'TARGET KEUANGAN (RP)', value: 'keuangan_target2',align:'end',width:100,sortable:false },                   
                { text: 'REALISASI KEUANGAN (RP)', value: 'keuangan_realisasi2',align:'end',width:100,sortable:false },                                                 
                { text: '%', value: 'keuangan_realisasi_persen_2',align:'end',width:100,sortable:false },                                                 
                { text: 'SISA ANGGARAN (RP)', value: 'sisa_anggaran',align:'end',width:100,sortable:false },   
            ],
            total_data:{
                'totalPaguUnit':0,
                'totalTargetKeuanganKeseluruhan':0,
                'totalRealisasiKeuanganKeseluruhan':0,
                'totalPersenTargetFisik':0,
                'totalPersenRealisasiFisik':0,
                'totalSisaAnggaran':0,                
            },
            total_forma:{
                'totalPaguDana':0,
                'totalPersenBobot':0,
                'totalRealisasiKeuanganKeseluruhan':0,
                'totalPersenTargetFisik':0,
                'totalPersenRealisasiFisik':0,
                'totalPersenTargetKeuangan':0,
                'totalPersenRealisasiKeuangan':0,
                'totalSisaAnggaran':0,
                'totalPersenSisaAnggaran':0,
            },
            //headers detail form 
            datatabledetail:[],
            headersdetail: [                        
                { text: 'KODE REKENING', value: 'kode',width:80,sortable:false },   
                { text: 'URAIAN', value: 'nama_uraian',width:300,sortable:false },   
                { text: 'JUMLAH', value: 'totalPaguDana',align:'end',width:100,sortable:false },   
                { text: 'BOBOT (%)', value: 'persen_bobot',align:'end',width:100,sortable:false },   
                
                { text: 'REALISASI FISIK (%)', value: 'persen_rata2_fisik',align:'end',width:100,sortable:false},                   
                { text: 'TTB FISIK (%)', value: 'persen_tertimbang_fisik',align:'end',width:100,sortable:false},                   

                { text: 'TARGET KEUANGAN (RP)', value: 'total_target',align:'end',width:100,sortable:false },                   
                { text: 'REALISASI KEUANGAN (RP)', value: 'total_realisasi',align:'end',width:100,sortable:false },   
                { text: '(%)', value: 'persen_realisasi',align:'end',width:100,sortable:false },   
                { text: 'TTB KEUANGAN (%)', value: 'persen_tertimbang_realisasi',align:'end',width:100,sortable:false },                   

                { text: 'SISA ANGGARAN (RP)', value: 'sisa_anggaran',align:'end',width:100,sortable:false },   
                
            ],
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
        viewitem (item)
        {
            this.formadetail=true;
            var page = this.$store.getters['uiadmin/Page']('formaperubahan');
            page.formadetail=true;
            page.datakegiatan=item;
            this.$store.dispatch('uiadmin/updatePage',page);      
            this.initalizeforma(); 
            this.$router.replace('/belanjaperubahan/report/forma/'+item.RKAID) ;
        },
        initalizeforma:async function ()
        {
            var page = this.$store.getters['uiadmin/Page']('formaperubahan');
            this.datakegiatan=page.datakegiatan;            
            let RKAID=this.datakegiatan.RKAID;

            await this.$ajax.post('/report/formaperubahan',
                {
                    RKAID:RKAID,                       
                    no_bulan:this.$store.getters['uifront/getBulanRealisasi'],                                                     
                },
                {
                    headers:{
                        Authorization:this.$store.getters['auth/Token']
                    }
                }
            ).then(({data})=>{            
                this.total_forma=data.total_data;  
                this.datatabledetail=data.rka;              
            });
        },
        colorRowFormA(tingkat)
        {
            var color = '';
            switch(tingkat)
            {
                case 4:
                    color='lime lighten-3';
                break;
                case 5:
                    color='blue lighten-4';
                break;
                case 6:
                    color='blue lighten-5';
                break;
            }
            return color;
        },
        printtoexcel:async function ()
        {
            var SOrgID_Selected=this.$store.getters['uiadmin/AtributeValueOfPage']('formaperubahan','SOrgID_Selected');  
            this.btnLoading=true;
            await this.$ajax.post('/report/formaperubahan/printtoexcel',
                {                 
                    SOrgID:SOrgID_Selected,
                    RKAID:this.datakegiatan.RKAID,                       
                    no_bulan:this.$store.getters['uifront/getBulanRealisasi'],                                           
                    tahun:this.$store.getters['uifront/getTahunAnggaran'],                                           
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

                link.setAttribute('download', 'form_a_'+Date.now()+'.xlsx');
                document.body.appendChild(link);
                link.click();                     
                this.btnLoading=false;
            }).catch(()=>{
                this.btnLoading=false;
            });     
        },
        exitforma()
        {
            var page = this.$store.getters['uiadmin/Page']('formaperubahan');
            page.formadetail=false;
            page.datakegiatan=[];
            this.$store.dispatch('uiadmin/updatePage',page);                               
            this.$router.go() ;
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
            var page = this.$store.getters['uiadmin/Page']('formaperubahan');
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
            var page = this.$store.getters['uiadmin/Page']('formaperubahan');
            
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
                if (this.formadetail)
                {
                    this.initalizeforma();
                }
                else
                {
                    this.loaddatakegiatan();
                }
            }            
        }, 

    }
}
</script>