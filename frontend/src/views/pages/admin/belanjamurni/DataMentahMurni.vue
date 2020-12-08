<template>
   <BelanjaMurniLayout :showrightsidebar="false">
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
                        <template v-slot:item.PaguDana1="{ item }">                            
                            {{ item.PaguDana1|formatUang }}
                        </template>
                        <template v-slot:item.status="{ item }">                            
                            <v-chip label outlined color="primary">
                                {{item.status}}
                            </v-chip>
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
                                <td colspan="5" class="text-right">TOTAL</td>
                                <td class="text-right">{{footers.paguunitkerja|formatUang}}</td>                                
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
   </BelanjaMurniLayout>
</template>
<script>
import BelanjaMurniLayout from '@/views/layouts/BelanjaMurniLayout';
import ModuleHeader from '@/components/ModuleHeader';
export default {
    name:'DataMentahMurni',
    created ()
    {
        this.breadcrumbs = [
            {
                text:'HOME',
                disabled:false,
                href:'/dashboard/'+this.$store.getters['auth/AccessToken']
            },
            {
                text:'BELANJA MURNI',
                disabled:false,
                href:'/belanjamurni'
            },
            {
                text:'DATA MENTAH',
                disabled:true,
                href:'#'
            }
        ];
        this.$store.dispatch('uiadmin/addToPages',{
            name:'datamentahmurni',
            OrgID_Selected:'',
            SOrgID_Selected:'',
            datakegiatan:{
                kode_kegiatan:'',
            },
            datauraian:{
                RKARincID:''
            },
            datarekening:{},
        })
    },
    mounted()
    {
        this.fetchOPD(); 
        var OrgID_Selected=this.$store.getters['uiadmin/AtributeValueOfPage']('datamentahmurni','OrgID_Selected');  
        var SOrgID_Selected=this.$store.getters['uiadmin/AtributeValueOfPage']('datamentahmurni','SOrgID_Selected');  
        if (OrgID_Selected.length > 0) 
        {
            this.OrgID_Selected = OrgID_Selected;            
            this.SOrgID_Selected = SOrgID_Selected;            
        }          
        
        if (SOrgID_Selected.length>0) 
        {
            this.OrgID_Selected = OrgID_Selected;            
            this.SOrgID_Selected = SOrgID_Selected;            
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
                { text: 'KODE PROGRAM', value: 'kode_program',width:100 },   
                { text: 'NAMA PROGRAM', value: 'PrgNm',width:200},   
                { text: 'KODE KEGIATAN', value: 'kode_kegiatan',width:80 },   
                { text: 'NAMA KEGIATAN', value: 'KgtNm',width:300 },                   
                { text: 'PAGU DANA', value: 'PaguDana1',align:'end',width:100 },                   
                { text: 'STATUS', value: 'status',width:100 },                   
                { text: 'AKSI', value: 'actions', sortable: false,width:80 },
            ],
            footers :{ 
                paguunitkerja:0,                
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
                paguunitkerja:0,                
            };
            if (data.length > 0)
            {
                var totalpagukegiatan=0;
                for (var i = 0; i < data.length;i++)
                {
                    var num = new Number(data[i].PaguDana1);
                    totalpagukegiatan+=num;
                }
                summary.paguunitkerja=totalpagukegiatan;                
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
                this.DataOPD = data.organisasi;
                this.daftar_unitkerja = data.unitkerja;
                this.datatableLoaded=false;
            });      
        },        
        loaddatakegiatan:async function ()
        {
            this.datatableLoading=true;
            await this.$ajax.post('/belanja/datamentahmurni',
                {
                    tahun:this.$store.getters['uifront/getTahunAnggaran'],                       
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
                this.datatableLoaded = true;
                this.datatableLoading=false;
                this.footersummary();
            });        
        },        
    },
    components:{
        BelanjaMurniLayout,
        ModuleHeader,
    },    
    watch:{
        OrgID_Selected (val)
        {   
            var page = this.$store.getters['uiadmin/Page']('datamentahmurni');
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
            var page = this.$store.getters['uiadmin/Page']('datamentahmurni');
            
            if (this.firstloading == false && val.length > 0 )
            {
                this.datatableLoaded=false;                
            }
            page.SOrgID_Selected = val;
            this.$store.dispatch('uiadmin/updatePage',page);
            this.loaddatakegiatan();            
        }
    }
}
</script>