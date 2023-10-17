<?php
namespace App\Http\Controllers\Shop\FrontEnd;
use Illuminate\Http\Request;
use App\Model\Shop\CustomerModel;
use App\Model\Shop\OrderModel;
use App\Model\Shop\CatProductModel;
use App\Model\Shop\ProductModel;
use App\Http\Requests;
use App\Http\Requests\UserRequest as MainRequest;
use App\Model\Shop\OrderModel as MainModel;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use App\Model\Shop\DistrictModel;
use App\Model\Shop\WardModel;
use App\Model\Shop\WarehouseModel;
use App\Helpers\MyFunction;
use Session;
use DB;
use Illuminate\Support\Str;
class OrderController extends ShopFrontEndController
{
    public function __construct()
    {
        $this->controllerName     = 'order';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Đơn hàng';
        $this->model = new MainModel();
        parent::__construct();
    }
    public function list(){
        $params['status']='tat_ca';
        $params['user_id']='';
        if(Session::has('user')){
            $user_login=Session::get('user');
            $params['user_id']=$user_login->user_id;
        }
        $order=$this->model->listItems($params, ['task' => 'user-list-items-frontend']);
        return view($this->moduleName.'.pages.order.index',compact('order'));
    }
    public function ajaxFliter(Request $request){
        $data = $request->all();
        $params['user_id']='';
        if(Session::has('user')){
            $user_login=Session::get('user');
            $params['user_id']=$user_login->user_id;
        }
        $params['status']=$request->status;
        $order=$this->model->listItems($params, ['task' => 'user-list-items-frontend']);
        return view("$this->moduleName.pages.order.partial.product_order_frontend",compact('order'));
    }
    public function detail(Request $request){
        $data = $request->all();
        $params['id']=intval($request->id);
        $order_detail=$this->model->getItem($params, ['task' => 'get-item-frontend']);
        $info_buyer=json_decode($order_detail['buyer'], true);
        $address='';
        if($order_detail->delivery_method ==1){
            $warehouse_id=$order_detail['pharmacy']['warehouse_id'];
            $address=(new WarehouseModel())->getItem(['id'=>$warehouse_id],['task' => 'get-item-of-id'])->address;
        }else{
            $ward_detail=(new WardModel())->getItem(['id'=>$order_detail->receive['ward_id']],['task' => 'get-item-full']);
            $ward=$ward_detail['name'];$district=$ward_detail['district']['name'];$province=$ward_detail['district']['province']['name'];
            $address=$order_detail->receive['address'].', '.$ward.', '.$district.', '.$province;
        }
        return view("$this->moduleName.pages.order.child_index.detail_order",compact('order_detail','address'));
        //  $result = array(
        //      'test'=>$info_buyer
        //   );
        //   return response()->json($result, 200);
    }
    public function completed(Request $request)
    {
      //  if (!$request->ajax()) return view("errors." .  'notfound', []);
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'fail' => true,
                'errors' => $request->validator->errors()
            ]);
        }
        if ($request->method() == 'POST') {
            $params = $request->all();

            $task   = "frontend-save-item";
            $notify = "Đặt hàng thành công!";

            if ($this->model->saveItem($params, ['task' => $task])){
                $request->session()->put('app_notify', $notify);
                $cart = $request->session()->get('cart');
                unset($cart[$params['user_sell']]);
                $request->session()->put('cart', $cart);
                setcookie("cart", json_encode($cart),time() + config('myconfig.time_cookie'), "/", $_SERVER['SERVER_NAME']);
                $code_order=$this->model->getItem(null, ['task' => 'get-item-last'])['code_order'];
                //return redirect()->route('fe.order.success', ['code' => $code_order]);
                return response()->json([
                    'fail' => false,
                    'redirect_url' =>route("fe.order.success",['code' => $code_order]),
                    'message'      => $notify,
                ]);
            }
            $request->session()->put('app_notify', 'Có lỗi trong quá trình đặt hàng');
            return response()->json([
                'fail' => true,
                'redirect_url' => route("home"),
                'message'      => $notify,
            ]);
        }
    }
    public function success($code)
    {
        $order=$this->model->getItem(['code_order'=>$code], ['task' => 'get-item-frontend-code']);
        $info_product=$order['info_product'];
        $params['id']=$order->customer_id;
        $customer=json_decode($order->buyer, true);
        $address='';
        if($order->delivery_method ==1){
            $warehouse_id=$order['pharmacy']['warehouse_id']??'';
            $address=(new WarehouseModel())->getItem(['id'=>$warehouse_id],['task' => 'get-item-of-id'])->address??'';
        }else{
            $ward_detail=(new WardModel())->getItem(['id'=>$order->receive['ward_id']],['task' => 'get-item-full']);
            $ward=$ward_detail['name'];$district=$ward_detail['district']['name'];$province=$ward_detail['district']['province']['name'];
            $address=$order->receive['address'].', '.$ward.', '.$district.', '.$province;
        }
        return view($this->pathViewController . 'order_success',compact('customer','order','info_product','address'));
    }
}
