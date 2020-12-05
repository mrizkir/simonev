<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRpjmdsasaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmPrioritasSasaranKab', function (Blueprint $table) {
            $table->string('PrioritasSasaranKabID',19);
            $table->string('PrioritasTujuanKabID',19);            
            $table->string('Kd_Sasaran',4);
            $table->text('Nm_Sasaran');           
            $table->string('Descr')->nullable();
            $table->year('TA');
            $table->string('PrioritasSasaranKabID_Src',19)->nullable();
            $table->boolean('Locked')->default(0);

            $table->timestamps();
            
            $table->primary('PrioritasSasaranKabID');

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
        Schema::dropIfExists('tmPrioritasSasaranKab');
    }
}
