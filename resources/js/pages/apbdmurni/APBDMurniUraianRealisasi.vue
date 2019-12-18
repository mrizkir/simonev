<template>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark">
                        <i class="nav-icon fas fa-cart-arrow-down"></i>
                        APBD MURNI
                    </h1>
                </div>
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><router-link to="/">HOME</router-link></li>
                        <li class="breadcrumb-item"><router-link to="/apbdmurni">APBD MURNI</router-link></li>
                        <li class="breadcrumb-item"><router-link to="/apbdmurni/uraian">URAIAN</router-link></li>
                        <li class="breadcrumb-item active">REALISASI</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>  
    <!-- Main content -->
    <section class="content" v-if="detailkegiatan.hasOwnProperty('RKAID') && datauraian.hasOwnProperty('RKARincID')">
        <div class="container-fluid">
            <div class="row" v-if="api_message">
                <div class="col-md-12">
                    <!-- /.card-header -->
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                        {{api_message}} 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-eye"></i> DATA KEGIATAN</h3>
                            <div class="card-tools">                                 
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">                                      
                                <div class="col-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label"><strong>RKAID: </strong></label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">{{detailkegiatan.RKAID}}</p>
                                        </div>                            
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label"><strong>OPD / SKPD: </strong></label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">[{{detailkegiatan.kode_organisasi}}] {{detailkegiatan.OrgNm}}</p>
                                        </div>                            
                                    </div>                             
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label"><strong>UNIT KERJA: </strong></label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">[{{detailkegiatan.kode_suborganisasi}}] {{detailkegiatan.SOrgNm}}</p>
                                        </div>                            
                                    </div>     
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label"><strong>PROGRAM: </strong></label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">[{{detailkegiatan.kode_program}}] {{detailkegiatan.PrgNm}}</p>
                                        </div>                            
                                    </div>       
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label"><strong>KEGIATAN: </strong></label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">
                                                [{{detailkegiatan.kode_kegiatan}}] {{detailkegiatan.KgtNm}} 
                                                <span class="badge badge-pill badge-primary mb-1">[{{detailkegiatan.sifat_kegiatan1}}]</span>
                                            </p>
                                        </div>                            
                                    </div>             
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label"><strong>PAGU DANA: </strong></label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">{{detailkegiatan.PaguDana1|formatUang}}</p>
                                        </div>                            
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-eye"></i> DATA URAIAN</h3>
                            <div class="card-tools">                                 
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">                                      
                                <div class="col-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label"><strong>RKARINCID: </strong></label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">{{datauraian.RKARincID}}</p>
                                        </div>                            
                                    </div>                             
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label"><strong>NAMA URAIAN: </strong></label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">[{{datauraian.kode_rek_5}}] {{datauraian.nama_uraian}}</p>
                                        </div>                            
                                    </div>                             
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label"><strong>PAGU URAIAN: </strong></label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">{{datauraian.pagu_uraian1|formatUang}}</p>
                                        </div>                            
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label"><strong>TOTAL REALISASI: </strong></label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">{{totalRealisasiAll|formatUang}}</p>
                                        </div>                            
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label"><strong>TOTAL FISIK: </strong></label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">{{totalFisikAll}}</p>
                                        </div>                            
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" v-if="pid=='create'">
				<div class="col-12">
                    <!-- Horizontal Form -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-plus"></i> TAMBAH REALISASI
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" v-on:click.prevent="proc('default',null)">
                                    <i class="fas fa-times"></i>
                                </button>                                                
                            </div>       
                        </div>
                        <form class="form-horizontal" @submit.prevent="saveData">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">BULAN REALISASI :</label>
                                    <div class="col-sm-10">
                                        <v-select 
                                            v-model="form.bulan" 
                                            :reduce="daftar_bulan => daftar_bulan.code"
                                            placeholder="PILIH BULAN REALISASI" 
                                            :options="daftar_bulan"
                                            @input="changeBulan">
                                        </v-select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">ANGGARAN KAS :</label>
                                    <div class="col-sm-10">                                        
                                        <p class="form-control-static">{{form.anggarankas|formatUang}}</p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">FISIK :</label>
                                    <div class="col-sm-10">                                        
                                        <p class="form-control-static">{{form.targetfisik}}%</p>
                                    </div>
                                </div>                                
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">REALISASI :</label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <vue-autonumeric 
                                                    v-model.trim="form.realisasi1" 
                                                    v-on:input="$v.form.$touch"
                                                    :options="{
                                                        minimumValue: '0',
                                                        decimalCharacter: ',',
                                                        digitGroupSeparator: '.',
                                                        emptyInputBehavior:0,
                                                        unformatOnSubmit: true 
                                                    }" 
                                                    class="form-control" 
                                                    v-bind:class="{'is-invalid': $v.form.realisasi1.$error, 'is-valid': $v.form.realisasi1.$dirty && !$v.form.realisasi1.$invalid}">
                                                </vue-autonumeric>
                                                <div class="text-danger" v-if="$v.form.realisasi1.$error">* Mohon untuk di isi atau nilai yang di isi telah melampau {{form.pagu_uraian|formatUang}}</div>
                                            </div>
                                            <div class="col-sm-5">
                                                <p class="form-control-static">
                                                    Sisa Pagu {{form.pagu_uraian-form.totalrealisasi|formatUang}}
                                                </p>
                                            </div>
                                        </div>										
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">FISIK :</label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <vue-autonumeric 
                                                    v-model.trim="form.fisik1" 
                                                    v-on:input="$v.form.$touch"
                                                    :options="{
                                                        allowDecimalPadding: false,
                                                        minimumValue:0.00,
                                                        maximumValue:100.00,
                                                        decimalCharacter:'.',
                                                        showWarnings:false,
                                                        emptyInputBehavior:0.00,
                                                        unformatOnSubmit: true,
                                                        modifyValueOnWheel:false
                                                    }"  
                                                    class="form-control" 
                                                    v-bind:class="{'is-invalid': $v.form.fisik1.$error, 'is-valid': $v.form.fisik1.$dirty && !$v.form.fisik1.$invalid}">
                                                </vue-autonumeric>
                                                <div class="text-danger" v-if="$v.form.fisik1.$error">* Mohon untuk di isi atau nilai yang di isi telah melampau 100%</div>
                                            </div>
                                            <div class="col-sm-5">
                                                <p class="form-control-static">
                                                    Sisa Fisik {{100-form.totalfisik}}
                                                </p>
                                            </div>
                                        </div>
										
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">KETERANGAN :</label>
                                    <div class="col-sm-10">                                        
                                        <textarea v-model="form.Descr" rows="4" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="form-group row">
                                    <div class="col-sm-2">
                                        &nbsp;
                                    </div>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-info" :disabled="$v.form.$error">Simpan</button>                                        
                                    </div>                                    
                                </div>
                            </div>
                        </form>
                    </div>
				</div>
            </div>
            <div class="row" v-if="pid=='edit'">
				<div class="col-12">
                    <!-- Horizontal Form -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-plus"></i> UBAH REALISASI
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" v-on:click.prevent="proc('default',null)">
                                    <i class="fas fa-times"></i>
                                </button>                                                
                            </div>       
                        </div>
                        <form class="form-horizontal" @submit.prevent="updateData">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">BULAN REALISASI :</label>
                                    <div class="col-sm-10">
                                        <p class="form-control-static">
                                            {{form.bulan}}
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">ANGGARAN KAS :</label>
                                    <div class="col-sm-10">                                        
                                        <p class="form-control-static">{{form.anggarankas|formatUang}}</p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">FISIK :</label>
                                    <div class="col-sm-10">                                        
                                        <p class="form-control-static">{{form.targetfisik}}%</p>
                                    </div>
                                </div>                                
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">REALISASI :</label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <vue-autonumeric 
                                                    v-model.trim="form.realisasi1" 
                                                    v-on:input="$v.form.$touch"
                                                    :options="{
                                                        minimumValue: '0',
                                                        decimalCharacter: ',',
                                                        digitGroupSeparator: '.',
                                                        emptyInputBehavior:0,
                                                        unformatOnSubmit: true 
                                                    }" 
                                                    class="form-control" 
                                                    v-bind:class="{'is-invalid': $v.form.realisasi1.$error, 'is-valid': $v.form.realisasi1.$dirty && !$v.form.realisasi1.$invalid}">
                                                </vue-autonumeric>
                                                <div class="text-danger" v-if="$v.form.realisasi1.$error">* Mohon untuk di isi atau nilai yang di isi telah melampau {{form.pagu_uraian|formatUang}}</div>
                                            </div>
                                            <div class="col-sm-5">
                                                <p class="form-control-static">
                                                    Sisa Pagu {{form.pagu_uraian-totalRealisasiAll|formatUang}}
                                                </p>
                                            </div>
                                        </div>										
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">FISIK :</label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <vue-autonumeric 
                                                    v-model.trim="form.fisik1" 
                                                    v-on:input="$v.form.$touch"
                                                    :options="{
                                                        allowDecimalPadding: false,
                                                        minimumValue:0.00,
                                                        maximumValue:100.00,
                                                        decimalCharacter:'.',
                                                        showWarnings:false,
                                                        emptyInputBehavior:0.00,
                                                        unformatOnSubmit: true,
                                                        modifyValueOnWheel:false
                                                    }"  
                                                    class="form-control" 
                                                    v-bind:class="{'is-invalid': $v.form.fisik1.$error, 'is-valid': $v.form.fisik1.$dirty && !$v.form.fisik1.$invalid}">
                                                </vue-autonumeric>
                                                <div class="text-danger" v-if="$v.form.fisik1.$error">* Mohon untuk di isi atau nilai yang di isi telah melampau 100%</div>
                                            </div>
                                            <div class="col-sm-5">
                                                <p class="form-control-static">
                                                    Sisa Fisik {{100-totalFisikAll}}
                                                </p>
                                            </div>
                                        </div>
										
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">KETERANGAN :</label>
                                    <div class="col-sm-10">                                        
                                        <textarea v-model="form.Descr" rows="4" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="form-group row">
                                    <div class="col-sm-2">
                                        &nbsp;
                                    </div>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-info" :disabled="$v.form.$error">Simpan</button>                                        
                                    </div>                                    
                                </div>
                            </div>
                        </form>
                    </div>
				</div>
            </div>
            <div class="row" v-if="pid=='default'">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-list-ol"></i>  DAFTAR REALISASI URAIAN KEGIATAN
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" v-on:click.prevent="proc('create')" title="Tambah Realisasi">
                                    <i class="fas fa-plus"></i>
                                </button>                                
                                <router-link to="/apbdmurni/uraian" class="btn btn-tool">
                                    <i class="fas fa-times"></i>
                                </router-link>                                
                            </div>       
                        </div>
                        <div class="card-body table-responsive p-0" v-if="daftar_realisasi.length">
                            <table class="table table-striped table-hover mb-2 table-condensed">
                                <thead>
                                    <tr>
                                        <th width="55">NO</th>    
                                        <th  width="150">
                                            BULAN
                                        </th>
                                        <th class="text-right">RENCANA ANGGARAN KAS</th>                    
                                        <th class="text-right">REALISASI/SP2D</th>                    
                                        <th class="text-center">RENCANA TARGET FISIK (%)</th>                    
                                        <th class="text-center">FISIK (%)</th>                                                                        
                                        <th class="text-right" width="150">SISA ANGGARAN (PAGU URAIAN - TOTAL REALISASI)</th>                                                                        
                                        <th width="80">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>  
                                    <tr v-for="(item,index) in daftar_realisasi" v-bind:key="item.RKARealisasiRincID">
                                        <td>{{ index+1 }}</td>                
                                        <td>
                                            {{ item.NamaBulan }} {{item.TA}}
                                        </td>                                       
                                        <td class="text-right">{{item.target1|formatUang}}</td>
                                        <td class="text-right">{{item.realisasi1|formatUang}}</td>
                                        <td class="text-center">{{item.target_fisik1}}</td>
                                        <td class="text-center">{{item.fisik1}}</td>
                                        <td class="text-right">{{item.sisa_anggaran|formatUang}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-wrench"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> 
                                                    <a class="dropdown-item" href="#" v-on:click.prevent="proc('edit',item)" title="Ubah Realisasi">
                                                        <i class="fas fa-edit"></i> UBAH
                                                    </a>                                                                                                     
                                                    <a class="dropdown-item" v-on:click.prevent="proc('destroy',item)" href="#" title="Hapus Data Realisasi">
                                                        <i class="fas fa-trash-alt"></i> HAPUS
                                                    </a>
                                                </div>
                                            </div>
                                        </td>          
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="table-info font-weight-bold">
                                        <td colspan="2" class="text-right">TOTAL</td>
                                        <td class="text-right">
                                            {{totalAnggaranKas|formatUang}}
                                        </td>
                                        <td class="text-right">
                                            {{totalRealisasiAll|formatUang}}
                                        </td>
                                        <td class="text-center">
                                            {{totalTargetFisikAll}}
                                        </td>
                                        <td class="text-center">
                                            {{totalFisikAll}}
                                        </td>
                                        <td class="text-right">
                                            {{sisaAnggaran|formatUang}}
                                        </td>
                                        <td class="center">
                                            &nbsp;
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="card-body table-responsive" v-else>                            
                            <div class="alert alert-info alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-info"></i> Info!</h5>
                                Belum ada data yang bisa ditampilkan.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>  
    <section class="content" v-else>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- /.card-header -->
                    <div class="alert alert-danger alert-dismissible">
                        <router-link to="/apbdmurni/uraian" class="close">
                            <i class="fas fa-times"></i>
                        </router-link>
                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                        Mohon di pilih terlebih dahulu uraian / rincian / sub kegiatan !!!                         
                    </div>
                </div>
            </div>
        </div>
    </section>  
</div>
</template>
<script>
import { required} from 'vuelidate/lib/validators';
import VueAutonumeric from 'vue-autonumeric';
import vSelect from 'vue-select';

const checkTotalFisik = (value,vm) => {    
    return (parseFloat(value)+vm.totalfisik) <= 100;
};
const checkTotalRealisasi = (value,vm) => {        
    return (parseFloat(value)+vm.totalrealisasi) <= vm.pagu_uraian;
};

export default {
    created ()
    {
        var page = this.$store.getters.getPage('apbdmurni');
        this.detailkegiatan = page.detailkegiatan;     
        this.datauraian = page.datauraian;                  
    },
    mounted()
    {
        this.proc('default');   
    },
    data: function() 
	{
		return {
            pid:'default',
            api_message:'',

            detailkegiatan:'',
            datauraian:'',
            daftar_realisasi:{},
            totalAnggaranKas:0,
            totalRealisasiAll:0,
            totalTargetFisikAll:0,
            totalFisikAll:0,
            sisaAnggaran:0,
            //form
            daftar_bulan:[],
            form: {		                
                RKARealisasiRincID:'',
                bulan:'',
                pagu_uraian:0,
                targetfisik:0,
                anggarankas:0,
                realisasi1:0,
                fisik1:0,
                totalrealisasi:0,
                totalfisik:0,
                Descr:'',
            }
        }
    },
    methods: 
    {
        populateData(page=1)
        {           
            axios.get('/api/v1/apbdmurni/uraian/realisasi/'+this.datauraian.RKARincID,{
                headers:{
                    'Authorization': window.laravel.api_token,
                }
            })
            .then(response => {                                        
                this.daftar_realisasi = response.data.daftar_realisasi;      
                
                this.form.pagu_uraian=parseFloat(this.datauraian.pagu_uraian1);
                
                this.totalAnggaranKas = response.data.totalanggarankas;      
                this.totalRealisasiAll = response.data.totalrealisasi;      
                this.form.totalrealisasi = response.data.totalrealisasi;      
                
                this.totalTargetFisikAll = response.data.totaltargetfisik;      
                this.totalFisikAll = response.data.totalfisik;      
                this.form.totalfisik = response.data.totalfisik;      
                
                this.sisaAnggaran = response.data.sisa_anggaran;      
            })
            .catch(response => {
                this.api_message = response;
            }); 
        },
        proc (pid,item=null) 
        { 
            this.$v.$reset();
            switch (pid)
            {      
                case 'create' :                    
                    if ((parseFloat(this.totalRealisasiAll) < parseFloat(this.datauraian.pagu_uraian1)) || (parseFloat(this.totalFisikAll)< 100))
                    {                    
                        this.pid = pid;
                        axios.get('/api/v1/apbdmurni/create4/'+this.datauraian.RKARincID,{
                            headers:{
                                'Authorization': window.laravel.api_token,
                            }
                        })
                        .then(response => {                   
                            var daftar_bulan = [];
                            $.each(response.data,function(key,value){                            
                                daftar_bulan.push({
                                    code:key,
                                    label:value
                                });
                            });                
                            this.daftar_bulan=daftar_bulan;                      
                        })
                        .catch(response => {                        
                            this.api_message = response;
                        }); 
                    }
                    else
                    {
                        this.$swal({
                            title: 'Tidak bisa tambah Realisasi',
                            type: 'warning',
                            text: 'Tidak bisa tambah realisasi, karena Realisasi telah sama atau melampau pagu uraian!',
                        });

                    }
                break;
                case 'edit' :
                    this.pid=pid;

                    this.form.RKARealisasiRincID=item.RKARealisasiRincID;
                    this.form.bulan=item.bulan1;

                    this.form.totalrealisasi=this.form.totalrealisasi-item.realisasi1;
                    this.form.realisasi1=item.realisasi1;

                    this.form.totalfisik=this.form.totalfisik-item.fisik1;
                    this.form.fisik1=item.fisik1;
                    this.form.Descr=item.Descr;
                break;
                case 'destroy':
                    var self = this;
                    this.$swal({
                        title: 'Yakin mau menghapus realisasi uraian kegiatan?',
                        text: "Anda tidak bisa mengembalikan data ini",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus ini!',
                        cancelButtonText: 'Tidak, Batalkan!',
                        buttonsStyling: true
                    }).then(function (isConfirm){
                        if(isConfirm.value === true) 
                        {
                            axios.post('/api/v1/apbdmurni/'+item.RKARealisasiRincID,{
                                '_method':'DELETE',
                                'pid':'datarealisasi'
                            },{
                                headers:{
                                    'Authorization': window.laravel.api_token,
                                },
                            })
                            .then(response => {                                                          
                                self.populateData();                                                           
                            })
                            .catch(response => {
                                self.api_message = response;                               
                            });                                  
                        }
                    });                    
                break;
                default :
                    this.pid = pid;
                    if (this.detailkegiatan.hasOwnProperty('RKAID') && this.datauraian.hasOwnProperty('RKARincID'))
                    {
                        this.populateData();                        
                    }                    
                    this.clearform();    
            }
        },
        changeBulan()
        {      
            var bulan=parseInt(this.form.bulan); 
            this.form.targetfisik=this.datauraian.targetfisik[bulan];
            this.form.anggarankas=this.datauraian.anggarankas[bulan];            
        },
        saveData() 
		{	
            this.$v.form.$touch();    
            if(this.$v.$invalid == false)
            {                 
                axios.post('/api/v1/apbdmurni/store4',{                   
                    'RKARincID':this.datauraian.RKARincID,
                    'RKAID':this.detailkegiatan.RKAID,
                    'bulan1':this.form.bulan,                   
                    'target1':this.form.anggarankas,                   
                    'realisasi1':this.form.realisasi1,                   
                    'target_fisik1':this.form.targetfisik,                   
                    'fisik1':this.form.fisik1,                   
                    'Descr':this.form.Descr,                   
                },{
                    headers:{
                        'Authorization': window.laravel.api_token,
                    },
                })
                .then(response => {                          
                    this.$swal({
                        title: '<i class="fas fa-spin fa-spinner"></i>',
                        text: "Menyimpan Data Realisasi berhasil dilakukan",
                        showCancelButton: false,
                        showConfirmButton: false,
                        showCloseButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                    });              
                    setTimeout(() => {
                        this.clearform();                             
                        this.$swal.close();   
                        this.proc('default');       
                    }, 1500);             
                })
                .catch(error => {
                    this.api_message = error.response.data.message;
                });			
            }
        },
        updateData()
        {
            this.$v.form.$touch();    
            if(this.$v.$invalid == false)
            {                 
                axios.post('/api/v1/apbdmurni/update4/'+this.form.RKARealisasiRincID,{                   
                    'realisasi1':this.form.realisasi1,                   
                    'fisik1':this.form.fisik1,                   
                    'Descr':this.form.Descr,                   
                },{
                    headers:{
                        'Authorization': window.laravel.api_token,
                    },
                })
                .then(response => {                          
                    this.$swal({
                        title: '<i class="fas fa-spin fa-spinner"></i>',
                        text: "Mengubah Data Realisasi berhasil dilakukan",
                        showCancelButton: false,
                        showConfirmButton: false,
                        showCloseButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                    });              
                    setTimeout(() => {
                        this.clearform();                             
                        this.$swal.close();   
                        this.proc('default');       
                    }, 1500);             
                })
                .catch(error => {
                    this.api_message = error.response.data.message;
                });			
            }
        },
        clearform ()
        {   
            this.form.RKARealisasiRincID='';
            this.form.bulan='';
            this.form.targetfisik=0;
            this.form.anggarankas=0;
            this.form.realisasi1=0;
            this.form.fisik1=0;
            this.form.Descr='';
        },
    },
    validations: {
		form: {
			bulan: {
				required
			},			
			realisasi1: {
                required,
                checkTotalRealisasi
			},			
			fisik1: {
                required,
                checkTotalFisik
			},			
		}
	},
	components: 
	{
        'vue-autonumeric':VueAutonumeric,
        'v-select': vSelect,
    }
}
</script>