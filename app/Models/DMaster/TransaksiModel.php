<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class TransaksiModel extends Model
{
    use LogsActivity;
    /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'tmStr';
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'StrID';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'StrID', 'Kd_Rek_1', 'StrNm', 'Descr', 'TA', 'StrID_Src'
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
    protected static $logName = 'TransaksiController';
    /**
     * log the changed attributes for all these events 
     */
    protected static $logAttributes = ['StrID', 'Kd_Rek_1', 'StrNm', 'Descr'];
    /**
     * log changes to all the $fillable attributes of the model
     */
}
