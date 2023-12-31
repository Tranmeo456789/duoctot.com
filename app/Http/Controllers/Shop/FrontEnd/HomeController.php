<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use Illuminate\Support\Facades\Config;
use App\Model\Shop\ProductModel;
use App\Model\Shop\UsersModel;
use App\Model\Shop\CatProductModel;
use App\Model\Shop\AffiliateModel;
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
        $numTake=20;
        $product_selling = (new ProductModel())->listItems(null, ['task' => 'frontend-list-items'])->take($numTake);
        $product_covid=(new ProductModel())->listItems(['type'=>'hau_covid','limit'=>10], ['task' => 'frontend-list-items-by-type']);
        $productInObject=(new ProductModel())->listItems(['type'=>'tre_em','limit'=>10], ['task' => 'frontend-list-items-by-type']);
        $itemsProduct['new'] = (new ProductModel())->listItems(['type'=>'new','limit'=>10], ['task' => 'frontend-list-items-by-type']);
        $couterSumProduct=(new ProductModel())->countItems(null, ['task' => 'count-items-all-product-frontend']);
        $couterSumProduct=$couterSumProduct[0]['count']-20;
        if ($request->has('codeRef')) {
            $request->session()->put('codeRef', $request->query('codeRef'));
            $codeRef = $request->codeRef ?? ($request->session()->get('codeRef') ?? '');
            $affiliate = AffiliateModel::where('code_ref', $codeRef)->first();
            if ($affiliate) {
                $affiliate->increment('sum_click');
             }
        }
        
        return view(
            $this->pathViewController . 'index',
            compact('product_selling','product_covid','productInObject','itemsProduct','couterSumProduct')
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

    public function ajax_filter(Request $request){
        $data = $request->all();
        $object_product = $request->object_product;
        $productInObject=(new ProductModel())->listItems(['type'=>$object_product,'limit'=>10], ['task' => 'frontend-list-items-by-type']);
        return view("$this->moduleName.partial.product",['items'=>$productInObject]);
    }
}
