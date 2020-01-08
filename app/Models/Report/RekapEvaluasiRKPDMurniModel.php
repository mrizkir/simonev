<?php

namespace App\Models\Report;

use Illuminate\Database\Eloquent\Model;

class RekapEvaluasiRKPDMurniModel extends Model {
    
     /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'rekap_evaluasi_rkpd_murni';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'TA',
        'kode',
        'PrioritasSasaranKabID',                       
        'Nm_Sasaran',                       
        'Nm_Urusan',                       
        'Nm_Bidang',                       
        'PrgNm',                       
        'KgtNm',                       
        'ik_program',                       
        'ik_kegiatan',                       
        't_rpjmd_n_k',                       
        't_rpjmd_n_rp',                       
        'rck_rpjmd_n_min_2_k',                       
        'rck_rpjmd_n_min_2_rp',                       
        'tk_rkpd_n_min_1_k',                       
        'tk_rkpd_n_min_1_rp',                       
        'rk_tw1_k',                       
        'rk_tw1_rp',                       
        'rk_tw2_k',                       
        'rk_tw2_rp',                       
        'rk_tw3_k',                       
        'rk_tw3_rp',                       
        'rk_tw4_k',                       
        'rk_tw4_rp',                       
        'rck_rkpd_k',                       
        'rck_rkpd_rp',                       
        'rk_rpjmd_sd_n_k',                       
        'rk_rpjmd_sd_n_rp',                       
        'OrgID',                       
        'OrgNm',
    ];
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = null;
    /**
     * enable auto_increment.
     *
     * @var string
     */
    public $incrementing = false;
    /**
     * activated timestamps.
     *
     * @var string
     */
    public $timestamps = true;
}
