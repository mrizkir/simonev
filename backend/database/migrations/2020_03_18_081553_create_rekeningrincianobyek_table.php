<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRekeningrincianobyekTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmROby', function (Blueprint $table) {
            $table->string('RObyID',19);
            $table->string('ObyID',19);            
            $table->string('Kd_Rek_5',4);
            $table->string('RObyNm');
            $table->string('Descr')->nullable();
            $table->year('TA');
            $table->string('RObyID_Src',19)->nullable();
            $table->timestamps();

            $table->primary('RObyID');
            $table->index('ObyID');

            $table->foreign('ObyID')
                            ->references('ObyID')
                            ->on('tmOby')
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
        Schema::dropIfExists('tmROby');
    }
}
