<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVRekeningView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement('CREATE VIEW v_rekening AS
            SELECT 
                A."RObyID",
                B."ObyID",
                C."JnsID",
                D."KlpID",
                E."StrID",
                CONCAT(E."Kd_Rek_1",\'.\',D."Kd_Rek_2",\'.\',C."Kd_Rek_3",\'.\',B."Kd_Rek_4",\'.\',A."Kd_Rek_5") AS "kode_rek_5",
                CONCAT(E."Kd_Rek_1",\'.\',D."Kd_Rek_2",\'.\',C."Kd_Rek_3",\'.\',B."Kd_Rek_4") AS "kode_rek_4",
                CONCAT(E."Kd_Rek_1",\'.\',D."Kd_Rek_2",\'.\',C."Kd_Rek_3") AS "kode_rek_3",
                CONCAT(E."Kd_Rek_1",\'.\',D."Kd_Rek_2") AS "kode_rek_2",
                E."Kd_Rek_1",
                D."Kd_Rek_2",
                C."Kd_Rek_3",
                B."Kd_Rek_4",
                A."Kd_Rek_5",
                A."RObyNm",
                B."ObyNm",
                C."JnsNm",
                D."KlpNm",
                E."StrNm",
                E."TA"
            FROM "tmROby" A
            JOIN "tmOby" B ON A."ObyID"=B."ObyID"
            JOIN "tmJns" C ON B."JnsID"=C."JnsID"
            JOIN "tmKlp" D ON C."KlpID"=D."KlpID"
            JOIN "tmStr" E ON D."StrID"=E."StrID" 
            ORDER BY E."Kd_Rek_1"::int ASC NULLS FIRST,
                    D."Kd_Rek_2"::int ASC NULLS FIRST,
                    C."Kd_Rek_3"::int ASC NULLS FIRST,
                    B."Kd_Rek_4"::int ASC NULLS FIRST,
                    A."Kd_Rek_5"::int ASC NULLS FIRST
        ');				
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement('DROP VIEW v_rekening');
    }
}
