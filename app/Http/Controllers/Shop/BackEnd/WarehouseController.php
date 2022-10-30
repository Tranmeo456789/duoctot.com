<?php

namespace App\Http\Controllers\Shop\BackEnd;

use App\Http\Controllers\Shop\BackEnd\BackEndController;

use Illuminate\Http\Request;
use App\Model\Shop\WarehouseModel;
use App\Http\Requests\WarehouseRequest as MainRequest;
use App\Model\Shop\WarehouseModel as MainModel;
use App\Model\Shop\ProductModel;
use App\Model\Shop\ProvinceModel;
use App\Model\Shop\DistrictModel;
use App\Model\Shop\WardModel;
use App\Model\Shop\UsersModel;
class WarehouseController extends BackEndController
{
    public function __construct()
    {
        $this->controllerName     = 'warehouse';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Kho hàng';
        $this->model = new MainModel();
        parent::__construct();
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

            if ($params['id'] != null) {
                $task   = "edit-item";
                $notify = "Cập nhật $this->pageTitle thành công!";
            }
            $this->model->saveItem($params, ['task' => $task]);
            $request->session()->put('app_notify', $notify);
            return response()->json([
                'fail' => false,
                'redirect_url' => route($this->controllerName),
                'message'      => $notify,
            ]);
        }
    }
    public function form(Request $request)
    {
        $item = null;
        $itemsProvince = (new ProvinceModel())->listItems(null,['task'=>'admin-list-items-in-selectbox']);
        $itemsDistrict = [];
        $itemsWard = [];

        if ($request->id !== null) {
            $params["id"] = $request->id;
            $item = $this->model->getItem($params, ['task' => 'get-item']);

            $params['province_id'] = ((isset($item->province_id)
                                        && ($item->province_id != 0))
                                        ? $item->province_id:0);
            if ($params['province_id'] != 0){
                $itemsDistrict = (new DistrictModel())->listItems(['parentID' => $params['province_id']],
                                                                    ['task'=>'admin-list-items-in-selectbox']);
            }
            $params['district_id'] = ((isset($item->district_id)
                                        && ($item->district_id != 0))
                                        ? $item->district_id:0);

            if ($params['district_id']  != 0){
                $itemsWard = (new WardModel())->listItems(['parentID' => $params['district_id']],
                                                                    ['task'=>'admin-list-items-in-selectbox']);
            }
        }

        return view($this->pathViewController .  'form',
            compact('item', 'itemsProvince' ,'itemsDistrict','itemsWard'));
    }
    public function info(Request $request)
    {
        $session = $request->session();
        $session->put('params.pagination.totalItemsPerPage', $this->totalItemsPerPage);
        $this->params =  $session->get('params');
        $pageTitle          = 'Thông tin Kho hàng';

        $itemsProduct = (new ProductModel())->listItems($this->params, ['task' => 'user-list-items-in-warehouse']);

        $itemsWarehouses = $this->model->listItems(null,['task' => 'admin-list-items-in-selectbox']);
        return view($this->pathViewController .  'info',
            compact('pageTitle','itemsProduct' ,'itemsWarehouses'));
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
        $pageTitle='Quản kho hàng';$this->params['user_type_id']=3;
        $items=(new UsersModel)->listItems($this->params, ['task'  => 'admin-list-items-of-shop']);
         return view($this->pathViewController .  'index_admin', [
            'items'            => $items,
            'pageTitle'=>$pageTitle
        ]);
    }
}
