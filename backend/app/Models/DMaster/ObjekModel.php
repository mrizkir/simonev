<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;

class ObjekModel extends Model
{
    /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'tmROby';
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'RObyID';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'RObyID', 'ObyID', 'Kd_Rek_5', 'RObyNm', 'Descr', 'TA'
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