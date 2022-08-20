<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;

class ProductController extends ShopFrontEndController
{
    public function __construct()
    {
        $this->controllerName     = 'cat';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Chi tiết sản phẩm';
        parent::__construct();
    }
    public function detail_product(){
        return view($this->pathViewController . 'detail_product');
    }
    
}
