<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use App\Model\Shop\Cat_productModel;
use App\Model\Shop\ProductModel;
use App\Model\Shop\Tinhthanhpho;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session as FacadesSession;

session_start();
include "app/Helper/data.php";
class CartController extends ShopFrontEndController
{
    public function __construct()
    {
        $this->controllerName     = 'product';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Giỏ hàng';
        parent::__construct();
        $data = Cat_productModel::all();
        $_SESSION['local'] = $local = Tinhthanhpho::all();
        
        $_SESSION['cat_product'] = $catps = data_tree1($data, 0);
    }

    public function cart_product()
    {
        return view($this->pathViewController . 'cart');
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
        $image = explode(",", $product->image);
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
                    'image' => $image[0],
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
                'image' => $image[0],
                'unit' => $product->unit,
            );
        }
        $request->session()->put('cart', $cart);

        $number_product = count($request->session()->get('cart'));
        $request->session()->flash('statuscart', '<p class="text-success notisucesscmn"><i class="fas fa-check"></i>Thêm thành công sản phẩm vào giỏ hàng</p>');
        $list_product = '';
        $list_cartload = '';
        $list_cartload .= '
                <div class="position-relative iconcartmenu">
                        <a href="' . route("fe.product.cart") . '" id="payment-link" class="">
                            <div class="clearfix icon_cart">
                                <div class="fl-left mr-2">
                                    <img style="width:32px" src="' . asset('images/shop/cart.png') . '">
                                </div>
                                <div class="fl-left pt-2">
                                    <p>Giỏ hàng</p>
                                </div>
                            </div>
                        </a>
                ';
        $list_cartload .= '
                        <span class="number_cartmenu">' . count($request->session()->get('cart')) . '</span>                
                        <div id="dropdown">
                            <div class="position-relative">
                                <span class="arrow-up"><i class="fas fa-sort-up"></i></span>
                                <p class="text-success notisucess1"></p>
                                <form action="" method="POST">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <ul class="listp-cartmini">
                ';
        foreach ($request->session()->get('cart') as $product) {
            $list_product .= '<li>
                <div class="d-flex">
                    <div title="" class="thumbperp">
                        <div class="rimg-center img-60">
                            <img src="' . asset('public/shop/uploads/images/product/' . $product['image']) . '">
                        </div>
                    </div>
                    <div class="infoperp">
                        <a href="" title="" class="nameprmn mb-1">' . $product['name'] . '</a>
                        <div class="clearfix">
                            <div class="fl-left">
                                <input type="text" maxlength="3" value="' . $product['qty'] . '" data-id="' . $product['id'] . '" data-rowId="' . $product['rowId'] . '" name="qty[' . $product['rowId'] . ']" class="numberperp numberperp' . $product['rowId'] . ' number-ajax">
                            </div>
                            <div class="fl-right">
                                <strong class="mb-0 priceperp">' . number_format($product['price'] * $product['qty'], 0, ',', '.') . 'đ</strong><span> | </span><span class="deleteperp">Xóa</span>
                            </div>
                        </div>
                    </div>
                </div>
            </li>';
        }
        $list_cartload .= $list_product;
        $list_cartload .= '
            </ul>
            </form>
            <div class="text-center"><a href="' . route("fe.product.cart") . '" class="viewcartmini">Xem giỏ hàng</a></div>
            </div>
        </div>
        </div>
            ';
        $result = array(
            'list_product' => $list_cartload,
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
