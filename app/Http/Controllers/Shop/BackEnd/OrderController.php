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
        $orders = OrderModel::paginate(10);
        return view('shop.backend.order.list_order',compact('orders'));
    }
    public function detail_order($code)
    {
        $order=OrderModel::where('code_order', $code)->get();
        $list_pr=[];$list_qty=[];
        $list_qty=explode(",", $order[0]['qty_per']);
        $list_pr = explode(",", $order[0]['product_id']);
        $ls_product_order=[];
        foreach($list_pr as $list_product){
            $ls_product_order[]=ProductModel::find($list_product);
        }     
        return view('shop.backend.order.detail_order',compact('order','list_qty','ls_product_order'));
    }
    public function list_invoice()
    {
        return view('shop.backend.order.list_invoice');
    }
    public function detail_invoice()
    {
        return view('shop.backend.order.detail_invoice');
    }
}
