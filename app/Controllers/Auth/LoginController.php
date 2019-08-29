<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{   
    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {
        $theme = 'dore';
        return view("pages.$theme.auth.login");
    }
    public function username () {
        return 'username';
    }
    
    protected function authenticated ()
    {
        $data_visi = \App\Models\RPJMD\RPJMDVisiModel::find(config('simonev.rpjmd_visi_id'));        
        $this->putControllerStateSession('global_controller','rpjmd_visi_id',config('simonev.rpjmd_visi_id'));
        
        $this->putControllerStateSession('global_controller','rpjmd_tahun_awal',$data_visi->TA_Awal);
        $this->putControllerStateSession('global_controller','rpjmd_tahun_mulai',$data_visi->TA_Awal+1);
        $this->putControllerStateSession('global_controller','rpjmd_tahun_akhir',$data_visi->TA_Awal+5);

        $this->putControllerStateSession('global_controller','renstra_tahun_awal',$data_visi->TA_Awal);
        $this->putControllerStateSession('global_controller','renstra_tahun_mulai',$data_visi->TA_Awal+1);
        $this->putControllerStateSession('global_controller','renstra_tahun_akhir',$data_visi->TA_Awal+5);

        $tahun_perencanaan = request()->input('TACd');
        $tahun_penyerapan = $tahun_perencanaan;

        $this->putControllerStateSession('global_controller','tahun_perencanaan',$tahun_perencanaan);
        $this->putControllerStateSession('global_controller','tahun_penyerapan',$tahun_penyerapan);

        $tahun_n = $tahun_perencanaan-$data_visi->TA_Awal;
        $this->putControllerStateSession('global_controller','tahun_N',"N$tahun_n");
    }
}