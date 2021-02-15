<template>
    <DataMasterLayout :showrightsidebar="false">
        <template v-slot:system-bar>
            Tahun Anggaran: {{$store.getters['uifront/getTahunAnggaran']}} | Bulan Realisasi:{{$store.getters['uifront/getNamaBulan']}}
        </template>
        <ModuleHeader>
            <template v-slot:icon>
                mdi-account-circle
            </template>
            <template v-slot:name>
                PEJABAT
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
                    type="info">
                    Pejabat untuk kegiatan masing-masing OPD seperti (PA, KPA, PPK, dan PPTK) 
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
                                filled
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
                        item-key="RiwayatJabatanASNID"
                        sort-by="Nm_ASN"
                        show-expand
                        :expanded.sync="expanded"
                        :single-expand="true"
                        class="elevation-1"
                        :loading="datatableLoading"
                        loading-text="Loading... Please wait"
                        @click:row="dataTableRowClicked"
                    >
                        <template v-slot:top>
                            <v-toolbar flat color="white">
                                <v-toolbar-title>DAFTAR ASN</v-toolbar-title>
                                <v-divider
                                    class="mx-4"
                                    inset
                                    vertical
                                ></v-divider>
                                <v-spacer></v-spacer>
                                <v-btn 
                                    color="primary"                                      
                                    class="mb-2" 
                                    :loading="btnLoading"
                                    :disabled="!OrgID_Selected.length > 0 || btnLoading"
                                    @click.stop="addItem">
                                        TAMBAH
                                </v-btn>
                                <v-dialog v-model="dialogfrm" max-width="800px" persistent>                                    
                                    <v-form ref="frmdata" v-model="form_valid" lazy-validation>
                                        <v-card>
                                            <v-card-title>
                                                <span class="headline">{{ formtitle }}</span>
                                            </v-card-title>
                                            <v-card-text>                                                                                                
                                                <v-autocomplete 
                                                    :items="daftar_opd" 
                                                    v-model="formdata.OrgID"
                                                    label="OPD / SKPD" 
                                                    item-text="OrgNm" 
                                                    item-value="OrgID"
                                                    filled
                                                    :disabled="true">                                        
                                                </v-autocomplete>                                                 
                                                <v-autocomplete 
                                                    filled
                                                    :items="daftar_asn" 
                                                    v-model="formdata.ASNID"
                                                    label="NAMA ASN" 
                                                    item-text="Nm_ASN" 
                                                    item-value="ASNID"
                                                    :rules="rule_nama_asn">                                        
                                                </v-autocomplete>                                                 
                                                <v-select
                                                    v-model="formdata.Jenis_Jabatan"                                                                
                                                    :items="daftar_jenisjabatan"
                                                    item-text="value"
                                                    item-value="key"
                                                    label="JENIS JABATAN"
                                                    :rules="rule_jenis_jabatan"
                                                    single-line
                                                ></v-select>                                                
                                            </v-card-text>
                                            <v-card-actions>
                                                <v-spacer></v-spacer>
                                                <v-btn color="blue darken-1" text @click.stop="closedialogfrm">BATAL</v-btn>
                                                <v-btn 
                                                    color="blue darken-1" 
                                                    text 
                                                    @click.stop="save" 
                                                    :loading="btnLoading"
                                                    :disabled="!form_valid||btnLoading">
                                                        SIMPAN                                                        
                                                </v-btn>
                                            </v-card-actions>
                                        </v-card>
                                    </v-form>
                                </v-dialog>      
                                <v-dialog v-model="dialogdetailitem" max-width="800px" persistent>
                                    <v-card>
                                        <v-card-title>
                                            <span class="headline">DETAIL DATA</span>
                                        </v-card-title>
                                        <v-card-text>     
                                            <v-row no-gutters> 
                                                <v-col xs="12" sm="6" md="6">
                                                    <v-card flat>                                        
                                                        <v-card-title>
                                                            ASNID
                                                        </v-card-title>
                                                        <v-card-subtitle>
                                                            {{formdata.ASNID}}
                                                        </v-card-subtitle>
                                                    </v-card>
                                                </v-col>
                                                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                                                <v-col xs="12" sm="6" md="6">
                                                    <v-card flat>                                        
                                                        <v-card-title>
                                                            KETERANGAN
                                                        </v-card-title>
                                                        <v-card-subtitle>
                                                            {{formdata.Jenis_Jabatan.toUpperCase()}}
                                                        </v-card-subtitle>
                                                    </v-card>
                                                </v-col>
                                                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                                            </v-row>
                                            <v-row no-gutters> 
                                                <v-col xs="12" sm="6" md="6">
                                                    <v-card flat>                                        
                                                        <v-card-title>
                                                            NIP ASN
                                                        </v-card-title>
                                                        <v-card-subtitle>
                                                            {{formdata.NIP_ASN}}
                                                        </v-card-subtitle>
                                                    </v-card>
                                                </v-col>
                                                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                                                <v-col xs="12" sm="6" md="6">
                                                    <v-card flat>                                        
                                                        <v-card-title>
                                                            CREATED
                                                        </v-card-title>
                                                        <v-card-subtitle>
                                                            {{$date(formdata.created_at).format('DD/MM/YYYY HH:mm')}}
                                                        </v-card-subtitle>
                                                    </v-card>
                                                </v-col>
                                                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                                            </v-row>
                                            <v-row no-gutters> 
                                                <v-col xs="12" sm="6" md="6">
                                                    <v-card flat>                                        
                                                        <v-card-title>
                                                            NAMA ASN
                                                        </v-card-title>
                                                        <v-card-subtitle>
                                                            {{formdata.Nm_ASN}}
                                                        </v-card-subtitle>
                                                    </v-card>
                                                </v-col>
                                                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                                                <v-col xs="12" sm="6" md="6">
                                                    <v-card flat>                                        
                                                        <v-card-title>
                                                            UPDATED
                                                        </v-card-title>
                                                        <v-card-subtitle>
                                                            {{$date(formdata.updated_at).format('DD/MM/YYYY HH:mm')}}
                                                        </v-card-subtitle>
                                                    </v-card>
                                                </v-col>
                                                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                                            </v-row>
                                        </v-card-text>
                                        <v-card-actions>
                                            <v-spacer></v-spacer>
                                            <v-btn color="blue darken-1" text @click.stop="closedialogdetailitem">KELUAR</v-btn>
                                        </v-card-actions>
                                    </v-card>                                    
                                </v-dialog>                          
                            </v-toolbar>
                        </template>
                        <template v-slot:item.actions="{ item }">
                            <v-icon
                                small
                                class="mr-2"
                                @click.stop="viewItem(item)"
                            >
                                mdi-eye
                            </v-icon>                 
                            <v-icon
                                small
                                :loading="btnLoading"
                                :disabled="btnLoading"
                                @click.stop="deleteItem(item)"
                            >
                                mdi-delete
                            </v-icon>
                        </template>
                        <template v-slot:expanded-item="{ headers, item }">
                            <td :colspan="headers.length" class="text-center">
                                <strong>ID:</strong>{{ item.RiwayatJabatanASNID }}
                                <strong>created_at:</strong>{{ $date(item.created_at).format('DD/MM/YYYY HH:mm') }}
                                <strong>updated_at:</strong>{{ $date(item.updated_at).format('DD/MM/YYYY HH:mm') }}
                            </td>
                        </template>
                        <template v-slot:item.Jenis_Jabatan="{ item }">                            
                            {{ item.Jenis_Jabatan.toUpperCase() }}
                        </template>
                        <template v-slot:no-data>
                            Data belum tersedia
                        </template>
                    </v-data-table>
                </v-col>
             </v-row>
        </v-container>
    </DataMasterLayout>
