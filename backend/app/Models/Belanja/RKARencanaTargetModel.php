<?php

namespace App\Models\Belanja;

use Illuminate\Database\Eloquent\Model;

class RKARencanaTargetModel extends Model 
{
     /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'trRKATargetRinc';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'RKATargetRincID', 
        'RKAID', 
        'RKARincID', 
        'bulan1', 
        'bulan2', 
        'target1',         
        'target2',                
        'fisik1',         
        'fisik2',    
        'EntryLvl', 
        'Descr', 
        'TA', 
        'Locked',
        'RKATargetRincID_Src'
    ];
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'RKATargetRincID';
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
}
