<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrusanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmUrs', function (Blueprint $table) {
            $table->string('UrsID',19);
            $table->string('KUrsID',19);
            $table->string('Kd_Bidang',4);
            $table->string('Nm_Bidang',100);           
            $table->string('Descr')->nullable();
            $table->year('TA');
            $table->string('UrsID_Src',19)->nullable();
            $table->boolean('Locked')->default(0);

            $table->timestamps();

            $table->primary('UrsID');
            $table->index('KUrsID');
            $table->index('Kd_Bidang');

            $table->foreign('KUrsID')
                ->references('KUrsID')
                ->on('tmKUrs')
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
        Schema::dropIfExists('tmUrs');
    }
}
