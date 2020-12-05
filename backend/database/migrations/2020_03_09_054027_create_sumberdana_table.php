<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSumberdanaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmSumberDana', function (Blueprint $table) {
            $table->string('SumberDanaID',19);
            $table->tinyInteger('Kd_SumberDana');
            $table->string('Nm_SumberDana',40);
            $table->string('Descr')->nullable();
            $table->year('TA');
            $table->string('SumberDanaID_Src',19)->nullable();
            $table->timestamps();

            $table->primary('SumberDanaID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tmSumberDana');
    }
}
