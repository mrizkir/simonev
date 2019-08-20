<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRkakegiatanmurniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trRKA', function (Blueprint $table) {
            $table->string('RKAID',19);
            $table->string('OrgID',19);
            $table->string('SOrgID',19);
            $table->string('PrgID',19);
            $table->string('RKPDID',19)->nullable();
            $table->text('KgtNm');
            $table->decimal('PaguDana1',15,2);
            $table->decimal('PaguDana2',15,2)->nullable();
            $table->string('Descr')->nullable();            
            $table->year('TA'); 
            $table->boolean('Locked')->default(0);
            $table->timestamps();

            $table->primary('RKAID');
            $table->index('OrgID');
            $table->index('SOrgID');
            $table->index('PrgID');
            $table->index('RKPDID');

            $table->foreign('OrgID')
                    ->references('OrgID')
                    ->on('tmOrg')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('SOrgID')
                    ->references('SOrgID')
                    ->on('tmSOrg')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('PrgID')
                    ->references('PrgID')
                    ->on('tmPrg')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('RKPDID')
                    ->references('RKPDID')
                    ->on('trRKPD')
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
        Schema::dropIfExists('rkakegiatanmurni');
    }
}
