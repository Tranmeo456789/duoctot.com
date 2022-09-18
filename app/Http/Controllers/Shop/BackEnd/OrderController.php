<?php

namespace App\Http\Controllers\Shop\BackEnd;

use Illuminate\Http\Request;
use App\Model\Shop\CustomerModel;
use App\Model\Shop\OrderModel;
use App\Model\Shop\Cat_productModel;
use App\Model\Shop\ProductModel;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function __construct()
    {
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
        return view('shop.backend.order.list_order', compact('orders','list_status'));
    }
    public function detail_order($code)
    {
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
        return view('shop.backend.order.detail_order', compact('order', 'list_qty', 'ls_product_order', 'list_status'));
    }
    public function list_invoice()
    {
        return view('shop.backend.order.list_invoice');
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
            'status' => $status,
            'noti_success' => session('statusorder'),
        );
        return response()->json($result, 200);
    }
}
