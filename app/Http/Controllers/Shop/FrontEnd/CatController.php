<?php

namespace App\Http\Controllers\Shop\FrontEnd;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use App\Model\Shop\CatProductModel;
use App\Model\Shop\ProductModel;
use App\Model\Shop\TrademarkModel;
use App\Model\Shop\CountryModel;
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
        $products=(new ProductModel())->listItems(['cat_product_id'=>$itemCatCurent['id'],'take'=>20],['task'=>'frontend-list-items']);
        $couterSumProduct=(new ProductModel())->countItems(['cat_product_id'=>$itemCatCurent['id']],['task'=>'count-number-product-in-cat']);
        $couterSumProduct=$couterSumProduct-20;
        $arrIdTrademark = $products->pluck('trademark_id')->unique()->values()->toArray();
        $listTrademark = (new TrademarkModel)->listItems(['group_id'=>$arrIdTrademark], ['task'=>'admin-list-items-in-selectbox']);
        $arrIdCountry = $products->pluck('country_id')->unique()->values()->toArray();
        $listCountry = (new CountryModel)->listItems(['group_id'=>$arrIdCountry], ['task'=>'admin-list-items-in-selectbox']);
        return view($this->pathViewController . 'cat_level1', compact('itemCatCurent','products','couterSumProduct','listTrademark','listCountry'));
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
        $arrIdTrademark = $products->pluck('trademark_id')->unique()->values()->toArray();
        $listTrademark = (new TrademarkModel)->listItems(['group_id'=>$arrIdTrademark], ['task'=>'admin-list-items-in-selectbox']);
        $arrIdCountry = $products->pluck('country_id')->unique()->values()->toArray();
        $listCountry = (new CountryModel)->listItems(['group_id'=>$arrIdCountry], ['task'=>'admin-list-items-in-selectbox']);
        return view($this->pathViewController . 'cat_level2', compact('itemCatCurent','products','itemCatParent','couterSumProduct','listTrademark','listCountry'));
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
        $arrIdTrademark = $products->pluck('trademark_id')->unique()->values()->toArray();
        $listTrademark = (new TrademarkModel)->listItems(['group_id'=>$arrIdTrademark], ['task'=>'admin-list-items-in-selectbox']);
        $arrIdCountry = $products->pluck('country_id')->unique()->values()->toArray();
        $listCountry = (new CountryModel)->listItems(['group_id'=>$arrIdCountry], ['task'=>'admin-list-items-in-selectbox']);
        return view($this->pathViewController . 'cat_level3', compact('itemCatCurent','itemCatParentLevel1','itemCatParentLevel2', 'products','couterSumProduct','listTrademark','listCountry'));
    }
    public function filterProduct(Request $request){
        $data = $request->all();
        if(isset($data['orderby_product'])){
            $listParams['order_by']=$data['orderby_product'] ?? null;
            if ($type = $data['type'] ?? null) {
                $listParams['cat_product_id'] = $data['idCat'] ?? null;
            }
            if ($data['listTrademarkId'] ?? null) {
                $listParams['group_trademark']=$data['listTrademarkId'];
            }
            if ($data['listCountryId'] ?? null) {
                $listParams['group_country']=$data['listCountryId'];
            }
            $listProductOrderBy=(new ProductModel())->listItems($listParams, ['task' => 'frontend-list-items'])->take(20);
            $couterSumProduct=(new ProductModel())->countItems($listParams,['task'=>'count-number-product-in-cat']);
            $couterSumProduct=$couterSumProduct-20;
            return view("$this->moduleName.pages.cat.templates.list_product",
                    [
                        'items'=>$listProductOrderBy,
                        'countProduct'=>$couterSumProduct,
                        'idCat'=>$data['idCat'],
                        'typeOrderBy'=>$data['orderby_product']
                    ]);
        }
    }
}
