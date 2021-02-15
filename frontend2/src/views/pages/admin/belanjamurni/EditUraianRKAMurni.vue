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
                    Ubah Uraian Rencana Kegiatan dan Anggaran (RKA) OPD / Unit Kerja APBD Murni
                </v-alert>
            </template>
        </ModuleHeader>
        <v-container > 
            <v-row class="mb-4" no-gutters>
                <v-col cols="12">
                    <v-bottom-navigation color="purple lighten-1">                        
                        <v-btn :to="{path:'/belanjamurni/rka/uraian/'+datauraian.RKAID}"> 
                            <span>Keluar</span>
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                    </v-bottom-navigation>
                </v-col>
            </v-row>
            <v-row class="mb-4" no-gutters>
                <v-col cols="12">
                    <v-form ref="frmedituraian" v-model="form_valid" lazy-validation>
                        <v-card class="mb-2">                                                
                            <v-card-text>
                                <h5>DATA URAIAN</h5>
                                <v-divider class="mb-2"></v-divider>                                
                                <v-text-field 
                                    label="KEGIATAN" 
                                    type="text"  
                                    filled     
                                    :value="'['+datakegiatan.kode_kegiatan+'] '+datakegiatan.KgtNm"
                                    :disabled="true"                                                          
                                />
                                <v-text-field 
                                    label="URAIAN" 
                                    type="text"  
                                    filled     
                                    :value="'['+datauraian.kode_uraian+'] '+datauraian.nama_uraian"
                                    :disabled="true"                                                          
                                />
                                <v-text-field 
                                    label="PAGU URAIAN" 
                                    type="text"  
                                    filled     
                                    :value="datauraian.PaguUraian1|formatUang"
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
                                <v-select 
                                    v-model="formdata.JenisPelaksanaanID"
                                    label="JENIS PELAKSANAAN"       
                                    item-text="NamaJenis" 
                                    item-value="JenisPelaksanaanID"                              
                                    :items="daftar_jenispelaksanaan"  
                                    filled                                                               
                                />
                                <v-select 
                                    v-model="formdata.JenisPembangunanID"
                                    label="JENIS PEMBANGUNAN"  
                                    item-text="NamaJenis" 
                                    item-value="JenisPembangunanID"                                                                 
                                    :items="daftar_jenispembangunan"  
                                    filled                                                               
                                />
                            </v-card-text>
                        </v-card>
                        <v-card class="mb-2">                            
                            <v-tabs v-model="tab">
                                <v-tab>LOKASI DEFAULT</v-tab>
                                <v-tab>LOKASI LAIN</v-tab>
                            </v-tabs>
                            <v-tabs-items v-model="tab">
                                <v-tab-item :key="0">
                                    <v-card flat>
                                        <v-card-text>
                                            <v-select 
                                                v-model="formlokasi_PMProvID" 
                                                label="PROVINSI"                                                 
                                                :items="daftar_prov"  
                                                item-text="Nm_Prov" 
                                                item-value="PMProvID"
                                                filled 
                                                :loading="btnLoading"
                                                :disabled="btnLoading"                                                             
                                            />
                                            <v-select 
                                                v-model="formlokasi_PmKotaID" 
                                                label="KABUPATEN/KOTA"                                                 
                                                :items="daftar_kab"  
                                                :loading="btnLoading"
                                                :disabled="btnLoading"                                                             
                                                item-text="Nm_Kota" 
                                                item-value="PmKotaID"
                                                filled                                                               
                                            />
                                            <v-select 
                                                v-model="formlokasi_PmKecamatanID" 
                                                label="KECAMATAN"   
                                                :loading="btnLoading"
                                                :disabled="btnLoading"                                                                                                           
                                                :items="daftar_kecamatan"  
                                                item-text="Nm_Kecamatan" 
                                                item-value="PmKecamatanID"
                                                filled                                                               
                                            />
                                            <v-select 
                                                v-model="formlokasi_PmDesaID" 
                                                label="DESA/KELURAHAN"                                                 
                                                :items="daftar_desa"                                                            
                                                item-text="Nm_Desa" 
                                                item-value="PmDesaID"
                                                filled                                                               
                                            />
                                            <v-select 
                                                v-model="formlokasi_rw" 
                                                label="RW"                                                 
                                                :items="daftar_rtrw"  
                                                filled                                                               
                                            />
                                            <v-select 
                                                v-model="formlokasi_rt" 
                                                label="RT"                                                 
                                                :items="daftar_rtrw"                                                  
                                                filled                                                               
                                            />
                                        </v-card-text>
                                    </v-card>
                                </v-tab-item>
                                <v-tab-item :key="1">
                                    <v-card flat>
                                        <v-card-text>
                                            <v-text-field 
                                                v-model="formdata.ket_lok" 
                                                label="LOKASI KEGIATAN"                                     
                                                type="text"  
                                                filled                                                               
                                            />
                                        </v-card-text>
                                    </v-card>
                                </v-tab-item>
                            </v-tabs-items>                                    
                        </v-card>
                        <v-card>
                            <v-card-text>
                                <h5>DATA URAIAN</h5>
                                <v-divider class="mb-2"></v-divider>
                                <v-text-field 
                                    v-model="formdata.nama_perusahaan" 
                                    label="NAMA PERUSAHAAN"                                     
                                    type="text"  
                                    filled                                                               
                                />
                                <v-text-field 
                                    v-model="formdata.alamat_perusahaan" 
                                    label="ALAMAT PERUSAHAAN"                                     
                                    type="text"  
                                    filled                                                               
                                />
                                <v-text-field 
                                    v-model="formdata.no_telepon" 
                                    label="NOMOR TELEPON"                                     
                                    type="text"
                                    :rules="rule_notelepon"
                                    filled                                                               
                                />
                                <v-text-field 
                                    v-model="formdata.nama_direktur" 
                                    label="NAMA DIREKTUR"                                     
                                    type="text"
                                    filled                                                               
                                />
                                <v-text-field 
                                    v-model="formdata.npwp" 
                                    label="NPWP"                                     
                                    type="text"
                                    filled                                                               
                                />
                                <v-text-field 
                                    v-model="formdata.no_kontrak" 
                                    label="NOMOR KONTRAK"                                     
                                    type="text"
                                    filled                                                               
                                />       
                                <v-menu
                                    ref="menuTanggalKontrak"
                                    v-model="menuTanggalKontrak"
                                    :close-on-content-click="false"
                                    :return-value.sync="formdata.tgl_kontrak"
                                    transition="scale-transition"
                                    offset-y
                                    max-width="290px"
                                    min-width="290px"
                                >
                                    <template v-slot:activator="{ on }">
                                        <v-text-field
                                            v-model="formdata.tgl_kontrak"
                                            label="TANGGAL KONTRAK"                                            
                                            readonly
                                            v-on="on"
                                        ></v-text-field>
                                    </template>
                                    <v-date-picker
                                        v-model="formdata.tgl_kontrak"                                        
                                        no-title
                                        scrollable
                                        >
                                        <v-spacer></v-spacer>
                                        <v-btn text color="primary" @click="menuTanggalKontrak = false">Cancel</v-btn>
                                        <v-btn text color="primary" @click="$refs.menuTanggalKontrak.save(formdata.tgl_kontrak)">OK</v-btn>
                                    </v-date-picker>
                                </v-menu>
                                <v-menu
                                    ref="menuTanggalMulaiPelaksanaan"
                                    v-model="menuTanggalMulaiPelaksanaan"
                                    :close-on-content-click="false"
                                    :return-value.sync="formdata.tgl_mulai_pelaksanaan"
                                    transition="scale-transition"
                                    offset-y
                                    max-width="290px"
                                    min-width="290px"
                                >
                                    <template v-slot:activator="{ on }">
                                        <v-text-field
                                            v-model="formdata.tgl_mulai_pelaksanaan"
                                            label="TANGGAL MULAI PELAKSANAAN"                                            
                                            readonly
                                            v-on="on"
                                        ></v-text-field>
                                    </template>
                                    <v-date-picker
                                        v-model="formdata.tgl_mulai_pelaksanaan"                                        
                                        no-title
                                        scrollable
                                        >
                                        <v-spacer></v-spacer>
                                        <v-btn text color="primary" @click="menuTanggalMulaiPelaksanaan = false">Cancel</v-btn>
                                        <v-btn text color="primary" @click="$refs.menuTanggalMulaiPelaksanaan.save(formdata.tgl_mulai_pelaksanaan)">OK</v-btn>
                                    </v-date-picker>
                                </v-menu>
                                <v-menu
                                    ref="menuTanggalSelesaiPelaksanaan"
                                    v-model="menuTanggalSelesaiPelaksanaan"
                                    :close-on-content-click="false"
                                    :return-value.sync="formdata.tgl_mulai_pelaksanaan"
                                    transition="scale-transition"
                                    offset-y
                                    max-width="290px"
                                    min-width="290px"
                                >
                                    <template v-slot:activator="{ on }">
                                        <v-text-field
                                            v-model="formdata.tgl_selesai_pelaksanaan"
                                            label="TANGGAL SELESAI PELAKSANAAN"                                            
                                            readonly
                                            v-on="on"
                                        ></v-text-field>
                                    </template>
                                    <v-date-picker
                                        v-model="formdata.tgl_selesai_pelaksanaan"                                        
                                        no-title
                                        scrollable
                                        >
                                        <v-spacer></v-spacer>
                                        <v-btn text color="primary" @click="menuTanggalSelesaiPelaksanaan = false">Cancel</v-btn>
                                        <v-btn text color="primary" @click="$refs.menuTanggalSelesaiPelaksanaan.save(formdata.tgl_selesai_pelaksanaan)">OK</v-btn>
                                    </v-date-picker>
                                </v-menu>
                                <v-select 
                                    v-model="formdata.status_lelang"
                                    label="STATUS LELANG"                                    
                                    :items="daftar_statuslelang"  
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
                                <v-btn color="blue darken-1" text @click.stop="closeedituraian">BATAL</v-btn>
                                <v-btn 
                                    color="blue darken-1" 
                                    text 
                                    @click.stop="updateuraian" 
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
    </BelanjaMurniLayout>
