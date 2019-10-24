<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJenisPelaksanaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmJenisPelaksanaan', function (Blueprint $table) {
            $table->string('JenisPelaksanaanID',19);
            $table->string('NamaJenis');
            $table->string('Descr')->nullable();    
            $table->year('TA');                    
            $table->boolean('Locked')->default(0);
            $table->timestamps();

            $table->primary('JenisPelaksanaanID');    

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tmJenisPelaksanaan');
    }
}
