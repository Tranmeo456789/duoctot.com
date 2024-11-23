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
use App\Model\Shop\ProductModel;
use App\Model\Shop\ShopProductAddModel;
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
        $userInfo = $request->session()->get('user');
        $userAff = (new AffiliateModel)->getItem(['user_id' => $userInfo['user_id']], ['task' => 'get-item']);
        if(isset($userAff) && !empty($userAff)){
            $codeRef = $userAff['code_ref'];
        }
        $codeRef = isset($userAff['code_ref']) ? $userAff['code_ref'] : null;
        return view($this->pathViewController .  'form',
                    compact('item','details', 'itemsProvince' ,'itemsDistrict','itemsWard','codeRef')
                );
    }
    public function save(MainRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'status' => 200,
                'data' => null,
                'success' => false,
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
        //$item = $this->model->getItem(['user_id' => $userInfo['user_id']], ['task' => 'get-item']);
        $codeRef = $userInfo['codeRef'];
        $session = $request->session();
        if ($session->has('currentController') &&  ($session->get('currentController') != $this->controllerName)) {
            $session->forget('params');
        } else {
            $session->put('currentController', $this->controllerName);
        }
       // $sumMoney=$item->sumMoneyRefAffiliate($codeRef);
       // $sumQuantity=$item->sumQuantityRefAffiliate($codeRef);
        //$sumLinkCount = AffiliateProductModel::where('code_ref', $codeRef)->sum('sum_click')+$item['sum_click'];
        //$params['group_id'] = collect($item->listIdProduct)->pluck('product_id')->toArray();
        if ($request->has('deleteValueSearch') && $request->get('deleteValueSearch') == 1) {
            $session->forget('params.search.value');
        }
        $session->put('params.search.field', $request->has('search_field') ? $request->get('search_field') : ($session->has('params.search.field') ? $session->get('params.search.field') : ''));
        $session->put('params.search.value', $request->has('search_value') ? $request->get('search_value') : ($session->has('params.search.value') ? $session->get('params.search.value') : ''));
        //$session->put('params.group_id', $params['group_id']);
        $session->put('params.pagination.totalItemsPerPage', $this->totalItemsPerPage);
        
        $this->params     = $session->get('params');
        $infoProduct=(new ProductModel)->listItems($this->params,['task'=>'user-list-items-simple-affiliate']);
        if ($infoProduct->currentPage() > $infoProduct->lastPage()) {
            $lastPage = $infoProduct->lastPage();
            Paginator::currentPageResolver(function () use ($lastPage) {
                return $lastPage;
            });
            $infoProduct             = (new ProductModel)->listItems($this->params, ['task'  => 'user-list-items-simple-affiliate']);
        }
        return view($this->pathViewController .  'affiliate_product',
        [
            'params'           => $this->params,
            //'item' => $item,
            'infoProduct' => $infoProduct,
            //'sumMoney'=> $sumMoney,
            //'sumQuantity' => $sumQuantity,
            //'sumLinkCount' => $sumLinkCount,
            'userInfo'=> $userInfo
        ]);
    }
    public function formAddProductShop(Request $request)
    {
        $item = null;
        $infoProduct=[];
        $userInfo=[];
        if ($request->userId !== null) {
            $userInfo=$this->model->getItem(['user_id'=>$request->userId],['task'=>'get-item']);
            if($userInfo['is_add_product'] == 1){
                $infoProduct= collect($userInfo->listIdProduct)->pluck('product_id')->toArray();
            }
            $itemsProduct = (new ProductModel())->listItems(['status_product'=>'da_duyet'], ['task' => 'admin-list-items-in-selectbox']);
            return view(
                $this->pathViewController .  'form_add_product_shop',
                compact('item', 'itemsProduct','infoProduct','userInfo')
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
            if($userInfo['is_add_product'] == 1){
                $notify = "Cập nhật sản phẩm cho Shop thành công!";
                ShopProductAddModel::where('user_id', $params['user_id'])->delete();
                foreach ($params['info_product'] as $value) {
                    $paramsProduct['product_id']=$value;
                    $paramsProduct['user_id']=$params['user_id'];
                    (new ShopProductAddModel)->saveItem($paramsProduct, ['task' => 'add-item']);
                }
            }else{
                foreach ($params['info_product'] as $value) {
                    $paramsProduct['product_id']=$value;
                    $paramsProduct['user_id']=$params['user_id'];
                    (new ShopProductAddModel)->saveItem($paramsProduct, ['task' => 'add-item']);
                }
                $this->model->saveItem(['user_id'=>$params['user_id'],'is_add_product'=> 1], ['task' => 'update-item-simple']);
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
