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
use App\Http\Requests\UserRequest as MainRequest;
use App\Model\Shop\UsersModel as MainModel;
use App\Model\Shop\ProvinceModel;
use App\Model\Shop\DistrictModel;
use App\Model\Shop\WardModel;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session as FacadesSession;

include "app/Helpers/data.php";
include_once "app/Helpers/data_cart.php";
class CartController extends ShopFrontEndController
{
    public function __construct()
    {
        $this->controllerName     = 'product';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Giỏ hàng';
        parent::__construct();
        $data = CatProductModel::all();
        $_SESSION['local'] = $local = Tinhthanhpho::all();
        $this->model = new MainModel();
        $_SESSION['cat_product'] = $catps = data_tree1($data, 0);
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
        $data = $request->all();
        $id = (int)$request->id_product;
        $qtyper = (int)$request->number_perp;
        $product = ProductModel::find($id);
        $image = $product->image;
        $row_Id = substr(md5(microtime()), rand(0, 26), 6);
        //$request->session()->forget('cart');
        $cart = $request->session()->get('cart');
        if ($cart == true) {
            $is_avai = 0;
            foreach ($cart as $key => $val) {
                if ($val['id'] == $id) {
                    $is_avai++;
                    $qty_prev = (int)$val['qty'];
                    $cart[$key]['qty'] = $qty_prev + $qtyper;
                }
            }
            if ($is_avai == 0) {
                $cart[] = array(
                    'rowId' => $row_Id,
                    'id' => (int)$id,
                    'name' => $product->name,
                    'price' => (int)$product->price,
                    'qty' => (int)$qtyper,
                    'image' => $image,
                    'unit' => $product->unit,
                );
                $request->session()->put('cart', $cart);
            }
        } else {
            $cart[] = array(
                'rowId' => $row_Id,
                'id' => (int)$id,
                'name' => $product->name,
                'price' => (int)$product->price,
                'qty' => (int)$qtyper,
                'image' => $image,
                'unit' => $product->unit,
            );
        }
        $request->session()->put('cart', $cart);

        $number_product = count($request->session()->get('cart'));
        $request->session()->flash('statuscart', notisuccess());
        $list_product = '';
        $list_cartload = '';
        $list_product_res='';
        $list_cartload .= list_cartloadhed($number_product);
        $list_product_res.=list_cart_resheader();
        foreach ($request->session()->get('cart') as $product) {
            $list_product .= list_product($product);
        }
        $list_cartload .= $list_product;
        $list_product_res.=$list_product;
        $list_cartload .= list_cartloadfoter();
        $list_product_res.=list_cart_resfooter();
        $result = array(
            'list_product' => $list_cartload,
            'list_product_res'=>$list_product_res,
            'number_product' => $number_product,
            'noti_success' => session('statuscart'),
            'rowId' => $request->session()->get('cart'),
        );
        return response()->json($result, 200);
    }
    public function changenp(Request $request)
    {
        $data = $request->all();
        $id = $request->id;
        $qty = $request->qty;
        $rowId = $request->rowId;
        $cart = $request->session()->get('cart');
        foreach ($cart as $key => $val) {
            if ($val['id'] == $id) {
                $qty_prev = (int)$val['qty'];
                $cart[$key]['qty'] = $qty;
                $qty_next=$qty;
                $price_next=$val['price'];
            }
        }
        $request->session()->put('cart', $cart);
        $total=0;
        foreach($request->session()->get('cart') as $item2){
            $total+=$item2['price']*$item2['qty'];
        }
        $numberp_cart = count($request->session()->get('cart'));
        $sub_total = number_format($price_next*$qty_next, 0, ',', '.');
        $totals = number_format($total, 0, ',', '.');
        $totalkm = number_format($total-10000, 0, ',', '.');

        $result = array(
            //'list_product' => $list_product,
            'number_product' => $qty,
            'numberp_cart' => $numberp_cart,
            'sub_total' => $sub_total . 'đ',
            'total' => $totals,
            'totalkm' => $totalkm,

        );
        return response()->json($result, 200);
    }
    public function delete(Request $request,$rowId)
    {
        $cart = Session::get('cart');
        foreach ($cart as $key => $item1) {
            if ($item1['rowId'] == $rowId) {
                unset($cart[$key]);
            }
        }
        $request->session()->put('cart', $cart);
        return redirect('/gio-hang');
    }
}
