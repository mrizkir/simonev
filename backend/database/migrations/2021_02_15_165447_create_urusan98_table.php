<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrusan98Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmKUrs98', function (Blueprint $table) {
            $table->string('KUrsID',19);  
            $table->string('RpjmdVisiID',19)->nullable();          
            $table->string('Kd_Urusan',2);
            $table->string('Nm_Urusan');            
            $table->string('Descr')->nullable();
            $table->year('TA');
            $table->string('KUrsID_Src',19)->nullable();
            $table->boolean('Locked')->default(0);
            
            $table->timestamps();

            $table->primary('KUrsID');
            $table->index('Kd_Urusan');            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tmKUrs98');
    }
}
