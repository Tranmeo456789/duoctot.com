<?php

namespace App\Http\Controllers\Shop\BackEnd;

use App\Model\Shop\AffiliateModel as MainModel;
use App\Model\Shop\ProductModel;
use App\Model\Shop\UsersModel;
use App\Model\Shop\OrderModel;
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
        if ($request->has('deleteValueSearch') && $request->get('deleteValueSearch') == 1) {
            $session->forget('params.search.value');
        }
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
        if ($request->id !== null) {
            $params["id"] = $request->id;
            $item = $this->model->getItem($params, ['task' => 'get-item']);
        }
        $itemsProduct = (new ProductModel())->listItems(null, ['task' => 'admin-list-items-in-selectbox']);
        return view(
            $this->pathViewController .  'form',
            compact('item', 'itemsProduct')
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
            $paramsUser = [];
            $paramsUser['fullname'] = $params['fullname'];
            $paramsUser['phone'] = $params['phone'];
            $paramsUser['password'] = $params['password'];
            $paramsUser['user_type_id'] = 10;
            $paramsUser['domain_register'] = config("myconfig.url.prod");
            $userModel = new UsersModel();
            if ($params['id'] != null) {
                $task   = "edit-item";
                $notify = "Cập nhật $this->pageTitle thành công!";
                $item = $this->model->getItem(['id' => $params['id']], ['task' => 'get-item']);
                $paramsUser['user_id'] = $item['user_id'];
                $userModel->saveItem($paramsUser, ['task' => 'update-item-simple']);
            } else {
                $params['user_id'] = $userModel->saveItem($paramsUser, ['task' => 'register']);
            }
            if ($this->model->saveItem($params, ['task' => $task])) {
                $request->session()->put('app_notify', $notify);
                return response()->json([
                    'status' => 200,
                    'success' => true,
                    'data' =>  null,
                    'errors' => null,
                    'message' => $notify,
                    'redirect_url' => route($this->controllerName)
                ], 200);
            } else {
                return response()->json([
                    'status' => 200,
                    'success' => false,
                    'data' => null,
                    'errors' => null,
                    'message' => 'Có lỗi xảy ra, vui lòng thử lại'
                ], 200);
            }
        }
    }
    public function detail($id)
    {
        $item = $this->model->getItem(['id' => $id], ['task' => 'get-item']);
        $infoProduct = $item['info_product'];
        return view($this->pathViewController .  'detail', compact('item', 'infoProduct'));
    }
    public function refAffiliate(Request $request)
    {
        $userInfo = $request->session()->get('user');
        $item = $this->model->getItem(['user_id' => $userInfo['user_id']], ['task' => 'get-item']);
        $infoProduct = $item['info_product'];
        $codeRef = $item['code_ref'];
        $orders = OrderModel::select('info_product')->where('status_order','hoanTat')->get();
        $productComplete = [];
        if(isset($orders) && !empty($orders)){
            foreach ($orders as $order) {
                $productOrder = $order->info_product;
                foreach ($productOrder as $productId => $product) {
                    if (isset($product['codeRef']) && $product['codeRef'] === $codeRef) {
                        if (!isset($productComplete[$productId])) {
                            $productComplete[$productId] = [
                                'product_id' => $productId,
                                'quantity' => 0,
                                'total_money' => 0,
                            ];
                        }
                        $productComplete[$productId]['quantity'] += $product['quantity'];
                        $productComplete[$productId]['total_money'] += $product['total_money'];
                    }
                }
            }
        }
        return view($this->pathViewController .  'references.index', compact('item', 'infoProduct','productComplete'));
    }
}
