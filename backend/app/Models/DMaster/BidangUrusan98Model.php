<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;

class BidangUrusan98Model extends Model
{
    /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'tmUrs98';
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'UrsID';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'UrsID', 
        'KUrsID', 
        'Kd_Bidang', 
        'Nm_Bidang', 
        'Descr',
        'TA',
        'UrsID_Src',
        'Locked',
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