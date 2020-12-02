<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;

class TransaksiModel extends Model
{
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
        'StrID', 'Kd_Rek_1', 'StrNm', 'Descr', 'TA'
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