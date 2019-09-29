<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class JenisModel extends Model
{
    use LogsActivity;
    /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'tmJns';
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'JnsID';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'JnsID', 'KlpID', 'Kd_Rek_3', 'JnsNm', 'Descr', 'TA'
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
    protected static $logName = 'JenisController';
    /**
     * log the changed attributes for all these events 
     */
    protected static $logAttributes = ['KlpID', 'JnsID', 'Kd_Rek_3', 'JnsNm', 'Descr', 'TA'];
    /**
     * log changes to all the $fillable attributes of the model
     */
    // protected static $logFillable = true;

    //only the `deleted` event will get logged automatically
    // protected static $recordEvents = ['deleted'];
    /**
     * digunakan untuk mendapatkan daftar rekening transaksi
     */    
    public static function getDaftarJenis ($ta,$prepend=true) 
    {
        $r=\DB::table('tmJns')
                ->select(\DB::raw('"tmJns"."JnsID",
                                    CONCAT("tmStr"."Kd_Rek_1",\'.\',"tmKlp"."Kd_Rek_2",\'.\',"tmJns"."Kd_Rek_3") AS "Kd_Rek_3","JnsNm"'))
                ->join('tmKlp','tmJns.KlpID','tmKlp.KlpID')
                ->join('tmStr','tmKlp.StrID','tmStr.StrID')
                ->where('tmKlp.TA',$ta)
                ->orderBy('Kd_Rek_3')->get();
        
        $daftar_jenis=($prepend==true)?['none'=>'DAFTAR JENIS']:[];        
        foreach ($r as $k=>$v)
        {
            $daftar_jenis[$v->JnsID]='['.$v->Kd_Rek_3.']. '.$v->JnsNm;
        } 
        return $daftar_jenis;
    }
    /**
     * digunakan untuk mendapatkan daftar rekening transaksi
     */    
    public static function getDaftarJenisByParent ($KlpID,$prepend=true) 
    {
        $r=\DB::table('tmJns')
                ->select(\DB::raw('"tmJns"."JnsID",
                                    CONCAT("tmStr"."Kd_Rek_1",\'.\',"tmKlp"."Kd_Rek_2",\'.\',"tmJns"."Kd_Rek_3") AS "Kd_Rek_3","JnsNm"'))
                ->join('tmKlp','tmJns.KlpID','tmKlp.KlpID')
                ->join('tmStr','tmKlp.StrID','tmStr.StrID')
                ->where('tmKlp.KlpID',$KlpID)
                ->orderBy('Kd_Rek_3')->get();
        
        $daftar_jenis=($prepend==true)?['none'=>'DAFTAR JENIS']:[];        
        foreach ($r as $k=>$v)
        {
            $daftar_jenis[$v->JnsID]='['.$v->Kd_Rek_3.']. '.$v->JnsNm;
        } 
        return $daftar_jenis;
    }
}
