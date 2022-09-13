<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use App\Model\Shop\Cat_productModel;
use App\Model\Shop\ProductModel;
use App\Model\Shop\Tinhthanhpho;
use Gloudemans\Shoppingcart\Facades\Cart;

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
        function data_tree1($data, $parent_id = 0, $level = 0)
        {
            $result = [];
            foreach ($data as $item) {
                if ($parent_id == $item['parent_id']) {
                    $item['level'] = $level;
                    $result[] = $item;
                    $child = data_tree1($data, $item['id'], $level + 1);
                    $result = array_merge($result, $child);
                }
            }
            return $result;
        }
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
        $id = $request->id_product;
        $qtyper = $request->number_perp;
        $product = ProductModel::find($id);
        $image = explode(",", $product->image);
        Cart::add([
            'id' => $id,
            'name' => $product->name,
            'qty' => $qtyper,
            'price' => $product->price,
            'options' => ['image' => $image[0], 'unit' => $product->unit],
        ]);
        $number_product = Cart::content()->count();
        $request->session()->flash('statuscart', '<p class="text-success notisucesscmn"><i class="fas fa-check"></i>Thêm thành công sản phẩm vào giỏ hàng</p>');
        $list_product = '';
        $list_cartload = '';
        $list_cartload .= '
            <div class="position-relative iconcartmenu">
                    <a href="' . route("fe.product.cart") . '" title="" id="payment-link" class="">
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
                    <span class="number_cartmenu">' . Cart::content()->count() . '</span>                
                    <div id="dropdown">
                        <div class="position-relative">
                            <span class="arrow-up"><i class="fas fa-sort-up"></i></span>
                            <p class="text-success notisucess1"></p>
                            <form action="" method="POST">
                                '.csrf_field().'
                                <ul class="listp-cartmini">
            ';
        foreach (Cart::content() as $product) {
            $imgm = explode(",", $product->options->image);
            $list_product .= '<li>
            <div class="d-flex">
                <div title="" class="thumbperp">
                    <div class="rimg-center img-60">
                        <img src="' . asset('public/shop/uploads/images/product/' . $imgm[0]) . '">
                    </div>
                </div>
                <div class="infoperp">
                    <a href="" title="" class="nameprmn mb-1">' . $product->name . '</a>
                    <div class="clearfix">
                        <div class="fl-left">
                            <input type="text" maxlength="3" value="' . $product->qty . '" data-id="' . $product->id . '" data-rowId="' . $product->rowId . '" name="qty[' . $product->rowId . ']" class="numberperp numberperp' . $product->rowId . ' number-ajax">
                        </div>
                        <div class="fl-right">
                            <strong class="mb-0 priceperp">' . number_format($product->price * $product->qty, 0, ',', '.') . 'đ</strong><span> | </span><span class="deleteperp">Xóa</span>
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

        );
        return response()->json($result, 200);
    }
    public function changenp(Request $request)
    {
        $data = $request->all();
        $id = $request->id;
        //$item=Product::find($id);
        $qty = $request->qty;
        $rowId = $request->rowId;
        Cart::update($rowId, $qty);
        $numberp_cart = Cart::content()->count();
        $sub_total = number_format(Cart::content()[$rowId]->total, 0, ',', '.');
        $total = number_format(Cart::total(), 0, ',', '.');
        $totalkm = number_format(Cart::total() - 10000, 0, ',', '.');
        // $list_product = '';
        //foreach (Cart::content() as $product) {
        // $imgm = explode(",", $product->options->image);
        //     $list_product .= '<li>
        //     <div class="d-flex">
        //         <div title="" class="thumbperp">
        //             <div class="rimg-center img-60">
        //                 <img src="' . asset('public/shop/uploads/images/product/' . $imgm[0]) . '">
        //             </div>
        //         </div>
        //         <div class="infoperp">
        //             <a href="" title="" class="nameprmn mb-1">' . $product->name . '</a>
        //             <div class="clearfix">
        //                 <div class="fl-left">
        //                     <input type="text" maxlength="3" value="' . $product->qty . '" data-id="'.$product->id.'" data-rowId="'.$product->rowId.'" name="qty['.$product->rowId.']"" class="numberperp number-ajax">
        //                 </div>
        //                 <div class="fl-right">
        //                     <strong class="mb-0 priceperp price-new'.$product->id.'">' . number_format($product->price*$product->qty, 0, ',', '.') . 'đ</strong><span> | </span><span class="deleteperp">Xóa</span>
        //                 </div>
        //             </div>
        //         </div>
        //     </div>
        // </li>';
        //}
        $result = array(
            //'list_product' => $list_product,
            'number_product' => $qty,
            'numberp_cart' => $numberp_cart,
            'sub_total' => $sub_total . 'đ',
            'total' => $total,
            'totalkm' => $totalkm,

        );
        return response()->json($result, 200);
    }
    public function delete($rowId){
        Cart::remove($rowId);
        return redirect('/gio-hang');
    }
}
