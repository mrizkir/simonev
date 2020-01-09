<template>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark">
                        <i class="nav-icon fas fa-cart-arrow-down"></i>
                        APBD PERUBAHAN
                    </h1>
                </div>
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><router-link to="/">HOME</router-link></li>
                        <li class="breadcrumb-item"><router-link to="/apbdperubahan">APBD PERUBAHAN</router-link></li>
                        <li class="breadcrumb-item"><router-link to="/apbdperubahan/uraian">URAIAN</router-link></li>
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
                                            <p class="form-control-static">{{detailkegiatan.PaguDana2|formatUang}}</p>
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
                                            @input="fetchPaguUraian" 
											v-bind:class="{'is-invalid': $v.form.RKARincID.$error, 'is-valid': $v.form.RKARincID.$dirty && !$v.form.RKARincID.$invalid}">
                                        </v-select>
										<div class="text-danger" v-if="$v.form.RKARincID.$error">* Mohon dipilih Rincian Kegiatan</div>
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">PAGU URAIAN :</label> 
                                    <div class="col-md-9">
                                        <p class="form-control-static">                                            
                                            {{form.pagu_uraian|formatUang}}
                                        </p>                                        
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
                                                <span class="text-danger" v-if="$v.form.totalTargetFisik.$error">* Tidak boleh melampaui dan kurang dari 100</span>							
                                            </td>
                                            <td>
                                                {{form.totalTargetAnggaranKas|formatUang}}			
                                                <span class="text-danger" v-if="$v.form.totalTargetAnggaranKas.$error">* Tidak boleh melampaui dan kurang dari {{form.pagu_uraian|formatUang}}</span>							
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
            <div class="row" v-if="pid=='edit'">
				<div class="col-12">
                    <!-- Horizontal Form -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-plus"></i> UBAH TARGET FISIK
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
                                    <label class="col-md-3 col-form-label">RINCIAN KEGIATAN :</label> 
                                    <div class="col-md-9">
                                        <p class="form-control-static">                                            
                                            [{{form.kode_rek_5}}] {{form.nama_uraian}}
                                        </p>                                        
                                    </div>
                                </div>   
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">PAGU URAIAN :</label> 
                                    <div class="col-md-9">
                                        <p class="form-control-static">                                            
                                            {{form.pagu_uraian|formatUang}}
                                        </p>                                        
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
                                                <span class="text-danger" v-if="$v.form.totalTargetFisik.$error">* Tidak boleh melampaui dan kurang dari 100</span>							
                                            </td>
                                            <td>
                                                {{form.totalTargetAnggaranKas|formatUang}}			
                                                <span class="text-danger" v-if="$v.form.totalTargetAnggaranKas.$error">* Tidak boleh melampaui dan kurang dari {{form.pagu_uraian|formatUang}}</span>							
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
                                <i class="fas fa-list-ol"></i>  DAFTAR RENCANA TARGET FISIK
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" v-on:click.prevent="proc('create')" title="Tambah Rencana Target Fisik dan Anggaran Kas">
                                    <i class="fas fa-plus"></i>
                                </button>                                
                                <router-link to="/apbdperubahan/uraian" class="btn btn-tool">
                                    <i class="fas fa-times"></i>
                                </router-link>                                
                            </div>       
                        </div>
                        <div class="card-body table-responsive p-0" v-if="daftar_targetfisik.length">
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
                                        <th width="80">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>  
                                    <tr v-for="item in daftar_targetfisik" v-bind:key="item.RKARincID">
                                        <td>{{ item.kode_rek_5 }}</td>                
                                        <td>
                                            {{ item.nama_uraian }}<br>
                                            [<em>{{ item.pagu_uraian2|formatUang }}</em>]
                                        </td>
                                        <td>{{ item.fisik_1 }}</td>
                                        <td>{{ item.fisik_2 }}</td>
                                        <td>{{ item.fisik_3 }}</td>
                                        <td>{{ item.fisik_4 }}</td>
                                        <td>{{ item.fisik_5 }}</td>
                                        <td>{{ item.fisik_6 }}</td>
                                        <td>{{ item.fisik_7 }}</td>
                                        <td>{{ item.fisik_8 }}</td>
                                        <td>{{ item.fisik_9 }}</td>
                                        <td>{{ item.fisik_10 }}</td>
                                        <td>{{ item.fisik_11 }}</td>
                                        <td>{{ item.fisik_12 }}</td> 
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-wrench"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">                                                    
                                                    <a class="dropdown-item" href="#" v-on:click.prevent="proc('edit',item)">
                                                        <i class="fas fa-edit"></i> UBAH
                                                    </a>
                                                    <a class="dropdown-item" v-on:click.prevent="proc('destroy',item)" href="#">
                                                        <i class="fas fa-trash-alt"></i> HAPUS
                                                    </a>
                                                </div>
                                            </div>
                                        </td>          
                                    </tr>
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-list-ol"></i>  DAFTAR RENCANA TARGET ANGGARAN KAS
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" v-on:click.prevent="proc('create')" title="Tambah Rencana Target Fisik dan Anggaran Kas">
                                    <i class="fas fa-plus"></i>
                                </button>                                
                                <router-link to="/apbdperubahan/uraian" class="btn btn-tool">
                                    <i class="fas fa-times"></i>
                                </router-link>                                
                            </div>       
                        </div>
                        <div class="card-body table-responsive p-0" v-if="daftar_targetanggarankas.length">
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
                                        <th width="80">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>  
                                    <tr v-for="item in daftar_targetanggarankas" v-bind:key="item.RKARincID">
                                        <td>{{ item.kode_rek_5 }}</td>                
                                        <td>
                                            {{ item.nama_uraian }}<br>
                                            [<em>{{ item.pagu_uraian2|formatUang }}</em>]
                                        </td>
                                        <td>{{ item.anggaran_1|formatUang() }}</td>
                                        <td>{{ item.anggaran_2|formatUang() }}</td>
                                        <td>{{ item.anggaran_3|formatUang() }}</td>
                                        <td>{{ item.anggaran_4|formatUang() }}</td>
                                        <td>{{ item.anggaran_5|formatUang() }}</td>
                                        <td>{{ item.anggaran_6|formatUang() }}</td>
                                        <td>{{ item.anggaran_7|formatUang() }}</td>
                                        <td>{{ item.anggaran_8|formatUang() }}</td>
                                        <td>{{ item.anggaran_9|formatUang() }}</td>
                                        <td>{{ item.anggaran_10|formatUang() }}</td>
                                        <td>{{ item.anggaran_11|formatUang() }}</td>
                                        <td>{{ item.anggaran_12|formatUang() }}</td> 
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-wrench"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">                                                    
                                                    <a class="dropdown-item" href="#" v-on:click.prevent="proc('edit',item)">
                                                        <i class="fas fa-edit"></i> UBAH
                                                    </a>
                                                    <a class="dropdown-item" v-on:click.prevent="proc('destroy',item)" href="#">
                                                        <i class="fas fa-trash-alt"></i> HAPUS
                                                    </a>
                                                </div>
                                            </div>
                                        </td>          
                                    </tr>
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
                        <router-link to="/apbdperubahan" class="close">
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

