<?php

namespace App\Http\Controllers\Shop\BackEnd;
use App\Model\Shop\Cat_productModel as MainModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Shop\BackEnd\BackEndController;
use App\Model\Shop\Cat_productModel;
use App\Http\Requests\Cat_productRequest as MainRequest;
use App\Helper;
include "app/Helper/data.php";
class Cat_productController extends BackEndController
{
    public function __construct()
    {
        $this->controllerName     = 'cat_product';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Danh mục sản phẩm';
        $this->model = new MainModel();
        parent::__construct();
        session(['module_active' => 'catproduct']);
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
        $data = Cat_productModel::all();
        $product_cats = data_tree1($data, 0);
        return view($this->pathViewController . 'form', ['item' => $item, 'product_cats' => $product_cats]);
    }
}
