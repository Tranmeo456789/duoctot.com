<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use Illuminate\Support\Facades\Config;
use App\Model\Shop\Cat_productModel;
use App\Model\Shop\ProductModel;
use App\Model\Shop\Tinhthanhpho;
include "app/Helper/data.php";
class HomeController extends ShopFrontEndController
{
    public function __construct()
    {
        $this->controllerName     = 'home';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Trang chủ';
        parent::__construct();
        $data = Cat_productModel::all();
        $_SESSION['local'] = $local = Tinhthanhpho::all();
        $_SESSION['cat_product'] = $catps = data_tree1($data, 0);
    }
    public function index()
    {
        $product_covids = ProductModel::inRandomOrder()->limit(8)->get();
        return view($this->pathViewController . 'index',compact('product_covids'));
    }
    public function ajaxcat3(Request $request)
    {
        $cats = Cat_productModel::all();
        $data = $request->all();
        $id_cat2 = $request->id_cat2;
        $id_cat1 = Cat_productModel::find($id_cat2)->parent_id;
        $slugcat1 = Cat_productModel::find($id_cat1)->slug;
        $slugcat2 = Cat_productModel::find($id_cat2)->slug;
        $list_idcat3 = [];
        foreach ($_SESSION['cat_product'] as $cat3) {
            if ($id_cat2 == $cat3['parent_id']) {
                $list_idcat3[] = $cat3['id'];
            }
        }
        $products = ProductModel::whereIn('cat_id', $list_idcat3)->inRandomOrder()->limit(4)->get();
        $list_cat = '';
        foreach ($_SESSION['cat_product'] as $item_submenu2) {
            if ($item_submenu2['parent_id'] == $id_cat2) {
                $list_cat .= '<li>
                    <a href="' . route("fe.cat3", [$slugcat1, $slugcat2, $item_submenu2->slug]) . '">
                        <div class="item_cat4 d-flex">
                            <div class="aimg rimg-centerx mr-1">
                                <img src="' . asset('public/shop/uploads/images/product/' . $item_submenu2['image']) . '">
                            </div>
                            <div class="align-self-center"><span>' . $item_submenu2['name'] . '</span></div>
                        </div>
                    </a>
                </li>';
            }
        }
        $list_product = '';
        if ($products->count() > 0) {
            $list_product .= '<div class="title-product-out d-flex justify-content-between my-3">
                                <div class="title_cathd">
                                    <h1>Sản phẩm nổi bật</h1>
                                    <img src="' . asset('images/shop/lua4.png') . '">
                                </div>
                                <a href="">Xem tất cả</a>
                            </div>';
            $list_product .= '<div class="productimenu">
                                <ul>
                                    <div class="row">';
            foreach ($products as $product) {
                $imgm=explode(",", $product['image']);
                $list_product .= '<div class="col-3 pl-3">
                <li>
                    <div class="bimgm"><a href="'.route("fe.product.detail",$product->id).'"><img src="' . asset('public/shop/uploads/images/product/' . $imgm[0]) . '" alt=""></a></div>
                    <div class="">
                        <a href="'.route("fe.product.detail",$product->id).'" class="truncate2">'.$product->name.'</a>
                        <h3 class="my-2">'.number_format($product['price'], 0, "" ,"." ).'đ/'.$product['unit'].'</h3>
                    </div>
                </li>
            </div>';
            }
            $list_product .= '</div>
                            </ul>
                        </div>';
        }
        $result = array(
            'list_cat' => $list_cat,
            'list_product' => $list_product,

        );
        return response()->json($result, 200);
    }
    public function ajaxcat1(Request $request)
    {
        $cats = Cat_productModel::all();
        $data = $request->all();
        $id_cat1 = $request->id_cat1;
        $slugcat1 = Cat_productModel::find($id_cat1)->slug;
        $temp = 0;
        $catcs2 = [];
        foreach ($cats as $cat2) {
            if ($cat2['parent_id'] == $id_cat1) {
                $catcs2[] = $cat2;
            }
        }
        $id_cat2 = $catcs2[0]->id;
        $slugcat2 = Cat_productModel::find($id_cat2)->slug;
        $list_idcat3 = [];
        foreach ($_SESSION['cat_product'] as $cat3) {
            if ($id_cat2 == $cat3['parent_id']) {
                $list_idcat3[] = $cat3['id'];
            }
        }
        $products = ProductModel::whereIn('cat_id', $list_idcat3)->inRandomOrder()->limit(4)->get();
        $list_cat = '';
        foreach ($_SESSION['cat_product'] as $item_submenu2) {
            if ($item_submenu2['parent_id'] == $id_cat2) {
                $list_cat .= '<li>
                    <a href="' . route("fe.cat3", [$slugcat1, $slugcat2, $item_submenu2->slug]) . '">
                        <div class="item_cat4 d-flex">
                            <div class="aimg rimg-centerx mr-1">
                                <img src="' . asset('public/shop/uploads/images/product/' . $item_submenu2['image']) . '">
                            </div>
                            <div class="align-self-center"><span>' . $item_submenu2['name'] . '</span></div>
                        </div>
                    </a>
                </li>';
            }
        }
        $list_product = '';
        if ($products->count() > 0) {
            $list_product .= '<div class="title-product-out d-flex justify-content-between my-3">
                                <div class="title_cathd">
                                    <h1>Sản phẩm nổi bật</h1>
                                    <img src="' . asset('images/shop/lua4.png') . '">
                                </div>
                                <a href="">Xem tất cả</a>
                            </div>';
            $list_product .= '<div class="productimenu">
                                <ul>
                                    <div class="row">';
            foreach ($products as $product) {
                $imgm=explode(",", $product['image']);
                $list_product .= '<div class="col-3 pl-3">
                <li>
                    <div class="bimgm"><a href=""><img src="' . asset('public/shop/uploads/images/product/' . $imgm[0]) . '" alt=""></a></div>
                    <div class="">
                        <a href="" class="truncate2">'.$product->name.'</a>
                        <h3 class="my-2">'.number_format($product['price'], 0, "" ,"." ).'đ/'.$product['unit'].'</h3>
                    </div>
                </li>
            </div>';
            }
            $list_product .= '</div>
                            </ul>
                        </div>';
        }
        $result = array(
            'list_cat' => $list_cat,
            'list_product' => $list_product,
        );
        return response()->json($result, 200);
    }
}
