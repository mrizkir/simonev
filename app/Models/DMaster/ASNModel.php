<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ASNModel extends Model {
    use LogsActivity;
     /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'tmASN';
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'ASNID';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ASNID', 'NIP_ASN', 'Nm_ASN', 'Descr','TA', 'Active'
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
    protected static $logName = 'ASNController';
    /**
     * log the changed attributes for all these events 
     */
    protected static $logAttributes = ['ASNID','NIP_ASN', 'Nm_ASN'];
    /**
     * log changes to all the $fillable attributes of the model
     */
    // protected static $logFillable = true;

    //only the `deleted` event will get logged automatically
    // protected static $recordEvents = ['deleted'];

    public static function getASN ($ta,$prepend=true) 
    {
        $r=ASNModel::where('TA',$ta)->orderBy('Kd_ASN')->get();
        $kelompok_urusan=($prepend==true)?['none'=>'DAFTAR ASN']:[];        
        foreach ($r as $k=>$v)
        {
            $kelompok_urusan[$v->ASNID]=$v->Kd_ASN.'. '.$v->Nm_ASN;
        } 
        return $kelompok_urusan;
    }
}
