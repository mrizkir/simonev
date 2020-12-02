<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;

class SumberDanaModel extends Model {
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

}