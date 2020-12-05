<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRpjmdindikatortujuanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmPrioritasIndikatorTujuan', function (Blueprint $table) {
            $table->string('PrioritasIndikatorTujuanID',19);
            $table->string('PrioritasTujuanKabID',19);            
            $table->text('NamaIndikator');
            $table->string('KondisiAwal',6,2);
            $table->string('KondisiAkhir',6,2);
            $table->string('Satuan');           
            $table->string('Descr')->nullable();
            $table->year('TA');
            $table->string('PrioritasIndikatorTujuanID_Src',19)->nullable();
            $table->boolean('Locked')->default(0);

            $table->timestamps();
            
            $table->primary('PrioritasIndikatorTujuanID');

            $table->index('PrioritasTujuanKabID');

            $table->foreign('PrioritasTujuanKabID')
                    ->references('PrioritasTujuanKabID')
                    ->on('tmPrioritasTujuanKab')
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
        Schema::dropIfExists('tmPrioritasIndikatorTujuan');
    }
}
