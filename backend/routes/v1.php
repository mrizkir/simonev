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
    $router->post('/dashboard/front',['uses'=>'DashboardController@indexfront','as'=>'v1.dashboard.indexfront']);

    //dmaster - ta
    $router->get('/dmaster/ta',['uses'=>'DMaster\TAController@index','as'=>'v1.ta.index']);

    //auth login
    $router->post('/auth/login',['uses'=>'AuthController@login','as'=>'v1.auth.login']);
    
    //provinsi -data master
    $router->get('/dmaster/provinsi',['uses'=>'DMaster\ProvinsiController@index','as'=>'v1.provinsi.index']);        
    $router->get('/dmaster/provinsi/{id}/kota',['uses'=>'DMaster\ProvinsiController@kotaprovinsi','as'=>'v1.provinsi.kotaprovinsi']);  

    //kota -data master
    $router->get('/dmaster/kota',['uses'=>'DMaster\KotaController@index','as'=>'v1.kota.index']);        
    $router->get('/dmaster/kota/{id}/kecamatan',['uses'=>'DMaster\KotaController@kecamatankota','as'=>'v1.kota.kecamatankota']);        
    
    //kecamatan -data master
    $router->get('/dmaster/kecamatan',['uses'=>'DMaster\KecamatanController@index','as'=>'v1.kecamatan.index']);        
    $router->get('/dmaster/kecamatan/{id}/desa',['uses'=>'DMaster\KecamatanController@desakecamatan','as'=>'v1.kecamatan.desakecamatan']);        
    
    //uifront
    $router->get('/setting/uifront',['uses'=>'Settings\UIController@frontend','as'=>'v1.ui.frontend']);

});
$router->group(['prefix'=>'v1','middleware'=>'auth:api'], function () use ($router)
{
    //authentication
    $router->post('/auth/logout',['uses'=>'AuthController@logout','as'=>'v1.auth.logout']);
    $router->get('/auth/refresh',['uses'=>'AuthController@refresh','as'=>'v1.auth.refresh']);
    $router->get('/auth/me',['uses'=>'AuthController@me','as'=>'v1.auth.me']);

    //data master - rekening - transaksi
    $router->post('/dmaster/rekening/transaksi',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'DMaster\TransaksiController@index','as'=>'v1.rekening.transaksi.index']);    
    $router->post('/dmaster/rekening/transaksi/store',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\TransaksiController@store','as'=>'v1.rekening.transaksi.store']);
    $router->put('/dmaster/rekening/transaksi/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\TransaksiController@update','as'=>'v1.rekening.transaksi.update']);
    $router->delete('/dmaster/rekening/transaksi/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\TransaksiController@destroy','as'=>'v1.rekening.transaksi.destroy']);    

    //data master - rekening - kelompok
    $router->post('/dmaster/rekening/kelompok',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'DMaster\KelompokController@index','as'=>'v1.rekening.kelompok.index']);    
    $router->post('/dmaster/rekening/kelompok/store',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\KelompokController@store','as'=>'v1.rekening.kelompok.store']);
    $router->put('/dmaster/rekening/kelompok/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\KelompokController@update','as'=>'v1.rekening.kelompok.update']);
    $router->delete('/dmaster/rekening/kelompok/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\KelompokController@destroy','as'=>'v1.rekening.kelompok.destroy']);
    
    //data master - rekening - jenis
    $router->post('/dmaster/rekening/jenis',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'DMaster\JenisController@index','as'=>'v1.rekening.jenis.index']);    
    $router->post('/dmaster/rekening/jenis/store',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\JenisController@store','as'=>'v1.rekening.jenis.store']);
    $router->put('/dmaster/rekening/jenis/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\JenisController@update','as'=>'v1.rekening.jenis.update']);
    $router->delete('/dmaster/rekening/jenis/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\JenisController@destroy','as'=>'v1.rekening.jenis.destroy']);
    
    //data master - rekening - rincian
    $router->post('/dmaster/rekening/rincian',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'DMaster\RincianController@index','as'=>'v1.rekening.rincian.index']);    
    $router->post('/dmaster/rekening/rincian/store',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\RincianController@store','as'=>'v1.rekening.rincian.store']);
    $router->put('/dmaster/rekening/rincian/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\RincianController@update','as'=>'v1.rekening.rincian.update']);
    $router->delete('/dmaster/rekening/rincian/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\RincianController@destroy','as'=>'v1.rekening.rincian.destroy']);
    
    //data master - rekening - objek
    $router->post('/dmaster/rekening/objek',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'DMaster\ObjekController@index','as'=>'v1.rekening.objek.index']);    
    $router->post('/dmaster/rekening/objek/store',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\ObjekController@store','as'=>'v1.rekening.objek.store']);
    $router->put('/dmaster/rekening/objek/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\ObjekController@update','as'=>'v1.rekening.objek.update']);
    $router->delete('/dmaster/rekening/objek/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\ObjekController@destroy','as'=>'v1.rekening.objek.destroy']);
    
    //data master - opd
    $router->post('/dmaster/opd',['uses'=>'DMaster\OrganisasiController@index','as'=>'v1.opd.index']);    
    $router->post('/dmaster/opd/loadopd',['middleware'=>['role:superadmin'],'uses'=>'DMaster\OrganisasiController@loadopd','as'=>'v1.opd.loadopd']);    
    $router->post('/dmaster/opd/loadpaguapbdp',['middleware'=>['role:superadmin'],'uses'=>'DMaster\OrganisasiController@loadpaguapbdp','as'=>'v1.opd.loadpaguapbdp']);    
    $router->put('/dmaster/opd/{id}',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'DMaster\OrganisasiController@update','as'=>'v1.opd.update']);
    $router->get('/dmaster/opd/{id}/unitkerja',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'DMaster\OrganisasiController@opdunitkerja','as'=>'v1.opd.unitkerja']);
    $router->get('/dmaster/opd/{id}/pejabat',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'DMaster\OrganisasiController@pejabatopd','as'=>'v1.opd.pejabatopd']);
    
    //data master - unit kerja
    $router->post('/dmaster/unitkerja',['uses'=>'DMaster\SubOrganisasiController@index','as'=>'v1.unitkerja.index']);    
    $router->post('/dmaster/unitkerja/loadunitkerja',['middleware'=>['role:superadmin'],'uses'=>'DMaster\SubOrganisasiController@loadunitkerja','as'=>'v1.unitkerja.loadunitkerja']);    
    $router->post('/dmaster/unitkerja/loadpaguapbdp',['middleware'=>['role:superadmin'],'uses'=>'DMaster\SubOrganisasiController@loadpaguapbdp','as'=>'v1.opd.loadpaguapbdp']);    
    $router->put('/dmaster/unitkerja/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|unitkerja'],'uses'=>'DMaster\SubOrganisasiController@update','as'=>'v1.unitkerja.update']);
    
    //data master - kegiatan - kelompok urusan
    $router->post('/dmaster/rekening/kelompokurusan',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'DMaster\KelompokUrusanController@index','as'=>'v1.kelompokurusan.index']);    
    $router->post('/dmaster/rekening/kelompokurusan/store',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\KelompokUrusanController@store','as'=>'v1.kelompokurusan.store']);
    $router->put('/dmaster/rekening/kelompokurusan/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\KelompokUrusanController@update','as'=>'v1.kelompokurusan.update']);
    $router->delete('/dmaster/rekening/kelompokurusan/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\KelompokUrusanController@destroy','as'=>'v1.kelompokurusan.destroy']);    


    //data master - kegiatan - jenis pelaksanaan
    $router->post('/dmaster/jenispelaksanaan',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'DMaster\JenisPelaksanaanController@index','as'=>'v1.jenispelaksanaan.index']);    
    $router->post('/dmaster/jenispelaksanaan/store',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\JenisPelaksanaanController@store','as'=>'v1.jenispelaksanaan.store']);
    $router->put('/dmaster/jenispelaksanaan/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\JenisPelaksanaanController@update','as'=>'v1.jenispelaksanaan.update']);
    $router->delete('/dmaster/jenispelaksanaan/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\JenisPelaksanaanController@destroy','as'=>'v1.jenispelaksanaan.destroy']);    
    
    //data master - kegiatan - jenis pembangunan
    $router->post('/dmaster/jenispembangunan',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'DMaster\JenisPembangunanController@index','as'=>'v1.jenispembangunan.index']);    
    $router->post('/dmaster/jenispembangunan/store',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\JenisPembangunanController@store','as'=>'v1.jenispembangunan.store']);
    $router->put('/dmaster/jenispembangunan/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\JenisPembangunanController@update','as'=>'v1.jenispembangunan.update']);
    $router->delete('/dmaster/jenispembangunan/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\JenisPembangunanController@destroy','as'=>'v1.jenispembangunan.destroy']);    
    
    //data master - ASN
    $router->post('/dmaster/asn',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'DMaster\ASNController@index','as'=>'v1.ASN.index']);    
    $router->post('/dmaster/asn/store',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\ASNController@store','as'=>'v1.ASN.store']);
    $router->put('/dmaster/asn/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\ASNController@update','as'=>'v1.ASN.update']);
    $router->delete('/dmaster/asn/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\ASNController@destroy','as'=>'v1.ASN.destroy']);    
    
    //data master - Pejabat
    $router->post('/dmaster/pejabat',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'DMaster\PejabatController@index','as'=>'v1.pejabat.index']);    
    $router->post('/dmaster/pejabat/store',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'DMaster\PejabatController@store','as'=>'v1.pejabat.store']);
    $router->put('/dmaster/pejabat/{id}',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'DMaster\PejabatController@update','as'=>'v1.pejabat.update']);
    $router->delete('/dmaster/pejabat/{id}',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'DMaster\PejabatController@destroy','as'=>'v1.pejabat.destroy']);    

    //data master - Sumber Dana
    $router->post('/dmaster/sumberdana',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'DMaster\SumberDanaController@index','as'=>'v1.sumberdana.index']);    
    $router->post('/dmaster/sumberdana/store',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\SumberDanaController@store','as'=>'v1.sumberdana.store']);
    $router->put('/dmaster/sumberdana/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\SumberDanaController@update','as'=>'v1.sumberdana.update']);
    $router->delete('/dmaster/sumberdana/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\SumberDanaController@destroy','as'=>'v1.sumberdana.destroy']);    
    
    //data master - ta        
    $router->post('/dmaster/ta/store',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\TAController@store','as'=>'v1.ta.store']);
    $router->put('/dmaster/ta/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\TAController@update','as'=>'v1.ta.update']);
    $router->delete('/dmaster/ta/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\TAController@destroy','as'=>'v1.ta.destroy']);    

    //belanja murni
    $router->post('/belanjamurni',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\BelanjaMurniController@index','as'=>'v1.belanjamurni.index']);    
    $router->post('/belanjamurni/reloadstatistik1',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\BelanjaMurniController@reloadstatistik1','as'=>'v1.belanjamurni.reloadstatistik1']);    
    $router->post('/belanjamurni/reloadstatistik2',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\BelanjaMurniController@reloadstatistik2','as'=>'v1.belanjamurni.reloadstatistik2']);    
    
    $router->post('/belanjamurni/statistik/peringkatopd',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\PeringkatOPDMurniController@index','as'=>'v1.peringkatopdmurni.index']);    
    
    //belanja perubahan
    $router->post('/belanjaperubahan',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\BelanjaPerubahanController@index','as'=>'v1.belanjaperubahan.index']);    
    $router->post('/belanjaperubahan/reloadstatistik1',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\BelanjaPerubahanController@reloadstatistik1','as'=>'v1.belanjaperubahan.reloadstatistik1']);    
    $router->post('/belanjaperubahan/reloadstatistik2',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\BelanjaPerubahanController@reloadstatistik2','as'=>'v1.belanjaperubahan.reloadstatistik2']);    

    $router->post('/belanjaperubahan/statistik/peringkatopd',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\PeringkatOPDPerubahanController@index','as'=>'v1.peringkatopdperubahan.index']);    

    //belanja - data mentah murni
    $router->post('/belanja/datamentahmurni',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Belanja\DataMentahMurniController@index','as'=>'v1.datamentahmurni.index']);    
    $router->post('/belanja/datamentahmurni/copyrka',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Belanja\DataMentahMurniController@copyrka','as'=>'v1.datamentahmurni.copyrka']);    

    //belanja - data mentah perubahan
    $router->post('/belanja/datamentahperubahan',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Belanja\DataMentahPerubahanController@index','as'=>'v1.datamentahperubahan.index']);    
    $router->post('/belanja/datamentahperubahan/copyrka',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Belanja\DataMentahPerubahanController@copyrka','as'=>'v1.datamentahperubahan.copyrka']);    

    //belanja - rka murni
    $router->post('/belanja/rkamurni',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@index','as'=>'v1.rkamurni.index']);    
    $router->get('/belanja/rkamurni/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@show','as'=>'v1.rkamurni.show']);    
    $router->put('/belanja/rkamurni/updatekegiatan/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@updatekegiatan','as'=>'v1.rkamurni.updatekegiatan']);   
    $router->put('/belanja/rkamurni/updateuraian/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@updateuraian','as'=>'v1.rkamurni.updateuraian']);   
    $router->put('/belanja/rkamurni/updatedetailuraian/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@updatedetailuraian','as'=>'v1.rkamurni.updatedetailuraian']);   
    $router->post('/belanja/rkamurni/rencanatarget',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@rencanatarget','as'=>'v1.rkamurni.rencanatarget']);        
    $router->post('/belanja/rkamurni/savetargetfisik',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@savetargetfisik','as'=>'v1.rkamurni.savetargetfisik']);        
    $router->put('/belanja/rkamurni/updatetargetfisik',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@updatetargetfisik','as'=>'v1.rkamurni.updatetargetfisik']);        
    $router->get('/belanja/rkamurni/bulanrealisasi/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@bulanrealisasi','as'=>'v1.rkamurni.bulanrealisasi']);        
    $router->post('/belanja/rkamurni/savetargetanggarankas',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@savetargetanggarankas','as'=>'v1.rkamurni.savetargetanggarankas']);        
    $router->put('/belanja/rkamurni/updatetargetanggarankas',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@updatetargetanggarankas','as'=>'v1.rkamurni.updatetargetanggarankas']);   
    $router->post('/belanja/rkamurni/realisasi',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@realisasi','as'=>'v1.rkamurni.realisasi']);             
    $router->post('/belanja/rkamurni/saverealisasi',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@saverealisasi','as'=>'v1.rkamurni.saverealisasi']);             
    $router->put('/belanja/rkamurni/updaterealisasi/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@updaterealisasi','as'=>'v1.rkamurni.updaterealisasi']);             
    $router->delete('/belanja/rkamurni/deleterealisasi/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@destroy','as'=>'v1.rkamurni.deleterealisasi']);             
    $router->post('/belanja/rkamurni/loaddatakegiatanfirsttime',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Belanja\RKAMurniController@loaddatakegiatanFirsttime','as'=>'v1.rkamurni.loaddatakegiatanfirsttime']);    
    $router->post('/belanja/rkamurni/loaddatauraianfirsttime',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Belanja\RKAMurniController@loaddatauraianFirsttime','as'=>'v1.rkamurni.loaddatauraianfirsttime']);    
    $router->delete('/belanja/rkamurni/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@destroy','as'=>'v1.rkamurni.deleterka']);             

    //belanja - rka perubahan
    $router->post('/belanja/rkaperubahan',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@index','as'=>'v1.rkaperubahan.index']);    
    $router->get('/belanja/rkaperubahan/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@show','as'=>'v1.rkaperubahan.show']);    
    $router->put('/belanja/rkaperubahan/updatekegiatan/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@updatekegiatan','as'=>'v1.rkaperubahan.updatekegiatan']);   
    $router->put('/belanja/rkaperubahan/updateuraian/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@updateuraian','as'=>'v1.rkaperubahan.updateuraian']);   
    $router->put('/belanja/rkaperubahan/updatedetailuraian/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@updatedetailuraian','as'=>'v1.rkaperubahan.updatedetailuraian']);   
    $router->post('/belanja/rkaperubahan/rencanatarget',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@rencanatarget','as'=>'v1.rkaperubahan.rencanatarget']);        
    $router->post('/belanja/rkaperubahan/savetargetfisik',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@savetargetfisik','as'=>'v1.rkaperubahan.savetargetfisik']);        
    $router->put('/belanja/rkaperubahan/updatetargetfisik',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@updatetargetfisik','as'=>'v1.rkaperubahan.updatetargetfisik']);        
    $router->get('/belanja/rkaperubahan/bulanrealisasi/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@bulanrealisasi','as'=>'v1.rkaperubahan.bulanrealisasi']);        
    $router->post('/belanja/rkaperubahan/savetargetanggarankas',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@savetargetanggarankas','as'=>'v1.rkaperubahan.savetargetanggarankas']);        
    $router->put('/belanja/rkaperubahan/updatetargetanggarankas',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@updatetargetanggarankas','as'=>'v1.rkaperubahan.updatetargetanggarankas']);   
    $router->post('/belanja/rkaperubahan/realisasi',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@realisasi','as'=>'v1.rkaperubahan.realisasi']);             
    $router->post('/belanja/rkaperubahan/saverealisasi',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@saverealisasi','as'=>'v1.rkaperubahan.saverealisasi']);             
    $router->put('/belanja/rkaperubahan/updaterealisasi/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@updaterealisasi','as'=>'v1.rkaperubahan.updaterealisasi']);             
    $router->delete('/belanja/rkaperubahan/deleterealisasi/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@destroy','as'=>'v1.rkaperubahan.deleterealisasi']);             
    $router->post('/belanja/rkaperubahan/loaddatakegiatanfirsttime',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Belanja\RKAPerubahanController@loaddatakegiatanFirsttime','as'=>'v1.rkaperubahan.loaddatakegiatanfirsttime']);    
    $router->post('/belanja/rkaperubahan/loaddatauraianfirsttime',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Belanja\RKAPerubahanController@loaddatauraianFirsttime','as'=>'v1.rkaperubahan.loaddatauraianfirsttime']);    
    $router->delete('/belanja/rkaperubahan/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@destroy','as'=>'v1.rkaperubahan.deleterka']);             
    //id disini adalah RKAID perubahan
    $router->put('/belanja/rkaperubahan/copykegiatanmurni/{id}',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Belanja\RKAPerubahanController@copykegiatanmurni','as'=>'v1.rkaperubahan.copykegiatanmurni']);    
    $router->put('/belanja/rkaperubahan/copytarget/{id}',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Belanja\RKAPerubahanController@copytarget','as'=>'v1.rkaperubahan.copytarget']);    
    //id disini adalah RKARincID perubahan
    $router->put('/belanja/rkaperubahan/copyrealisasi/{id}',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Belanja\RKAPerubahanController@copyrealisasi','as'=>'v1.rkaperubahan.copyrealisasi']);    

    //report - form a murni
    $router->post('/report/formamurni',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\FormAMurniController@index','as'=>'v1.formamurni.index']);    
    $router->post('/report/formamurni/printtoexcel',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\FormAMurniController@printtoexcel','as'=>'v1.formamurni.printtoexcel']);    

    //report - form a perubahan
    $router->post('/report/formaperubahan',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\FormAPerubahanController@index','as'=>'v1.formaperubahan.index']);    
    $router->post('/report/formaperubahan/printtoexcel',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\FormAPerubahanController@printtoexcel','as'=>'v1.formaperubahan.printtoexcel']);    

    //report - form b opd murni
    $router->post('/report/formbopdmurni',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\FormBOPDMurniController@index','as'=>'v1.formbopdmurni.index']);    
    $router->post('/report/formbopdmurni/printtoexcel',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\FormBOPDMurniController@printtoexcel','as'=>'v1.formbopdmurni.printtoexcel']);    
    
    //report - form b opd perubahan
    $router->post('/report/formbopdperubahan',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\FormBOPDPerubahanController@index','as'=>'v1.formbopdperubahan.index']);    
    $router->post('/report/formbopdperubahan/printtoexcel',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\FormBOPDPerubahanController@printtoexcel','as'=>'v1.formbopdperubahan.printtoexcel']);    

    //report - form b unit kerja murni
    $router->post('/report/formbunitkerjamurni',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\FormBUnitKerjaMurniController@index','as'=>'v1.formbunitkerjamurni.index']);    
    $router->post('/report/formbunitkerjamurni/printtoexcel',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\FormBUnitKerjaMurniController@printtoexcel','as'=>'v1.formbunitkerjamurni.printtoexcel']);    
    
    //report - form b unit kerja perubahan
    $router->post('/report/formbunitkerjaperubahan',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\FormBUnitKerjaPerubahanController@index','as'=>'v1.formbunitkerjaperubahan.index']);    
    $router->post('/report/formbunitkerjaperubahan/printtoexcel',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\FormBUnitKerjaPerubahanController@printtoexcel','as'=>'v1.formbunitkerjaperubahan.printtoexcel']);    

    //report - evaluasi rkpd murni
    $router->post('/report/evaluasirkpdmurni',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'Report\EvaluasiRKPDMurniController@index','as'=>'v1.evaluasirkpdmurni.index']);    
    $router->post('/report/evaluasirkpdmurni/printtoexcel',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'Report\EvaluasiRKPDMurniController@printtoexcel','as'=>'v1.evaluasirkpdmurni.printtoexcel']);    

    //report - evaluasi rkpd perubahan
    $router->post('/report/evaluasirkpdperubahan',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'Report\EvaluasiRKPDPerubahanController@index','as'=>'v1.evaluasirkpdperubahan.index']);    
    $router->post('/report/evaluasirkpdperubahan/printtoexcel',['middleware'=>['role:superadmin'],'uses'=>'Report\EvaluasiRKPDPerubahanController@printtoexcel','as'=>'v1.evaluasirkpdperubahan.printtoexcel']);    
    
    //report - evaluasi renja murni
    $router->post('/report/evaluasirenjamurni',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\EvaluasiRENJAMurniController@index','as'=>'v1.evaluasirenjamurni.index']);    
    $router->post('/report/evaluasirenjamurni/printtoexcel',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\EvaluasiRENJAMurniController@printtoexcel','as'=>'v1.evaluasirenjamurni.printtoexcel']);    
    
    //report - evaluasi renja perubahan
    $router->post('/report/evaluasirenjaperubahan',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\EvaluasiRENJAPerubahanController@index','as'=>'v1.evaluasirenjaperubahan.index']);    
    $router->post('/report/evaluasirenjaperubahan/printtoexcel',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\EvaluasiRENJAPerubahanController@printtoexcel','as'=>'v1.evaluasirenjaperubahan.printtoexcel']);    
    
    //setting - permissions
    $router->get('/setting/permissions',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Settings\PermissionsController@index','as'=>'v1.permissions.index']);
    $router->post('/setting/permissions/store',['middleware'=>['role:superadmin'],'uses'=>'Settings\PermissionsController@store','as'=>'v1.permissions.store']);    
    $router->delete('/setting/permissions/{id}',['middleware'=>['role:superadmin'],'uses'=>'Settings\PermissionsController@destroy','as'=>'v1.permissions.destroy']);

    //setting - roles
    $router->get('/setting/roles',['middleware'=>['role:superadmin'],'uses'=>'Settings\RolesController@index','as'=>'v1.roles.index']);
    $router->post('/setting/roles/store',['middleware'=>['role:superadmin'],'uses'=>'Settings\RolesController@store','as'=>'v1.roles.store']);
    $router->post('/setting/roles/storerolepermissions',['middleware'=>['role:superadmin'],'uses'=>'Settings\RolesController@storerolepermissions','as'=>'v1.roles.storerolepermissions']);
    $router->post('/setting/roles/revokerolepermissions',['middleware'=>['role:superadmin'],'uses'=>'Settings\RolesController@revokerolepermissions','as'=>'v1.users.revokerolepermissions']);
    $router->put('/setting/roles/{id}',['middleware'=>['role:superadmin'],'uses'=>'Settings\RolesController@update','as'=>'v1.roles.update']);
    $router->delete('/setting/roles/{id}',['middleware'=>['role:superadmin'],'uses'=>'Settings\RolesController@destroy','as'=>'v1.roles.destroy']);
    $router->get('/setting/roles/{id}/permission',['middleware'=>['role:superadmin'],'uses'=>'Settings\RolesController@rolepermissions','as'=>'v1.roles.permission']);
    
    //setting - users
    $router->get('/setting/users',['middleware'=>['role:superadmin'],'uses'=>'Settings\UsersController@index','as'=>'v1.users.index']);
    $router->post('/setting/users/store',['middleware'=>['role:superadmin'],'uses'=>'Settings\UsersController@store','as'=>'v1.users.store']);
    $router->put('/setting/users/updatepassword/{id}',['uses'=>'Settings\UsersController@updatepassword','as'=>'v1.users.updatepassword']);
    $router->post('/setting/users/uploadfoto/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Settings\UsersController@uploadfoto','as'=>'v1.users.uploadfoto']);
    $router->post('/setting/users/resetfoto/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Settings\UsersController@resetfoto','as'=>'v1.users.resetfoto']);
    $router->post('/setting/users/syncallpermissions',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Settings\UsersController@syncallpermissions','as'=>'v1.users.syncallpermissions']);
    $router->post('/setting/users/storeuserpermissions',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Settings\UsersController@storeuserpermissions','as'=>'v1.users.storeuserpermissions']);
    $router->post('/setting/users/revokeuserpermissions',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Settings\UsersController@revokeuserpermissions','as'=>'v1.users.revokeuserpermissions']);
    $router->put('/setting/users/{id}',['middleware'=>['role:superadmin'],'uses'=>'Settings\UsersController@update','as'=>'v1.users.update']);
    $router->delete('/setting/users/{id}',['middleware'=>['role:superadmin'],'uses'=>'Settings\UsersController@destroy','as'=>'v1.users.destroy']);    
    $router->get('/setting/users/{id}/permission',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Settings\UsersController@userpermissions','as'=>'v1.users.permission']);    
    $router->get('/setting/users/{id}/opd',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Settings\UsersController@useropd','as'=>'v1.users.opd']);    
    $router->get('/setting/users/role',['uses'=>'Settings\UsersController@role','as'=>'v1.users.role']);    
    $router->get('/setting/users/{id}/roles',['uses'=>'Settings\UsersController@roles','as'=>'v1.users.roles']);

    //setting - users bapelitbang
    $router->get('/setting/usersbapelitbang',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'Settings\UsersBapelitbangController@index','as'=>'v1.usersbapelitbang.index']);
    $router->post('/setting/usersbapelitbang/store',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'Settings\UsersBapelitbangController@store','as'=>'v1.usersbapelitbang.store']);
    $router->put('/setting/usersbapelitbang/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'Settings\UsersBapelitbangController@update','as'=>'v1.usersbapelitbang.update']);
    $router->put('/setting/usersbapelitbang/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'Settings\UsersBapelitbangController@update','as'=>'v1.usersbapelitbang.update']);
    $router->delete('/setting/usersbapelitbang/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'Settings\UsersBapelitbangController@destroy','as'=>'v1.usersbapelitbang.destroy']);    
    
    //setting - users opd
    $router->get('/setting/usersopd',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Settings\UsersOPDController@index','as'=>'v1.usersopd.index']);
    $router->post('/setting/usersopd/store',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Settings\UsersOPDController@store','as'=>'v1.usersopd.store']);
    $router->put('/setting/usersopd/{id}',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Settings\UsersOPDController@update','as'=>'v1.usersopd.update']);
    $router->put('/setting/usersopd/{id}',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Settings\UsersOPDController@update','as'=>'v1.usersopd.update']);
    $router->delete('/setting/usersopd/{id}',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Settings\UsersOPDController@destroy','as'=>'v1.usersopd.destroy']);    
    
    //uiadmin
    $router->get('/setting/uiadmin',['uses'=>'Settings\UIController@admin','as'=>'v1.ui.admin']);
});
