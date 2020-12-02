<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;

class JenisPelaksanaanModel extends Model {
     /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'tmJenisPelaksanaan';
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'JenisPelaksanaanID';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'JenisPelaksanaanID', 'NamaJenis', 'Descr','TA'
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
