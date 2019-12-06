<?php

namespace App\Models\RKA;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class RKARincianKegiatanModel extends Model 
{
    use LogsActivity;

     /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'trRKARinc';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'RKARincID', 
        'RKAID', 
        'RObyID', 
        'JenisPelaksanaanID', 
        'nama_uraian', 
        'volume1', 
        'volume2', 
        'satuan1',         
        'satuan2',         
        'harga_satuan1',  
        'harga_satuan2',  
        'pagu_uraian1',         
        'pagu_uraian2',         
        'EntryLvl',         
        'Descr',         
        'TA',         
        'Locked',  
        'RKARincIDSrc',                       
    ];
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'RKARincID';
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
    protected static $logName = 'APBDMurniController';
    /**
     * log the changed attributes for all these events 
     */
    protected static $logAttributes = ['RKARincID', 'nama_uraian', 'pagu_uraian1'];
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
