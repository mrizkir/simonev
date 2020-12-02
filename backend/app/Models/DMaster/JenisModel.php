<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;

class JenisModel extends Model
{
    /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'tmJns';
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'JnsID';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'JnsID', 'KlpID', 'Kd_Rek_3', 'JnsNm', 'Descr', 'TA'
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