</template>
<script>

import DataMasterLayout from '@/views/layouts/DataMasterLayout';
import ModuleHeader from '@/components/ModuleHeader';
export default {
    name:'Pejabat',
    created () 
    {
        this.breadcrumbs = [
            {
                text:'HOME',
                disabled:false,
                href:'/dashboard/'+this.$store.getters['auth/AccessToken']
            },
            {
                text:'DATA MASTER',
                disabled:false,
                href:'#'
            },
            {
                text:'PEJABAT',
                disabled:true,
                href:'#'
            }
        ];
        this.$store.dispatch('uiadmin/addToPages',{
            name:'pejabat',
            OrgID_Selected:'',
        });            
    }, 
    mounted() 
    {
        this.fetchOPD();     
        var OrgID_Selected=this.$store.getters['uiadmin/AtributeValueOfPage']('pejabat','OrgID_Selected');  
        if (OrgID_Selected.length > 0) 
        {
            this.OrgID_Selected = OrgID_Selected;                                  
        }  
    },
    data ()
    {
        return {
            btnLoading:false,
            datatableLoading:false,
            expanded:[],
            datatable:[],
            headers: [                        
                { text: 'NIP ASN', value: 'NIP_ASN',width:150 },   
                { text: 'NAMA ASN', value: 'Nm_ASN' },   
                { text: 'JENIS JABATAN', value: 'Jenis_Jabatan' },   
                { text: 'AKSI', value: 'actions', sortable: false,width:100 },
            ],
            search:'',    
            //filter form
            daftar_opd:[],
            OrgID_Selected : '',

            //dialog
            dialogfrm:false,
            dialogdetailitem:false,

            //form data   
            form_valid:true,   
            daftar_asn:[],      
            daftar_jenisjabatan:[
                {
                    key:'pa',
                    value:'PENGGUNA ANGGARAN'
                },
                {
                    key:'kpa',
                    value:'KUASA PENGGUNA ANGGARAN'
                },
                {
                    key:'ppk',
                    value:'PEJABAT PEMBUAT KOMITMEN'
                },
                {
                    key:'pptk',
                    value:'PEJABAT PELAKSANA TEKNIS KEGIATAN'
                },
            ],
            formdata: {
                RiwayatJabatanASNID:'',                        
                OrgID:'',                        
                ASNID:'',                        
                NIP_ASN:'',                        
                Nm_ASN:'',                        
                Jenis_Jabatan:'',                        
                TA:'',                        
                created_at: '',           
                updated_at: '',           

            },
            formdefault: {
                RiwayatJabatanASNID:'',                        
                OrgID:'',                        
                NIP_ASN:'',                        
                Nm_ASN:'',                        
                Jenis_Jabatan:'',                        
                TA:'',                        
                created_at: '',           
                updated_at: '',        
            },
            editedIndex: -1,

            //form rules  
            rule_nama_asn:[
                value => !!value||"Mohon untuk di pilih nama ASN !!!",                     
            ], 
            rule_jenis_jabatan:[
                value => !!value||"Mohon untuk di pilih Jenis Jabatan !!!",                                  
            ], 
        };
    },
    methods: {
        initialize:async function (OrgID_Selected) 
        {    
            this.datatableLoading=true;
            await this.$ajax.post('/dmaster/pejabat',
                {
                    tahun:this.$store.getters['uifront/getTahunAnggaran'],                       
                    OrgID:OrgID_Selected,                       
                },
                {
                    headers:{
                        Authorization:this.$store.getters['auth/Token']
                    }
                }
            ).then(({data})=>{         
                this.datatable = data.pejabat;
                this.datatableLoading=false;
            });                      
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
        addItem:async function () {                        
            this.btnLoading = true;
            await this.$ajax.post('/dmaster/asn',
                {
                    tahun:this.$store.getters['uifront/getTahunAnggaran'],                       
                },
                {
                    headers:{
                        Authorization:this.$store.getters['auth/Token']
                    }
                }
            ).then(({data})=>{                
                this.dialogfrm = true;
                this.daftar_asn = data.asn;  
                this.formdata.OrgID=this.OrgID_Selected;              
                this.btnLoading=false;
            }).catch(()=>{
                this.btnLoading=false;
            });
        },         
        viewItem (item) {
            this.formdata=item;      
            this.dialogdetailitem=true;                       
        },     
        save () {
            if (this.$refs.frmdata.validate())
            {
                this.btnLoading=true;       
                this.$ajax.post('/dmaster/pejabat/store',
                    {
                        OrgID:this.formdata.OrgID,    
                        ASNID:this.formdata.ASNID,    
                        Jenis_Jabatan:this.formdata.Jenis_Jabatan,                                
                        TA:this.$store.getters['uifront/getTahunAnggaran'],                                                            
                    },
                    {
                        headers:{
                            Authorization:this.$store.getters['auth/Token']
                        }
                    }
                ).then(()=>{   
                    this.initialize(this.OrgID_Selected);
                    this.closedialogfrm();
                }).catch(()=>{
                    this.btnLoading=false;
                });
    
            }
        },
        deleteItem (item) {           
            this.$root.$confirm.open('Delete', 'Apakah Anda ingin menghapus data jabatan ASN dengan ID '+item.ASNID+' ?', { color: 'red' }).then((confirm) => {
                if (confirm)
                {
                    this.btnLoading=true;
                    this.$ajax.post('/dmaster/pejabat/'+item.RiwayatJabatanASNID,
                        {
                            '_method':'DELETE',
                        },
                        {
                            headers:{
                                Authorization:this.$store.getters['auth/Token']
                            }
                        }
                    ).then(()=>{   
                        const index = this.datatable.indexOf(item);
                        this.datatable.splice(index, 1);
                        this.btnLoading=false;
                    }).catch(()=>{
                        this.btnLoading=false;
                    });
                }                
            });
        },        
        closedialogfrm () {
            this.btnLoading=false;
            this.dialogfrm = false; 
            setTimeout(() => {
                this.formdata = Object.assign({}, this.formdefault);                
                this.editedIndex = -1;
                this.$refs.frmdata.resetValidation(); 
                }, 300
            );
        },
        closedialogdetailitem () {
            this.dialogdetailitem = false;            
            setTimeout(() => {
                this.formdata = Object.assign({}, this.formdefault)
                this.editedIndex = -1
                }, 300
            );
        },
    },
    watch: {
        OrgID_Selected (val)
        { 
            var page = this.$store.getters['uiadmin/Page']('pejabat');
            page.OrgID_Selected = val;
            this.$store.dispatch('uiadmin/updatePage',page);
            this.initialize(val);
        }
    },
    computed: {
        formtitle () {
            return this.editedIndex === -1 ? 'TAMBAH DATA' : 'UBAH DATA'
        },
    },
    components:{
        DataMasterLayout,
        ModuleHeader,
    },
}
</script>