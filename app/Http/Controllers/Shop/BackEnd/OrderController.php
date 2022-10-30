<?php

namespace App\Http\Controllers\Shop\BackEnd;
use Illuminate\Http\Request;
use App\Model\Shop\WarehouseModel;
use App\Model\Shop\ProductModel;
use App\Model\Shop\WardModel;
use App\Model\Shop\UsersModel;
use App\Http\Requests;
use App\Http\Controllers\Shop\BackEnd\BackEndController;
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
         return view($this->pathViewController .  'index_admin', [
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
        $itemsProduct = (new ProductModel())->listItems($params,['task' => 'user-list-items']);
        return view($this->pathViewController .  'detail',
                 compact('item','itemsWarehouse','itemsProduct','pageTitle'));
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
            $params['warehouse_id'] = intval($request->warehouse_id);
            $task   = "update-item";
            $notify = "Cập nhật $this->pageTitle thành công!";
            $this->model->saveItem($params, ['task' => $task]);
            $request->session()->put('app_notify', $notify);
            return response()->json([
                'fail' => false,
                'redirect_url' => route($this->controllerName),
                'message'      => $notify,
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
}
