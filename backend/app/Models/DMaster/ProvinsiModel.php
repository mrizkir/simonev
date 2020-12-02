<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;

class ProvinsiModel extends Model {    
     /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'tmPMProv';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'PMProvID', 
        'Kd_Prov', 
        'Nm_Prov', 
        'lat',
        'lng',
        'Descr',         
    ];
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'PMProvID';
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
