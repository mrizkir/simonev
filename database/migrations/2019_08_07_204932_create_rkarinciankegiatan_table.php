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
            $table->string('SumberDanaID',19)->nullable();
            $table->text('nama_uraian')->nullable();
            $table->string('volume1')->nullable();
            $table->string('volume2')->nullable();
            $table->string('satuan1',50)->nullable();            
            $table->string('satuan2',50)->nullable();            
            $table->decimal('harga_satuan1',15,2);
            $table->decimal('harga_satuan2',15,2);
            $table->decimal('pagu_uraian1',15,2);            
            $table->decimal('pagu_uraian2',15,2);            
            $table->string('idlok',19)->nullable();
            $table->string('ket_lok',3)->nullable();
            $table->string('rw',5)->nullable();
            $table->string('rt',5)->nullable();
            $table->string('nama_perusahaan')->nullable();
            $table->string('alamat_perusahaan')->nullable();
            $table->string('no_telepon',25)->nullable();
            $table->string('nama_direktur')->nullable();
            $table->string('npwpw',25)->nullable();
            $table->string('no_kontrak')->nullable();
            $table->date('tgl_kontrak')->nullable();
            $table->date('tgl_mulai_pelaksanaan')->nullable();
            $table->date('tgl_selesai_pelaksanaan')->nullable();
            $table->boolean('status_lelang')->default(0);

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
