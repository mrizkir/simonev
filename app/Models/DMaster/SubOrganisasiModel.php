<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class SubOrganisasiModel extends Model {
    use LogsActivity;
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
        'SOrgID', 'OrgID', 'SOrgCd', 'SOrgNm', 'Alamat', 'NamaKepalaSKPD', 'NIPKepalaSKPD', 'Descr', 'TA'
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

    /**
     * make the model use another name than the default
     *
     * @var string
     */
    protected static $logName = 'SubOrganisasiController';
    /**
     * log the changed attributes for all these events 
     */
    protected static $logAttributes = ['SOrgID', 'OrgID', 'SOrgNm'];
    /**
     * log changes to all the $fillable attributes of the model
     */
    // protected static $logFillable = true;

    //only the `deleted` event will get logged automatically
    // protected static $recordEvents = ['deleted'];

    /**
     * digunakan untuk mendapatkan daftar unit kerja
     */
    public static function getDaftarUnitKerja ($ta,$prepend=true,$OrgID=null,$SOrgID=null) 
    {
        $r=\DB::table('v_suborganisasi')
                ->where('TA',$ta);
        if($OrgID!=null)
        {
            $r->where('OrgID',$OrgID);
        }
        if($SOrgID!=null)
        {
            $r->where('SOrgID',$SOrgID);
        }
        $q=$r->orderBy('kode_suborganisasi')
             ->get();
        
        $daftar_organisasi=($prepend==true)?['none'=>'DAFTAR UNIT KERJA']:[];        
        foreach ($q as $k=>$v)
        {
            $daftar_organisasi[$v->SOrgID]=$v->kode_suborganisasi.'. '.$v->SOrgNm;
        } 
        return $daftar_organisasi;
    }
    /**
     * digunakan untuk nama unit kerja berdasarkan SOrgID
     */
    public static function getNamaUnitKerjaByID ($SOrgID) 
    {
        $r = \DB::table('v_suborganisasi')->where('SOrgID',$SOrgID)->pluck('SOrgNm')->toArray();
        if (isset($r[0]))
        {
            return $r[0];
        }
        else
        {
            return null;
        }
    }
}
