<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubOrganisasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmSOrg', function (Blueprint $table) {
            $table->string('SOrgID',19);
            $table->string('OrgID',19);
            $table->string('Nm_Urusan');

            $table->string('kode_organisasi');
            $table->string('OrgNm');

            $table->string('kode_suborganisasi');
            $table->string('SOrgNm');

            $table->string('SOrgAlias');
            $table->string('Alamat');
            $table->string('NamaKepalaUnitKerja');
            $table->string('NIPKepalaUnitKerja');
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
            $table->string('Descr')->nullable();
            $table->year('TA');       
            $table->timestamps();

            $table->primary('SOrgID'); 
            $table->index('OrgID'); 
            $table->index('kode_suborganisasi'); 
            $table->index('kode_organisasi'); 

            $table->foreign('OrgID')
                            ->references('OrgID')
                            ->on('tmOrg')
                            ->onDelete('cascade')
                            ->onUpdate('cascade');
            
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tmSOrg');
    }
}
