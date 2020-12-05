<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Carbon\Carbon;
use App\Models\DMaster\TAModel;

class TATableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {       
        \DB::statement('TRUNCATE "tmTA" RESTART IDENTITY CASCADE');

        $ta = TAModel::create ([
            'TAID'=> uniqid ('uid'),
            'TACd'=>date('Y'),
            'TANm'=>date('Y'),
            'Descr'=>'Tahun Realisasi '.date('Y')
        ]);        
    }
}
