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
    Route::get('master/organisasi/daftaropd',['uses'=>'DMaster\OrganisasiController@getdaftaropd','as'=>'organisasi.daftaropd']);
    
    //master - suborganisasi
    Route::resource('/master/suborganisasi', 'DMaster\SubOrganisasiController', [
        'parameters' => ['suborganisasi' => 'uuid'],
        'only' => ['index', 'show']
    ]);
    Route::post('/master/suborganisasi/search',['uses'=>'DMaster\SubOrganisasiController@search','as'=>'suborganisasi.search']);  
    Route::get('master/suborganisasi/daftarunitkerja',['uses'=>'DMaster\SubOrganisasiController@getdaftarunitkerja','as'=>'suborganisasi.daftarunitkerja']);
    
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


});