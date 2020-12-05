<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmTA', function (Blueprint $table) {
            $table->string('TAID',19);
            $table->year('TACd');
            $table->string('TANm',100);
            $table->string('Descr')->nullable();
            $table->timestamps();

            $table->primary('TAID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tmTA');
    }
}