</template>
<script>
import BelanjaMurniLayout from '@/views/layouts/BelanjaMurniLayout';
import ModuleHeader from '@/components/ModuleHeader';
export default {
    name:'EditUraianRKAMurni',
    created () 
    {
        this.breadcrumbs = [
            {
                text:'HOME',
                disabled:false,
                href:'/dashboard/'+this.$store.getters['auth/AccessToken']
            },
            {
                text:'BELANJA',
                disabled:false,
                href:'#'
            },
            {
                text:'RKA MURNI',
                disabled:false,
                href:'#'
            },
            {
                text:'URAIAN RKA MURNI',
                disabled:false,
                href:'#'
            },
            {
                text:'UBAH URAIAN RKA',
                disabled:true,
                href:'#'
            }
        ];

        this.RKARincID = this.$route.params.rkarincid;            
        var page = this.$store.getters['uiadmin/Page']('rkamurni');        
        this.datakegiatan = page.datakegiatan; 
        this.datauraian = page.datauraian; 

        if (Object.keys(this.datauraian).length > 1)
        {
            this.OrgID=page.OrgID_Selected;
            this.initialize();       
            if (this.formdata.SumberDanaID ==null || this.formdata.SumberDanaID=='')
            {
                this.formdata.SumberDanaID=this.datakegiatan.SumberDanaID;
            }
            if (this.formdata.idlok!=null &&this.formdata.idlok!='' && this.formdata.idlok.length >0)
            {
                this.formlokasi_PMProvID=this.formdata.PMProvID;        
            }   
            else
            {
                this.tab=1;
            }              
            this.formlokasi_rw=this.formdata.rw;
            this.formlokasi_rt=this.formdata.rt; 
                       
        }  
        else if (Object.keys(this.datakegiatan).length > 1)
        {
            this.closeedituraian();
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
            this.$router.push('/belanjamurni/rka');
        } 
    },     
    data ()
    {
        return {
            //modul
            OrgID:'',
            RKARincID:'',
            btnLoading:false,
            datakegiatan: [],
            datauraian: [],
            //form data    
            firstformload_prov:true, 
            firstformload_kota:true, 
            firstformload_kecamatan:true, 
            menuTanggalKontrak:false, 
            menuTanggalMulaiPelaksanaan:false, 
            menuTanggalSelesaiPelaksanaan:false, 
            tab:null,         
            form_valid:true,
            daftar_sumberdana:[],
            daftar_jenispelaksanaan: [],
            daftar_jenispembangunan: [],
            daftar_prov: [],
            daftar_kab: [],
            daftar_kecamatan: [],
            daftar_desa: [],
            daftar_rtrw: [                
                { 
                    value:"1",
                    text:"I"
                },
                { 
                    value:"2",
                    text:"II"
                },
                { 
                    value:"3",
                    text:"III"
                },
                { 
                    value:"4",
                    text:"IV"
                },
                { 
                    value:"5",
                    text:"V"
                },
                { 
                    value:"6",
                    text:"VI"
                },
                { 
                    value:"7",
                    text:"VII"
                },
                { 
                    value:"8",
                    text:"VIII"
                },
                { 
                    value:"9",
                    text:"IX"
                },
                { 
                    value:"10",
                    text:"X"
                },
                { 
                    value:"11",
                    text:"XI"
                },
                { 
                    value:"12",
                    text:"XII"
                },
                { 
                    value:"13",
                    text:"XIII"
                },
                { 
                    value:"14",
                    text:"XIV"
                },
                { 
                    value:"15",
                    text:"XV"
                },
                { 
                    value:"16",
                    text:"XVI"
                },
                { 
                    value:"17",
                    text:"XVII"
                },
                { 
                    value:"18",
                    text:"XVIII"
                },
                { 
                    value:"19",
                    text:"XIX"
                },
                { 
                    value:"20",
                    text:"XX"
                },
            ],    
            daftar_statuslelang: [
                {
                    value:"0",
                    text:"BELUM DILELANG"
                },
                {
                    value:"2",
                    text:"PROSES LELANG"
                },
                {
                    value:"1",
                    text:"TELAH DILELANG"
                }
            ],        
            formlokasi_PMProvID:'',
            formlokasi_PmKotaID:'',
            formlokasi_PmKecamatanID:'',
            formlokasi_PmDesaID:'',
            formlokasi_rw:'',
            formlokasi_rt:'',            
            formdata :{
                RKARincID: '',
                RKAID: '',
                JenisPelaksanaanID:'',
                SumberDanaID: null,
                JenisPembangunanID:'',
                kode_uraian: '',              
                nama_uraian: '',                               
                volume1: 0,                
                satuan1: '',                
                harga_satuan1: 0,                
                PaguUraian1: 0, 
                PMProvID:'',
                PmKotaID:'',
                PmKecamatanID:'', 
                idlok: '',                
                ket_lok: '',                
                rw: '',                
                rt: '',                                       
                nama_perusahaan: '',                
                alamat_perusahaan: '',                
                no_telepon: '',                
                nama_direktur: '',                
                npwp: '',                
                no_kontrak: '',                
                tgl_kontrak: '',                
                tgl_mulai_pelaksanaan: '',                
                tgl_selesai_pelaksanaan: '',                
                status_lelang: '',                
                Descr: '',
                TA: '',                
                created_at: '',
                updated_at: '',
            },
            rule_sumberdana:[
                value => !!value||"Mohon untuk di pilih sumber dana !!!",                  
            ],                        
            rule_notelepon:[
                (value) =>  {
                    if (value !== null && value !== '' && value.length > 0)
                    {
                        return /^[0-9]+$/.test(value) || 'Nomor Telepon harus angka'                              
                    }
                    else
                    {
                        return true;
                    }
                }
            ],                        
        };
    },
    methods: {
        initialize:async function  () 
        {  
            this.formdata = Object.assign({}, this.datauraian);              
            await this.$ajax.post('/dmaster/jenispelaksanaan',
                {
                    tahun:this.$store.getters['uifront/getTahunAnggaran']
                },
                {
                    headers:{
                        Authorization:this.$store.getters['auth/Token']
                    }
                }
            ).then(({data})=>{                                 
                this.daftar_jenispelaksanaan=data.jenispelaksanaan;
            }).catch(()=>{
                this.btnLoading=false;
            });  
            
            await this.$ajax.post('/dmaster/jenispembangunan',
                {
                    tahun:this.$store.getters['uifront/getTahunAnggaran']
                },
                {
                    headers:{
                        Authorization:this.$store.getters['auth/Token']
                    }
                }
            ).then(({data})=>{                                                 
                this.daftar_jenispembangunan=data.jenispembangunan;                
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

            await this.$ajax.get('/dmaster/provinsi',
                {
                    tahun:this.$store.getters['uifront/getTahunAnggaran']
                },
                {
                    headers:{
                        Authorization:this.$store.getters['auth/Token']
                    }
                }
            ).then(({data})=>{                                      
                this.daftar_prov=data.provinsi;
            }).catch(()=>{
                this.btnLoading=false;
            });  
            
            
        },
        updateuraian:async function ()
        {
            if (this.$refs.frmedituraian.validate())
            {
                this.btnLoading=true;
                var idlok = this.formdata.idlok;
                var ket_lok = this.formdata.ket_lok;
                if (this.tab==1)
                {
                    idlok = '';                     
                }
                await this.$ajax.post('/belanja/rkamurni/updatedetailuraian/'+this.formdata.RKARincID,
                    {
                        _method: 'PUT',
                        JenisPelaksanaanID: this.formdata.JenisPelaksanaanID,
                        SumberDanaID: this.formdata.SumberDanaID,
                        JenisPembangunanID: this.formdata.JenisPembangunanID,                        
                        idlok: idlok,                
                        ket_lok: ket_lok,                
                        rw: this.formlokasi_rw,                
                        rt: this.formlokasi_rt,                
                        nama_perusahaan: this.formdata.nama_perusahaan,                
                        alamat_perusahaan: this.formdata.alamat_perusahaan,                
                        no_telepon: this.formdata.no_telepon,                                                                              
                        nama_direktur: this.formdata.nama_direktur,                
                        npwp: this.formdata.npwp,                
                        no_kontrak: this.formdata.no_kontrak,                
                        tgl_kontrak: this.formdata.tgl_kontrak,                                        
                        tgl_mulai_pelaksanaan: this.formdata.tgl_mulai_pelaksanaan,                
                        tgl_selesai_pelaksanaan: this.formdata.tgl_selesai_pelaksanaan,                
                        status_lelang: this.formdata.status_lelang,             
                        Descr: this.formdata.Descr,                        
                    },
                    {
                        headers:{
                            Authorization:this.$store.getters['auth/Token']
                        }
                    }
                ).then(()=>{    
                    var page = this.$store.getters['uiadmin/Page']('rkamurni');
                    page.datauraian.JenisPelaksanaanID= this.formdata.JenisPelaksanaanID;
                    page.datauraian.SumberDanaID= this.formdata.SumberDanaID;                
                    page.datauraian.JenisPembangunanID= this.formdata.JenisPembangunanID;                                    
                    page.datauraian.idlok= idlok;                
                    page.datauraian.ket_lok= ket_lok;   
                    page.datauraian.PMProvID=this.formlokasi_PMProvID;             
                    page.datauraian.PmKotaID=this.formlokasi_PmKotaID;             
                    page.datauraian.PmKecamatanID=this.formlokasi_PmKecamatanID;             
                    page.datauraian.PmDesaID=this.formlokasi_PmDesaID;             
                    page.datauraian.rw= this.formlokasi_rw;                
                    page.datauraian.rt= this.formlokasi_rt;                
                    page.datauraian.nama_perusahaan= this.formdata.nama_perusahaan;                
                    page.datauraian.alamat_perusahaan= this.formdata.alamat_perusahaan;                                                                              
                    page.datauraian.no_telepon= this.formdata.no_telepon;                
                    page.datauraian.nama_direktur= this.formdata.nama_direktur;                
                    page.datauraian.npwp= this.formdata.npwp;                
                    page.datauraian.no_kontrak= this.formdata.no_kontrak;                
                    page.datauraian.tgl_kontrak= this.formdata.tgl_kontrak;                
                    page.datauraian.tgl_mulai_pelaksanaan= this.formdata.tgl_mulai_pelaksanaan;                
                    page.datauraian.tgl_selesai_pelaksanaan= this.formdata.tgl_selesai_pelaksanaan;                
                    page.datauraian.status_lelang= this.formdata.status_lelang;                
                    page.datauraian.Descr= this.formdata.Descr;      
                    this.$store.dispatch('uiadmin/updatePage',page);
                    this.closeedituraian();
                    this.btnLoading=false;                    
                }).catch(()=>{                    
                    this.btnLoading=false;
                });  
            }
        },
        closeedituraian()
        {
            this.$router.push('/belanjamurni/rka/realisasi/'+this.formdata.RKARincID);                                
        }
    },
    watch:{
        formlokasi_PMProvID:async function (val)
        {
            let PMProvID=val;            
            this.btnLoading=true;                        
            await this.$ajax.get('/dmaster/provinsi/'+PMProvID+'/kota',
                {
                    tahun:this.$store.getters['uifront/getTahunAnggaran']
                },
                {
                    headers:{
                        Authorization:this.$store.getters['auth/Token']
                    }
                }
            ).then(({data})=>{                                      
                this.daftar_kab=data.kota;
                this.formdata.idlok=PMProvID;
                this.formdata.ket_lok='provinsi';
                this.btnLoading=false;
            }).catch(()=>{
                this.btnLoading=false;
            });                 
            if (this.firstformload_prov)
            {
                this.firstformload_prov=false;
                this.formlokasi_PmKotaID=this.formdata.PmKotaID;                                                            
            }                
            this.daftar_kecamatan=[];
            this.daftar_desa=[];                         
        },
        formlokasi_PmKotaID:async function (val)
        {
            let PmKotaID=val;
            this.btnLoading=true;
            await this.$ajax.get('/dmaster/kota/'+PmKotaID+'/kecamatan',
                {
                    tahun:this.$store.getters['uifront/getTahunAnggaran']
                },
                {
                    headers:{
                        Authorization:this.$store.getters['auth/Token']
                    }
                }
            ).then(({data})=>{                                      
                this.daftar_kecamatan=data.kecamatan;
                this.formdata.idlok=PmKotaID;
                this.formdata.ket_lok='kota';
                this.btnLoading=false;
            }).catch(()=>{
                this.btnLoading=false;
            });                                 
            if (this.firstformload_kota)
            {
                this.firstformload_kota=false;
                this.formlokasi_PmKecamatanID=this.formdata.PmKecamatanID;                                                            
            }      
            this.daftar_desa=[];   
        },
        formlokasi_PmKecamatanID:async function (val)
        {
            let PmKecamatanID=val;
            await this.$ajax.get('/dmaster/kecamatan/'+PmKecamatanID+'/desa',
                {
                    tahun:this.$store.getters['uifront/getTahunAnggaran']
                },
                {
                    headers:{
                        Authorization:this.$store.getters['auth/Token']
                    }
                }
            ).then(({data})=>{                                      
                this.daftar_desa=data.desa;
                this.formdata.idlok=PmKecamatanID;
                this.formdata.ket_lok='kecamatan';
                this.btnLoading=false;
            }).catch(()=>{
                this.btnLoading=false;
            }); 
            if (this.firstformload_kecamatan)
            {
                this.firstformload_kecamatan=false;
                this.formlokasi_PmDesaID=this.formdata.PmDesaID;                                                          
            }                                 
        },
        formlokasi_PmDesaID(val)
        {
            this.formdata.idlok=val;
            this.formdata.ket_lok='desa';        
        }
    },
    components:{
        BelanjaMurniLayout,
        ModuleHeader,
    },
}
</script>