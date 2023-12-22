<?php

namespace App\Http\Controllers\Shop\BackEnd;

use App\Model\Shop\ProductModel as MainModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Shop\BackEnd\BackEndController;
use App\Model\Shop\ProductModel;
use App\Model\Shop\CatProductModel;
use App\Model\Shop\UsersModel;
use App\Model\Shop\ProducerModel;
use App\Model\Shop\TrademarkModel;
use App\Model\Shop\WarehouseModel;
use App\Model\Shop\CountryModel;
use App\Http\Requests\ProductRequest as MainRequest;
use App\Model\Shop\UnitModel;
use App\Model\Shop\ProvinceModel;
use App\Helpers\MyFunction;
use Illuminate\Support\Str;

use DB;
use Session;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
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
        if ($session->has('currentController') &&  ($session->get('currentController') != $this->controllerName)) {
            $session->forget('params');
        } else {
            $session->put('currentController', $this->controllerName);
        }
        $session->put('params.filter.status_product', $request->has('filter_status_product') ? $request->get('filter_status_product') : ($session->has('params.filter.status_product') ? $session->get('params.filter.status_product') : 'all'));
        $session->put('params.search.field', $request->has('search_field') ? $request->get('search_field') : ($session->has('params.search.field') ? $session->get('params.search.field') : ''));
        $session->put('params.search.value', $request->has('search_value') ? $request->get('search_value') : ($session->has('params.search.value') ? $session->get('params.search.value') : ''));
        $session->put('params.pagination.totalItemsPerPage', $this->totalItemsPerPage);
        $this->params     = $session->get('params');

        $items            = $this->model->listItems($this->params, ['task'  => 'user-list-items']);
        $itemStatusProductCount = $this->model->countItems($this->params, ['task' => 'admin-count-items-group-by-status-product']);
        if ($items->currentPage() > $items->lastPage()) {
            $lastPage = $items->lastPage();
            Paginator::currentPageResolver(function () use ($lastPage) {
                return $lastPage;
            });
            $items              = $this->model->listItems($this->params, ['task'  => 'user-list-items']);
        }
        $pathView = $request->ajax() ? 'ajax' : 'index';
        return view($this->pathViewController .  $pathView, [
            'params'           => $this->params,
            'items'            => $items,
            'itemStatusProductCount' => $itemStatusProductCount
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
        $pageTitle='Quản lý thuốc';$this->params['user_type_id']=3;
        $items=(new UsersModel)->listItems($this->params, ['task'  => 'admin-list-items-of-shop']);
         return view($this->pathViewController .  'index_admin', [
            //'params'           => $this->params,
            'items'            => $items,
            'pageTitle'=>$pageTitle
        ]);
    }
    public function listProductAdmin(Request $request){
        $session = $request->session();
        if ($session->has('currentController') &&  ($session->get('currentController') != $this->controllerName)) {
            if(!$request->get('page')){
                $session->forget('params');
            }         
        } else {
            $session->put('currentController', $this->controllerName);
        }
        $session->put('params.filter.status_product', $request->has('filter_status_product') ? $request->get('filter_status_product') : ($session->has('params.filter.status_product') ? $session->get('params.filter.status_product') : 'cho_kiem_duyet'));
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
        $itemStatusProductCount = $this->model->countItems($this->params, ['task' => 'admin-count-items-group-by-status-product']);
        //return($request->get('page'));
        return view($this->pathViewController .'admin.products', [
            'params'           => $this->params,
            'items'            => $items,
            'itemStatusProductCount' => $itemStatusProductCount
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
            // $urlImgBB=$this->model->uploadToImgBB($params['image']);
            // if ($urlImgBB) {
            //     $params['image'] = $urlImgBB;
            // }
            $params['slug']= Str::slug($params['name']);
            $this->model->saveItem($params, ['task' => $task]);
            $request->session()->put('app_notify', $notify);
            if(Session::get('user')['is_admin'] == 1 || Session::get('user')['is_admin'] == 2){
                $notify='Cập nhật thông tin thuốc thành công!';
                $request->session()->put('app_notify', 'Cập nhật thông tin thuốc thành công!');
                return response()->json([
                    'fail' => false,
                    'redirect_url' => route('admin.product.list'),
                    'message'      => $notify,
                ]);
            }
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
        $itemsCatProduct = (new CatProductModel())->listItems(null, ['task' => 'admin-list-items-in-selectbox']);
        $itemsProducer = (new ProducerModel())->listItems(null, ['task' => 'admin-list-items-in-selectbox']);
        $itemsTrademark = (new TrademarkModel())->listItems(null, ['task' => 'admin-list-items-in-selectbox']);
        $itemsCountry = (new CountryModel())->listItems(null, ['task' => 'admin-list-items-in-selectbox']);
        $itemsUnit = (new UnitModel())->listItems(null, ['task' => 'admin-list-items-in-selectbox']);
        $itemsProvince = (new ProvinceModel())->listItems(null, ['task' => 'admin-list-items-in-selectbox']);
        return view($this->pathViewController . 'form', compact(
            'item',
            'itemsCatProduct',
            'itemsProducer',
            'itemsTrademark',
            'itemsCountry',
            'itemsUnit',
            'itemsProvince'
        ));
    }
    public function getItem(Request $request){
        $params["id"] = intval($request->id);
        $item = $this->model->getItem($params, ['task' => 'get-item-simple']);
        return json_encode($item->toArray());
    }
   public function changeProductInAdmin(Request $request,$id,$status){
        $params['id']=$request->id;
        $params['status_product']=$request->status;
        $this->model->saveItem($params, ['task' => 'update-status-item-of-admin']);
        $request->session()->put('app_notify', 'Thay đổi trạng thái thuốc thành công!');
        return back()->withInput();
   }
}
