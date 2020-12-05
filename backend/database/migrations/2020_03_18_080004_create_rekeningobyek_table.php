<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRekeningobyekTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmOby', function (Blueprint $table) {
            $table->string('ObyID',19);
            $table->string('JnsID',19);            
            $table->string('Kd_Rek_4',4);
            $table->string('ObyNm');
            $table->string('Descr')->nullable();
            $table->year('TA');
            $table->string('ObyID_Src',19)->nullable();
            $table->timestamps();

            $table->primary('ObyID');
            $table->index('JnsID');

            $table->foreign('JnsID')
                            ->references('JnsID')
                            ->on('tmJns')
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
        Schema::dropIfExists('tmOby');
    }
}
