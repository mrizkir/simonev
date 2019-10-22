<?php

namespace App\Models\Report;

use Illuminate\Database\Eloquent\Model;

class StatistikTargetKinerjaModel extends Model {
    
     /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 's_targetkinerja_opd';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'TargetKinerjaID',
        'OrgID',
        'OrgNm',                       
        'jumlah_kegiatan1',                       
        'jumlah_kegiatan2',                       
        'jumlah_uraian1',                       
        'jumlah_uraian2',                       
        'pagudinas1',                       
        'pagudinas2',                       
        'pagupembanding1',                       
        'pagupembanding2',                       
        'target_fisik1',                       
        'target_fisik2',                       
        'realisasi_fisik1',                       
        'realisasi_fisik2',                       
        'persen_target_keuangan1',                       
        'persen_target_keuangan2',                       
        'persen_realisasi_keuangan1',                       
        'persen_realisasi_keuangan2',                       
        'target_keuangan1',                       
        'target_keuangan2',                       
        'realisasi_keuangan1',                       
        'realisasi_keuangan2',                       
        'sisa_pagu1',                       
        'sisa_pagu2',                       
        'persen_sisa_pagu1',                       
        'persen_sisa_pagu2',                       
        'bobot1',                       
        'bobot2',                       
        'bulan',                                   
        'TA',                   
        'EntryLvl'        
    ];
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'TargetKinerjaID';
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
