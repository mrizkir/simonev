<?php

namespace App\Models\RKA;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class RKARencanaTargetFisikModel extends Model 
{
    use LogsActivity;

     /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'trRKATargetRinc';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'RKATargetRincID', 
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
        'StatusIsiKeuangan1',         
        'hasil2StatusIsiKeuangan2',         
        'StatusIsiFisik1',         
        'StatusIsiFisik2',   
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
    protected $primaryKey = 'RKATargetRincID';
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
    protected static $logAttributes = ['RKATargetRincID', 'RKARincID', 'target1', 'target2'];
    /**
     * log changes to all the $fillable attributes of the model
     */
    // protected static $logFillable = true;

    //only the `deleted` event will get logged automatically
    // protected static $recordEvents = ['deleted'];
}
