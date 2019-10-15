<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRkatargetrinciankegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trRKATargetRinc', function (Blueprint $table) {
            $table->string('RKATargetRincID',19);
            $table->string('RKAID',19);
            $table->string('RKARincID',19);
            $table->tinyInteger('bulan1');
            $table->tinyInteger('bulan2');
            $table->decimal('target1',15,2);
            $table->decimal('target2',15,2);
            $table->decimal('realisasi1',15,2);            
            $table->decimal('realisasi2',15,2);            
            $table->decimal('fisik1',5,2);            
            $table->decimal('fisik2',5,2);            
            $table->boolean('StatusIsiKeuangan1');            
            $table->boolean('StatusIsiKeuangan2');           
            $table->boolean('StatusIsiFisik1');            
            $table->boolean('StatusIsiFisik2');            
            $table->tinyInteger('EntryLvl')->default(0);
            $table->string('Descr')->nullable();            
            $table->year('TA'); 
            $table->boolean('Locked')->default(0);
            $table->string('RKATargetRincID_Src',19)->nullable();
            $table->timestamps();

            $table->primary('RKATargetRincID');
            $table->index('RKAID');
            $table->index('RKARincID');
            $table->index('RKATargetRincID_Src');

            $table->foreign('RKARincID')
                    ->references('RKARincID')
                    ->on('trRKARinc')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');    

            $table->foreign('RKAID')
                    ->references('RKAID')
                    ->on('trRKA')
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
        Schema::dropIfExists('trRKATargetRinc');
    }
}
