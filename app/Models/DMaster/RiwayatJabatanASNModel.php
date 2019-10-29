<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class RiwayatJabatanASNModel extends Model {
    use LogsActivity;
     /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'trRiwayatJabatanASN';
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'RiwayatJabatanASNID';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'RiwayatJabatanASNID', 'ASNID', 'OrgID', 'Jenis_Jabatan','TA'
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
    protected static $logAttributes = ['RiwayatJabatanASNID','ASNID', 'OrgID'];
    /**
     * log changes to all the $fillable attributes of the model
     */
    // protected static $logFillable = true;

    //only the `deleted` event will get logged automatically
    // protected static $recordEvents = ['deleted'];

}
