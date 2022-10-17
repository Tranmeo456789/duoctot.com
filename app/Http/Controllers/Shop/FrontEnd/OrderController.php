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
use App\Helpers\MyFunction;
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
                return response()->json([
                    'fail' => false,
                    'redirect_url' => route("home"),
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
