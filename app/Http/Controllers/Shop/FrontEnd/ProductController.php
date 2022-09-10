<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Shop\Cat_productModel;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use App\Model\Shop\ProductModel;
use App\Model\Shop\Tinhthanhpho;
class ProductController extends ShopFrontEndController
{
    public function __construct()
    {
        $this->controllerName     = 'cat';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Chi tiết sản phẩm';
        parent::__construct();
        $data = Cat_productModel::all();
        $_SESSION['local']=$local=Tinhthanhpho::all();
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
    public function detail_product($id){  
        $productcs=ProductModel::find($id);
        $cat= $productcs->cat;
        $img_products = explode(",", $productcs->image);
        return view($this->pathViewController . 'detail_product',compact('productcs','img_products','cat'));
    }
}
