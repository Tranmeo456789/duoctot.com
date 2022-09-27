<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Shop\Cat_productModel;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use App\Http\Requests\CatProductRequest;
use App\Http\Requests\UnitRequest;
use App\Model\Shop\ProductModel;
use App\Model\Shop\TrademarkModel;
use App\Model\Shop\Tinhthanhpho;
include "app/Helpers/data.php";
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
        $_SESSION['cat_product']= $catps = data_tree1($data, 0);
    }
    public function detail_product($id){        
        $productcs=ProductModel::find($id);         
        //$img_products = explode(",", $productcs->image);
        $unit=$productcs->unitProduct;
       // return($unit);
       // $customer_id = sprintf("%08d", $customer_id);
        return view($this->pathViewController . 'detail_product',compact('productcs'));
    }
}
