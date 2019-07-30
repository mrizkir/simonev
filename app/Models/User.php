<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use Notifiable, HasRoles, HasApiTokens, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username','password','OrgID','OrgNm','SOrgID','SOrgNm','theme'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

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
    protected static $logName = 'setting\UsersController';
    /**
     * log the changed attributes for all these events 
     */
    protected static $logAttributes = ['name', 'email', 'username','OrgID','OrgNm','SOrgID','SOrgNm','PemilikPokokID','NmPk','PmKecamatanID','Nm_Kecamatan','PmDesaID','Nm_Desa','theme'];
    /**
     * log changes to all the $fillable attributes of the model
     */
    // protected static $logFillable = true;

    //only the `deleted` event will get logged automatically
    // protected static $recordEvents = ['deleted'];      

    /**
     * override password username
     */
    public static function findForPassport($username) 
    {
        $data=User::where('username', $username)->first();         
        return $data;
    }
}
