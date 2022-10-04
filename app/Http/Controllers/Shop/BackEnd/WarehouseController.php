<?php

namespace App\Http\Controllers\Shop\BackEnd;

use App\Model\Shop\WarehouseModel as MainModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Shop\BackEnd\BackEndController;
use App\Model\Shop\Tinhthanhpho;
use App\Model\Shop\Quanhuyen;
use App\Model\Shop\WarehouseModel;
use App\Model\Shop\ProducerModel;
use App\Model\Shop\CouponImportModel;
use App\Model\Shop\UnitModel;
use App\Model\Shop\Xaphuongthitran;
use App\Http\Requests\WarehouseRequest as MainRequest;
use App\Model\Shop\CountryModel;
use App\Model\Shop\ProductModel;
use Session;
use DB;

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
            $products = (new ProductModel)->listItemsNoPaginate();
            $product_id=[];
            if ($products != null) {
                foreach($products as $product){
                    $product_id[$product['id']]=0;
                }
            }
            $product_id=json_encode($product_id);
            $params['product_id']=$product_id;
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
        $locals = Tinhthanhpho::all();
        return view($this->pathViewController .  'form', [
            'item'        => $item, 'locals' => $locals,
        ]);
    }
    public function qlwarehouse(Request $request)
    {
        $session = $request->session();
        if ($session->has('user')) {
            $user = $request->session()->get('user');
        }
        $products = ProductModel::where('user_id', $user->user_id)->get();
        $warehouses = WarehouseModel::where('user_id', $user->user_id)->get();
        //return($warehouses);
        return view('shop.backend.pages.warehouse.qlwarehouse', compact('warehouses', 'products'));
    }
    public function add_product(Request $request)
    {
        $data = $request->all();
        $product_id = $request->product_id;
        $number_change = $request->number_change;
        $warehouse_id = $request->warehouse_id;
        $warehouses = WarehouseModel::where('id', $warehouse_id)->get();
        $warehouse = $warehouses[0];
        $product = json_decode($warehouse->product_id, true);
        $qty = $product[$product_id] + $number_change;
        $product[$product_id] = $qty;
        WarehouseModel::where('id', $warehouse_id)->update(
            [
                'product_id' => json_encode($product)
            ]
        );
        $result = array(
            'number' => $qty,
            'test' => json_encode($product),
        );
        return response()->json($result, 200);
    }
    public function import(Request $request)
    {
        if ($request->input('add_warehouse')) {
            $warehouse_id = $request->input('warehouse');
            $ls_product_old = json_decode(WarehouseModel::find($warehouse_id)->product_id, true);
            $producer_id = $request->input('producer');
            $ls_product = $request->input('ls_qty');

            $isset_number = 0;
            foreach ($ls_product_old as $k => $item) {
                if ($ls_product[$k] != null && $ls_product[$k] > 0) {
                    $ls_product_old[$k] = (int)$item + (int)$ls_product[$k];
                    $isset_number++;
                }
            }
            if ($isset_number > 0) {
                $coupon_id_last = CouponImportModel::latest('id')->first();
                if (CouponImportModel::latest('id')->first() == null) {
                    $coupon_id_last['id'] = 0;
                }
                $year = getdate()['year'];
                $month = sprintf("%02d", getdate()['mon']);
                $day = sprintf("%02d", getdate()['mday']);
                $id_coupon = sprintf("%05d", $coupon_id_last['id'] + 1);
                $code_coupon = 'PNK' . $year . $month . $day . $id_coupon;
                $session = $request->session();
                if ($session->has('user')) {
                    $user = $request->session()->get('user');
                }
                $qty_total=0;
                foreach($ls_product as $item){
                    if ($item != null && $item > 0) {
                        $qty_total+=$item;
                    }                 
                }
                CouponImportModel::create([
                    'code_coupon' => $code_coupon,
                    'warehouse_id' => $warehouse_id,
                    'user_id' => $user->user_id,
                    'qty_total'=>$qty_total,
                    'list_product'=>json_encode($ls_product)
                ]);
                WarehouseModel::where('id', $warehouse_id)->update(
                    [
                        'product_id' => json_encode($ls_product_old)
                    ]
                );
                return back()->with('app_notify', 'Nhập thêm hàng vào kho hàng thành công');
            } else {
                return back()->withInput();
            }
        } else {
            $session = $request->session();
            if ($session->has('user')) {
                $user = $request->session()->get('user');
            }
            $products = ProductModel::where('user_id', $user->user_id)->get();
            $warehouses = WarehouseModel::where('user_id', $user->user_id)->get();
            $units = UnitModel::all();
            $producers = ProducerModel::all();
            $coupon_imports = CouponImportModel::where('user_id', $user->user_id)->get();
            return view($this->pathViewController .  'importWarehouse', compact('products', 'warehouses', 'units', 'producers', 'coupon_imports'));
        }
    }
}
