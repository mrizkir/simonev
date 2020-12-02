<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;

class KelompokModel extends Model
{
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
}