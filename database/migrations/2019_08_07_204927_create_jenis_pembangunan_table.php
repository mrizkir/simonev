<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJenisPembangunanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmJenisPembangunan', function (Blueprint $table) {
            $table->string('JenisPembangunanID',19);
            $table->string('NamaJenis');
            $table->string('Descr')->nullable();    
            $table->year('TA');                    
            $table->boolean('Locked')->default(0);
            $table->timestamps();

            $table->primary('JenisPembangunanID');    

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tmJenisPembangunan');
    }
}
