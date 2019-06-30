<?php

return [
    //setting general
    'nama_institusi'=>env('SIMONEV_NAMA_INSTITUSI'),
    'tahun_perencanaan'=>env('SIMONEV_TAHUN_PERENCANAAN'),
    'tahun_penyerapan'=>env('SIMONEV_TAHUN_PENYERAPAN'),
    'default_provinsi'=>env('SIMONEV_DEFAULT_PROVINSI'),
    'defaul_kota_atau_kab'=>env('SIMONEV_DEFAULT_KOTA_KAB'),

    //setting rpjmd
    'rpjmd_tahun_mulai'=>env('SIMONEV_RPJMD_TAHUN_MULAI'),
    'rpjmd_tahun_akhir'=>env('SIMONEV_RPJMD_TAHUN_AKHIR'),
    'renstra_tahun_mulai'=>env('SIMONEV_RENSTRA_TAHUN_MULAI'),
    'renstra_tahun_akhir'=>env('SIMONEV_RENSTRA_TAHUN_AKHIR'),

    /**
     * Saat mengekspor dan mingimpor file, e-Planning membutuhkan lokasi tempat penyimpanan sementara
     * disini anda bisa mengganti lokasinya.
     */
    'local_path' => env('SIMONEV_LOCAL_PATH', sys_get_temp_dir()),

    'log_pattern' => env('SIMONEV_LOG_PATTERN', '*.log'),
    'storage_path' => env('SIMONEV_STORAGE_PATH', storage_path('logs')),
];