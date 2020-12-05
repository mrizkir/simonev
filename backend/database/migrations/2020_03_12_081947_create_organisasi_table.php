<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganisasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmOrg', function (Blueprint $table) {
            $table->string('OrgID',19);
            $table->string('Nm_Urusan');
            $table->string('kode_organisasi');
            $table->string('OrgNm');
            $table->string('OrgAlias');
            $table->string('Alamat');
            $table->string('NamaKepalaSKPD');
            $table->string('NIPKepalaSKPD');
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

            $table->primary('OrgID'); 
            $table->index('kode_organisasi'); 


            
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tmOrg');
    }
}
