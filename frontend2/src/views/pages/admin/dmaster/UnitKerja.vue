<template>
    <DataMasterLayout :showrightsidebar="false"> 
        <template v-slot:system-bar>
            Tahun Anggaran: {{$store.getters['uifront/getTahunAnggaran']}} | Bulan Realisasi:{{$store.getters['uifront/getNamaBulan']}}
        </template>       
        <ModuleHeader>
            <template v-slot:icon>
                mdi-domain
            </template>
            <template v-slot:name>
                UNIT KERJA
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
                    Daftar Unit Kerja yang datanya diload dari SIMDA. Silahkan klik tombol load data.
                </v-alert>
                <v-alert type="warning">
                    Catatan: Kadang-kadang Jumlah APBD atau APBDP berbeda dengan yang ada di OPD; hal ini disebabkan ada beberapa unit kerja yang tidak terload, misalnya seperti BKAD (PPKD), Sekretariat DPRD, Sekretariat Daerah (BUPATI)
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
                        item-key="SOrgID"
                        sort-by="kode_suborganisasi"
                        show-expand
                        dense
                        :loading="datatableLoading"
                        loading-text="Loading... Please wait"
                        :single-expand="true"
                        class="elevation-1"
                    >
                        <template v-slot:top>
                            <v-toolbar flat color="white">
                                <v-toolbar-title>DAFTAR UNIT KERJA</v-toolbar-title>
                                <v-divider
                                    class="mx-4"
                                    inset
                                    vertical
                                ></v-divider>
                                <v-spacer></v-spacer>
                                <v-btn color="primary" class="mb-2" @click.stop="loadPaguAPBDP" :disabled="btnLoading">LOAD PAGU APBDP</v-btn>
                                <v-dialog v-model="dialogfrm" max-width="700px" persistent>
                                    <v-form ref="frmdata" v-model="form_valid" lazy-validation>
                                        <v-card>
                                            <v-card-title>
                                                <span class="headline">{{ formtitle }}</span>
                                            </v-card-title>
                                            <v-card-text>                                               
                                                <v-text-field 
                                                    v-model="formdata.Nm_Urusan" 
                                                    label="URUSAN"
                                                    disabled>
                                                </v-text-field>
                                                <v-text-field 
                                                    v-model="formdata.kode_suborganisasi" 
                                                    label="KODE"
                                                    disabled>
                                                </v-text-field>
                                                <v-text-field 
                                                    v-model="formdata.SOrgNm" 
                                                    label="NAMA UNIT KERJA"
                                                    disabled>
                                                </v-text-field>
                                                <v-text-field 
                                                    v-model="formdata.SOrgAlias" 
                                                    :rules="rule_required"
                                                    label="SINGKATAN UNIT KERJA">
                                                </v-text-field>
                                                <v-text-field 
                                                    v-model="formdata.Alamat" 
                                                    :rules="rule_required"
                                                    label="ALAMAT">
                                                </v-text-field>
                                                <v-text-field 
                                                    v-model="formdata.NamaKepalaUnitKerja" 
                                                    :rules="rule_kepala_skpd"
                                                    label="NAMA KEPALA UNIT KERJA">
                                                </v-text-field>
                                                <v-text-field 
                                                    v-model="formdata.NIPKepalaUnitKerja" 
                                                    :rules="rule_nip_kepala_skpd"
                                                    label="NIP KEPALA UNIT KERJA">
                                                </v-text-field>
                                                <v-text-field 
                                                    v-model="formdata.Descr" 
                                                    label="KETERANGAN">
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
                                <v-dialog v-model="dialogdetailitem" max-width="800px" persistent>
                                    <v-card>
                                        <v-card-title>
                                            <span class="headline">DETAIL DATA UNIT KERJA</span>
                                        </v-card-title>
                                        <v-card-text>
                                            <v-row no-gutters> 
                                                <v-col xs="12" sm="6" md="6">
                                                    <v-card flat>
                                                        <v-card-title>
                                                            <strong>ID :</strong>
                                                        </v-card-title>
                                                        <v-card-subtitle>
                                                            {{formdata.SOrgID}}
                                                        </v-card-subtitle>                                                    
                                                    </v-card>
                                                </v-col>
                                                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                                                <v-col xs="12" sm="6" md="6">
                                                    <v-card flat>
                                                        <v-card-title>
                                                            <strong>ALAMAT :</strong>
                                                        </v-card-title>
                                                        <v-card-subtitle>
                                                            {{formdata.Alamat}}
                                                        </v-card-subtitle>     
                                                    </v-card> 
                                                </v-col>
                                                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                                            </v-row>
                                            <v-row no-gutters> 
                                                <v-col xs="12" sm="6" md="6">
                                                    <v-card flat>
                                                        <v-card-title>
                                                            <strong>KODE :</strong>
                                                        </v-card-title>
                                                        <v-card-subtitle>
                                                            {{formdata.kode_suborganisasi}}
                                                        </v-card-subtitle>
                                                    </v-card>
                                                </v-col>
                                                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                                                <v-col xs="12" sm="6" md="6">
                                                    <v-card flat>
                                                        <v-card-title>
                                                            <strong>APBD :</strong>
                                                        </v-card-title>
                                                        <v-card-subtitle>
                                                            {{formdata.PaguDana1|formatUang}}
                                                        </v-card-subtitle>   
                                                    </v-card> 
                                                </v-col> 
                                                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                                            </v-row>
                                            <v-row no-gutters> 
                                                <v-col xs="12" sm="6" md="6">
                                                    <v-card flat>
                                                        <v-card-title>
                                                            <strong>NAMA UNIT KERJA :</strong>
                                                        </v-card-title>
                                                        <v-card-subtitle>
                                                            {{formdata.SOrgNm}}
                                                        </v-card-subtitle>
                                                    </v-card>
                                                </v-col>
                                                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                                                <v-col xs="12" sm="6" md="6">
                                                    <v-card flat>
                                                        <v-card-title>
                                                            <strong>APBDP :</strong>
                                                        </v-card-title>
                                                        <v-card-subtitle>
                                                            {{formdata.PaguDana2|formatUang}}
                                                        </v-card-subtitle>  
                                                    </v-card>                                                
                                                </v-col>
                                                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                                            </v-row>
                                            <v-row no-gutters> 
                                                <v-col xs="12" sm="6" md="6">
                                                    <v-card flat>
                                                        <v-card-title>
                                                            <strong>SINGKATAN :</strong>
                                                        </v-card-title>
                                                        <v-card-subtitle>
                                                            {{formdata.SOrgAlias}}
                                                        </v-card-subtitle>
                                                    </v-card>
                                                </v-col>
                                                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                                                <v-col xs="12" sm="6" md="6">
                                                    <v-card flat>
                                                        <v-card-title>
                                                            <strong>TAHUN :</strong>
                                                        </v-card-title>
                                                        <v-card-subtitle>
                                                            {{formdata.TA}}
                                                        </v-card-subtitle> 
                                                    </v-card>
                                                </v-col>
                                                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                                            </v-row>
                                            <v-row no-gutters> 
                                                <v-col xs="12" sm="6" md="6">
                                                    <v-card flat>
                                                        <v-card-title>
                                                            <strong>URUSAN :</strong>
                                                        </v-card-title>
                                                        <v-card-subtitle>
                                                            {{formdata.Nm_Urusan}}
                                                        </v-card-subtitle>
                                                    </v-card>
                                                </v-col>
                                                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                                                <v-col xs="12" sm="6" md="6">
                                                    <v-card flat>
                                                        <v-card-title>
                                                            <strong>KET. :</strong>
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
                                                            <strong>KEPALA UNIT KERJA :</strong>
                                                        </v-card-title>
                                                        <v-card-subtitle>
                                                            {{formdata.NamaKepalaUnitKerja}} NIP.  {{formdata.NIPKepalaUnitKerja}}
                                                        </v-card-subtitle>  
                                                    </v-card>
                                                </v-col>
                                                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                                                <v-col xs="12" sm="6" md="6">
                                                    <v-card flat>
                                                        <v-card-title>
                                                            <strong>CREATED / UPDATED:</strong>
                                                        </v-card-title>
                                                        <v-card-subtitle>
                                                            {{$date(formdata.created_at).format('DD/MM/YYYY HH:mm')}} / {{$date(formdata.updated_at).format('DD/MM/YYYY HH:mm')}}
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
                        <template v-slot:item.PaguDana1="{ item }">                            
                            {{ item.PaguDana1|formatUang }}
                        </template>
                        <template v-slot:item.PaguDana2="{ item }">
                            {{ item.PaguDana2|formatUang }}
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
                                @click.stop="editItem(item)"
                            >
                                mdi-pencil
                            </v-icon>                           
                        </template>
                        <template v-slot:expanded-item="{ headers, item }">
                            <td :colspan="headers.length" class="text-center">
                                <strong>SOrgID:</strong>{{ item.SOrgID }}
                                <strong>Urusan:</strong>{{ item.Nm_Urusan }}
                                <strong>ALIAS:</strong>{{ item.SOrgAlias }}
                                <strong>Alamat:</strong>{{ item.Alamat }}
                                <strong>TA:</strong>{{ item.TA }}
                                <strong>created_at:</strong>{{ $date(item.created_at).format('DD/MM/YYYY HH:mm') }}
                                <strong>updated_at:</strong>{{ $date(item.updated_at).format('DD/MM/YYYY HH:mm') }}
                            </td>
                        </template>
                        <template v-slot:body.append>
                            <tr class="amber darken-1 font-weight-black">
                                <td colspan="5" class="text-right">TOTAL</td>
                                <td class="text-right">{{footers.jumlah_apbd|formatUang}}</td>                                
                                <td class="text-right">{{footers.jumlah_apbdp|formatUang}}</td>    
                                <td></td>                                                                                        
                            </tr>
                        </template>
                        <template v-slot:no-data>
                            <v-col cols="12">
                                <v-btn 
                                color="primary" 
                                @click.stop="loaddataunitkerja" 
                                :loading="btnLoading"
                                :disabled="showBtnLoadDataUnitKerja||btnLoading">
                                    LOAD DATA UNIT KERJA
                                    <template v-slot:loader>
                                        <span>LOADING ...</span>
                                    </template>
                                </v-btn>                            
                            </v-col>                            
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
    name: 'UNITKERJA',
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
                text:'UNIT KERJA',
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
            datatableLoaded:false,
            datatable:[],
            headers: [                        
                { text: 'KODE UNIT KERJA', value: 'kode_suborganisasi',width:70 },   
                { text: 'NAMA OPD', value: 'OrgNm',width:300 },   
                { text: 'NAMA UNIT KERJA', value: 'SOrgNm',width:300 },   
                { text: 'KEPALA UNIT KERJA', value: 'NamaKepalaUnitKerja',width:200 },   
                { text: 'APBD', align:'end',value: 'PaguDana1',width:100 },   
                { text: 'APBDP', align:'end',value: 'PaguDana2',sortable: false,width:100 },   
                { text: 'AKSI', value: 'actions', sortable: false,width:100 },
            ],
            search:'',    
            footers :{ 
                jumlah_apbd:0,
                jumlah_apbdp:0,                
            },

            //dialog
            dialogdetailitem:false,
            dialogfrm:false,

            //form data            
            form_valid:true,
            formdata: {
                SOrgID:'',                        
                Nm_Urusan:'',                        
                kode_suborganisasi:'',                        
                SOrgNm:'',                        
                SOrgAlias:'',                        
                Alamat:'',                        
                NamaKepalaUnitKerja:'',                        
                NIPKepalaUnitKerja:'',  
                PaguDana1:0,  
                PaguDana2:0,  
                Descr:'',                        
                TA:'',                        
                created_at: '',           
                updated_at: '',    
            },
            formdefault: {
                SOrgID:'',                        
                Nm_Urusan:'',                        
                kode_suborganisasi:'',                        
                SOrgNm:'',                        
                SOrgAlias:'',                        
                Alamat:'',                        
                NamaKepalaUnitKerja:'',                        
                NIPKepalaUnitKerja:'',    
                PaguDana1:0,  
                PaguDana2:0,                      
                Descr:'',                        
                TA:'',                        
                created_at: '',           
                updated_at: '',    
            },
            //form rules  
            rule_required:[
                value => !!value||"Mohon untuk di isi karena dibutuhkan !!!",  
            ], 
            rule_kepala_skpd:[
                value => !!value||"Mohon untuk di isi nama Kepala UNIT KERJA !!!",  
                value => /^[A-Za-z\s\\,\\.]*$/.test(value) || 'Nama kepala UNIT KERJA hanya boleh string dan spasi',                
            ], 
            rule_nip_kepala_skpd:[
                value => !!value||"Mohon untuk di isi NIP Kepala UNIT KERJA !!!",  
                value => /^[0-9]+$/.test(value) || 'NIP kepala UNIT KERJA hanya boleh angka',                
            ], 
            
            
        };
    },
    methods: {
        initialize () 
        {
            this.$ajax.post('/dmaster/unitkerja',
                {
                    tahun:this.$store.getters['uifront/getTahunAnggaran'],                       
                },
                {
                    headers:{
                        Authorization: this.$store.getters["auth/Token"]
                    }
                }
            ).then(({data})=>{                
                this.datatable = data.unitkerja;
                this.footers.jumlah_apbd=data.jumlah_apbd;
                this.footers.jumlah_apbdp=data.jumlah_apbdp;
                this.datatableLoaded=true;
                this.datatableLoading = false;
            });                      
        },
        loaddataunitkerja ()
        {
            this.$root.$confirm.open('Load Data Unit Kerja', 'Apakah Anda ingin meload data Unit Kerja kembali ?', { color: 'yellow' }).then((confirm) => {
                if (confirm)
                {
                    this.btnLoading = true;
                    this.$ajax.post('/dmaster/unitkerja/loadunitkerja',
                        {
                            tahun:this.$store.getters['uifront/getTahunAnggaran'],                       
                        },
                        {
                            headers:{
                                Authorization: this.$store.getters["auth/Token"]
                            }
                        }
                    ).then(({data})=>{                
                        this.datatable = data.unitkerja;
                        this.footers.jumlah_apbd=data.jumlah_apbd;
                        this.footers.jumlah_apbdp=data.jumlah_apbdp;
                        this.btnLoading = false;
                    }).catch(()=>{
                        this.btnLoading = false;
                    });  
                }
            });
        },
        loadPaguAPBDP ()
        {
            this.btnLoading = true;
            this.datatableLoading = true;
            this.$ajax.post('/dmaster/unitkerja/loadpaguapbdp',
                {
                    tahun:this.$store.getters['uifront/getTahunAnggaran'],                       
                },
                {
                    headers:{
                        Authorization: this.$store.getters["auth/Token"]
                    }
                }
            ).then(({data})=>{                
                this.datatable = data.unitkerja;
                this.footers.jumlah_apbd=data.jumlah_apbd;
                this.footers.jumlah_apbdp=data.jumlah_apbdp;
                this.btnLoading = false;
                this.datatableLoaded=true;
                this.datatableLoading = false;
            }).catch(()=>{
                this.btnLoading = false;
                this.datatableLoading = false;
            });  
        },
        viewItem (item) {
            this.formdata=item;      
            this.dialogdetailitem=true;   
        },
        editItem (item) {
            this.editedIndex = this.datatable.indexOf(item);
            this.formdata = Object.assign({}, item);
            this.dialogfrm = true
        },  
        save () {
            if (this.$refs.frmdata.validate())
            {
                this.btnLoading = true;
                if (this.editedIndex > -1) 
                {
                    this.$ajax.post('/dmaster/unitkerja/'+this.formdata.SOrgID,
                        {
                            '_method': 'PUT',
                            SOrgAlias:this.formdata.SOrgAlias,                        
                            Alamat:this.formdata.Alamat,                        
                            NamaKepalaUnitKerja:this.formdata.NamaKepalaUnitKerja,                        
                            NIPKepalaUnitKerja:this.formdata.NIPKepalaUnitKerja,                        
                            Descr:this.formdata.Descr,      
                        },
                        {
                            headers:{
                                Authorization: this.$store.getters["auth/Token"]
                            }
                        }
                    ).then(({data})=>{   
                        Object.assign(this.datatable[this.editedIndex], data.unitkerja);
                        this.closedialogfrm();
                    }).catch(()=>{
                        this.btnLoading = false;
                    });                 
                    
                }
            }
        },
        closedialogdetailitem () {
            this.btnLoading = false;
            this.dialogdetailitem = false;            
            setTimeout(() => {
                this.formdata = Object.assign({}, this.formdefault)
                this.editedIndex = -1
                }, 300
            );
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
    },
    computed: {
        formtitle () {
            return this.editedIndex === -1 ? 'TAMBAH DATA' : 'UBAH DATA'
        },
        showBtnLoadDataUnitKerja ()
        {
            var bool = true;
            if (this.datatableLoaded == true)
            {
                bool = this.datatable.length > 0;             
            }
            return bool;
        }
    },
    components: {
        DataMasterLayout,
        ModuleHeader,
    },
};
</script>