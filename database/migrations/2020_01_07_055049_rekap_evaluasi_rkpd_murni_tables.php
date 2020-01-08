<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RekapEvaluasiRkpdMurniTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekap_evaluasi_rkpd_murni', function (Blueprint $table) {
            $table->year('TA');
            $table->string('kode',30)->nullable();
            $table->string('PrioritasSasaranKabID')->nullable();                        
            $table->string('Nm_Sasaran')->nullable();                        
            $table->string('Nm_Urusan')->nullable();                        
            $table->string('Nm_Bidang')->nullable();                        
            $table->string('PrgNm')->nullable();                        
            $table->string('KgtNm')->nullable();                        
            $table->string('ik_program')->nullable();                        
            $table->string('ik_kegiatan')->nullable();                        
            $table->decimal('t_rpjmd_n_k',5,2)->default(0);  // Target RPJMD pada Tahun 2020                      
            $table->decimal('t_rpjmd_n_rp',15,2)->default(0);  // Target RPJMD pada Tahun 2020                      
            $table->decimal('rck_rpjmd_n_min_2_k',5,2)->default(0); // Realisasi Capaian Kinerja RPJMD s/d RKPD Tahun (n-2)                       
            $table->decimal('rck_rpjmd_n_min_2_rp',15,2)->default(0); // Realisasi Capaian Kinerja RPJMD s/d RKPD Tahun (n-2)                       
            $table->decimal('tk_rkpd_n_min_1_k',5,2)->default(0); //Target Kinerja dan Anggaran RKPD Tahun (n-1)                       
            $table->decimal('tk_rkpd_n_min_1_rp',15,2)->default(0); //Target Kinerja dan Anggaran RKPD Tahun (n-1)                       
            $table->decimal('rk_tw1_k',5,2)->default(0);                        
            $table->decimal('rk_tw1_rp',15,2)->default(0);                        
            $table->decimal('rk_tw2_k',5,2)->default(0);                        
            $table->decimal('rk_tw2_rp',15,2)->default(0);                        
            $table->decimal('rk_tw3_k',5,2)->default(0);                        
            $table->decimal('rk_tw3_rp',15,2)->default(0);                        
            $table->decimal('rk_tw4_k',5,2)->default(0);                        
            $table->decimal('rk_tw4_rp',15,2)->default(0);                        
            $table->decimal('rck_rkpd_k',5,2)->default(0); // Realisasi Kinerja dan Anggaran RPJMD s/d Tahun n                                           
            $table->decimal('rck_rkpd_rp',15,2)->default(0); // Realisasi Kinerja dan Anggaran RPJMD s/d Tahun n                     
            $table->decimal('rk_rpjmd_sd_n_k',5,2)->default(0); //  Tingkat Capaian Kinerja dan Realisasi Anggaran RPJMD s/d Tahun n (%)                       
            $table->decimal('rk_rpjmd_sd_n_rp',15,2)->default(0); //  Tingkat Capaian Kinerja dan Realisasi Anggaran RPJMD s/d Tahun n (%)                   
            $table->string('OrgID',19)->nullable();    
            $table->string('OrgNm')->nullable();    
            $table->timestamps();

            $table->index('TA');    
            $table->index('PrioritasSasaranKabID');    
            $table->index('OrgID');    

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rekap_evaluasi_rkpd_murni');
    }
}
