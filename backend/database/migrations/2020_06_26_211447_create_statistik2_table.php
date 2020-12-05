<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatistik2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistik2', function (Blueprint $table) {
            $table->string('Statistik2ID',19);
            $table->string('OrgID',19);
            $table->string('kode_organisasi');
            $table->string('OrgNm');
            $table->decimal('PaguDana1',15,2)->default(0);
            $table->decimal('PaguDana2',15,2)->default(0);
            $table->decimal('PaguDana3',15,2)->default(0);
            $table->integer('JumlahKegiatan1')->default(0);
            $table->integer('JumlahKegiatan2')->default(0);
            $table->integer('JumlahKegiatan3')->default(0);
            $table->integer('JumlahUraian1')->default(0);
            $table->integer('JumlahUraian2')->default(0);
            $table->integer('JumlahUraian3')->default(0);

            $table->decimal('TargetFisik1',5,2)->default(0);
            $table->decimal('TargetFisik2',5,2)->default(0);
            $table->decimal('TargetFisik3',5,2)->default(0);
            $table->decimal('RealisasiFisik1',5,2)->default(0);
            $table->decimal('RealisasiFisik2',5,2)->default(0);
            $table->decimal('RealisasiFisik3',5,2)->default(0);

            $table->decimal('TargetKeuangan1',15,2)->default(0);
            $table->decimal('TargetKeuangan2',15,2)->default(0);
            $table->decimal('TargetKeuangan3',15,2)->default(0);
            $table->decimal('RealisasiKeuangan1',15,2)->default(0);
            $table->decimal('RealisasiKeuangan2',15,2)->default(0);
            $table->decimal('RealisasiKeuangan3',15,2)->default(0);

            $table->decimal('PersenTargetKeuangan1',5,2)->default(0);
            $table->decimal('PersenTargetKeuangan2',5,2)->default(0);
            $table->decimal('PersenTargetKeuangan3',5,2)->default(0);
            $table->decimal('PersenRealisasiKeuangan1',5,2)->default(0);
            $table->decimal('PersenRealisasiKeuangan2',5,2)->default(0);
            $table->decimal('PersenRealisasiKeuangan3',5,2)->default(0);

            $table->decimal('SisaPaguDana1',15,2)->default(0);
            $table->decimal('SisaPaguDana2',15,2)->default(0);
            $table->decimal('SisaPaguDana3',15,2)->default(0);

            $table->decimal('PersenSisaPaguDana1',15,2)->default(0);
            $table->decimal('PersenSisaPaguDana2',15,2)->default(0);
            $table->decimal('PersenSisaPaguDana3',15,2)->default(0);

            $table->decimal('Bobot1',5,2)->default(0);
            $table->decimal('Bobot2',5,2)->default(0);
            $table->decimal('Bobot3',5,2)->default(0);

            $table->tinyInteger('Bulan');
            $table->year('TA');
            $table->tinyInteger('EntryLvl')->default(0);

            $table->timestamps();

            $table->primary('Statistik2ID');
            $table->index('OrgID');
            $table->index('kode_organisasi');
            $table->index('TA');
            $table->index('Bulan');
            $table->index('EntryLvl');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statistik2');
    }
}
