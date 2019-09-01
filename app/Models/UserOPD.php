<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class UserOPD extends Model
{
    use LogsActivity;
    /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'usersopd';   

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'useropd', 'id', 'ta','OrgID','OrgNm','SOrgID','SOrgNm','locked'
    ];
    /**
    * primary key tabel ini.
    *
    * @var string
    */
    protected $primaryKey = 'useropd';
    /**
    * enable auto_increment.
    *
    * @var string
    */
    public $incrementing = true;
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
    protected static $logName = 'setting\UsersOPDController';
    /**
     * log the changed attributes for all these events 
     */
    protected static $logAttributes = ['useropd', 'id', 'ta','OrgID','OrgNm','SOrgID','SOrgNm','locked'];
    /**
     * log changes to all the $fillable attributes of the model
     */
    protected static $logFillable = true;

    //only the `deleted` event will get logged automatically
    // protected static $recordEvents = ['deleted'];     
    public static function getOPD($listlocked=true,$ignorelocked=false)
    {        
        if ($ignorelocked == true)
        {
            $daftar_opd=\App\Models\UserOPD::where('ta',\HelperKegiatan::getTahunPerencanaan())
                                                ->where('id',\Auth::user()->id)                                                
                                                ->pluck('OrgNm','OrgID');      
        }
        else
        {
            $daftar_opd=\App\Models\UserOPD::where('ta',\HelperKegiatan::getTahunPerencanaan())
                                                ->where('id',\Auth::user()->id)
                                                ->where('locked',!$listlocked)
                                                ->pluck('OrgNm','OrgID');      
        }
        return $daftar_opd;
    }
}   
