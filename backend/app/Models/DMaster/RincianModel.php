<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;

class RincianModel extends Model
{
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
}