<?php

namespace App\Http\Controllers\Shop\BackEnd;
use Illuminate\Http\Request;
use App\Model\Shop\CustomerModel;
use App\Model\Shop\OrderModel;
use App\Model\Shop\ProductModel;
use App\Model\Shop\WarehouseModel;
use App\Http\Requests;
use App\Http\Controllers\Shop\BackEnd\BackEndController;
use App\Model\Shop\OrderModel as MainModel;
use Session;
use DB;


class OrderController extends BackEndController
{
    public function __construct()
    {
        $this->controllerName     = 'order';
        $this->pathViewController = "$this->moduleName.$this->controllerName.";
        $this->pageTitle          = 'Danh sách đơn hàng';
        $this->model = new MainModel();
        parent::__construct();
    }   
    public function add_order()
    {
        return view('shop.backend.order.add_order');
    }
    public function list_order()
    {
        $list_status = ['Đang xử lý', 'Đã xác nhận', 'Đang giao hàng', 'Đã giao hàng', 'Hoàn tất', 'Đã hủy'];
        $orders = OrderModel::orderBy('id', 'DESC')->paginate(10); 
        return view($this->pathViewController.'list_order', compact('orders', 'list_status'));
    }
    public function detail_order($code)
    {
        $params['code_order']=$code;
        $order=$this->model->getItem($params,['task' => 'get-item']);
        $list_status = ['Đang xử lý', 'Đã xác nhận', 'Đang giao hàng', 'Đã giao hàng', 'Hoàn tất', 'Đã hủy'];
        $status_curent = $order->status;
        foreach ($list_status as $k => $item) {
            if ($status_curent == $item) {
                unset($list_status[$k]);
            }
        }
        $params['id']=$order->customer_id;
        $customer=(new CustomerModel)->getItem($params, ['task' => 'get-item']);
        $info_product=json_decode($order->info_product,true);
        return view('shop.backend.order.detail_order', compact('order','info_product','customer', 'list_status'));
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
        $request->session()->flash('statusorder', 'Cập nhật trạng thái thành công !');
        $result = array(
            'noti_success' => session('statusorder'),
            //'pro' =>  json_encode($numper_products),
        );
        return response()->json($result, 200);
    }
}
