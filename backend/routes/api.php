<?php
$router->get('/', function () use ($router) {
    $res=[
            'status'=>1,
            'pid'=>'fetchdata',
            'message'=>'SIMONEV API Micro-Service',            
        ];

    return response()->json($res);
});
$router->group(['prefix'=>'v1'], function () use ($router)
{
    //dashboard
    $router->post('/dashboard/front',['uses'=>'DashboardController@indexfront','as'=>'dashboard.indexfront']);

    //dmaster - ta
    $router->get('/dmaster/ta',['uses'=>'DMaster\TAController@index','as'=>'ta.index']);

    //auth login
    $router->post('/auth/login',['uses'=>'AuthController@login','as'=>'auth.login']);
    
    //provinsi -data master
    $router->get('/dmaster/provinsi',['uses'=>'DMaster\ProvinsiController@index','as'=>'provinsi.index']);        
    $router->get('/dmaster/provinsi/{id}/kota',['uses'=>'DMaster\ProvinsiController@kotaprovinsi','as'=>'provinsi.kotaprovinsi']);  

    //kota -data master
    $router->get('/dmaster/kota',['uses'=>'DMaster\KotaController@index','as'=>'kota.index']);        
    $router->get('/dmaster/kota/{id}/kecamatan',['uses'=>'DMaster\KotaController@kecamatankota','as'=>'kota.kecamatankota']);        
    
    //kecamatan -data master
    $router->get('/dmaster/kecamatan',['uses'=>'DMaster\KecamatanController@index','as'=>'kecamatan.index']);        
    $router->get('/dmaster/kecamatan/{id}/desa',['uses'=>'DMaster\KecamatanController@desakecamatan','as'=>'kecamatan.desakecamatan']);        
    
    //uifront
    $router->get('/setting/uifront',['uses'=>'Settings\UIController@frontend','as'=>'ui.frontend']);

});
$router->group(['prefix'=>'v1','middleware'=>'auth:api'], function () use ($router)
{
    //authentication
    $router->post('/auth/logout',['uses'=>'AuthController@logout','as'=>'auth.logout']);
    $router->get('/auth/refresh',['uses'=>'AuthController@refresh','as'=>'auth.refresh']);
    $router->get('/auth/me',['uses'=>'AuthController@me','as'=>'auth.me']);

    //data master - rekening - transaksi
    $router->post('/dmaster/rekening/transaksi',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'DMaster\TransaksiController@index','as'=>'rekening.transaksi.index']);    
    $router->post('/dmaster/rekening/transaksi/store',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\TransaksiController@store','as'=>'rekening.transaksi.store']);
    $router->put('/dmaster/rekening/transaksi/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\TransaksiController@update','as'=>'rekening.transaksi.update']);
    $router->delete('/dmaster/rekening/transaksi/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\TransaksiController@destroy','as'=>'rekening.transaksi.destroy']);    

    //data master - rekening - kelompok
    $router->post('/dmaster/rekening/kelompok',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'DMaster\KelompokController@index','as'=>'rekening.kelompok.index']);    
    $router->post('/dmaster/rekening/kelompok/store',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\KelompokController@store','as'=>'rekening.kelompok.store']);
    $router->put('/dmaster/rekening/kelompok/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\KelompokController@update','as'=>'rekening.kelompok.update']);
    $router->delete('/dmaster/rekening/kelompok/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\KelompokController@destroy','as'=>'rekening.kelompok.destroy']);
    
    //data master - rekening - jenis
    $router->post('/dmaster/rekening/jenis',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'DMaster\JenisController@index','as'=>'rekening.jenis.index']);    
    $router->post('/dmaster/rekening/jenis/store',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\JenisController@store','as'=>'rekening.jenis.store']);
    $router->put('/dmaster/rekening/jenis/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\JenisController@update','as'=>'rekening.jenis.update']);
    $router->delete('/dmaster/rekening/jenis/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\JenisController@destroy','as'=>'rekening.jenis.destroy']);
    
    //data master - rekening - rincian
    $router->post('/dmaster/rekening/rincian',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'DMaster\RincianController@index','as'=>'rekening.rincian.index']);    
    $router->post('/dmaster/rekening/rincian/store',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\RincianController@store','as'=>'rekening.rincian.store']);
    $router->put('/dmaster/rekening/rincian/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\RincianController@update','as'=>'rekening.rincian.update']);
    $router->delete('/dmaster/rekening/rincian/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\RincianController@destroy','as'=>'rekening.rincian.destroy']);
    
    //data master - rekening - objek
    $router->post('/dmaster/rekening/objek',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'DMaster\ObjekController@index','as'=>'rekening.objek.index']);    
    $router->post('/dmaster/rekening/objek/store',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\ObjekController@store','as'=>'rekening.objek.store']);
    $router->put('/dmaster/rekening/objek/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\ObjekController@update','as'=>'rekening.objek.update']);
    $router->delete('/dmaster/rekening/objek/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\ObjekController@destroy','as'=>'rekening.objek.destroy']);
    
    //data master - opd
    $router->post('/dmaster/opd',['uses'=>'DMaster\OrganisasiController@index','as'=>'opd.index']);    
    $router->post('/dmaster/opd/loadopd',['middleware'=>['role:superadmin'],'uses'=>'DMaster\OrganisasiController@loadopd','as'=>'opd.loadopd']);    
    $router->post('/dmaster/opd/loadpaguapbdp',['middleware'=>['role:superadmin'],'uses'=>'DMaster\OrganisasiController@loadpaguapbdp','as'=>'opd.loadpaguapbdp']);    
    $router->put('/dmaster/opd/{id}',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'DMaster\OrganisasiController@update','as'=>'opd.update']);
    $router->get('/dmaster/opd/{id}/unitkerja',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'DMaster\OrganisasiController@opdunitkerja','as'=>'opd.unitkerja']);
    $router->get('/dmaster/opd/{id}/pejabat',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'DMaster\OrganisasiController@pejabatopd','as'=>'opd.pejabatopd']);
    
    //data master - unit kerja
    $router->post('/dmaster/unitkerja',['uses'=>'DMaster\SubOrganisasiController@index','as'=>'unitkerja.index']);    
    $router->post('/dmaster/unitkerja/loadunitkerja',['middleware'=>['role:superadmin'],'uses'=>'DMaster\SubOrganisasiController@loadunitkerja','as'=>'unitkerja.loadunitkerja']);    
    $router->post('/dmaster/unitkerja/loadpaguapbdp',['middleware'=>['role:superadmin'],'uses'=>'DMaster\SubOrganisasiController@loadpaguapbdp','as'=>'opd.loadpaguapbdp']);    
    $router->put('/dmaster/unitkerja/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|unitkerja'],'uses'=>'DMaster\SubOrganisasiController@update','as'=>'unitkerja.update']);
    
    //data master - kegiatan - kelompok urusan
    $router->post('/dmaster/rekening/kelompokurusan',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'DMaster\KelompokUrusanController@index','as'=>'kelompokurusan.index']);    
    $router->post('/dmaster/rekening/kelompokurusan/store',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\KelompokUrusanController@store','as'=>'kelompokurusan.store']);
    $router->put('/dmaster/rekening/kelompokurusan/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\KelompokUrusanController@update','as'=>'kelompokurusan.update']);
    $router->delete('/dmaster/rekening/kelompokurusan/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\KelompokUrusanController@destroy','as'=>'kelompokurusan.destroy']);    


    //data master - kegiatan - jenis pelaksanaan
    $router->post('/dmaster/jenispelaksanaan',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'DMaster\JenisPelaksanaanController@index','as'=>'jenispelaksanaan.index']);    
    $router->post('/dmaster/jenispelaksanaan/store',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\JenisPelaksanaanController@store','as'=>'jenispelaksanaan.store']);
    $router->put('/dmaster/jenispelaksanaan/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\JenisPelaksanaanController@update','as'=>'jenispelaksanaan.update']);
    $router->delete('/dmaster/jenispelaksanaan/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\JenisPelaksanaanController@destroy','as'=>'jenispelaksanaan.destroy']);    
    
    //data master - kegiatan - jenis pembangunan
    $router->post('/dmaster/jenispembangunan',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'DMaster\JenisPembangunanController@index','as'=>'jenispembangunan.index']);    
    $router->post('/dmaster/jenispembangunan/store',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\JenisPembangunanController@store','as'=>'jenispembangunan.store']);
    $router->put('/dmaster/jenispembangunan/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\JenisPembangunanController@update','as'=>'jenispembangunan.update']);
    $router->delete('/dmaster/jenispembangunan/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\JenisPembangunanController@destroy','as'=>'jenispembangunan.destroy']);    
    
    //data master - ASN
    $router->post('/dmaster/asn',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'DMaster\ASNController@index','as'=>'ASN.index']);    
    $router->post('/dmaster/asn/store',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\ASNController@store','as'=>'ASN.store']);
    $router->put('/dmaster/asn/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\ASNController@update','as'=>'ASN.update']);
    $router->delete('/dmaster/asn/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\ASNController@destroy','as'=>'ASN.destroy']);    
    
    //data master - Pejabat
    $router->post('/dmaster/pejabat',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'DMaster\PejabatController@index','as'=>'pejabat.index']);    
    $router->post('/dmaster/pejabat/store',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'DMaster\PejabatController@store','as'=>'pejabat.store']);
    $router->put('/dmaster/pejabat/{id}',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'DMaster\PejabatController@update','as'=>'pejabat.update']);
    $router->delete('/dmaster/pejabat/{id}',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'DMaster\PejabatController@destroy','as'=>'pejabat.destroy']);    

    //data master - Sumber Dana
    $router->post('/dmaster/sumberdana',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'DMaster\SumberDanaController@index','as'=>'sumberdana.index']);    
    $router->post('/dmaster/sumberdana/store',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\SumberDanaController@store','as'=>'sumberdana.store']);
    $router->put('/dmaster/sumberdana/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\SumberDanaController@update','as'=>'sumberdana.update']);
    $router->delete('/dmaster/sumberdana/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\SumberDanaController@destroy','as'=>'sumberdana.destroy']);    
    
    //data master - ta        
    $router->post('/dmaster/ta/store',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\TAController@store','as'=>'ta.store']);
    $router->put('/dmaster/ta/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\TAController@update','as'=>'ta.update']);
    $router->delete('/dmaster/ta/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\TAController@destroy','as'=>'ta.destroy']);    

    //belanja murni
    $router->post('/belanjamurni',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\BelanjaMurniController@index','as'=>'belanjamurni.index']);    
    $router->post('/belanjamurni/reloadstatistik1',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\BelanjaMurniController@reloadstatistik1','as'=>'belanjamurni.reloadstatistik1']);    
    $router->post('/belanjamurni/reloadstatistik2',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\BelanjaMurniController@reloadstatistik2','as'=>'belanjamurni.reloadstatistik2']);    
    
    $router->post('/belanjamurni/statistik/peringkatopd',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\PeringkatOPDMurniController@index','as'=>'peringkatopdmurni.index']);    
    
    //belanja perubahan
    $router->post('/belanjaperubahan',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\BelanjaPerubahanController@index','as'=>'belanjaperubahan.index']);    
    $router->post('/belanjaperubahan/reloadstatistik1',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\BelanjaPerubahanController@reloadstatistik1','as'=>'belanjaperubahan.reloadstatistik1']);    
    $router->post('/belanjaperubahan/reloadstatistik2',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\BelanjaPerubahanController@reloadstatistik2','as'=>'belanjaperubahan.reloadstatistik2']);    

    $router->post('/belanjaperubahan/statistik/peringkatopd',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\PeringkatOPDPerubahanController@index','as'=>'peringkatopdperubahan.index']);    

    //belanja - rka murni
    $router->post('/belanja/rkamurni',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@index','as'=>'rkamurni.index']);    
    $router->get('/belanja/rkamurni/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@show','as'=>'rkamurni.show']);    
    $router->put('/belanja/rkamurni/updatekegiatan/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@updatekegiatan','as'=>'rkamurni.updatekegiatan']);   
    $router->put('/belanja/rkamurni/updateuraian/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@updateuraian','as'=>'rkamurni.updateuraian']);   
    $router->put('/belanja/rkamurni/updatedetailuraian/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@updatedetailuraian','as'=>'rkamurni.updatedetailuraian']);   
    $router->post('/belanja/rkamurni/rencanatarget',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@rencanatarget','as'=>'rkamurni.rencanatarget']);        
    $router->post('/belanja/rkamurni/savetargetfisik',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@savetargetfisik','as'=>'rkamurni.savetargetfisik']);        
    $router->put('/belanja/rkamurni/updatetargetfisik',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@updatetargetfisik','as'=>'rkamurni.updatetargetfisik']);        
    $router->get('/belanja/rkamurni/bulanrealisasi/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@bulanrealisasi','as'=>'rkamurni.bulanrealisasi']);        
    $router->post('/belanja/rkamurni/savetargetanggarankas',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@savetargetanggarankas','as'=>'rkamurni.savetargetanggarankas']);        
    $router->put('/belanja/rkamurni/updatetargetanggarankas',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@updatetargetanggarankas','as'=>'rkamurni.updatetargetanggarankas']);   
    $router->post('/belanja/rkamurni/realisasi',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@realisasi','as'=>'rkamurni.realisasi']);             
    $router->post('/belanja/rkamurni/saverealisasi',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@saverealisasi','as'=>'rkamurni.saverealisasi']);             
    $router->put('/belanja/rkamurni/updaterealisasi/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@updaterealisasi','as'=>'rkamurni.updaterealisasi']);             
    $router->delete('/belanja/rkamurni/deleterealisasi/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@destroy','as'=>'rkamurni.deleterealisasi']);             
    $router->post('/belanja/rkamurni/loaddatakegiatanfirsttime',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Belanja\RKAMurniController@loaddatakegiatanFirsttime','as'=>'rkamurni.loaddatakegiatanfirsttime']);    
    $router->post('/belanja/rkamurni/loaddatauraianfirsttime',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Belanja\RKAMurniController@loaddatauraianFirsttime','as'=>'rkamurni.loaddatauraianfirsttime']);    

    //belanja - rka perubahan
    $router->post('/belanja/rkaperubahan',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@index','as'=>'rkaperubahan.index']);    
    $router->get('/belanja/rkaperubahan/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@show','as'=>'rkaperubahan.show']);    
    $router->put('/belanja/rkaperubahan/updatekegiatan/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@updatekegiatan','as'=>'rkaperubahan.updatekegiatan']);   
    $router->put('/belanja/rkaperubahan/updateuraian/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@updateuraian','as'=>'rkaperubahan.updateuraian']);   
    $router->put('/belanja/rkaperubahan/updatedetailuraian/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@updatedetailuraian','as'=>'rkaperubahan.updatedetailuraian']);   
    $router->post('/belanja/rkaperubahan/rencanatarget',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@rencanatarget','as'=>'rkaperubahan.rencanatarget']);        
    $router->post('/belanja/rkaperubahan/savetargetfisik',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@savetargetfisik','as'=>'rkaperubahan.savetargetfisik']);        
    $router->put('/belanja/rkaperubahan/updatetargetfisik',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@updatetargetfisik','as'=>'rkaperubahan.updatetargetfisik']);        
    $router->get('/belanja/rkaperubahan/bulanrealisasi/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@bulanrealisasi','as'=>'rkaperubahan.bulanrealisasi']);        
    $router->post('/belanja/rkaperubahan/savetargetanggarankas',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@savetargetanggarankas','as'=>'rkaperubahan.savetargetanggarankas']);        
    $router->put('/belanja/rkaperubahan/updatetargetanggarankas',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@updatetargetanggarankas','as'=>'rkaperubahan.updatetargetanggarankas']);   
    $router->post('/belanja/rkaperubahan/realisasi',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@realisasi','as'=>'rkaperubahan.realisasi']);             
    $router->post('/belanja/rkaperubahan/saverealisasi',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@saverealisasi','as'=>'rkaperubahan.saverealisasi']);             
    $router->put('/belanja/rkaperubahan/updaterealisasi/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@updaterealisasi','as'=>'rkaperubahan.updaterealisasi']);             
    $router->delete('/belanja/rkaperubahan/deleterealisasi/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@destroy','as'=>'rkaperubahan.deleterealisasi']);             
    $router->post('/belanja/rkaperubahan/loaddatakegiatanfirsttime',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Belanja\RKAPerubahanController@loaddatakegiatanFirsttime','as'=>'rkaperubahan.loaddatakegiatanfirsttime']);    
    $router->post('/belanja/rkaperubahan/loaddatauraianfirsttime',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Belanja\RKAPerubahanController@loaddatauraianFirsttime','as'=>'rkaperubahan.loaddatauraianfirsttime']);    
    //id disini adalah RKAID perubahan
    $router->put('/belanja/rkaperubahan/copykegiatanmurni/{id}',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Belanja\RKAPerubahanController@copykegiatanmurni','as'=>'rkaperubahan.copykegiatanmurni']);    
    $router->put('/belanja/rkaperubahan/copytarget/{id}',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Belanja\RKAPerubahanController@copytarget','as'=>'rkaperubahan.copytarget']);    
    //id disini adalah RKARincID perubahan
    $router->put('/belanja/rkaperubahan/copyrealisasi/{id}',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Belanja\RKAPerubahanController@copyrealisasi','as'=>'rkaperubahan.copyrealisasi']);    

    //report - form a murni
    $router->post('/report/formamurni',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\FormAMurniController@index','as'=>'formamurni.index']);    
    $router->post('/report/formamurni/printtoexcel',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\FormAMurniController@printtoexcel','as'=>'formamurni.printtoexcel']);    

    //report - form a perubahan
    $router->post('/report/formaperubahan',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\FormAPerubahanController@index','as'=>'formaperubahan.index']);    
    $router->post('/report/formaperubahan/printtoexcel',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\FormAPerubahanController@printtoexcel','as'=>'formaperubahan.printtoexcel']);    

    //report - form b opd murni
    $router->post('/report/formbopdmurni',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\FormBOPDMurniController@index','as'=>'formbopdmurni.index']);    
    $router->post('/report/formbopdmurni/printtoexcel',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\FormBOPDMurniController@printtoexcel','as'=>'formbopdmurni.printtoexcel']);    
    
    //report - form b opd perubahan
    $router->post('/report/formbopdperubahan',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\FormBOPDPerubahanController@index','as'=>'formbopdperubahan.index']);    
    $router->post('/report/formbopdperubahan/printtoexcel',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\FormBOPDPerubahanController@printtoexcel','as'=>'formbopdperubahan.printtoexcel']);    

    //report - form b unit kerja murni
    $router->post('/report/formbunitkerjamurni',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\FormBUnitKerjaMurniController@index','as'=>'formbunitkerjamurni.index']);    
    $router->post('/report/formbunitkerjamurni/printtoexcel',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\FormBUnitKerjaMurniController@printtoexcel','as'=>'formbunitkerjamurni.printtoexcel']);    
    
    //report - form b unit kerja perubahan
    $router->post('/report/formbunitkerjaperubahan',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\FormBUnitKerjaPerubahanController@index','as'=>'formbunitkerjaperubahan.index']);    
    $router->post('/report/formbunitkerjaperubahan/printtoexcel',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\FormBUnitKerjaPerubahanController@printtoexcel','as'=>'formbunitkerjaperubahan.printtoexcel']);    

    //report - evaluasi rkpd murni
    $router->post('/report/evaluasirkpdmurni',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'Report\EvaluasiRKPDMurniController@index','as'=>'evaluasirkpdmurni.index']);    
    $router->post('/report/evaluasirkpdmurni/printtoexcel',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'Report\EvaluasiRKPDMurniController@printtoexcel','as'=>'evaluasirkpdmurni.printtoexcel']);    

    //report - evaluasi rkpd perubahan
    $router->post('/report/evaluasirkpdperubahan',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'Report\EvaluasiRKPDPerubahanController@index','as'=>'evaluasirkpdperubahan.index']);    
    $router->post('/report/evaluasirkpdperubahan/printtoexcel',['middleware'=>['role:superadmin'],'uses'=>'Report\EvaluasiRKPDPerubahanController@printtoexcel','as'=>'evaluasirkpdperubahan.printtoexcel']);    
    
    //report - evaluasi renja murni
    $router->post('/report/evaluasirenjamurni',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\EvaluasiRenjaMurniController@index','as'=>'evaluasirenjamurni.index']);    
    $router->post('/report/evaluasirenjamurni/printtoexcel',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\EvaluasiRenjaMurniController@printtoexcel','as'=>'evaluasirenjamurni.printtoexcel']);    
    
    //report - evaluasi renja perubahan
    $router->post('/report/evaluasirenjaperubahan',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\EvaluasiRenjaPerubahanController@index','as'=>'evaluasirenjaperubahan.index']);    
    $router->post('/report/evaluasirenjaperubahan/printtoexcel',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\EvaluasiRenjaPerubahanController@printtoexcel','as'=>'evaluasirenjaperubahan.printtoexcel']);    
    
    //setting - permissions
    $router->get('/setting/permissions',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Settings\PermissionsController@index','as'=>'permissions.index']);
    $router->post('/setting/permissions/store',['middleware'=>['role:superadmin'],'uses'=>'Settings\PermissionsController@store','as'=>'permissions.store']);    
    $router->delete('/setting/permissions/{id}',['middleware'=>['role:superadmin'],'uses'=>'Settings\PermissionsController@destroy','as'=>'permissions.destroy']);

    //setting - roles
    $router->get('/setting/roles',['middleware'=>['role:superadmin'],'uses'=>'Settings\RolesController@index','as'=>'roles.index']);
    $router->post('/setting/roles/store',['middleware'=>['role:superadmin'],'uses'=>'Settings\RolesController@store','as'=>'roles.store']);
    $router->post('/setting/roles/storerolepermissions',['middleware'=>['role:superadmin'],'uses'=>'Settings\RolesController@storerolepermissions','as'=>'roles.storerolepermissions']);
    $router->post('/setting/roles/revokerolepermissions',['middleware'=>['role:superadmin'],'uses'=>'Settings\RolesController@revokerolepermissions','as'=>'users.revokerolepermissions']);
    $router->put('/setting/roles/{id}',['middleware'=>['role:superadmin'],'uses'=>'Settings\RolesController@update','as'=>'roles.update']);
    $router->delete('/setting/roles/{id}',['middleware'=>['role:superadmin'],'uses'=>'Settings\RolesController@destroy','as'=>'roles.destroy']);
    $router->get('/setting/roles/{id}/permission',['middleware'=>['role:superadmin'],'uses'=>'Settings\RolesController@rolepermissions','as'=>'roles.permission']);
    
    //setting - users
    $router->get('/setting/users',['middleware'=>['role:superadmin'],'uses'=>'Settings\UsersController@index','as'=>'users.index']);
    $router->post('/setting/users/store',['middleware'=>['role:superadmin'],'uses'=>'Settings\UsersController@store','as'=>'users.store']);
    $router->post('/setting/users/uploadfoto/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Settings\UsersController@uploadfoto','as'=>'users.uploadfoto']);
    $router->post('/setting/users/resetfoto/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Settings\UsersController@resetfoto','as'=>'users.resetfoto']);
    $router->post('/setting/users/syncallpermissions',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Settings\UsersController@syncallpermissions','as'=>'users.syncallpermissions']);
    $router->post('/setting/users/storeuserpermissions',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Settings\UsersController@storeuserpermissions','as'=>'users.storeuserpermissions']);
    $router->post('/setting/users/revokeuserpermissions',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Settings\UsersController@revokeuserpermissions','as'=>'users.revokeuserpermissions']);
    $router->put('/setting/users/{id}',['middleware'=>['role:superadmin'],'uses'=>'Settings\UsersController@update','as'=>'users.update']);
    $router->delete('/setting/users/{id}',['middleware'=>['role:superadmin'],'uses'=>'Settings\UsersController@destroy','as'=>'users.destroy']);    
    $router->get('/setting/users/{id}/permission',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Settings\UsersController@userpermissions','as'=>'users.permission']);    
    $router->get('/setting/users/{id}/opd',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Settings\UsersController@useropd','as'=>'users.opd']);    
    $router->get('/setting/users/role',['uses'=>'Settings\UsersController@role','as'=>'users.role']);    
    $router->get('/setting/users/{id}/roles',['uses'=>'Settings\UsersController@roles','as'=>'users.roles']);

    //setting - users bapelitbang
    $router->get('/setting/usersbapelitbang',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'Settings\UsersBapelitbangController@index','as'=>'usersbapelitbang.index']);
    $router->post('/setting/usersbapelitbang/store',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'Settings\UsersBapelitbangController@store','as'=>'usersbapelitbang.store']);
    $router->put('/setting/usersbapelitbang/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'Settings\UsersBapelitbangController@update','as'=>'usersbapelitbang.update']);
    $router->put('/setting/usersbapelitbang/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'Settings\UsersBapelitbangController@update','as'=>'usersbapelitbang.update']);
    $router->delete('/setting/usersbapelitbang/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'Settings\UsersBapelitbangController@destroy','as'=>'usersbapelitbang.destroy']);    
    
    //setting - users opd
    $router->get('/setting/usersopd',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Settings\UsersOPDController@index','as'=>'usersopd.index']);
    $router->post('/setting/usersopd/store',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Settings\UsersOPDController@store','as'=>'usersopd.store']);
    $router->put('/setting/usersopd/{id}',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Settings\UsersOPDController@update','as'=>'usersopd.update']);
    $router->put('/setting/usersopd/{id}',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Settings\UsersOPDController@update','as'=>'usersopd.update']);
    $router->delete('/setting/usersopd/{id}',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Settings\UsersOPDController@destroy','as'=>'usersopd.destroy']);    
    
    //uiadmin
    $router->get('/setting/uiadmin',['uses'=>'Settings\UIController@admin','as'=>'ui.admin']);
});
