<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use App\Model\Shop\Cat_productModel;
use App\Model\Shop\CatProductModel;
use App\Model\Shop\CustomerModel;
use App\Model\Shop\ProductModel;
use App\Model\Shop\Tinhthanhpho;
use App\Model\Shop\ProvinceModel;
use App\Model\Shop\DistrictModel;
use App\Model\Shop\WardModel;
use App\Model\Shop\UsersModel;

include "app/Helpers/data.php";
include_once "app/Helpers/data_cart.php";
class CartController extends ShopFrontEndController
{
    public function __construct()
    {
        $this->controllerName     = 'cart';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Giỏ hàng';
        parent::__construct();
        $data = CatProductModel::all();
        $_SESSION['local'] = $local = Tinhthanhpho::all();
        $_SESSION['cat_product'] = $catps = data_tree1($data, 0);
    }
    public function view(Request $request)
    {
        $params['user_sell'] = intval($request->user_sell);
        $session = $request->session();

        $user = [];
        $details =[];
        if ($session->has('user')){
            $user = $this->model->getItem(['user_id'=>$session->get('user.user_id')],['task' => 'get-item']);
            $details = $item->details->pluck('value','user_field')->toArray()??[];
        }
        $itemsProvince = (new ProvinceModel())->listItems(null,['task'=>'admin-list-items-in-selectbox']);
        $params['province_id'] = (isset($details['province_id']) && ($details['province_id']!=0))?$details['province_id']:((isset($user->province_id) && ($user->province_id != 0)) ? $user->province_id:0);
        $itemsDistrict = [];
        if ($params['province_id']  != 0){
            $itemsDistrict = (new DistrictModel())->listItems(['parentID' => $params['province_id']],
                                                                ['task'=>'admin-list-items-in-selectbox']);
        }
        $params['district_id'] = (isset($details['district_id']) && ($details['district_id'] != 0))?$details['district_id']:((isset($user->district_id) && ($user->district_id != 0)) ? $user->district_id:0);
        $itemsWard = [];
        if ($params['district_id']  != 0){
            $itemsWard = (new WardModel())->listItems(['parentID' => $params['district_id']],
                                                                ['task'=>'admin-list-items-in-selectbox']);
        }
        if (!$session->has("cart." . $params['user_sell']) && isset($_COOKIE['cart'])){
            $cart = json_decode($_COOKIE['cart'], true);
            $session->put("cart", $cart);
        }

        $item = $session->has("cart." . $params['user_sell'])?$session->get("cart." . $params['user_sell']):[];
        return view($this->pathViewController . 'view',
               compact('item','user','itemsProvince' ,'itemsDistrict','itemsWard','details'));
    }
    public function cart_product(Request $request)
    {
        $session = $request->session();
        $item = [];
        if ($session->has('user')){
            $item = $this->model->getItem(['user_id'=>$session->get('user.user_id')],['task' => 'get-item']);
            $details = $item->details->pluck('value','user_field')->toArray()??[];
        }
        $itemsProvince = (new ProvinceModel())->listItems(null,['task'=>'admin-list-items-in-selectbox']);
        $params['province_id'] = (isset($details['province_id']) && ($details['province_id']!=0))?$details['province_id']:((isset($item->province_id) && ($item->province_id != 0)) ? $item->province_id:0);
        $itemsDistrict = [];
        if ($params['province_id']  != 0){
            $itemsDistrict = (new DistrictModel())->listItems(['parentID' => $params['province_id']],
                                                                ['task'=>'admin-list-items-in-selectbox']);
        }
        $params['district_id'] = (isset($details['district_id']) && ($details['district_id'] != 0))?$details['district_id']:((isset($item->district_id) && ($item->district_id != 0)) ? $item->district_id:0);
        $itemsWard = [];
        if ($params['district_id']  != 0){
            $itemsWard = (new WardModel())->listItems(['parentID' => $params['district_id']],
                                                                ['task'=>'admin-list-items-in-selectbox']);
        }
        $citys=Tinhthanhpho::all();
        if ($session->has('user')){
            return view($this->pathViewController . 'cart',compact('itemsProvince' ,'itemsDistrict','itemsWard','item','details','citys'));
        }

        return view($this->pathViewController . 'cart',compact('itemsProvince','itemsDistrict','itemsWard','citys'));
    }
    public function cart_null()
    {
        return view($this->pathViewController . 'cart_null');
    }
    public function pay_home()
    {
        return view($this->pathViewController . 'cart_pay_home');
    }
    public function pay_shop()
    {
        return view($this->pathViewController . 'cart_pay_shop');
    }

