<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class JenisPelaksanaanModel extends Model {
    use LogsActivity;
     /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'tmJenisPelaksanaan';
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'JenisPelaksanaanID';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'JenisPelaksanaanID', 'NamaJenis', 'Descr','TA'
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
    protected static $logName = 'JenisPelaksanaanController';
    /**
     * log the changed attributes for all these events 
     */
    protected static $logAttributes = ['JenisPelaksanaanID','NamaJenis'];
    /**
     * log changes to all the $fillable attributes of the model
     */
    // protected static $logFillable = true;

    //only the `deleted` event will get logged automatically
    // protected static $recordEvents = ['deleted'];

    public static function getJenisPelaksanaan ($ta,$prepend=true) 
    {
        $r=JenisPelaksanaanModel::where('TA',$ta)->orderBy('NamaJenis')->get();
        $jenis_pelaksanaan=($prepend==true)?['none'=>'DAFTAR JENIS PELAKSANAAN']:[];        
        foreach ($r as $k=>$v)
        {
            $jenis_pelaksanaan[$v->JenisPelaksanaanID]=$v->NamaJenis;
        } 
        return $jenis_pelaksanaan;
    }
}
