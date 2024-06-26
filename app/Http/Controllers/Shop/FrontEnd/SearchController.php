<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use App\Model\Shop\AffiliateModel;
use App\Model\Shop\ProductModel;
use App\Model\Shop\OrderModel;
use App\Model\Shop\OrderProductModel;
use App\Model\Shop\SearchModel as MainModel;
use Illuminate\Support\Str;

class SearchController extends ShopFrontEndController
{
    public function __construct()
    {
        $this->controllerName     = 'search';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Tìm kiếm';
        $this->model = new MainModel();
        parent::__construct();
    }
    public function viewHome(Request $request,$keyword)
    {
        $params['keyword']=$keyword;
        $itemSearch=(new ProductModel)->listItems($params,['task'=>'list-items-search']);
        $title= 'Kết quả tìm kiếm';
        return view($this->pathViewController . 'view',['keyword'=>$keyword,'itemSearch'=>$itemSearch,'title'=>$title]);
    }
    public function saveHome(Request $request)
    {
        // save history keyword search
        if(!empty($request->input('btn_search')) && !empty($request->input('keyword')) && trim($request->input('keyword')) !== ''){
            $params = $request->all();
            $itemExist = $this->model->getItem($params, ['task'=>'get-item']);
            $keywordHistory  = (isset($_COOKIE["keywordHistory"]))?json_decode($_COOKIE["keywordHistory"],true):[];
            $keywordCurrent = [];
        if (isset($keywordCurrent[$params['keyword']])){
            $keywordCurrent[$params['keyword']] = $keywordHistory[$params['keyword']];
            unset($keywordHistory[$params['keyword']]);
        }else{
            $keywordCurrent[$params['keyword']] = [
                'keyword' => $params['keyword'],
            ];
        }
        $keywordHistory = $keywordCurrent + $keywordHistory;
        if (count($keywordHistory) > 5){
            array_pop($keywordHistory);
        }
        setcookie("keywordHistory", json_encode($keywordHistory),time() + config('myconfig.time_cookie'), "/");
        $_COOKIE["keywordHistory"] = json_encode($keywordHistory);
        //save keyword search most
        if(isset($itemExist)){
            $params['id']=$itemExist['id'];
            $params['number_search'] = $itemExist['number_search'];
            $this->model->saveItem($params, ['task'=>'update-number-search-item']);
        }else{
            $this->model->saveItem($params, ['task'=>'add-item-home']);
        } 
            return redirect()->route('fe.search.viewHome',['keyword' => $params['keyword']]);
        }else{
            return redirect()->back();
        }
        
    }
    public function deleteHistory(Request $request){
        $data = $request->all();
        setcookie( "keywordHistory", "", time()- 60, "/","", 0);
        return view("$this->moduleName.block.menu.child_menu_yes_search.list_history_keyword");
    }
    public function updateFieldSearchKeyword(Request $request) {
        if($request->product){
            try {
                DB::beginTransaction();
                $products = ProductModel::with('trademarkProduct')->select('id', 'name', 'benefit', 'trademark_id','user_id','cat_product_id')->where('status_product', 'da_duyet')->get();
                foreach ($products as $product) {
                    $trademarkName = $product->trademarkProduct ? $product->trademarkProduct->name : '';
                    $userSell = $product->userProduct ? $product->userProduct->fullname : '';
                    $catProduct = $product->catProduct ? $product->catProduct->name : '';
                    $keywordSearch = implode(' ', [
                        $trademarkName,
                        Str::ascii($trademarkName),
                        $userSell,
                        Str::ascii($userSell),
                        $catProduct,
                        Str::ascii($catProduct),
                        Str::ascii($product->name),
                        Str::ascii($product->benefit),
                    ]);
        
                    ProductModel::where('id', $product['id'])->update(['keyword_search' => $keywordSearch]);
                }
                DB::commit();
                return response()->json(['success' => true, 'message' => 'Cập nhật keyword product thành công']);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['success' => false, 'message' => $e->getMessage()]);
            }
        }else{
            try {
                DB::beginTransaction();
                $affiliates = AffiliateModel::with('userRef')->select('id', 'code_ref', 'user_id', 'info_user')->get();
                foreach ($affiliates as $affiliate) {
                    $fullname = $affiliate->userRef ? $affiliate->userRef->fullname : '';
                    $phone = $affiliate->userRef ? $affiliate->userRef->phone : '';
                    $email = $affiliate->userRef ? $affiliate->userRef->email : '';
                    $infoUser = implode(' ', [
                        $fullname,
                        $phone,
                        $email
                    ]);
                    AffiliateModel::where('id', $affiliate['id'])->update(['info_user' => $infoUser]);
                }
                DB::commit();
                return response()->json(['success' => true, 'message' => 'Cập nhật info user affiliate thành công']);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['success' => false, 'message' => $e->getMessage()]);
            }
        }

        // add infomation for table order_product
        // $listOrders = OrderModel::all();
        // try {
        //     foreach ($listOrders as $order) {
        //         foreach ($order['info_product'] as $product) {
        //             $paramsOrderProduct['order_id'] = $order['id']??'';
        //             $paramsOrderProduct['product_id'] = $product['product_id']??'';
        //             $paramsOrderProduct['code_order'] = $order['code_order']??'';
        //             $paramsOrderProduct['status_order'] = $order['status_order']??'dangXuLy';
        //             $paramsOrderProduct['quantity'] = $product['quantity']??0;
        //             $paramsOrderProduct['price'] = $product['price']?? 0;
        //             $paramsOrderProduct['unit'] = $product['unit_id']??'';
        //             $paramsOrderProduct['code_ref'] = $product['codeRef']??'';
        //             (new OrderProductModel)->saveItem($paramsOrderProduct, ['task' => 'add-item']);
        //         }
        //     }
        //     return "Thêm dữ liệu vào order_product ok!";
        // } catch (\Exception $e) {
        //     return "Đã xảy ra lỗi khi thêm dữ liệu vào cơ sở dữ liệu: " . $e->getMessage();
        // }
    }
}
