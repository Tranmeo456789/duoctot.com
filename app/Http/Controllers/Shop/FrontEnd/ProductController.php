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

use Illuminate\Support\Facades\Cookie;
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
        $productViewed  = (isset($_COOKIE["productViewed"]))?json_decode($_COOKIE["productViewed"],true):[];
        $productCurrent = [];
        if (isset($productViewed[$params['id']])){
            $productCurrent[$params['id']] = $productViewed[$params['id']];
            unset($productViewed[$params['id']]);
        }else{
            $productCurrent[$params['id']] = [
                'product_id' => $item->id,
                'name'       => $item->name,
                'price'      => $item->price,
                'image'      => $item->image,
                'unit'       => $item->unitProduct->name
            ];
        }

        $productViewed = $productCurrent + $productViewed;
        if (count($productViewed) > 8){
            array_pop($productViewed);
        }
        setcookie("productViewed", json_encode($productViewed),time() + config('myconfig.time_cookie'), "/");
        $_COOKIE["productViewed"] = json_encode($productViewed);

        return view($this->pathViewController . 'detail',compact('item','params'));
    }
    public function searchProductAjax(Request $request){
        $data = $request->all();
        $params['keyword']=$request->keyword;$params['limit']=5;
        $keyword=$params['keyword'];
        $items=$this->model->listItems($params,['task' => 'list-items-search']);
        return view("$this->moduleName.pages.prescrip.child_index.ls_product_search",compact('items','keyword'));
        //   $result = array(  
        //      'test'=>$items
        //   );
        //   return response()->json($result, 200);
    }
}
