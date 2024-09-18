<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use Illuminate\Support\Facades\Config;
use App\Model\Shop\ProductModel;
use App\Model\Shop\UsersModel;
use App\Model\Shop\CatProductModel;
use App\Model\Shop\AffiliateModel;
use App\Model\Shop\ArticleModel;
use App\Model\Shop\PostModel;

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
        $product_covid=(new ProductModel())->listItems(['type'=>'hau_covid'], ['task' => 'frontend-list-items'])->take(10);
        $productInObject=(new ProductModel())->listItems(['type'=>'tre_em'], ['task' => 'frontend-list-items'])->take(10);
        $countproductInObject=(new ProductModel())->countItems(['type'=>'tre_em'], ['task' => 'count-items-product-frontend']);
        $countproductInObject=$countproductInObject[0]['count']-10;
        $itemsProduct['new'] = (new ProductModel())->listItems(['type'=>'new'], ['task' => 'frontend-list-items'])->take(10);
        $itemsProduct['best'] = (new ProductModel())->listItems(['type'=>'noi_bat'], ['task' => 'frontend-list-items'])->take(10);
        $couterSumProduct=(new ProductModel())->countItems(null, ['task' => 'count-items-product-frontend']);
        $couterSumProduct=$couterSumProduct[0]['count']-20;
        if ($request->has('codeRef')) {
            $request->session()->put('codeRef', $request->query('codeRef'));
            $codeRef = $request->codeRef ?? ($request->session()->get('codeRef') ?? '');
            $affiliate = AffiliateModel::where('code_ref', $codeRef)->first();
            if ($affiliate) {
                $affiliate->increment('sum_click');
             }
        }
        //$itemsArticle = (new ArticleModel())->listItems(null, ['task' => 'frontend-list-items']);
        $itemsArticle = (new PostModel)->listItems(['take'=>5], ['task' => 'frontend-list-items']);
        return view(
            $this->pathViewController . 'index',
            compact('product_selling','product_covid','productInObject','itemsProduct','couterSumProduct','countproductInObject','itemsArticle')
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
        if(isset($data['orderby_product'])){
            $listParams['order_by']=$data['orderby_product'] ?? null;
            if ($type = $data['type'] ?? null) {
                $listParams['cat_product_id'] = $data['idCat'] ?? null;
            }
            $listProductOrderBy=(new ProductModel())->listItems($listParams, ['task' => 'frontend-list-items'])->take(20);
            $couterSumProduct=(new ProductModel())->countItems(['cat_product_id'=>$data['idCat']],['task'=>'count-number-product-in-cat']);
            $couterSumProduct=$couterSumProduct-20;
            return view("$this->moduleName.pages.cat.templates.list_product",
                    [
                        'items'=>$listProductOrderBy,
                        'countProduct'=>$couterSumProduct,
                        'idCat'=>$data['idCat'],
                        'typeOrderBy'=>$data['orderby_product']
                    ]);
        }else{
            $typeObject = $request->object_product;
            $countproductInObject=(new ProductModel())->countItems(['type'=>$typeObject], ['task' => 'count-items-product-frontend']);
            $countproductInObject=$countproductInObject[0]['count']-10;
            $productInObject=(new ProductModel())->listItems(['type'=>$typeObject], ['task' => 'frontend-list-items'])->take(10);
            return view("$this->pathViewController.child_index.product_by_object",
                    [
                        'productInObject'=>$productInObject,
                        'countproductInObject'=>$countproductInObject,
                        'typeObject'=>$typeObject
                    ]);
        }
    }
    public function writeContentAi(){
        $title = 'Hướng dẫn viết content bằng AI | Tdoctor';
        return view("$this->pathViewController.write_content",[
            'title'=>$title
        ]);
    }
    public function pageChinhSachDoiTra(){
        $title = 'Chính sách đổi trả | Tdoctor';
        return view("$this->pathViewController.chinhsach_doitra",[
            'title'=>$title
        ]);
    }
    public function pageAboutUs(){
        $title = 'Về chúng tôi | Tdoctor';
        return view("$this->pathViewController.about_us",[
            'title'=>$title
        ]);
    }
    public function pageContact(){
        $title = 'Liên hệ | Tdoctor';
        return view("$this->pathViewController.contact",[
            'title'=>$title
        ]);
    }
    public function pageQuytrinhGiaiquyetTranhchap(){
        $title = 'Quy trình giải quyết tranh chấp | Tdoctor';
        return view("$this->pathViewController.quytrinh_giaiquyet_tranhchap",[
            'title'=>$title
        ]);
    }
    public function pageChinhsachBaomatThongtin(){
        $title = 'Chính sách bảo mật thông tin | Tdoctor';
        return view("$this->pathViewController.chinhsach_baomat_thongtin",[
            'title'=>$title
        ]);
    }
}
