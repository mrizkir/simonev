<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;

class Urusan98Model extends Model
{
    /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'tmKUrs98';
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
        'KUrsID', 
        'RpjmdVisiID', 
        'Kd_Urusan', 
        'Nm_Urusan', 
        'Descr',
        'TA',
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
}