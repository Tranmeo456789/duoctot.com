<?php

namespace App\Http\Controllers\Shop\BackEnd;

use App\Model\Shop\QuestionModel as MainModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Shop\BackEnd\BackEndController;
use App\Http\Requests\QuestionRequest as MainRequest;
use App\Model\Shop\ProductModel;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
class QuestionController extends BackEndController
{
    public function __construct()
    {
        $this->controllerName     = 'question';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Câu hỏi';
        $this->model = new MainModel();
        parent::__construct();
    }
    public function index(Request $request)
    {
        $productId=$request->productId;
        $product = ProductModel::find($productId);
        $session = $request->session();
        if ($session->has('currentController') &&  ($session->get('currentController') != $this->controllerName)) {
            $session->forget('params');
        } else {
            $session->put('currentController', $this->controllerName);
        }
        $session->put('params.pagination.totalItemsPerPage', $this->totalItemsPerPage);
        $this->params =  $session->get('params');
        $this->params['product_id']=$productId;
        $items              = $this->model->listItems($this->params, ['task'  => 'user-list-items']);

        if ($items->currentPage() > $items->lastPage()) {
            $lastPage = $items->lastPage();
            Paginator::currentPageResolver(function () use ($lastPage) {
                return $lastPage;
            });
            $items              = $this->model->listItems($this->params, ['task'  => 'user-list-items']);
        }
        return view($this->pathViewController .  'index', [
            'params'           => $this->params,
            'items'            => $items,
            'productId'            => $productId,
            'product'            => $product,
            'controllerName' => $this->controllerName
        ]);    
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
                'redirect_url' => route($this->controllerName, ['productId' => $request->product_id]),
                'message'      => $notify,
            ]);
        }
    }
    public function form(Request $request)
    {
        $productId=$request->productId;
        $item = null;
        if ($request->id !== null) {
            $params["id"] = $request->id;
            $item = $this->model->getItem($params, ['task' => 'get-item']);
        }
        
        return view($this->pathViewController . 'form', compact(
            'productId',
            'item'
        ));
    }
}
