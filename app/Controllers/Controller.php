<?php

namespace App\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;    
    /**
     * nama session
     */
    protected $PageTitle;
    /**
     * nama session
     */
    protected $SessionName;

     /**
     * nama dari halaman saat ini 
     */
    protected $NameOfPage;
    /**
     * nama session
     */
    protected $LabelTransfer;
    /**
     * digunakan untuk menampung daftar theme
     */
    protected $listOfthemes;

    public function __construct () 
    {          
        $this->listOfthemes=$this->getListThemes(false);
        \View::share('listOfthemes', $this->listOfthemes);
    }
    /**
     * digunakan untuk mendapatkan nama untuk session 
     */
    public function getNameForSession()
    {
        return \Helper::getNameOfPage();
    }
    /**
     * digunakan untuk mengecek apakah controller telah memiliki ke session
     */
    protected function checkStateIsExistSession($controllerName,$k) 
    {
        return request()->session()->has("$controllerName.$k");
    }
    /**
     * put new state for controller
     */
    protected function putControllerStateSession ($controllerName,$k,$v) 
    {
        $state = request()->session()->get($controllerName);
        $state[$k]=$v;
        request()->session()->put($controllerName,$state);        
    }
    /**
     * get state for controller
     */
    protected function getControllerStateSession ($controllerName,$k) 
    {
        if ($this->checkStateIsExistSession($controllerName,$k))
        {
            return request()->session()->get("$controllerName.$k");
        }
        else
        {
            return null;
        }
        
    }
    /**
     * destroy state for controller
     */
    protected function destroyControllerStateSession ($controllerName,$k) 
    {
        return request()->session()->forget("$controllerName.$k");
    }
     /**
     * setter value of current page inside session
     * @var controllerName name of controller
     * @var currentpage object of pagination
     */
    protected function setCurrentPageInsideSession($controllerName,$currentpage) 
    {   
        $this->putControllerStateSession($controllerName,'currentpage',$currentpage);
    }

    /**
     * getting value of current page inside session
     * @var controllerName name of controller
     * @return currentPage
     */
    protected function getCurrentPageInsideSession($controllerName) 
    {
        $currentPage=1;
        if ($this->checkStateIsExistSession($controllerName,'currentpage'))
        {
            $currentPage=$this->getControllerStateSession($controllerName,'currentpage');
        }
        return $currentPage;
    }

    /**
     * digunakan untuk mengecek apakah controller telah memiliki ke session
     */
    protected function checkStateIsExistCookie($controllerName,$k) 
    {
        $state = json_decode(\Cookie::get($controllerName),true);
        return isset($state[$k]);
    }
    /**
     * put new state for controller
     */
    protected function putControllerStateCookie ($controllerName,$k,$v) 
    {
        $state = json_decode(\Cookie::get($controllerName),true);
        $state[$k]=$v;                
        \Cookie::queue(\Cookie::make($controllerName,json_encode($state)));
    }
    /**
     * get state for controller
     */
    protected function getControllerStateCookie ($controllerName,$k) 
    {
        $state = json_decode(\Cookie::get($controllerName),true);
        if (isset($state[$k]))
        {
            return $state[$k];
        }
        else
        {
            return NULL;
        }        
    }
    /**
     * destroy state for controller
     */
    protected function destroyControllerStateCookie ($controllerName,$k=null) 
    {
        if ($k == null)
        {
            return \Cookie::forget($controllerName);
        }
        else
        {
            $state = json_decode(\Cookie::get($controllerName),true);      
            unset($state[$k]);
            \Cookie::queue(\Cookie::make($controllerName,json_encode($state)));
        }
    }
     /**
     * setter value of current page inside session
     * @var controllerName name of controller
     * @var currentpage object of pagination
     */
    protected function setCurrentPageInsideCookie($controllerName,$currentpage) 
    {   
        $this->putControllerStateCookie($controllerName,'currentpage',$currentpage);
    }

    /**
     * getting value of current page inside session
     * @var controllerName name of controller
     * @return currentPage
     */
    protected function getCurrentPageInsideCookie($controllerName) 
    {
        $currentPage=1;
        if ($this->checkStateIsExistCookie($controllerName,'currentpage'))
        {
            $state=$this->getControllerState($controllerName);
            $currentPage=$state['currentpage'];
        }
        return $currentPage;
    }   
    /**
     * digunakan untuk mendapatkan themes di folder themes
     */
    protected function getListThemes ($prepend=true) 
    {
        $folder_themes=public_path().DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR;
        $r = \File::directories($folder_themes);
        $daftar_theme=[];
        if ($prepend)
        {
            $daftar_theme['none']='DAFTAR THEME';
        }
        foreach ($r as $theme)
        {
            $arr = explode($folder_themes, $theme);
            if (isset($arr[1]) )
            {
                $daftar_theme[$arr[1]]=strtoupper($arr[1]);    
            }
           
        }
        return $daftar_theme;
    }
}