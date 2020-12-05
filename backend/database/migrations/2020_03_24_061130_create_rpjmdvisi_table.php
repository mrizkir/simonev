<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRpjmdvisiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmRpjmdVisi', function (Blueprint $table) {
            $table->string('RpjmdVisiID',19);
            $table->text('Nm_RpjmdVisi');           
            $table->string('Descr')->nullable();
            $table->year('TA_Awal');
            $table->boolean('Locked')->default(0);
            $table->timestamps();
            $table->primary('RpjmdVisiID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tmRpjmdVisi');
    }
}
