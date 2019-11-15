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

    //master - pagu anggaran opd
    Route::resource('master/paguanggaranopd','DMaster\PaguAnggaranOPDController',['parameters'=>['paguanggaranopd'=>'uuid']]);
    Route::post('/master/paguanggaranopd/search',['uses'=>'DMaster\PaguAnggaranOPDController@search','as'=>'paguanggaranopd.search']);  
    

});