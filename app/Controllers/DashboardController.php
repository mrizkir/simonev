<?php

namespace App\Controllers;

use App\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Membuat sebuah objek
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['auth']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $auth = \Auth::user();
        $roles = $auth->getRoleNames();
        $bulan_realisasi = \HelperKegiatan::getBulanRealisasi() > 9 ? 9:HelperKegiatan::getBulanRealisasi();
        switch ($roles[0]) {
            case 'superadmin':
            case 'bapelitbang':
            case 'tapd':
                $jumlah_opd = \DB::table('tmOrg')
                                ->where('TA',\HelperKegiatan::getTahunAnggaran())
                                ->count('OrgID');

                $jumlah_kegiatan = \DB::table('s_targetkinerja_opd')
                        ->where('TA',\HelperKegiatan::getTahunAnggaran())
                        ->where('bulan',$bulan_realisasi)
                        ->sum('jumlah_kegiatan1');

                $pagudana=\DB::table('s_targetkinerja_opd')
                            ->where('TA',\HelperKegiatan::getTahunAnggaran())
                            ->where('bulan',$bulan_realisasi)
                            ->sum('pagudinas1');

                $realisasi=\DB::table('s_targetkinerja_opd')
                            ->where('TA',\HelperKegiatan::getTahunAnggaran())
                            ->where('bulan',$bulan_realisasi)
                            ->sum('realisasi_keuangan1');
                
                $sisa_anggaran=$pagudana-$realisasi;

                $target_realisasi=\DB::table('s_targetkinerja_opd')
                                        ->where('TA',\HelperKegiatan::getTahunAnggaran())
                                        ->where('bulan',$bulan_realisasi)
                                        ->sum('persen_target_keuangan1');                
                $persen_target_keuangan = \Helper::formatPecahan($target_realisasi,$jumlah_opd);

                $persen_realisasi=\DB::table('s_targetkinerja_opd')
                                        ->where('TA',\HelperKegiatan::getTahunAnggaran())
                                        ->where('bulan',$bulan_realisasi)
                                        ->sum('persen_realisasi_keuangan1');
                $persen_realisasi_keuangan = \Helper::formatPecahan($persen_realisasi,$jumlah_opd);
                
                $t_fisik=\DB::table('s_targetkinerja_opd')
                                        ->where('TA',\HelperKegiatan::getTahunAnggaran())
                                        ->where('bulan',$bulan_realisasi)
                                        ->sum('target_fisik1');

                $target_fisik = \Helper::formatPecahan($t_fisik,$jumlah_opd);

                $r_fisik=\DB::table('s_targetkinerja_opd')
                                        ->where('TA',\HelperKegiatan::getTahunAnggaran())
                                        ->where('bulan',$bulan_realisasi)
                                        ->sum('realisasi_fisik1');
                $realisasi_fisik = \Helper::formatPecahan($r_fisik,$jumlah_opd);;

                $data = [];
                return view("pages.dore.dashboard.index")->with([
                                                        'page_active' => 'dashboard',
                                                        'jumlah_opd' => $jumlah_opd,
                                                        'bulan_realisasi'=>$bulan_realisasi,
                                                        'data' => $data,
                                                        'pagudana' => $pagudana,
                                                        'jumlah_kegiatan' => $jumlah_kegiatan,
                                                        'realisasi' => $realisasi,
                                                        'sisa_anggaran' => $sisa_anggaran,
                                                        'persen_target_keuangan' => $persen_target_keuangan,
                                                        'persen_realisasi_keuangan' => $persen_realisasi_keuangan,
                                                        'target_fisik' => $target_fisik,
                                                        'realisasi_fisik' => $realisasi_fisik,                                                        
                ]);
            break;
            case 'opd':
                $data = [];
                return view("pages.dore.dashboard.indexOPD")->with([
                    'page_active' => 'dashboard',
                    'data' => $data,
                ]);
            break;
            case 'dewan':
                return view("pages.dore.dashboard.indexDewan")->with([
                    'page_active' => 'dashboard',
                    'data' => $data,
                ]);
            break;
            case 'kecamatan':
                $data = [];
                return view("pages.dore.dashboard.indexKecamatan")->with([
                    'page_active' => 'dashboard',
                    'data' => $data,
                ]);
            break;
            case 'desa':
                $data = [];
                return view("pages.dore.dashboard.indexDesa")->with([
                    'page_active' => 'dashboard',
                    'data' => $data,
                ]);
            break;
        }
    }
}
