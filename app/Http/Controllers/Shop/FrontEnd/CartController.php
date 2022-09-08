<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use App\Model\Shop\Cat_productModel;
class CartController extends ShopFrontEndController
{
    public function __construct()
    {
        $this->controllerName     = 'product';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Giỏ hàng';
        parent::__construct();
        $data = Cat_productModel::all();
        function data_tree1($data, $parent_id = 0, $level = 0)
        {
            $result = [];
            foreach ($data as $item) {
                if ($parent_id == $item['parent_id']) {
                    $item['level'] = $level;
                    $result[] = $item;
                    $child = data_tree1($data, $item['id'], $level + 1);
                    $result = array_merge($result, $child);
                }
            }
            return $result;
        }
        $_SESSION['cat_product']= $catps = data_tree1($data, 0);
    }
    public function cart_product(){
        return view($this->pathViewController . 'cart');
    }
    public function cart_null(){
        return view($this->pathViewController . 'cart_null');
    }
    public function pay_home(){
        return view($this->pathViewController . 'cart_pay_home');
    }
    public function pay_shop(){
        return view($this->pathViewController . 'cart_pay_shop');
    }
}
