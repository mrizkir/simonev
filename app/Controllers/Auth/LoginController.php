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
        $this->putControllerStateSession('global_controller','tahun_perencanaan',request()->input('TACd'));
        $this->putControllerStateSession('global_controller','tahun_penyerapan',request()->input('TACd')-1);
    }
}