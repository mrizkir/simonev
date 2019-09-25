<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class KelompokModel extends Model
{
    use LogsActivity;
    /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'tmKlp';
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'KlpID';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'KlpID', 'StrID', 'Kd_Rek_2', 'KlpNm', 'Descr', 'TA'
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
    protected static $logName = 'KelompokController';
    /**
     * log the changed attributes for all these events 
     */
    protected static $logAttributes = ['KlpID', 'StrID', 'Kd_Rek_2', 'KlpNm', 'Descr', 'TA'];
    /**
     * log changes to all the $fillable attributes of the model
     */
}
