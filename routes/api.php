<?php
Route::get('/datadashboard', ['uses' => 'FrontendController@datadashboard', 'as' => 'datadashboard']);
Route::group (['prefix'=>'v1','middleware'=>['auth:api']],function() {         
    //masters - kelompok urusan 
    Route::resource('/master/kelompokurusan', 'DMaster\KelompokUrusanController', [
        'parameters' => ['kelompokurusan' => 'uuid'],
        'only' => ['index', 'show']
    ]);

    //masters - urusan 
    Route::resource('/master/urusan', 'DMaster\UrusanController', [
        'parameters' => ['urusan' => 'uuid'],
        'only' => ['index', 'show']
    ]);
    Route::post('/master/urusan/search',['uses'=>'DMaster\UrusanController@search','as'=>'urusan.search']);  

    //master - organisasi
    Route::resource('/master/organisasi', 'DMaster\OrganisasiController', [
        'parameters' => ['organisasi' => 'uuid'],
        'only' => ['index', 'show']
    ]);
    Route::post('/master/organisasi/search',['uses'=>'DMaster\OrganisasiController@search','as'=>'organisasi.search']);  
    Route::get('/master/organisasi/daftaropd',['uses'=>'DMaster\OrganisasiController@getdaftaropd','as'=>'organisasi.daftaropd']);
    
    //master - suborganisasi
    Route::resource('/master/suborganisasi', 'DMaster\SubOrganisasiController', [
        'parameters' => ['suborganisasi' => 'uuid'],
        'only' => ['index', 'show']
    ]);
    Route::post('/master/suborganisasi/search',['uses'=>'DMaster\SubOrganisasiController@search','as'=>'suborganisasi.search']);  
    Route::get('/master/suborganisasi/daftarunitkerja/{uuid}',['uses'=>'DMaster\SubOrganisasiController@getdaftarunitkerja','as'=>'suborganisasi.daftarunitkerja']);
    
    //masters - program 
    Route::resource('/master/program', 'DMaster\ProgramController', [
        'parameters' => ['program' => 'uuid'],
        'only' => ['index', 'show']
    ]);
    Route::post('/master/program/search',['uses'=>'DMaster\ProgramController@search','as'=>'program.search']);
    Route::post('/master/program/filter',['uses'=>'DMaster\ProgramController@filter','as'=>'program.filter']);
    
    //masters - program kegiatan
    Route::resource('/master/programkegiatan', 'DMaster\ProgramKegiatanController', [
        'parameters' => ['programkegiatan' => 'uuid'],
        'only' => ['index', 'show']
    ]);
    Route::post('/master/programkegiatan/search',['uses'=>'DMaster\ProgramKegiatanController@search','as'=>'programkegiatan.search']);
    Route::post('/master/programkegiatan/filter',['uses'=>'DMaster\ProgramKegiatanController@filter','as'=>'programkegiatan.filter']);
    
    //masters - transaksi
    Route::resource('/master/transaksi', 'DMaster\TransaksiController', [
        'parameters' => ['transaksi' => 'uuid'],
    ]);
    Route::post('/master/transaksi/search', ['uses' => 'DMaster\TransaksiController@search', 'as' => 'transaksi.search']);
    Route::post('/master/transaksi/filter', ['uses' => 'DMaster\TransaksiController@filter', 'as' => 'transaksi.filter']);
    
    //masters - kelompok
    Route::resource('/master/kelompok', 'DMaster\KelompokController', [
        'parameters' => ['kelompok' => 'uuid'],
    ]);
    Route::post('/master/kelompok/search', ['uses' => 'DMaster\KelompokController@search', 'as' => 'kelompok.search']);
    Route::post('/master/kelompok/filter', ['uses' => 'DMaster\KelompokController@filter', 'as' => 'kelompok.filter']);
    
    //masters - jenis
    Route::resource('/master/jenis', 'DMaster\JenisController', [
        'parameters' => ['jenis' => 'uuid'],
    ]);
    Route::post('/master/jenis/search', ['uses' => 'DMaster\JenisController@search', 'as' => 'jenis.search']);
    Route::post('/master/jenis/filter', ['uses' => 'DMaster\JenisController@filter', 'as' => 'jenis.filter']);
    
    //masters - rincian
    Route::resource('/master/rincian', 'DMaster\RincianController', [
        'parameters' => ['rincian' => 'uuid'],
    ]);
    Route::post('/master/rincian/search', ['uses' => 'DMaster\RincianController@search', 'as' => 'rincian.search']);
    Route::post('/master/rincian/filter', ['uses' => 'DMaster\RincianController@filter', 'as' => 'rincian.filter']);
    
    //masters - objek
    Route::resource('/master/objek', 'DMaster\ObjekController', [
        'parameters' => ['objek' => 'uuid'],
    ]);
    Route::post('/master/objek/search', ['uses' => 'DMaster\ObjekController@search', 'as' => 'objek.search']);
    Route::post('/master/objek/filter', ['uses' => 'DMaster\ObjekController@filter', 'as' => 'objek.filter']);
    
    //masters - asn [pegawai]
    Route::resource('/master/asn', 'DMaster\ASNController', [
        'parameters' => ['asn' => 'uuid'],
    ]);
    Route::post('/master/asn/search', ['uses' => 'DMaster\ASNController@search', 'as' => 'asn.search']);
    Route::post('/master/asn/filter', ['uses' => 'DMaster\ASNController@filter', 'as' => 'asn.filter']);
    
    //masters - asn opd [pegawai]
    Route::resource('/master/asnopd', 'DMaster\ASNOPDController', [
        'parameters' => ['asnopd' => 'uuid'],
    ]);
    Route::post('/master/asnopd/search', ['uses' => 'DMaster\ASNOPDController@search', 'as' => 'asnopd.search']);
    Route::post('/master/asnopd/filter', ['uses' => 'DMaster\ASNOPDController@filter', 'as' => 'asnopd.filter']);

    //master - pagu anggaran opd [lain-lain]
    Route::resource('master/paguanggaranopd','DMaster\PaguAnggaranOPDController',['parameters'=>['paguanggaranopd'=>'uuid']]);
    Route::post('/master/paguanggaranopd/search',['uses'=>'DMaster\PaguAnggaranOPDController@search','as'=>'paguanggaranopd.search']);  
    
    //masters - jenis pelaksanaan [lain-lain]
    Route::resource('/master/jenispelaksanaan', 'DMaster\JenisPelaksanaanController', [
        'parameters' => ['jenispelaksanaan' => 'uuid'],
    ]);
    Route::post('/master/jenispelaksanaan/search', ['uses' => 'DMaster\JenisPelaksanaanController@search', 'as' => 'jenispelaksanaan.search']);
    
    //masters - jenis pembangunan [lain-lain]
    Route::resource('/master/jenispembangunan', 'DMaster\JenisPembangunanController', [
        'parameters' => ['jenispembangunan' => 'uuid'],
    ]);
    Route::post('/master/jenispembangunan/search', ['uses' => 'DMaster\JenisPembangunanController@search', 'as' => 'jenispembangunan.search']);
    Route::get('/master/jenispembangunan/daftar_jenispembangunan/{ta}', ['uses' => 'DMaster\JenisPembangunanController@getDaftarJenisPembangunan', 'as' => 'jenispembangunan.daftar_jenispembangunan']);
    
    //masters - urusan 
    Route::resource('/master/sumberdana', 'DMaster\SumberDanaController', [
        'parameters' => ['sumberdana' => 'uuid'],
        'only' => ['index', 'show']
    ]);
    Route::post('/master/sumberdana/search',['uses'=>'DMaster\SumberDanaController@search','as'=>'sumberdana.search']);  

    //RKA - APBD Murni
    Route::resource('/apbdmurni','RKA\APBDMurniController',['parameters'=>['apbdmurni'=>'uuid']]);
    Route::get('/apbdmurni/uraian/rencanatarget/{uuid}',['uses'=>'RKA\APBDMurniController@rencanatarget','as'=>'apbdmurni.rencanatarget']);  
    Route::get('/apbdmurni/uraian/realisasi/{uuid}',['uses'=>'RKA\APBDMurniController@realisasi','as'=>'apbdmurni.realisasi']);  
    Route::get('/apbdmurni/uraian/info/{uuid}',['uses'=>'RKA\APBDMurniController@infouraian','as'=>'apbdmurni.infouraian']);  
    Route::post('/apbdmurni/filter',['uses'=>'RKA\APBDMurniController@filter','as'=>'apbdmurni.filter']);  
    Route::get('/apbdmurni/create1',['uses'=>'RKA\APBDMurniController@create1','as'=>'apbdmurni.create1']);  
    Route::get('/apbdmurni/create2',['uses'=>'RKA\APBDMurniController@create2','as'=>'apbdmurni.create2']);  
    Route::get('/apbdmurni/create3/{uuid}',['uses'=>'RKA\APBDMurniController@create3','as'=>'apbdmurni.create3']);  
    Route::get('/apbdmurni/create4/{uuid}',['uses'=>'RKA\APBDMurniController@create4','as'=>'apbdmurni.create4']);  
    Route::post('/apbdmurni/changerekening',['uses'=>'RKA\APBDMurniController@changerekening','as'=>'apbdmurni.changerekening']);
    Route::post('/apbdmurni/store2',['uses'=>'RKA\APBDMurniController@store2','as'=>'apbdmurni.store2']);                      
    Route::post('/apbdmurni/store3',['uses'=>'RKA\APBDMurniController@store3','as'=>'apbdmurni.store3']);  
    Route::post('/apbdmurni/store4',['uses'=>'RKA\APBDMurniController@store4','as'=>'apbdmurni.store4']);      
    Route::get('/apbdmurni/{uuid}/edit3/',['uses'=>'RKA\APBDMurniController@edit3','as'=>'apbdmurni.edit3']);  
    Route::put('/apbdmurni/update/{uuid}',['uses'=>'RKA\APBDMurniController@update','as'=>'apbdmurni.update']);                      
    Route::post('/apbdmurni/update2/{uuid}',['uses'=>'RKA\APBDMurniController@update2','as'=>'apbdmurni.update2']);                      
    Route::post('/apbdmurni/update3',['uses'=>'RKA\APBDMurniController@update3','as'=>'apbdmurni.update3']);                      
    Route::post('/apbdmurni/update4/{uuid}',['uses'=>'RKA\APBDMurniController@update4','as'=>'apbdmurni.update4']);                      
    Route::get('/apbdmurni/totaluraian/{uuid}',['uses'=>'RKA\APBDMurniController@totaluraian','as'=>'apbdmurni.totaluraian']);  

    //RKA - APBD Perubahan
    Route::resource('/apbdperubahan','RKA\APBDPerubahanController',['parameters'=>['apbdperubahan'=>'uuid']]);
    Route::get('/apbdperubahan/uraian/rencanatarget/{uuid}',['uses'=>'RKA\APBDPerubahanController@rencanatarget','as'=>'apbdperubahan.rencanatarget']);  
    Route::get('/apbdperubahan/uraian/realisasi/{uuid}',['uses'=>'RKA\APBDPerubahanController@realisasi','as'=>'apbdperubahan.realisasi']);  
    Route::get('/apbdperubahan/uraian/info/{uuid}',['uses'=>'RKA\APBDPerubahanController@infouraian','as'=>'apbdperubahan.infouraian']);  
    Route::post('/apbdperubahan/filter',['uses'=>'RKA\APBDPerubahanController@filter','as'=>'apbdperubahan.filter']);  
    Route::get('/apbdperubahan/create1',['uses'=>'RKA\APBDPerubahanController@create1','as'=>'apbdperubahan.create1']);  
    Route::get('/apbdperubahan/create2',['uses'=>'RKA\APBDPerubahanController@create2','as'=>'apbdperubahan.create2']);  
    Route::get('/apbdperubahan/create3/{uuid}',['uses'=>'RKA\APBDPerubahanController@create3','as'=>'apbdperubahan.create3']);  
    Route::get('/apbdperubahan/create4/{uuid}',['uses'=>'RKA\APBDPerubahanController@create4','as'=>'apbdperubahan.create4']);  
    Route::post('/apbdperubahan/changerekening',['uses'=>'RKA\APBDPerubahanController@changerekening','as'=>'apbdperubahan.changerekening']);
    Route::post('/apbdperubahan/store2',['uses'=>'RKA\APBDPerubahanController@store2','as'=>'apbdperubahan.store2']);                      
    Route::post('/apbdperubahan/store3',['uses'=>'RKA\APBDPerubahanController@store3','as'=>'apbdperubahan.store3']);  
    Route::post('/apbdperubahan/store4',['uses'=>'RKA\APBDPerubahanController@store4','as'=>'apbdperubahan.store4']);      
    Route::get('/apbdperubahan/{uuid}/edit3/',['uses'=>'RKA\APBDPerubahanController@edit3','as'=>'apbdperubahan.edit3']);  
    Route::put('/apbdperubahan/update/{uuid}',['uses'=>'RKA\APBDPerubahanController@update','as'=>'apbdperubahan.update']);                      
    Route::post('/apbdperubahan/update2/{uuid}',['uses'=>'RKA\APBDPerubahanController@update2','as'=>'apbdperubahan.update2']);                      
    Route::post('/apbdperubahan/update3',['uses'=>'RKA\APBDPerubahanController@update3','as'=>'apbdperubahan.update3']);                      
    Route::post('/apbdperubahan/update4/{uuid}',['uses'=>'RKA\APBDPerubahanController@update4','as'=>'apbdperubahan.update4']);
    Route::get('/apbdperubahan/totaluraian/{uuid}',['uses'=>'RKA\APBDPerubahanController@totaluraian','as'=>'apbdperubahan.totaluraian']);  

    //REPORT - Form A Murni
    Route::post('/report/formamurni', ['uses'=>'Report\FormAMurniController@index', 'as'=>'formamurni.index']);
    Route::post('/report/formamurni/printtoexcel', ['uses'=>'Report\FormAMurniController@printtoexcel', 'as'=>'formamurni.printtoexcel']);

    //REPORT - Form B Murni
    Route::post('/report/formbmurni', ['uses'=>'Report\FormBMurniController@index', 'as'=>'formbmurni.index']);
    Route::post('/report/formbmurni/printtoexcel', ['uses'=>'Report\FormBMurniController@printtoexcel', 'as'=>'formbmurni.printtoexcel']);

    //REPORT - Evaluasi RKPD Murni
    Route::post('/report/reportevaluasirkpdmurni', ['uses'=>'Report\EvaluasiRKPDMurniController@index', 'as'=>'reportevaluasirkpdmurni.index']);
    Route::get('/report/reportevaluasirkpdmurni/populatedata', ['uses'=>'Report\EvaluasiRKPDMurniController@populatedata', 'as'=>'reportevaluasirkpdmurni.populatedata']);
    
    //setting - app configuration
    Route::resource('/setting/config','Setting\ConfigController',['parameters'=>['config'=>'uuid']]);
    Route::get('/setting/config/all',['uses'=>'Setting\ConfigController@all','as'=>'config.all']);
    
});