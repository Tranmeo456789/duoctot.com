<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Shop\CatProductModel;
use App\Model\Shop\AffiliateProductModel;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use App\Model\Shop\AffiliateModel;
use App\Model\Shop\ProductModel as MainModel;
use App\Model\Shop\ProvinceModel;
use App\Model\Shop\TrademarkModel;
use App\Model\Shop\UsersModel;
use App\Model\Shop\WardModel;
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
        $codeRef = $request->codeRef ?? ($request->session()->get('codeRef') ?? '');
        if (empty($request->codeRef) && session('codeRef')) {
            return redirect()->route('fe.product.detail', ['slug' => $slug, 'codeRef' => $codeRef]);
        }
        $item= $this->model->getItem(['slug'=>$slug],['task' => 'frontend-get-item']);
        $userInfo = (new UsersModel)->getItem(['user_id' => $item['user_id']],['task'=>'get-item']);
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
        $session = $request->session();
        if ($session->has('user')) {
            $userInfoCurrent = $request->session()->get('user');
            $userInfoCurrent = (new UsersModel)->getItem(['user_id' => $userInfoCurrent['user_id']], ['task' => 'get-item']);
            $itemAffiliate = (new AffiliateModel)->getItem(['user_id' => $userInfoCurrent['user_id']], ['task' => 'get-item']);
            if ($itemAffiliate && isset($itemAffiliate['code_ref'])) {
                $codeRefLogin = $itemAffiliate['code_ref'];
            } else {
                $codeRefLogin = '';
            }
        } else {
            $codeRefLogin = '';
        }
        
        return view($this->pathViewController . 'detail',compact('params','item','albumImageCurrent','codeRef','userInfo','codeRefLogin'));
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
        $params['keyword']=$request->keyword;
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
        if ($object = $data['object'] ?? null) {
            $listParams['type'] = $data['object'] ?? null;
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
    public function drugstore(Request $request){
        $productDrugstore = $this->model->listItems(['user_id'=>$request->id], ['task' => 'frontend-list-items']);
        $userInfo=(new UsersModel)->getItem(['user_id' => $request->id],['task'=>'get-item']);
        if ($request->has('codeRef')) {
            $request->session()->put('codeRef', $request->query('codeRef'));
            $codeRef = $request->codeRef ?? ($request->session()->get('codeRef') ?? '');
            $affiliate = AffiliateModel::where('code_ref', $codeRef)->first();
            if ($affiliate) {
                $affiliate->increment('sum_click');
             }
        }

        $item = (new AffiliateModel)->getItem(['user_id' => $userInfo['user_id']], ['task' => 'get-item']);
        $productAffiliate=[];
        if ($item) {
            $params['group_id'] = collect($item->listIdProduct)->pluck('product_id')->toArray();
            $productAffiliate = $this->model->listItems(['group_id' => $params['group_id']], ['task' => 'frontend-list-items']);
        } 
        $address='';
        $map='';
        $ward='';
        if(isset($userInfo['details'])){
            $ward_detail=(new WardModel())->getItem(['id'=> $userInfo['details']['ward_id']],['task' => 'get-item-full']);
            if($ward_detail){
                $ward=$ward_detail['name']??'';
                $district=$ward_detail['district']['name']??'';
                $province=$ward_detail['district']['province']['name']??'';
            }else{
                $province_detail=(new ProvinceModel)->getItem(['id'=> $userInfo['details']['province_id']],['task' => 'get-item-full']);
                $province=$province_detail['name']??'';
                $district_detail=(new ProvinceModel)->getItem(['id'=> $userInfo['details']['district_id']],['task' => 'get-item-full']);
                $district=$district_detail['name']??'';
            }
            
            $address=$userInfo['details']['address'].' '.$ward.' '.$district.' '.$province;
            $map=isset($userInfo['details']['map']) ? $userInfo['details']['map'] : '';
        }
        $title = isset($userInfo['fullname']) && $userInfo['fullname'] !== '' ? $userInfo['fullname'] . ', Shop dược phẩm trực tuyến | Tdoctor' : 'Sàn thương mại điện tử trong y dược';
        return view($this->pathViewController . 'drugstore',
            [
                'userInfo' => $userInfo,
                'productDrugstore'=>$productDrugstore,
                'productAffiliate'=>$productAffiliate,
                'address'=>$address,
                'map'=>$map,
                'title'=> $title        
               ]
    );
    }
}
