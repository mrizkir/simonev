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
            $table->string('OrgID',19);
            $table->string('SOrgID',19);
            $table->string('PrgID',19);
            $table->string('KgtID',19);
            $table->string('EBudgetingID')->nullable();
            $table->string('SumberDanaID',19)->nullable();
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
            $table->decimal('PaguDana1',15,2);
            $table->decimal('PaguDana2',15,2)->nullable();
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
            $table->index('OrgID');
            $table->index('SOrgID');
            $table->index('PrgID');
            $table->index('KgtID');
            $table->index('EBudgetingID');
            $table->index('SumberDanaID');
            $table->index('nip_pa1');
            $table->index('nip_pa2');
            $table->index('nip_kpa1');
            $table->index('nip_kpa2');
            $table->index('nip_ppk1');
            $table->index('nip_ppk2');
            $table->index('nip_pptk1');
            $table->index('nip_pptk2');
            $table->index('RKAID_Src');

            $table->foreign('OrgID')
                    ->references('OrgID')
                    ->on('tmOrg')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('SOrgID')
                    ->references('SOrgID')
                    ->on('tmSOrg')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('PrgID')
                    ->references('PrgID')
                    ->on('tmPrg')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            
            $table->foreign('KgtID')
                    ->references('KgtID')
                    ->on('tmKgt')
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
        Schema::dropIfExists('trRKA');
    }
}
