<?php

namespace App\Http\Controllers\Shop\BackEnd;

use Illuminate\Http\Request;
use App\Model\Shop\CustomerModel;
use App\Model\Shop\OrderModel;
use App\Model\Shop\Cat_productModel;
use App\Model\Shop\ProductModel;
use App\Model\Shop\WarehouseModel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Shop\OrderModel as MainModel;

use Session;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->controllerName     = 'order';
        //$this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        //$this->pageTitle          = 'Danh sách đơn hàng';
        //$this->model = new MainModel();
        //parent::__construct();
        session(['module_active' => 'order']);
    }
    
    public function add_order()
    {
        return view('shop.backend.order.add_order');
    }
    public function list_order()
    {
        $list_status = ['Đang xử lý', 'Đã xác nhận', 'Đang giao hàng', 'Đã giao hàng', 'Hoàn tất', 'Đã hủy'];
        $orders = OrderModel::paginate(10);
        $pageTitle='Danh sách đơn hàng';
        $moduleName='shop.backend';
        return view('shop.backend.order.list_order', compact('orders', 'list_status','pageTitle','moduleName'));
    }
    public function detail_order($code)
    {
        $pageTitle='Chi tiết đơn hàng';
        $moduleName='shop.backend';
        $order = OrderModel::where('code_order', $code)->get();
        $list_pr = [];
        $list_qty = [];
        $list_qty = explode(",", $order[0]['qty_per']);
        $list_pr = explode(",", $order[0]['product_id']);
        $ls_product_order = [];
        foreach ($list_pr as $list_product) {
            $ls_product_order[] = ProductModel::find($list_product);
        }
        $list_status = ['Đang xử lý', 'Đã xác nhận', 'Đang giao hàng', 'Đã giao hàng', 'Hoàn tất', 'Đã hủy'];
        $status_curent = $order[0]->status;
        foreach ($list_status as $k => $item) {
            if ($status_curent == $item) {
                unset($list_status[$k]);
            }
        }
        return view('shop.backend.order.detail_order', compact('order', 'list_qty', 'ls_product_order', 'list_status','pageTitle','moduleName'));
    }
    public function list_invoice()
    {
        $pageTitle='Danh sách hóa đơn';
        $moduleName='shop.backend';
        return view('shop.backend.order.list_invoice',compact('pageTitle','moduleName'));
    }
    public function detail_invoice()
    {
        return view('shop.backend.order.detail_invoice');
    }
    public function update_status(Request $request)
    {
        $data = $request->all();
        $status = $request->status;
        $id = $request->id;
        OrderModel::where('id', $id)->update([
            'status' => $status
        ]);
        $list_pr = [];
        $list_qty = [];
        if ($status == 'Hoàn tất') {
            $order = OrderModel::where('id', $id)->get();
            
            $list_qty = explode(",", $order[0]['qty_per']);
            $list_pr = explode(",", $order[0]['product_id']);
            $list_porder = [];
            foreach ($list_pr as $k => $pr) {
                $list_porder[$pr] = (int)$list_qty[$k];
            }


            $id_cus = 0;
            if (Session::has('islogin')) {
                $id_cus = Session::get('id');
            }
            $products = ProductModel::where('customer_id', $id_cus)->get();
            $warehouses = WarehouseModel::where('customer_id', $id_cus)->get();
            $numper_products = [];
            foreach ($warehouses as $k => $warehouse) {
                $qty_per = explode(',', $warehouse['qty']);
                $product_id = explode(',', $warehouse['product_id']);
                foreach ($product_id as $i => $product_id1) {
                    $numper_products[$k][$product_id1] = (int)$qty_per[$i];
                }
            }
        
            foreach($numper_products[0] as $k=>$numware){
                foreach($list_porder as $i=>$numorder){
                    if($k==$i){
                        $qty_product=$numware-$numorder;
                        $numper_products[0][$k]=$qty_product;
                    }
                }
            }
            $list_product='';
            $t=0;
            foreach($numper_products[0] as $k=>$numper_product){  
                      if($t==0)  {
                        $list_product.= $numper_product;
                      }else{
                        $list_product.= ','.$numper_product;
                      }
                $t++;
            }
         
                WarehouseModel::where('id', $warehouses[0]['id'])->update(
                    [
                        'qty' => $list_product
                    ]
                    );     

        }
        $request->session()->flash('statusorder', 'Cập nhật trạng thái thành công !');
        $result = array(
            'status' => $status,
            'noti_success' => session('statusorder'),
            //'pro' => $list_product
        );
        return response()->json($result, 200);
    }
}
