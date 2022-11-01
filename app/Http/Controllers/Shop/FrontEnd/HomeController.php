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
    public function index(Request $request)
    {
        $product_selling = (new ProductModel())->listItems(null, ['task' => 'frontend-list-items']);
        $product_covid=(new ProductModel())->listItems(['type'=>'hau_covid','limit'=>10], ['task' => 'frontend-list-items-featurer']);
        $product=(new ProductModel())->listItems(['type'=>'tre_em','limit'=>10], ['task' => 'frontend-list-items-featurer']);
        return view(
            $this->pathViewController . 'index',
            compact('product_selling','product_covid','product')
        );
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
        return view("$this->moduleName.templates.menu_cart",compact('itemsCart'));
        //return response()->json($result, 200);
    }
    public function ajaxlocal(Request $request)
    {
        $data = $request->all();
        $maid = $request->maid;
        $output = '';
        $params = [];
        $list_store = '';
        $district_select = null;
        if ($data['action']) {
            $params['user_type_id'] = 4;
            if ($data['action'] == 'city3') {
                $params['province_id'] = $maid;
                $stores = (new UsersModel())->listItems($params, ['task' => 'list-store-select-province']);
                $province_select = (new ProvinceModel)->getItem(['id' => $maid], ['task' => 'get-item-full'])->name;
                $temp = count($stores);
                $list_store .= StrData::count_store($temp, $province_select, $district_select);
                $output .= '<option value="">--Chọn quận huyện--</option>';
                $itemsDistrict = (new DistrictModel())->listItems(['parentID' => $maid], ['task' => 'admin-list-items-in-selectbox']);
                foreach ($itemsDistrict as $key => $value) {
                    $output .= '<option value="' . $key . '">' . $value . '</option>';
                }
            }
            if ($data['action'] == 'district3') {
                $params['district_id'] = $maid;
                $district_select=(new DistrictModel)->getItem(['id' => $maid], ['task' => 'get-item-full'])->name;
                $province_select = (new DistrictModel)->getItem(['id' => $maid], ['task' => 'get-item-full'])->province->name;
                $stores = (new UsersModel())->listItems($params, ['task' => 'list-store-select-district']);
                $temp = count($stores);
                $list_store= StrData::count_store($temp, $province_select, $district_select);
            }
            foreach ($stores as $item) {
                $details = $item->details->pluck('value', 'user_field')->toArray();
                if ($details != null) {
                    if ($details['address'] != null) {
                        $wards = (new WardModel)->getItem(['id' => $details['ward_id']], ['task' => 'get-item-full']);
                        $ward = $wards->name;
                        $district = $wards->district->name;
                        $province = $wards->district->province->name;
                        $address_store = $details['address'] . ', ' . $ward . ', ' . $district . ', ' . $province;
                        $store_id = $item['user_id'];
                        $list_store .= StrData::list_store($store_id, $address_store);
                    }
                }
            }
        }
        $result = array(
            'list_district' => $output,
            'list_store' => $list_store,
            'test'=>$temp
        );
        return response()->json($result, 200);
    }
    public function ajax_filter(Request $request){
        $data = $request->all();
        $ls_product='';
        $object_product = $request->object_product;
        $params['type']=$object_product;$params['limit']=10;
        $product=(new ProductModel())->listItems($params, ['task' => 'frontend-list-items-featurer']);
        $result = array(  
            'test'=>$object_product
        );
        return view("$this->pathViewController.partial.product_object",compact('product'));
        return response()->json($result, 200);
    }
}
