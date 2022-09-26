<?php

namespace App\Http\Controllers\Shop\BackEnd;

use App\Model\Shop\ProductModel as MainModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Shop\BackEnd\BackEndController;
use App\Model\Shop\ProductModel;
use App\Model\Shop\CatProductModel;
use App\Model\Shop\ProducerModel;
use App\Model\Shop\TrademarkModel;
use App\Model\Shop\CountryModel;
use App\Http\Requests\ProductRequest as MainRequest;
use App\Model\Shop\UnitModel;
use App\Model\Shop\ProvinceModel;
class ProductController extends BackEndController
{
    public function __construct()
    {
        $this->controllerName     = 'product';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Danh sách Thuốc';
        $this->model = new MainModel();
        parent::__construct();
    }
    public function index(Request $request)
    {
        $session = $request->session();
        if ($session->has('currentController') &&  ($session->get('currentController') != $this->controllerName) ) {
            $session->forget('params');
        }else{
            $session->put('currentController', $this->controllerName);
        }
        $session->put('params.filter.typeProduct',$request->has('filter_typeProduct')? $request->get('filter_typeProduct'):($session->has('params.filter.typeProduct')? $session->get('params.filter.typeProduct'):'dang_ban'));

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
       // $itemsHieuLucVanBanCount   = $this->model->countItems($this->params, ['task' => 'admin-count-items-group-by-hieu-luc-van-ban']); // [ ['status', 'count']]
        $pathView = ($request->ajax()) ? 'ajax' : 'index';
        return view($this->pathViewController .  $pathView, [
            'params'           => $this->params,
            'items'            => $items
          //  'itemsHieuLucVanBanCount' => $itemsHieuLucVanBanCount
        ]);
    }
    public function save(MainRequest $request)
    {
       // if (!$request->ajax()) return view("errors." .  'notfound', []);
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
        if ($request->id !== null) {
            $params["id"] = $request->id;
            $item = $this->model->getItem($params, ['task' => 'get-item']);
        }
        $itemsCatProduct = (new CatProductModel())->listItems(null,['task' => 'admin-list-items-in-selectbox']);
        $itemsProducer = (new ProducerModel())->listItems(null,['task' => 'admin-list-items-in-selectbox']);
        $itemsTrademark = (new TrademarkModel())->listItems(null,['task' => 'admin-list-items-in-selectbox']);
        $itemsCountry = (new CountryModel())->listItems(null,['task' => 'admin-list-items-in-selectbox']);
        $itemsUnit = (new UnitModel())->listItems(null,['task' => 'admin-list-items-in-selectbox']);
        $itemsProvince = (new ProvinceModel())->listItems(null,['task' => 'admin-list-items-in-selectbox']);
        return view($this->pathViewController . 'form', compact(
            'item',
            'itemsCatProduct',
            'itemsProducer',
            'itemsTrademark',
            'itemsCountry',
            'itemsUnit','itemsProvince'));
    }
}
