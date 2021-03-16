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
                    Uraian Rencana Kegiatan dan Anggaran (RKA) OPD / Unit Kerja APBD Perubahan
                </v-alert>
            </template>
        </ModuleHeader>
        <v-container v-if="Object.keys(datakegiatan).length > 1"> 
            <v-row class="mb-4" no-gutters>
                <v-col cols="12">
                    <v-card>
                        <v-card-title>
                            DATA KEGIATAN
                        </v-card-title>
                        <v-card-text>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td width="150"><strong>RKAID</strong></td>
                                        <td width="400">{{datakegiatan.RKAID}}</td>
                                        <td width="150"><strong>NAMA URUSAN</strong></td>
                                        <td width="400">{{datakegiatan.Nm_Bidang}}</td> 
                                    </tr>
                                    <tr>
                                        <td width="150"><strong>RKAID Murni</strong></td>
                                        <td width="400"><v-chip color="blue" text-color="white">{{datakegiatan.RKAID_Src==null?'BELUM DISALIN':datakegiatan.RKAID_Src}}</v-chip></td>
                                        <td width="150"><strong>KODE OPD / SKPD</strong></td>
                                        <td width="400">{{datakegiatan.kode_organisasi}}</td>                                                                      
                                    </tr>
                                    <tr>
                                        <td width="150"><strong>KODE PROGRAM</strong></td>
                                        <td width="400">{{datakegiatan.kode_program}}</td>
                                        <td width="150"><strong>OPD / SKPD</strong></td>
                                        <td width="400">{{datakegiatan.OrgNm}}</td>
                                    </tr>
                                    <tr>
                                        <td width="150"><strong>PROGRAM</strong></td>
                                        <td width="400">{{datakegiatan.PrgNm}}</td>                                                                       
                                        <td width="150"><strong>KODE UNIT KERJA</strong></td>
                                        <td width="400">{{datakegiatan.kode_suborganisasi}}</td>                                                                      
                                    </tr>                            
                                    <tr>
                                        <td width="150"><strong>KODE KEGIATAN</strong></td>
                                        <td width="400">{{datakegiatan.kode_kegiatan}}</td>   
                                        <td width="150"><strong>UNIT KERJA</strong></td>
                                        <td width="400">{{datakegiatan.SOrgNm}}</td>                                                                      
                                    </tr>
                                    <tr>
                                        <td width="150"><strong>NAMA KEGIATAN</strong></td>
                                        <td width="400">{{datakegiatan.KgtNm}}</td>
                                        <td width="150"><strong>DIBUAT</strong></td>
                                        <td width="400">{{$date(datakegiatan.created_at).format('DD/MM/YYYY HH:mm')}}</td>
                                    </tr>
                                    <tr>
                                        <td width="150"><strong>PAGU DANA</strong></td>
                                        <td width="400">{{datakegiatan.PaguDana2|formatUang}}</td>
                                        <td width="150"><strong>DIUBAH</strong></td>
                                        <td width="400">{{$date(datakegiatan.updated_at).format('DD/MM/YYYY HH:mm')}}</td>
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
                        <v-btn :to="{path:'/belanjaperubahan/rka/'+RKAID+'/edit'}">
                            <span>Edit RKA</span>
                            <v-icon>mdi-pencil</v-icon>
                        </v-btn>
                        <v-btn @click.stop="showdialogtargetfisik" :disabled="btnLoading">
                            <span>Target Fisik</span>
                            <v-icon>mdi-history</v-icon>
                        </v-btn>
                        <v-btn @click.stop="showdialogtargetanggkarankas" :disabled="btnLoading">
                            <span>Target Anggaran Kas</span>
                            <v-icon>mdi-history</v-icon>
                        </v-btn>
                        <v-btn @click.stop="exituraianrka"> 
                            <span>Keluar</span>
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                    </v-bottom-navigation>
                </v-col>
            </v-row>
             <v-row class="mb-4" no-gutters>
                <v-col cols="12">
                    <v-dialog v-model="dialogedituraian" max-width="800px" persistent> 
                        <v-form ref="frmedituraian" v-model="form_valid" lazy-validation>
                            <v-card>
                                <v-card-title>
                                    <span class="headline">UBAH URAIAN</span>
                                </v-card-title>
                                <v-card-text>
                                    <v-container fluid>
                                        <v-row>
                                            <v-col cols="12" sm="12" md="12">
                                                <v-text-field 
                                                    label="KODE URAIAN" 
                                                    type="text" 
                                                    :value="formuraian.kode_uraian"
                                                    :disabled="true"
                                                />
                                            </v-col> 
                                            <v-col cols="12" sm="12" md="12">
                                                <v-text-field 
                                                    label="NAMA URAIAN" 
                                                    type="text" 
                                                    :value="formuraian.nama_uraian"
                                                    :disabled="true"
                                                />
                                            </v-col> 
                                            <v-col cols="6" sm="6" md="6">
                                                <v-text-field 
                                                    label="VOLUME" 
                                                    type="text" 
                                                    filled
                                                    :rules="rule_volume"
                                                    :value="formuraian.volume2"
                                                />
                                            </v-col> 
                                            <v-col cols="6" sm="6" md="6">
                                                <v-text-field 
                                                    label="SATUAN" 
                                                    type="text" 
                                                    filled
                                                    :rules="rule_satuan"
                                                    :value="formuraian.satuan2"
                                                />
                                            </v-col> 
                                            <v-col cols="6" sm="6" md="6">
                                                <v-currency-field 
                                                    label="HARGA PER SATUAN" 
                                                    :min="null"
                                                    :max="null"
                                                    filled
                                                    v-model="formuraian.harga_satuan2"
                                                >
                                                </v-currency-field>
                                            </v-col>  
                                            <v-col cols="6" sm="6" md="6">
                                                <v-currency-field 
                                                    label="PAGU URAIAN (VOLUME * HARGA PER SATUAN)" 
                                                    :min="null"
                                                    :max="null"
                                                    filled
                                                    v-model="formuraian.PaguUraian2"
                                                >
                                                </v-currency-field>
                                            </v-col>  
                                            <v-col cols="12" sm="12" md="12">
                                                <v-autocomplete 
                                                    :items="daftar_jenispelaksanaan" 
                                                    v-model="formuraian.JenisPelaksanaanID"
                                                    label="JENIS PELAKSANAAN"                                                     
                                                    item-text="NamaJenis" 
                                                    item-value="JenisPelaksanaanID">                                        
                                                </v-autocomplete>  
                                            </v-col>
                                        </v-row>
                                    </v-container>
                                </v-card-text>
                                <v-card-actions>                                    
                                    <v-spacer></v-spacer>
                                    <v-btn color="blue darken-1" text @click.stop="closedialogedituraian">BATAL</v-btn>
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
                    </v-dialog>
                    <v-dialog v-model="dialogtargetfisik" max-width="800px" v-if="dialogtargetfisik" persistent> 
                        <v-form ref="frmtargetfisik" v-model="form_valid" lazy-validation>
                            <v-card>
                                <v-card-title>
                                    <span class="headline">TARGET FISIK</span>
                                </v-card-title>
                                <v-card-text>
                                    <v-container fluid>
                                        <v-row>
                                            <v-col cols="12" sm="12" md="12">
                                                <v-autocomplete 
                                                    :items="daftar_uraian" 
                                                    v-model="RKARincID_Selected"
                                                    label="URAIAN KEGIATAN" 
                                                    :rules="rule_rkarinc">                                        
                                                </v-autocomplete>  
                                            </v-col>   
                                            <v-col cols="12" sm="12" md="12" v-if="datakegiatan_murni.Locked && daftar_uraian.length > 0">
                                                Salin seluruh data target fisik dan anggaran kas dari kegiatan murni <strong>"[{{datakegiatan_murni.kode_kegiatan}}] {{datakegiatan_murni.KgtNm}}"</strong>                                                
                                                <v-btn 
                                                    color="blue darken-1" 
                                                    text                                                     
                                                    :loading="btnLoading"                                        
                                                    @click.stop="copytarget" 
                                                    :disabled="btnLoading">
                                                        SALIN TARGET
                                                        <v-icon>
                                                            mdi-content-copy
                                                        </v-icon>
                                                </v-btn>
                                            </v-col>
                                            <v-col cols="12" sm="12" md="12">
                                                <v-text-field 
                                                    label="Januari" 
                                                    type="text" 
                                                    :rules="rule_angka"
                                                    v-model="formtarget.targetfisik[0]"
                                                    filled
                                                />
                                            </v-col>                                    
                                            <v-col cols="12" sm="12" md="12">
                                                <v-text-field 
                                                    label="Februari" 
                                                    type="text" 
                                                    :rules="rule_angka"
                                                    v-model="formtarget.targetfisik[1]"
                                                    filled
                                                />
                                            </v-col>                                    
                                            <v-col cols="12" sm="12" md="12">
                                                <v-text-field 
                                                    label="Maret" 
                                                    type="text" 
                                                    :rules="rule_angka"
                                                    v-model="formtarget.targetfisik[2]"
                                                    filled
                                                />
                                            </v-col>                                    
                                            <v-col cols="12" sm="12" md="12">
                                                <v-text-field 
                                                    label="April" 
                                                    type="text" 
                                                    :rules="rule_angka"
                                                    v-model="formtarget.targetfisik[3]"
                                                    filled
                                                />
                                            </v-col>                                    
                                            <v-col cols="12" sm="12" md="12">
                                                <v-text-field 
                                                    label="Mei" 
                                                    type="text" 
                                                    :rules="rule_angka"
                                                    v-model="formtarget.targetfisik[4]"
                                                    filled
                                                />
                                            </v-col>                                    
                                            <v-col cols="12" sm="12" md="12">
                                                <v-text-field 
                                                    label="Juni" 
                                                    type="text" 
                                                    :rules="rule_angka"
                                                    v-model="formtarget.targetfisik[5]"
                                                    filled
                                                />
                                            </v-col>                                    
                                            <v-col cols="12" sm="12" md="12">
                                                <v-text-field 
                                                    label="Juli" 
                                                    type="text" 
                                                    :rules="rule_angka"
                                                    v-model="formtarget.targetfisik[6]"
                                                    filled
                                                />
                                            </v-col>                                    
                                            <v-col cols="12" sm="12" md="12">
                                                <v-text-field 
                                                    label="Agustus" 
                                                    type="text" 
                                                    :rules="rule_angka"
                                                    v-model="formtarget.targetfisik[7]"
                                                    filled
                                                />
                                            </v-col>                                    
                                            <v-col cols="12" sm="12" md="12">
                                                <v-text-field 
                                                    label="September" 
                                                    type="text" 
                                                    :rules="rule_angka"
                                                    v-model="formtarget.targetfisik[8]"
                                                    filled
                                                />
                                            </v-col>                                    
                                            <v-col cols="12" sm="12" md="12">
                                                <v-text-field 
                                                    label="Oktober" 
                                                    type="text" 
                                                    :rules="rule_angka"
                                                    v-model="formtarget.targetfisik[9]"
                                                    filled
                                                />
                                            </v-col>                                    
                                            <v-col cols="12" sm="12" md="12">
                                                <v-text-field 
                                                    label="November" 
                                                    type="text" 
                                                    :rules="rule_angka"
                                                    v-model="formtarget.targetfisik[10]"
                                                    filled
                                                />
                                            </v-col>                                                                                 
                                            <v-col cols="12" sm="12" md="12">
                                                <v-text-field 
                                                    label="Desember" 
                                                    type="text" 
                                                    :rules="rule_angka"
                                                    v-model="formtarget.targetfisik[11]"
                                                    filled
                                                />
                                            </v-col>                           
                                            <v-col cols="12" sm="12" md="12">
                                                <v-text-field 
                                                    label="Total" 
                                                    type="text" 
                                                    :rules="rule_totalfisik"
                                                    :readonly="true"
                                                    v-model="totalTargetFisik"
                                                    filled
                                                />
                                            </v-col> 
                                        </v-row>
                                    </v-container>
                                </v-card-text>
                                <v-card-actions>                                    
                                    <v-spacer></v-spacer>
                                    <v-btn color="blue darken-1" text @click.stop="closedialogtargetfisik">BATAL</v-btn>
                                    <v-btn 
                                        color="blue darken-1" 
                                        text 
                                        :loading="btnLoading"                                        
                                        @click.stop="savetargetfisik" 
                                        :disabled="!form_valid||btnLoading">
                                            SIMPAN
                                    </v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-form>
                    </v-dialog>
                    <v-dialog v-model="dialogtargetanggarankas" max-width="800px" v-if="dialogtargetanggarankas" persistent> 
                        <v-form ref="frmtargetanggarankas" v-model="form_valid" lazy-validation>
                            <v-card>
                                <v-card-title>
                                    <span class="headline">TARGET ANGGARAN KAS</span>
                                </v-card-title>
                                <v-card-text>
                                    <v-container fluid>
                                        <v-row>
                                            <v-col cols="12" sm="12" md="12">
                                                <v-autocomplete 
                                                    :items="daftar_uraian" 
                                                    v-model="RKARincID_Selected"
                                                    label="URAIAN KEGIATAN" 
                                                    :rules="rule_rkarinc">                                        
                                                </v-autocomplete>  
                                                <span class="deep-purple--text">Pagu Uraian : {{formtarget.paguuraian2|formatUang}}</span>
                                            </v-col>      
                                            <v-col cols="12" sm="12" md="12" v-if="datakegiatan_murni.Locked && daftar_uraian.length > 0">
                                                Salin seluruh data target fisik dan anggaran kas dari kegiatan murni <strong>"[{{datakegiatan_murni.kode_kegiatan}}] {{datakegiatan_murni.KgtNm}}"</strong>                                                
                                                <v-btn 
                                                    color="blue darken-1" 
                                                    text                                                     
                                                    :loading="btnLoading"                                        
                                                    @click.stop="copytarget" 
                                                    :disabled="btnLoading">
                                                        SALIN TARGET
                                                        <v-icon>
                                                            mdi-content-copy
                                                        </v-icon>
                                                </v-btn>
                                            </v-col>                                                                 
                                            <v-col cols="12" sm="12" md="12">
                                                <v-currency-field 
                                                    label="Januari" 
                                                    :min="null"
                                                    :max="null"
                                                    filled
                                                    v-model="formtarget.targetanggarankas[0]"
                                                >
                                                </v-currency-field>
                                            </v-col>    
                                            <v-col cols="12" sm="12" md="12">
                                                <v-currency-field 
                                                    label="Februari" 
                                                    :min="null"
                                                    :max="null"
                                                    filled
                                                    v-model="formtarget.targetanggarankas[1]"
                                                >
                                                </v-currency-field>
                                            </v-col>    
                                            <v-col cols="12" sm="12" md="12">
                                                <v-currency-field 
                                                    label="Maret" 
                                                    :min="null"
                                                    :max="null"
                                                    filled
                                                    v-model="formtarget.targetanggarankas[2]"
                                                >
                                                </v-currency-field>
                                            </v-col>    
                                            <v-col cols="12" sm="12" md="12">
                                                <v-currency-field 
                                                    label="April" 
                                                    :min="null"
                                                    :max="null"
                                                    filled
                                                    v-model="formtarget.targetanggarankas[3]"
                                                >
                                                </v-currency-field>
                                            </v-col>    
                                            <v-col cols="12" sm="12" md="12">
                                                <v-currency-field 
                                                    label="Mei" 
                                                    :min="null"
                                                    :max="null"
                                                    filled
                                                    v-model="formtarget.targetanggarankas[4]"
                                                >
                                                </v-currency-field>
                                            </v-col>    
                                            <v-col cols="12" sm="12" md="12">
                                                <v-currency-field 
                                                    label="Juni" 
                                                    :min="null"
                                                    :max="null"
                                                    filled
                                                    v-model="formtarget.targetanggarankas[5]"
                                                >
                                                </v-currency-field>
                                            </v-col>    
                                            <v-col cols="12" sm="12" md="12">
                                                <v-currency-field 
                                                    label="Juli" 
                                                    :min="null"
                                                    :max="null"
                                                    filled
                                                    v-model="formtarget.targetanggarankas[6]"
                                                >
                                                </v-currency-field>
                                            </v-col>    
                                            <v-col cols="12" sm="12" md="12">
                                                <v-currency-field 
                                                    label="Agustus" 
                                                    :min="null"
                                                    :max="null"
                                                    filled
                                                    v-model="formtarget.targetanggarankas[7]"
                                                >
                                                </v-currency-field>
                                            </v-col>    
                                            <v-col cols="12" sm="12" md="12">
                                                <v-currency-field 
                                                    label="September" 
                                                    :min="null"
                                                    :max="null"
                                                    filled
                                                    v-model="formtarget.targetanggarankas[8]"
                                                >
                                                </v-currency-field>
                                            </v-col>    
                                            <v-col cols="12" sm="12" md="12">
                                                <v-currency-field 
                                                    label="Oktober" 
                                                    :min="null"
                                                    :max="null"
                                                    filled
                                                    v-model="formtarget.targetanggarankas[9]"
                                                >
                                                </v-currency-field>
                                            </v-col>    
                                            <v-col cols="12" sm="12" md="12">
                                                <v-currency-field 
                                                    label="November" 
                                                    :min="null"
                                                    :max="null"
                                                    filled
                                                    v-model="formtarget.targetanggarankas[10]"
                                                >
                                                </v-currency-field>
                                            </v-col>    
                                            <v-col cols="12" sm="12" md="12">
                                                <v-currency-field 
                                                    label="Desember" 
                                                    :min="null"
                                                    :max="null"
                                                    filled
                                                    v-model="formtarget.targetanggarankas[11]"
                                                >
                                                </v-currency-field>
                                            </v-col>    
                                            <v-col cols="12" sm="12" md="12">
                                                <v-currency-field 
                                                    label="Total Isian Anggaran" 
                                                    :rules="rule_totalanggarankas"
                                                    :readonly="true"
                                                    filled
                                                    v-model="totalTargetAnggaranKas"
                                                >
                                                </v-currency-field>
                                                <span class="deep-purple--text">Pagu Uraian : {{formtarget.paguuraian2|formatUang}}</span>
                                            </v-col>    
                                        </v-row>
                                    </v-container>
                                </v-card-text>
                                <v-card-actions>                                    
                                    <v-spacer></v-spacer>
                                    <v-btn color="blue darken-1" text @click.stop="closedialogtargetanggarankas">BATAL</v-btn>
                                    <v-btn 
                                        color="blue darken-1" 
                                        text 
                                        :loading="btnLoading"
                                        @click.stop="savetargetanggarankas" 
                                        :disabled="!form_valid||btnLoading">
                                            SIMPAN
                                    </v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-form>
                    </v-dialog>
                    <v-data-table
                        :headers="headers"
                        :items="datatable"
                        :search="search"
                        item-key="RKARincID"
                        sort-by="kode_uraian"
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
                                <v-toolbar-title>DAFTAR URAIAN</v-toolbar-title>
                                <v-divider
                                    class="mx-4"
                                    inset
                                    vertical
                                ></v-divider>
                                <v-spacer></v-spacer>                                
                            </v-toolbar>
                        </template>                        
                        <template v-slot:item.PaguUraian2="{ item }">                            
                            {{ item.PaguUraian2|formatUang }}
                        </template>
                        <template v-slot:item.fisik2="{ item }">                            
                            {{ item.fisik2|makeLookPrecision }}
                        </template>
                        <template v-slot:item.realisasi2="{ item }">                            
                            {{ item.realisasi2|formatUang }}
                        </template>
                        <template v-slot:item.persen_keuangan2="{ item }">                            
                            {{ item.persen_keuangan2|makeLookPrecision }}
                        </template>
                        <template v-slot:item.sisa="{ item }">                            
                            {{  (item.PaguUraian2-item.realisasi2)|formatUang }}
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
                        <template v-slot:body.append>
                            <tr class="amber darken-1 font-weight-black">
                                <td colspan="3" class="text-right">TOTAL</td>
                                <td class="text-right">{{footers.paguuraian|formatUang}}</td>
                                <td class="text-right">{{footers.fisik|makeLookPrecision}}</td>
                                <td class="text-right">{{footers.realisasi|formatUang}}</td>                                
                                <td class="text-right">{{footers.persen_keuangan.toFixed(2)}}</td>
                                <td class="text-right">{{footers.sisa|formatUang}}</td>   
                                <td></td>                                                             
                            </tr>
                        </template>
                        <template v-slot:expanded-item="{ headers, item }">
                            <td :colspan="headers.length" class="text-center">
                                <strong>ID:</strong>{{ item.RKARincID }}
                                <strong>VOLUME:</strong>{{ item.volume }}
                                <strong>HARGA SATUAN:</strong>{{ item.harga_satuan2|formatUang }}
                                <strong>created_at:</strong>{{ $date(item.created_at).format('DD/MM/YYYY HH:mm') }}
                                <strong>updated_at:</strong>{{ $date(item.created_at).format('DD/MM/YYYY HH:mm') }}
                            </td>
                        </template>                       
                        <template v-slot:no-data>                                                        
                            <v-btn
                                class="ma-2"
                                :loading="btnLoading"
                                :disabled="showBtnLoadDataUraian || btnLoading"
                                color="primary"             
                                @click.stop="loaddatauraianfirsttime"                   
                                >
                                    LOAD DATA URAIAN
                                <template v-slot:loader>
                                    <span>LOADING DATA ...</span>
                                </template>
                            </v-btn>
                        </template>
                    </v-data-table>
                </v-col>
             </v-row>             
            <router-view></router-view>
        </v-container>
    </BelanjaPerubahanLayout>
