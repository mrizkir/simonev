<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class OrganisasiRPJMDModel extends Model {
    use LogsActivity;
     /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'tmOrgRPJMD';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'OrgIDRPJMD', 'UrsID', 'OrgCd', 'OrgNm', 'OrgAlias', 'Alamat', 'Descr', 'TA'
    ];
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'OrgIDRPJMD';
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

    /**
     * make the model use another name than the default
     *
     * @var string
     */
    protected static $logName = 'OrganisasiMasterController';
    /**
     * log the changed attributes for all these events 
     */
    protected static $logAttributes = ['OrgIDRPJMD', 'OrgCd', 'OrgNm'];
    /**
     * log changes to all the $fillable attributes of the model
     */
    // protected static $logFillable = true;

    //only the `deleted` event will get logged automatically
    // protected static $recordEvents = ['deleted'];

    /**
     * digunakan untuk mendapatkan daftar organisasi master
     */
    public static function getDaftarOPDMaster ($ta,$prepend=true,$ursid=NULL,$OrgIDRPJMD=NUll) 
    {
        $q=\DB::table('v_urusan_organisasi_master')
                ->where('TA',$ta);
        
        if ($ursid !==NULL)
        {
            $q->where('UrsID',$ursid);    
        }
        if ($OrgIDRPJMD !==NULL)
        {
            $q->where('OrgIDRPJMD',$OrgIDRPJMD);    
        }
        $q->orderBy('kode_organisasi');
        $q = $q->get();
        
        $daftar_organisasi=($prepend==true)?['none'=>'DAFTAR OPD / SKPD']:[];        
        foreach ($q as $k=>$v)
        {
            $daftar_organisasi[$v->OrgIDRPJMD]=$v->kode_organisasi.'. '.$v->OrgNm;
        } 
        return $daftar_organisasi;
    }
    /**
     * Dapatkan urusan dari Organisasi ini
     */
    public function urusan ()
    {
        return $this->belongsTo('App\Models\DMaster\UrusanModel');
    }
}