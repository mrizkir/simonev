<?php

namespace App\Controllers;

use Illuminate\Http\Request;
use App\Controllers\Controller;
use App\Models\DashboardModel;

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

        switch ($roles[0]) {
            case 'superadmin':
            case 'bapelitbang':
            case 'tapd':
                $data = [];
                return view("pages.dore.dashboard.index")->with([
                    'page_active' => 'dashboard',
                    'data' => $data
                ]);
                break;
            case 'opd':
                $data = [];
                return view("pages.dore.dashboard.indexOPD")->with([
                    'page_active' => 'dashboard',
                    'data' => $data
                ]);
                break;
            case 'dewan':
                return view("pages.dore.dashboard.indexDewan")->with([
                    'page_active' => 'dashboard',
                    'data' => $data
                ]);
                break;
            case 'kecamatan':
                $data = [];
                return view("pages.dore.dashboard.indexKecamatan")->with([
                    'page_active' => 'dashboard',
                    'data' => $data
                ]);
                break;
            case 'desa':
                $data = [];
                return view("pages.dore.dashboard.indexDesa")->with([
                    'page_active' => 'dashboard',
                    'data' => $data
                ]);
                break;
        }
    }
}
