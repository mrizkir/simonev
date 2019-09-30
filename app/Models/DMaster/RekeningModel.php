<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;

class RekeningModel extends Model
{
    /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'v_rekening';   
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'RObyID'; 
}
