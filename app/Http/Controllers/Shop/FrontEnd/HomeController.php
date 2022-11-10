<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use Illuminate\Support\Facades\Config;
use App\Model\Shop\ProductModel;
use App\Model\Shop\UsersModel;
use App\Model\Shop\CatProductModel;
use App\Helpers\HttpClient;
class HomeController extends ShopFrontEndController
{
    public function __construct()
    {
        $this->controllerName     = 'home';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Trang chủ';
        parent::__construct();
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
    public function ajaxHoverCatLevel1(Request $request)
    {
        $cats = CatProductModel::all();
        $data = $request->all();
        $idCatLevel1 = $request->idCatLevel1;
        $itemCatCurent=(new CatProductModel())->getItem(['id'=>$idCatLevel1],['task'=>'get-item']);
        $slugCatLevel1=$itemCatCurent['slug'];
        $params['parent_id']=$itemCatCurent['id'];
        $listItemLevel2=(new CatProductModel())->listItems($params,['task'=>'frontend-list-items-by-parent-id']);
        $itemLevel2First=$listItemLevel2[0];
        $slugCatLevel2=$itemLevel2First['slug'];
        $params['parent_id']=$itemLevel2First['id'];
        $listItemLevel3=(new CatProductModel())->listItems($params,['task'=>'frontend-list-items-by-parent-id']);
        unset($params['parent_id']);
        $params['cat_product_id']=$itemLevel2First['id'];
        $params['limit']=4;
        $listProductCatLevel2=(new ProductModel())->listItems($params,['task'=>'frontend-list-items']);
        return view("$this->moduleName.block.child_submenu.ls_cat_level3_and_product",compact('listItemLevel3','listProductCatLevel2','slugCatLevel1','slugCatLevel2'));
    }
    public function ajaxHoverCatLevel2(Request $request)
    {
        $cats = CatProductModel::all();
        $data = $request->all();
        $idCatLevel2 = $request->idCatLevel2;
        $itemCatCurent=(new CatProductModel())->getItem(['id'=>$idCatLevel2],['task'=>'get-item']);
        $slugCatLevel2=$itemCatCurent['slug'];
        $itemCatParent=(new CatProductModel())->getItem(['parent_id'=>$itemCatCurent['parent_id']],['task'=>'get-item-parent']);
        $slugCatLevel1=$itemCatParent['slug'];
        $params['parent_id']=$idCatLevel2;
        $listItemLevel3=(new CatProductModel())->listItems($params,['task'=>'frontend-list-items-by-parent-id']);
        unset($params['parent_id']);
        $params['cat_product_id']=$idCatLevel2;
        $params['limit']=4;
        $listProductCatLevel2=(new ProductModel())->listItems($params,['task'=>'frontend-list-items']);
        return view("$this->moduleName.block.child_submenu.ls_cat_level3_and_product",compact('listItemLevel3','listProductCatLevel2','slugCatLevel1','slugCatLevel2'));
    }
    // public function ajaxlocal(Request $request)
    // {
    //     $data = $request->all();
    //     $maid = $request->maid;
    //     $output = '';
    //     $params = [];
    //     $list_store = '';
    //     $district_select = null;
    //     if ($data['action']) {
    //         $params['user_type_id'] = 4;
    //         if ($data['action'] == 'city3') {
    //             $params['province_id'] = $maid;
    //             $stores = (new UsersModel())->listItems($params, ['task' => 'list-store-select-province']);
    //             $province_select = (new ProvinceModel)->getItem(['id' => $maid], ['task' => 'get-item-full'])->name;
    //             $temp = count($stores);
    //             $list_store .= StrData::count_store($temp, $province_select, $district_select);
    //             $output .= '<option value="">--Chọn quận huyện--</option>';
    //             $itemsDistrict = (new DistrictModel())->listItems(['parentID' => $maid], ['task' => 'admin-list-items-in-selectbox']);
    //             foreach ($itemsDistrict as $key => $value) {
    //                 $output .= '<option value="' . $key . '">' . $value . '</option>';
    //             }
    //         }
    //         if ($data['action'] == 'district3') {
    //             $params['district_id'] = $maid;
    //             $district_select=(new DistrictModel)->getItem(['id' => $maid], ['task' => 'get-item-full'])->name;
    //             $province_select = (new DistrictModel)->getItem(['id' => $maid], ['task' => 'get-item-full'])->province->name;
    //             $stores = (new UsersModel())->listItems($params, ['task' => 'list-store-select-district']);
    //             $temp = count($stores);
    //             $list_store= StrData::count_store($temp, $province_select, $district_select);
    //         }
    //         foreach ($stores as $item) {
    //             $details = $item->details->pluck('value', 'user_field')->toArray();
    //             if ($details != null) {
    //                 if ($details['address'] != null) {
    //                     $wards = (new WardModel)->getItem(['id' => $details['ward_id']], ['task' => 'get-item-full']);
    //                     $ward = $wards->name;
    //                     $district = $wards->district->name;
    //                     $province = $wards->district->province->name;
    //                     $address_store = $details['address'] . ', ' . $ward . ', ' . $district . ', ' . $province;
    //                     $store_id = $item['user_id'];
    //                     $list_store .= StrData::list_store($store_id, $address_store);
    //                 }
    //             }
    //         }
    //     }
    //     $result = array(
    //         'list_district' => $output,
    //         'list_store' => $list_store,
    //         'test'=>$temp
    //     );
    //     return response()->json($result, 200);
    // }
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
