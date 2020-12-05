<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVRencanaFisikAnggaranKasView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement('CREATE VIEW v_rencana_fisik_anggaran_kas AS
            SELECT 
                "RKARincID",
                a[1] fisik_1,
                b[1] anggaran_1, 
                a[2] fisik_2,
                b[2] anggaran_2, 
                a[3] fisik_3,
                b[3] anggaran_3, 
                a[4] fisik_4,
                b[4] anggaran_4, 
                a[5] fisik_5,
                b[5] anggaran_5, 
                a[6] fisik_6,
                b[6] anggaran_6,
                a[7] fisik_7,
                b[7] anggaran_7, 
                a[8] fisik_8,
                b[8] anggaran_8, 
                a[9] fisik_9,
                b[9] anggaran_9, 
                a[10] fisik_10,
                b[10] anggaran_10, 
                a[11] fisik_11,
                b[11] anggaran_11, 
                a[12] fisik_12,
                b[12] anggaran_12
            FROM
            (
                SELECT "RKARincID",array_agg(fisik1) a,array_agg(target1) b
                FROM (SELECT "RKARincID",fisik1,target1 FROM "trRKATargetRinc" ORDER BY bulan1 ASC) AS temp
                GROUP BY 1	
            ) AS z
        ');				
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement('DROP VIEW v_rencana_fisik_anggaran_kas');
    }
}
