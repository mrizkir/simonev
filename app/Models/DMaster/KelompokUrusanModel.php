<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class KelompokUrusanModel extends Model {
    use LogsActivity;
     /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'tmKUrs';
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'KUrsID';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'KUrsID', 'RpjmdVisiID', 'Kd_Urusan', 'Nm_Urusan', 'Descr','TA',
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
    protected static $logName = 'KelompokUrusanController';
    /**
     * log the changed attributes for all these events 
     */
    protected static $logAttributes = ['KUrsID','Kd_Urusan', 'Nm_Urusan'];
    /**
     * log changes to all the $fillable attributes of the model
     */
    // protected static $logFillable = true;

    //only the `deleted` event will get logged automatically
    // protected static $recordEvents = ['deleted'];

    public static function getKelompokUrusan ($ta,$prepend=true) 
    {
        $r=KelompokUrusanModel::where('TA',$ta)->orderBy('Kd_Urusan')->get();
        $kelompok_urusan=($prepend==true)?['none'=>'DAFTAR KELOMPOK URUSAN']:[];        
        foreach ($r as $k=>$v)
        {
            $kelompok_urusan[$v->KUrsID]=$v->Kd_Urusan.'. '.$v->Nm_Urusan;
        } 
        return $kelompok_urusan;
    }
}