</template>
<script>
import Vue from 'vue';
import BelanjaPerubahanLayout from '@/views/layouts/BelanjaPerubahanLayout';
import ModuleHeader from '@/components/ModuleHeader';
export default {
    name: 'UraianRKAPerubahan',
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
                text:'URAIAN',
                disabled:true,
                href:'#'
            }
        ];
        this.RKAID = this.$route.params.rkaid;  
        var page = this.$store.getters["uiadmin/Page"]('rkaperubahan');
        this.datakegiatan = page.datakegiatan;   
        if (Object.keys(this.datakegiatan).length > 1)
        {
            this.initialize();
        }  
        else
        {
            this.exituraianrka();
        }      
    },     
    data()
    {
        return {
            //modul
            RKAID: "",
            datakegiatan: [],
            datakegiatan_murni:{
                Locked:null
            },
            btnLoading:false,
            datatableLoading:false,
            datatableLoaded:false,
            expanded:[],
            datatable:[],
            headers: [                        
                { text: 'KODE', value: 'kode_uraian',width:100},   
                { text: 'NAMA PAKET PEKERJAAN', value: 'nama_uraian',width:300},                   
                { text: 'PAGU URAIAN', align:'end',value: 'PaguUraian2',width:100},   
                { text: 'REALISASI FISIK (%)', align:'end',value: 'fisik2',width:100},   
                { text: 'REALISASI KEUANGAN', align:'end',value: 'realisasi2',width:100},                   
                { text: '%', align:'end',value: 'persen_keuangan2',width:100},                   
                { text: 'SISA PAGU', align:'end',value: 'sisa',width:100},    
                { text: 'AKSI', value: 'actions', sortable: false,width:80 },
            ],
            footers :{ 
                paguuraian:0,
                realisasi:0,
                sisa:0,
                persen_keuangan:0,
                fisik:0
            },
            search:'',    

            //dialog
            dialogedituraian:false,
            dialogtargetfisik:false,
            dialogtargetanggarankas:false,
            dialogdetailitem:false,

            //form data   
            form_valid:true,         
            RKARincID_Selected:null,
            daftar_jenispelaksanaan:[],
            formuraian: {
                RKARincID:'',  
                kode_uraian: '',
                nama_uraian: '',
                volume: '',
                volume2: '',
                satuan2: '',
                harga_satuan2: 0,
                PaguUraian2: 0,
                realisasi2: 0,
                fisik2: 0,
                JenisPelaksanaanID:'',
                created_at: '',
                updated_at: '',              
            },
            formuraiandefault: {
                RKARincID:'',  
                kode_uraian: '',
                nama_uraian: '',
                volume: '',
                volume2: '',
                satuan2: '',
                harga_satuan2: 0,
                PaguUraian2: 0,
                realisasi2: 0,
                fisik2: 0,
                JenisPelaksanaanID:'',
                created_at: '',
                updated_at: '',              
            },
            formtarget: {
                paguuraian2:0,
                targetfisik:[0,0,0,0,0,0,0,0,0,0,0,0],
                targetanggarankas:[0,0,0,0,0,0,0,0,0,0,0,0],     
                created_at: '',           
                updated_at: '',     
            },
            formtargetdefault: {
                paguuraian2:0,
                targetfisik:[0,0,0,0,0,0,0,0,0,0,0,0],
                targetanggarankas:[0,0,0,0,0,0,0,0,0,0,0,0],                                
                created_at: '',           
                updated_at: '',       
            },
            editedIndex: -1,

            //form rules  
            rule_volume:[
                value => !!value||"Mohon untuk di isi Volume kegiatan !!!",  
                value => /^[0-9]+$/.test(value) || 'Volume kegiatan hanya boleh angka',                
            ],
            rule_satuan:[
                value => !!value||"Mohon untuk di isi Satuab Uraian !!!",  
            ], 
            rule_rkarinc:[
                value => !!value||"Mohon untuk dipilih Uraian Kegiatan !!!",  
            ], 
            rule_angka:[
                value => /^(100(\.0{1,2})?|[1-9]?\d(\.\d{1,2})?)$/.test(value) || 'Isi dengan nilai persentase 0.00 s.d 100.00', 
            ],
            rule_totalfisik:[
                value => new Number(value) == 100 ||"Total Target Fisik harus sama dengan 100% !!!",  
            ], 
            rule_totalanggarankas:[
                value => {                    
                    if (typeof value !== 'undefined' && value.length > 0) 
                    {
                        let pagu_uraian = new Number (this.formtarget.paguuraian2);
                        let nilai_total = parseFloat(value.replace(/[^0-9.-]+/g,""));
                        return nilai_total == pagu_uraian ||"Total Target Anggaran Kas harus sama dengan Pagu Uraian ("+Vue.filter('formatUang')(pagu_uraian)+")";                    
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
            this.datatableLoading = true;
            await this.$ajax.get('/belanja/rkaperubahan/'+this.datakegiatan.RKAID,                
                {
                    headers:{
                        Authorization: this.$store.getters["auth/Token"]
                    }
                }
            ).then(({data})=>{                
                this.datatable = data.uraian;
                this.datatableLoaded=true;
                this.datatableLoading = false;
                this.footersummary();
            }).catch(()=>{
                this.datatableLoaded=true;
                this.datatableLoading = false;
            });   
            
        },
        loaddatauraianfirsttime:async function ()
        {
            this.btnLoading = true;
            await this.$ajax.post('/belanja/rkaperubahan/loaddatauraianfirsttime',
                {
                    RKAID:this.datakegiatan.RKAID,                       
                },
                {
                    headers:{
                        Authorization: this.$store.getters["auth/Token"]
                    }
                }
            ).then(({data})=>{  
                var page = this.$store.getters["uiadmin/Page"]('rkaperubahan');
                this.datakegiatan = data.rka;
                page.datakegiatan = data.rka;
                this.$store.dispatch('uiadmin/updatePage',page);              
                this.datatable = data.uraian;
                this.footersummary();
                this.btnLoading = false;
            }).catch(()=>{
                this.btnLoading = false;
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
        footersummary()
        {
            let data = this.datatable;            
            var summary = { 
                paguuraian:0,
                realisasi:0,
                sisa:0,
                persen_keuangan:0,
                fisik:0
            };
            if (data.length > 0)
            {
                var totalpaguuraian=0;
                var totalrealiasi=0;
                var totalfisik=0;
                for (var i = 0; i < data.length;i++)
                {
                    var num = new Number(data[i].PaguUraian2);
                    totalpaguuraian+=num;

                    num = new Number(data[i].realisasi2);
                    totalrealiasi+=num;

                    num = new Number(data[i].fisik2);
                    totalfisik+=num;
                }
                summary.paguuraian=totalpaguuraian;
                summary.realisasi=totalrealiasi;
                summary.sisa=totalpaguuraian-totalrealiasi;
                summary.persen_keuangan=(totalrealiasi>0 && totalpaguuraian >0)?((totalrealiasi/totalpaguuraian)*100):0;
                summary.fisik=(totalfisik>0)?(totalfisik/data.length):0;
            }
            this.footers = summary;
        },
        viewItem (item) {
            var page = this.$store.getters["uiadmin/Page"]('rkaperubahan');              
            if (page.datauraian.RKARincID == '')
            {
                page.datauraian = item;
                this.$store.dispatch('uiadmin/updatePage',page);

                this.$router.push('/belanjaperubahan/rka/realisasi/'+page.datauraian.RKARincID);
            }
            else
            {
                this.$root.$confirm.open('INFO', 'Uraian lain sedang dibuka, jadi tidak bisa membuka Uraian ini', { color: 'warning' }).then((confirm) => {
                    if (confirm)
                    {
                        this.$router.push('/belanjaperubahan/rka/realisasi/'+page.datauraian.RKARincID);
                    }                
                });
            }                    
        },    
        editItem:async function (item) {  
            await this.$ajax.post('/dmaster/jenispelaksanaan',
                {
                    tahun:item.TA,                       
                },
                {
                    headers:{
                        Authorization: this.$store.getters["auth/Token"]
                    }
                }
            ).then(({data})=>{                
                this.daftar_jenispelaksanaan = data.jenispelaksanaan;
            });  
            this.form_valid=true;
            this.editedIndex = this.datatable.indexOf(item);
            this.formuraian = Object.assign({}, item);
            this.dialogedituraian = true
        },    
        updateuraian: async function () 
        {
            if (this.$refs.frmedituraian.validate())
            {
                if (this.editedIndex > -1)
                {
                    this.btnLoading = true;
                    await this.$ajax.post('/belanja/rkaperubahan/updateuraian/'+this.formuraian.RKARincID,
                        {
                            '_method': 'PUT',
                            'RKARincID':this.formuraian.RKARincID,
                            'volume2':this.formuraian.volume2,   
                            'satuan2':this.formuraian.satuan2,   
                            'harga_satuan2':this.formuraian.harga_satuan2,   
                            'PaguUraian2':this.formuraian.PaguUraian2,   
                            'JenisPelaksanaanID':this.formuraian.JenisPelaksanaanID,  
                        },
                        {
                            headers:{
                                Authorization: this.$store.getters["auth/Token"]
                            }
                        }
                    ).then(({data})=>{                   
                        var page = this.$store.getters["uiadmin/Page"]('rkaperubahan');
                        this.datakegiatan = data.rka;
                        page.datakegiatan = data.rka;
                        this.$store.dispatch('uiadmin/updatePage',page);             
                        
                        this.initialize();    
                        this.closedialogedituraian();
                    }).catch(()=>{
                        this.btnLoading = false;
                    });  
                }
            }
        },
        copytarget ()
        {
            this.$root.$confirm.open('Salin data Target Fisik dan Anggaran Kas', 'Proses ini akan menyalin target fisik dan anggaran kas dari kegiatan murni sekaligus menghapus yang saat ini. Apakah bersedia ?', { color: 'red',width:500 }).then((confirm) => {
                if (confirm)
                {
                    this.btnLoading = true;            
                    this.$ajax.post('/belanja/rkaperubahan/copytarget/'+this.datakegiatan.RKAID,
                        {
                            _method:'PUT',
                            RKAID:this.datakegiatan_murni.RKAID,
                        },
                        {
                            headers:{
                                Authorization: this.$store.getters["auth/Token"]
                            }
                        }
                    ).then(()=>{                
                        this.btnLoading = false;
                    }).catch(()=>{            
                        this.btnLoading = false;
                    });                  
                }
            });
        },
        savetargetfisik: async function () {
            if (this.$refs.frmtargetfisik.validate())
            {
                this.btnLoading = true;
                if (this.editedIndex > -1)
                {
                    await this.$ajax.post('/belanja/rkaperubahan/updatetargetfisik',
                        {
                            '_method': 'PUT',
                            'RKARincID':this.RKARincID_Selected,
                            'bulan_fisik':this.formtarget.targetfisik,   
                        },
                        {
                            headers:{
                                Authorization: this.$store.getters["auth/Token"]
                            }
                        }
                    ).then(()=>{                       
                        this.closedialogtargetfisik();
                    }).catch(()=>{
                        this.btnLoading = false;
                    });  
                }
                else
                {
                    await this.$ajax.post('/belanja/rkaperubahan/savetargetfisik',
                        {
                            'RKARincID':this.RKARincID_Selected,
                            'RKAID':this.datakegiatan.RKAID,
                            'bulan_fisik':this.formtarget.targetfisik,   
                            'tahun':this.$store.getters['uifront/getTahunAnggaran']                
                        },
                        {
                            headers:{
                                Authorization: this.$store.getters["auth/Token"]
                            }
                        }
                    ).then(()=>{                       
                        this.closedialogtargetfisik();
                    }).catch(()=>{
                        this.btnLoading = false;
                    });  
                }
            }
        },
        savetargetanggarankas: async function () {
            if (this.$refs.frmtargetanggarankas.validate())
            {
                this.btnLoading = true;
                if (this.editedIndex > -1)
                {
                    await this.$ajax.post('/belanja/rkaperubahan/updatetargetanggarankas',
                        {
                            '_method': 'PUT',
                            'RKARincID':this.RKARincID_Selected,
                            'bulan_anggaran':this.formtarget.targetanggarankas,   
                        },
                        {
                            headers:{
                                Authorization: this.$store.getters["auth/Token"]
                            }
                        }
                    ).then(()=>{                       
                        this.closedialogtargetanggarankas();
                    }).catch(()=>{
                        this.btnLoading = false;
                    });  
                }
                else
                {
                    await this.$ajax.post('/belanja/rkaperubahan/savetargetanggarankas',
                        {
                            'RKARincID':this.RKARincID_Selected,
                            'RKAID':this.datakegiatan.RKAID,
                            'bulan_anggaran':this.formtarget.targetanggarankas,   
                            'tahun':this.$store.getters['uifront/getTahunAnggaran']                
                        },
                        {
                            headers:{
                                Authorization: this.$store.getters["auth/Token"]
                            }
                        }
                    ).then(()=>{                       
                        this.closedialogtargetanggarankas();
                    }).catch(()=>{
                        this.btnLoading = false;
                    });  
                }
            }
        },
        closedialogdetailitem () {
            setTimeout(() => {
                
                }, 300
            );
            this.dialogdetailitem = false;   
        },
        async showdialogtargetfisik () {  
            this.form_valid=true;     
            this.editedIndex=-1;     
            this.RKARincID_Selected = null; 
            this.formtarget.targetfisik=[0,0,0,0,0,0,0,0,0,0,0,0];              
            if (this.datakegiatan.RKAID_Src != null)
            {
                this.btnLoading = true;
                await this.$ajax.get('/belanja/rkamurni/'+this.datakegiatan.RKAID_Src,                
                    {
                        headers:{
                            Authorization: this.$store.getters["auth/Token"]
                        }
                    }
                ).then(({data})=>{                      
                    this.datakegiatan_murni=data.datakegiatan;      
                    this.btnLoading = false;
                }).catch(()=>{
                    this.btnLoading = false;
                });   
            }            
            this.dialogtargetfisik = true;           
        },
        async showdialogtargetanggkarankas () {
            this.form_valid=true;
            this.editedIndex=-1;
            this.RKARincID_Selected = null; 
            this.formtarget.targetanggarankas=[0,0,0,0,0,0,0,0,0,0,0,0]; 
            if (this.datakegiatan.RKAID_Src != null)
            {
                this.btnLoading = true;
                await this.$ajax.get('/belanja/rkamurni/'+this.datakegiatan.RKAID_Src,                
                    {
                        headers:{
                            Authorization: this.$store.getters["auth/Token"]
                        }
                    }
                ).then(({data})=>{                      
                    this.datakegiatan_murni=data.datakegiatan;      
                    this.btnLoading = false;
                }).catch(()=>{
                    this.btnLoading = false;
                });   
            }                   
            this.dialogtargetanggarankas = true;   
        },
        closedialogedituraian () {
            this.btnLoading = false;            
            setTimeout(() => {                
                this.editedIndex = -1;
                this.$refs.frmedituraian.resetValidation();               
                this.dialogedituraian = false;
                }, 300
            );            
        },
        closedialogtargetfisik () {
            this.btnLoading = false;            
            setTimeout(() => {
               this.$router.go();
                }, 300
            );            
        },
        closedialogtargetanggarankas () {    
            this.btnLoading = false;                     
            setTimeout(() => {
                this.$router.go();
                }, 300
            );            
        },
        exituraianrka ()
        {
            this.btnLoading = false;
            var page = this.$store.getters["uiadmin/Page"]('rkaperubahan');
            page.datakegiatan ={
                RKAID: "",
            };
            page.datauraian ={
                RKARincID:'',
            };
            page.datarekening ={};

            this.$store.dispatch('uiadmin/updatePage',page);
            this.$router.push('/belanjaperubahan/rka');
        }

    },
    computed: {        
        showBtnLoadDataUraian()
        {
            var bool = false;
            if (this.datatableLoaded == true)
            {
                bool = this.datatable.length > 0;
             
            }
            return bool;
            
        },
        totalTargetFisik ()
        {
            var total=0;
            for (var i = 0; i < 12; i++)
            {
                total += new Number(this.formtarget.targetfisik[i]);
            }
            return total;
        },
        totalTargetAnggaranKas: {
            get ()
            {
                var total=0;
                for (var i = 0; i < 12; i++)
                {
                    total += new Number(this.formtarget.targetanggarankas[i]);
                }
                return total;
            },
            set ()
            {
                
            }
        },
        daftar_uraian()
        {
            var uraian=[];
            var du=this.datatable;  
            du.forEach(item=>{               
                uraian.push({
                    text:'['+item.kode_uraian+'] '+item.nama_uraian,
                    value:item.RKARincID
                });
            });
            return uraian;
        }
    },
    watch : {
       RKARincID_Selected: async function (val)
       {
           if (val !== null && typeof val !== 'undefined')
           {   
                var mode = this.dialogtargetfisik == true ? 'targetfisik': 'targetanggarankas'
                await this.$ajax.post('/belanja/rkaperubahan/rencanatarget',
                        {
                            'mode':mode,
                            'RKARincID':this.RKARincID_Selected,
                        },
                        {
                            headers:{
                                Authorization: this.$store.getters["auth/Token"]
                            }
                        }
                    ).then(({data})=>{               
                        this.formtarget.paguuraian2 = data.datauraian.PaguUraian2;               
                        if (data.mode=='targetfisik')
                        {
                            if (Object.keys(data.target).length > 0)
                            {
                                this.editedIndex=1;
                                this.formtarget.targetfisik=[
                                    data.target.fisik_1,
                                    data.target.fisik_2,
                                    data.target.fisik_3,
                                    data.target.fisik_4,
                                    data.target.fisik_5,
                                    data.target.fisik_6,
                                    data.target.fisik_7,
                                    data.target.fisik_8,
                                    data.target.fisik_9,
                                    data.target.fisik_10,
                                    data.target.fisik_11,
                                    data.target.fisik_12,
                                ];     
                            }
                            else
                            {
                                this.formtarget.targetfisik=[0,0,0,0,0,0,0,0,0,0,0,0];        
                                this.editedIndex=-1;
                            }
                        }
                        else if (mode == 'targetanggarankas')
                        {
                            if (Object.keys(data.target).length > 0)
                            {
                                this.editedIndex=1;
                                this.formtarget.targetanggarankas=[
                                    data.target.anggaran_1,
                                    data.target.anggaran_2,
                                    data.target.anggaran_3,
                                    data.target.anggaran_4,
                                    data.target.anggaran_5,
                                    data.target.anggaran_6,
                                    data.target.anggaran_7,
                                    data.target.anggaran_8,
                                    data.target.anggaran_9,
                                    data.target.anggaran_10,
                                    data.target.anggaran_11,
                                    data.target.anggaran_12,
                                ];     
                            }
                            else
                            {
                                this.formtarget.targetanggarankas=[0,0,0,0,0,0,0,0,0,0,0,0];        
                                this.editedIndex=-1;
                            }
                        }                                          
                    });  
           }
       }
    },
    components: {
        BelanjaPerubahanLayout,
        ModuleHeader,
    },
};
</script>