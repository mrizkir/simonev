<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class KelompokModel extends Model
{
    use LogsActivity;
    /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'tmKlp';
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'KlpID';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'KlpID', 'StrID', 'Kd_Rek_2', 'KlpNm', 'Descr', 'TA'
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
    protected static $logName = 'KelompokController';
    /**
     * log the changed attributes for all these events 
     */
    protected static $logAttributes = ['KlpID', 'StrID', 'Kd_Rek_2', 'KlpNm', 'Descr', 'TA'];
    /**
     * log changes to all the $fillable attributes of the model
     */
    // protected static $logFillable = true;

    //only the `deleted` event will get logged automatically
    // protected static $recordEvents = ['deleted'];
    /**
     * digunakan untuk mendapatkan daftar rekening transaksi
     */    
    public static function getDaftarKelompok ($ta,$prepend=true) 
    {
        $r=\DB::table('tmKlp')
                ->select(\DB::raw('"tmKlp"."KlpID",
                                    CONCAT("tmStr"."Kd_Rek_1",\'.\',"tmKlp"."Kd_Rek_2") AS "Kd_Rek_2","KlpNm"'))
                ->join('tmStr','tmKlp.StrID','tmStr.StrID')
                ->where('tmKlp.TA',$ta)
                ->orderBy('Kd_Rek_2')->get();
        
        $daftar_kelompok=($prepend==true)?['none'=>'DAFTAR KELOMPOK']:[];        
        foreach ($r as $k=>$v)
        {
            $daftar_kelompok[$v->KlpID]='['.$v->Kd_Rek_2.']. '.$v->KlpNm;
        } 
        return $daftar_kelompok;
    }
    /**
     * digunakan untuk mendapatkan daftar rekening transaksi
     */    
    public static function getDaftarKelompokByParent ($ta,$StrID,$prepend=true) 
    {
        $r=\DB::table('tmKlp')
                ->select(\DB::raw('"tmKlp"."KlpID",
                                    CONCAT("tmStr"."Kd_Rek_1",\'.\',"tmKlp"."Kd_Rek_2") AS "Kd_Rek_2","KlpNm"'))
                ->join('tmStr','tmKlp.StrID','tmStr.StrID')
                ->where('tmKlp.StrID',$StrID)
                ->orderBy('Kd_Rek_2')->get();
        
        $daftar_kelompok=($prepend==true)?['none'=>'DAFTAR KELOMPOK']:[];        
        foreach ($r as $k=>$v)
        {
            $daftar_kelompok[$v->KlpID]='['.$v->Kd_Rek_2.']. '.$v->KlpNm;
        } 
        return $daftar_kelompok;
    }
}
