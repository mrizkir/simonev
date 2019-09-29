<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class RincianModel extends Model
{
    use LogsActivity;
    /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'tmOby';
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'ObyID';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ObyID', 'JnsID', 'Kd_Rek_4', 'ObyNm', 'Descr', 'TA'
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

    /**
     * make the model use another name than the default
     *
     * @var string
     */
    protected static $logName = 'RincianController';
    /**
     * log the changed attributes for all these events 
     */
    protected static $logAttributes = ['ObyID', 'JnsID', 'Kd_Rek_4', 'ObyNm', 'Descr', 'TA'];
    /**
     * log changes to all the $fillable attributes of the model
     */
    // protected static $logFillable = true;

    //only the `deleted` event will get logged automatically
    // protected static $recordEvents = ['deleted'];
    /**
     * digunakan untuk mendapatkan daftar rekening transaksi
     */    
    public static function getDaftarRincian ($ta,$prepend=true) 
    {
        $r=\DB::table('tmOby')
                ->select(\DB::raw('"tmOby"."ObyID",
                                    CONCAT("tmStr"."Kd_Rek_1",\'.\',"tmKlp"."Kd_Rek_2",\'.\',"tmJns"."Kd_Rek_3",\'.\',"tmOby"."Kd_Rek_4") AS "Kd_Rek_4","ObyNm"'))
                ->join('tmJns','tmOby.JnsID','tmJns.JnsID')
                ->join('tmKlp','tmJns.KlpID','tmKlp.KlpID')
                ->join('tmStr','tmKlp.StrID','tmStr.StrID')
                ->where('tmKlp.TA',$ta)
                ->orderBy('Kd_Rek_4')->get();
        
        $daftar_jenis=($prepend==true)?['none'=>'DAFTAR RINCIAN']:[];        
        foreach ($r as $k=>$v)
        {
            $daftar_jenis[$v->ObyID]='['.$v->Kd_Rek_4.']. '.$v->ObyNm;
        } 
        return $daftar_jenis;
    }
     /**
     * digunakan untuk mendapatkan daftar rekening transaksi
     */    
    public static function getDaftarRincianByParent ($JnsID,$prepend=true) 
    {
        $r=\DB::table('tmOby')
                ->select(\DB::raw('"tmOby"."ObyID",
                                    CONCAT("tmStr"."Kd_Rek_1",\'.\',"tmKlp"."Kd_Rek_2",\'.\',"tmJns"."Kd_Rek_3",\'.\',"tmOby"."Kd_Rek_4") AS "Kd_Rek_4","ObyNm"'))
                ->join('tmJns','tmOby.JnsID','tmJns.JnsID')
                ->join('tmKlp','tmJns.KlpID','tmKlp.KlpID')
                ->join('tmStr','tmKlp.StrID','tmStr.StrID')
                ->where('tmOby.JnsID',$JnsID)
                ->orderBy('Kd_Rek_4')->get();
        
        $daftar_rincian=($prepend==true)?['none'=>'DAFTAR RINCIAN']:[];        
        foreach ($r as $k=>$v)
        {
            $daftar_rincian[$v->ObyID]='['.$v->Kd_Rek_4.']. '.$v->ObyNm;
        } 
        return $daftar_rincian;
    }
}
