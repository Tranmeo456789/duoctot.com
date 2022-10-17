<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Shop\Cat_productModel;
use App\Model\Shop\CatProductModel;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;

use App\Model\Shop\ProductModel as MainModel;
use App\Model\Shop\TrademarkModel ;
use App\Model\Shop\Tinhthanhpho;
include "app/Helpers/data.php";
class ProductController extends ShopFrontEndController
{
    public function __construct()
    {
        $this->controllerName     = 'product';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Chi tiết sản phẩm';
        $this->model = new MainModel();
        parent::__construct();
        $data = CatProductModel::all();
        $_SESSION['cat_product']= $catps = data_tree1($data, 0);
    }
    public function detail(Request $request){
        $params['id'] = intval($request->id);
        $item= $this->model->getItem($params,['task' => 'frontend-get-item']);
        return view($this->pathViewController . 'detail',compact('item'));
    }
}
