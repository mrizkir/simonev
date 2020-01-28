<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class JenisPembangunanModel extends Model {
    use LogsActivity;
     /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'tmJenisPembangunan';
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'JenisPembangunanID';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'JenisPembangunanID', 'NamaJenis', 'Descr','TA'
    ];
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
    protected static $logName = 'JenisPembangunanController';
    /**
     * log the changed attributes for all these events 
     */
    protected static $logAttributes = ['JenisPembangunanID','NamaJenis'];
    /**
     * log changes to all the $fillable attributes of the model
     */
    // protected static $logFillable = true;

    //only the `deleted` event will get logged automatically
    // protected static $recordEvents = ['deleted'];

    public static function getJenisPembangunan ($ta,$prepend=true) 
    {
        $r=JenisPembangunanModel::where('TA',$ta)->orderBy('NamaJenis')->get();
        $jenis_pelaksanaan=($prepend==true)?['none'=>'DAFTAR JENIS PEMBANGUNAN']:[];        
        foreach ($r as $k=>$v)
        {
            $jenis_pelaksanaan[$v->JenisPembangunanID]=$v->NamaJenis;
        } 
        return $jenis_pelaksanaan;
    }
}
