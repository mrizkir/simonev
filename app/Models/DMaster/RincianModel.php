<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class RincianModel extends Model
{
    use LogsActivity;
    /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'tmOby';
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'ObyID';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ObyID', 'JnsID', 'Kd_Rek_4', 'ObyNm', 'Descr', 'TA'
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
    protected static $logName = 'RincianController';
    /**
     * log the changed attributes for all these events 
     */
    protected static $logAttributes = ['ObyID', 'JnsID', 'Kd_Rek_4', 'ObyNm', 'Descr', 'TA'];
    /**
     * log changes to all the $fillable attributes of the model
     */
}
