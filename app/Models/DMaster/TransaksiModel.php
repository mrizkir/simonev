<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class TransaksiModel extends Model
{
    use LogsActivity;
    /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'tmStr';
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'StrID';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'StrID', 'Kd_Rek_1', 'StrNm', 'Descr', 'TA'
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
    protected static $logName = 'TransaksiController';
    /**
     * log the changed attributes for all these events 
     */
    protected static $logAttributes = ['StrID', 'Kd_Rek_1', 'StrNm', 'Descr'];
    /**
     * digunakan untuk mendapatkan daftar rekening transaksi
     */    
    public static function getDaftarTransaksi ($ta,$prepend=true) 
    {
        $r=\DB::table('tmStr')
                ->where('TA',$ta)
                ->orderBy('Kd_Rek_1')->get();
        
        $daftar_transaksi=($prepend==true)?['none'=>'DAFTAR TRANSAKSI']:[];        
        foreach ($r as $k=>$v)
        {
            $daftar_transaksi[$v->StrID]=$v->Kd_Rek_1.'. '.$v->StrNm;
        } 
        return $daftar_transaksi;
    }
}
