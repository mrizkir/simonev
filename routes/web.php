<?php

//disable halaman register [pendaftaran]
Auth::routes(['register' => false]);

Route::get('/', ['uses' => 'FrontendController@welcome', 'as' => 'frontend.index']);
Route::get('/logout', ['uses' => 'Auth\LoginController@logout', 'as' => 'logout']);

Route::group(['prefix' => 'admin', 'middleware' => ['disablepreventback', 'web', 'auth']], function () {
    Route::get('/', ['uses' => 'DashboardController@index', 'as' => 'dashboard.index']);

    //masters - data kelompok urusan [data]
    Route::resource('/dmaster/kelompokurusan', 'DMaster\KelompokUrusanController', [
        'parameters' => ['kelompokurusan' => 'uuid'],
        'only' => ['index', 'show']
    ]);
    Route::get('/dmaster/kelompokurusan/paginate/{id}', ['uses' => 'DMaster\KelompokUrusanController@paginate', 'as' => 'kelompokurusan.paginate']);
    Route::post('/dmaster/kelompokurusan/changenumberrecordperpage', ['uses' => 'DMaster\KelompokUrusanController@changenumberrecordperpage', 'as' => 'kelompokurusan.changenumberrecordperpage']);
    Route::post('/dmaster/kelompokurusan/orderby', ['uses' => 'DMaster\KelompokUrusanController@orderby', 'as' => 'kelompokurusan.orderby']);

    //masters - data urusan [data]
    Route::resource('/dmaster/urusan', 'DMaster\UrusanController', [
        'parameters' => ['urusan' => 'uuid'],
        'only' => ['index', 'show']
    ]);
    Route::post('/dmaster/urusan/search', ['uses' => 'DMaster\UrusanController@search', 'as' => 'urusan.search']);
    Route::get('/dmaster/urusan/paginate/{id}', ['uses' => 'DMaster\UrusanController@paginate', 'as' => 'urusan.paginate']);
    Route::post('/dmaster/urusan/changenumberrecordperpage', ['uses' => 'DMaster\UrusanController@changenumberrecordperpage', 'as' => 'urusan.changenumberrecordperpage']);
    Route::post('/dmaster/urusan/orderby', ['uses' => 'DMaster\UrusanController@orderby', 'as' => 'urusan.orderby']);

    //masters - data organisasi (OPD / SKPD) [data]
    Route::resource('/dmaster/organisasi', 'DMaster\OrganisasiController', [
        'parameters' => ['organisasi' => 'uuid'],
        'only' => ['index', 'show']
    ]);
    Route::post('/dmaster/organisasi/search', ['uses' => 'DMaster\OrganisasiController@search', 'as' => 'organisasi.search']);
    Route::post('/dmaster/organisasi/filter', ['uses' => 'DMaster\OrganisasiController@filter', 'as' => 'organisasi.filter']);
    Route::get('/dmaster/organisasi/paginate/{id}', ['uses' => 'DMaster\OrganisasiController@paginate', 'as' => 'organisasi.paginate']);
    Route::post('/dmaster/organisasi/changenumberrecordperpage', ['uses' => 'DMaster\OrganisasiController@changenumberrecordperpage', 'as' => 'organisasi.changenumberrecordperpage']);
    Route::post('/dmaster/organisasi/orderby', ['uses' => 'DMaster\OrganisasiController@orderby', 'as' => 'organisasi.orderby']);

    //masters - data sub organisasi (Unit Kerja) [data]
    Route::resource('/dmaster/suborganisasi', 'DMaster\SubOrganisasiController', [
        'parameters' => ['suborganisasi' => 'uuid'],
        'only' => ['index', 'show']
    ]);
    Route::post('/dmaster/suborganisasi/search', ['uses' => 'DMaster\SubOrganisasiController@search', 'as' => 'suborganisasi.search']);
    Route::post('/dmaster/suborganisasi/filter', ['uses' => 'DMaster\SubOrganisasiController@filter', 'as' => 'suborganisasi.filter']);
    Route::get('/dmaster/suborganisasi/paginate/{id}', ['uses' => 'DMaster\SubOrganisasiController@paginate', 'as' => 'suborganisasi.paginate']);
    Route::post('/dmaster/suborganisasi/changenumberrecordperpage', ['uses' => 'DMaster\SubOrganisasiController@changenumberrecordperpage', 'as' => 'suborganisasi.changenumberrecordperpage']);
    Route::post('/dmaster/suborganisasi/orderby', ['uses' => 'DMaster\SubOrganisasiController@orderby', 'as' => 'suborganisasi.orderby']);

    //masters - data program  [data]
    Route::resource('/dmaster/program', 'DMaster\ProgramController', [
        'parameters' => ['program' => 'uuid'],
        'only' => ['index', 'show']
    ]);
    Route::post('/dmaster/program/search', ['uses' => 'DMaster\ProgramController@search', 'as' => 'program.search']);
    Route::post('/dmaster/program/filter', ['uses' => 'DMaster\ProgramController@filter', 'as' => 'program.filter']);
    Route::get('/dmaster/program/paginate/{id}', ['uses' => 'DMaster\ProgramController@paginate', 'as' => 'program.paginate']);
    Route::post('/dmaster/program/changenumberrecordperpage', ['uses' => 'DMaster\ProgramController@changenumberrecordperpage', 'as' => 'program.changenumberrecordperpage']);
    Route::post('/dmaster/program/orderby', ['uses' => 'DMaster\ProgramController@orderby', 'as' => 'program.orderby']);

    //masters - data program kegiatan [data]
    Route::resource('/dmaster/programkegiatan', 'DMaster\ProgramKegiatanController', [
        'parameters' => ['programkegiatan' => 'uuid'],
        'only' => ['index', 'show']
    ]);
    Route::post('/dmaster/programkegiatan/search', ['uses' => 'DMaster\ProgramKegiatanController@search', 'as' => 'kegiatan.search']);
    Route::post('/dmaster/programkegiatan/filter', ['uses' => 'DMaster\ProgramKegiatanController@filter', 'as' => 'kegiatan.filter']);
    Route::get('/dmaster/programkegiatan/paginate/{id}', ['uses' => 'DMaster\ProgramKegiatanController@paginate', 'as' => 'kegiatan.paginate']);
    Route::post('/dmaster/programkegiatan/changenumberrecordperpage', ['uses' => 'DMaster\ProgramKegiatanController@changenumberrecordperpage', 'as' => 'kegiatan.changenumberrecordperpage']);
    Route::post('/dmaster/programkegiatan/orderby', ['uses' => 'DMaster\ProgramKegiatanController@orderby', 'as' => 'kegiatan.orderby']);

    //masters - mapping program ke OPD [mapping]
    Route::resource('/dmaster/mappingprogramtoopd', 'DMaster\MappingProgramToOPDController', [
        'parameters' => ['mappingprogramtoopd' => 'uuid'],
        'only' => ['index', 'show']
    ]);
    Route::post('/dmaster/mappingprogramtoopd/search', ['uses' => 'DMaster\MappingProgramToOPDController@search', 'as' => 'mappingprogramtoopd.search']);
    Route::post('/dmaster/mappingprogramtoopd/filter', ['uses' => 'DMaster\MappingProgramToOPDController@filter', 'as' => 'mappingprogramtoopd.filter']);
    Route::post('/dmaster/mappingprogramtoopd/filtercreate', ['uses' => 'DMaster\MappingProgramToOPDController@filtercreate', 'as' => 'mappingprogramtoopd.filtercreate']);
    Route::get('/dmaster/mappingprogramtoopd/paginate/{id}', ['uses' => 'DMaster\MappingProgramToOPDController@paginate', 'as' => 'mappingprogramtoopd.paginate']);
    Route::post('/dmaster/mappingprogramtoopd/orderby', ['uses' => 'DMaster\MappingProgramToOPDController@orderby', 'as' => 'mappingprogramtoopd.orderby']);

    //masters - mapping program ke OPD [mapping]
    Route::resource('/dmaster/asn', 'DMaster\ASNController', [
        'parameters' => ['asn' => 'uuid'],
    ]);
    Route::post('/dmaster/asn/search', ['uses' => 'DMaster\ASNController@search', 'as' => 'asn.search']);
    Route::post('/dmaster/asn/filter', ['uses' => 'DMaster\ASNController@filter', 'as' => 'asn.filter']);
    Route::post('/dmaster/asn/filtercreate', ['uses' => 'DMaster\ASNController@filtercreate', 'as' => 'asn.filtercreate']);
    Route::get('/dmaster/asn/paginate/{id}', ['uses' => 'DMaster\ASNController@paginate', 'as' => 'asn.paginate']);
    Route::post('/dmaster/asn/orderby', ['uses' => 'DMaster\ASNController@orderby', 'as' => 'asn.orderby']);

    //masters - transaksi
    Route::resource('/dmaster/transaksi', 'DMaster\TransaksiController', [
        'parameters' => ['transaksi' => 'uuid'],
    ]);
    Route::post('/dmaster/transaksi/search', ['uses' => 'DMaster\TransaksiController@search', 'as' => 'transaksi.search']);
    Route::post('/dmaster/transaksi/filter', ['uses' => 'DMaster\TransaksiController@filter', 'as' => 'transaksi.filter']);
    Route::post('/dmaster/transaksi/filtercreate', ['uses' => 'DMaster\TransaksiController@filtercreate', 'as' => 'transaksi.filtercreate']);
    Route::get('/dmaster/transaksi/paginate/{id}', ['uses' => 'DMaster\TransaksiController@paginate', 'as' => 'transaksi.paginate']);
    Route::post('/dmaster/transaksi/orderby', ['uses' => 'DMaster\TransaksiController@orderby', 'as' => 'transaksi.orderby']);

    //masters - jenis
    Route::resource('/dmaster/jenis', 'DMaster\JenisController', [
        'parameters' => ['transaksi' => 'uuid'],
    ]);
    Route::post('/dmaster/jenis/search', ['uses' => 'DMaster\JenisController@search', 'as' => 'jenis.search']);
    Route::post('/dmaster/jenis/filter', ['uses' => 'DMaster\JenisController@filter', 'as' => 'jenis.filter']);
    Route::post('/dmaster/jenis/filtercreate', ['uses' => 'DMaster\JenisController@filtercreate', 'as' => 'jenis.filtercreate']);
    Route::get('/dmaster/jenis/paginate/{id}', ['uses' => 'DMaster\JenisController@paginate', 'as' => 'jenis.paginate']);
    Route::post('/dmaster/jenis/orderby', ['uses' => 'DMaster\JenisController@orderby', 'as' => 'jenis.orderby']);

    //masters - rincian
    Route::resource('/dmaster/rincian', 'DMaster\RincianController', [
        'parameters' => ['transaksi' => 'uuid'],
    ]);
    Route::post('/dmaster/rincian/search', ['uses' => 'DMaster\RincianController@search', 'as' => 'rincian.search']);
    Route::post('/dmaster/rincian/filter', ['uses' => 'DMaster\RincianController@filter', 'as' => 'rincian.filter']);
    Route::post('/dmaster/rincian/filtercreate', ['uses' => 'DMaster\RincianController@filtercreate', 'as' => 'rincian.filtercreate']);
    Route::get('/dmaster/rincian/paginate/{id}', ['uses' => 'DMaster\RincianController@paginate', 'as' => 'rincian.paginate']);
    Route::post('/dmaster/rincian/orderby', ['uses' => 'DMaster\RincianController@orderby', 'as' => 'rincian.orderby']);

    //masters - kelompok
    Route::resource('/dmaster/kelompok', 'DMaster\KelompokController', [
        'parameters' => ['transaksi' => 'uuid'],
    ]);
    Route::post('/dmaster/kelompok/search', ['uses' => 'DMaster\KelompokController@search', 'as' => 'kelompok.search']);
    Route::post('/dmaster/kelompok/filter', ['uses' => 'DMaster\KelompokController@filter', 'as' => 'kelompok.filter']);
    Route::post('/dmaster/kelompok/filtercreate', ['uses' => 'DMaster\KelompokController@filtercreate', 'as' => 'kelompok.filtercreate']);
    Route::get('/dmaster/kelompok/paginate/{id}', ['uses' => 'DMaster\KelompokController@paginate', 'as' => 'kelompok.paginate']);
    Route::post('/dmaster/kelompok/orderby', ['uses' => 'DMaster\KelompokController@orderby', 'as' => 'kelompok.orderby']);

    // RKA Kegiatan Murni
    Route::resource('/rka/rkakegiatanmurni', 'RKA\RKAKegiatanMurniController', ['parameters' => ['rkakegiatanmurni' => 'uuid']]);
    Route::get('/rka/rkakegiatanmurni/create1/{uuid}', ['uses' => 'RKA\RKAKegiatanMurniController@create1', 'as' => 'rkakegiatanmurni.create1']);
    Route::post('/rka/rkakegiatanmurni/changetab', ['uses' => 'RKA\RKAKegiatanMurniController@changetab', 'as' => 'rkakegiatanmurni.changetab']);
    Route::post('/rka/rkakegiatanmurni/search', ['uses' => 'RKA\RKAKegiatanMurniController@search', 'as' => 'rkakegiatanmurni.search']);
    Route::post('/rka/rkakegiatanmurni/filter', ['uses' => 'RKA\RKAKegiatanMurniController@filter', 'as' => 'rkakegiatanmurni.filter']);
    Route::get('/rka/rkakegiatanmurni/paginate/{id}', ['uses' => 'RKA\RKAKegiatanMurniController@paginate', 'as' => 'rkakegiatanmurni.paginate']);
    Route::post('/rka/rkakegiatanmurni/changenumberrecordperpage', ['uses' => 'RKA\RKAKegiatanMurniController@changenumberrecordperpage', 'as' => 'rkakegiatanmurni.changenumberrecordperpage']);
    Route::post('/rka/rkakegiatanmurni/orderby', ['uses' => 'RKA\RKAKegiatanMurniController@orderby', 'as' => 'rkakegiatanmurni.orderby']);


    //setting - permissions    
    Route::resource('/setting/permissions', 'Setting\PermissionsController', [
        'parameters' => ['permissions' => 'id'],
        'only' => ['index', 'show', 'create', 'store', 'destroy']
    ]);

    Route::get('/setting/permissions/paginate/{id}', ['uses' => 'Setting\PermissionsController@paginate', 'as' => 'permissions.paginate']);
    Route::post('/setting/permissions/search', ['uses' => 'Setting\PermissionsController@search', 'as' => 'permissions.search']);
    Route::post('/setting/permissions/changenumberrecordperpage', ['uses' => 'Setting\PermissionsController@changenumberrecordperpage', 'as' => 'permissions.changenumberrecordperpage']);
    Route::post('/setting/permissions/orderby', ['uses' => 'Setting\PermissionsController@orderby', 'as' => 'permissions.orderby']);

    //setting - roles
    Route::resource('/setting/roles', 'Setting\RolesController', ['parameters' => ['roles' => 'id']]);
    Route::get('/setting/roles/paginate/{id}', ['uses' => 'Setting\RolesController@paginate', 'as' => 'roles.paginate']);
    Route::post('/setting/roles/changenumberrecordperpage', ['uses' => 'Setting\RolesController@changenumberrecordperpage', 'as' => 'roles.changenumberrecordperpage']);
    Route::post('/setting/roles/orderby', ['uses' => 'Setting\RolesController@orderby', 'as' => 'roles.orderby']);
    Route::post('/setting/roles/storerolepermission', ['uses' => 'Setting\RolesController@storerolepermission', 'as' => 'roles.storerolepermission']);

    //setting - users
    Route::resource('/setting/users', 'Setting\UsersController', ['parameters' => ['users' => 'id']])->middleware(['auth', 'role:superadmin']);
    Route::get('/setting/users/paginatecreate/{id}', ['uses' => 'Setting\UsersController@paginate', 'as' => 'users.paginate'])->middleware(['auth', 'role:superadmin']);
    Route::get('/setting/users/profil/{id}', ['uses' => 'Setting\UsersController@profil', 'as' => 'users.profil']);
    Route::put('/setting/users/updateprofil/{id}', ['uses' => 'Setting\UsersController@updateprofil', 'as' => 'users.updateprofil']);
    Route::post('/setting/users/changenumberrecordperpage', ['uses' => 'Setting\UsersController@changenumberrecordperpage', 'as' => 'users.changenumberrecordperpage'])->middleware(['auth', 'role:superadmin']);
    Route::post('/setting/users/orderby', ['uses' => 'Setting\UsersController@orderby', 'as' => 'users.orderby'])->middleware(['auth', 'role:superadmin']);
    Route::post('/setting/users/search', ['uses' => 'Setting\UsersController@search', 'as' => 'users.search'])->middleware(['auth', 'role:superadmin']);
    Route::post('/setting/users/filter', ['uses' => 'Setting\UsersController@filter', 'as' => 'users.filter'])->middleware(['auth', 'role:superadmin']);

    //setting - users bapelitbang
    Route::resource('/setting/usersbapelitbang', 'Setting\UsersBapelitbangController', ['parameters' => ['usersbapelitbang' => 'id']]);
    Route::get('/setting/usersbapelitbang/paginatecreate/{id}', ['uses' => 'Setting\UsersBapelitbangController@paginate', 'as' => 'usersbapelitbang.paginate']);
    Route::post('/setting/usersbapelitbang/changenumberrecordperpage', ['uses' => 'Setting\UsersBapelitbangController@changenumberrecordperpage', 'as' => 'usersbapelitbang.changenumberrecordperpage']);
    Route::post('/setting/usersbapelitbang/orderby', ['uses' => 'Setting\UsersBapelitbangController@orderby', 'as' => 'usersbapelitbang.orderby']);
    Route::post('/setting/usersbapelitbang/search', ['uses' => 'Setting\UsersBapelitbangController@search', 'as' => 'usersbapelitbang.search']);
    Route::post('/setting/usersbapelitbang/filter', ['uses' => 'Setting\UsersBapelitbangController@filter', 'as' => 'usersbapelitbang.filter']);

    //setting - users OPD
    Route::resource('/setting/usersopd', 'Setting\UsersOPDController', ['parameters' => ['usersopd' => 'id']]);
    Route::post('/setting/usersopd/store1/{id}', ['uses' => 'Setting\UsersOPDController@store1', 'as' => 'usersopd.store1']);
    Route::put('/setting/usersopd/changelocked/{id}', ['uses' => 'Setting\UsersOPDController@changelocked', 'as' => 'usersopd.changelocked']);
    Route::get('/setting/usersopd/paginate/{id}', ['uses' => 'Setting\UsersOPDController@paginate', 'as' => 'usersopd.paginate']);
    Route::post('/setting/usersopd/changenumberrecordperpage', ['uses' => 'Setting\UsersOPDController@changenumberrecordperpage', 'as' => 'usersopd.changenumberrecordperpage']);
    Route::post('/setting/usersopd/orderby', ['uses' => 'Setting\UsersOPDController@orderby', 'as' => 'usersopd.orderby']);
    Route::post('/setting/usersopd/search', ['uses' => 'Setting\UsersOPDController@search', 'as' => 'usersopd.search']);
    Route::post('/setting/usersopd/filter', ['uses' => 'Setting\UsersOPDController@filter', 'as' => 'usersopd.filter']);
    Route::post('/setting/usersopd/storeuserpermission', ['uses' => 'Setting\UsersOPDController@storeuserpermission', 'as' => 'usersopd.storeuserpermission']);
});
