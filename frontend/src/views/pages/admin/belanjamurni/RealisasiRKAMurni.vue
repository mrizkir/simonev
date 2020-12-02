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
                    Realisasi Uraian Rencana Kegiatan dan Anggaran (RKA) OPD / Unit Kerja APBD Murni
                </v-alert>
            </template>
        </ModuleHeader>
        <v-container v-if="Object.keys(this.datakegiatan).length>2&&Object.keys(this.datauraian).length > 2"> 
            <v-row class="mb-4" no-gutters>
                <v-col cols="12">
                    <v-card>
                        <v-card-title>
                            DATA URAIAN
                        </v-card-title>
                        <v-card-text>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td width="150">RKARincID</td>
                                        <td width="400">{{datauraian.RKARincID}}</td>
                                        <td width="150">KODE OPD / SKPD</td>
                                        <td width="400">{{datakegiatan.kode_organisasi}}</td>                                        
                                    </tr>
                                    <tr>
                                        <td width="150">KODE URAIAN</td>
                                        <td width="400">{{datauraian.kode_uraian}}</td>  
                                        <td width="150">OPD / SKPD</td>
                                        <td width="400">{{datakegiatan.OrgNm}}</td>
                                    </tr>
                                    <tr>
                                        <td width="150">NAMA URAIAN</td>
                                        <td width="400">{{datauraian.nama_uraian}}</td>  
                                        <td width="150">KODE UNIT</td>
                                        <td width="400">{{datakegiatan.kode_suborganisasi}}</td>                                                                      
                                    </tr>
                                    <tr>
                                        <td width="150">VOLUME</td>
                                        <td width="400">{{datauraian.volume}}</td>
                                        <td width="150">UNIT KERJA</td>
                                        <td width="400">{{datakegiatan.SOrgNm}}</td>                                                                      
                                    </tr>
                                    <tr>
                                        <td width="150">HARGA SATUAN</td>
                                        <td width="400">{{datauraian.harga_satuan1|formatUang}}</td>
                                        <td width="150">KODE KEGIATAN</td>
                                        <td width="400">{{datakegiatan.kode_kegiatan}}</td>   
                                    </tr>
                                    <tr>
                                        <td width="150">PAGU URAIAN</td>
                                        <td width="400">{{datauraian.PaguUraian1|formatUang}}</td>
                                        <td width="150">NAMA KEGIATAN</td>
                                        <td width="400">{{datakegiatan.KgtNm}}</td>                                        
                                    </tr>          
                                    <tr>
                                        <td width="150">PROGRAM</td>
                                        <td width="400">{{datakegiatan.PrgNm}}</td>
                                        <td width="150">DIBUAT/DIUBAH</td>
                                        <td width="400">{{$date(datauraian.created_at).format('DD/MM/YYYY HH:mm')}} / {{$date(datauraian.updated_at).format('DD/MM/YYYY HH:mm')}}</td>
                                    </tr>
                                </tbody>
                            </table>            
                        </v-card-text>
                    </v-card>                    
                </v-col>
            </v-row>  
            <v-row class="mb-4" no-gutters>
                <v-col cols="12">
                    <v-bottom-navigation color="purple lighten-1">  
                        <v-btn :to="{path:'/belanjamurni/rka/uraian/'+this.RKARincID+'/edit'}">
                            <span>Edit Uraian</span>
                            <v-icon>mdi-pencil</v-icon>
                        </v-btn>                      
                        <v-btn @click.stop="exitrealisasi"> 
                            <span>Keluar</span>
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                    </v-bottom-navigation>
                </v-col>
            </v-row>
            <v-row class="mb-4" no-gutters>
                <v-col cols="12">
                    <v-data-table
                        :headers="headers"
                        :items="datatable"
                        item-key="RKARealisasiRincID"
                        sort-by="bulan1"
                        show-expand
                        :loading="datatableLoading"
                        loading-text="Loading... Please wait"
                        :expanded.sync="expanded"
                        :single-expand="true"
                        class="elevation-1"
                        :disable-pagination="true"
                        :hide-default-footer="true"
                        dense
                        @click:row="dataTableRowClicked"
                    >
                        <template v-slot:top>
                            <v-toolbar flat color="white">
                                <v-toolbar-title>DAFTAR REALISASI</v-toolbar-title>
                                <v-divider
                                    class="mx-4"
                                    inset
                                    vertical
                                ></v-divider>
                                <v-spacer></v-spacer>
                                <v-btn color="primary" dark class="mb-2" @click.stop="tambahRealisasi">TAMBAH REALISASI</v-btn>
                                <v-dialog v-model="dialogfrm" max-width="800px" persistent>
                                    <v-form ref="frmdata" v-model="form_valid" lazy-validation>
                                        <v-card>
                                            <v-card-title>
                                                <span class="headline">TAMBAH DATA REALISASI</span>
                                            </v-card-title>
                                            <v-card-text>
                                                <v-simple-table dense dark>
                                                    <template v-slot:default>
                                                        <tbody>
                                                            <tr>
                                                                <td width="150">ID :</td>
                                                                <td>{{datauraian.RKARincID}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td width="150">NAMA URAIAN :</td>
                                                                <td>{{datauraian.nama_uraian}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td width="150">PAGU URAIAN :</td>
                                                                <td>{{datauraian.PaguUraian1|formatUang}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </template>
                                                </v-simple-table>
                                                <v-container fluid>
                                                    <v-row>
                                                        <v-col cols="12" sm="12" md="12">
                                                            <v-autocomplete 
                                                                :items="daftar_bulan" 
                                                                v-model="bulan1"
                                                                label="BULAN" 
                                                                :rules="rule_bulan">                                        
                                                            </v-autocomplete>  
                                                        </v-col>                                     
                                                        <v-col cols="6" sm="6" md="6">
                                                            <v-currency-field 
                                                                label="SISA PAGU" 
                                                                :min="null"
                                                                :max="null"
                                                                filled
                                                                :disabled="true"
                                                                v-model="formdata.sisapagu">
                                                            >
                                                            </v-currency-field>
                                                        </v-col> 
                                                        <v-col cols="6" sm="6" md="6">
                                                            <v-currency-field 
                                                                label="ANGGARAN KAS" 
                                                                :min="null"
                                                                :max="null"
                                                                filled
                                                                :disabled="true"
                                                                v-model="formdata.anggarankas">
                                                            >
                                                            </v-currency-field>
                                                        </v-col> 
                                                        <v-col cols="6" sm="6" md="6">
                                                            <v-currency-field 
                                                                label="SISA FISIK" 
                                                                :min="null"
                                                                :max="null"
                                                                filled
                                                                :disabled="true"
                                                                v-model="formdata.sisafisik">
                                                            >
                                                            </v-currency-field>
                                                        </v-col> 
                                                        <v-col cols="6" sm="6" md="6">                                                            
                                                            <v-text-field 
                                                                label="TARGET FISIK" 
                                                                type="text"                                                                 
                                                                v-model="formdata.targetfisik"
                                                                filled
                                                                :disabled="true"
                                                            />
                                                        </v-col> 
                                                        <v-col cols="12" sm="12" md="12">
                                                            <v-currency-field 
                                                                label="REALISASI" 
                                                                :min="null"
                                                                :max="null"
                                                                :rules="rule_realisasi"
                                                                filled
                                                                v-model="formdata.realisasi1">
                                                            >
                                                            </v-currency-field>
                                                        </v-col> 
                                                        <v-col cols="12" sm="12" md="12">
                                                            <v-text-field 
                                                                label="FISIK" 
                                                                type="text" 
                                                                filled
                                                                :rules="rule_fisik"
                                                                v-model="formdata.fisik1"
                                                            />
                                                        </v-col> 
                                                        <v-col cols="12" sm="12" md="12">
                                                            <v-textarea                                                                
                                                                label="KETERANGAN"
                                                                filled
                                                                v-model="formdata.Descr">
                                                            ></v-textarea>
                                                        </v-col> 
                                                    </v-row>
                                                </v-container>
                                            </v-card-text>
                                            <v-card-actions>
                                                <v-spacer></v-spacer>
                                                <v-btn color="blue darken-1" text @click="closedialogfrm">BATAL</v-btn>
                                                <v-btn 
                                                    color="blue darken-1" 
                                                    text 
                                                    @click="save" 
                                                    :loading="btnLoading"
                                                    :disabled="!form_valid||btnLoading">SIMPAN</v-btn>
                                            </v-card-actions>
                                        </v-card>
                                    </v-form>
                                </v-dialog>                               
                                <v-dialog v-model="dialogfrmedit" max-width="800px" persistent>
                                    <v-form ref="frmdata" v-model="form_valid" lazy-validation>
                                        <v-card>
                                            <v-card-title>
                                                <span class="headline">UBAH DATA REALISASI</span>
                                            </v-card-title>
                                            <v-card-text>
                                                <v-simple-table dense dark>
                                                    <template v-slot:default>
                                                        <tbody>
                                                            <tr>
                                                                <td width="150">NAMA URAIAN :</td>
                                                                <td>{{datauraian.nama_uraian}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td width="150">PAGU URAIAN :</td>
                                                                <td>{{datauraian.PaguUraian1|formatUang}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </template>
                                                </v-simple-table>
                                                <v-container fluid>
                                                    <v-row>
                                                        <v-col cols="12" sm="12" md="12">
                                                            <v-autocomplete 
                                                                :items="daftar_bulan" 
                                                                v-model="bulan1"
                                                                label="BULAN" 
                                                                :rules="rule_bulan"
                                                                :disabled="true">                                        
                                                            </v-autocomplete>  
                                                        </v-col> 
                                                        <v-col cols="6" sm="6" md="6">
                                                            <v-currency-field 
                                                                label="SISA PAGU" 
                                                                :min="null"
                                                                :max="null"
                                                                filled
                                                                :disabled="true"
                                                                v-model="formdata.sisapagu">
                                                            >
                                                            </v-currency-field>
                                                        </v-col>
                                                        <v-col cols="6" sm="6" md="6">
                                                            <v-currency-field 
                                                                label="ANGGARAN KAS" 
                                                                :min="null"
                                                                :max="null"
                                                                filled
                                                                :disabled="true"
                                                                v-model="formdata.anggarankas">
                                                            >
                                                            </v-currency-field>
                                                        </v-col> 
                                                        <v-col cols="6" sm="6" md="6">
                                                            <v-currency-field 
                                                                label="SISA FISIK" 
                                                                :min="null"
                                                                :max="null"
                                                                filled
                                                                :disabled="true"
                                                                v-model="formdata.sisafisik">
                                                            >
                                                            </v-currency-field>
                                                        </v-col> 
                                                        <v-col cols="6" sm="6" md="6">
                                                            <v-currency-field 
                                                                label="TARGET FISIK" 
                                                                :min="null"
                                                                :max="null"
                                                                filled
                                                                :disabled="true"
                                                                v-model="formdata.targetfisik">
                                                            >
                                                            </v-currency-field>
                                                        </v-col> 
                                                        <v-col cols="12" sm="12" md="12">
                                                            <v-currency-field 
                                                                label="REALISASI" 
                                                                :min="null"
                                                                :max="null"
                                                                :rules="rule_realisasiedit"
                                                                filled
                                                                v-model="formdata.realisasi1">
                                                            >
                                                            </v-currency-field>
                                                        </v-col> 
                                                        <v-col cols="12" sm="12" md="12">
                                                            <v-text-field 
                                                                label="FISIK" 
                                                                type="text" 
                                                                filled
                                                                :rules="rule_fisikedit"
                                                                v-model="formdata.fisik1"
                                                            />
                                                        </v-col> 
                                                        <v-col cols="12" sm="12" md="12">
                                                            <v-textarea                                                                
                                                                label="KETERANGAN"
                                                                filled
                                                                v-model="formdata.Descr">
                                                            ></v-textarea>
                                                        </v-col> 
                                                    </v-row>
                                                </v-container>
                                            </v-card-text>
                                            <v-card-actions>
                                                <v-spacer></v-spacer>
                                                <v-btn color="blue darken-1" text @click.stop="closedialogfrmedit">BATAL</v-btn>
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
                                @click.stop="editItem(item)"
                            >
                                mdi-pencil
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
                        <template v-slot:item.target1="{ item }">                            
                            {{ item.target1|formatUang }}
                        </template>
                        <template v-slot:item.realisasi1="{ item }">                            
                            {{ item.realisasi1|formatUang }}
                        </template>
                        <template v-slot:item.sisa_anggaran="{ item }">                            
                            {{  item.sisa_anggaran|formatUang }}
                        </template>
                        <template v-slot:expanded-item="{ headers, item }">
                            <td :colspan="headers.length" class="text-center">
                                <strong>ID:</strong>{{ item.RKARealisasiRincID }}                                
                                <strong>created_at:</strong>{{ $date(item.created_at).format('DD/MM/YYYY HH:mm') }}
                                <strong>updated_at:</strong>{{ $date(item.created_at).format('DD/MM/YYYY HH:mm') }}
                            </td>
                        </template>
                        <template v-slot:body.append>
                            <tr class="amber darken-1 font-weight-black">
                                <td colspan="2" class="text-right">TOTAL</td>
                                <td class="text-right">{{footers.anggarankas|formatUang}}</td>
                                <td class="text-right">{{footers.realisasi|formatUang}}</td>
                                <td class="text-right">{{footers.targetfisik}}</td>
                                <td class="text-right">{{footers.fisik}}</td>
                                <td class="text-right">{{footers.sisa|formatUang}}</td>
                                <td></td>                                
                            </tr>
                        </template>
                        <template v-slot:no-data>                            
                            data realisasi tidak tersedia.
                        </template>
                    </v-data-table>
                </v-col>
            </v-row>            
        </v-container>
    </BelanjaMurniLayout>
</template>
<script>
import Vue from 'vue'

import BelanjaMurniLayout from '@/views/layouts/BelanjaMurniLayout';
import ModuleHeader from '@/components/ModuleHeader';
export default {
    name:'RealisasiRKAMurni',
    created () 
    {
        this.RKARincID = this.$route.params.rkarincid;    
        var page = this.$store.getters['uiadmin/Page']('rkamurni');
        this.datakegiatan = page.datakegiatan;    
        this.datauraian = page.datauraian;       

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
                text:'URAIAN',
                disabled:false,
                href:'/belanjamurni/rka/uraian/'+page.datakegiatan.RKAID
            },
            {
                text:'REALISASI',
                disabled:true,
                href:'#'
            }
        ];        
        if (Object.keys(this.datakegiatan).length>2&&Object.keys(this.datauraian).length > 2)
        {
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
            this.$router.push('/belanjamurni/rka');
        }
        
    }, 
    data ()
    {
        return {
            //modul
            RKARincID:'',
            btnLoading:false,
            datakegiatan: [],
            datauraian: [],
            datatableLoading:false,
            datatableLoaded:false,
            expanded:[],
            datatable:[],
            headers: [                        
                { text: 'BULAN', value: 'NamaBulan',width:70},   
                { text: 'ANGGARAN KAS', align:'end', value: 'target1',width:100},                   
                { text: 'REALISASI/SP2D', align:'end', value: 'realisasi1',width:100},                   
                { text: 'TARGET FISIK', align:'end',value: 'target_fisik1',width:100},   
                { text: 'FISIK (%)', align:'end',value: 'fisik1',width:100},                   
                { text: 'SISA ANGGARAN', align:'end',value: 'sisa_anggaran',width:100},    
                { text: 'AKSI', value: 'actions', sortable: false,width:100 },
            ],
            footers :{ 
                anggarankas:0,
                realisasi:0,
                sisa:0,
                persen_sisa:0,
                targetfisik:0,
                fisik:0
            },
            //dialog
            dialogfrm:false,
            dialogfrmedit:false,
            dialogdetailitem:false,

            //form data               
            form_valid:true, 
            daftar_bulan:[],
            bulan1:null,                        
            formdata: {
                RKARealisasiRincID:'',
                anggarankas:0,                        
                targetfisik:0,   
                sisapagu:0,                                                         
                sisafisik:0,                                             
                realisasi1:0,                        
                fisik1:0,      
                Descr:'',                  
                created_at: '',           
                updated_at: '',           

            },
            formdefault: {        
                RKARealisasiRincID:'',                
                anggarankas:0,                                                         
                targetfisik:0,                        
                sisapagu:0,                                                         
                sisafisik:0,                        
                realisasi1:0,                        
                fisik1:0,      
                Descr:'',                  
                created_at: '',           
                updated_at: '',       
            },
            editedIndex: -1,

            //form rules  
            rule_bulan:[
                value => !!value||"Mohon untuk di pilih bulan realisasi !!!",  
            ], 
            rule_user_password:[            
                value => {
                    if (value && typeof value !== 'undefined' && value.length > 0){
                        return !!value||"Mohon untuk di isi password User !!!";
                    }
                    else
                    {
                        return true;
                    }
                }
            ],
            rule_realisasi:[
                value => {
                    if (value.length > 0)
                    {
                        let PaguUraian1 = parseFloat(this.datauraian.PaguUraian1);
                        let sisapagu = parseFloat(this.formdata.sisapagu);
                        let realisasi1 = parseFloat(value.replace(/[^0-9.-]+/g,""));
                        return realisasi1 <= sisapagu || 'Jumlah realisasi keuangan telah melampaui pagu uraian ('+Vue.filter('formatUang')(PaguUraian1)+')';                    
                    }
                    else
                    {
                        return true;
                    }
                }
            ],
            rule_realisasiedit:[
                value => {
                    if (value.length > 0)
                    {
                        let PaguUraian1 = parseFloat(this.datauraian.PaguUraian1);
                        let sisapagu = parseFloat(this.formdata.sisapagu);
                        let realisasi1 = parseFloat(value.replace(/[^0-9.-]+/g,""));
                        return realisasi1 <= sisapagu || 'Jumlah realisasi keuangan telah melampaui pagu uraian ('+Vue.filter('formatUang')(PaguUraian1)+')';                    
                    }
                    else
                    {
                        return true;
                    }
                }
            ],
            rule_fisik:[
                value => /^(100(\.0{1,2})?|[1-9]?\d(\.\d{1,2})?)$/.test(value) || 'Isi dengan nilai persentase 0.00 s.d 100.00', 
                value => {
                    var fisik = parseFloat(value);
                    var sisafisik = parseFloat(this.formdata.sisafisik);
                    return fisik <= sisafisik  || 'Jumlah realisasi fisik telah melampau 100%, mohon dikurangi !!!';
                }
            ],
            rule_fisikedit:[
                value => /^(100(\.0{1,2})?|[1-9]?\d(\.\d{1,2})?)$/.test(value) || 'Isi dengan nilai persentase 0.00 s.d 100.00', 
                value => {
                    var fisik = parseFloat(value);
                    var sisafisik = parseFloat(this.formdata.sisafisik);
                    return fisik <= sisafisik  || 'Jumlah realisasi fisik telah melampau 100%, mohon dikurangi !!!';
                }
            ],
        }
    },
    methods: {
        initialize:async function  () 
        {
            this.datatableLoading=true;   
            
            this.$ajax.post('/belanja/rkamurni/realisasi',
                {
                    RKARincID:this.datauraian.RKARincID,                       
                },
                {
                    headers:{
                        Authorization:this.$store.getters['auth/Token']
                    }
                }
            ).then(({data})=>{                   
                this.datatable = data.realisasi;
                this.footers.anggarankas=data.totalanggarankas;
                this.footers.realisasi=data.totalrealisasi;
                this.footers.sisa=data.sisa_anggaran;
                this.footers.targetfisik=data.totaltargetfisik;
                this.footers.fisik=data.totalfisik;
                this.datatableLoading=false;
            }).catch(()=>{
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
        tambahRealisasi: async function ()
        {
            await this.$ajax.get('/belanja/rkamurni/bulanrealisasi/'+this.datauraian.RKARincID,               
                {
                    headers:{
                        Authorization:this.$store.getters['auth/Token']
                    }
                }
            ).then(({data})=>{   
                let daftarbulan = data.bulan;
                var bulan=[];
                var index = 0;
                for (var i in daftarbulan)
                {
                    bulan[index]=daftarbulan[i];
                    index+=1;
                }
                this.daftar_bulan = bulan;
            });   
            this.dialogfrm = true;
        },
        save () {
            if (this.$refs.frmdata.validate())
            {
                this.btnLoading=true;
                if (this.editedIndex > -1) 
                {
                    this.$ajax.post('/belanja/rkamurni/updaterealisasi/'+this.formdata.RKARealisasiRincID,
                        {
                            _method:'put',
                            target1:this.formdata.anggarankas, 
                            realisasi1:this.formdata.realisasi1, 
                            target_fisik1:this.formdata.targetfisik,                           
                            fisik1:this.formdata.fisik1,                            
                            Descr:this.formdata.Descr,                            
                        },
                        {
                            headers:{
                                Authorization:this.$store.getters['auth/Token']
                            }
                        }
                    ).then(()=>{   
                        this.initialize();
                        this.closedialogfrmedit();
                    }).catch(()=>{
                        this.btnLoading=false;
                    });
                } else {
                    this.$ajax.post('/belanja/rkamurni/saverealisasi',
                        {
                            RKARincID:this.datauraian.RKARincID,
                            RKAID:this.datakegiatan.RKAID,
                            bulan1:this.bulan1,                            
                            target1:this.formdata.anggarankas, 
                            realisasi1:this.formdata.realisasi1, 
                            target_fisik1:this.formdata.targetfisik,                           
                            fisik1:this.formdata.fisik1,                            
                            TA:this.datakegiatan.TA,                            
                            Descr:this.formdata.Descr,                            
                        },
                        {
                            headers:{
                                Authorization:this.$store.getters['auth/Token']
                            }
                        }
                    ).then(()=>{   
                        this.initialize();
                        this.closedialogfrm();
                    }).catch(()=>{
                        this.btnLoading=false;
                    });
                }
            }
        },
        editItem: async function (item) {                  
            this.editedIndex = this.datatable.indexOf(item);
            this.daftar_bulan = this.$store.getters['uifront/getDaftarBulan'];                        
            this.bulan1=item.bulan1;
            await this.$ajax.post('/belanja/rkamurni/rencanatarget',
                {
                    'mode':'bulan',
                    'RKARincID':this.datauraian.RKARincID,
                    'bulan1':item.bulan1,
                },
                {
                    headers:{
                        Authorization:this.$store.getters['auth/Token']
                    }
                }
            ).then(({data})=>{      
                this.formdata.RKARealisasiRincID=item.RKARealisasiRincID;
                this.formdata.targetfisik = data.target.fisik;
                this.formdata.anggarankas = data.target.anggaran;
                
                let sisapagu = parseFloat(this.datauraian.PaguUraian1)-parseFloat(data.datarealisasi.jumlah_realisasi);
                this.formdata.sisapagu = sisapagu + parseFloat(item.realisasi1);
                let sisafisik=100-(new Number(data.datarealisasi.jumlah_fisik));
                this.formdata.sisafisik = sisafisik + parseFloat(item.fisik1);

                this.formdata.realisasi1 = item.realisasi1;
                this.formdata.fisik1 = item.fisik1;
                this.formdata.Descr = item.Descr;

            });  
                
            this.dialogfrmedit=true;
        },     
        deleteItem (item) {                       
            this.$root.$confirm.open('Delete', 'Apakah Anda ingin menghapus realisasi dengan ID '+item.RKARealisasiRincID+' ?', { color: 'red' }).then((confirm) => {
                if (confirm)
                {
                    this.btnLoading=true;
                    this.$ajax.post('/belanja/rkamurni/deleterealisasi/'+item.RKARealisasiRincID,
                        {
                            '_method':'DELETE',
                            'pid':'datarealisasi'
                        },
                        {
                            headers:{
                                Authorization:this.$store.getters['auth/Token']
                            }
                        }
                    ).then(()=>{   
                        this.initialize();    
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
            this.bulan1=null;            
            setTimeout(() => {
                this.$refs.frmdata.reset(); 
                this.formdata = Object.assign({}, this.formdefault);                
                this.editedIndex = -1;                
                }, 300
            );
        },
        closedialogfrmedit () {
            this.btnLoading=false;
            this.dialogfrmedit = false;
            this.bulan1=null;            
            setTimeout(() => {
                this.$refs.frmdata.reset(); 
                this.formdata = Object.assign({}, this.formdefault);                
                this.editedIndex = -1;                
                }, 300
            );
        },
        exitrealisasi ()
        {
            this.btnLoading=false;
            var page = this.$store.getters['uiadmin/Page']('rkamurni');
            page.datauraian ={
                RKARincID:'',
            };
            page.datarekening ={};
            this.$store.dispatch('uiadmin/updatePage',page);
            this.$router.push('/belanjamurni/rka/uraian/'+page.datakegiatan.RKAID);
        }
    },
    watch : {
       bulan1: async function (val)
       {
           if (val !== null && this.editedIndex == -1 && typeof val !=='undefined')
           {
                await this.$ajax.post('/belanja/rkamurni/rencanatarget',
                {
                    'mode':'bulan',
                    'RKARincID':this.datauraian.RKARincID,
                    'bulan1':this.bulan1,
                },
                {
                    headers:{
                        Authorization:this.$store.getters['auth/Token']
                    }
                }
            ).then(({data})=>{      
                this.formdata.targetfisik = data.target.fisik;
                this.formdata.anggarankas = data.target.anggaran;

                this.formdata.sisapagu = (new Number(this.datauraian.PaguUraian1))-(new Number(data.datarealisasi.jumlah_realisasi));
                this.formdata.sisafisik = 100-(new Number(data.datarealisasi.jumlah_fisik));
            });  
           }
       }
    },
    components:{
        BelanjaMurniLayout,
        ModuleHeader,
    },
}
</script>