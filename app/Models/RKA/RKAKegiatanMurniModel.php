<?php

namespace App\Models\RKA;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class RKAKegiatanMurniModel extends Model 
{
    use LogsActivity;

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
        'RKPDID',         
        'SumberDanaID',  
        'keluaran',         
        'tk_keluaran',         
        'hasil',         
        'tk_hasil',         
        'capaian_program',  
        'tk_capaian',                
        'masukan',         
        'ksk',         
        'sifat_kegiatan',   
        'waktu_pelaksanaan',         
        'lokasi_kegiatan',      
        'PaguDana1', 
        'PaguDana2',        
        'nip_pa', 
        'nip_kpa', 
        'nip_ppk', 
        'nip_pptk', 
        'user_id', 
        'EntryLvl', 
        'Descr', 
        'TA', 
        'Locked'
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

    /**
     * make the model use another name than the default
     *
     * @var string
     */
    // protected static $logName = 'RKAKegiatanMurniController';
    /**
     * log the changed attributes for all these events 
     */
    protected static $logAttributes = ['RKAID', 'KgtNm', 'PaguDana1', 'PaguDana1'];
    /**
     * log changes to all the $fillable attributes of the model
     */
    // protected static $logFillable = true;

    //only the `deleted` event will get logged automatically
    // protected static $recordEvents = ['deleted'];
}
