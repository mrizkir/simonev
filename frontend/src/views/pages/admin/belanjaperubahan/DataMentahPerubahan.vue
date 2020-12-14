<template>
   <BelanjaPerubahanLayout :showrightsidebar="false">
       <template v-slot:system-bar>
            Tahun Anggaran: {{$store.getters['uifront/getTahunAnggaran']}} | Bulan Realisasi:{{$store.getters['uifront/getNamaBulan']}}
        </template>
        <ModuleHeader>
            <template v-slot:icon>
                mdi-database
            </template>
            <template v-slot:name>
                DATA MENTAH
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
                    Halaman ini berisi data mentah hasil integrasi dari SIMDA KEUANGAN.
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
                        item-key="kode_kegiatan"
                        sort-by="kode_kegiatan"
                        show-expand                        
                        :expanded.sync="expanded"
                        :single-expand="true"
                        class="elevation-1"
                        :loading="datatableLoading"
                        loading-text="Loading... Please wait"
                        @click:row="dataTableRowClicked">
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
                                <v-dialog v-model="dialogcopyrka" max-width="700px" persistent>                 
                                    <v-card>
                                        <v-card-title class="mb-2">
                                            <span class="headline">SALIN DATA KEGIATAN DARI DATA MENTAH</span>
                                        </v-card-title>
                                        <v-card-subtitle>
                                            <v-alert type="warning">
                                                Tentukan Unit Kerja yang akan menerima data kegiatan ini, selanjutnya tekan tombol salin.
                                            </v-alert>
                                        </v-card-subtitle>
                                        <v-card-text>
                                            <v-autocomplete 
                                                :items="daftar_unitkerja" 
                                                v-model="SOrgID_Selected"
                                                label="UNIT KERJA" 
                                                item-text="SOrgNm" 
                                                item-value="SOrgID">                                        
                                            </v-autocomplete> 
                                        </v-card-text>
                                        <v-card-actions>                                    
                                            <v-spacer></v-spacer>
                                            <v-btn color="blue darken-1" text @click.stop="closedialogcopykegiatan">BATAL</v-btn>                        
                                        </v-card-actions>
                                    </v-card>                    
                                </v-dialog>
                            </v-toolbar>
                        </template>
                        <template v-slot:item.actions="{ item }">                            
                            <v-icon
                                small
                                class="mr-2"
                                v-if="item.Locked">
                                mdi-lock
                            </v-icon>
                        </template>
                        <template v-slot:item.PaguDana2="{ item }">                            
                            {{ item.PaguDana2|formatUang }}
                        </template>
                        <template v-slot:item.status="{ item }">                            
                            <v-chip label outlined :color="colorStatus(item.status)">
                                {{item.status}}
                            </v-chip>
                        </template>       
                        <template v-slot:item.actions="{ item }">                            
                            <v-tooltip bottom>             
                                <template v-slot:activator="{ on, attrs }">                                             
                                    <v-btn 
                                        v-bind="attrs"
                                        v-on="on"
                                        color="primary" 
                                        icon 
                                        outlined 
                                        small 
                                        class="ma-2" 
                                        @click.stop="showdialogcopyrka(item)"
                                        :disabled="item.status=='SUDAH DICOPY'">
                                        <v-icon small>mdi-content-copy</v-icon>
                                    </v-btn>     
                                </template>
                                <span>salin ke RKA Perubahan</span>                                   
                            </v-tooltip>
                        </template>
                        <template v-slot:expanded-item="{ headers, item }">
                            <td :colspan="headers.length" class="text-center">
                                <v-col cols="12" clœass="mb1">
                                    <strong>ID:</strong>{{ item.kode_kegiatan }}                                    
                                    <strong>created_at:</strong>{{ $date(item.created_at).format('DD/MM/YYYY HH:mm') }}
                                    <strong>updated_at:</strong>{{ $date(item.created_at).format('DD/MM/YYYY HH:mm') }}
                                </v-col>                                
                            </td>
                        </template>  
                        <template v-slot:body.append>
                            <tr class="amber darken-1 font-weight-black">
                                <td colspan="7" class="text-right">TOTAL</td>
                                <td class="text-right">{{footers.paguopd|formatUang}}</td>                                
                                <td></td>                               
                                <td></td>                               
                            </tr>
                        </template>
                        <template v-slot:no-data>                                                                                                           
                            Tidak ada data hasil integrasi dari SIMDA KEUANGAN
                        </template>                 
                    </v-data-table>
                </v-col>
            </v-row>             
        </v-container>
   </BelanjaPerubahanLayout>
