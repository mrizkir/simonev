<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;

class PejabatModel extends Model {
     /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'trRiwayatJabatanASN';
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'RiwayatJabatanASNID';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'RiwayatJabatanASNID', 'ASNID', 'OrgID', 'Jenis_Jabatan','TA'
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
