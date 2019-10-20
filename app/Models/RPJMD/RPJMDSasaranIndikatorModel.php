<?php

namespace App\Models\RPJMD;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class RPJMDSasaranIndikatorModel extends Model {
    use LogsActivity;
     /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'tmPrioritasIndikatorSasaran';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'PrioritasIndikatorSasaranID', 
        'PrioritasSasaranKabID', 
        'NamaIndikator', 
        'KondisiAwal', 
        'N1', 
        'N2', 
        'N3', 
        'N4', 
        'N5', 
        'KondisiAkhir', 
        'Satuan', 
        'Descr', 
        'TA', 
        'PrioritasIndikatorSasaranID_Src'
    ];
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'PrioritasIndikatorSasaranID';
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
    protected static $logName = 'RPJMDSasaranController';
    /**
     * log the changed attributes for all these events 
     */
    protected static $logAttributes = ['PrioritasIndikatorSasaranID', 'NamaIndikator'];
    /**
     * log changes to all the $fillable attributes of the model
     */
    // protected static $logFillable = true;

    //only the `deleted` event will get logged automatically
    // protected static $recordEvents = ['deleted'];
    
    public function sasaran()
    {
        return $this->belongsTo('\App\Models\RPJMD\RPJMDSasaranModel','PrioritasSasaranKabID');
    }
}
