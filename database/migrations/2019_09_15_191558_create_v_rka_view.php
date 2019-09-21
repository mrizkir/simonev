<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVRkaView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement('CREATE VIEW v_rka AS
            SELECT 
                A."RKAID",
                A."RKPDID",
                A."OrgID",
                A."SOrgID",
                E."Kd_Urusan" AS "Kd_UrusanUnit",
                D."Kd_Bidang" AS "Kd_BidangUnit",
                CONCAT(E."Kd_Urusan",  \'.\', D."Kd_Bidang",\'.\', B."OrgCd") AS kode_organisasi,
                B."OrgCd",
                B."OrgNm",
                CONCAT(E."Kd_Urusan",\'.\',D."Kd_Bidang",\'.\',B."OrgCd",\'.\',C."SOrgCd") kode_suborganisasi,
                C."SOrgCd",
                C."SOrgNm",                
                J."KUrsID",
                J."Kd_Urusan",
                J."Nm_Urusan",
                I."UrsID",
                I."Kd_Bidang",
                CASE 
                    WHEN I."UrsID" IS NOT NULL OR  J."KUrsID" IS NOT NULL THEN
                        CONCAT(J."Kd_Urusan",\'.\',I."Kd_Bidang")
                    ELSE
                        \'SEMUA URUSAN\'
                END AS kode_urusan,
                I."Nm_Bidang",
                G."PrgID",
                G."Kd_Prog",
                CASE 
                    WHEN I."UrsID" IS NOT NULL OR  J."KUrsID" IS NOT NULL THEN
                        CONCAT(J."Kd_Urusan",\'.\',I."Kd_Bidang",\'.\',G."Kd_Prog")
                    ELSE
                        CONCAT(\'0.\',\'00.\',G."Kd_Prog")
                END AS kode_program,
                G."PrgNm",
                G."Jns",
                A."KgtID",
                F."Kd_Keg",
                CASE 
                    WHEN I."UrsID" IS NOT NULL OR  J."KUrsID" IS NOT NULL THEN
                        CONCAT(J."Kd_Urusan", \'.\',I."Kd_Bidang", \'.\',G."Kd_Prog", \'.\',F."Kd_Keg")
                    ELSE
                        CONCAT(\'0.00.\',G."Kd_Prog", \'.\',F."Kd_Keg")
                END AS kode_kegiatan,
                F."KgtNm",
                K."Nm_SumberDana",
                A."keluaran",
                A."tk_keluaran",
                A."hasil",
                A."tk_hasil",
                A."capaian_program",
                A."tk_capaian",
                A."masukan",
                A."ksk",
                A."sifat_kegiatan",
                A."waktu_pelaksanaan",
                A."lokasi_kegiatan",
                A."PaguDana1",
                A."PaguDana2",
                A."nip_pa",
                A."nip_kpa",
                A."nip_ppk",
                A."nip_pptk",
                A."user_id",
                A."Descr",
                A."TA",
                A."Status",
                A."Status_Indikator",
                A."EntryLvl",
                A."Privilege",
                A."RKPDID_Src",
                A."created_at",
                A."updated_at"
            FROM "trRKA" A
            JOIN "tmOrg" B ON A."OrgID"=B."OrgID"
            JOIN "tmSOrg" C ON A."SOrgID"=C."SOrgID"
            JOIN "tmUrs" D ON B."UrsID"=D."UrsID"
            JOIN "tmKUrs" E ON D."KUrsID"=E."KUrsID"
            LEFT JOIN "tmSumberDana" K ON K."SumberDanaID"=A."SumberDanaID"

            JOIN "tmKgt" F ON A."KgtID"=F."KgtID"
            JOIN "tmPrg" G ON F."PrgID"=G."PrgID"
            LEFT JOIN "trUrsPrg" H ON G."PrgID"=H."PrgID"
            LEFT JOIN "tmUrs" I ON H."UrsID"=I."UrsID"
            LEFT JOIN "tmKUrs" J ON J."KUrsID"=I."KUrsID"

            ORDER BY
                    J."Kd_Urusan"::int ASC NULLS FIRST,
                    I."Kd_Bidang"::int ASC NULLS FIRST,
                    G."Kd_Prog"::int ASC,
                    F."Kd_Keg"::int ASC                 
        ');				
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement('DROP VIEW v_rka');
    }
}