const checkTotalFisik = (value) => {
    return value == 100;
};
const checkTotalAnggaranKas = (value,vm) => {    
    return value==vm.pagu_uraian;
};

export default {
    created ()
    {
        var page = this.$store.getters.getPage('apbdperubahan');
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
            daftar_targetfisik:{},
            daftar_targetanggarankas:{},

            //form			            
            daftar_rinciankegiatan: [],           
			form: {		
                RKARincID:'',
                kode_rek_5:'',
                nama_uraian:'',
                pagu_uraian:0,                
                targetfisik:[0,0,0,0,0,0,0,0,0,0,0,0],
                targetanggarankas:[0,0,0,0,0,0,0,0,0,0,0,0],
                totalTargetFisik:0,
                totalTargetAnggaranKas:0,
            }
        }
    },
    methods: 
    {	
        populateData(page=1)
        {           
            axios.get('/api/v1/apbdperubahan/uraian/rencanatarget/'+this.detailkegiatan.RKAID,{
                headers:{
                    'Authorization': window.laravel.api_token,
                }
            })
            .then(response => {                                        
                this.daftar_targetfisik=response.data.targetfisik;     
                this.daftar_targetanggarankas=response.data.anggarankas;     
            })
            .catch(response => {
                this.api_message = response;
            }); 
        },
        fetchPaguUraian ()
        {
            axios.post('/api/v1/apbdperubahan/changerekening',
                {
                    'pid':'tambahrencana',
                    'RKARincID':this.form.RKARincID
                },
                {
                    headers:{
                        'Authorization': window.laravel.api_token,
                    }
                }
            )
            .then(response => {                                                                
                this.form.pagu_uraian=parseFloat(response.data.pagu_uraian2);
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
                    this.form.pagu_uraian=0;                 
                    axios.get('/api/v1/apbdperubahan/create3/'+this.detailkegiatan.RKAID,{
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
                case 'edit' :
                    this.pid=pid;               
                    this.form.RKARincID=item.RKARincID;                      
                    this.form.pagu_uraian=item.pagu_uraian2;                      
                    axios.get('/api/v1/apbdperubahan/'+item.RKARincID+'/edit3',{
                        headers:{
                            'Authorization': window.laravel.api_token,
                        }
                    })
                    .then(response => {          
                        var data = response.data; 
                        this.form.kode_rek_5=item.kode_rek_5;
                        this.form.nama_uraian=item.nama_uraian;                           
                        this.form.targetfisik[0]=parseFloat(data.fisik_1);
                        this.form.targetfisik[1]=parseFloat(data.fisik_2);
                        this.form.targetfisik[2]=parseFloat(data.fisik_3);
                        this.form.targetfisik[3]=parseFloat(data.fisik_4);
                        this.form.targetfisik[4]=parseFloat(data.fisik_5);
                        this.form.targetfisik[5]=parseFloat(data.fisik_6);
                        this.form.targetfisik[6]=parseFloat(data.fisik_7);
                        this.form.targetfisik[7]=parseFloat(data.fisik_8);
                        this.form.targetfisik[8]=parseFloat(data.fisik_9);
                        this.form.targetfisik[9]=parseFloat(data.fisik_10);
                        this.form.targetfisik[10]=parseFloat(data.fisik_11);
                        this.form.targetfisik[11]=parseFloat(data.fisik_12);   
                        
                        this.form.targetanggarankas[0]=parseFloat(data.anggaran_1);
                        this.form.targetanggarankas[1]=parseFloat(data.anggaran_2);
                        this.form.targetanggarankas[2]=parseFloat(data.anggaran_3);
                        this.form.targetanggarankas[3]=parseFloat(data.anggaran_4);
                        this.form.targetanggarankas[4]=parseFloat(data.anggaran_5);
                        this.form.targetanggarankas[5]=parseFloat(data.anggaran_6);
                        this.form.targetanggarankas[6]=parseFloat(data.anggaran_7);
                        this.form.targetanggarankas[7]=parseFloat(data.anggaran_8);
                        this.form.targetanggarankas[8]=parseFloat(data.anggaran_9);
                        this.form.targetanggarankas[9]=parseFloat(data.anggaran_10);
                        this.form.targetanggarankas[10]=parseFloat(data.anggaran_11);
                        this.form.targetanggarankas[11]=parseFloat(data.anggaran_12);   
                    })
                    .catch(response => {
                        this.api_message = response;
                    });
                break;
                case 'destroy':
                    var self = this;
                    this.$swal({
                        title: 'Yakin mau menghapus?',
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
                            axios.post('/api/v1/apbdperubahan/'+item.RKARincID,{
                                '_method':'DELETE',
                                'pid':'datarencana'
                            },{
                                headers:{
                                    'Authorization': window.laravel.api_token,
                                },
                            })
                            .then(response => {                                                          
                                self.proc('default');                                                                    
                            })
                            .catch(response => {
                                self.api_message = response;                               
                            });                                  
                        }
                    });                                      
                break;
                default :
                    this.pid = pid;
                    if (this.detailkegiatan.hasOwnProperty('RKAID'))
                    {
                        this.populateData();                        
                    }                    
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
                axios.post('/api/v1/apbdperubahan/store3',{                   
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
                axios.post('/api/v1/apbdperubahan/update3',{                   
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
                        text: "Mengubah Data Rencana Target Fisik dan Anggaran Kas Rincian Kegiatan berhasil dilakukan",
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
            this.form.RKARincID='';
            this.form.kode_rek_5='';
            this.form.nama_uraian='';
            this.form.targetfisik=[0,0,0,0,0,0,0,0,0,0,0,0];
            this.form.targetanggarankas=[0,0,0,0,0,0,0,0,0,0,0,0];
            this.form.totalTargetFisik=0;
            this.form.totalTargetAnggaranKas=0;            
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