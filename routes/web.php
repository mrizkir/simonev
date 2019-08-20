<?php

//disable halaman register [pendaftaran]
Auth::routes(['register' => false]);

Route::get('/',['uses'=>'FrontendController@welcome','as'=>'frontend.index']);
Route::get('/logout',['uses'=>'Auth\LoginController@logout','as'=>'logout']);

Route::group (['prefix'=>'admin','middleware'=>['disablepreventback','web', 'auth']],function() {     
    Route::get('/',['uses'=>'DashboardController@index','as'=>'dashboard.index']);
    
    //masters - data kelompok urusan [data]
    Route::resource('/dmaster/kelompokurusan','DMaster\KelompokUrusanController',[
                                                                                    'parameters'=>['kelompokurusan'=>'uuid'],
                                                                                    'only'=>['index','show']
                                                                                ]); 
    Route::get('/dmaster/kelompokurusan/paginate/{id}',['uses'=>'DMaster\KelompokUrusanController@paginate','as'=>'kelompokurusan.paginate']);              
    Route::post('/dmaster/kelompokurusan/changenumberrecordperpage',['uses'=>'DMaster\KelompokUrusanController@changenumberrecordperpage','as'=>'kelompokurusan.changenumberrecordperpage']);  
    Route::post('/dmaster/kelompokurusan/orderby',['uses'=>'DMaster\KelompokUrusanController@orderby','as'=>'kelompokurusan.orderby']); 

    //masters - data urusan [data]
    Route::resource('/dmaster/urusan','DMaster\UrusanController',[
                                                                    'parameters'=>['urusan'=>'uuid'],
                                                                    'only'=>['index','show']
                                                                ]); 
    Route::post('/dmaster/urusan/search',['uses'=>'DMaster\UrusanController@search','as'=>'urusan.search']);          
    Route::get('/dmaster/urusan/paginate/{id}',['uses'=>'DMaster\UrusanController@paginate','as'=>'urusan.paginate']);              
    Route::post('/dmaster/urusan/changenumberrecordperpage',['uses'=>'DMaster\UrusanController@changenumberrecordperpage','as'=>'urusan.changenumberrecordperpage']);  
    Route::post('/dmaster/urusan/orderby',['uses'=>'DMaster\UrusanController@orderby','as'=>'urusan.orderby']);  

    //masters - data organisasi (OPD / SKPD) [data]
    Route::resource('/dmaster/organisasi','DMaster\OrganisasiController',[
                                                                            'parameters'=>['organisasi'=>'uuid'],
                                                                            'only'=>['index','show']
                                                                        ]); 
    Route::post('/dmaster/organisasi/search',['uses'=>'DMaster\OrganisasiController@search','as'=>'organisasi.search']);  
    Route::post('/dmaster/organisasi/filter',['uses'=>'DMaster\OrganisasiController@filter','as'=>'organisasi.filter']);           
    Route::get('/dmaster/organisasi/paginate/{id}',['uses'=>'DMaster\OrganisasiController@paginate','as'=>'organisasi.paginate']);              
    Route::post('/dmaster/organisasi/changenumberrecordperpage',['uses'=>'DMaster\OrganisasiController@changenumberrecordperpage','as'=>'organisasi.changenumberrecordperpage']);  
    Route::post('/dmaster/organisasi/orderby',['uses'=>'DMaster\OrganisasiController@orderby','as'=>'organisasi.orderby']);

    //masters - data sub organisasi (Unit Kerja) [data]
    Route::resource('/dmaster/suborganisasi','DMaster\SubOrganisasiController',[
                                                                                'parameters'=>['suborganisasi'=>'uuid'],
                                                                                'only'=>['index','show']
                                                                            ]); 
    Route::post('/dmaster/suborganisasi/search',['uses'=>'DMaster\SubOrganisasiController@search','as'=>'suborganisasi.search']);  
    Route::post('/dmaster/suborganisasi/filter',['uses'=>'DMaster\SubOrganisasiController@filter','as'=>'suborganisasi.filter']);           
    Route::get('/dmaster/suborganisasi/paginate/{id}',['uses'=>'DMaster\SubOrganisasiController@paginate','as'=>'suborganisasi.paginate']);              
    Route::post('/dmaster/suborganisasi/changenumberrecordperpage',['uses'=>'DMaster\SubOrganisasiController@changenumberrecordperpage','as'=>'suborganisasi.changenumberrecordperpage']);  
    Route::post('/dmaster/suborganisasi/orderby',['uses'=>'DMaster\SubOrganisasiController@orderby','as'=>'suborganisasi.orderby']);

    //masters - data program  [data]
    Route::resource('/dmaster/program','DMaster\ProgramController',[
                                                                    'parameters'=>['program'=>'uuid'],
                                                                    'only'=>['index','show']
                                                                ]); 
    Route::post('/dmaster/program/search',['uses'=>'DMaster\ProgramController@search','as'=>'program.search']);  
    Route::post('/dmaster/program/filter',['uses'=>'DMaster\ProgramController@filter','as'=>'program.filter']);           
    Route::get('/dmaster/program/paginate/{id}',['uses'=>'DMaster\ProgramController@paginate','as'=>'program.paginate']);              
    Route::post('/dmaster/program/changenumberrecordperpage',['uses'=>'DMaster\ProgramController@changenumberrecordperpage','as'=>'program.changenumberrecordperpage']);  
    Route::post('/dmaster/program/orderby',['uses'=>'DMaster\ProgramController@orderby','as'=>'program.orderby']);  

    //masters - data program kegiatan [data]
    Route::resource('/dmaster/programkegiatan','DMaster\ProgramKegiatanController',[
                                                                                    'parameters'=>['programkegiatan'=>'uuid'],
                                                                                    'only'=>['index','show']
                                                                                ]); 
    Route::post('/dmaster/programkegiatan/search',['uses'=>'DMaster\ProgramKegiatanController@search','as'=>'kegiatan.search']);  
    Route::post('/dmaster/programkegiatan/filter',['uses'=>'DMaster\ProgramKegiatanController@filter','as'=>'kegiatan.filter']);              
    Route::get('/dmaster/programkegiatan/paginate/{id}',['uses'=>'DMaster\ProgramKegiatanController@paginate','as'=>'kegiatan.paginate']);              
    Route::post('/dmaster/programkegiatan/changenumberrecordperpage',['uses'=>'DMaster\ProgramKegiatanController@changenumberrecordperpage','as'=>'kegiatan.changenumberrecordperpage']);  
    Route::post('/dmaster/programkegiatan/orderby',['uses'=>'DMaster\ProgramKegiatanController@orderby','as'=>'kegiatan.orderby']);  
    
    //masters - mapping program ke OPD [mapping]
    Route::resource('/dmaster/mappingprogramtoopd','DMaster\MappingProgramToOPDController',[
                                                                                            'parameters'=>['mappingprogramtoopd'=>'uuid'],
                                                                                            'only'=>['index','show']
                                                                                        ]); 
    Route::post('/dmaster/mappingprogramtoopd/search',['uses'=>'DMaster\MappingProgramToOPDController@search','as'=>'mappingprogramtoopd.search']);  
    Route::post('/dmaster/mappingprogramtoopd/filter',['uses'=>'DMaster\MappingProgramToOPDController@filter','as'=>'mappingprogramtoopd.filter']);           
    Route::post('/dmaster/mappingprogramtoopd/filtercreate',['uses'=>'DMaster\MappingProgramToOPDController@filtercreate','as'=>'mappingprogramtoopd.filtercreate']);           
    Route::get('/dmaster/mappingprogramtoopd/paginate/{id}',['uses'=>'DMaster\MappingProgramToOPDController@paginate','as'=>'mappingprogramtoopd.paginate']);                  
    Route::post('/dmaster/mappingprogramtoopd/orderby',['uses'=>'DMaster\MappingProgramToOPDController@orderby','as'=>'mappingprogramtoopd.orderby']);  

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