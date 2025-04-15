<?php

namespace App\Http\Controllers\Shop\BackEnd;

use App\Model\Shop\UsersModel as MainModel;
use App\Http\Requests\UserRequest as MainRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Shop\BackEnd\BackEndController;
use App\Model\Shop\ProvinceModel;
use App\Model\Shop\DistrictModel;
use App\Model\Shop\WardModel;
use App\Model\Shop\AffiliateModel;
use App\Helpers\MyFunction;
use App\Model\Shop\AffiliateProductModel;
use App\Model\Shop\CatProductModel;
use App\Model\Shop\ProductModel;
use App\Model\Shop\ShopProductAddModel;
use App\Model\Shop\UsersModel;
use DB;
use Hash;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
class UserController extends BackEndController
{
    public function __construct()
    {
        $this->controllerName     = 'user';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Danh sách Người dùng';
        $this->model = new MainModel();
        parent::__construct();
    }
    public function index(Request $request)
    {
        $session = $request->session();
        if ($session->has('currentController') &&  ($session->get('currentController') == $this->controllerName)) {
            $session->forget('params');
        } else {
            $session->put('currentController', $this->controllerName);
        }
        $session->put('params.filter.status', $request->has('filter_status') ? $request->get('filter_status') : ($session->has('params.filter.status') ? $session->get('params.filter.status') : 'all'));
        $session->put('params.search.field', $request->has('search_field') ? $request->get('search_field') : ($session->has('params.search.field') ? $session->get('params.search.field') : ''));
        $session->put('params.search.value', $request->has('search_value') ? $request->get('search_value') : ($session->has('params.search.value') ? $session->get('params.search.value') : ''));
        $session->put('params.pagination.totalItemsPerPage', $this->totalItemsPerPage);
        $this->params =  $session->get('params');
        $items              = $this->model->listItems($this->params, ['task'  => 'admin-list-items-of-shop']);
        if ($items->currentPage() > $items->lastPage()) {
            $lastPage = $items->lastPage();
            Paginator::currentPageResolver(function () use ($lastPage) {
                return $lastPage;
            });
            $items  = $this->model->listItems($this->params, ['task'  => 'admin-list-items-of-shop']);
        }
        return view($this->pathViewController .  'index', [
            'params'           => $this->params,
            'items'            => $items,
        ]);
    }
    public function form(Request $request)
    {
        $item = null;
        $details=[];
        if ($request->id !== null) {
            $params["user_id"] = $request->id;
            $item = $this->model->getItem(['user_id'=>$request->id],['task' => 'get-item']);
            if ($item && $item->detailValues) {
                $details = $item->detailValues->pluck('value', 'user_field')->toArray() ?? [];
            } else {
                $details = [];
            }
        }
        $itemsProvince = (new ProvinceModel())->listItems(null,['task'=>'admin-list-items-in-selectbox']);
        $params['province_id'] = (isset($details['province_id']) && ($details['province_id']!=0))?$details['province_id']:((isset($item['province_id']) && ($item['province_id'] != 0)) ? $item['province_id']:0);
        $itemsDistrict = [];
        if ($params['province_id']  != 0){
            $itemsDistrict = (new DistrictModel())->listItems(['parentID' => $params['province_id']],
                                                                ['task'=>'admin-list-items-in-selectbox']);
        }

        $params['district_id'] = (isset($details['district_id']) && ($details['district_id'] != 0))?$details['district_id']:((isset($item['district_id']) && ($item['district_id'] != 0)) ? $item['district_id']:0);
        $itemsWard = [];
        if ($params['district_id']  != 0){
            $itemsWard = (new WardModel())->listItems(['parentID' => $params['district_id']],
                                                                ['task'=>'admin-list-items-in-selectbox']);
        }
        $codeRef = $item['codeRef'];
        return view($this->pathViewController .  'form',
                    compact('item','details', 'itemsProvince' ,'itemsDistrict','itemsWard','codeRef')
                );
    }
    public function save(MainRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'fail' => true,
                'errors' => $request->validator->errors()
            ]);
        }
        if ($request->method() == 'POST') {
            $params = $request->all();
            if(isset($params['password']) && ($params['password'] !== '' && $params['password'] !== null)){
                $params['password'] = Hash::make($params['password']);
            } else {
                unset($params['password']);
            }
            $task   = $params['task'];
            $notify = "Cập nhật $this->pageTitle thành công!";
            $redirect_url = route($this->controllerName);
            if(!empty($params['ref_register'])){
                $userShareCodeRef = UsersModel::where('codeRef', $params['ref_register'])->first();
                if($userShareCodeRef){
                    $userLogin = \Session::get('user');
                    $userLogin = UsersModel::where('user_id', $userLogin['user_id'])->first();
                    if($userLogin['num_import_code_ref'] < 2){
                        $pointAdd=10;
                        $params['reward_points'] = $userLogin['reward_points']+$pointAdd;
                        $params['num_import_code_ref'] =  $userLogin['num_import_code_ref']+1;
                        (new UsersModel)->saveItem(['user_id'=>$userShareCodeRef->user_id,'reward_points'=>$userShareCodeRef->reward_points + $pointAdd], ['task' => 'update-item-api']);
                    }
                }
            }
            if ($this->model->saveItem($params, ['task' => 'update-item'])){
                $request->session()->put('app_notify', $notify);
                return response()->json([
                    'status' => 200,
                    'success' => true,
                    'data' =>  null,
                    'errors' => null,
                    'message' => $notify,
                    'redirect_url' => $redirect_url
                ], 200);
            }else{
                return response()->json([
                    'status' => 200,
                    'success' => false,
                    'data' =>  null,
                    'errors' => null,
                    'message' => 'lỗi xảy ra trong quá trình cập nhật thông tin',
                    'redirect_url' => ''
                ], 200);
            }

        }
    }
    public function filterInDay(Request $request){
        $data = $request->all();
        $day_start=$request->day_start;
        $day_end=$request->day_end;
        $session = $request->session();
        if ($session->has('currentController') &&  ($session->get('currentController') != $this->controllerName)) {
            $session->forget('params');
        } else {
            $session->put('currentController', $this->controllerName);
        }
        $session->put('params.pagination.totalItemsPerPage', $this->totalItemsPerPage);
        $params     = $session->get('params');
        $params['user_type_id']=3;
        $params['filter_in_day']['day_start']=MyFunction::formatDateLikeMySQL($day_start);
        $params['filter_in_day']['day_end']=MyFunction::formatDateLikeMySQL($day_end);
        $items=$this->model->listItems($params, ['task'  => 'admin-list-items-of-shop']);
        //  $result = array(  
        //      'test'=>$items
        //   );
        //   return response()->json($result, 200);
        $controller_name=$request->controller_name;
          return view($this->moduleName.'.pages.'.$controller_name.'.list_admin', [
            'params'           => $params,
            'items'            => $items,
        ]);
    }
    public function userImportCodeAffiliate(Request $request){
        $session = $request->session();
        $userInfo = $request->session()->get('user');
        $session->forget('params');
        $session->put('params.filter.status', $request->has('filter_status') ? $request->get('filter_status') : ($session->has('params.filter.status') ? $session->get('params.filter.status') : 'all'));
        $session->put('params.search.field', $request->has('search_field') ? $request->get('search_field') : ($session->has('params.search.field') ? $session->get('params.search.field') : ''));
        $session->put('params.search.value', $request->has('search_value') ? $request->get('search_value') : ($session->has('params.search.value') ? $session->get('params.search.value') : ''));
        $session->put('params.pagination.totalItemsPerPage', $this->totalItemsPerPage);
        $this->params =  $session->get('params');
        $this->params['ref_register']=$userInfo['codeRef'];
        $items              = $this->model->listItems($this->params, ['task'  => 'list-items-import-code-ref']);
        if ($items->currentPage() > $items->lastPage()) {
            $lastPage = $items->lastPage();
            Paginator::currentPageResolver(function () use ($lastPage) {
                return $lastPage;
            });
            $items  = $this->model->listItems($this->params, ['task'  => 'list-items-import-code-ref']);
        }
        return view($this->pathViewController .  'users_import_codeRef', [
            'params'           => $this->params,
            'items'            => $items,
        ]);
    }
    public function refAffiliate(Request $request)
    {
        $userInfo = $request->session()->get('user');
        $userInfo=$this->model->getItem(['user_id' => $userInfo['user_id']],['task'=>'get-item']);
        $codeRef = $userInfo['codeRef'];
        $session = $request->session();
        $session->forget('params');
        if ($request->has('deleteValueSearch') && $request->get('deleteValueSearch') == 1) {
            $session->forget('params.search.value');
        }
        $session->put('params.search.field', $request->has('search_field') ? $request->get('search_field') : ($session->has('params.search.field') ? $session->get('params.search.field') : ''));
        $session->put('params.search.value', $request->has('search_value') ? $request->get('search_value') : ($session->has('params.search.value') ? $session->get('params.search.value') : ''));
        $session->put('params.pagination.totalItemsPerPage', $this->totalItemsPerPage);
        $infoProductClick = collect($userInfo->listIdProductGetNumberClick)->pluck('sum_click', 'product_id')->toArray();
        $sumLinkCount = AffiliateProductModel::where('user_id', $userInfo['user_id'])->sum('sum_click');
        $this->params     = $session->get('params');
        $this->params['user_id'] = $userInfo['user_id'];
        $infoProduct=(new ProductModel)->listItems($this->params,['task'=>'user-list-items-simple-affiliate-order-by-click']);
        if ($infoProduct->currentPage() > $infoProduct->lastPage()) {
            $lastPage = $infoProduct->lastPage();
            Paginator::currentPageResolver(function () use ($lastPage) {
                return $lastPage;
            });
            $infoProduct             = (new ProductModel)->listItems($this->params, ['task'  => 'user-list-items-simple-affiliate-order-by-click']);
        }
        return view($this->pathViewController .  'affiliate_product',
        [
            'params'           => $this->params,
            'infoProductClick' => $infoProductClick,
            'infoProduct' => $infoProduct,
            //'sumMoney'=> $sumMoney,
            //'sumQuantity' => $sumQuantity,
            'sumLinkCount' => $sumLinkCount,
            'userInfo'=> $userInfo
        ]);
    }
    public function detailListProductAffiliate(Request $request)
    {
        $codeRef=$request->codeRef;
        $userInfo=$this->model->getItem(['codeRef' => $codeRef],['task'=>'get-item-code-ref']);
        $session = $request->session();
        $session->forget('params');
        if ($request->has('deleteValueSearch') && $request->get('deleteValueSearch') == 1) {
            $session->forget('params.search.value');
        }
        $session->put('params.search.field', $request->has('search_field') ? $request->get('search_field') : ($session->has('params.search.field') ? $session->get('params.search.field') : ''));
        $session->put('params.search.value', $request->has('search_value') ? $request->get('search_value') : ($session->has('params.search.value') ? $session->get('params.search.value') : ''));
        $session->put('params.pagination.totalItemsPerPage', $this->totalItemsPerPage);
        $this->params     = $session->get('params');
        $this->params['user_id'] = $userInfo['user_id'];
        $infoProduct=(new ProductModel)->listItems($this->params,['task'=>'user-list-items-simple-affiliate-order-by-click']);
        $infoProductClick = collect($userInfo->listIdProductGetNumberClick)->pluck('sum_click', 'product_id')->toArray();
        $sumLinkCount = AffiliateProductModel::where('user_id', $userInfo['user_id'])->sum('sum_click');
        if ($infoProduct->currentPage() > $infoProduct->lastPage()) {
            $lastPage = $infoProduct->lastPage();
            Paginator::currentPageResolver(function () use ($lastPage) {
                return $lastPage;
            });
            $infoProduct = (new ProductModel)->listItems($this->params, ['task'  => 'user-list-items-simple-affiliate-order-by-click']);
        }
        return view($this->pathViewController .  'affiliate_product',
        [
            'params'           => $this->params,
            'infoProductClick' => $infoProductClick,
            'infoProduct' => $infoProduct,
            //'sumMoney'=> $sumMoney,
            //'sumQuantity' => $sumQuantity,
            'sumLinkCount' => $sumLinkCount,
            'userInfo'=> $userInfo
        ]);
    }
    public function formAddProductShop(Request $request)
    {
        $infoProduct=[];
        $userInfo=[];
        if ($request->userId !== null) {
            $userInfo=$this->model->getItem(['user_id'=>$request->userId],['task'=>'get-item']);
            if($userInfo['is_add_product'] == 1){
                $infoProduct= collect($userInfo->listIdProduct)->pluck('product_id')->toArray();
            }
            $itemsCatLevel2 = (new CatProductModel())->listItems(null, ['task' => 'frontend-list-items-level-2']);
            return view(
                $this->pathViewController .  'form_add_product_shop',
                compact('infoProduct','userInfo','itemsCatLevel2')
            );
        }  
    }
    public function saveAddProductShop(MainRequest $request)
    {
        if (!$request->ajax()) return view("errors." .  'notfound', []);
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'fail' => true,
                'errors' => $request->validator->errors()
            ]);
        }
        if ($request->method() == 'POST') {
            $params = $request->all();
            $task   = "add-item";
            $notify = "Thêm mới sản phẩm cho Shop thành công!";
            $userInfo=$this->model->getItem(['user_id'=>$params['user_id']],['task'=>'get-item']);
            if (empty($params['info_product'])) {
                $notify = "Cập nhật sản phẩm cho Shop thành công!";
                ShopProductAddModel::where('user_id', $params['user_id'])->delete();
            } else {
                $notify = "Cập nhật sản phẩm cho Shop thành công!";
                // Xóa sản phẩm cũ nếu đã thêm trước đó
                if ($userInfo['is_add_product'] == 1) {
                    ShopProductAddModel::where('user_id', $params['user_id'])->delete();
                }
                // Thêm sản phẩm mới
                foreach ($params['info_product'] as $value) {
                    $paramsProduct['product_id'] = $value;
                    $paramsProduct['user_id'] = $params['user_id'];
                    (new ShopProductAddModel)->saveItem($paramsProduct, ['task' => 'add-item']);
                }
                // Nếu chưa từng thêm, cập nhật trạng thái
                if ($userInfo['is_add_product'] != 1) {
                    $this->model->saveItem(['user_id' => $params['user_id'], 'is_add_product' => 1], ['task' => 'update-item-simple']);
                }
            }
            $request->session()->put('app_notify', $notify);
            return response()->json([
                'status' => 200,
                'success' => true,
                'data' =>  null,
                'errors' => null,
                'message' => $notify,
                'redirect_url' => route($this->controllerName)
            ], 200);
        }
    }
}
