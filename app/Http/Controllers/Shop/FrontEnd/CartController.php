<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use App\Model\Shop\CatProductModel;
use App\Model\Shop\ProductModel;
use App\Model\Shop\ProvinceModel;
use App\Model\Shop\DistrictModel;
use App\Model\Shop\WardModel;
use App\Model\Shop\UsersModel;
use App\Model\Shop\WarehouseModel;
class CartController extends ShopFrontEndController
{
    public function __construct()
    {
        $this->controllerName     = 'cart';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Giỏ hàng';
        parent::__construct();

    }
    public function view(Request $request)
    {
        $params['user_sell'] = intval($request->user_sell);
        $session = $request->session();
        $user = [];
        $details =[];
        if ($session->has('user')){
            $user = (new UsersModel())->getItem(['user_id'=>$session->get('user.user_id')],['task' => 'get-item']);
            $details = $user->detailValues->pluck('value','user_field')->toArray()??[];
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
        $itemsStore = (new WarehouseModel())->listItems(['user_id'=>$params['user_sell']],['task' => 'frontend-list-items']);
        return view($this->pathViewController . 'view',
               compact('item','user','itemsProvince' ,'itemsDistrict','itemsWard','details','itemsStore'));
    }
    public function cartFull(Request $request)
    {

        return view($this->pathViewController . 'cart_full');
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
        $result = [
            'message' => "Đã thêm sản phẩm thành công"
        ];
        $itemsCart = $cart;

        return view("$this->moduleName.templates.menu_cart",compact('itemsCart'));
       // return response()->json($result, 200);
    }
    public function changeQuatity(Request $request)
    {
        $id = intval($request->id);
        $quantity = intval($request->quantity);
        $user_sell = intval($request->user_sell);
        $cart = $request->session()->get('cart');
        $cart[$user_sell]['total_product'] = $cart[$user_sell]['total_product'] - $cart[$user_sell]['product'][$id]['quantity'] +  $quantity;
        $cart[$user_sell]['product'][$id]['quantity'] =  $quantity;
        $cart[$user_sell]['total'] =   $cart[$user_sell]['total']  -  $cart[$user_sell]['product'][$id]['total_money'] + $cart[$user_sell]['product'][$id]['price'] * $quantity;
        $cart[$user_sell]['product'][$id]['total_money'] = $cart[$user_sell]['product'][$id]['price'] * $quantity;
        $request->session()->put('cart', $cart);
        setcookie("cart", json_encode($cart), time() + config('myconfig.time_cookie'), "/", $_SERVER['SERVER_NAME']);
        return response()->json($cart[$user_sell], 200);
        //    $result = array(
        //       'test'=>$cart[$user_sell]
        //    );
        //    return response()->json($result, 200);
    }
    public function delete(Request $request)
    {
        $cart = $request->session()->get('cart');
        $id = intval($request->id);
        $user_sell = intval($request->user_sell);
        $product = $cart[$user_sell]['product'][$id];
        $cart[$user_sell]['total_product'] =    $cart[$user_sell]['total_product'] - $product['quantity'];
        $cart[$user_sell]['total'] =    $cart[$user_sell]['total'] - $product['total_money'];
        unset($cart[$user_sell]['product'][$id]);
        if (count($cart[$user_sell]['product']) == 0){
            unset($cart[$user_sell]);
        }
        $request->session()->put('cart', $cart);

        if (empty($cart)){
            setcookie("cart",null, time() -3600, "/", $_SERVER['SERVER_NAME']);
        }else{
            setcookie("cart", json_encode($cart), time() + config('myconfig.time_cookie'), "/", $_SERVER['SERVER_NAME']);
        }
        return redirect()->back();
        $result = [
            'redirect_url' =>route("fe.product.viewcart",['user_sell' => $user_sell]),
        ];
        return response()->json($result, 200);
    }
}