    public function addproduct(Request $request)
    {

        $id = intval($request->product_id);
        $quantity = intval($request->quantity);
        $user_sell = intval($request->user_sell);
        $product = ProductModel::find($id);
        $image = $product->image;
        $cart = $request->session()->has('cart')?$request->session()->get('cart'):[];
        if (!isset($cart[$user_sell]))  {
            $cart[$user_sell]['user_sell'] = $user_sell;
            $cart[$user_sell]['name'] = (new UsersModel())->getItem(['user_id'=>$user_sell],['task'=>'get-item'])->fullname;
            $cart[$user_sell]['total_product'] = 0;
            $cart[$user_sell]['total']=0;
        }
        $cart[$user_sell]['total_product'] += $quantity;
        if (isset($cart[$user_sell]['product'][$id])){
            $cart[$user_sell]['product'][$id]['quantity'] += $quantity;
            $cart[$user_sell]['total'] =  $cart[$user_sell]['total'] -  $cart[$user_sell]['product'][$id]['total_money'] +  $product->price * $quantity;
            $cart[$user_sell]['product'][$id]['total_money'] = $product->price * $quantity;
        }else{
            $cart[$user_sell]['product'][$id] = [
                'product_id' => $id,
                'name' => $product->name,
                'price' => $product->price,
                'total_money' => $product->price * $quantity,
                'quantity' => $quantity,
                'image' => $image,
                'unit_id' => $product->unit_id,
            ];
            $cart[$user_sell]['total'] += $product->price * $quantity;
        }

        $request->session()->put('cart', $cart);
        setcookie("cart", json_encode($cart),time() + config('myconfig.time_cookie'), "/", $_SERVER['SERVER_NAME']);
        // echo '<pre>';
        // print_r($_COOKIE['cart']);
        // echo '</pre>';
        // die();
        // if ($cart == true) {
        //     $is_avai = 0;
        //     foreach ($cart as $key => $val) {
        //         if ($val['id'] == $id) {
        //             $is_avai++;
        //             $qty_prev = (int)$val['qty'];
        //             $cart[$key]['qty'] = $qty_prev + $qtyper;
        //         }
        //     }
        //     if ($is_avai == 0) {
        //         $cart[] = array(
        //             'rowId' => $row_Id,
        //             'id' => (int)$id,
        //             'name' => $product->name,
        //             'price' => (int)$product->price,
        //             'qty' => (int)$qtyper,
        //             'image' => $image,
        //             'unit' => $product->unit,
        //         );
        //         $request->session()->put('cart', $cart);
        //     }
        // } else {
        //     $cart[] = array(
        //         'rowId' => $row_Id,
        //         'id' => (int)$id,
        //         'name' => $product->name,
        //         'price' => (int)$product->price,
        //         'qty' => (int)$qtyper,
        //         'image' => $image,
        //         'unit' => $product->unit,
        //     );
        // }
        //

        // // \Cookie::queue(\Cookie::make('cart',$cart, 60));
        // // $request->cookie->put('cart', $cart);
        // $nofify = 'Thêm sản phẩm vào giỏ hàng thành công';
        // $total_product = array_sum(array_column($cart,'qty'));
        // $request->session()->push('app_notify', 'Thêm sản phẩm vào giỏ hàng thành công');
        // $list_product = '';
        // $list_cartload = '';
        // $list_product_res='';
        // $list_cartload .= list_cartloadhed($number_product);
        // $list_product_res.=list_cart_resheader();
        // foreach ($request->session()->get('cart') as $product) {
        //     $list_product .= list_product($product);
        // }
        // $list_cartload .= $list_product;
        // $list_product_res.=$list_product;
        // $list_cartload .= list_cartloadfoter();
        // $list_product_res.=list_cart_resfooter();
        // $result = array(
        //     'list_product' => $list_cartload,
        //     'list_product_res'=>$list_product_res,
        //     'number_product' => $number_product,
        //     'noti_success' => session('statuscart'),
        //     'rowId' => $request->session()->get('cart'),
        //     'success' =>  $nofify
        // );

        // return response()->withCookie('cart',$cart, 60)->json($result, 200);
        $result = [
            'message' => "Đã thêm sản phẩm thành công"
        ];
        return response()->json($result, 200);
    }
    public function changeQuatity(Request $request)
    {
        $id = intval($request->id);
        $quantity = intval($request->quantity);
        $user_sell = intval($request->user_sell);
        $cart = $request->session()->get('cart');
        $cart[$user_sell]['total_product'] = $cart[$user_sell]['total_product'] - $cart[$user_sell]['product'][$id]['quantity'] +  $quantity;
        $cart[$user_sell]['product'][$id]['quantity'] =  $quantity;
        $cart[$user_sell]['product'][$id]['total_money'] = $cart[$user_sell]['product'][$id]['price'] * $quantity;
        $request->session()->put('cart', $cart);
        setcookie("cart", json_encode($cart), time() + config('myconfig.time_cookie'), "/", $_SERVER['SERVER_NAME']);
        return response()->json($cart[$user_sell], 200);
    }
    public function delete(Request $request)
    {
        $cart = $request->session()->get('cart');
        $id = intval($request->id);
        $user_sell = intval($request->user_sell);
        $product = $cart[$user_sell]['product'][$id];
        $cart[$user_sell]['total_product'] =    $cart[$user_sell]['total'] - $product['quantity'];
        $cart[$user_sell]['total'] =    $cart[$user_sell]['total'] - $product['total_money'];
        unset($cart[$user_sell]['product'][$id]);
        if (count($cart[$user_sell]['product']) == 0){
            unset($cart[$user_sell]);
            $request->session()->forget('cart');
        }else{
            $request->session()->put('cart', $cart);
            setcookie("cart", json_encode($cart), time() + config('myconfig.time_cookie'), "/", $_SERVER['SERVER_NAME']);
        }

        $result = [
            'message' => "Đã xóa sản phẩm thành công"
        ];
        return response()->json($result, 200);
    }
}
