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
                                    <v-form ref="frmcopyrka" v-model="form_valid" lazy-validation>
                                        <v-card>
                                            <v-card-title class="mb-2">
                                                <span class="headline">SALIN DATA KEGIATAN DARI DATA MENTAH</span>
                                            </v-card-title>
                                            <v-card-subtitle>
                                                <v-alert type="warning">
                                                    Proses ini akan menyalin kegiatan diatas ke RKA Murni.
                                                </v-alert>
                                            </v-card-subtitle>
                                            <v-card-text>
                                                <table>
                                                    <tr>
                                                        <td width="100"><strong>Kode Kelompok</strong></td>
                                                        <td width="150">{{data_rka.Kd_Urusan}}</td>
                                                        <td width="120"><strong>Nama Kelompok</strong></td>
                                                        <td>{{data_rka.Nm_Urusan}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Kode Urusan</strong></td>
                                                        <td>{{data_rka.Kd_Bidang}}</td>
                                                        <td><strong>Nama Urusan</strong></td>
                                                        <td>{{data_rka.Nm_Bidang}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Kode Program</strong></td>
                                                        <td>{{data_rka.kode_program}}</td>
                                                        <td><strong>Nama Program</strong></td>
                                                        <td>{{data_rka.PrgNm}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Kode Kegiatan</strong></td>
                                                        <td>{{data_rka.kode_kegiatan}}</td>
                                                        <td><strong>Nama Kegiatan</strong></td>
                                                        <td>{{data_rka.KgtNm}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Pagu Dana</strong></td>
                                                        <td><strong>{{data_rka.PaguDana1|formatUang}}</strong></td>                                                    
                                                    </tr>
                                                </table>                                                
                                            </v-card-text>
                                            <v-card-actions>                                    
                                                <v-spacer></v-spacer>
                                                <v-btn 
                                                    color="blue darken-1" 
                                                    text 
                                                    :loading="btnLoading"                                        
                                                    @click.stop="copyrka(data_rka)" 
                                                    :disabled="!form_valid||btnLoading">
                                                        SALIN
                                                </v-btn>
                                                <v-btn color="blue darken-1" text @click.stop="closedialogcopyrka">BATAL</v-btn>                        
                                            </v-card-actions>
                                        </v-card>                    
                                    </v-form>
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
                        <template v-slot:item.PaguDana1="{ item }">                            
                            {{ item.PaguDana1|formatUang }}
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
                                <span>salin ke RKA Murni</span>                                   
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
   </BelanjaMurniLayout>
</template>
<script>
import BelanjaMurniLayout from '@/views/layouts/BelanjaMurniLayout';
import ModuleHeader from '@/components/ModuleHeader';
export default {
    name: 'DataMentahMurni',
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
                text:'DATA MENTAH',
                disabled:true,
                href:'#'
            }
        ];
        this.$store.dispatch('uiadmin/addToPages',{
            name: 'datamentahmurni',
            OrgID_Selected:'',                        
        })
    },
    mounted()
    {
        this.fetchOPD(); 
        var OrgID_Selected=this.$store.getters['uiadmin/AtributeValueOfPage']('datamentahmurni','OrgID_Selected');          
        if (OrgID_Selected.length > 0) 
        {
            this.OrgID_Selected = OrgID_Selected;                              
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
                { text: 'KODE KELOMPOK', value: 'Kd_Urusan',width:50 },   
                { text: 'KODE URUSAN', value: 'Kd_Bidang',width:50 },   
                { text: 'KODE PROGRAM', value: 'kode_program',width:100 },   
                { text: 'NAMA PROGRAM', value: 'PrgNm',width:200},   
                { text: 'KODE KEGIATAN', value: 'kode_kegiatan',width:80 },   
                { text: 'NAMA KEGIATAN', value: 'KgtNm',width:300 },                   
                { text: 'PAGU DANA', value: 'PaguDana1',align:'end',width:100 },                   
                { text: 'STATUS', value: 'status',width:100 },                   
                { text: 'AKSI', value: 'actions', sortable: false,width:80 },
            ],
            footers :{ 
                paguopd:0,                
            },
            //filter form
            daftar_opd:[],
            OrgID_Selected : '',

            //form data
            form_valid:true,
            data_rka:{}, 
            dialogcopyrka:false,           
            
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
                paguopd:0,                
            };
            if (data.length > 0)
            {
                var totalpagukegiatan=0;
                for (var i = 0; i < data.length;i++)
                {
                    var num = new Number(data[i].PaguDana1);
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
        loaddatakegiatan:async function ()
        {
            this.datatableLoading = true;
            await this.$ajax.post('/belanja/datamentahmurni',
                {
                    tahun:this.$store.getters['uifront/getTahunAnggaran'],                       
                    OrgID:this.OrgID_Selected,                       
                },
                {
                    headers:{
                        Authorization: this.$store.getters["auth/Token"]
                    }
                }
            ).then(({data})=>{                              
                this.datatable = data.rka;
                this.datatableLoaded = true;
                this.datatableLoading = false;
                this.footersummary();
            });        
        },        
        colorStatus(status)
        {
            return status === 'SUDAH DICOPY'?'blue-grey lighten-4': 'primary'
        },
        showdialogcopyrka(item)
        {
            this.data_rka=item;
            this.dialogcopyrka=true;
        },
        closedialogcopyrka ()
        {
            this.data_rka={};
            this.dialogcopyrka=false;
        },
        async copyrka (item)
        {
            if (this.$refs.frmcopyrka.validate())
            {
                this.datatableLoading = true;
                await this.$ajax.post('/belanja/datamentahmurni/copyrka',
                    {
                        kode_kegiatan:item.kode_kegiatan,                       
                        OrgID:this.OrgID_Selected,                       
                    },
                    {
                        headers:{
                            Authorization: this.$store.getters["auth/Token"]
                        }
                    }
                ).then(()=>{                              
                    this.$router.go();
                });        
            }
        }
    },
    components: {
        BelanjaMurniLayout,
        ModuleHeader,
    },    
    watch: {
        OrgID_Selected(val)
        {   
            var page = this.$store.getters["uiadmin/Page"]('datamentahmurni');

            if (this.firstloading == false && val.length > 0 )
            {
                this.datatableLoaded=false;                
            }
            page.OrgID_Selected = val;
            this.$store.dispatch('uiadmin/updatePage',page);
            this.loaddatakegiatan();    
        },  
    }
};
</script>