<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRekeningstrukturTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmStr', function (Blueprint $table) {
            $table->string('StrID',19);
            $table->string('Kd_Rek_1',4);
            $table->string('StrNm');
            $table->string('Descr')->nullable();
            $table->year('TA');
            $table->string('StrID_Src',19)->nullable();
            $table->timestamps();

            $table->primary('StrID');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tmStr');
    }
}
