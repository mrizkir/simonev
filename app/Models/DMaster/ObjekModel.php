<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ObjekModel extends Model
{
    use LogsActivity;
    /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'tmROby';
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'RObyID';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ObyID', 'RObyID', 'Kd_Rek_5', 'RObyNm', 'Descr', 'TA'
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
    protected static $logName = 'ObjekController';
    /**
     * log the changed attributes for all these events 
     */
    protected static $logAttributes = ['ObyID', 'RObyID', 'Kd_Rek_5', 'RObyNm', 'Descr', 'TA'];
    /**
     * log changes to all the $fillable attributes of the model
     */
    // protected static $logFillable = true;

    //only the `deleted` event will get logged automatically
    // protected static $recordEvents = ['deleted'];
    /**
     * digunakan untuk mendapatkan daftar rekening transaksi
     */    
    public static function getDaftarObyek ($ta,$prepend=true) 
    {
        $r=\DB::table('tmROby')
                    ->select(\DB::raw('"tmROby"."RObyID",
                                CONCAT("tmStr"."Kd_Rek_1",\'.\',"tmKlp"."Kd_Rek_2",\'.\',"tmJns"."Kd_Rek_3",\'.\',"tmOby"."Kd_Rek_4",\'.\',"tmROby"."Kd_Rek_5") AS "Kd_Rek_5","RObyNm"'))
                    ->join('tmOby','tmROby.ObyID','tmOby.ObyID')
                    ->join('tmJns','tmOby.JnsID','tmJns.JnsID')
                    ->join('tmKlp','tmJns.KlpID','tmKlp.KlpID')
                    ->join('tmStr','tmKlp.StrID','tmStr.StrID')
                    ->where('tmKlp.TA',$ta)
                    ->orderBy('Kd_Rek_5')->get();
        
        $daftar_jenis=($prepend==true)?['none'=>'DAFTAR RINCIAN']:[];        
        foreach ($r as $k=>$v)
        {
            $daftar_jenis[$v->RObyID]='['.$v->Kd_Rek_5.']. '.$v->RObyNm;
        } 
        return $daftar_jenis;
    }
     /**
     * digunakan untuk mendapatkan daftar rekening transaksi
     */    
    public static function getDaftarObyekByParent ($ObyID,$prepend=true) 
    {
        $r=\DB::table('tmROby')
                    ->select(\DB::raw('"tmROby"."RObyID",
                                        CONCAT("tmStr"."Kd_Rek_1",\'.\',"tmKlp"."Kd_Rek_2",\'.\',"tmJns"."Kd_Rek_3",\'.\',"tmOby"."Kd_Rek_4",\'.\',"tmROby"."Kd_Rek_5") AS "Kd_Rek_5","RObyNm"'))
                    ->join('tmOby','tmROby.ObyID','tmOby.ObyID')
                    ->join('tmJns','tmOby.JnsID','tmJns.JnsID')
                    ->join('tmKlp','tmJns.KlpID','tmKlp.KlpID')
                    ->join('tmStr','tmKlp.StrID','tmStr.StrID')
                    ->where('tmROby.ObyID',$ObyID)
                    ->orderBy('Kd_Rek_5')->get();
        
        $daftar_obyek=($prepend==true)?['none'=>'DAFTAR OBYEK']:[];        
        foreach ($r as $k=>$v)
        {
            $daftar_obyek[$v->RObyID]='['.$v->Kd_Rek_5.']. '.$v->RObyNm;
        } 
        return $daftar_obyek;
    }
}