</template>
<script>
import BelanjaPerubahanLayout from '@/views/layouts/BelanjaPerubahanLayout';
import ModuleHeader from '@/components/ModuleHeader';
export default {
    name:'DataMentahPerubahan',
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
                text:'DATA MENTAH',
                disabled:true,
                href:'#'
            }
        ];
        this.$store.dispatch('uiadmin/addToPages',{
            name:'datamentahperubahan',
            OrgID_Selected:'',            
            datakegiatan:{
                kode_kegiatan:'',
            },       
        })
    },
    mounted()
    {
        this.fetchOPD(); 
        var OrgID_Selected=this.$store.getters['uiadmin/AtributeValueOfPage']('datamentahperubahan','OrgID_Selected');          
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
            datatableLoaded:false,
            datatable:[],
            headers: [                        
                { text: 'KODE KELOMPOK', value: 'Kd_Urusan',width:50 },   
                { text: 'KODE URUSAN', value: 'Kd_Bidang',width:50 },   
                { text: 'KODE PROGRAM', value: 'kode_program',width:100 },   
                { text: 'NAMA PROGRAM', value: 'PrgNm',width:200},   
                { text: 'KODE KEGIATAN', value: 'kode_kegiatan',width:80 },   
                { text: 'NAMA KEGIATAN', value: 'KgtNm',width:300 },                   
                { text: 'PAGU DANA', value: 'PaguDana2',align:'end',width:100 },                   
                { text: 'STATUS', value: 'status',width:100 },                   
                { text: 'AKSI', value: 'actions', sortable: false,width:80 },
            ],
            footers :{ 
                paguopd:0,                
            },
            //filter form
            daftar_opd:[],
            OrgID_Selected : '',

            daftar_unitkerja:[],
            SOrgID_Selected : '',
            
            //form data
            data_rka:{}, 
            dialogcopyrka:false           
        }
        
    },
    methods :{
        dataTableRowClicked(item)
        {
            if ( item === this.expanded[0])
            {
                this.expanded=[];                
            }
            else
            {
                this.expanded=[item];
            }               
        },   
        footersummary()
        {
            let data = this.datatable;            
            var summary = { 
                paguopd:0,                
            };
            if (data.length > 0)
            {
                var totalpagukegiatan=0;
                for (var i = 0; i < data.length;i++)
                {
                    var num = new Number(data[i].PaguDana2);
                    totalpagukegiatan+=num;
                }
                summary.paguopd=totalpagukegiatan;                
            }
            this.footers = summary;
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
                    this.datatableLoaded=false;     
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
                this.daftar_unitkerja = data.unitkerja;                
            });      
        },
        loaddatakegiatan:async function ()
        {
            this.datatableLoading=true;
            await this.$ajax.post('/belanja/datamentahperubahan',
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
                this.datatable = data.rka;
                this.datatableLoaded = true;
                this.datatableLoading=false;
                this.footersummary();
            });        
        },        
        colorStatus(status)
        {
            return status === 'SUDAH DICOPY'?'blue-grey lighten-4':'primary'
        },
        showdialogcopyrka()
        {
            this.dialogcopyrka=true;
        },
        async copyrka (item)
        {
            this.datatableLoading=true;
            await this.$ajax.post('/belanja/datamentahperubahan/copyka',
                {
                    kode_kegiatan:item.kode_kegiatan,                       
                    SOrgID:this.SOrgID_Selected,                       
                },
                {
                    headers:{
                        Authorization:this.$store.getters['auth/Token']
                    }
                }
            ).then(({data})=>{                              
                console.log(data);
            });        
        }
    },
    components:{
        BelanjaPerubahanLayout,
        ModuleHeader,
    },    
    watch:{
        OrgID_Selected (val)
        {   
            var page = this.$store.getters['uiadmin/Page']('datamentahperubahan');

            if (this.firstloading == false && val.length > 0 )
            {
                this.datatableLoaded=false;                
            }
            page.OrgID_Selected = val;
            this.$store.dispatch('uiadmin/updatePage',page);
            this.loaddatakegiatan();    

            this.loadunitkerja();
        },  
    }
}
</script>