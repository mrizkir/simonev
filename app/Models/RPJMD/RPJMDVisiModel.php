<?php
namespace App\Models\RPJMD;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class RPJMDVisiModel extends Model {
    use LogsActivity;
     /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'tmRpjmdVisi';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'RpjmdVisiID', 'Nm_RpjmdVisi', 'Descr', 'TA_Awal'
    ];
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'RpjmdVisiID';
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
    protected static $logName = 'RPJMDVisiController';
    /**
     * log the changed attributes for all these events 
     */
    protected static $logAttributes = ['RpjmdVisiID', 'Nm_RpjmdVisi'];
    /**
     * log changes to all the $fillable attributes of the model
     */
    // protected static $logFillable = true;
    //only the `deleted` event will get logged automatically
    // protected static $recordEvents = ['deleted'];
}