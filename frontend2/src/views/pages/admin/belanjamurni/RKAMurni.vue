<template>
   <BelanjaMurniLayout :showrightsidebar="false">
       <template v-slot:system-bar>
            Tahun Anggaran: {{$store.getters['uifront/getTahunAnggaran']}} | Bulan Realisasi:{{$store.getters['uifront/getNamaBulan']}}
        </template>
        <ModuleHeader>
            <template v-slot:icon>
                mdi-graph
            </template>
            <template v-slot:name>
                RKA MURNI
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
                    Rencana Kegiatan dan Anggaran (RKA) OPD / Unit Kerja APBD Murni
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
                        item-key="RKAID"
                        sort-by="kode_kegiatan"
                        show-expand
                        dense
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
                            <v-tooltip bottom>             
                                <template v-slot:activator="{ on, attrs }">      
                                    <v-icon
                                        small
                                        v-bind="attrs"
                                        v-on="on"                                        
                                        color="primary"
                                        @click.stop="viewUraian(item)"
                                    >
                                        mdi-eye
                                    </v-icon>                                                                       
                                </template>
                                <span>detail uraian kegiatan</span>                                   
                            </v-tooltip>
                            <v-tooltip bottom>             
                                <template v-slot:activator="{ on, attrs }">      
                                    <v-icon
                                        small
                                        v-bind="attrs"
                                        v-on="on"
                                        class="ma-2"
                                        color="warning"
                                        :loading="btnLoading"
                                        :disabled="item.PaguDana1>0 || item.Locked || btnLoading"
                                        @click.stop="loaddatauraianfirsttime(item)"
                                    >
                                        mdi-sync-circle
                                    </v-icon>                                                                       
                                </template>
                                <span>load uraian</span>                                   
                            </v-tooltip>                     
                            <v-tooltip bottom>             
                                <template v-slot:activator="{ on, attrs }">      
                                    <v-icon
                                        small
                                        v-bind="attrs"
                                        v-on="on"                                        
                                        color="red"
                                        :loading="btnLoading"    
                                        :disabled="btnLoading||item.Locked"                                    
                                        @click.stop="deleteItem(item)">
                                    >
                                        mdi-delete
                                    </v-icon>                                                                       
                                </template>
                                <span>Hapus RKA</span>                                   
                            </v-tooltip>
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
                        <template v-slot:item.RealisasiKeuangan1="{ item }">                            
                            {{ item.RealisasiKeuangan1|formatUang }}
                        </template>
                        <template v-slot:item.SisaAnggaran="{ item }">                            
                            {{ (item.PaguDana1-item.RealisasiKeuangan1)|formatUang }}
                        </template>
                        <template v-slot:expanded-item="{ headers, item }">
                            <td :colspan="headers.length" class="text-center">
                                <v-col cols="12" clœass="mb1">
                                    <strong>ID:</strong>{{ item.RKAID }}                                    
                                    <strong>created_at:</strong>{{ $date(item.created_at).format('DD/MM/YYYY HH:mm') }}
                                    <strong>updated_at:</strong>{{ $date(item.created_at).format('DD/MM/YYYY HH:mm') }}
                                </v-col>                                
                            </td>
                        </template>  
                        <template v-slot:body.append>
                            <tr class="amber darken-1 font-weight-black">
                                <td colspan="3" class="text-right">TOTAL</td>
                                <td class="text-right">{{footers.pagukegiatan|formatUang}}</td>
                                <td class="text-right">{{footers.fisik}}</td>
                                <td class="text-right">{{footers.realisasi|formatUang}}</td>                                
                                <td class="text-right">{{footers.persen_keuangan.toFixed(2)}}</td>
                                <td class="text-right">{{footers.sisa|formatUang}}</td> 
                                <td></td>                               
                            </tr>
                        </template>
                        <template v-slot:no-data>                                                                                                           
                            <v-btn
                                class="ma-2"
                                :loading="btnLoading"
                                :disabled="showBtnLoadDataKegiatan || btnLoading"                                
                                color="primary"             
                                @click.stop="loaddatakegiatanFirsttime"                   
                                >
                                    LOAD DATA KEGIATAN
                                <template v-slot:loader>
                                    <span>LOADING DATA ...</span>
                                </template>
                            </v-btn>
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
    name: 'RKAMurni',
    created()
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
                text:'RKA (RENCANA KEGIATAN DAN ANGGARAN)',
                disabled:true,
                href:'#'
            }
        ];
        this.$store.dispatch('uiadmin/addToPages',{
            name: 'rkamurni',
            OrgID_Selected:'',
            SOrgID_Selected:'',
            datakegiatan: {
                RKAID: "",
            },
            datauraian:{
                RKARincID:''
            },
            datarekening: {},
        })
    },
    mounted()
    {
        this.fetchOPD(); 
        var OrgID_Selected=this.$store.getters['uiadmin/AtributeValueOfPage']('rkamurni','OrgID_Selected');  
        var SOrgID_Selected=this.$store.getters['uiadmin/AtributeValueOfPage']('rkamurni','SOrgID_Selected');  
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
    data()
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
                { text: 'KODE', value: 'kode_kegiatan',width:80 },   
                { text: 'NAMA KEGIATAN', value: 'KgtNm',width:300 },   
                { text: 'PAGU KEGIATAN', value: 'PaguDana1',align:'end',width:100 },   
                { text: 'REALISASI FISIK', value: 'RealisasiFisik1',align:'end',width:100},   
                { text: 'REALISASI KEUANGAN', value: 'RealisasiKeuangan1',align:'end',width:100 },   
                { text: '%', align:'end',value: 'persen_keuangan1',width:50},                   
                { text: 'SISA PAGU', value: 'SisaAnggaran',align:'end',width:100},   
                { text: 'AKSI', value: 'actions', sortable: false,width:110 },
            ],
            footers :{ 
                paguunitkerja:0,
                pagukegiatan:0,
                realisasi:0,
                sisa:0,
                persen_keuangan:0,
                fisik:0
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
    methods: {
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
                pagukegiatan:0,
                realisasi:0,
                sisa:0,
                persen_keuangan:0,
                fisik:0
            };
            if (data.length > 0)
            {
                var totalpagukegiatan=0;
                for (var i = 0; i < data.length;i++)
                {
                    var num = new Number(data[i].PaguDana1);
                    totalpagukegiatan+=num;
                }
                summary.paguunitkerja=this.DataUnitKerja.PaguDana1;
                summary.pagukegiatan=totalpagukegiatan;
                var totalrealisasi = parseFloat(this.DataUnitKerja.RealisasiKeuangan1);
                summary.realisasi=totalrealisasi;
                summary.sisa=totalpagukegiatan-totalrealisasi;
                summary.persen_keuangan=(totalrealisasi>0 && totalpagukegiatan >0)?((totalrealisasi/totalpagukegiatan)*100):0;
                summary.fisik=this.DataUnitKerja.RealisasiFisik1;
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
                        Authorization: this.$store.getters["auth/Token"]
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
                        Authorization: this.$store.getters["auth/Token"]
                    }
                }
            ).then(({data})=>{       
                this.DataOPD = data.organisasi;
                this.daftar_unitkerja = data.unitkerja;
                this.datatableLoaded=false;
            });      
        },
        loaddatauraianfirsttime:async function (item)
        {
            if (!item.PaguDana2 > 0)
            {            
                this.btnLoading = true;
                await this.$ajax.post('/belanja/rkamurni/loaddatauraianfirsttime',
                    {
                        RKAID: item.RKAID,                       
                    },
                    {
                        headers:{
                            Authorization: this.$store.getters["auth/Token"]
                        }
                    }
                ).then(()=>{  
                    this.$router.go();
                    this.btnLoading = false;
                }).catch(()=>{
                    this.btnLoading = false;
                });        
            }
        },           
        loaddatakegiatanFirsttime: async function ()
        {
            this.btnLoading = true;
            await this.$ajax.post('/belanja/rkamurni/loaddatakegiatanfirsttime',
                {
                    tahun:this.$store.getters['uifront/getTahunAnggaran'],                       
                    SOrgID:this.SOrgID_Selected,                       
                },
                {
                    headers:{
                        Authorization: this.$store.getters["auth/Token"]
                    }
                }
            ).then(({data})=>{                
                this.DataUnitKerja = data.unitkerja;
                this.datatable = data.rka;
                this.footersummary();
                this.btnLoading = false;
            }).catch(()=>{
                this.btnLoading = false;
            });            
        },            
        loaddatakegiatan:async function ()
        {
            this.datatableLoading = true;
            await this.$ajax.post('/belanja/rkamurni',
                {
                    tahun:this.$store.getters['uifront/getTahunAnggaran'],                       
                    SOrgID:this.SOrgID_Selected,                       
                },
                {
                    headers:{
                        Authorization: this.$store.getters["auth/Token"]
                    }
                }
            ).then(({data})=>{              
                this.DataUnitKerja = data.unitkerja;
                this.datatable = data.rka;
                this.datatableLoaded = true;
                this.datatableLoading = false;
                this.footersummary();
            });        
        },
        viewUraian (item)
        {
            var page = this.$store.getters["uiadmin/Page"]('rkamurni');  
            if (page.datakegiatan.RKAID == "")
            {
                page.datakegiatan = item;
                this.$store.dispatch('uiadmin/updatePage',page);

                this.$router.push('/belanjamurni/rka/uraian/'+page.datakegiatan.RKAID);
            }
            else
            {
                this.$root.$confirm.open('INFO', 'Kegiatan lain sedang dibuka, jadi tidak bisa membuka kegiatan ini', { color: 'warning' }).then((confirm) => {
                    if (confirm)
                    {
                        this.$router.push('/belanjamurni/rka/uraian/'+page.datakegiatan.RKAID);
                    }                
                });
            }
        },
        deleteItem (item) {           
            this.$root.$confirm.open("Delete", 'Apakah Anda ingin menghapus data RKA Murni dengan Nama "'+item.KgtNm+'" ?', { color: 'red',width:'600px' }).then((confirm) => {
                if (confirm)
                {
                    this.btnLoading = true;
                    this.$ajax.post('/belanja/rkamurni/'+item.RKAID,
                        {
                            _method: "DELETE",
                            pid: 'datarka'
                        },
                        {
                            headers:{
                                Authorization: this.$store.getters["auth/Token"]
                            }
                        }
                    ).then(()=>{   
                        this.$router.go();
                    }).catch(()=>{
                        this.btnLoading = false;
                    });
                }                
            });
        },       
    },
    components: {
        BelanjaMurniLayout,
        ModuleHeader,
    },
    computed: {
        showBtnLoadDataKegiatan()
        {
            var bool = true;
            if (this.SOrgID_Selected.length > 0 && this.datatableLoaded == true)
            {
                bool = this.datatable.length > 0;             
            }
            return bool;
        }
    },
    watch: {
        OrgID_Selected(val)
        {   
            var page = this.$store.getters["uiadmin/Page"]('rkamurni');
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
        SOrgID_Selected(val)
        {   
            var page = this.$store.getters["uiadmin/Page"]('rkamurni');
            
            if (this.firstloading == false && val.length > 0 )
            {
                this.datatableLoaded=false;                
            }
            page.SOrgID_Selected = val;
            this.$store.dispatch('uiadmin/updatePage',page);
            this.loaddatakegiatan();            
        }
    }
};
</script>