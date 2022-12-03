<?php

namespace App\Http\Controllers\Shop\BackEnd;

use App\Model\Shop\UsersModel as MainModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Shop\BackEnd\BackEndController;
use App\Http\Requests\EditorRequest as MainRequest;
use App\Model\Shop\ProvinceModel;
use App\Model\Shop\DistrictModel;
use App\Model\Shop\WardModel;
use App\Helpers\MyFunction;
use DB;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
class EditorController extends BackEndController
{
    public function __construct()
    {
        $this->controllerName     = 'editor';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Danh sách Editor';
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
        $this->params['is_editor']=2;
        $items              = $this->model->listItems($this->params, ['task'  => 'admin-list-editor-of-shop']);
        
        if ($items->currentPage() > $items->lastPage()) {
            $lastPage = $items->lastPage();
            Paginator::currentPageResolver(function () use ($lastPage) {
                return $lastPage;
            });
            $items  = $this->model->listItems($this->params, ['task'  => 'admin-list-editor-of-shop']);
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
            $item = $this->model->getItem($params, ['task' => 'get-item']);
            //$details = $item->details->pluck('value','user_field')->toArray()??[];
        }
        $itemsProvince = (new ProvinceModel())->listItems(null,['task'=>'admin-list-items-in-selectbox']);
        return view($this->pathViewController . 'form', compact(
            'item'

        ));
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
            $params['is_admin']=2;
            $task   = "add-item-editor";
            $notify = "Thêm mới $this->pageTitle thành công!";
            if ($params["user_id"] != null) {
                $task   = "edit-item-editor";
                $notify = "Cập nhật $this->pageTitle thành công!";
            }
            $this->model->saveItem($params, ['task' => $task]);
            $request->session()->put('app_notify', $notify);
            return response()->json([
                'fail' => false,
                'redirect_url' => route('editor'),
                'message'      => $notify,
            ]);
        }
    }
    public function delete(Request $request)
    {
        $params["user_id"]             = $request->id;
        $this->model->deleteItem($params, ['task' => 'delete-item']);
        $notify = "Xóa $this->pageTitle thành công!";
        $request->session()->put('app_notify', $notify);
        return response()->json([
            'fail'         => false,
            'redirect_url' => route($this->controllerName),
            'message'      => $notify,
        ]);
    }
}
