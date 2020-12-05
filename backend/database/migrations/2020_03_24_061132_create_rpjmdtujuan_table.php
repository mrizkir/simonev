<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRpjmdtujuanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmPrioritasTujuanKab', function (Blueprint $table) {
            $table->string('PrioritasTujuanKabID',19);
            $table->string('PrioritasKabID',19);            
            $table->string('Kd_Tujuan',4);
            $table->text('Nm_Tujuan');           
            $table->string('Descr')->nullable();
            $table->year('TA');
            $table->string('PrioritasTujuanKabID_Src',19)->nullable();
            $table->boolean('Locked')->default(0);

            $table->timestamps();
            
            $table->primary('PrioritasTujuanKabID');

            $table->index('PrioritasKabID');

            $table->foreign('PrioritasKabID')
                    ->references('PrioritasKabID')
                    ->on('tmPrioritasKab')
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
        Schema::dropIfExists('tmPrioritasTujuanKab');
    }
}
