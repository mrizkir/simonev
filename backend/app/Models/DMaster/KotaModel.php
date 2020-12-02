<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;

class KotaModel extends Model {
     /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'tmPmKota';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'PmKotaID', 
        'PMProvID', 
        'Kd_Kota', 
        'Nm_Kota', 
        'lat',
        'lng',
        'Descr',         
    ];
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'PmKotaID';
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
