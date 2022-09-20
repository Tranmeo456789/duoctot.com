<?php


namespace App\Http\Controllers\Shop\BackEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Shop\BackEnd\BackEndController;
class DashboardController extends BackEndController
{
    public function __construct()
    {
        $this->controllerName     = 'dashboard';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Thống kê bán hàng';
        parent::__construct();
    }
    public function index(Request $request){
        return view($this->pathViewController .  'index');
    }
}
