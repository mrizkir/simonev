<?php
Route::get('/datadashboard', ['uses' => 'FrontendController@datadashboard', 'as' => 'datadashboard']);
Route::group (['prefix'=>'v1','middleware'=>['auth:api']],function() {     
    //master - organisasi
    Route::get('master/organisasi/daftaropd',['uses'=>'DMaster\OrganisasiController@getdaftaropd','as'=>'organisasi.daftaropd']);

    //master - pagu anggaran opd
    Route::resource('master/paguanggaranopd','DMaster\PaguAnggaranOPDController',['parameters'=>['paguanggaranopd'=>'uuid']]);
    
});