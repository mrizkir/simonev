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

    //master - pagu anggaran opd
    Route::resource('master/paguanggaranopd','DMaster\PaguAnggaranOPDController',['parameters'=>['paguanggaranopd'=>'uuid']]);
    Route::post('/master/paguanggaranopd/search',['uses'=>'DMaster\PaguAnggaranOPDController@search','as'=>'paguanggaranopd.search']);  
    
});