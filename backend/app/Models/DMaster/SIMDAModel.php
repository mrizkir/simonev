<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;

class SIMDAModel extends Model {
     /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'simda';    
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'TepraID';
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
