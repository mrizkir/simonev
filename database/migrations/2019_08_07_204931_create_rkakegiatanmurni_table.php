<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRkakegiatanmurniTable extends Migration
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
            $table->string('RKPDID',19)->nullable();
            $table->string('SumberDanaID',19)->nullable();
            $table->text('keluaran')->nullable();
            $table->string('tk_keluaran')->nullable();
            $table->text('hasil')->nullable();
            $table->string('tk_hasil')->nullable();
            $table->text('capaian_program')->nullable();
            $table->string('tk_capaian')->nullable();
            $table->string('masukan')->nullable();
            $table->string('ksk')->nullable();
            $table->string('sifat_kegiatan',10)->nullable();
            $table->string('waktu_pelaksanaan',15)->nullable();
            $table->string('lokasi_kegiatan')->nullable();
            $table->decimal('PaguDana1',15,2);
            $table->decimal('PaguDana2',15,2)->nullable();
            $table->string('nip_pa',19)->nullable();
            $table->string('nip_kpa',19)->nullable();
            $table->string('nip_ppk',19)->nullable();
            $table->string('nip_pptk',19)->nullable();
            $table->integer('user_id'); 
            $table->string('Descr')->nullable();            
            $table->year('TA'); 
            $table->boolean('Locked')->default(0);
            $table->timestamps();

            $table->primary('RKAID');
            $table->index('OrgID');
            $table->index('SOrgID');
            $table->index('PrgID');
            $table->index('KgtID');
            $table->index('RKPDID');
            $table->index('SumberDanaID');
            $table->index('nip_pa');
            $table->index('nip_kpa');
            $table->index('nip_ppk');
            $table->index('nip_pptk');

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

            $table->foreign('RKPDID')
                    ->references('RKPDID')
                    ->on('trRKPD')
                    ->onDelete('set null')
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
