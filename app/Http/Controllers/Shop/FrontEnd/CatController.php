<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;

class CatController extends ShopFrontEndController
{
    public function __construct()
    {
        $this->controllerName     = 'cat';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'danh mục';
        parent::__construct();
    }
    public function index(){
        return view($this->pathViewController . 'index');
    }
}
