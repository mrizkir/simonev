<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistik1Model extends Model {
     /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'statistik1';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'statistikID', 'PaguDana1', 'PaguDana2','JumlahProgram1', 'JumlahProgram2', 'JumlahKegiatan1', 'JumlahKegiatan2', 'RealisasiKeuangan1', 'RealisasiKeuangan2','RealisasiFisik1','RealisasiFisik2'
    ];
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'statistikID';
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
