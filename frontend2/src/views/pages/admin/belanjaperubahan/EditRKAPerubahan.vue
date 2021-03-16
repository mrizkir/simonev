<template>
    <BelanjaPerubahanLayout :showrightsidebar="false">
        <template v-slot:system-bar>
            Tahun Anggaran: {{$store.getters['uifront/getTahunAnggaran']}} | Bulan Realisasi:{{$store.getters['uifront/getNamaBulan']}}
        </template>
        <ModuleHeader>
            <template v-slot:icon>
                mdi-graph
            </template>
            <template v-slot:name>
                RKA PERUBAHAN
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
                    Ubah Rencana Kegiatan dan Anggaran (RKA) OPD / Unit Kerja APBD Perubahan
                </v-alert>
            </template>
        </ModuleHeader>
        <v-container > 
            <v-row class="mb-4" no-gutters>
                <v-col cols="12">
                    <v-bottom-navigation color="purple lighten-1">                        
                        <v-btn @click.stop="showdialogcopykegiatan" :disabled="btnLoading"> 
                            <span>Salin dari Murni</span>
                            <v-icon>mdi-content-copy</v-icon>
                        </v-btn>
                        <v-btn :to="{path:'/belanjaperubahan/rka/uraian/'+datakegiatan.RKAID}"> 
                            <span>Keluar</span>
                            <v-icon>mdi-close</v-icon>
                        </v-btn>                        
                    </v-bottom-navigation>
                </v-col>
            </v-row>
            <v-dialog v-model="dialogcopykegiatan" max-width="700px" persistent>                 
                <v-card>
                    <v-card-title class="mb-2">
                        <span class="headline">SALIN DATA KEGIATAN DARI MURNI</span>
                    </v-card-title>
                    <v-card-subtitle>
                        <v-alert type="warning">
                            Dengan meng-klik tombol salin, maka data kegiatan dengan kode yang sama akan disalin pada kegiatan ini. BILA SUDAH ADA MAKA AKAN TERTIMPA.
                        </v-alert>
                    </v-card-subtitle>
                    <v-card-text>
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
                                    dense                                    
                                    class="elevation-1"             >
                                >
                                    <template v-slot:item.actions="{ item }">
                                        <v-icon
                                            small
                                            class="mr-2"
                                            :disabled="btnLoading||item.Locked"
                                            @click.stop="copyFromMurni(item)"
                                        >
                                            mdi-content-copy
                                        </v-icon>
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
                                    <template v-slot:no-data>                                                                                                                                                   
                                        tidak ada kegiatan murni yang memiliki kode yang sama dengan {{search}}.
                                    </template>                 
                                </v-data-table>
                            </v-col>
                        </v-row>             
                    </v-card-text>
                    <v-card-actions>                                    
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" text @click.stop="closedialogcopykegiatan">BATAL</v-btn>                        
                    </v-card-actions>
                </v-card>                    
            </v-dialog>
            <v-row class="mb-4" no-gutters>
                <v-col cols="12">
                    <v-form ref="frmeditkegiatan" v-model="form_valid" lazy-validation>
                        <v-card>                                                
                            <v-card-text>
                                <h5>DATA KEGIATAN</h5>
                                <v-divider class="mb-2"></v-divider>
                                <v-text-field 
                                    label="KELOMPOK URUSAN" 
                                    type="text"  
                                    filled     
                                    :value="'['+datakegiatan.kode_urusan+'] '+datakegiatan.Nm_Urusan"
                                    :disabled="true"                                                          
                                />
                                <v-text-field 
                                    label="URUSAN" 
                                    type="text"  
                                    filled     
                                    :value="'['+datakegiatan.kode_bidang+'] '+datakegiatan.Nm_Bidang"
                                    :disabled="true"                                                          
                                />
                                <v-text-field 
                                    label="PROGRAM" 
                                    type="text"  
                                    filled     
                                    :value="'['+datakegiatan.kode_program+'] '+datakegiatan.PrgNm"
                                    :disabled="true"                                                          
                                />
                                <v-text-field 
                                    label="KEGIATAN" 
                                    type="text"  
                                    filled     
                                    :value="'['+datakegiatan.kode_kegiatan+'] '+datakegiatan.KgtNm"
                                    :disabled="true"                                                          
                                />
                                <v-text-field 
                                    label="TARGET KINERJA MASUKAN" 
                                    type="text"  
                                    filled     
                                    :value="datakegiatan.PaguDana2|formatUang"
                                    :disabled="true"                                                          
                                />                                
                                <v-select 
                                    v-model="formdata.SumberDanaID" 
                                    label="SUMBER DANA" 
                                    :rules="rule_sumberdana"
                                    :items="daftar_sumberdana"  
                                    item-text="Nm_SumberDana" 
                                    item-value="SumberDanaID"
                                    filled                                                               
                                />
                                <v-text-field 
                                    v-model="formdata.lokasi_kegiatan2" 
                                    label="LOKASI KEGIATAN" 
                                    :rules="rule_lokasikegiatan"
                                    type="text"  
                                    filled                                                               
                                />
                                <h5>INDIKATOR DAN TOLAK UKUR KINERJA BELANJA LANGSUNG</h5>
                                <v-divider class="mb-2"></v-divider>
                                <v-text-field 
                                    v-model="formdata.capaian_program2" 
                                    label="CAPAIAN PROGRAM" 
                                    :rules="rule_capaianprogram"
                                    type="text"  
                                    filled                                                               
                                />
                                <v-text-field 
                                    v-model="formdata.tk_capaian2" 
                                    label="TARGET KINERJA CAPAIAN (%)" 
                                    :rules="rule_tkcapaian"
                                    type="text"  
                                    filled                                                               
                                />
                                <v-textarea 
                                    v-model="formdata.masukan2" 
                                    label="MASUKAN" 
                                    :rules="rule_masukan"
                                    type="text"
                                    filled                                                               
                                />
                                <v-textarea 
                                    v-model="formdata.keluaran2" 
                                    label="KELUARAN (OUTPUT)" 
                                    :rules="rule_keluaran"
                                    type="text"
                                    filled                                                               
                                />
                                <v-textarea 
                                    v-model="formdata.tk_keluaran2" 
                                    label="TARGET KINERJA KELUARAN (OUTPUT)" 
                                    :rules="rule_tkkeluaran"
                                    type="text"
                                    filled                                                               
                                />
                                <v-textarea 
                                    v-model="formdata.hasil2" 
                                    label="HASIL (OUTCOME)" 
                                    :rules="rule_hasil"
                                    type="text"
                                    filled                                                               
                                />
                                <v-textarea 
                                    v-model="formdata.tk_hasil2" 
                                    label="TARGET KINERJA HASIL (OUTCOME)" 
                                    :rules="rule_tkhasil"
                                    type="text"
                                    filled                                                               
                                />
                                <v-text-field 
                                    v-model="formdata.ksk2" 
                                    label="KELOMPOK SASARAN KEGIATAN" 
                                    :rules="rule_ksk"
                                    type="text"  
                                    filled                                                               
                                />
                                <v-radio-group v-model="formdata.sifat_kegiatan2" row>
                                    <v-radio label="BARU" value="baru"></v-radio>
                                    <v-radio label="LANJUTAN" value="lanjutan">></v-radio>
                                </v-radio-group>
                                <v-text-field 
                                    v-model="formdata.waktu_pelaksanaan2" 
                                    label="WAKTU PELAKSANAAN" 
                                    :rules="rule_waktupelaksanaan"
                                    type="text"  
                                    filled                                                               
                                />
                                <h5>PENGAMPU KEGIATAN</h5>
                                <v-divider class="mb-2"></v-divider>
                                <v-alert
                                    dense
                                    type="info"
                                    >
                                    Bila pejabat PA, KPA, PPK, dan PPTK kosong; silahkah isi dulu di 
                                    <v-btn link text to="/dmaster/pejabat">
                                        <strong>DMaster->Pejabat</strong>
                                    </v-btn>
                                </v-alert>
                                <v-select 
                                    v-model="formdata.nip_pa2"
                                    label="PENGGUNA ANGGARAN" 
                                    :rules="rule_pa"
                                    :items="daftar_pa"  
                                    filled                                                               
                                />
                                <v-select 
                                    v-model="formdata.nip_kpa2"
                                    label="KUASA PENGGUNA ANGGARAN" 
                                    :rules="rule_kpa"
                                    :items="daftar_kpa"  
                                    filled                                                               
                                />
                                <v-select 
                                    label="PPK" 
                                    v-model="formdata.nip_ppk2"
                                    :rules="rule_ppk"
                                    :items="daftar_ppk"  
                                    filled                                                               
                                />
                                <v-select 
                                    label="PPTK" 
                                    v-model="formdata.nip_pptk2"
                                    :rules="rule_pptk"
                                    :items="daftar_pptk"  
                                    filled                                                               
                                />
                                <h5>LAIN-LAIN</h5>
                                <v-divider class="mb-2"></v-divider>
                                <v-textarea 
                                    v-model="formdata.Descr" 
                                    label="KETERANGAN"                                 
                                    type="text"
                                    filled                                                               
                                />
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click.stop="closeeditkegiatan">BATAL</v-btn>
                                <v-btn 
                                    color="blue darken-1" 
                                    text 
                                    @click.stop="updatekegiatan" 
                                    :loading="btnLoading"
                                    :disabled="!form_valid||btnLoading">
                                        SIMPAN
                                    </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-form>
                </v-col>
            </v-row>              
        </v-container>
    </BelanjaPerubahanLayout>
