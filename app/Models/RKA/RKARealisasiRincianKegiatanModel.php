<?php

namespace App\Models\RKA;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class RKARealisasiRincianKegiatanModel extends Model 
{
    use LogsActivity;

     /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'trRKARealisasiRinc';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'RKARealisasiRincID', 
        'RKAID', 
        'RKARincID', 
        'bulan1', 
        'bulan2', 
        'target1', 
        'target2',         
        'realisasi1',  
        'realisasi2',         
        'fisik1',         
        'fisik2',         
        'EntryLvl',         
        'Descr',         
        'TA',         
        'Locked',  
        'RKARealisasiRincID_Src',                       
    ];
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'RKARealisasiRincID';
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
    protected static $logName = 'RKAKegiatanMurniController';
    /**
     * log the changed attributes for all these events 
     */
    protected static $logAttributes = ['RKARincID', 'RKARincID', 'realisasi1', 'realisasi2'];
    /**
     * log changes to all the $fillable attributes of the model
     */
    // protected static $logFillable = true;

    //only the `deleted` event will get logged automatically
    // protected static $recordEvents = ['deleted'];
    
    public function rka()
    {
        return $this->belongsTo('\App\Models\RKA\RKAKegiatanModel','RKAID');
    }
}
