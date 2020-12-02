<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;

class JenisPembangunanModel extends Model {
     /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'tmJenisPembangunan';
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'JenisPembangunanID';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'JenisPembangunanID', 'NamaJenis', 'Descr','TA'
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