</template>
<script>
import BelanjaPerubahanLayout from '@/views/layouts/BelanjaPerubahanLayout';
import ModuleHeader from '@/components/ModuleHeader';
export default {
    name: 'EditRKAPerubahan',
    created()
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
                text:'RKA (RENCANA KEGIATAN DAN ANGGARAN)',
                disabled:false,
                href:'/belanjaperubahan/rka'
            },
            {
                text:'UBAH RKA',
                disabled:true,
                href:'#'
            }
        ];

        this.RKAID = this.$route.params.rkaid;              
        var page = this.$store.getters["uiadmin/Page"]('rkaperubahan');
        this.datakegiatan = page.datakegiatan; 

        if (Object.keys(this.datakegiatan).length > 1)
        {
            this.OrgID=page.OrgID_Selected;
            this.SOrgID=page.SOrgID_Selected;
            this.initialize();            
        }  
        else
        {
            page.datakegiatan ={
                RKAID: "",
            };
            page.datauraian ={
                RKARincID:'',
            };
            page.datarekening ={};

            this.$store.dispatch('uiadmin/updatePage',page);
            this.$router.push('/belanja/rkaperubahan');
        } 
    },     
    data()
    {
        return {
            //modul
            OrgID:'',
            SOrgID:'',
            RKAID: "",
            btnLoading:false,
            datakegiatan: [],
            
            dialogcopykegiatan:false,

            datatable:[],
            headers: [                        
                { text: 'KODE', value: 'kode_kegiatan',width:80 },   
                { text: 'NAMA KEGIATAN', value: 'KgtNm',width:300 },   
                { text: 'PAGU KEGIATAN', value: 'PaguDana1',align:'end',width:100 },   
                { text: 'REALISASI KEUANGAN', value: 'RealisasiKeuangan1',align:'end',width:100 },   
                { text: 'REALISASI FISIK', value: 'RealisasiFisik1',align:'end',width:100},   
                { text: 'SISA PAGU', value: 'SisaAnggaran',align:'end',width:100},   
                { text: 'AKSI', value: 'actions', sortable: false,width:80 },
            ],
            search:'',

            //form data               
            form_valid:true,
            daftar_sumberdana:[],
            daftar_pa: [],
            daftar_kpa: [],
            daftar_ppk: [],
            daftar_pptk: [],
            formdata :{
                RKAID: '',
                SumberDanaID: null,
                kode_urusan: '',
                kode_bidang: '',
                kode_organisasi: '',
                kode_suborganisasi: '',
                kode_program: '',
                kode_kegiatan: '',
                Nm_Urusan: '',
                Nm_Bidang: '',
                OrgNm: '',
                SOrgNm: '',
                PrgNm: '',
                KgtNm: '',
                keluaran2: null,                
                tk_keluaran2: '',                
                hasil2: '',                
                tk_hasil2: '',                
                capaian_program2: '',                
                tk_capaian2: '',                
                masukan2: '',                
                ksk2: '',                
                sifat_kegiatan2: 'baru',                
                waktu_pelaksanaan2: '',                
                lokasi_kegiatan2: '',                
                PaguDana2: '',                
                RealisasiKeuangan2: '',                
                RealisasiFisik2: '',                
                nip_pa2: '',                
                nip_kpa2: '',                
                nip_ppk2: '',                
                nip_pptk2: '',                
                Descr: '',
                TA: '',
                Locked: '',                
                created_at: '',
                updated_at: '',
            },
            rule_sumberdana:[
                value => !!value||"Mohon untuk di pilih sumber dana !!!",                  
            ], 
            rule_lokasikegiatan:[
                value => !!value||"Mohon untuk di isi lokasi kegiatan !!!",                  
            ], 
            rule_capaianprogram:[
                value => !!value||"Mohon untuk di isi capaian program !!!",                  
            ], 
            rule_tkcapaian:[
                value => !!value||"Mohon untuk di isi target kinerja capaian !!!",
                value => /^(100(\.0{1,2})?|[1-9]?\d(\.\d{1,2})?)$/.test(value) || 'Isi dengan nilai persentase 0.00 s.d 100.00',                  
            ], 
            rule_masukan:[
                value => !!value||"Mohon untuk di isi masuk !!!",                  
            ], 
            rule_keluaran:[
                value => !!value||"Mohon untuk di isi output !!!",                  
            ], 
            rule_tkkeluaran:[
                value => !!value||"Mohon untuk di isi target kinerja keluaran (OUTPUT) !!!",                  
            ], 
            rule_hasil:[
                value => !!value||"Mohon untuk di isi hasil (OUTCOME) !!!",                  
            ], 
            rule_tkhasil:[
                value => !!value||"Mohon untuk di isi target kinerja hasil (OUTCOME) !!!",                  
            ], 
            rule_ksk:[
                value => !!value||"Mohon untuk di isi kelompok sasaran kegiatan !!!",                  
            ], 
            rule_waktupelaksanaan:[
                value => !!value||"Mohon untuk di isi waktu pelaksanaan !!!",                  
            ], 
            rule_pa:[
                value => !!value||"Mohon untuk di pilih namam PA !!!",                               
            ], 
            rule_kpa:[
                value => !!value||"Mohon untuk di pilih namam KPA !!!",                               
            ], 
            rule_ppk:[
                value => !!value||"Mohon untuk di pilih namam PPK !!!",                  
            ], 
            rule_pptk:[
                value => !!value||"Mohon untuk di pilih namam PPTK !!!",                  
            ],             
        };
    },
    methods: {
        initialize:async function  () 
        {  
            this.formdata = Object.assign({}, this.datakegiatan);              
            await this.$ajax.get('/dmaster/opd/'+this.OrgID+'/pejabat',
                {
                    headers:{
                        Authorization: this.$store.getters["auth/Token"]
                    }
                }
            ).then(({data})=>{                                 
                this.daftar_pa=data.pejabat.pa;
                this.daftar_kpa=data.pejabat.kpa;
                this.daftar_ppk=data.pejabat.ppk;
                this.daftar_pptk=data.pejabat.pptk;
            }).catch(()=>{ 
                this.btnLoading = false;
            });  

            await this.$ajax.post('/dmaster/sumberdana',
                {
                    tahun:this.$store.getters['uifront/getTahunAnggaran']
                },
                {
                    headers:{
                        Authorization: this.$store.getters["auth/Token"]
                    }
                }
            ).then(({data})=>{                                      
                this.daftar_sumberdana=data.sumberdana;
            }).catch(()=>{
                this.btnLoading = false;
            });  

        },
        async showdialogcopykegiatan ()
        {
            this.btnLoading = true;            
            await this.$ajax.post('/belanja/rkamurni',
                {
                    tahun:this.$store.getters['uifront/getTahunAnggaran'],                       
                    SOrgID:this.SOrgID,                       
                },
                {
                    headers:{
                        Authorization: this.$store.getters["auth/Token"]
                    }
                }
            ).then(({data})=>{     
                var datatable=data.rka;
                datatable.forEach(item => {
                    if (item.kode_kegiatan==this.datakegiatan.kode_kegiatan)
                    {
                        this.datatable.push(item);
                    }
                });               
                this.btnLoading = false;     
                this.search=this.datakegiatan.kode_kegiatan;
                this.dialogcopykegiatan=true;           
            }).catch(()=>{            
                this.btnLoading = false;
            });                  
        },
        async copyFromMurni (item)
        {
            this.btnLoading = true;            
            await this.$ajax.post('/belanja/rkaperubahan/copykegiatanmurni/'+this.datakegiatan.RKAID,
                {
                    _method:'PUT',
                    RKAID: item.RKAID,
                },
                {
                    headers:{
                        Authorization: this.$store.getters["auth/Token"]
                    }
                }
            ).then(({data})=>{
                var rka=data.rka;
                var page = this.$store.getters["uiadmin/Page"]('rkaperubahan');
                page.datakegiatan.SumberDanaID= rka.SumberDanaID,
                page.datakegiatan.keluaran2= rka.keluaran2,                
                page.datakegiatan.tk_keluaran2= rka.tk_keluaran2,                
                page.datakegiatan.hasil2= rka.hasil2,                
                page.datakegiatan.tk_hasil2= rka.tk_hasil2,                
                page.datakegiatan.capaian_program2= rka.capaian_program2,                
                page.datakegiatan.tk_capaian2= rka.tk_capaian2,                
                page.datakegiatan.masukan2= rka.masukan2,                
                page.datakegiatan.ksk2= rka.ksk2,                
                page.datakegiatan.sifat_kegiatan2= rka.sifat_kegiatan2,                
                page.datakegiatan.waktu_pelaksanaan2= rka.waktu_pelaksanaan2,                
                page.datakegiatan.lokasi_kegiatan2= rka.lokasi_kegiatan2,                                                                              
                page.datakegiatan.nip_pa2= rka.nip_pa2,                
                page.datakegiatan.nip_kpa2= rka.nip_kpa2,                
                page.datakegiatan.nip_ppk2= rka.nip_ppk2,                
                page.datakegiatan.nip_pptk2= rka.nip_pptk2,                
                page.datakegiatan.Descr= rka.Descr,      
                page.datakegiatan.RKAID_Src= rka.RKAID_Src,      
                this.$store.dispatch('uiadmin/updatePage',page);                                 
                this.btnLoading = false;
                this.$router.go();
            }).catch(()=>{            
                this.btnLoading = false;
            });                  
        },
        updatekegiatan:async function ()
        {
            if (this.$refs.frmeditkegiatan.validate())
            {
                this.btnLoading = true;
                await this.$ajax.post('/belanja/rkaperubahan/updatekegiatan/'+this.formdata.RKAID,
                    {
                        _method: 'PUT',
                        SumberDanaID: this.formdata.SumberDanaID,
                        keluaran2: this.formdata.keluaran2,                
                        tk_keluaran2: this.formdata.tk_keluaran2,                
                        hasil2: this.formdata.hasil2,                
                        tk_hasil2: this.formdata.tk_hasil2,                
                        capaian_program2: this.formdata.capaian_program2,                
                        tk_capaian2: this.formdata.tk_capaian2,                
                        masukan2: this.formdata.masukan2,                
                        ksk2: this.formdata.ksk2,                
                        sifat_kegiatan2: this.formdata.sifat_kegiatan2,                
                        waktu_pelaksanaan2: this.formdata.waktu_pelaksanaan2,                
                        lokasi_kegiatan2: this.formdata.lokasi_kegiatan2,                                                                              
                        nip_pa2: this.formdata.nip_pa2,                
                        nip_kpa2: this.formdata.nip_kpa2,                
                        nip_ppk2: this.formdata.nip_ppk2,                
                        nip_pptk2: this.formdata.nip_pptk2,                
                        Descr: this.formdata.Descr,                        
                    },
                    {
                        headers:{
                            Authorization: this.$store.getters["auth/Token"]
                        }
                    }
                ).then(()=>{    
                    var page = this.$store.getters["uiadmin/Page"]('rkaperubahan');
                    page.datakegiatan.SumberDanaID= this.formdata.SumberDanaID,
                    page.datakegiatan.keluaran2= this.formdata.keluaran2,                
                    page.datakegiatan.tk_keluaran2= this.formdata.tk_keluaran2,                
                    page.datakegiatan.hasil2= this.formdata.hasil2,                
                    page.datakegiatan.tk_hasil2= this.formdata.tk_hasil2,                
                    page.datakegiatan.capaian_program2= this.formdata.capaian_program2,                
                    page.datakegiatan.tk_capaian2= this.formdata.tk_capaian2,                
                    page.datakegiatan.masukan2= this.formdata.masukan2,                
                    page.datakegiatan.ksk2= this.formdata.ksk2,                
                    page.datakegiatan.sifat_kegiatan2= this.formdata.sifat_kegiatan2,                
                    page.datakegiatan.waktu_pelaksanaan2= this.formdata.waktu_pelaksanaan2,                
                    page.datakegiatan.lokasi_kegiatan2= this.formdata.lokasi_kegiatan2,                                                                              
                    page.datakegiatan.nip_pa2= this.formdata.nip_pa2,                
                    page.datakegiatan.nip_kpa2= this.formdata.nip_kpa2,                
                    page.datakegiatan.nip_ppk2= this.formdata.nip_ppk2,                
                    page.datakegiatan.nip_pptk2= this.formdata.nip_pptk2,                
                    page.datakegiatan.Descr= this.formdata.Descr,      
                    this.$store.dispatch('uiadmin/updatePage',page);
                    this.closeeditkegiatan();
                }).catch(()=>{                    
                    this.btnLoading = false;
                });  
            }
        },
        closedialogcopykegiatan()
        {
            this.dialogcopykegiatan=false;
            this.datatable=[];
            this.search='';
        },
        closeeditkegiatan()
        {
            this.$router.push('/belanjaperubahan/rka/uraian/'+this.datakegiatan.RKAID);            
        },
        
    },
    components: {
        BelanjaPerubahanLayout,
        ModuleHeader,
    },
};
</script>