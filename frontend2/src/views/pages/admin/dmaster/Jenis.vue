<template>
    <DataMasterLayout :showrightsidebar="false">
        <template v-slot:system-bar>
            Tahun Anggaran: {{$store.getters['uifront/getTahunAnggaran']}} | Bulan Realisasi:{{$store.getters['uifront/getNamaBulan']}}
        </template>
        <ModuleHeader>
            <template v-slot:icon>
                mdi-decimal
            </template>
            <template v-slot:name>
                JENIS
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
                    Daftar rekening "jenis" uraian digunakan sebagai referensi di uraian kegiatan saat proses integrasi.
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
                        item-key="JnsID"                        
                        show-expand
                        :expanded.sync="expanded"
                        :single-expand="true"
                        class="elevation-1"
                        :loading="datatableLoading"
                        loading-text="Loading... Please wait"
                        @click:row="dataTableRowClicked">
                        <template v-slot:top>
                            <v-toolbar flat color="white">
                                <v-toolbar-title>DAFTAR JENIS</v-toolbar-title>
                                <v-divider
                                    class="mx-4"
                                    inset
                                    vertical
                                ></v-divider>
                                <v-spacer></v-spacer>
                                <v-btn color="primary" class="mb-2" @click.stop="addItem" :disabled="!$store.getters['auth/can']('REKENING-JENIS_STORE') || btnLoading" :loading="btnLoading">TAMBAH</v-btn>
                                <v-dialog v-model="dialogfrm" max-width="800px" persistent>                                    
                                    <v-form ref="frmdata" v-model="form_valid" lazy-validation>
                                        <v-card>
                                            <v-card-title>
                                                <span class="headline">{{ formtitle }}</span>
                                            </v-card-title>
                                            <v-card-text>
                                                <v-container fluid>
                                                    <v-row>
                                                        <v-col cols="12" sm="12" md="12">
                                                            <v-autocomplete 
                                                                :items="daftar_kelompok" 
                                                                v-model="formdata.KlpID"
                                                                label="KELOMPOK" 
                                                                item-text="nama_rek2"
                                                                item-value="KlpID"
                                                                filled
                                                                :rules="rule_kelompok">                                                    
                                                            </v-autocomplete>  
                                                        </v-col>                                    
                                                        <v-col cols="12" sm="12" md="12">
                                                            <v-text-field 
                                                                v-model="formdata.Kd_Rek_3" 
                                                                label="KODE JENIS"
                                                                filled
                                                                :rules="rule_kode_rek">
                                                            </v-text-field>
                                                        </v-col>                                    
                                                        <v-col cols="12" sm="12" md="12">
                                                            <v-text-field 
                                                                v-model="formdata.JnsNm" 
                                                                label="NAMA JENIS"
                                                                filled
                                                                :rules="rule_name">
                                                            </v-text-field>
                                                        </v-col>                                    
                                                        <v-col cols="12" sm="12" md="12">
                                                            <v-textarea
                                                                v-model="formdata.Descr" 
                                                                label="KETERANGAN"
                                                                filled>
                                                            </v-textarea>
                                                        </v-col>                                    
                                                    </v-row>
                                                </v-container>
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
                                                            JnsID
                                                        </v-card-title>
                                                        <v-card-subtitle>
                                                            {{formdata.JnsID}}
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
                                                            {{formdata.Descr}}
                                                        </v-card-subtitle>
                                                    </v-card>
                                                </v-col>
                                                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                                            </v-row>
                                            <v-row no-gutters> 
                                                <v-col xs="12" sm="6" md="6">
                                                    <v-card flat>                                        
                                                        <v-card-title>
                                                            KODE JENIS
                                                        </v-card-title>
                                                        <v-card-subtitle>
                                                            {{formdata.Kd_Rek_3}}
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
                                                            NAMA JENIS
                                                        </v-card-title>
                                                        <v-card-subtitle>
                                                            {{formdata.JnsNm}}
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
                                class="mr-2"
                                :loading="btnLoading"
                                :disabled="!$store.getters['auth/can']('REKENING-JENIS_UPDATE')"
                                @click.stop="editItem(item)"
                            >
                                mdi-pencil
                            </v-icon>
                            <v-icon
                                small
                                :loading="btnLoading"
                                :disabled="btnLoading||!$store.getters['auth/can']('REKENING-JENIS_STORE')"
                                @click.stop="deleteItem(item)"
                            >
                                mdi-delete
                            </v-icon>
                        </template>
                        <template v-slot:expanded-item="{ headers, item }">
                            <td :colspan="headers.length" class="text-center">
                                <strong>ID:</strong>{{ item.JnsID }}
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
    name: 'Jenis',
    created()
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
                text:'REKENING',
                disabled:true,
                href:'#'
            },
            {
                text:'JENIS',
                disabled:true,
                href:'#'
            }
        ];
        this.initialize()
    }, 
    data()
    {
        return {
            btnLoading:false,
            datatableLoading:false,
            expanded:[],
            datatable:[],
            headers: [                        
                { text: 'KELOMPOK', value: 'nama_rek2',width:200},   
                { text: 'KODE JENIS', value: 'Kd_Rek_3',width:100 },   
                { text: 'NAMA JENIS', value: 'JnsNm' },   
                { text: 'KET', value: 'Descr',width:100 },   
                { text: 'TA', value: 'TA',width:50 },   
                { text: 'AKSI', value: 'actions', sortable: false,width:100 },
            ],
            search:'',    

            //dialog
            dialogfrm:false,
            dialogdetailitem:false,

            //form data   
            form_valid:true,
            daftar_kelompok:[],         
            formdata: {
                JnsID:'',  
                KlpID:'',                                              
                Kd_Rek_3:'',                        
                JnsNm:'',                        
                Descr:'',                        
                TA:'',                        
                created_at: '',           
                updated_at: '',           

            },
            formdefault: {
                JnsID:'',                        
                KlpID:'',                        
                Kd_Rek_3:'',                        
                JnsNm:'',                        
                Descr:'',                        
                TA:'',                          
                created_at: '',           
                updated_at: '',        
            },
            editedIndex: -1,

            //form rules  
            rule_kelompok:[
                value => !!value||"Mohon untuk dipilih Rekening Transaksi !!!",  
            ], 
            rule_kode_rek:[
                value => !!value||"Mohon untuk di isi Kode Rekening Jenis!!!",                     
                value => /^[0-9]+$/.test(value) || 'Kode Rekening Jenis hanya boleh angka',                
            ], 
            rule_name:[
                value => !!value||"Mohon untuk di isi Nama Rekening Jenis !!!",                  
                value => /^[A-Za-z\s\\,\\.]*$/.test(value) || 'Nama Rekening Jenis hanya boleh string dan spasi',             
            ], 
        };
    },
    methods: {
        initialize:async function () 
        {
            this.datatableLoading = true;
            await this.$ajax.post('/dmaster/rekening/jenis',
                {
                    TA:this.$store.getters['uifront/getTahunAnggaran'],                       
                },
                {
                    headers:{
                        Authorization: this.$store.getters["auth/Token"]
                    }
                }
            ).then(({data})=>{                
                this.datatable = data.jenis;
                this.datatableLoading = false;
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
        async addItem ()
        {
            this.btnLoading = true;
            await this.$ajax.post('/dmaster/rekening/kelompok',
                {
                    TA:this.$store.getters['uifront/getTahunAnggaran'], 
                },
                {
                    headers:{
                        Authorization: this.$store.getters["auth/Token"],
                        'Access-Control-Allow-Origin': '*',
                    }
                }
            ).then(({data})=>{   
                this.dialogfrm=true;
                this.daftar_kelompok=data.kelompok;                
                this.btnLoading = false;
            }).catch(()=>{
                this.btnLoading = false;
            });
            
        },
        async editItem (item) {     
            this.btnLoading = true;
            await this.$ajax.post('/dmaster/rekening/kelompok',
                {
                    TA:this.$store.getters['uifront/getTahunAnggaran'], 
                },
                {
                    headers:{
                        Authorization: this.$store.getters["auth/Token"]
                    }
                }
            ).then(({data})=>{   
                this.dialogfrm=true;
                this.daftar_kelompok=data.kelompok;            
                this.editedIndex = this.datatable.indexOf(item);
                this.formdata = Object.assign({}, item);                                
                this.btnLoading = false;
            }).catch(()=>{
                this.btnLoading = false;
            });            
        }, 
        viewItem (item) {
            this.formdata=item;      
            this.dialogdetailitem=true;                                       
        },     
        save () {
            if (this.$refs.frmdata.validate())
            {
                this.btnLoading = true;                
                if (this.editedIndex > -1) 
                {
                    this.$ajax.post('/dmaster/rekening/jenis/'+this.formdata.JnsID,
                        {
                            '_method': 'PUT',
                            KlpID:this.formdata.KlpID,
                            Kd_Rek_3:this.formdata.Kd_Rek_3,
                            JnsNm:this.formdata.JnsNm,
                            Descr:this.formdata.Descr,
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
                    
                } else {
                    this.$ajax.post('/dmaster/rekening/jenis/store',
                        {
                            KlpID:this.formdata.KlpID,
                            Kd_Rek_3:this.formdata.Kd_Rek_3,
                            JnsNm:this.formdata.JnsNm,
                            Descr:this.formdata.Descr,
                            TA:this.$store.getters['uifront/getTahunAnggaran'],                                                            
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
            }
        },
        deleteItem (item) {           
            this.$root.$confirm.open("Delete", 'Apakah Anda ingin menghapus data dengan ID '+item.JnsID+' ?', { color: 'red' }).then((confirm) => {
                if (confirm)
                {
                    this.btnLoading = true;
                    this.$ajax.post('/dmaster/rekening/jenis/'+item.JnsID,
                        {
                            _method: "DELETE",
                        },
                        {
                            headers:{
                                Authorization: this.$store.getters["auth/Token"]
                            }
                        }
                    ).then(()=>{   
                        const index = this.datatable.indexOf(item);
                        this.datatable.splice(index, 1);
                        this.btnLoading = false;
                    }).catch(()=>{
                        this.btnLoading = false;
                    });
                }                
            });
        },        
        closedialogfrm () {
            this.btnLoading = false;
            this.dialogfrm = false;            
            setTimeout(() => {
                this.formdata = Object.assign({}, this.formdefault);                
                this.editedIndex = -1;
                this.$refs.frmdata.reset(); 
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
    computed: {
        formtitle () {
            return this.editedIndex === -1 ? 'TAMBAH DATA' : 'UBAH DATA'
        },
    },
    components: {
        DataMasterLayout,
        ModuleHeader,
    },
};
</script>