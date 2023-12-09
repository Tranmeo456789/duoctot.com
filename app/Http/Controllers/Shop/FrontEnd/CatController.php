<?php

namespace App\Http\Controllers\Shop\FrontEnd;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use App\Model\Shop\CatProductModel;
use App\Model\Shop\ProductModel;
class CatController extends ShopFrontEndController
{
    public function __construct()
    {
        $this->controllerName     = 'cat';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'danh mục';
        parent::__construct();
    }
    public function catLevel1($slug)
    {
        $itemCatCurent = (new CatProductModel())->getItem(['slug'=>$slug],['task'=>'get-item-slug']);
        //return $itemCatCurent['id'];
        $products=(new ProductModel())->listItems(['cat_product_id'=>$itemCatCurent['id'],'take'=>20],['task'=>'frontend-list-items']);
        $couterSumProduct=(new ProductModel())->countItems(['cat_product_id'=>$itemCatCurent['id']],['task'=>'count-number-product-in-cat']);
        $couterSumProduct=$couterSumProduct-20;
        return view($this->pathViewController . 'cat_level1', compact('itemCatCurent','products','couterSumProduct'));
    }
    public function catLevel2($slug, $slug1)
    {
        $itemCatCurent = (new CatProductModel())->getItem(['slug'=>$slug1],['task'=>'get-item-slug']);
        $products=(new ProductModel())->listItems(['cat_product_id'=>$itemCatCurent['id'],'take'=>20],['task'=>'frontend-list-items']);
        $itemCatParent=(new CatProductModel)->getItem(['parent_id'=>$itemCatCurent['parent_id']],['task'=>'get-item-parent']);
        $couterSumProduct=(new ProductModel())->countItems(['cat_product_id'=>$itemCatCurent['id']],['task'=>'count-number-product-in-cat']);
        $couterSumProduct=$couterSumProduct-20;
        if($slug=='thuoc' && $slug1=='tra-cuu-thuoc'){
            $productAlls = (new ProductModel())->listItems(['limit'=>20], ['task' => 'frontend-list-items-simple']);
            $viewNoSearchHeader=true;
            return view($this->pathViewController . 'view_search_product', compact('productAlls','itemCatParent','itemCatCurent','viewNoSearchHeader'));
        }
        return view($this->pathViewController . 'cat_level2', compact('itemCatCurent','products','itemCatParent','couterSumProduct'));
    }
    public function catLevel3($slug, $slug1, $slug2)
    {
        $itemCatCurent = (new CatProductModel())->getItem(['slug'=>$slug2],['task'=>'get-item-slug']);
        $params['parent_id']=$itemCatCurent['parent_id'];
        $itemCatParentLevel1=(new CatProductModel)->getItem($params,['task'=>'get-item-parent']);
        $params['up_level']=2;
        $itemCatParentLevel2=(new CatProductModel)->getItem($params,['task'=>'get-item-parent']);
        $products=(new ProductModel())->listItems(['cat_product_id'=>$itemCatCurent['id'],'take'=>20],['task'=>'frontend-list-items']);
        $couterSumProduct=(new ProductModel())->countItems(['cat_product_id'=>$itemCatCurent['id']],['task'=>'count-number-product-in-cat']);
        $couterSumProduct=$couterSumProduct-20;
        return view($this->pathViewController . 'cat_level3', compact('itemCatCurent','itemCatParentLevel1','itemCatParentLevel2', 'products','couterSumProduct'));
    }
}
