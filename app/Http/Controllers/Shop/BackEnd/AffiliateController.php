<?php

namespace App\Http\Controllers\Shop\BackEnd;

use App\Model\Shop\AffiliateModel as MainModel;
use App\Model\Shop\ProductModel;
use App\Model\Shop\UsersModel;
use App\Model\Shop\AffiliateProductModel;
use App\Model\Shop\CouponPaymentModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Shop\BackEnd\BackEndController;
use App\Http\Requests\AffiliateRequest as MainRequest;
use App\Model\Shop\AffiliateModel;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Support\Str;

class AffiliateController extends BackEndController
{
    public function __construct()
    {
        $this->controllerName     = 'affiliate';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Affiliate';
        $this->model = new MainModel();
        parent::__construct();
    }
    public function index(Request $request)
    {
        $session = $request->session();
        if ($session->has('currentController') &&  ($session->get('currentController') != $this->controllerName)) {
            $session->forget('params');
        } else {
            $session->put('currentController', $this->controllerName);
        }
        if ($request->has('deleteValueSearch') && $request->get('deleteValueSearch') == 1) {
            $session->forget('params.search.value');
        }
        $session->put('params.filter.status', $request->has('filter_status') ? $request->get('filter_status') : ($session->has('params.filter.status') ? $session->get('params.filter.status') : 'all'));
        $session->put('params.search.field', $request->has('search_field') ? $request->get('search_field') : ($session->has('params.search.field') ? $session->get('params.search.field') : ''));
        $session->put('params.search.value', $request->has('search_value') ? $request->get('search_value') : ($session->has('params.search.value') ? $session->get('params.search.value') : ''));
        $session->put('params.pagination.totalItemsPerPage', $this->totalItemsPerPage);
        $this->params     = $session->get('params');
        $items            = $this->model->listItems($this->params, ['task'  => 'user-list-items']);
        if ($items->currentPage() > $items->lastPage()) {
            $lastPage = $items->lastPage();
            Paginator::currentPageResolver(function () use ($lastPage) {
                return $lastPage;
            });
            $items              = $this->model->listItems($this->params, ['task'  => 'user-list-items']);
        }
        return view($this->pathViewController .  'index', [
            'params'           => $this->params,
            'items'            => $items
        ]);
    }
    public function form(Request $request)
    {
        $item = null;
        $infoProduct=[];
        if ($request->id !== null) {
            $params["id"] = $request->id;
            $item = $this->model->getItem($params, ['task' => 'get-item']);
            $infoProduct= collect($item->listIdProduct)->pluck('product_id')->toArray();
        }
        $itemsProduct = (new ProductModel())->listItems(['status_product'=>'da_duyet'], ['task' => 'admin-list-items-in-selectbox']);
        
        // /$typeUserId=[4,10];
        $itemsUser=(new UsersModel())->listItems(null,['task'=>'admin-list-by-type-id-in-selectbox-affiliate']);
        return view(
            $this->pathViewController .  'form',
            compact('item', 'itemsProduct','itemsUser','infoProduct')
        );
    }
    public function save(MainRequest $request)
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
            $notify = "Thêm mới $this->pageTitle thành công!";
            $paramsAffiliateProduct=[];
            if ($params['id'] != null) {
                $task   = "edit-item";
                $notify = "Cập nhật $this->pageTitle thành công!";
                $item = $this->model->getItem(['id' => $params['id']], ['task' => 'get-item']);
                $codeRef=$item['code_ref'];
                $this->model->saveItem($params, ['task' => $task]);

                $productIdsToCheck=$params['info_product'];
                $existingProductIds = AffiliateProductModel::where('code_ref',$codeRef)->pluck('product_id')->toArray();
                $newProductIds = array_diff($productIdsToCheck, $existingProductIds);
                $oldProductIds= array_diff($existingProductIds, $productIdsToCheck);
                $commonProductIds = array_intersect($productIdsToCheck, $existingProductIds);
                if (!empty($newProductIds)) {
                    foreach ($newProductIds as $productId) {
                        (new AffiliateProductModel)->saveItem(['code_ref'=>$codeRef,'product_id'=>$productId,'user_id'=>$item['user_id']], ['task' => 'add-item']);
                    }
                }
                if (!empty($oldProductIds)) {
                    AffiliateProductModel::whereIn('product_id', $oldProductIds)->where('code_ref', $codeRef)->update(['active' => 0,'user_id' => $item['user_id']]);
                }
                if (!empty($commonProductIds)) {
                    AffiliateProductModel::whereIn('product_id', $commonProductIds)->where('code_ref', $codeRef)->update(['active' => 1,'user_id' => $item['user_id']]);
                }
                (new UsersModel())->saveItem(['user_id'=>$item['user_id'],'is_affiliate'=> 1], ['task' => 'update-item-simple']);
            } else {
                $existingAffiliate = $this->model->getItem(['user_id' => $params['user_id']], ['task' => 'get-item']);
                if ($existingAffiliate) {
                    return response()->json([
                        'status' => 200,
                        'success' => true,
                        'data' =>  null,
                        'errors' => null,
                        'message' => 'affilate đã tồn tại',
                        'redirect_url' => route($this->controllerName)
                    ], 200);
                } else {
                    (new UsersModel())->saveItem(['user_id'=>$params['user_id'],'is_affiliate'=> 1], ['task' => 'update-item-simple']);
                    $codeRef=$this->model->saveItem($params, ['task' => $task]); 
                    foreach ($params['info_product'] as $value) {
                        $paramsAffiliateProduct['code_ref']=$codeRef;
                        $paramsAffiliateProduct['product_id']=$value;
                        $paramsAffiliateProduct['user_id']=$params['user_id'];
                        (new AffiliateProductModel)->saveItem($paramsAffiliateProduct, ['task' => 'add-item']);
                    }
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
    public function detail(Request $request, $id)
    {
        $session = $request->session();
        if ($session->has('currentController') &&  ($session->get('currentController') != $this->controllerName)) {
            $session->forget('params');
        } else {
            $session->put('currentController', $this->controllerName);
        }
        $item = $this->model->getItem(
            is_numeric($id) ? ['id' => $id] : ['code_ref' => $id], 
            ['task' => 'get-item']
        );
        $codeRef = $item['code_ref'];
        $userId=$item['user_id'];
        $userInfo=(new UsersModel)->getItem(['user_id' => $userId],['task'=>'get-item']);
        $sumMoney=$item->sumMoneyRefAffiliate($codeRef);
        $sumQuantity=$item->sumQuantityRefAffiliate($codeRef);
        $sumLinkCount = AffiliateProductModel::where('code_ref', $codeRef)->sum('sum_click')+$item['sum_click'];
        $params['group_id'] = collect($item->listIdProduct)->pluck('product_id')->toArray();
        if ($request->has('deleteValueSearch') && $request->get('deleteValueSearch') == 1) {
            $session->forget('params.search.value');
        }
        $session->put('params.search.field', $request->has('search_field') ? $request->get('search_field') : ($session->has('params.search.field') ? $session->get('params.search.field') : ''));
        $session->put('params.search.value', $request->has('search_value') ? $request->get('search_value') : ($session->has('params.search.value') ? $session->get('params.search.value') : ''));
        $session->put('params.group_id', $params['group_id']);
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
        return view($this->pathViewController .  'detail',
        [
            'params'           => $this->params,
            'item' => $item,
            'infoProduct' => $infoProduct,
            'sumMoney'=> $sumMoney,
            'sumQuantity' => $sumQuantity,
            'sumLinkCount' => $sumLinkCount,
            'userInfo'=> $userInfo
        ]);
    }
    public function refAffiliate(Request $request)
    {
        $userInfo = $request->session()->get('user');
        $userInfo=(new UsersModel)->getItem(['user_id' => $userInfo['user_id']],['task'=>'get-item']);
        $item = $this->model->getItem(['user_id' => $userInfo['user_id']], ['task' => 'get-item']);
        $codeRef = $item['code_ref'];
        $session = $request->session();
        if ($session->has('currentController') &&  ($session->get('currentController') != $this->controllerName)) {
            $session->forget('params');
        } else {
            $session->put('currentController', $this->controllerName);
        }
        $sumMoney=$item->sumMoneyRefAffiliate($codeRef);
        $sumQuantity=$item->sumQuantityRefAffiliate($codeRef);
        $sumLinkCount = AffiliateProductModel::where('code_ref', $codeRef)->sum('sum_click')+$item['sum_click'];
        $params['group_id'] = collect($item->listIdProduct)->pluck('product_id')->toArray();
        if ($request->has('deleteValueSearch') && $request->get('deleteValueSearch') == 1) {
            $session->forget('params.search.value');
        }
        $session->put('params.search.field', $request->has('search_field') ? $request->get('search_field') : ($session->has('params.search.field') ? $session->get('params.search.field') : ''));
        $session->put('params.search.value', $request->has('search_value') ? $request->get('search_value') : ($session->has('params.search.value') ? $session->get('params.search.value') : ''));
        $session->put('params.group_id', $params['group_id']);
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
        return view($this->pathViewController .  'references.index',
        [
            'params'           => $this->params,
            'item' => $item,
            'infoProduct' => $infoProduct,
            'sumMoney'=> $sumMoney,
            'sumQuantity' => $sumQuantity,
            'sumLinkCount' => $sumLinkCount,
            'userInfo'=> $userInfo
        ]);
    }
    public function infoBank(Request $request){
        $userInfo = $request->session()->get('user');
        $item = $this->model->getItem(['user_id' => $userInfo['user_id']], ['task' => 'get-item']);
        $infoBank = $item['info_bank'];
        return view($this->pathViewController .  'references.info_bank',['item'=>$infoBank]);
    }
    public function saveInfoBank(Request $request){
        $userInfo = $request->session()->get('user');
        $item = $this->model->getItem(['user_id' => $userInfo['user_id']], ['task' => 'get-item']);
        $infoBank = [
            'fullname' => $request->input('info_bank.fullname'),
            'stk_bank' => $request->input('info_bank.stk_bank'),
            'name_bank' => $request->input('info_bank.name_bank'),
        ];
        
        $notify = "Cập nhật thành công!";
        $this->model->saveItem(['id'=> $item['id'],'info_bank'=>$infoBank], ['task' => 'edit-item']);
        $request->session()->put('app_notify', $notify);
        return response()->json([
            'fail' => false,
            'redirect_url' => route('affiliate.infoBank'),
            'message'      => $notify,
        ]);
    }
    public function dashboardRef(Request $request){
        $userInfo = $request->session()->get('user');
        $item = $this->model->getItem(['user_id' => $userInfo['user_id']], ['task' => 'get-item']);
        $codeRef = $item['code_ref'];
        $sumMoney=$item->sumMoneyRefAffiliate($codeRef);
        $sumQuantity=$item->sumQuantityRefAffiliate($codeRef);
        $sumClickLinkProduct = AffiliateProductModel::where('code_ref', $codeRef)->sum('sum_click');
        $sumClickLinkComon = AffiliateModel::where('code_ref', $codeRef)->value('sum_click');
        $sumLinkCount = ($sumClickLinkProduct ?? 0) + ($sumClickLinkComon ?? 0);
        $sumPayment=(new CouponPaymentModel)->sumMoney(['code_ref'=>$codeRef],['task'=>'tinh-tong-tien-affiliate']);
        return view($this->pathViewController .  'references.dashboard', compact('sumMoney','sumPayment','sumQuantity','sumLinkCount'));
    }
}
