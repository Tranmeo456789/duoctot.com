<?php

namespace App\Http\Controllers\Shop\FrontEnd;
use Illuminate\Http\Request;
use App\Model\Shop\CustomerModel;
use App\Model\Shop\OrderModel;
use App\Model\Shop\CatProductModel;
use App\Model\Shop\ProductModel;
use App\Http\Requests;
use App\Http\Requests\UserRequest as MainRequest;
use App\Model\Shop\UsersModel as MainModel;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use App\Model\Shop\DistrictModel;
use App\Model\Shop\WardModel;
use Session;
use DB;
use Illuminate\Support\Str;
include "app/Helpers/data.php";
class OrderController extends ShopFrontEndController
{
   
    public function __construct()
    {
        $this->controllerName     = 'product';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Đơn hàng';
        $this->model = new MainModel();
        parent::__construct();
        $data = CatProductModel::all();
        $_SESSION['cat_product'] = $catps = data_tree1($data, 0);
    }
    public function completed(Request $request)
    {  
        $session = $request->session();
        $item = [];$params=[];
        if ($session->has('user')){
            $item = $this->model->getItem(['user_id'=>$session->get('user.user_id')],['task' => 'get-item']);
            $details = $item->details->pluck('value','user_field')->toArray()??[];
            $params['user_id']=$item->user_id;
        }
        $wards=(new WardModel)->getItem(['id'=>(int)$request->input('wards2')],['task' => 'get-item-full']);
        $ward=$wards->name;
        $district=$wards->district->name;
        $local1=$wards->district->province->name;
        $local = $ward . ',' . $district . ',' . $local1;
       
        $order_id_last = DB::table('orders')->max('id');
        if (OrderModel::latest('id')->first() == null) {
            $order_id_last['id'] = 0;
        }
        $year= getdate()['year'];
        $month = sprintf("%02d", getdate()['mon']);
        $day = sprintf("%02d", getdate()['mday']);
        $id_order = sprintf("%05d", $order_id_last + 1);
        $code_order='DHTD'.$year.$month.$day.$id_order;      
         $total = 0;
         $qty = 0;
         $info_product=[];$product_item=[];
        foreach ($request->session()->get('cart') as $item) {
            $total += $item['price'] * $item['qty'];
            $price=$item['price'];$qty_per=$item['qty'];$sub_total=$price*$qty_per;$image=$item['image'];$name=$item['name'];$unit=(ProductModel::find($item['id']))->unitProduct->name;
            $code=(ProductModel::find($item['id']))->code;
            $qty += $item['qty'];
            $product_item['name']=$name;
            $product_item['qty_per']=$qty_per;
            $product_item['price']=$price;
            $product_item['sub_total']=$sub_total;
            $product_item['unit']=$unit;
            $product_item['image']=$image;
            $product_item['code']=$code;
            $info_product[$item['id']]= json_encode($product_item);
        }    
        $isCustomerExist = (new CustomerModel)->getItem($params, ['task' => 'get-item-userId']);
        $customer_id=$isCustomerExist->id;
        if(!$isCustomerExist){
            DB::table('customers')->insert([
                'gender' => $request->input('gender'),
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'user_id'=>$item->user_id,
                'address'=>$local,
                'address_detail'=>$request->input('addressdetail2'),
            ]);
            $customer_id=DB::table('customers')->max('id');
        }       
        OrderModel::insert([
            'code_order' =>  $code_order,
            'customer_id' =>  $customer_id,
            'total' =>  $total,
            'info_product' => json_encode($info_product),
            'qty_total' =>  $qty,
            'name' =>  $request->input('name2'),
            'phone' =>  $request->input('phone2'),
            'address' =>  $local,
            'address_detail' =>  $request->input('addressdetail2'),
            'delivery_form' =>  $request->input('local-re'),
            'request_invoice' =>  $request->input('req_export'),
            'status' => 'Đang xử lý',
            'status_control'=>'Chưa thanh toán',
            'created_at'=>date('Y-m-d')
        ]);
        return redirect()->route('fe.order.success', ['code' => $code_order]);
    }
    public function success($code)
    {
        $orders=OrderModel::where('code_order',$code)->get();
        $order=$orders[0];
        $params['id']=$orders[0]->customer_id;
        $customer=(new CustomerModel)->getItem($params, ['task' => 'get-item']);
        $info_product=json_decode($order->info_product,true);
        return view($this->pathViewController . 'order_success',compact('customer','orders','info_product'));
    }
}
