<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRkakegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trRKA', function (Blueprint $table) {
            $table->string('RKAID',19);
            $table->string('SumberDanaID',19)->nullable();

            $table->string('kode_urusan',19);
            $table->string('kode_bidang',19);
            $table->string('kode_organisasi',19);
            $table->string('kode_suborganisasi',19);
            $table->string('kode_program',19);
            $table->string('kode_kegiatan',19);
            
            $table->string('Nm_Urusan');
            $table->string('Nm_Bidang');
            $table->string('OrgNm');
            $table->string('SOrgNm');
            $table->string('PrgNm');
            $table->string('KgtNm');

            $table->text('keluaran1')->nullable();
            $table->text('keluaran2')->nullable();
            $table->string('tk_keluaran1')->nullable();
            $table->string('tk_keluaran2')->nullable();
            $table->text('hasil1')->nullable();
            $table->text('hasil2')->nullable();
            $table->string('tk_hasil1')->nullable();
            $table->string('tk_hasil2')->nullable();
            $table->text('capaian_program1')->nullable();
            $table->text('capaian_program2')->nullable();
            $table->string('tk_capaian1')->nullable();
            $table->string('tk_capaian2')->nullable();
            $table->string('masukan1')->nullable();
            $table->string('masukan2')->nullable();
            $table->string('ksk1')->nullable();
            $table->string('ksk2')->nullable();
            $table->string('sifat_kegiatan1',10)->nullable();
            $table->string('sifat_kegiatan2',10)->nullable();
            $table->string('waktu_pelaksanaan1',15)->nullable();
            $table->string('waktu_pelaksanaan2',15)->nullable();
            $table->string('lokasi_kegiatan1')->nullable();
            $table->string('lokasi_kegiatan2')->nullable();
            $table->decimal('PaguDana1',15,2)->defualt(0);
            $table->decimal('PaguDana2',15,2)->default(0);
            $table->decimal('RealisasiKeuangan1',15,2)->defualt(0);
            $table->decimal('RealisasiKeuangan2',15,2)->defualt(0);
            $table->decimal('RealisasiFisik1',5,2)->default(0);
            $table->decimal('RealisasiFisik2',5,2)->default(0);
            $table->string('nip_pa1',19)->nullable();
            $table->string('nip_pa2',19)->nullable();
            $table->string('nip_kpa1',19)->nullable();
            $table->string('nip_kpa2',19)->nullable();
            $table->string('nip_ppk1',19)->nullable();
            $table->string('nip_ppk2',19)->nullable();
            $table->string('nip_pptk1',19)->nullable();
            $table->string('nip_pptk2',19)->nullable();
            $table->integer('user_id'); 
            $table->tinyInteger('EntryLvl')->default(0);
            $table->string('Descr')->nullable();            
            $table->year('TA'); 
            $table->boolean('Locked')->default(0);
            $table->string('RKAID_Src',19)->nullable();
            $table->timestamps();

            $table->primary('RKAID');
            $table->index('SumberDanaID');
            $table->index('kode_urusan');
            $table->index('kode_bidang');
            $table->index('kode_organisasi');
            $table->index('kode_suborganisasi');
            $table->index('kode_program');
            $table->index('kode_kegiatan');
            $table->index('KgtNm');
            $table->index('nip_pa1');
            $table->index('nip_pa2');
            $table->index('nip_kpa1');
            $table->index('nip_kpa2');
            $table->index('nip_ppk1');
            $table->index('nip_ppk2');
            $table->index('nip_pptk1');
            $table->index('nip_pptk2');
            $table->index('RKAID_Src');

     
        });       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {        
        Schema::dropIfExists('trRKA');
    }
}
