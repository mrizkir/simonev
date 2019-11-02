<?php
Route::get('/datadashboard', ['uses' => 'FrontendController@datadashboard', 'as' => 'api.datadashboard']);
Route::group (['prefix'=>'v1','middleware'=>['auth:api']],function() {     
    Route::resource('master/paguanggaranopd','DMaster\PaguAnggaranOPDController',['parameters'=>['paguanggaranopd'=>'uuid']]);
});