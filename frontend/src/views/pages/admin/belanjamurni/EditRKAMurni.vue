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
                    Ubah Rencana Kegiatan dan Anggaran (RKA) OPD / Unit Kerja APBD Murni
                </v-alert>
            </template>
        </ModuleHeader>
        <v-container > 
            <v-row class="mb-4" no-gutters>
                <v-col cols="12">
                    <v-bottom-navigation color="purple lighten-1">                        
                        <v-btn :to="{path:'/belanjamurni/rka/uraian/'+datakegiatan.RKAID}"> 
                            <span>Keluar</span>
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                    </v-bottom-navigation>
                </v-col>
            </v-row>
            <v-row class="mb-4" no-gutters>
                <v-col cols="12">
                    <v-form ref="frmeditkegiatan" v-model="form_valid" lazy-validation>
                        <v-card>           
                            <v-card-title>
                                <v-spacer />
                                    <v-icon
                                        small
                                        class="mr-2"
                                        v-if="datakegiatan.Locked">
                                        mdi-lock
                                    </v-icon>
                            </v-card-title>
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
                                    :value="datakegiatan.PaguDana1|formatUang"
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
                                    :disabled="datakegiatan.Locked"                                                            
                                />
                                <v-text-field 
                                    v-model="formdata.lokasi_kegiatan1" 
                                    label="LOKASI KEGIATAN" 
                                    :rules="rule_lokasikegiatan"
                                    type="text"  
                                    filled               
                                    :disabled="datakegiatan.Locked"                                                 
                                />
                                <h5>INDIKATOR DAN TOLAK UKUR KINERJA BELANJA LANGSUNG</h5>
                                <v-divider class="mb-2"></v-divider>
                                <v-text-field 
                                    v-model="formdata.capaian_program1" 
                                    label="CAPAIAN PROGRAM" 
                                    :rules="rule_capaianprogram"
                                    type="text"  
                                    filled      
                                    :disabled="datakegiatan.Locked"                                                          
                                />
                                <v-text-field 
                                    v-model="formdata.tk_capaian1" 
                                    label="TARGET KINERJA CAPAIAN (%)" 
                                    :rules="rule_tkcapaian"
                                    type="text"  
                                    filled         
                                    :disabled="datakegiatan.Locked"                                                       
                                />
                                <v-textarea 
                                    v-model="formdata.masukan1" 
                                    label="MASUKAN" 
                                    :rules="rule_masukan"
                                    type="text"
                                    filled              
                                    :disabled="datakegiatan.Locked"                                                  
                                />
                                <v-textarea 
                                    v-model="formdata.keluaran1" 
                                    label="KELUARAN (OUTPUT)" 
                                    :rules="rule_keluaran"
                                    type="text"
                                    filled                                                               
                                    :disabled="datakegiatan.Locked" 
                                />
                                <v-textarea 
                                    v-model="formdata.tk_keluaran1" 
                                    label="TARGET KINERJA KELUARAN (OUTPUT)" 
                                    :rules="rule_tkkeluaran"
                                    type="text"
                                    filled                
                                    :disabled="datakegiatan.Locked"                                                
                                />
                                <v-textarea 
                                    v-model="formdata.hasil1" 
                                    label="HASIL (OUTCOME)" 
                                    :rules="rule_hasil"
                                    type="text"
                                    filled                
                                    :disabled="datakegiatan.Locked"                                                
                                />
                                <v-textarea 
                                    v-model="formdata.tk_hasil1" 
                                    label="TARGET KINERJA HASIL (OUTCOME)" 
                                    :rules="rule_tkhasil"
                                    type="text"
                                    filled               
                                    :disabled="datakegiatan.Locked"                                                 
                                />
                                <v-text-field 
                                    v-model="formdata.ksk1" 
                                    label="KELOMPOK SASARAN KEGIATAN" 
                                    :rules="rule_ksk"
                                    type="text"  
                                    filled                
                                    :disabled="datakegiatan.Locked"                                                
                                />
                                <v-radio-group v-model="formdata.sifat_kegiatan1" row :disabled="datakegiatan.Locked">
                                    <v-radio label="BARU" value="baru"></v-radio>
                                    <v-radio label="LANJUTAN" value="lanjutan">></v-radio>
                                </v-radio-group>
                                <v-text-field 
                                    v-model="formdata.waktu_pelaksanaan1" 
                                    label="WAKTU PELAKSANAAN" 
                                    :rules="rule_waktupelaksanaan"
                                    type="text"  
                                    filled                     
                                    :disabled="datakegiatan.Locked"                                           
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
                                    v-model="formdata.nip_pa1"
                                    label="PENGGUNA ANGGARAN" 
                                    :rules="rule_pa"
                                    :items="daftar_pa"  
                                    filled                         
                                    :disabled="datakegiatan.Locked"                                       
                                />
                                <v-select 
                                    v-model="formdata.nip_kpa1"
                                    label="KUASA PENGGUNA ANGGARAN" 
                                    :rules="rule_kpa"
                                    :items="daftar_kpa"  
                                    filled                               
                                    :disabled="datakegiatan.Locked"                                 
                                />
                                <v-select 
                                    label="PPK" 
                                    v-model="formdata.nip_ppk1"
                                    :rules="rule_ppk"
                                    :items="daftar_ppk"  
                                    filled                           
                                    :disabled="datakegiatan.Locked"                                     
                                />
                                <v-select 
                                    label="PPTK" 
                                    v-model="formdata.nip_pptk1"
                                    :rules="rule_pptk"
                                    :items="daftar_pptk"  
                                    filled                       
                                    :disabled="datakegiatan.Locked"                                         
                                />
                                <h5>LAIN-LAIN</h5>
                                <v-divider class="mb-2"></v-divider>
                                <v-textarea 
                                    v-model="formdata.Descr" 
                                    label="KETERANGAN"                                 
                                    type="text"
                                    filled                                                               
                                    :disabled="datakegiatan.Locked" 
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
                                    :disabled="!form_valid||btnLoading||datakegiatan.Locked">
                                        SIMPAN
                                    </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-form>
                </v-col>
            </v-row>              
        </v-container>
    </BelanjaMurniLayout>
