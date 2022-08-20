<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;

class CartController extends ShopFrontEndController
{
    public function __construct()
    {
        $this->controllerName     = 'product';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Giỏ hàng';
        parent::__construct();
    }
    public function cart_product(){
        return view($this->pathViewController . 'cart');
    }
}
