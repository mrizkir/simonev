<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmASN', function (Blueprint $table) {
            $table->string('ASNID',19);
            $table->string('NIP_ASN',30);
            $table->string('Nm_ASN',19);                        
            $table->string('Descr')->nullable();    
            $table->year('TA');                    
            $table->boolean('Active')->default(1);
            $table->boolean('Locked')->default(0);
            $table->timestamps();

            $table->primary('ASNID');    
            $table->unique('NIP_ASN');    

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tmASN');
    }
}
