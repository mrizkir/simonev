<?php
$router->get('/', function () use ($router) {
    $res=[
            'status'=>1,
            'pid'=>'fetchdata',
            'message'=>'SIMONEV API Micro-Service',            
        ];

    return response()->json($res);
});
$router->group(['prefix'=>'v2'], function () use ($router)
{
    //dashboard
    $router->post('/dashboard/front',['uses'=>'DashboardController@indexfront','as'=>'v2.dashboard.indexfront']);

    //dmaster - ta
    $router->get('/dmaster/ta',['uses'=>'DMaster\TAController@index','as'=>'v2.ta.index']);

    //auth login
    $router->post('/auth/login',['uses'=>'AuthController@login','as'=>'v2.auth.login']);
    
    //provinsi -data master
    $router->get('/dmaster/provinsi',['uses'=>'DMaster\ProvinsiController@index','as'=>'v2.provinsi.index']);        
    $router->get('/dmaster/provinsi/{id}/kota',['uses'=>'DMaster\ProvinsiController@kotaprovinsi','as'=>'v2.provinsi.kotaprovinsi']);  

    //kota -data master
    $router->get('/dmaster/kota',['uses'=>'DMaster\KotaController@index','as'=>'v2.kota.index']);        
    $router->get('/dmaster/kota/{id}/kecamatan',['uses'=>'DMaster\KotaController@kecamatankota','as'=>'v2.kota.kecamatankota']);        
    
    //kecamatan -data master
    $router->get('/dmaster/kecamatan',['uses'=>'DMaster\KecamatanController@index','as'=>'v2.kecamatan.index']);        
    $router->get('/dmaster/kecamatan/{id}/desa',['uses'=>'DMaster\KecamatanController@desakecamatan','as'=>'v2.kecamatan.desakecamatan']);        
    
    //uifront
    $router->get('/setting/uifront',['uses'=>'Settings\UIController@frontend','as'=>'v2.ui.frontend']);

});
$router->group(['prefix'=>'v2','middleware'=>'auth:api'], function () use ($router)
{
    //authentication
    $router->post('/auth/logout',['uses'=>'AuthController@logout','as'=>'v2.auth.logout']);
    $router->get('/auth/refresh',['uses'=>'AuthController@refresh','as'=>'v2.auth.refresh']);
    $router->get('/auth/me',['uses'=>'AuthController@me','as'=>'v2.auth.me']);

    //data master - rekening - transaksi
    $router->post('/dmaster/rekening/transaksi',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'DMaster\TransaksiController@index','as'=>'v2.rekening.transaksi.index']);    
    $router->post('/dmaster/rekening/transaksi/store',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\TransaksiController@store','as'=>'v2.rekening.transaksi.store']);
    $router->put('/dmaster/rekening/transaksi/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\TransaksiController@update','as'=>'v2.rekening.transaksi.update']);
    $router->delete('/dmaster/rekening/transaksi/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\TransaksiController@destroy','as'=>'v2.rekening.transaksi.destroy']);    

    //data master - rekening - kelompok
    $router->post('/dmaster/rekening/kelompok',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'DMaster\KelompokController@index','as'=>'v2.rekening.kelompok.index']);    
    $router->post('/dmaster/rekening/kelompok/store',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\KelompokController@store','as'=>'v2.rekening.kelompok.store']);
    $router->put('/dmaster/rekening/kelompok/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\KelompokController@update','as'=>'v2.rekening.kelompok.update']);
    $router->delete('/dmaster/rekening/kelompok/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\KelompokController@destroy','as'=>'v2.rekening.kelompok.destroy']);
    
    //data master - rekening - jenis
    $router->post('/dmaster/rekening/jenis',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'DMaster\JenisController@index','as'=>'v2.rekening.jenis.index']);    
    $router->post('/dmaster/rekening/jenis/store',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\JenisController@store','as'=>'v2.rekening.jenis.store']);
    $router->put('/dmaster/rekening/jenis/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\JenisController@update','as'=>'v2.rekening.jenis.update']);
    $router->delete('/dmaster/rekening/jenis/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\JenisController@destroy','as'=>'v2.rekening.jenis.destroy']);
    
    //data master - rekening - rincian
    $router->post('/dmaster/rekening/rincian',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'DMaster\RincianController@index','as'=>'v2.rekening.rincian.index']);    
    $router->post('/dmaster/rekening/rincian/store',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\RincianController@store','as'=>'v2.rekening.rincian.store']);
    $router->put('/dmaster/rekening/rincian/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\RincianController@update','as'=>'v2.rekening.rincian.update']);
    $router->delete('/dmaster/rekening/rincian/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\RincianController@destroy','as'=>'v2.rekening.rincian.destroy']);
    
    //data master - rekening - objek
    $router->post('/dmaster/rekening/objek',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'DMaster\ObjekController@index','as'=>'v2.rekening.objek.index']);    
    $router->post('/dmaster/rekening/objek/store',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\ObjekController@store','as'=>'v2.rekening.objek.store']);
    $router->put('/dmaster/rekening/objek/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\ObjekController@update','as'=>'v2.rekening.objek.update']);
    $router->delete('/dmaster/rekening/objek/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\ObjekController@destroy','as'=>'v2.rekening.objek.destroy']);
    
    //data master - opd
    $router->post('/dmaster/opd',['uses'=>'DMaster\OrganisasiController@index','as'=>'v2.opd.index']);    
    $router->post('/dmaster/opd/loadopd',['middleware'=>['role:superadmin'],'uses'=>'DMaster\OrganisasiController@loadopd','as'=>'v2.opd.loadopd']);    
    $router->post('/dmaster/opd/loadpaguapbdp',['middleware'=>['role:superadmin'],'uses'=>'DMaster\OrganisasiController@loadpaguapbdp','as'=>'v2.opd.loadpaguapbdp']);    
    $router->put('/dmaster/opd/{id}',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'DMaster\OrganisasiController@update','as'=>'v2.opd.update']);
    $router->get('/dmaster/opd/{id}/unitkerja',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'DMaster\OrganisasiController@opdunitkerja','as'=>'v2.opd.unitkerja']);
    $router->get('/dmaster/opd/{id}/pejabat',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'DMaster\OrganisasiController@pejabatopd','as'=>'v2.opd.pejabatopd']);
    
    //data master - unit kerja
    $router->post('/dmaster/unitkerja',['uses'=>'DMaster\SubOrganisasiController@index','as'=>'v2.unitkerja.index']);    
    $router->post('/dmaster/unitkerja/loadunitkerja',['middleware'=>['role:superadmin'],'uses'=>'DMaster\SubOrganisasiController@loadunitkerja','as'=>'v2.unitkerja.loadunitkerja']);    
    $router->post('/dmaster/unitkerja/loadpaguapbdp',['middleware'=>['role:superadmin'],'uses'=>'DMaster\SubOrganisasiController@loadpaguapbdp','as'=>'v2.opd.loadpaguapbdp']);    
    $router->put('/dmaster/unitkerja/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|unitkerja'],'uses'=>'DMaster\SubOrganisasiController@update','as'=>'v2.unitkerja.update']);
    
    //data master - urusan
    $router->post('/dmaster/rekening/urusan',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'DMaster\KelompokUrusanController@index','as'=>'v2.urusan.index']);    
    $router->post('/dmaster/rekening/urusan/store',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\KelompokUrusanController@store','as'=>'v2.urusan.store']);
    $router->put('/dmaster/rekening/urusan/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\KelompokUrusanController@update','as'=>'v2.urusan.update']);
    $router->delete('/dmaster/rekening/urusan/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\KelompokUrusanController@destroy','as'=>'v2.urusan.destroy']);    


    //data master - kegiatan - jenis pelaksanaan
    $router->post('/dmaster/jenispelaksanaan',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'DMaster\JenisPelaksanaanController@index','as'=>'v2.jenispelaksanaan.index']);    
    $router->post('/dmaster/jenispelaksanaan/store',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\JenisPelaksanaanController@store','as'=>'v2.jenispelaksanaan.store']);
    $router->put('/dmaster/jenispelaksanaan/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\JenisPelaksanaanController@update','as'=>'v2.jenispelaksanaan.update']);
    $router->delete('/dmaster/jenispelaksanaan/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\JenisPelaksanaanController@destroy','as'=>'v2.jenispelaksanaan.destroy']);    
    
    //data master - kegiatan - jenis pembangunan
    $router->post('/dmaster/jenispembangunan',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'DMaster\JenisPembangunanController@index','as'=>'v2.jenispembangunan.index']);    
    $router->post('/dmaster/jenispembangunan/store',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\JenisPembangunanController@store','as'=>'v2.jenispembangunan.store']);
    $router->put('/dmaster/jenispembangunan/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\JenisPembangunanController@update','as'=>'v2.jenispembangunan.update']);
    $router->delete('/dmaster/jenispembangunan/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\JenisPembangunanController@destroy','as'=>'v2.jenispembangunan.destroy']);    
    
    //data master - ASN
    $router->post('/dmaster/asn',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'DMaster\ASNController@index','as'=>'v2.ASN.index']);    
    $router->post('/dmaster/asn/store',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\ASNController@store','as'=>'v2.ASN.store']);
    $router->put('/dmaster/asn/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\ASNController@update','as'=>'v2.ASN.update']);
    $router->delete('/dmaster/asn/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\ASNController@destroy','as'=>'v2.ASN.destroy']);    
    
    //data master - Pejabat
    $router->post('/dmaster/pejabat',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'DMaster\PejabatController@index','as'=>'v2.pejabat.index']);    
    $router->post('/dmaster/pejabat/store',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'DMaster\PejabatController@store','as'=>'v2.pejabat.store']);
    $router->put('/dmaster/pejabat/{id}',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'DMaster\PejabatController@update','as'=>'v2.pejabat.update']);
    $router->delete('/dmaster/pejabat/{id}',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'DMaster\PejabatController@destroy','as'=>'v2.pejabat.destroy']);    

    //data master - Sumber Dana
    $router->post('/dmaster/sumberdana',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'DMaster\SumberDanaController@index','as'=>'v2.sumberdana.index']);    
    $router->post('/dmaster/sumberdana/store',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\SumberDanaController@store','as'=>'v2.sumberdana.store']);
    $router->put('/dmaster/sumberdana/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\SumberDanaController@update','as'=>'v2.sumberdana.update']);
    $router->delete('/dmaster/sumberdana/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\SumberDanaController@destroy','as'=>'v2.sumberdana.destroy']);    
    
    //data master - ta        
    $router->post('/dmaster/ta/store',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\TAController@store','as'=>'v2.ta.store']);
    $router->put('/dmaster/ta/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\TAController@update','as'=>'v2.ta.update']);
    $router->delete('/dmaster/ta/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'DMaster\TAController@destroy','as'=>'v2.ta.destroy']);    

    //belanja murni
    $router->post('/belanjamurni',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\BelanjaMurniController@index','as'=>'v2.belanjamurni.index']);    
    $router->post('/belanjamurni/reloadstatistik1',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\BelanjaMurniController@reloadstatistik1','as'=>'v2.belanjamurni.reloadstatistik1']);    
    $router->post('/belanjamurni/reloadstatistik2',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\BelanjaMurniController@reloadstatistik2','as'=>'v2.belanjamurni.reloadstatistik2']);    
    
    $router->post('/belanjamurni/statistik/peringkatopd',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\PeringkatOPDMurniController@index','as'=>'v2.peringkatopdmurni.index']);    
    
    //belanja perubahan
    $router->post('/belanjaperubahan',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\BelanjaPerubahanController@index','as'=>'v2.belanjaperubahan.index']);    
    $router->post('/belanjaperubahan/reloadstatistik1',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\BelanjaPerubahanController@reloadstatistik1','as'=>'v2.belanjaperubahan.reloadstatistik1']);    
    $router->post('/belanjaperubahan/reloadstatistik2',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\BelanjaPerubahanController@reloadstatistik2','as'=>'v2.belanjaperubahan.reloadstatistik2']);    

    $router->post('/belanjaperubahan/statistik/peringkatopd',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\PeringkatOPDPerubahanController@index','as'=>'v2.peringkatopdperubahan.index']);    

    //belanja - data mentah murni
    $router->post('/belanja/datamentahmurni',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Belanja\DataMentahMurniController@index','as'=>'v2.datamentahmurni.index']);    
    $router->post('/belanja/datamentahmurni/copyrka',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Belanja\DataMentahMurniController@copyrka','as'=>'v2.datamentahmurni.copyrka']);    

    //belanja - data mentah perubahan
    $router->post('/belanja/datamentahperubahan',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Belanja\DataMentahPerubahanController@index','as'=>'v2.datamentahperubahan.index']);    
    $router->post('/belanja/datamentahperubahan/copyrka',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Belanja\DataMentahPerubahanController@copyrka','as'=>'v2.datamentahperubahan.copyrka']);    

    //belanja - rka murni
    $router->post('/belanja/rkamurni',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@index','as'=>'v2.rkamurni.index']);    
    $router->get('/belanja/rkamurni/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@show','as'=>'v2.rkamurni.show']);    
    $router->put('/belanja/rkamurni/updatekegiatan/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@updatekegiatan','as'=>'v2.rkamurni.updatekegiatan']);   
    $router->put('/belanja/rkamurni/updateuraian/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@updateuraian','as'=>'v2.rkamurni.updateuraian']);   
    $router->put('/belanja/rkamurni/updatedetailuraian/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@updatedetailuraian','as'=>'v2.rkamurni.updatedetailuraian']);   
    $router->post('/belanja/rkamurni/rencanatarget',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@rencanatarget','as'=>'v2.rkamurni.rencanatarget']);        
    $router->post('/belanja/rkamurni/savetargetfisik',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@savetargetfisik','as'=>'v2.rkamurni.savetargetfisik']);        
    $router->put('/belanja/rkamurni/updatetargetfisik',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@updatetargetfisik','as'=>'v2.rkamurni.updatetargetfisik']);        
    $router->get('/belanja/rkamurni/bulanrealisasi/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@bulanrealisasi','as'=>'v2.rkamurni.bulanrealisasi']);        
    $router->post('/belanja/rkamurni/savetargetanggarankas',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@savetargetanggarankas','as'=>'v2.rkamurni.savetargetanggarankas']);        
    $router->put('/belanja/rkamurni/updatetargetanggarankas',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@updatetargetanggarankas','as'=>'v2.rkamurni.updatetargetanggarankas']);   
    $router->post('/belanja/rkamurni/realisasi',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@realisasi','as'=>'v2.rkamurni.realisasi']);             
    $router->post('/belanja/rkamurni/saverealisasi',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@saverealisasi','as'=>'v2.rkamurni.saverealisasi']);             
    $router->put('/belanja/rkamurni/updaterealisasi/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@updaterealisasi','as'=>'v2.rkamurni.updaterealisasi']);             
    $router->delete('/belanja/rkamurni/deleterealisasi/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@destroy','as'=>'v2.rkamurni.deleterealisasi']);             
    $router->post('/belanja/rkamurni/loaddatakegiatanfirsttime',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Belanja\RKAMurniController@loaddatakegiatanFirsttime','as'=>'v2.rkamurni.loaddatakegiatanfirsttime']);    
    $router->post('/belanja/rkamurni/loaddatauraianfirsttime',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Belanja\RKAMurniController@loaddatauraianFirsttime','as'=>'v2.rkamurni.loaddatauraianfirsttime']);    
    $router->delete('/belanja/rkamurni/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAMurniController@destroy','as'=>'v2.rkamurni.deleterka']);             

    //belanja - rka perubahan
    $router->post('/belanja/rkaperubahan',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@index','as'=>'v2.rkaperubahan.index']);    
    $router->get('/belanja/rkaperubahan/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@show','as'=>'v2.rkaperubahan.show']);    
    $router->put('/belanja/rkaperubahan/updatekegiatan/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@updatekegiatan','as'=>'v2.rkaperubahan.updatekegiatan']);   
    $router->put('/belanja/rkaperubahan/updateuraian/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@updateuraian','as'=>'v2.rkaperubahan.updateuraian']);   
    $router->put('/belanja/rkaperubahan/updatedetailuraian/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@updatedetailuraian','as'=>'v2.rkaperubahan.updatedetailuraian']);   
    $router->post('/belanja/rkaperubahan/rencanatarget',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@rencanatarget','as'=>'v2.rkaperubahan.rencanatarget']);        
    $router->post('/belanja/rkaperubahan/savetargetfisik',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@savetargetfisik','as'=>'v2.rkaperubahan.savetargetfisik']);        
    $router->put('/belanja/rkaperubahan/updatetargetfisik',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@updatetargetfisik','as'=>'v2.rkaperubahan.updatetargetfisik']);        
    $router->get('/belanja/rkaperubahan/bulanrealisasi/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@bulanrealisasi','as'=>'v2.rkaperubahan.bulanrealisasi']);        
    $router->post('/belanja/rkaperubahan/savetargetanggarankas',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@savetargetanggarankas','as'=>'v2.rkaperubahan.savetargetanggarankas']);        
    $router->put('/belanja/rkaperubahan/updatetargetanggarankas',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@updatetargetanggarankas','as'=>'v2.rkaperubahan.updatetargetanggarankas']);   
    $router->post('/belanja/rkaperubahan/realisasi',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@realisasi','as'=>'v2.rkaperubahan.realisasi']);             
    $router->post('/belanja/rkaperubahan/saverealisasi',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@saverealisasi','as'=>'v2.rkaperubahan.saverealisasi']);             
    $router->put('/belanja/rkaperubahan/updaterealisasi/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@updaterealisasi','as'=>'v2.rkaperubahan.updaterealisasi']);             
    $router->delete('/belanja/rkaperubahan/deleterealisasi/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@destroy','as'=>'v2.rkaperubahan.deleterealisasi']);             
    $router->post('/belanja/rkaperubahan/loaddatakegiatanfirsttime',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Belanja\RKAPerubahanController@loaddatakegiatanFirsttime','as'=>'v2.rkaperubahan.loaddatakegiatanfirsttime']);    
    $router->post('/belanja/rkaperubahan/loaddatauraianfirsttime',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Belanja\RKAPerubahanController@loaddatauraianFirsttime','as'=>'v2.rkaperubahan.loaddatauraianfirsttime']);    
    $router->delete('/belanja/rkaperubahan/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Belanja\RKAPerubahanController@destroy','as'=>'v2.rkaperubahan.deleterka']);             
    //id disini adalah RKAID perubahan
    $router->put('/belanja/rkaperubahan/copykegiatanmurni/{id}',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Belanja\RKAPerubahanController@copykegiatanmurni','as'=>'v2.rkaperubahan.copykegiatanmurni']);    
    $router->put('/belanja/rkaperubahan/copytarget/{id}',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Belanja\RKAPerubahanController@copytarget','as'=>'v2.rkaperubahan.copytarget']);    
    //id disini adalah RKARincID perubahan
    $router->put('/belanja/rkaperubahan/copyrealisasi/{id}',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Belanja\RKAPerubahanController@copyrealisasi','as'=>'v2.rkaperubahan.copyrealisasi']);    

    //report - form a murni
    $router->post('/report/formamurni',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\FormAMurniController@index','as'=>'v2.formamurni.index']);    
    $router->post('/report/formamurni/printtoexcel',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\FormAMurniController@printtoexcel','as'=>'v2.formamurni.printtoexcel']);    

    //report - form a perubahan
    $router->post('/report/formaperubahan',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\FormAPerubahanController@index','as'=>'v2.formaperubahan.index']);    
    $router->post('/report/formaperubahan/printtoexcel',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\FormAPerubahanController@printtoexcel','as'=>'v2.formaperubahan.printtoexcel']);    

    //report - form b opd murni
    $router->post('/report/formbopdmurni',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\FormBOPDMurniController@index','as'=>'v2.formbopdmurni.index']);    
    $router->post('/report/formbopdmurni/printtoexcel',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\FormBOPDMurniController@printtoexcel','as'=>'v2.formbopdmurni.printtoexcel']);    
    
    //report - form b opd perubahan
    $router->post('/report/formbopdperubahan',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\FormBOPDPerubahanController@index','as'=>'v2.formbopdperubahan.index']);    
    $router->post('/report/formbopdperubahan/printtoexcel',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\FormBOPDPerubahanController@printtoexcel','as'=>'v2.formbopdperubahan.printtoexcel']);    

    //report - form b unit kerja murni
    $router->post('/report/formbunitkerjamurni',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\FormBUnitKerjaMurniController@index','as'=>'v2.formbunitkerjamurni.index']);    
    $router->post('/report/formbunitkerjamurni/printtoexcel',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\FormBUnitKerjaMurniController@printtoexcel','as'=>'v2.formbunitkerjamurni.printtoexcel']);    
    
    //report - form b unit kerja perubahan
    $router->post('/report/formbunitkerjaperubahan',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\FormBUnitKerjaPerubahanController@index','as'=>'v2.formbunitkerjaperubahan.index']);    
    $router->post('/report/formbunitkerjaperubahan/printtoexcel',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\FormBUnitKerjaPerubahanController@printtoexcel','as'=>'v2.formbunitkerjaperubahan.printtoexcel']);    

    //report - evaluasi rkpd murni
    $router->post('/report/evaluasirkpdmurni',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'Report\EvaluasiRKPDMurniController@index','as'=>'v2.evaluasirkpdmurni.index']);    
    $router->post('/report/evaluasirkpdmurni/printtoexcel',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'Report\EvaluasiRKPDMurniController@printtoexcel','as'=>'v2.evaluasirkpdmurni.printtoexcel']);    

    //report - evaluasi rkpd perubahan
    $router->post('/report/evaluasirkpdperubahan',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'Report\EvaluasiRKPDPerubahanController@index','as'=>'v2.evaluasirkpdperubahan.index']);    
    $router->post('/report/evaluasirkpdperubahan/printtoexcel',['middleware'=>['role:superadmin'],'uses'=>'Report\EvaluasiRKPDPerubahanController@printtoexcel','as'=>'v2.evaluasirkpdperubahan.printtoexcel']);    
    
    //report - evaluasi renja murni
    $router->post('/report/evaluasirenjamurni',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\EvaluasiRENJAMurniController@index','as'=>'v2.evaluasirenjamurni.index']);    
    $router->post('/report/evaluasirenjamurni/printtoexcel',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\EvaluasiRENJAMurniController@printtoexcel','as'=>'v2.evaluasirenjamurni.printtoexcel']);    
    
    //report - evaluasi renja perubahan
    $router->post('/report/evaluasirenjaperubahan',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\EvaluasiRENJAPerubahanController@index','as'=>'v2.evaluasirenjaperubahan.index']);    
    $router->post('/report/evaluasirenjaperubahan/printtoexcel',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Report\EvaluasiRENJAPerubahanController@printtoexcel','as'=>'v2.evaluasirenjaperubahan.printtoexcel']);    
    
    //setting - permissions
    $router->get('/setting/permissions',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Settings\PermissionsController@index','as'=>'v2.permissions.index']);
    $router->post('/setting/permissions/store',['middleware'=>['role:superadmin'],'uses'=>'Settings\PermissionsController@store','as'=>'v2.permissions.store']);    
    $router->delete('/setting/permissions/{id}',['middleware'=>['role:superadmin'],'uses'=>'Settings\PermissionsController@destroy','as'=>'v2.permissions.destroy']);

    //setting - roles
    $router->get('/setting/roles',['middleware'=>['role:superadmin'],'uses'=>'Settings\RolesController@index','as'=>'v2.roles.index']);
    $router->post('/setting/roles/store',['middleware'=>['role:superadmin'],'uses'=>'Settings\RolesController@store','as'=>'v2.roles.store']);
    $router->post('/setting/roles/storerolepermissions',['middleware'=>['role:superadmin'],'uses'=>'Settings\RolesController@storerolepermissions','as'=>'v2.roles.storerolepermissions']);
    $router->post('/setting/roles/revokerolepermissions',['middleware'=>['role:superadmin'],'uses'=>'Settings\RolesController@revokerolepermissions','as'=>'v2.users.revokerolepermissions']);
    $router->put('/setting/roles/{id}',['middleware'=>['role:superadmin'],'uses'=>'Settings\RolesController@update','as'=>'v2.roles.update']);
    $router->delete('/setting/roles/{id}',['middleware'=>['role:superadmin'],'uses'=>'Settings\RolesController@destroy','as'=>'v2.roles.destroy']);
    $router->get('/setting/roles/{id}/permission',['middleware'=>['role:superadmin'],'uses'=>'Settings\RolesController@rolepermissions','as'=>'v2.roles.permission']);
    
    //setting - users
    $router->get('/setting/users',['middleware'=>['role:superadmin'],'uses'=>'Settings\UsersController@index','as'=>'v2.users.index']);
    $router->post('/setting/users/store',['middleware'=>['role:superadmin'],'uses'=>'Settings\UsersController@store','as'=>'v2.users.store']);
    $router->put('/setting/users/updatepassword/{id}',['uses'=>'Settings\UsersController@updatepassword','as'=>'v2.users.updatepassword']);
    $router->post('/setting/users/uploadfoto/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Settings\UsersController@uploadfoto','as'=>'v2.users.uploadfoto']);
    $router->post('/setting/users/resetfoto/{id}',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Settings\UsersController@resetfoto','as'=>'v2.users.resetfoto']);
    $router->post('/setting/users/syncallpermissions',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Settings\UsersController@syncallpermissions','as'=>'v2.users.syncallpermissions']);
    $router->post('/setting/users/storeuserpermissions',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Settings\UsersController@storeuserpermissions','as'=>'v2.users.storeuserpermissions']);
    $router->post('/setting/users/revokeuserpermissions',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Settings\UsersController@revokeuserpermissions','as'=>'v2.users.revokeuserpermissions']);
    $router->put('/setting/users/{id}',['middleware'=>['role:superadmin'],'uses'=>'Settings\UsersController@update','as'=>'v2.users.update']);
    $router->delete('/setting/users/{id}',['middleware'=>['role:superadmin'],'uses'=>'Settings\UsersController@destroy','as'=>'v2.users.destroy']);    
    $router->get('/setting/users/{id}/permission',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Settings\UsersController@userpermissions','as'=>'v2.users.permission']);    
    $router->get('/setting/users/{id}/opd',['middleware'=>['role:superadmin|bapelitbang|opd|pptk'],'uses'=>'Settings\UsersController@useropd','as'=>'v2.users.opd']);    
    $router->get('/setting/users/role',['uses'=>'Settings\UsersController@role','as'=>'v2.users.role']);    
    $router->get('/setting/users/{id}/roles',['uses'=>'Settings\UsersController@roles','as'=>'v2.users.roles']);

    //setting - users bapelitbang
    $router->get('/setting/usersbapelitbang',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'Settings\UsersBapelitbangController@index','as'=>'v2.usersbapelitbang.index']);
    $router->post('/setting/usersbapelitbang/store',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'Settings\UsersBapelitbangController@store','as'=>'v2.usersbapelitbang.store']);
    $router->put('/setting/usersbapelitbang/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'Settings\UsersBapelitbangController@update','as'=>'v2.usersbapelitbang.update']);
    $router->put('/setting/usersbapelitbang/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'Settings\UsersBapelitbangController@update','as'=>'v2.usersbapelitbang.update']);
    $router->delete('/setting/usersbapelitbang/{id}',['middleware'=>['role:superadmin|bapelitbang'],'uses'=>'Settings\UsersBapelitbangController@destroy','as'=>'v2.usersbapelitbang.destroy']);    
    
    //setting - users opd
    $router->get('/setting/usersopd',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Settings\UsersOPDController@index','as'=>'v2.usersopd.index']);
    $router->post('/setting/usersopd/store',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Settings\UsersOPDController@store','as'=>'v2.usersopd.store']);
    $router->put('/setting/usersopd/{id}',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Settings\UsersOPDController@update','as'=>'v2.usersopd.update']);
    $router->put('/setting/usersopd/{id}',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Settings\UsersOPDController@update','as'=>'v2.usersopd.update']);
    $router->delete('/setting/usersopd/{id}',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'Settings\UsersOPDController@destroy','as'=>'v2.usersopd.destroy']);    
    
    //uiadmin
    $router->get('/setting/uiadmin',['uses'=>'Settings\UIController@admin','as'=>'v2.ui.admin']);
});
