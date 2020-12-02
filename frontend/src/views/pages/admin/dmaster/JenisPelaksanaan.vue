<template>
    <DataMasterLayout :showrightsidebar="false">
        <template v-slot:system-bar>
            Tahun Anggaran: {{$store.getters['uifront/getTahunAnggaran']}} | Bulan Realisasi:{{$store.getters['uifront/getNamaBulan']}}
        </template>
        <ModuleHeader>
            <template v-slot:icon>
                mdi-road
            </template>
            <template v-slot:name>
                JENIS PELAKSANAAN
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
                    Jenis Pelaksanaan untuk Uraian RKA
                </v-alert>
            </template>
        </ModuleHeader>
        <v-container fluid>             
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
                        item-key="JenisPelaksanaanID"
                        sort-by="NamaJenis"
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
                                <v-toolbar-title>DAFTAR JENIS PELAKSANAAN</v-toolbar-title>
                                <v-divider
                                    class="mx-4"
                                    inset
                                    vertical
                                ></v-divider>
                                <v-spacer></v-spacer>
                                <v-dialog v-model="dialogfrm" max-width="500px" persistent>
                                    <template v-slot:activator="{ on }">
                                        <v-btn color="primary" dark class="mb-2" v-on="on" :disabled="!$store.getters['auth/can']('ASN_UPDATE')">TAMBAH</v-btn>
                                    </template>
                                    <v-form ref="frmdata" v-model="form_valid" lazy-validation>
                                        <v-card>
                                            <v-card-title>
                                                <span class="headline">{{ formtitle }}</span>
                                            </v-card-title>
                                            <v-card-text>
                                                <v-text-field 
                                                    v-model="formdata.NamaJenis" 
                                                    label="NAMA JENIS"
                                                    filled
                                                    :rules="rule_name">
                                                </v-text-field>                                                        
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
                            </v-toolbar>
                        </template>
                        <template v-slot:item.actions="{ item }">
                            <v-icon
                                small
                                class="mr-2"
                                :disabled="!$store.getters['auth/can']('ASN_UPDATE')"
                                @click.stop="editItem(item)"
                            >
                                mdi-pencil
                            </v-icon>
                            <v-icon
                                small
                                :loading="btnLoading"
                                :disabled="btnLoading||!$store.getters['auth/can']('ASN_DESTROY')"
                                @click.stop="deleteItem(item)"
                            >
                                mdi-delete
                            </v-icon>
                        </template>
                        <template v-slot:expanded-item="{ headers, item }">
                            <td :colspan="headers.length" class="text-center">
                                <strong>ID:</strong>{{ item.JenisPelaksanaanID }}
                                <strong>created_at:</strong>{{ $date(item.created_at).format('DD/MM/YYYY HH:mm') }}
                                <strong>updated_at:</strong>{{ $date(item.updated_at).format('DD/MM/YYYY HH:mm') }}
                            </td>
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
    name:'JenisPelaksanaan',
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
                text:'JENIS PELAKSANAAN',
                disabled:true,
                href:'#'
            }
        ];
        this.initialize()
    }, 
    data ()
    {
        return {
            btnLoading:false,
            datatableLoading:false,
            expanded:[],
            datatable:[],
            headers: [                        
                { text: 'NAMA JENIS', value: 'NamaJenis' },   
                { text: 'AKSI', value: 'actions', sortable: false,width:100 },
            ],
            search:'',    

            //dialog
            dialogfrm:false,
            
            //form data   
            form_valid:true,         
            formdata: {
                JenisPelaksanaanID:'',                        
                NamaJenis:'',                        
                Descr:'',                        
                created_at: '',           
                updated_at: '',           

            },
            formdefault: {
                JenisPelaksanaanID:'',                        
                NamaJenis:'',                        
                Descr:'',                        
                created_at: '',           
                updated_at: '',       
            },
            editedIndex: -1,

            //form rules  
            rule_name:[
                value => !!value||"Mohon untuk di isi Nama Jenis !!!",  
                value => /^[A-Za-z\s]*$/.test(value) || 'Nama Jenis hanya boleh string dan spasi',                
            ], 
        };
    },
    methods: {
        initialize:async function () 
        {
            this.datatableLoading=true;
            await this.$ajax.post('/dmaster/jenispelaksanaan',
                {
                    tahun:this.$store.getters['uifront/getTahunAnggaran'],                       
                },
                {
                    headers:{
                        Authorization:this.$store.getters['auth/Token']
                    }
                }
            ).then(({data})=>{                
                this.datatable = data.jenispelaksanaan;
                this.datatableLoading=false;
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
        editItem (item) {
            this.editedIndex = this.datatable.indexOf(item);
            this.formdata = Object.assign({}, item);
            this.dialogfrm = true
        },    
        save () {
            if (this.$refs.frmdata.validate())
            {
                this.btnLoading=true;
                if (this.editedIndex > -1) 
                {
                    this.$ajax.post('/dmaster/jenispelaksanaan/'+this.formdata.JenisPelaksanaanID,
                        {
                            '_method':'PUT',
                            NamaJenis:this.formdata.NamaJenis,                       
                            Descr:'',       
                        },
                        {
                            headers:{
                                Authorization:this.$store.getters['auth/Token']
                            }
                        }
                    ).then(({data})=>{   
                        Object.assign(this.datatable[this.editedIndex], data.jenispelaksanaan);
                        this.closedialogfrm();
                    }).catch(()=>{
                        this.btnLoading=false;
                    });                 
                    
                } else {
                    this.$ajax.post('/dmaster/jenispelaksanaan/store',
                        {
                            NamaJenis:this.formdata.NamaJenis,    
                            Descr:'',          
                            TA:this.$store.getters['uifront/getTahunAnggaran'],                                                            
                        },
                        {
                            headers:{
                                Authorization:this.$store.getters['auth/Token']
                            }
                        }
                    ).then(({data})=>{   
                        this.datatable.push(data.jenispelaksanaan);
                        this.closedialogfrm();
                    }).catch(()=>{
                        this.btnLoading=false;
                    });
                }
            }
        },
        deleteItem (item) {           
            this.$root.$confirm.open('Delete', 'Apakah Anda ingin menghapus data dengan ID '+item.JenisPelaksanaanID+' ?', { color: 'red' }).then((confirm) => {
                if (confirm)
                {
                    this.btnLoading=true;
                    this.$ajax.post('/dmaster/jenispelaksanaan/'+item.JenisPelaksanaanID,
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
                this.$refs.frmdata.reset(); 
                }, 300
            );
        },
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