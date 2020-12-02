<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;

class ASNModel extends Model {    
     /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'tmASN';
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'ASNID';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ASNID', 'NIP_ASN', 'Nm_ASN', 'Descr','TA', 'Active'
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
