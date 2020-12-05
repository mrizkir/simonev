<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRpjmdstrategiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmPrioritasStrategiKab', function (Blueprint $table) {
            $table->string('PrioritasStrategiKabID',19);
            $table->string('PrioritasSasaranKabID',19);            
            $table->string('Kd_Strategi',4);
            $table->text('Nm_Strategi');           
            $table->string('Descr')->nullable();
            $table->year('TA');
            $table->string('PrioritasStrategiKabID_Src',19)->nullable();
            $table->boolean('Locked')->default(0);

            $table->timestamps();
            
            $table->primary('PrioritasStrategiKabID');

            $table->index('PrioritasSasaranKabID');

            $table->foreign('PrioritasSasaranKabID')
                    ->references('PrioritasSasaranKabID')
                    ->on('tmPrioritasSasaranKab')
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
        Schema::dropIfExists('tmPrioritasStrategiKab');
    }
}
