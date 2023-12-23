<?php

namespace App\Http\Controllers\Shop\BackEnd;

use App\Model\Shop\AffiliateModel as MainModel;
use App\Model\Shop\WarehouseModel;
use App\Model\Shop\ProductModel;
use App\Model\Shop\UnitModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Shop\BackEnd\BackEndController;
use App\Http\Requests\AffiliateRequest as MainRequest;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

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
        if ($request->id !== null) {
            $params["id"] = $request->id;
            $item = $this->model->getItem($params, ['task' => 'get-item']);
        }
        $itemsProduct = (new ProductModel())->listItems(null,['task'=>'admin-list-items-in-selectbox']);
        return view($this->pathViewController .  'form',
            compact('item','itemsProduct'));
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
            if ($this->model->saveItem($params, ['task' => $task])){
                $request->session()->put('app_notify', $notify);
                return response()->json([
                    'status' => 200,
                    'success' => true,
                    'data' =>  null,
                    'errors' => null,
                    'message' => $notify,
                    'redirect_url' => route($this->controllerName)
                ], 200);
            }else{
                return response()->json([
                    'status' => 200,
                    'success' => false,
                    'data' => null,
                    'errors' => null,
                    'message' => 'Có lỗi xảy ra, vui lòng thử lại'
                ],200);
            }
        }
    }
    public function detail($id){
        $item = $this->model->getItem(['id'=>$id], ['task' => 'get-item']);
        $infoProduct=$item['info_product'];
        return view($this->pathViewController .  'detail', compact('item','infoProduct'));
    }
}
