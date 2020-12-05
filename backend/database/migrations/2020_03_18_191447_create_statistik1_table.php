<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatistik1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistik1', function (Blueprint $table) {
            $table->smallInteger('statistikID');
            $table->decimal('PaguDana1',15,2)->default(0);
            $table->decimal('PaguDana2',15,2)->default(0);
            $table->integer('JumlahProgram1')->default(0);
            $table->integer('JumlahProgram2')->default(0);
            $table->integer('JumlahKegiatan1')->default(0);
            $table->integer('JumlahKegiatan2')->default(0);
            $table->decimal('RealisasiKeuangan1',15,2)->default(0);
            $table->decimal('RealisasiKeuangan2',15,2)->default(0);
            $table->decimal('RealisasiFisik1',5,2)->default(0);
            $table->decimal('RealisasiFisik2',5,2)->default(0);
            $table->timestamps();

            $table->primary('statistikID'); 
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statistik1');
    }
}
