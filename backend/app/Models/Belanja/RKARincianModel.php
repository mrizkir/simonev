<?php

namespace App\Models\Belanja;

use Illuminate\Database\Eloquent\Model;

class RKARincianModel extends Model 
{
     /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'trRKARinc';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'RKARincID',
        'RKAID',
        'JenisPelaksanaanID',
        'SumberDanaID',
        'JenisPembangunanID',            
        'volume1',
        'volume2',
        'satuan1',            
        'satuan2',            
        'harga_satuan1',
        'harga_satuan2',                        
        'idlok',
        'ket_lok',
        'rw',
        'rt',
        'nama_perusahaan',
        'alamat_perusahaan',
        'no_telepon',
        'nama_direktur',
        'npwp',
        'no_kontrak',
        'tgl_kontrak',
        'tgl_mulai_pelaksanaan',
        'tgl_selesai_pelaksanaan',
        'status_lelang',
        'EntryLvl',
        'Descr',            
        'TA',
        'Locked',
        'RKARincID_Src',                    
    ];
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'RKARincID';
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
