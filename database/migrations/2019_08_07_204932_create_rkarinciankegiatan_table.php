<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRkarinciankegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trRKARinc', function (Blueprint $table) {
            $table->string('RKARincID',19);
            $table->string('RKAID',19);
            $table->string('RObyID',19);
            $table->string('JenisPelaksanaanID',19)->nullable();
            $table->text('nama_uraian')->nullable();
            $table->string('volume')->nullable();
            $table->string('satuan',50)->nullable();            
            $table->decimal('harga_satuan',15,2);
            $table->decimal('pagu_uraian',15,2);            
            $table->tinyInteger('EntryLvl')->default(0);
            $table->string('Descr')->nullable();            
            $table->year('TA'); 
            $table->boolean('Locked')->default(0);
            $table->string('RKARincID_Src',19)->nullable();
            $table->timestamps();

            $table->primary('RKARincID');
            $table->index('RKAID');
            $table->index('RObyID');
            $table->index('JenisPelaksanaanID');
            $table->index('RKARincID_Src');

            $table->foreign('RKAID')
                    ->references('RKAID')
                    ->on('trRKA')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('RObyID')
                    ->references('RObyID')
                    ->on('tmROby')
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
        Schema::dropIfExists('trRKARinc');
    }
}
