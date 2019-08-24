<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class OrganisasiModel extends Model
{
    use LogsActivity;
    /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'tmOrg';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'OrgID', 'UrsID', 'OrgCd', 'OrgNm', 'Alamat', 'NamaKepalaSKPD', 'NIPKepalaSKPD', 'Descr', 'TA',
    ];
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'OrgID';
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
    protected static $logName = 'OrganisasiController';
    /**
     * log the changed attributes for all these events
     */
    protected static $logAttributes = ['OrgID', 'OrgCd', 'OrgNm'];
    /**
     * log changes to all the $fillable attributes of the model
     */
    // protected static $logFillable = true;

    //only the `deleted` event will get logged automatically
    // protected static $recordEvents = ['deleted'];

    /**
     * digunakan untuk mendapatkan kode urusan
     */
    public static function getDaftarOPD($ta, $prepend = true, $ursid = null, $OrgID = null)
    {
        $q = \DB::table('v_urusan_organisasi')
            ->where('TA', $ta);

        if ($ursid !== null) {
            $q->where('UrsID', $ursid);
        }
        if ($OrgID !== null) {
            $q->where('OrgID', $OrgID);
        }
        $q->orderBy('kode_organisasi');
        $q = $q->get();

        $daftar_organisasi = ($prepend == true) ? ['none' => 'DAFTAR OPD / SKPD'] : [];
        foreach ($q as $k => $v) {
            $daftar_organisasi[$v->OrgID] = $v->kode_organisasi . '. ' . $v->OrgNm;
        }
        return $daftar_organisasi;
    }
    /**
     * Dapatkan urusan dari Organisasi ini
     */
    public function urusan()
    {
        return $this->belongsTo('App\Models\DMaster\UrusanModel');
    }
}
