<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSTargetkinerjaOpdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_targetkinerja_opd', function (Blueprint $table) {
            $table->string('TargetKinerjaID',19);
            $table->string('OrgID',19);
            $table->string('OrgNm');                        
            $table->integer('jumlah_kegiatan1');                        
            $table->integer('jumlah_kegiatan2');                        
            $table->integer('jumlah_uraian1');                        
            $table->integer('jumlah_uraian2');                        
            $table->decimal('pagudinas1',15,2);                        
            $table->decimal('pagudinas2',15,2);                        
            $table->decimal('pagupembanding1',15,2);                        
            $table->decimal('pagupembanding2',15,2);                        
            $table->decimal('target_fisik1',5,2);                        
            $table->decimal('target_fisik2',5,2);                        
            $table->decimal('realisasi_fisik1',5,2);                        
            $table->decimal('realisasi_fisik2',5,2);                        
            $table->decimal('persen_target_keuangan1',5,2);                        
            $table->decimal('persen_target_keuangan2',5,2);                        
            $table->decimal('persen_realisasi_keuangan1',5,2);                        
            $table->decimal('persen_realisasi_keuangan2',5,2);                        
            $table->decimal('target_keuangan1',15,2);                        
            $table->decimal('target_keuangan2',15,2);                        
            $table->decimal('realisasi_keuangan1',15,2);                        
            $table->decimal('realisasi_keuangan2',15,2);                        
            $table->decimal('sisa_pagu1',15,2);                        
            $table->decimal('sisa_pagu2',15,2);                        
            $table->decimal('persen_sisa_pagu1',15,2);                        
            $table->decimal('persen_sisa_pagu2',15,2);                        
            $table->decimal('bobot1',5,2);                        
            $table->decimal('bobot2',5,2);                        
            $table->tinyInteger('bulan');                                    
            $table->year('TA');                    
            $table->tinyInteger('EntryLvl')->default(0);
            $table->timestamps();

            $table->primary('TargetKinerjaID');    
            $table->index('OrgID');    
            $table->index('bulan');    
            $table->index('TA');     
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('s_targetkinerja_opd');
    }
}
