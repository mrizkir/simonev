<?php

namespace App\Models\Belanja;

use Illuminate\Database\Eloquent\Model;

class RKAModel extends Model 
{

     /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'trRKA';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'RKAID', 
        'OrgID', 
        'SOrgID', 
        'PrgID', 
        'KgtID', 
        'KgtNm',         
        'keluaran1',         
        'keluaran2',         
        'tk_keluaran1',         
        'tk_keluaran2',         
        'hasil1',         
        'hasil2',         
        'tk_hasil1',         
        'tk_hasil2',         
        'capaian_program1',  
        'capaian_program2',  
        'tk_capaian1',                
        'tk_capaian2',                
        'masukan1',         
        'masukan2',         
        'ksk1',         
        'ksk2',         
        'sifat_kegiatan1',   
        'sifat_kegiatan2',   
        'waktu_pelaksanaan1',         
        'waktu_pelaksanaan2',         
        'lokasi_kegiatan1',      
        'lokasi_kegiatan2',      
        'PaguDana1', 
        'PaguDana2',        
        'RealisasiKeuangan1', 
        'RealisasiKeuangan2',        
        'RealisasiFisik1',        
        'RealisasiFisik2',        
        'nip_pa1', 
        'nip_pa2', 
        'nip_kpa1', 
        'nip_kpa2', 
        'nip_ppk1', 
        'nip_ppk2', 
        'nip_pptk1', 
        'nip_pptk2', 
        'user_id', 
        'EntryLvl', 
        'Descr', 
        'TA', 
        'Locked',
        'RKAID_Src'
    ];
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'RKAID';
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
