<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class SumberDanaModel extends Model {
    use LogsActivity;
     /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'tmSumberDana';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'SumberDanaID', 'Kd_SumberDana', 'Kd_SumberDana', 'Nm_SumberDana', 'Descr', 'TA'
    ];
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'SumberDanaID';
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
    // protected static $logName = 'SumberDanaController';
    /**
     * log the changed attributes for all these events 
     */
    protected static $logAttributes = [
        'SumberDanaID', 'Kd_SumberDana', 'Kd_SumberDana', 'Nm_SumberDana', 'Descr', 'TA'
    ];
    /**
     * log changes to all the $fillable attributes of the model
     */
    // protected static $logFillable = true;

    //only the `deleted` event will get logged automatically
    // protected static $recordEvents = ['deleted'];

    /**
     * digunakan untuk mendapatkan daftar sumber dana
     */
    public static function getDaftarSumberDana($ta,$prepend=true) 
    {
        $daftar_sumberdana = $prepend==true?SumberDanaModel::where('TA',$ta)->orderBy('Kd_SumberDana','asc')->get()->pluck('Nm_SumberDana', 'SumberDanaID')->prepend('DAFTAR SUMBER DANA','none')->toArray():
                                            SumberDanaModel::where('TA',$ta)->orderBy('Kd_SumberDana','asc')->get()->pluck('Nm_SumberDana', 'SumberDanaID')->toArray();

        return $daftar_sumberdana;
    }
}