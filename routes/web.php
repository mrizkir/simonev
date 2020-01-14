<?php

//disable halaman register [pendaftaran]
Auth::routes(['register' => false]);

Route::get('/', ['uses' => 'FrontendController@index', 'as' => 'frontend.index']);
Route::get('/logout', ['uses' => 'Auth\LoginController@logout', 'as' => 'logout']);

Route::group(['prefix' => 'admin', 'middleware' => ['disablepreventback', 'web', 'auth']], function () {
    Route::get('/', ['uses' => 'BackendController@index', 'as' => 'backend.index']); 
});
