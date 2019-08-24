<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class UrusanModel extends Model {
    use LogsActivity;
     /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'tmUrs';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'UrsID', 'KUrsID','Kd_Bidang', 'Kode_Bidang', 'Nm_Bidang', 'Descr','TA',
    ];
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'UrsID';
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
    protected static $logName = 'UrusanController';
    /**
     * log the changed attributes for all these events 
     */
    protected static $logAttributes = ['UrsID','KUrsID','Kd_Bidang', 'Kode_Bidang', 'Nm_Bidang'];
    /**
     * log changes to all the $fillable attributes of the model
     */
    // protected static $logFillable = true;

    //only the `deleted` event will get logged automatically
    // protected static $recordEvents = ['deleted'];

    public function kelompokurusan () 
    {
        return $this->belongsTo('App\Models\DMaster\KelompokUrusanModel','KUrsID');
    }

    public static function getDaftarUrusan ($ta,$prepend=true) 
    {
        $r=\DB::table('v_urusan')
                ->where('TA',$ta)
                ->orderBy('Kode_Bidang')->get();
        
        $daftar_urusan=($prepend==true)?['none'=>'DAFTAR URUSAN']:[];        
        foreach ($r as $k=>$v)
        {
            $daftar_urusan[$v->UrsID]=$v->Kode_Bidang.'. '.$v->Nm_Bidang;
        } 
        return $daftar_urusan;
    }
    public static function getDaftarUrusanByOPD ($ta,$OrgID,$prepend=true) 
    {
        $r=\DB::table('trOrgProgram')
                ->join('v_urusan_program','v_urusan_program.PrgID','trOrgProgram.PrgID')
                ->select(\DB::raw('"v_urusan_program"."UrsID","v_urusan_program"."Kd_Urusan","v_urusan_program"."Kd_Bidang","v_urusan_program"."Nm_Bidang"'))
                ->where('trOrgProgram.OrgID',$OrgID)
                ->where('trOrgProgram.TA',$ta)
                ->orderBy('Kd_Bidang')->get();
        
        $daftar_urusan=($prepend==true)?['none'=>'DAFTAR URUSAN']:[];        
        foreach ($r as $k=>$v)
        {
            $daftar_urusan[$v->UrsID]=$v->Kd_Urusan.'.'.$v->Kd_Bidang.' '.$v->Nm_Bidang;
        } 
        return $daftar_urusan;
    }

    /**
     * digunakan untuk mendapatkan kode urusan
     */
    public static function getKodeUrusanByUrsID($UrsID) 
    {
        $r = \DB::table('v_urusan')->where('UrsID',$UrsID)->pluck('Kode_Bidang')->toArray();
        if (isset($r[0]))
        {
            return $r[0];
        }
        else
        {
            return null;
        }
    }

    /**
     * digunakan untuk mendapatkan kode urusan
     */
    public static function getKodeUrusanByOrgID($OrgID) 
    {
        $r = \DB::table('tmOrg')->where('OrgID',$OrgID)->pluck('UrsID')->toArray();
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
