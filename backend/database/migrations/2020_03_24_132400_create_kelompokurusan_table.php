<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKelompokurusanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmKUrs', function (Blueprint $table) {
            $table->string('KUrsID',19);
            $table->string('RpjmdVisiID',19)->nullable();
            $table->tinyInteger('Kd_Urusan');
            $table->string('Nm_Urusan',100);            
            $table->string('Descr')->nullable();
            $table->year('TA');
            $table->string('KUrsID_Src',19)->nullable();
            $table->boolean('Locked')->default(0);
            
            $table->timestamps();

            $table->primary('KUrsID');
            $table->index('Kd_Urusan');
            $table->index('RpjmdVisiID');

            $table->foreign('RpjmdVisiID')
                    ->references('RpjmdVisiID')
                    ->on('tmRpjmdVisi')
                    ->onDelete('set null')
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
        Schema::dropIfExists('tmKUrs');
    }
}
