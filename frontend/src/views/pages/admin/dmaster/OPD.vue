<template>
    <DataMasterLayout :showrightsidebar="false">
        <template v-slot:system-bar>
            Tahun Anggaran: {{$store.getters['uifront/getTahunAnggaran']}} | Bulan Realisasi:{{$store.getters['uifront/getNamaBulan']}}
        </template>
        <ModuleHeader>
            <template v-slot:icon>
                mdi-office-building
            </template>
            <template v-slot:name>
                ORG. PERANGKAT DAERAH (OPD)
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
                    Daftar OPD yang datanya diload dari SIMDA. Silahkan klik tombol load data.
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
                        item-key="OrgID"
                        sort-by="kode_organisasi"
                        show-expand
                        dense
                        :loading="datatableLoading"
                        loading-text="Loading... Please wait"
                        :single-expand="true"
                        class="elevation-1"
                    >
                        <template v-slot:top>
                            <v-toolbar flat color="white">
                                <v-toolbar-title>DAFTAR OPD</v-toolbar-title>
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
                                                    v-model="formdata.kode_organisasi" 
                                                    label="KODE OPD"
                                                    disabled>
                                                </v-text-field>
                                                <v-text-field 
                                                    v-model="formdata.OrgNm" 
                                                    label="NAMA OPD"
                                                    disabled>
                                                </v-text-field>
                                                <v-text-field 
                                                    v-model="formdata.OrgAlias" 
                                                    :rules="rule_required"
                                                    label="SINGKATAN OPD">
                                                </v-text-field>
                                                <v-text-field 
                                                    v-model="formdata.Alamat" 
                                                    :rules="rule_required"
                                                    label="ALAMAT">
                                                </v-text-field>
                                                <v-text-field 
                                                    v-model="formdata.NamaKepalaSKPD" 
                                                    :rules="rule_kepala_skpd"
                                                    label="NAMA KEPALA OPD">
                                                </v-text-field>
                                                <v-text-field 
                                                    v-model="formdata.NIPKepalaSKPD" 
                                                    :rules="rule_nip_kepala_skpd"
                                                    label="NIP KEPALA OPD">
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
                                            <span class="headline">DETAIL DATA OPD</span>
                                        </v-card-title>
                                        <v-card-text>
                                            <v-row no-gutters> 
                                                <v-col xs="12" sm="6" md="6">
                                                    <v-card flat>
                                                        <v-card-title>
                                                            <strong>ID :</strong>
                                                        </v-card-title>
                                                        <v-card-subtitle>
                                                            {{formdata.OrgID}}
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
                                                            <strong>KODE OPD :</strong>
                                                        </v-card-title>
                                                        <v-card-subtitle>
                                                            {{formdata.kode_organisasi}}
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
                                                            <strong>NAMA OPD :</strong>
                                                        </v-card-title>
                                                        <v-card-subtitle>
                                                            {{formdata.OrgNm}}
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
                                                            {{formdata.OrgAlias}}
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
                                                            <strong>KEPALA OPD :</strong>
                                                        </v-card-title>
                                                        <v-card-subtitle>
                                                            {{formdata.NamaKepalaSKPD}} NIP.  {{formdata.NIPKepalaSKPD}}
                                                        </v-card-subtitle> 
                                                    </v-card>
                                                </v-col>         
                                                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>                                       
                                                <v-col xs="12" sm="6" md="6">
                                                    <v-card flat>
                                                        <v-card-title>
                                                            <strong>CREATED / UPDATED :</strong>
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
                                <strong>OrgID:</strong>{{ item.OrgID }}
                                <strong>Urusan:</strong>{{ item.Nm_Urusan }}
                                <strong>ALIAS:</strong>{{ item.OrgAlias }}
                                <strong>Alamat:</strong>{{ item.Alamat }}
                                <strong>TA:</strong>{{ item.TA }}
                                <strong>created_at:</strong>{{ $date(item.created_at).format('DD/MM/YYYY HH:mm') }}
                                <strong>updated_at:</strong>{{ $date(item.updated_at).format('DD/MM/YYYY HH:mm') }}
                            </td>
                        </template>
                        <template v-slot:body.append>
                            <tr class="amber darken-1 font-weight-black">
                                <td colspan="4" class="text-right">TOTAL</td>
                                <td class="text-right">{{footers.jumlah_apbd|formatUang}}</td>                                
                                <td class="text-right">{{footers.jumlah_apbdp|formatUang}}</td>    
                                <td></td>                                                                                        
                            </tr>
                        </template>
                        <template v-slot:no-data>
                            <v-col cols="12">
                                <v-btn 
                                    color="primary" 
                                    @click.stop="loaddataopd" 
                                    :loading="btnLoading"
                                    :disabled="showBtnLoadDataOPD||btnLoading">
                                        LOAD DATA OPD
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
    name:'OPD',
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
                text:'OPD',
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
            datatableLoaded:false,
            datatable:[],
            headers: [                        
                { text: 'KODE OPD', value: 'kode_organisasi',width:70 },   
                { text: 'NAMA OPD', value: 'OrgNm',width:300 },   
                { text: 'KEPALA OPD', value: 'NamaKepalaSKPD',width:200 },   
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
                OrgID:'',                        
                Nm_Urusan:'',                        
                kode_organisasi:'',                        
                OrgNm:'',                        
                OrgAlias:'',                        
                Alamat:'',                        
                NamaKepalaSKPD:'',                        
                NIPKepalaSKPD:'',  
                PaguDana1:0,  
                PaguDana2:0,  
                Descr:'',                        
                TA:'',                        
                created_at: '',           
                updated_at: '',    
            },
            formdefault: {
                OrgID:'',                        
                Nm_Urusan:'',                        
                kode_organisasi:'',                        
                OrgNm:'',                        
                OrgAlias:'',                        
                Alamat:'',                        
                NamaKepalaSKPD:'',                        
                NIPKepalaSKPD:'',    
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
                value => !!value||"Mohon untuk di isi nama Kepala OPD / SKPD !!!",  
                value => /^[A-Za-z\s\\,\\.]*$/.test(value) || 'Nama Kepala OPD / SKPD hanya boleh string dan spasi',                
            ], 
            rule_nip_kepala_skpd:[
                value => !!value||"Mohon untuk di isi NIP Kepala OPD / SKPD !!!",  
                value => /^[0-9]+$/.test(value) || 'NIP Kepala OPD / SKPD hanya boleh angka',                
            ], 
        };
    },
    methods: {
        initialize:async function () 
        {
            this.datatableLoading=true;
            await this.$ajax.post('/dmaster/opd',
                {
                    tahun:this.$store.getters['uifront/getTahunAnggaran'],                       
                },
                {
                    headers:{
                        Authorization:this.$store.getters['auth/Token']
                    }
                }
            ).then(({data})=>{                
                this.datatable = data.opd;
                this.footers.jumlah_apbd=data.jumlah_apbd;
                this.footers.jumlah_apbdp=data.jumlah_apbdp;
                this.datatableLoaded=true;
                this.datatableLoading=false;
            });                      
        },
        loaddataopd ()
        {
            this.$root.$confirm.open('Load Data OPD', 'Apakah Anda ingin meload data OPD kembali ?', { color: 'yellow' }).then((confirm) => {
                if (confirm)
                {
                    this.btnLoading=true;
                    this.$ajax.post('/dmaster/opd/loadopd',
                        {
                            tahun:this.$store.getters['uifront/getTahunAnggaran'],                       
                        },
                        {
                            headers:{
                                Authorization:this.$store.getters['auth/Token']
                            }
                        }
                    ).then(({data})=>{                
                        this.datatable = data.opd;
                        this.footers.jumlah_apbd=data.jumlah_apbd;
                        this.footers.jumlah_apbdp=data.jumlah_apbdp;
                        this.btnLoading=false;
                    }).catch(()=>{
                        this.btnLoading=false;
                    });  
                }
            });
        },
        loadPaguAPBDP ()
        {
            this.btnLoading=true;
            this.$ajax.post('/dmaster/opd/loadpaguapbdp',
                {
                    tahun:this.$store.getters['uifront/getTahunAnggaran'],                       
                },
                {
                    headers:{
                        Authorization:this.$store.getters['auth/Token']
                    }
                }
            ).then(({data})=>{                
                this.datatable = data.opd;
                this.footers.jumlah_apbd=data.jumlah_apbd;
                this.footers.jumlah_apbdp=data.jumlah_apbdp;
                this.btnLoading=false;
            }).catch(()=>{
                this.btnLoading=false;
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
                    this.$ajax.post('/dmaster/opd/'+this.formdata.OrgID,
                        {
                            '_method':'PUT',
                            OrgAlias:this.formdata.OrgAlias,                        
                            Alamat:this.formdata.Alamat,                        
                            NamaKepalaSKPD:this.formdata.NamaKepalaSKPD,                        
                            NIPKepalaSKPD:this.formdata.NIPKepalaSKPD,                        
                            Descr:this.formdata.Descr,      
                        },
                        {
                            headers:{
                                Authorization:this.$store.getters['auth/Token']
                            }
                        }
                    ).then(({data})=>{   
                        Object.assign(this.datatable[this.editedIndex], data.opd);
                        this.closedialogfrm();
                    }).catch(()=>{
                        this.btnLoading=false;
                    });                 
                    
                }
            }
        },
        closedialogdetailitem () {
            this.btnLoading=false;
            this.dialogdetailitem = false;            
            setTimeout(() => {
                this.formdata = Object.assign({}, this.formdefault)
                this.editedIndex = -1
                }, 300
            );
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
        showBtnLoadDataOPD ()
        {
            var bool = true;
            if (this.datatableLoaded == true)
            {
                bool = this.datatable.length > 0;             
            }
            return bool;
        }
    },
    components:{
        DataMasterLayout,
        ModuleHeader,
    },
}
</script>