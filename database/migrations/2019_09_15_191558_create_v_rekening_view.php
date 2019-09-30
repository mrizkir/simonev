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
                CONCAT(E."Kd_Rek_1",\'.\',D."Kd_Rek_2",\'.\',C."Kd_Rek_3",\'.\',B."Kd_Rek_4",\'.\',A."Kd_Rek_5") AS "Kd_Rek_5",
                CONCAT(E."Kd_Rek_1",\'.\',D."Kd_Rek_2",\'.\',C."Kd_Rek_3",\'.\',B."Kd_Rek_4") AS "Kd_Rek_4",
                CONCAT(E."Kd_Rek_1",\'.\',D."Kd_Rek_2",\'.\',C."Kd_Rek_3") AS "Kd_Rek_3",
                CONCAT(E."Kd_Rek_1",\'.\',D."Kd_Rek_2") AS "Kd_Rek_2",
                E."Kd_Rek_1",
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
