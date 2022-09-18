<?php

namespace App\Http\Controllers\Shop\BackEnd;

use App\Model\Shop\WarehouseModel as MainModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Shop\BackEnd\BackEndController;
use App\Model\Shop\Tinhthanhpho;
use App\Model\Shop\Quanhuyen;
use App\Model\Shop\WarehouseModel;
use App\Model\Shop\ProducerModel;
use App\Model\Shop\Xaphuongthitran;
use App\Http\Requests\WarehouseRequest as MainRequest;
use App\Model\Shop\ProductModel;
use Session;
class WarehouseController extends BackEndController
{
    public function __construct()
    {
        $this->controllerName     = 'warehouse';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Kho hàng';
        $this->model = new MainModel();
        parent::__construct();
        session(['module_active'=>'warehouse']);
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
        $locals=Tinhthanhpho::all();
        return view($this->pathViewController .  'form', [
            'item'        => $item, 'locals'=> $locals,
        ]);
    }
    public function qlwarehouse(){
        $id=0;
        if(Session::has('islogin')){
            $id=Session::get('id');
        }
        $products=ProductModel::where('customer_id',$id)->get();
        $warehouses=WarehouseModel::where('customer_id',$id)->get();
        $numper_products=[];
        foreach($warehouses as $k => $warehouse) {
            $qty_per=explode(',', $warehouse['qty']);
            $product_id = explode(',', $warehouse['product_id']);
            foreach($product_id as $i => $product_id1){             
                   $numper_products[$k][$product_id1]=(int)$qty_per[$i];                             
            }                 
        }

       //return($numper_products[1][50]);
        return view('shop.backend.pages.warehouse.qlwarehouse',compact('warehouses','products','numper_products'));
    }
}
