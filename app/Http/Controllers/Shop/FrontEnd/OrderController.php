<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;
use App\Model\Shop\CustomerModel;
use App\Model\Shop\OrderModel;
use App\Model\Shop\Tinhthanhpho;
use App\Model\Shop\Xaphuongthitran;
use App\Model\Shop\Quanhuyen;
use App\Model\Shop\Cat_productModel;
use App\Model\Shop\CatProductModel;
use App\Model\Shop\ProductModel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use Session;
use Illuminate\Support\Str;

session_start();
include "app/Helpers/data.php";
class OrderController extends ShopFrontEndController
{
    public function __construct()
    {
        $this->controllerName     = 'product';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Đơn hàng';
        parent::__construct();
        $data = CatProductModel::all();
        $_SESSION['local'] = $local = Tinhthanhpho::all();

        $_SESSION['cat_product'] = $catps = data_tree1($data, 0);
    }
    public function completed(Request $request)
    {
        // if (Session::has('islogin')) {
        //     $id = Session::get('id');
        //     $customer = CustomerModel::find($id);
        // }
        // $mail = $request->input('email');
        // if (!empty($mail)) {
        //     CustomerModel::where('id', $id)->update([
        //         'email' => $mail
        //     ]);
        // }
        // CustomerModel::where('id', $id)->update([
        //     'gender' => $request->input('gender'),
        //     'name' => $request->input('name'),
        //     'phone' => $request->input('phone'),
        // ]);
        //return(Session::get('user')['user_id']);
        $order_id_last = OrderModel::latest('id')->first();
        if (OrderModel::latest('id')->first() == null) {
            $order_id_last['id'] = 0;
        }
        $year= getdate()['year'];
        $month = sprintf("%02d", getdate()['mon']);
        $day = sprintf("%02d", getdate()['mday']);
        $id_order = sprintf("%05d", $order_id_last['id'] + 1);
        $code_order='DHTD'.$year.$month.$day.$id_order;
        $total = 0;
        $qty = 0;
        $listm_id = [];
        $listm_qty = [];
        foreach ($request->session()->get('cart') as $item) {
            $total += $item['price'] * $item['qty'];
            $qty += $item['qty'];
            $listm_id[] = $item['id'];
            $listm_qty[] = (int)$item['qty'];
        }
        $list_id = implode(',', $listm_id);
        $list_qty = implode(',', $listm_qty);
        $wards = Xaphuongthitran::where('xaid', (int)$request->input('wards2'))->get();
        $ward = $wards[0]->name;
        $districts = Quanhuyen::where('maqh', (int)$request->input('district2'))->get();
        $district = $districts[0]->name;
        $local1s = Tinhthanhpho::where('matp', (int)$request->input('city2'))->get();
        $local1 = $local1s[0]->name;
        $local = $ward . ',' . $district . ',' . $local1;
        OrderModel::create([
            'code_order' =>  $code_order,
            //'customer_id' =>  11,
            'total' =>  $total,
            'qty_total' =>  $qty,
            'qty_per' =>  $list_qty,
            'product_id' =>  $list_id,
            'name' =>  $request->input('name2'),
            'phone' =>  $request->input('phone2'),
            'address' =>  $local,
            'address_detail' =>  $request->input('addressdetail2'),
            'delivery_form' =>  $request->input('local-re'),
            'request_invoice' =>  $request->input('req_export'),
            'status' => 'Đang xử lý',
            'status_control'=>'Chưa thanh toán'
        ]);
        return redirect()->route('fe.order.success', ['code' => $code_order]);
    }
    public function success($code)
    {
        $list_pr=[];$list_qty=[];
        $orders=OrderModel::where('code_order',$code)->get();
        $customer=CustomerModel::find($orders[0]->customer_id);

        $list_qty=explode(",", $orders[0]['qty_per']);
        $list_pr = explode(",", $orders[0]['product_id']);
        $ls_product_order=[];
        foreach($list_pr as $list_product){
            $ls_product_order[]=ProductModel::find($list_product);
        }
        return view($this->pathViewController . 'order_success',compact('customer','orders','list_qty','ls_product_order'));
    }
    public function test(){
        $id=99;
        $date = getdate();
        $year= getdate()['year'];
        $month = sprintf("%02d", getdate()['mon']);
        $day = sprintf("%02d", getdate()['mday']);
        $id=sprintf("%05d", $id);
        $code_order='DHTD'.$year.$month.$day.$id;
        return($code_order);
    }
}
