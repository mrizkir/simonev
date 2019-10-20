<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ProgramModel extends Model
{
    use LogsActivity;
    /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'tmPrg';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'PrgID', 'Kd_Prog', 'PrgNm', 'Jns', 'TA', 'Descr',
    ];
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'PrgID';
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
    protected static $logName = 'ProgramController';
    /**
     * log the changed attributes for all these events
     */
    protected static $logAttributes = ['PrgID', 'Kd_Prog', 'PrgNm'];
    /**
     * log changes to all the $fillable attributes of the model
     */
    // protected static $logFillable = true;

    //only the `deleted` event will get logged automatically
    // protected static $recordEvents = ['deleted'];

    public static function getDaftarProgram ($ta,$prepend=true,$UrsID=null) 
    {
        if ($UrsID==null)
        {
            $r=\DB::table('v_urusan_program')
                ->where('TA',$ta)          
                ->orderByRaw('"Kd_Urusan" ASC NULLS FIRST')
                ->orderByRaw('"Kd_Bidang" ASC NULLS FIRST')
                ->orderByRaw('"Kd_Prog" ASC NULLS FIRST')
                ->get();
        }
        else if($UrsID == 'all')
        {
            $r=\DB::table('v_urusan_program')
                ->where('TA',$ta)
                ->orderBy('Kd_Prog')
                ->where('Jns','f')
                ->orderByRaw('"Kd_Urusan" ASC NULLS FIRST')
                ->orderByRaw('"Kd_Bidang" ASC NULLS FIRST')
                ->orderByRaw('"Kd_Prog" ASC NULLS FIRST')
                ->get();
        }
        else
        {
            $r=\DB::table('v_urusan_program')
                ->where('TA',$ta)
                ->orderBy('Kd_Prog')
                ->where('UrsID',$UrsID)
                ->orderByRaw('"Kd_Urusan" ASC NULLS FIRST')
                ->orderByRaw('"Kd_Bidang" ASC NULLS FIRST')
                ->orderByRaw('"Kd_Prog" ASC NULLS FIRST')
                ->get();
            
        }        
        
        $daftar_program=($prepend==true)?['none'=>'DAFTAR PROGRAM']:[];        
        foreach ($r as $k=>$v)
        {           
            $daftar_program[$v->PrgID]=$v->kode_program.'. '.$v->PrgNm;           
        }
        return $daftar_program;
    }

    /**
     * digunakan untuk mendapatkan kode urusan
     */
    public static function getKodeProgramByPrgID($PrgID)
    {
        $r = \DB::table('v_urusan_program')->where('PrgID', $PrgID)->pluck('kode_program')->toArray();
        if (isset($r[0])) {
            return $r[0];
        } else {
            return null;
        }
    }

    public static function getDaftarProgramByOPD ($OrgIDRPJMD,$prepend=true) 
    {    
        $r=\DB::table('v_organisasi_program')
                ->where('OrgIDRPJMD',$OrgIDRPJMD)                
                ->orderByRaw('"Kd_Urusan" ASC NULLS FIRST')
                ->orderByRaw('"Kd_Bidang" ASC NULLS FIRST')
                ->orderByRaw('"Kd_Prog" ASC NULLS FIRST')
                ->get();
       
        $daftar_program=($prepend==true)?['none'=>'DAFTAR PROGRAM']:[];        
        foreach ($r as $k=>$v)
        {            
            $daftar_program[$v->PrgID]='['.$v->kode_organisasi.'.'.$v->kode_program.'] '.$v->PrgNm;           
        }
        return $daftar_program;
    }
    
    public static function getDaftarProgramByOPDComplete ($OrgIDRPJMD,$prepend=true) 
    {    
        $r=\DB::table('v_organisasi_program')
                ->where('OrgIDRPJMD',$OrgIDRPJMD)                
                ->orderByRaw('"Kd_Urusan" ASC NULLS FIRST')
                ->orderByRaw('"Kd_Bidang" ASC NULLS FIRST')
                ->orderByRaw('"Kd_Prog" ASC NULLS FIRST')
                ->get();
       
        $daftar_program=($prepend==true)?['none'=>'DAFTAR PROGRAM']:[];        
        foreach ($r as $k=>$v)
        {            
            $daftar_program[$v->PrgID]=['kode_program'=>$v->kode_organisasi.'.'.$v->kode_program,
                                        'PrgNm'=>$v->PrgNm];
        }
        return $daftar_program;
    }
}
