<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use Illuminate\Support\Facades\Config;
use App\Model\Shop\ProductModel;
use App\Model\Shop\Tinhthanhpho;
use App\Model\Shop\Cat_productModel;
use App\Model\Shop\CatProductModel;
include "app/Helpers/data_cat.php";
include "app/Helpers/data.php";
use App\Helpers\HttpClient;
class HomeController extends ShopFrontEndController
{
    public function __construct()
    {
        $this->controllerName     = 'home';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Trang chủ';
        parent::__construct();
        $data = CatProductModel::all();
        $_SESSION['local'] = $local = Tinhthanhpho::all();
        $_SESSION['cat_product'] = $catps = data_tree1($data, 0);
    }
    public function index()
    {
        $product_covids = ProductModel::all();

        return view($this->pathViewController . 'index',
                    compact('product_covids'));
    }
    public function ajaxcat3(Request $request)
    {
        $cats = CatProductModel::all();
        $data = $request->all();
        $id_cat2 = $request->id_cat2;
        $id_cat1 = CatProductModel::find($id_cat2)->parent_id;
        $slugcat1 = CatProductModel::find($id_cat1)->slug;
        $slugcat2 = CatProductModel::find($id_cat2)->slug;
        $list_idcat3 = [];
        foreach ($_SESSION['cat_product'] as $cat3) {
            if ($id_cat2 == $cat3['parent_id']) {
                $list_idcat3[] = $cat3['id'];
            }
        }
        $products = ProductModel::whereIn('cat_product_id', $list_idcat3)->inRandomOrder()->limit(4)->get();
        $list_cat = '';
        foreach ($_SESSION['cat_product'] as $item_submenu2) {
            if ($item_submenu2['parent_id'] == $id_cat2) {
                $list_cat .= list_cat2($slugcat1, $slugcat2, $item_submenu2);
            }
        }
        $list_product = '';
        if ($products->count() > 0) {
            $list_product .= list_productheader();
            foreach ($products as $product) {
                //$imgm = explode(",", $product['image']);
                $list_product .= list_productcontent($product);
            }
            $list_product .= list_productfooter();
        }
        $result = array(
            'list_cat' => $list_cat,
            'list_product' => $list_product,

        );
        return response()->json($result, 200);
    }
    public function ajaxcat1(Request $request)
    {
        $cats = CatProductModel::all();
        $data = $request->all();
        $id_cat1 = $request->id_cat1;
        $slugcat1 = CatProductModel::find($id_cat1)->slug;
        $temp = 0;
        $catcs2 = [];
        foreach ($cats as $cat2) {
            if ($cat2['parent_id'] == $id_cat1) {
                $catcs2[] = $cat2;
            }
        }
        $id_cat2 = $catcs2[0]->id;
        $slugcat2 = CatProductModel::find($id_cat2)->slug;
        $list_idcat3 = [];
        foreach ($_SESSION['cat_product'] as $cat3) {
            if ($id_cat2 == $cat3['parent_id']) {
                $list_idcat3[] = $cat3['id'];
            }
        }
         $products = ProductModel::whereIn('cat_product_id', $list_idcat3)->inRandomOrder()->limit(4)->get();
        $list_cat = '';
        foreach ($_SESSION['cat_product'] as $item_submenu2) {
            if ($item_submenu2['parent_id'] == $id_cat2) {
                $list_cat .= list_cat2($slugcat1, $slugcat2, $item_submenu2);
            }
        }
        $list_product = '';
        if ($products->count() > 0) {
            $list_product .= list_productheader();
            foreach ($products as $product) {
                $list_product .= list_productcontent($product);
            }
            $list_product .= list_productfooter();
        }
        $result = array(
            'list_cat' => $list_cat,
            'list_product' => $list_product,
            //'test'=> $products->count()
        );
        return response()->json($result, 200);
    }
}
