<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRpjmdmisiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmPrioritasKab', function (Blueprint $table) {
            $table->string('PrioritasKabID',19);
            $table->string('RpjmdVisiID',19);
            $table->string('Kd_PrioritasKab',4);
            $table->text('Nm_PrioritasKab');           
            $table->string('Descr')->nullable();
            $table->year('TA');
            $table->string('PrioritasKabID_Src',19)->nullable();
            $table->boolean('Locked')->default(0);

            $table->primary('PrioritasKabID');

            $table->index('RpjmdVisiID');

            $table->foreign('RpjmdVisiID')
                    ->references('RpjmdVisiID')
                    ->on('tmRpjmdVisi')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tmPrioritasKab');
    }
}
