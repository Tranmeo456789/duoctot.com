<?php

namespace App\Http\Controllers\Shop\BackEnd;

use App\Model\Shop\CouponPaymentModel as MainModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Shop\BackEnd\BackEndController;
use App\Http\Requests\CouponPaymentRequest as MainRequest;
use App\Model\Shop\AffiliateModel;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class CouponPaymentController extends BackEndController
{
    public function __construct()
    {
        $this->controllerName     = 'couponPayment';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Phiếu thanh toán';
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
        if ($request->id !== null) {
            $params["id"] = $request->id;
            $item = $this->model->getItem($params, ['task' => 'get-item']);
        }
        $itemRef=null;
        $fullname='';
        $infoBank=null;
        if ($request->codeRef !== null) {
            $codeRef = $request->codeRef;
            $itemRef = (new AffiliateModel)->getItem(['code_ref'=>$codeRef], ['task' => 'get-item']);
            $fullname =  $itemRef->userRef['fullname']??'';
            $infoBank=$itemRef['info_bank'];
            
            $userId=$itemRef['user_id'];
        }
        return view(
            $this->pathViewController .  'form',
            compact('item', 'codeRef','fullname','infoBank','userId')
        );
    }

}
