<?php

namespace App\Http\Controllers\Shop\BackEnd;
use Illuminate\Http\Request;
use App\Model\Shop\WarehouseModel;
use App\Model\Shop\ProductModel;
use App\Model\Shop\OrderProductModel;
use App\Model\Shop\WardModel;
use App\Model\Shop\UsersModel;
use App\Http\Requests;
use App\Http\Controllers\Shop\BackEnd\BackEndController;
use App\Model\Shop\AffiliateModel;
use App\Model\Shop\OrderModel as MainModel;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
class OrderController extends BackEndController
{
    public function __construct()
    {
        $this->controllerName     = 'order';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Danh sách đơn hàng';
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
        $session->put('params.filter.status_order', $request->has('filter_status_order') ? $request->get('filter_status_order') : ($session->has('params.filter.status_order') ? $session->get('params.filter.status_order') : 'all'));

        $session->put('params.pagination.totalItemsPerPage', $this->totalItemsPerPage);
        $this->params     = $session->get('params');
        if($session->get('user.is_affiliate') == 1){
            $userAffiliate = (new AffiliateModel)->getItem(['user_id' => $session->get('user.user_id')], ['task' => 'get-item']);
            $this->params['code_ref'] = $userAffiliate['code_ref'];
            $this->params['user_type_id'] = $session->get('user.user_type_id');
            $items = $this->model->listItems($this->params, ['task'  => 'user-list-items-affiliate']);
        }else{
            $items            = $this->model->listItems($this->params, ['task'  => 'user-list-items']);
        }
        if ($items->currentPage() > $items->lastPage()) {
            $lastPage = $items->lastPage();
            Paginator::currentPageResolver(function () use ($lastPage) {
                return $lastPage;
            });
            if($session->get('user.is_affiliate') == 1){
                $userAffiliate = (new AffiliateModel)->getItem(['user_id' => $session->get('user.user_id')], ['task' => 'get-item']);
                $this->params['code_ref'] = $userAffiliate['code_ref'];
                $this->params['user_type_id'] = $session->get('user.user_type_id');
                $items = $this->model->listItems($this->params, ['task'  => 'user-list-items-affiliate']);
            }else{
                $items = $this->model->listItems($this->params, ['task'  => 'user-list-items']);
            }
        }
        $itemStatusOrderCount = $this->model->countItems($this->params, ['task' => 'admin-count-items-group-by-status-order']);
        return view($this->pathViewController .  'index', [
            'params'           => $this->params,
            'items'            => $items,
            'itemStatusOrderCount' => $itemStatusOrderCount
        ]);
    }
    public function index_admin(Request $request){
        $session = $request->session();
        if ($session->has('currentController') &&  ($session->get('currentController') != $this->controllerName)) {
            $session->forget('params');
        } else {
            $session->put('currentController', $this->controllerName);
        }
        $session->put('params.pagination.totalItemsPerPage', $this->totalItemsPerPage);
        $this->params     = $session->get('params');
        $pageTitle='Quản lý đơn hàng';$this->params['user_type_id']=3;
        $items=(new UsersModel)->listItems($this->params, ['task'  => 'admin-list-items-of-shop']);
         return view($this->pathViewController .  'admin.index', [
            'items'            => $items,
            'pageTitle'=>$pageTitle
        ]);
    }
    public function detail(Request $request)
    {
        $params['id']= intval($request->id);
        $item= $this->model->getItem($params,['task' => 'get-item']);
        $pageTitle ='Chi tiết đơn hàng';
        $itemsWarehouse = (new WarehouseModel())->listItems(['user_id'=>$item['user_sell']],['task' => 'admin-list-items-in-selectbox']);
        $params['group_id'] = array_keys($item['info_product']);
        $address='';
        if($item->delivery_method ==1){
            $warehouse_id=$item['pharmacy']['warehouse_id'];
            $address=(new WarehouseModel())->getItem(['id'=>$warehouse_id],['task' => 'get-item-of-id'])->address??'';
        }else{
            $ward_detail=(new WardModel())->getItem(['id'=>$item->receive['ward_id']],['task' => 'get-item-full']);
            $ward=$ward_detail['name'];$district=$ward_detail['district']['name'];$province=$ward_detail['district']['province']['name'];
            $address=$item->receive['address'].', '.$ward.', '.$district.', '.$province;
        }
        $itemsProduct = (new ProductModel())->listItems($params,['task' => 'user-list-items']);
        $infoBuyer=json_decode($item['buyer'], true);
        return view($this->pathViewController .  'detail',
                 compact('item','itemsWarehouse','itemsProduct','address','infoBuyer','pageTitle'));
    }
    public function save(Request $request)
    {
        // if (!$request->ajax()) return view("errors." .  'notfound', []);
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'fail' => true,
                'errors' => $request->validator->errors()
            ]);
        }
        if ($request->method() == 'POST') {
            $params['id'] = intval($request->id);
            $params['status_order'] = $request->status_order;
            $params['status_control'] = $request->status_control;
            $params['warehouse_id'] = intval($request->warehouse_id);
            $task   = "update-item";
            $notify = "Cập nhật trạng thái đơn hàng thành công!";
            $this->model->saveItem($params, ['task' => $task]);
            (new OrderProductModel)->saveItem(['order_id' => $params['id'],'status_order' => $params['status_order']], ['task' => 'edit-item']);
            $request->session()->put('app_notify', $notify);
            return response()->json([
                'fail' => false,
                'redirect_url' => route($this->controllerName),
                'message' => $notify,
            ]);
        }
    }
    public function list_invoice()
    {
        $pageTitle='Danh sách hóa đơn';
        $moduleName='shop.backend';
        return view('shop.backend.order.list_invoice',compact('pageTitle','moduleName'));
    }
    public function detail_invoice()
    {
        return view('shop.backend.order.detail_invoice');
    }
    public function changeStatusOrder(Request $request)
    {
        $params["currentValue"]  = $request->value;
        $params["id"]             = $request->id;
        $this->model->saveItem($params, ['task' => 'change-status-order']);
        $notify = "Cập nhật Trạng thái đơn hàng thành công!";
        $request->session()->put('app_notify', $notify);
        return redirect()->back();
        // return response()->json([
        //     'fail'         => false,
        //     'redirect_url' => route($this->controllerName),
        //     'message'      => $notify
        // ]);
    }
    public function listOrderAdmin(Request $request){
        $session = $request->session();
        if ($session->has('currentController') &&  ($session->get('currentController') != $this->controllerName)) {
            $session->forget('params');
        } else {
            $session->put('currentController', $this->controllerName);
        }
        $session->put('params.filter.status_order', $request->has('filter_status_order') ? $request->get('filter_status_order') : ($session->has('params.filter.status_order') ? $session->get('params.filter.status_order') : 'dangXuLy'));
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
        $itemStatusOrderCount = $this->model->countItems($this->params, ['task' => 'admin-count-items-group-by-status-order']);
        return view($this->pathViewController .  'admin.list_order', [
            'params'           => $this->params,
            'items'            => $items,
            'itemStatusOrderCount' => $itemStatusOrderCount
        ]);
    }
}
