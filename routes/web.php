<?php

//disable halaman register [pendaftaran]
Auth::routes(['register' => false]);

Route::get('/',['uses'=>'FrontendController@welcome','as'=>'frontend.index']);
Route::get('/logout',['uses'=>'Auth\LoginController@logout','as'=>'logout']);

Route::group (['prefix'=>'admin','middleware'=>['disablepreventback','web', 'auth']],function() {     
    Route::get('/',['uses'=>'DashboardController@index','as'=>'dashboard.index']);
    
    // RKA Kegiatan Murni
    Route::resource('/rka/rkakegiatanmurni','RKA\RKAKegiatanMurniController',['parameters'=>['rkakegiatanmurni'=>'uuid']]); 
    Route::post('/rka/rkakegiatanmurni/search',['uses'=>'RKA\RKAKegiatanMurniController@search','as'=>'rkakegiatanmurni.search']);  
    Route::post('/rka/rkakegiatanmurni/filter',['uses'=>'RKA\RKAKegiatanMurniController@filter','as'=>'rkakegiatanmurni.filter']);              
    Route::get('/rka/rkakegiatanmurni/paginate/{id}',['uses'=>'RKA\RKAKegiatanMurniController@paginate','as'=>'rkakegiatanmurni.paginate']);              
    Route::post('/rka/rkakegiatanmurni/changenumberrecordperpage',['uses'=>'RKA\RKAKegiatanMurniController@changenumberrecordperpage','as'=>'rkakegiatanmurni.changenumberrecordperpage']);  
    Route::post('/rka/rkakegiatanmurni/orderby',['uses'=>'RKA\RKAKegiatanMurniController@orderby','as'=>'rkakegiatanmurni.orderby']); 

    // RKA realisasi Murni
    Route::resource('/rka/realisasikegiatanmurni','RKA\RKAKegiatanMurniController',['parameters'=>['realisasikegiatanmurni'=>'uuid']]); 
    Route::post('/rka/realisasikegiatanmurni/search',['uses'=>'RKA\RKAKegiatanMurniController@search','as'=>'realisasikegiatanmurni.search']);  
    Route::post('/rka/realisasikegiatanmurni/filter',['uses'=>'RKA\RKAKegiatanMurniController@filter','as'=>'realisasikegiatanmurni.filter']);              
    Route::get('/rka/realisasikegiatanmurni/paginate/{id}',['uses'=>'RKA\RKAKegiatanMurniController@paginate','as'=>'realisasikegiatanmurni.paginate']);              
    Route::post('/rka/realisasikegiatanmurni/changenumberrecordperpage',['uses'=>'RKA\RKAKegiatanMurniController@changenumberrecordperpage','as'=>'realisasikegiatanmurni.changenumberrecordperpage']);  
    Route::post('/rka/realisasikegiatanmurni/orderby',['uses'=>'RKA\RKAKegiatanMurniController@orderby','as'=>'realisasikegiatanmurni.orderby']); 
});