<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRpjmdkebijakanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmPrioritasKebijakanKab', function (Blueprint $table) {
            $table->string('PrioritasKebijakanKabID',19);
            $table->string('PrioritasStrategiKabID',19);            
            $table->string('Kd_Kebijakan',4);
            $table->text('Nm_Kebijakan');           
            $table->string('Descr')->nullable();
            $table->year('TA');
            $table->string('PrioritasKebijakanKabID_Src',19)->nullable();
            $table->boolean('Locked')->default(0);

            $table->timestamps();
                
            $table->primary('PrioritasKebijakanKabID');

            $table->index('PrioritasStrategiKabID');

            $table->foreign('PrioritasStrategiKabID')
                    ->references('PrioritasStrategiKabID')
                    ->on('tmPrioritasStrategiKab')
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
        Schema::dropIfExists('tmPrioritasKebijakanKab');
    }
}
