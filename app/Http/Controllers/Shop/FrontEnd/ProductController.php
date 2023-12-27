<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Shop\CatProductModel;
use App\Model\Shop\AffiliateProductModel;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;

use App\Model\Shop\ProductModel as MainModel;
use App\Model\Shop\TrademarkModel ;
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
    }
    public function detail(Request $request){
        $slug = $request->slug;
        $codeRef=$request->codeRef ?? '';
        $item= $this->model->getItem(['slug'=>$slug],['task' => 'frontend-get-item']);
        $affiliateProduct = AffiliateProductModel::where('code_ref', $codeRef)
            ->where('product_id', $item['id'])
            ->first();
        if ($affiliateProduct) {
            $affiliateProduct->increment('sum_click');
        }
        $albumImageCurrent=!empty($item['albumImageHash']) ? explode('|', $item['albumImageHash']) : [];
        $productViewed  = (isset($_COOKIE["productViewed"]))?json_decode($_COOKIE["productViewed"],true):[];
        $productCurrent = [];
        if (isset($productViewed[$item['id']])){
            $productCurrent[$item['id']] = $productViewed[$item['id']];
            unset($productViewed[$item['id']]);
        }else{
            $productCurrent[$item['id']] = [
                'product_id' => $item->id,
                'name'       => $item->name,
                'price'      => $item->price,
                'image'      => $item->image,
                'unit'       => $item->unitProduct->name,
                'slug'=>$item->slug
            ];

        }

        $productViewed = $productCurrent + $productViewed;
        $params['id']=$item['id'];
        if (count($productViewed) > 8){
            array_pop($productViewed);
        }
        setcookie("productViewed", json_encode($productViewed),time() + config('myconfig.time_cookie'), "/");
        $_COOKIE["productViewed"] = json_encode($productViewed);

        return view($this->pathViewController . 'detail',compact('params','item','albumImageCurrent','codeRef'));
    }
    public function searchProductAjax(Request $request){
        $data = $request->all();
        $params['keyword']=$request->keyword;$params['limit']=5;
        $keyword=$params['keyword'];
        $params['user_sell']=$request->user_sell;
        $items=$this->model->listItems($params,['task' => 'list-items-search']);
        return view("$this->moduleName.pages.prescrip.child_index.ls_product_search",compact('items','keyword'));
    }
    public function searchListProductShort(Request $request){
        $data = $request->all();
        $params['keyword']=$request->keyword;$params['limit']=6;
        $keyword=$params['keyword'];
        $items=$this->model->listItems($params,['task' => 'list-items-search']);
        return view("$this->moduleName.templates.list_product_short",compact('items','keyword'));
    }
    public function loadMoreProducts(Request $request){
        $data = $request->all();
        $offset = $request->offset;
        $listParams = ['offset' => $offset, 'take' => 20];
        if ($type = $data['type'] ?? null) {
            $listParams['cat_product_id'] = $data['idCat'] ?? null;
        }
        $listProductAddView = $this->model->listItems($listParams, ['task' => 'frontend-list-items']);
        $viewName = $this->moduleName;
        if ($type == 'product_cat_horizontal') {
            $viewName .= '.pages.cat.partial.product_horizontal';
        } elseif ($type == 'product_cat') {
            $viewName .= '.pages.cat.partial.product';
        } else {
            $viewName .= '.partial.product';
        }
        return view($viewName, ['items' => $listProductAddView]);
        }
}
