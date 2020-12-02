<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;

class SubOrganisasiModel extends Model {
     /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'tmSOrg';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'SOrgID', 
        'OrgID', 
        'Nm_Urusan', 
        'kode_organisasi', 
        'OrgNm', 
        'kode_suborganisasi', 
        'SOrgNm', 
        'SOrgAlias', 
        'Alamat', 
        'NamaKepalaUnitKerja', 
        'NIPKepalaUnitKerja', 
        'PaguDana1',
        'PaguDana2',
        'JumlahProgram',
        'JumlahProgram2',        
        'JumlahKegiatan',
        'JumlahKegiatan2',        
        'RealisasiKeuangan1',            
        'RealisasiKeuangan2',        
        'RealisasiFisik1',        
        'RealisasiFisik2',
        'Descr', 
        'TA'
    ];
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'SOrgID';
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

    public function OPD ()
    {
        return $this->belongsTo('App\DMaster\OrganisasiModel','OrgID','OrgID');
    }

}
