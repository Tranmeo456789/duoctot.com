<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use App\Model\Shop\ProductModel;
use App\Model\Shop\UsersModel;
use App\Model\Shop\CatProductModel;
use App\Model\Shop\AffiliateModel;
use App\Model\Shop\PostModel;
use App\Model\Shop\ProducerModel;
use App\Model\Shop\QuangCaoModel;
use Illuminate\Http\Response;
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
        // if ($request->has('t')) {
        //     return redirect()->to(route('home'));
        // }
        // Cache::forget('duoctot_cache_product_best_data'); 
        // Cache::forget('duoctot_cache_ncc_data'); 
        // Cache::forget('duoctot_cache_product_new_data'); 
        // Cache::forget('duoctot_cache_product_km_data'); 
        $numTake=10;
        $keyCacheNcc = 'duoctot_cache_ncc_data';
        $keyCacheProductNew = 'duoctot_cache_product_new_data';
        $keyCacheProductBest = 'duoctot_cache_product_best_data';
        $keyCacheProductKhuyenMai = 'duoctot_cache_product_km_data';

        $dataNccCache = Cache::get($keyCacheNcc);
        $dataProductNewCache = Cache::get($keyCacheProductNew);
        $dataProductBestCache = Cache::get($keyCacheProductBest);
        $dataProductKhuyenMaiCache = Cache::get($keyCacheProductKhuyenMai);

        if(!empty($dataNccCache)){
            $productcers = $dataNccCache['productcers'];
        }else{
            $arrayIds = [1144150976,1144150977,1144150972,1144150971,1144150953,1144150969,1144150968,1144150959,1144150936,1144150924,1144150923,1144150918,1144150682,1144150915,1144150691,994110253,1144150905,1144150808,1144150821,1144150807,1144150805,1144150804,1144150797,1144150796,1144150792,1144150791,1144150788,1144150954,1144151048,1984151214,1144150711,1984151316];
            $productcersRaw = UsersModel::whereIn('user_id', $arrayIds)->get()->keyBy('user_id');
            $productcers = collect($arrayIds)->map(function ($id) use ($productcersRaw) {
                return $productcersRaw->get($id);
            })->filter();
            $cacheDataNcc = [
                'productcers' => $productcers,
            ];
            Cache::put($keyCacheNcc, $cacheDataNcc, 100000000);
        }
        if (!empty($dataProductNewCache)) {
            $itemsProduct['new'] = $dataProductNewCache['new'];
        } else {
            $itemsProduct['new'] = (new ProductModel())->listItems(['type' => 'new'], ['task' => 'frontend-list-items'])->take(10);
            $cacheDataProductNew = [
                'new' => $itemsProduct['new']
            ];
            Cache::put($keyCacheProductNew, $cacheDataProductNew, 100000000);
        }
        if (!empty($dataProductBestCache)) {
            $itemsProduct['best'] = $dataProductBestCache['best'];
        } else {
            $itemsProduct['best'] = (new ProductModel())->listItems(['type' => 'noi_bat'], ['task' => 'frontend-list-items'])->take(10);
            $cacheDataProductBest = [
                'best' => $itemsProduct['best']
            ];
            Cache::put($keyCacheProductBest, $cacheDataProductBest, 100000000);
        }
        if (!empty($dataProductKhuyenMaiCache)) {
            $itemsProduct['km'] = $dataProductKhuyenMaiCache['km'];
        } else {
            $itemsProduct['km'] = (new ProductModel())->listItems(['type' => 'goi_y'], ['task' => 'frontend-list-items'])->take(10);
            $cacheDataProductKhuyenMai = [
                'km' => $itemsProduct['km']
            ];
            Cache::put($keyCacheProductKhuyenMai, $cacheDataProductKhuyenMai, 100000000);
        }
        if ($request->has('codeRef')) {
            $request->session()->put('codeRef', $request->query('codeRef'));
            $codeRef = $request->codeRef ?? ($request->session()->get('codeRef') ?? '');
        }
        $formRegister =0;
        if($request->formRegister){
            $formRegister =1;
        }
        return view(
            $this->pathViewController . 'index',
            compact('itemsProduct','formRegister','productcers')
        );
    }
    // public function ajaxHoverCatLevel1(Request $request)
    // {
    //     $data = $request->all();
    //     $idCatLevel1 = $request->idCatLevel1;
    //     $itemCatCurent=(new CatProductModel())->getItem(['id'=>$idCatLevel1],['task'=>'get-item']);
    //     $slugCatLevel1=$itemCatCurent['slug'];
    //     $params['parent_id']=$itemCatCurent['id'];
    //     $listItemLevel2=(new CatProductModel())->listItems($params,['task'=>'frontend-list-items-by-parent-id']);
    //     $itemLevel2First=$listItemLevel2[0];
    //     $slugCatLevel2=$itemLevel2First['slug'];
    //     $params['parent_id']=$itemLevel2First['id'];
    //     $listItemLevel3=(new CatProductModel())->listItems($params,['task'=>'frontend-list-items-by-parent-id']);
    //     unset($params['parent_id']);
    //     $params['cat_product_id']=$itemLevel2First['id'];
    //     $params['limit']=4;
    //     $listProductCatLevel2=(new ProductModel())->listItems($params,['task'=>'frontend-list-items']);
    //     return view("$this->moduleName.block.child_submenu.ls_cat_level3_and_product",compact('listItemLevel3','listProductCatLevel2','slugCatLevel1','slugCatLevel2'));
    // }
    public function ajaxHoverCatLevel1(Request $request)
    {
        $idCatLevel1 = $request->idCatLevel1;
        if (!$idCatLevel1) {
            return response()->json([], 400);
        }
        $cacheKey = 'duoctot_cache_hover_cat_level1_' . $idCatLevel1;
        $data = Cache::remember($cacheKey, 300, function () use ($idCatLevel1) {
            $itemCatCurent = (new CatProductModel())
                ->getItem(['id'=>$idCatLevel1], ['task'=>'get-item']);
            if (!$itemCatCurent) {
                return null;
            }
            $slugCatLevel1 = $itemCatCurent['slug'] ?? null;
            $params['parent_id'] = $itemCatCurent['id'];
            $listItemLevel2 = (new CatProductModel())
                ->listItems($params, ['task'=>'frontend-list-items-by-parent-id']);
            if (empty($listItemLevel2)) {
                return null;
            }
            $itemLevel2First = $listItemLevel2[0];
            $slugCatLevel2 = $itemLevel2First['slug'] ?? null;
            // Lấy level 3
            $params['parent_id'] = $itemLevel2First['id'];
            $listItemLevel3 = (new CatProductModel())
                ->listItems($params, ['task'=>'frontend-list-items-by-parent-id']);
            unset($params['parent_id']);
            // Lấy sản phẩm
            $params['cat_product_id'] = $itemLevel2First['id'];
            $params['limit'] = 4;
            $listProductCatLevel2 = (new ProductModel())
                ->listItems($params, ['task'=>'frontend-list-items']);
            return compact(
                'listItemLevel3',
                'listProductCatLevel2',
                'slugCatLevel1',
                'slugCatLevel2'
            );
        });
        if (!$data) {
            return response()->json([], 404);
        }
        return view(
            "$this->moduleName.block.child_submenu.ls_cat_level3_and_product",
            $data
        );
    }
    // public function ajaxHoverCatLevel2(Request $request)
    // {
    //     $idCatLevel2 = $request->idCatLevel2;
    //     if (!$idCatLevel2) {
    //         return response()->json([], 400);
    //     }
    //     $itemCatCurent = (new CatProductModel())
    //         ->getItem(['id'=>$idCatLevel2], ['task'=>'get-item']);
    //     if (!$itemCatCurent) {
    //         return response()->json([], 404);
    //     }
    //     $slugCatLevel2 = $itemCatCurent['slug'] ?? null;
    //     $itemCatParent = (new CatProductModel())
    //         ->getItem(['parent_id'=>$itemCatCurent['parent_id']], ['task'=>'get-item-parent']);
    //     $slugCatLevel1 = $itemCatParent['slug'] ?? null;
    //     $params['parent_id'] = $idCatLevel2;
    //     $listItemLevel3 = (new CatProductModel())
    //         ->listItems($params, ['task'=>'frontend-list-items-by-parent-id']);
    //     unset($params['parent_id']);
    //     $params['cat_product_id'] = $idCatLevel2;
    //     $params['limit'] = 4;
    //     $listProductCatLevel2 = (new ProductModel())
    //         ->listItems($params, ['task'=>'frontend-list-items']);
    //     return view(
    //         "$this->moduleName.block.child_submenu.ls_cat_level3_and_product",
    //         compact(
    //             'listItemLevel3',
    //             'listProductCatLevel2',
    //             'slugCatLevel1',
    //             'slugCatLevel2'
    //         )
    //     );
    // }
    public function ajaxHoverCatLevel2(Request $request)
    {
        $idCatLevel2 = $request->idCatLevel2;
        if (!$idCatLevel2) {
            return response()->json([], 400);
        }
        $cacheKey = 'duoctot_cache_hover_cat_level2_' . $idCatLevel2;
        $data = Cache::remember($cacheKey, 300, function () use ($idCatLevel2) {
            $itemCatCurent = (new CatProductModel())
                ->getItem(['id'=>$idCatLevel2],['task'=>'get-item']);
            if (!$itemCatCurent) {
                return null;
            }
            $slugCatLevel2 = $itemCatCurent['slug'] ?? null;
            $itemCatParent = (new CatProductModel())
                ->getItem(['parent_id'=>$itemCatCurent['parent_id']],['task'=>'get-item-parent']);
            $slugCatLevel1 = $itemCatParent['slug'] ?? null;
            $params['parent_id'] = $idCatLevel2;
            $listItemLevel3 = (new CatProductModel())
                ->listItems($params,['task'=>'frontend-list-items-by-parent-id']);
            unset($params['parent_id']);
            $params['cat_product_id'] = $idCatLevel2;
            $params['limit'] = 4;
            $listProductCatLevel2 = (new ProductModel())
                ->listItems($params,['task'=>'frontend-list-items']);
            return compact(
                'listItemLevel3',
                'listProductCatLevel2',
                'slugCatLevel1',
                'slugCatLevel2'
            );
        });
        if (!$data) {
            return response()->json([],404);
        }
        return view(
            "$this->moduleName.block.child_submenu.ls_cat_level3_and_product",
            $data
        );
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
            $countproductInObject = isset($countproductInObject[0]['count']) ? $countproductInObject[0]['count'] - 10 : 0;
            $productInObject=(new ProductModel())->listItems(['type'=>$typeObject], ['task' => 'frontend-list-items'])->take(10);
            return view("$this->pathViewController.child_index.product_by_object",
                    [
                        'productInObject'=>$productInObject,
                        'countproductInObject'=>$countproductInObject,
                        'typeObject'=>$typeObject
                    ]);
        }
    }
    public function ajaxShowProductNccInKhuyenmai(Request $request){
        $data = $request->all();
        $slug = $request->slug;
        $nccInfo = UsersModel::where('slug', $slug)->first();
        $idnccInfo = $nccInfo->user_id ?? 1;
        $listIdProductAddSelect = collect($nccInfo->listIdProduct)->pluck('product_id')->toArray();
        $lsProductKm = (new ProductModel)->listItems([
            'group_id' => $listIdProductAddSelect,
            'user_id' => $idnccInfo,
            'take' => 5
        ], ['task' => 'frontend-list-item-shop']) ?? [];
        return view("$this->pathViewController.child_khuyen_mai.ls_product_ncc",
        [
            'lsProductKm'=>$lsProductKm
        ]);
    }
    public function writeContentAi(){
        $title = 'Hướng dẫn viết content bằng AI | Duoctot.com';
        return view("$this->pathViewController.write_content",[
            'title'=>$title
        ]);
    }
    public function pageChinhSachDoiTra(){
        $title = 'Chính sách đổi trả | Duoctot.com';
        return view("$this->pathViewController.chinhsach_doitra",[
            'title'=>$title
        ]);
    }
    public function pageAboutUs(){
        $title = 'Về chúng tôi | Duoctot.com';
        return view("$this->pathViewController.about_us",[
            'title'=>$title
        ]);
    }
    public function pageAboutUsWebView(){
        $title = 'Về chúng tôi | Duoctot.com';
        return view("$this->pathViewController.about_us_web_view",[
            'title'=>$title
        ]);
    }
    public function pageContact(){
        $title = 'Liên hệ | Duoctot.com';
        return view("$this->pathViewController.contact",[
            'title'=>$title
        ]);
    }
    public function pageContactWebView(){
        $title = 'Liên hệ | Duoctot.com';
        return view("$this->pathViewController.contact_webview",[
            'title'=>$title
        ]);
    }
    public function pageQuytrinhGiaiquyetTranhchap(){
        $title = 'Quy trình giải quyết tranh chấp | Duoctot.com';
        return view("$this->pathViewController.quytrinh_giaiquyet_tranhchap",[
            'title'=>$title
        ]);
    }
    public function pageChinhsachBaomatThongtin(){
        $title = 'Chính sách bảo mật thông tin | Duoctot.com';
        return view("$this->pathViewController.chinhsach_baomat_thongtin",[
            'title'=>$title
        ]);
    }
    public function pageChinhsachGiaoNhan(){
        $title = 'Chính sách giao nhận | Duoctot.com';
        return view("$this->pathViewController.chinhsach_giaonhan",[
            'title'=>$title
        ]);
    }
    public function pageChinhsachThanhToan(){
        $title = 'Chính sách thanh toán | Duoctot.com';
        return view("$this->pathViewController.chinhsach_thanhtoan",[
            'title'=>$title
        ]);
    }
    public function indexSitemap()
    {
        $sitemaps = config('myconfig.urlSitemap');
        $xmlContent = view('shop.frontend.pages.home.sitemap', compact('sitemaps'))->render();
        return response($xmlContent, 200)->header('Content-Type', 'application/xml');
        
    }
    public function getSitemap($filePath)
    {
        if (!file_exists($filePath)) {
            abort(404, 'File not found');
        }
        $links = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $xmlContent = view('shop.frontend.pages.home.sitemap_detail', compact('links'))->render();
        return response($xmlContent, 200)->header('Content-Type', 'application/xml');
    }
    public function sitemapPost(){
        $filePath = public_path('xml/post.txt');
        return $this->getSitemap($filePath);
    }
    public function sitemapPage(){
        $filePath = public_path('xml/page.txt');
        return $this->getSitemap($filePath);
    }
    public function siteCategory(){
        $filePath = public_path('xml/category.txt');
        return $this->getSitemap($filePath);
    }
    public function siteCatProduct(){
        $filePath = public_path('xml/cat_product.txt');
        return $this->getSitemap($filePath);
    }
    public function siteProduct(){
        $filePath = public_path('xml/product.txt');
        return $this->getSitemap($filePath);
    }
    public function siteProduct1(){
        $filePath = public_path('xml/product1.txt');
        return $this->getSitemap($filePath);
    }
    public function siteProduct2(){
        $filePath = public_path('xml/product2.txt');
        return $this->getSitemap($filePath);
    }
    public function siteProduct3(){
        $filePath = public_path('xml/product3.txt');
        return $this->getSitemap($filePath);
    }
    public function siteProduct4(){
        $filePath = public_path('xml/product4.txt');
        return $this->getSitemap($filePath);
    }
    public function siteProduct5(){
        $filePath = public_path('xml/product5.txt');
        return $this->getSitemap($filePath);
    }
    public function siteProduct6(){
        $filePath = public_path('xml/product6.txt');
        return $this->getSitemap($filePath);
    }
    public function siteProduct7(){
        $filePath = public_path('xml/product7.txt');
        return $this->getSitemap($filePath);
    }
    public function siteProduct8(){
        $filePath = public_path('xml/product8.txt');
        return $this->getSitemap($filePath);
    }
    public function siteUserBenhVien(){
        $filePath = public_path('xml/user_benhvien.txt');
        return $this->getSitemap($filePath);
    }
    public function pageHomeWebView(Request $request){
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
        //$itemsQuangCao = QuangCaoModel::where('status', 'active')->get();
        $itemsArticle = (new PostModel)->listItems(['take'=>5], ['task' => 'frontend-list-items']);
        return view(
            $this->pathViewController . 'home_webview',
            compact('product_selling','product_covid','productInObject','itemsProduct','couterSumProduct','countproductInObject','itemsArticle')
        );
    }
    public function pageDieukhoanSudung(){
        $title = 'Điều khoản sử dụng | Duoctot.com';
        return view("$this->pathViewController.dieukhoan_sudung",[
            'title'=>$title
        ]);
    }
    public function downloadAppTdoctor(Request $request){
        $userAgent = $request->header('User-Agent');
        if (strpos($userAgent, 'Android') !== false) {
            return redirect('https://play.google.com/store/apps/details?id=com.app.khambenh.bacsiviet');
        }
        if (strpos($userAgent, 'iPhone') !== false || strpos($userAgent, 'iPad') !== false) {
            return redirect('https://apps.apple.com/vn/app/tdoctor/id1443310734?l=vi');
        }
        return view('shop.frontend.pages.error.page_404');
    }
    public function pageKhuyenMai(){
        $title = 'Khuyến Mãi | Duoctot.com';
        $arrayIds = [1144150976,1144150977,1144150972,1144150971,1144150953,1144150969,1144150968,1144150959,1144150936,1144150924,1144150923,1144150918,1144150682,1144150915,1144150691,994110253,1144150905,1144150808,1144150821,1144150807,1144150805,1144150804,1144150797,1144150796,1144150792,1144150791,1144150788,1144150954,1144151048,1984151214,1144150711,1984151316];
            $productcersRaw = UsersModel::whereIn('user_id', $arrayIds)->get()->keyBy('user_id');
            $productcers = collect($arrayIds)->map(function ($id) use ($productcersRaw) {
                return $productcersRaw->get($id);
            })->filter();
        $firstUser = $productcers->first();
        $idFirstUser = $firstUser->user_id ?? 1; // Truy cập bằng object
        $listIdProductAddSelect = collect($firstUser->listIdProduct)->pluck('product_id')->toArray();
        $lsProductKm = (new ProductModel)->listItems([
            'group_id' => $listIdProductAddSelect,
            'user_id' => $idFirstUser,
            'take' => 5
        ], ['task' => 'frontend-list-item-shop']) ?? [];
        return view("$this->pathViewController.khuyen_mai",[
            'title'=>$title,
            'productcers'=>$productcers,
            'lsProductKm'=>$lsProductKm,
        ]);
    }
    public function pageDiemTichLuy(Request $request) {
        if ($request->session()->has('user')) {
            $title = 'Điểm tích lũy | Duoctot.com';
            return view("{$this->pathViewController}.diem_tich_luy", [
                'title' => $title
            ]);
        } else {
            return view('shop.frontend.pages.error.diem_tich_luy_chua_login');
        }
    }
    public function pageRiengChoBan(Request $request) {
        if ($request->session()->has('user')) {
            $title = 'Riêng cho bạn | Duoctot.com';
            $user = $request->session()->get('user');
            $userId = $user['user_id'] ?? null;
            $userInfo=UsersModel::where('user_id', $userId)->first();
            $userDetails= $userInfo->details;
            $slug=$userDetails['slug'];
            return redirect()->route('fe.product.drugstore', ['slug' => $slug]);
        } else {
            return view('shop.frontend.pages.error.vui_long_dang_nhap');
        }
    }
    public function pageDanhSachDonMua(Request $request) {
        if ($request->session()->has('user')) {
            return redirect()->route('order');
        } else {
            return view('shop.frontend.pages.error.vui_long_dang_nhap');
        }
    }
}
