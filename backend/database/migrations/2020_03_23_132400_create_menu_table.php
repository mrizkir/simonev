<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('permission_id')->nullable();
            $table->string('title');
            $table->string('icon',20);            
            $table->string('link');
            $table->boolean('haveSubmenu')->default(false);
            $table->unsignedInteger('parent');            
            
            $table->timestamps();

            $table->index('permission_id');
            $table->index('parent');


            $table->foreign('permission_id')
                    ->references('id')
                    ->on('permissions')
                    ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
