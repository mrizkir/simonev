<?php

namespace App\Models\RPJMD;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class RPJMDSasaranModel extends Model {
    use LogsActivity;
     /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'tmPrioritasSasaranKab';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'PrioritasSasaranKabID', 'PrioritasTujuanKabID', 'Kd_Sasaran', 'Nm_Sasaran', 'Descr', 'TA'
    ];
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'PrioritasSasaranKabID';
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
    protected static $logName = 'RPJMDSasaranController';
    /**
     * log the changed attributes for all these events 
     */
    protected static $logAttributes = ['PrioritasSasaranKabID', 'Nm_Sasaran'];
    /**
     * log changes to all the $fillable attributes of the model
     */
    // protected static $logFillable = true;

    //only the `deleted` event will get logged automatically
    // protected static $recordEvents = ['deleted'];
    /**
     * digunakan untuk mendapatkan daftar sasaran
     */
    public static function getDaftarSasaran($ta,$prepend=true)
    {
        $r=RPJMDSasaranModel::select(\DB::raw('
                                "PrioritasSasaranKabID",
                                CONCAT(
                                \'[\',
                                "Kd_PrioritasKab",
                                \'.\',
                                "Kd_Tujuan",
                                \'.\',
                                "Kd_Sasaran",                                
                                \'] \',
                                "Nm_Sasaran"
                                ) AS "Nm_Sasaran"'))                                
                                ->join('tmPrioritasTujuanKab','tmPrioritasTujuanKab.PrioritasTujuanKabID','tmPrioritasSasaranKab.PrioritasTujuanKabID')
                                ->join('tmPrioritasKab','tmPrioritasKab.PrioritasKabID','tmPrioritasTujuanKab.PrioritasKabID')
                                ->where('tmPrioritasSasaranKab.TA',$ta)
                                ->orderBy('Kd_PrioritasKab')
                                ->orderBy('Kd_Tujuan')
                                ->orderBy('Kd_Sasaran')
                                ->get();

        $daftar_sasaran=$prepend == true 
                                        ?
                                            $r->pluck('Nm_Sasaran','PrioritasSasaranKabID')
                                            ->prepend('DAFTAR SASARAN RPJMD')
                                            ->toArray()
                                        :
                                        $r->pluck('Nm_Sasaran','PrioritasSasaranKabID')
                                            ->toArray();
       
        return $daftar_sasaran;
    }
    /**
     * digunakan untuk mendapatkan daftar sasaran
     */
    public static function getDaftarSasaranNotInIndikatorSasaran($ta,$prepend=true)
    {
        $r=RPJMDSasaranModel::select(\DB::raw('
                                "PrioritasSasaranKabID",
                                CONCAT(
                                \'[\',
                                "Kd_PrioritasKab",
                                \'.\',
                                "Kd_Tujuan",
                                \'.\',
                                "Kd_Sasaran",                                
                                \'] \',
                                "Nm_Sasaran"
                                ) AS "Nm_Sasaran"'))                                
                                ->join('tmPrioritasTujuanKab','tmPrioritasTujuanKab.PrioritasTujuanKabID','tmPrioritasSasaranKab.PrioritasTujuanKabID')
                                ->join('tmPrioritasKab','tmPrioritasKab.PrioritasKabID','tmPrioritasTujuanKab.PrioritasKabID')
                                ->where('tmPrioritasSasaranKab.TA',$ta)
                                ->WhereNotIn('PrioritasSasaranKabID',function($query) use ($ta){
                                    $query->select('PrioritasSasaranKabID')
                                                        ->from('trRpjmdProgramPembangunan')
                                                        ->where('TA', $ta);
                                })
                                ->orderBy('Kd_PrioritasKab')
                                ->orderBy('Kd_Tujuan')
                                ->orderBy('Kd_Sasaran')
                                ->get();

        $daftar_sasaran=$prepend == true 
                                        ?
                                            $r->pluck('Nm_Sasaran','PrioritasSasaranKabID')
                                            ->prepend('DAFTAR SASARAN RPJMD')
                                            ->toArray()
                                        :
                                        $r->pluck('Nm_Sasaran','PrioritasSasaranKabID')
                                            ->toArray();
       
        return $daftar_sasaran;
    }
}
