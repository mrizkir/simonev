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
                        <li class="breadcrumb-item active">RENCANA TARGET FISIK</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>  
    <!-- Main content -->
    <section class="content" v-if="detailkegiatan.hasOwnProperty('RKAID')">
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
            </div>
            <div class="row" v-if="pid=='create'">
				<div class="col-12">
                    <!-- Horizontal Form -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-plus"></i> TAMBAH TARGET FISIK DAN TARGET ANGGARAN KAS
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
                                    <label class="col-md-3 col-form-label">RINCIAN KEGIATAN :</label> 
                                    <div class="col-md-9">
                                        <v-select 
                                            v-model="form.RKARincID" 
											v-on:input="$v.form.$touch" 
                                            placeholder="PILIH RINCIAN KEGIATAN" 
                                            :options="daftar_rinciankegiatan" 
                                            :reduce="daftar_rinciankegiatan => daftar_rinciankegiatan.code" 
											v-bind:class="{'is-invalid': $v.form.RKARincID.$error, 'is-valid': $v.form.RKARincID.$dirty && !$v.form.RKARincID.$invalid}">
                                        </v-select>
										<div class="text-danger" v-if="$v.form.RKARincID.$error">* Mohon dipilih Rincian Kegiatan</div>
                                    </div>
                                </div> 
                                <table class="table mb-2">
                                    <thead>
                                        <tr>
                                            <th width="150">BULAN</th>    
                                            <th>TARGET FISIK</th>
                                            <th>ANGGARAN KAS</th>                                           
                                        </tr>
                                    </thead>
                                    <tbody>  
                                        <tr>
                                            <td>JANUARI</td>
                                            <td> 
                                                <vue-autonumeric 
                                                    v-model.trim="form.targetfisik[0]" 
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
                                                    v-on:input="calTotalTargetFisik">
                                                </vue-autonumeric>
                                            </td>
                                            <td>
                                                <vue-autonumeric 
                                                    v-model.trim="form.targetanggarankas[0]" 
                                                    :options="{
                                                        minimumValue: '0',
                                                        decimalCharacter: ',',
                                                        digitGroupSeparator: '.',
                                                        emptyInputBehavior:0,
                                                        unformatOnSubmit: true 
                                                    }" 
                                                    class="form-control" 
                                                    v-on:input="calTotalAnggaranKas"> 
                                                </vue-autonumeric>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>FEBRUARI</td>
                                            <td> 
                                                <vue-autonumeric 
                                                    v-model.trim="form.targetfisik[1]" 
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
                                                    v-on:input="calTotalTargetFisik">
                                                </vue-autonumeric>
                                            </td>
                                            <td>
                                                <vue-autonumeric 
                                                    v-model.trim="form.targetanggarankas[1]" 
                                                    :options="{
                                                        minimumValue: '0',
                                                        decimalCharacter: ',',
                                                        digitGroupSeparator: '.',
                                                        emptyInputBehavior:0,
                                                        unformatOnSubmit: true 
                                                    }" 
                                                    class="form-control" 
                                                    v-on:input="calTotalAnggaranKas"> 
                                                </vue-autonumeric>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>MARET</td>
                                            <td> 
                                                <vue-autonumeric 
                                                    v-model.trim="form.targetfisik[2]" 
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
                                                    v-on:input="calTotalTargetFisik">
                                                </vue-autonumeric>
                                            </td>
                                            <td>
                                                <vue-autonumeric 
                                                    v-model.trim="form.targetanggarankas[2]" 
                                                    :options="{
                                                        minimumValue: '0',
                                                        decimalCharacter: ',',
                                                        digitGroupSeparator: '.',
                                                        emptyInputBehavior:0,
                                                        unformatOnSubmit: true 
                                                    }" 
                                                    class="form-control" 
                                                    v-on:input="calTotalAnggaranKas"> 
                                                </vue-autonumeric>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>APRIL</td>
                                            <td> 
                                                <vue-autonumeric 
                                                    v-model.trim="form.targetfisik[3]" 
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
                                                    v-on:input="calTotalTargetFisik">
                                                </vue-autonumeric>
                                            </td>
                                            <td>
                                                <vue-autonumeric 
                                                    v-model.trim="form.targetanggarankas[3]" 
                                                    :options="{
                                                        minimumValue: '0',
                                                        decimalCharacter: ',',
                                                        digitGroupSeparator: '.',
                                                        emptyInputBehavior:0,
                                                        unformatOnSubmit: true 
                                                    }" 
                                                    class="form-control" 
                                                    v-on:input="calTotalAnggaranKas"> 
                                                </vue-autonumeric>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>MEI</td>
                                            <td> 
                                                <vue-autonumeric 
                                                    v-model.trim="form.targetfisik[4]" 
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
                                                    v-on:input="calTotalTargetFisik">
                                                </vue-autonumeric>
                                            </td>
                                            <td>
                                                <vue-autonumeric 
                                                    v-model.trim="form.targetanggarankas[4]" 
                                                    :options="{
                                                        minimumValue: '0',
                                                        decimalCharacter: ',',
                                                        digitGroupSeparator: '.',
                                                        emptyInputBehavior:0,
                                                        unformatOnSubmit: true 
                                                    }" 
                                                    class="form-control" 
                                                    v-on:input="calTotalAnggaranKas"> 
                                                </vue-autonumeric>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>JUNI</td>
                                            <td> 
                                                <vue-autonumeric 
                                                    v-model.trim="form.targetfisik[5]" 
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
                                                    v-on:input="calTotalTargetFisik">
                                                </vue-autonumeric>
                                            </td>
                                            <td>
                                                <vue-autonumeric 
                                                    v-model.trim="form.targetanggarankas[5]" 
                                                    :options="{
                                                        minimumValue: '0',
                                                        decimalCharacter: ',',
                                                        digitGroupSeparator: '.',
                                                        emptyInputBehavior:0,
                                                        unformatOnSubmit: true 
                                                    }" 
                                                    class="form-control" 
                                                    v-on:input="calTotalAnggaranKas"> 
                                                </vue-autonumeric>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>JULI</td>
                                            <td> 
                                                <vue-autonumeric 
                                                    v-model.trim="form.targetfisik[6]" 
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
                                                    v-on:input="calTotalTargetFisik">
                                                </vue-autonumeric>
                                            </td>
                                            <td>
                                                <vue-autonumeric 
                                                    v-model.trim="form.targetanggarankas[6]" 
                                                    :options="{
                                                        minimumValue: '0',
                                                        decimalCharacter: ',',
                                                        digitGroupSeparator: '.',
                                                        emptyInputBehavior:0,
                                                        unformatOnSubmit: true 
                                                    }" 
                                                    class="form-control" 
                                                    v-on:input="calTotalAnggaranKas"> 
                                                </vue-autonumeric>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>AGUSTUS</td>
                                            <td> 
                                                <vue-autonumeric 
                                                    v-model.trim="form.targetfisik[7]" 
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
                                                    v-on:input="calTotalTargetFisik">
                                                </vue-autonumeric>
                                            </td>
                                            <td>
                                                <vue-autonumeric 
                                                    v-model.trim="form.targetanggarankas[7]" 
                                                    :options="{
                                                        minimumValue: '0',
                                                        decimalCharacter: ',',
                                                        digitGroupSeparator: '.',
                                                        emptyInputBehavior:0,
                                                        unformatOnSubmit: true 
                                                    }" 
                                                    class="form-control" 
                                                    v-on:input="calTotalAnggaranKas"> 
                                                </vue-autonumeric>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>SEPTEMBER</td>
                                            <td> 
                                                <vue-autonumeric 
                                                    v-model.trim="form.targetfisik[8]" 
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
                                                    v-on:input="calTotalTargetFisik">
                                                </vue-autonumeric>
                                            </td>
                                            <td>
                                                <vue-autonumeric 
                                                    v-model.trim="form.targetanggarankas[8]" 
                                                    :options="{
                                                        minimumValue: '0',
                                                        decimalCharacter: ',',
                                                        digitGroupSeparator: '.',
                                                        emptyInputBehavior:0,
                                                        unformatOnSubmit: true 
                                                    }" 
                                                    class="form-control" 
                                                    v-on:input="calTotalAnggaranKas"> 
                                                </vue-autonumeric>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>OKTOBER</td>
                                            <td> 
                                                <vue-autonumeric 
                                                    v-model.trim="form.targetfisik[9]" 
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
                                                    v-on:input="calTotalTargetFisik">
                                                </vue-autonumeric>
                                            </td>
                                            <td>
                                                <vue-autonumeric 
                                                    v-model.trim="form.targetanggarankas[9]" 
                                                    :options="{
                                                        minimumValue: '0',
                                                        decimalCharacter: ',',
                                                        digitGroupSeparator: '.',
                                                        emptyInputBehavior:0,
                                                        unformatOnSubmit: true 
                                                    }" 
                                                    class="form-control" 
                                                    v-on:input="calTotalAnggaranKas"> 
                                                </vue-autonumeric>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>NOVEMBER</td>
                                            <td> 
                                                <vue-autonumeric 
                                                    v-model.trim="form.targetfisik[10]" 
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
                                                    v-on:input="calTotalTargetFisik">
                                                </vue-autonumeric>
                                            </td>
                                            <td>
                                                <vue-autonumeric 
                                                    v-model.trim="form.targetanggarankas[10]" 
                                                    :options="{
                                                        minimumValue: '0',
                                                        decimalCharacter: ',',
                                                        digitGroupSeparator: '.',
                                                        emptyInputBehavior:0,
                                                        unformatOnSubmit: true 
                                                    }" 
                                                    class="form-control" 
                                                    v-on:input="calTotalAnggaranKas"> 
                                                </vue-autonumeric>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>DESEMBER</td>
                                            <td> 
                                                <vue-autonumeric 
                                                    v-model.trim="form.targetfisik[11]" 
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
                                                    v-on:input="calTotalTargetFisik">
                                                </vue-autonumeric>
                                            </td>
                                            <td>
                                                <vue-autonumeric 
                                                    v-model.trim="form.targetanggarankas[11]" 
                                                    :options="{
                                                        minimumValue: '0',
                                                        decimalCharacter: ',',
                                                        digitGroupSeparator: '.',
                                                        emptyInputBehavior:0,
                                                        unformatOnSubmit: true 
                                                    }" 
                                                    class="form-control" 
                                                    v-on:input="calTotalAnggaranKas"> 
                                                </vue-autonumeric>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>TOTAL</td>
                                            <td>
                                                {{form.totalTargetFisik}}			
                                                <span class="text-danger" v-if="$v.form.totalTargetFisik.$error">* Tidak boleh melampaui 100</span>							
                                            </td>
                                            <td>
                                                {{form.totalTargetAnggaranKas}}			
                                                <span class="text-danger" v-if="$v.form.totalTargetAnggaranKas.$error">* Tidak boleh melampaui 100</span>							
                                            </td>
                                        </tr>   
                                    </tfoot>
                                </table>
                            </div>  
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-info">Simpan</button>                                        
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
                                <i class="fas fa-list-ol"></i>  DAFTAR RENCANA TARGET FISIK DAN ANGGARAN KAS
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" v-on:click.prevent="proc('create')" title="Tambah Rencana Target Fisik dan Anggaran Kas">
                                    <i class="fas fa-plus"></i>
                                </button>                                
                                <router-link to="/apbdmurni/uraian" class="btn btn-tool">
                                    <i class="fas fa-times"></i>
                                </router-link>                                
                            </div>       
                        </div>
                        <div class="card-body table-responsive p-0" v-if="daftar_targetfisik.data.length">
                            <table class="table table-striped table-hover mb-2">
                                <thead>
                                    <tr>
                                        <th width="55">REKENING</th>    
                                        <th  width="250">
                                            NAMA URAIAN
                                        </th>
                                        <th width="55">1</th>                    
                                        <th width="55">2</th>                    
                                        <th width="55">3</th>                    
                                        <th width="55">4</th>                    
                                        <th width="55">5</th>                    
                                        <th width="55">6</th>                    
                                        <th width="55">7</th>                    
                                        <th width="55">8</th>                    
                                        <th width="55">9</th>                    
                                        <th width="55">10</th>                    
                                        <th width="55">11</th>                    
                                        <th width="55">12</th>                    
                                        <th  width="80">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>  

                                </tbody>
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
                        <router-link to="/apbdmurni" class="close">
                            <i class="fas fa-times"></i>
                        </router-link>
                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                        Mohon di pilih terlebih dahulu kegiatan !!!                         
                    </div>
                </div>
            </div>
        </div>
    </section>   