</template>
<script>
import BelanjaMurniLayout from '@/views/layouts/BelanjaMurniLayout';
import ModuleHeader from '@/components/ModuleHeader';
export default {
    name:'EditRKAMurni',
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
                text:'RKA (RENCANA KEGIATAN DAN ANGGARAN)',
                disabled:false,
                href:'/belanjamurni/rka'
            },
            {
                text:'UBAH RKA',
                disabled:true,
                href:'#'
            }
        ];

        this.RKAID = this.$route.params.rkaid;            
        var page = this.$store.getters['uiadmin/Page']('rkamurni');
        this.datakegiatan = page.datakegiatan; 

        if (Object.keys(this.datakegiatan).length > 1)
        {
            this.OrgID=page.OrgID_Selected;
            this.initialize();            
        }  
        else
        {
            page.datakegiatan ={
                RKAID:'',
            };
            page.datauraian ={
                RKARincID:'',
            };
            page.datarekening ={};

            this.$store.dispatch('uiadmin/updatePage',page);
            this.$router.push('/belanja/rkamurni');
        } 
    },     
    data ()
    {
        return {
            //modul
            OrgID:'',
            RKAID:'',
            btnLoading:false,
            datakegiatan: [],
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
                keluaran1: null,                
                tk_keluaran1: '',                
                hasil1: '',                
                tk_hasil1: '',                
                capaian_program1: '',                
                tk_capaian1: '',                
                masukan1: '',                
                ksk1: '',                
                sifat_kegiatan1: 'baru',                
                waktu_pelaksanaan1: '',                
                lokasi_kegiatan1: '',                
                PaguDana1: '',                
                RealisasiKeuangan1: '',                
                RealisasiFisik1: '',                
                nip_pa1: '',                
                nip_kpa1: '',                
                nip_ppk1: '',                
                nip_pptk1: '',                
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
                        Authorization:this.$store.getters['auth/Token']
                    }
                }
            ).then(({data})=>{                                 
                this.daftar_pa=data.pejabat.pa;
                this.daftar_kpa=data.pejabat.kpa;
                this.daftar_ppk=data.pejabat.ppk;
                this.daftar_pptk=data.pejabat.pptk;
            }).catch(()=>{
                this.btnLoading=false;
            });  

            await this.$ajax.post('/dmaster/sumberdana',
                {
                    tahun:this.$store.getters['uifront/getTahunAnggaran']
                },
                {
                    headers:{
                        Authorization:this.$store.getters['auth/Token']
                    }
                }
            ).then(({data})=>{                                      
                this.daftar_sumberdana=data.sumberdana;
            }).catch(()=>{
                this.btnLoading=false;
            });  

        },
        updatekegiatan:async function ()
        {
            if (this.$refs.frmeditkegiatan.validate())
            {
                this.btnLoading=true;
                await this.$ajax.post('/belanja/rkamurni/updatekegiatan/'+this.formdata.RKAID,
                    {
                        _method: 'PUT',
                        SumberDanaID: this.formdata.SumberDanaID,
                        keluaran1: this.formdata.keluaran1,                
                        tk_keluaran1: this.formdata.tk_keluaran1,                
                        hasil1: this.formdata.hasil1,                
                        tk_hasil1: this.formdata.tk_hasil1,                
                        capaian_program1: this.formdata.capaian_program1,                
                        tk_capaian1: this.formdata.tk_capaian1,                
                        masukan1: this.formdata.masukan1,                
                        ksk1: this.formdata.ksk1,                
                        sifat_kegiatan1: this.formdata.sifat_kegiatan1,                
                        waktu_pelaksanaan1: this.formdata.waktu_pelaksanaan1,                
                        lokasi_kegiatan1: this.formdata.lokasi_kegiatan1,                                                                              
                        nip_pa1: this.formdata.nip_pa1,                
                        nip_kpa1: this.formdata.nip_kpa1,                
                        nip_ppk1: this.formdata.nip_ppk1,                
                        nip_pptk1: this.formdata.nip_pptk1,                
                        Descr: this.formdata.Descr,                        
                    },
                    {
                        headers:{
                            Authorization:this.$store.getters['auth/Token']
                        }
                    }
                ).then(()=>{    
                    var page = this.$store.getters['uiadmin/Page']('rkamurni');
                    page.datakegiatan.SumberDanaID= this.formdata.SumberDanaID,
                    page.datakegiatan.keluaran1= this.formdata.keluaran1,                
                    page.datakegiatan.tk_keluaran1= this.formdata.tk_keluaran1,                
                    page.datakegiatan.hasil1= this.formdata.hasil1,                
                    page.datakegiatan.tk_hasil1= this.formdata.tk_hasil1,                
                    page.datakegiatan.capaian_program1= this.formdata.capaian_program1,                
                    page.datakegiatan.tk_capaian1= this.formdata.tk_capaian1,                
                    page.datakegiatan.masukan1= this.formdata.masukan1,                
                    page.datakegiatan.ksk1= this.formdata.ksk1,                
                    page.datakegiatan.sifat_kegiatan1= this.formdata.sifat_kegiatan1,                
                    page.datakegiatan.waktu_pelaksanaan1= this.formdata.waktu_pelaksanaan1,                
                    page.datakegiatan.lokasi_kegiatan1= this.formdata.lokasi_kegiatan1,                                                                              
                    page.datakegiatan.nip_pa1= this.formdata.nip_pa1,                
                    page.datakegiatan.nip_kpa1= this.formdata.nip_kpa1,                
                    page.datakegiatan.nip_ppk1= this.formdata.nip_ppk1,                
                    page.datakegiatan.nip_pptk1= this.formdata.nip_pptk1,                
                    page.datakegiatan.Descr= this.formdata.Descr,      
                    this.$store.dispatch('uiadmin/updatePage',page);
                    this.closeeditkegiatan();
                }).catch(()=>{                    
                    this.btnLoading=false;
                });  
            }
        },
        closeeditkegiatan()
        {
            this.$router.push('/belanjamurni/rka/uraian/'+this.datakegiatan.RKAID);            
        }
    },
    components:{
        BelanjaMurniLayout,
        ModuleHeader,
    },
}
</script>