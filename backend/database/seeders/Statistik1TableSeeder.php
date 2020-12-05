<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Statistik1Model;

class Statistik1TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {       
        \DB::statement('TRUNCATE statistik1 RESTART IDENTITY CASCADE');

        $user=Statistik1Model::create([
            'statistikID'=>date('Y'),
            'PaguDana1'=>0,                
            'PaguDana2'=>0,                
            'JumlahProgram1'=>0,                
            'JumlahProgram2'=>0,                
            'JumlahKegiatan1'=>0,                
            'JumlahKegiatan2'=>0,                
            'RealisasiKeuangan1'=>0,                
            'RealisasiKeuangan2'=>0,                
            'RealisasiFisik1'=>0,                
            'RealisasiFisik2'=>0,                  
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);  
        
    }
}
