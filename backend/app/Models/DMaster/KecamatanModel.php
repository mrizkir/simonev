<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;
class KecamatanModel extends Model {

     /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'tmPmKecamatan';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'PmKecamatanID', 
        'PmKotaID', 
        'Kd_Kecamatan', 
        'Nm_Kecamatan', 
        'lat',
        'lng',
        'Descr',         
    ];
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'PmKecamatanID';
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

    public function desa ()
    {
        return $this->hasMany('App\Models\DMaster\DesaModel','PmKecamatanID','PmKecamatanID');
    }
}