</div>
</template>
<script>
import vSelect from 'vue-select';
import { required} from 'vuelidate/lib/validators';
import VueAutonumeric from 'vue-autonumeric';

const checkTotalFisik = (value) => value <= 100;
const checkTotalAnggaranKas = (value) => value > 100;

export default {
    created ()
    {
        var page = this.$store.getters.getPage('apbdmurni');
        this.detailkegiatan = page.detailkegiatan;             
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
            daftar_targetfisik:{
                data:{}
            },
            //form			
            
            daftar_rinciankegiatan: [],           
			form: {		
                RKARincID:'',
                targetfisik:[],
                targetanggarankas:[],
                totalTargetFisik:0,
                totalTargetAnggaranKas:0,
            }
        }
    },
    methods: 
    {	
        populateData(page=1)
        {           
            axios.get('/api/v1/apbdmurni/uraian/rencanatarget/'+this.detailkegiatan.RKAID,{
                headers:{
                    'Authorization': window.laravel.api_token,
                }
            })
            .then(response => {                                        
                console.log(response.data);                
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
                    this.pid = pid;                    
                    axios.get('/api/v1/apbdmurni/create3/'+this.detailkegiatan.RKAID,{
                        headers:{
                            'Authorization': window.laravel.api_token,
                        }
                    })
                    .then(response => {                                                                  
                        var daftar_rinciankegiatan = [];
                        $.each(response.data,function(key,value){
                            daftar_rinciankegiatan.push({
                                code:key,
                                label:value
                            });
                        });                
                        this.daftar_rinciankegiatan=daftar_rinciankegiatan;                   
                    })
                    .catch(response => {
                        this.api_message = response;
                    }); 
                break;
                default :
                    this.pid = pid;
                    this.populateData();
                    this.clearform();
            }
        },
        calTotalTargetFisik ()
        {
			var total=0;
			$.each(this.form.targetfisik, function(key,value) {
				total+=value;
			});
			this.form.totalTargetFisik = total;            
        },
        calTotalAnggaranKas ()
        {
            var total=0;
			$.each(this.form.targetanggarankas, function(key,value) {
				total+=value;
			});
			this.form.totalTargetAnggaranKas = total;
        },
        saveData() 
		{	
            this.$v.form.$touch();  
            if(this.$v.$invalid == false)
            { 
                axios.post('/api/v1/apbdmurni/store3',{                   
                    'RKARincID':this.form.RKARincID,
                    'RKAID':this.detailkegiatan.RKAID,
                    'bulan_fisik':this.form.targetfisik,                   
                    'bulan_anggaran':this.form.targetanggarankas,                   
                },{
                    headers:{
                        'Authorization': window.laravel.api_token,
                    },
                })
                .then(response => {                          
                    this.$swal({
                        title: '<i class="fas fa-spin fa-spinner"></i>',
                        text: "Menyimpan Data Rencana Target Fisik dan Anggaran Kas Rincian Kegiatan berhasil dilakukan",
                        showCancelButton: false,
                        showConfirmButton: false,
                        showCloseButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                    });              
                    setTimeout(() => {
                        this.clearform();     
                        var page = this.$store.getters.getPage('apbdmurni');
                        page.datarekening = '';                        
                        this.$store.commit('replacePage',page);         
                        this.$swal.close();          
                        this.$router.push('/apbdmurni/uraian/rencanatarget');                          
                    }, 1500);             
                })
                .catch(error => {
                    this.api_message = error.response.data.message;
                });			
            }                   
        },
        clearform ()
        {   
            
        },
    },
    validations: {
		form:{
            RKARincID: {
                required
            },             
            totalTargetFisik: {
                checkTotalFisik
            },             
            totalTargetAnggaranKas: {
                checkTotalAnggaranKas
            }           
        },        
	},
	components: 
	{
        'v-select': vSelect,
        'vue-autonumeric':VueAutonumeric,
    }
}
</script>