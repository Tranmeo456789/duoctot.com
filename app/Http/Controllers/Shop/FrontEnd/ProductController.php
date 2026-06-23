<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Shop\CatProductModel;
use App\Model\Shop\AffiliateProductModel;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use App\Model\Shop\AffiliateModel;
use App\Model\Shop\CommentModel;
use App\Model\Shop\ProductModel as MainModel;
use App\Model\Shop\ProvinceModel;
use App\Model\Shop\DistrictModel;
use App\Model\Shop\TrademarkModel;
use App\Model\Shop\UsersModel;
use App\Model\Shop\UserValuesModel;
use App\Model\Shop\WardModel;
use App\Model\Shop\ConfigModel;
use App\Helpers\MyFunction;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
class ProductController extends ShopFrontEndController
{
    public function __construct()
    {
        $this->controllerName     = 'product';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Chi tiết sản phẩm';
        $this->model = new MainModel();
        parent::__construct();
    }
    // public function detail(Request $request)
    // {
    //     $slug = $request->slug;
    //     $session = $request->session();
    //     $codeRefLogin = '';
    //     $codeRefRegister = '';
    //     // user login
    //     if ($session->has('user')) {
    //         $userInfoCurrent = $session->get('user');
    //         $userInfoCurrent = (new UsersModel)->getItem(
    //             ['user_id'=>$userInfoCurrent['user_id']],
    //             ['task'=>'get-item']
    //         );
    //         $codeRefLogin    = $userInfoCurrent['codeRef'];
    //         $codeRefRegister = $userInfoCurrent['ref_register'] ?? '';
    //         $cacheKey = 'duoctot_product_login_' . $slug;
    //         $item = Cache::remember($cacheKey, 3600, function () use ($slug) {
    //             return $this->model->getItem(
    //                 ['slug' => $slug],
    //                 ['task' => 'frontend-get-item-has-login']
    //             );
    //         });
    //     }else {
    //         $cacheKey = 'duoctot_product_guest_' . $slug;
    //         $item = Cache::remember($cacheKey, 3600, function () use ($slug) {
    //             return $this->model->getItem(
    //                 ['slug' => $slug],
    //                 ['task' => 'frontend-get-item']
    //             );
    //         });
    //     }
    //     if (!$item) {
    //         return redirect()->route('home');
    //     }
    //     $codeRef = $request->codeRef ?? ($session->get('codeRef') ?? $codeRefRegister);
    //     // redirect thêm codeRef
    //     if ((empty($request->codeRef) && session('codeRef')) || (empty($request->codeRef) && $codeRefRegister != '')) {
    //         return redirect()->route('fe.product.detail', [
    //             'slug'=>$slug,
    //             'codeRef'=>$codeRef
    //         ]);
    //     }
    //     if ($request->codeRef) {
    //         $cacheCodeRef = Cache::get('duoctot_user_by_codeRef_'.$request->codeRef);
    //         if ($cacheCodeRef !== null) {
    //             $userCodeRef = !empty($cacheCodeRef) ? $cacheCodeRef : null;
    //         } else {
    //             $model = UsersModel::where('codeRef',$request->codeRef)->first();
    //             $payload = $model ? $model->toArray() : [];
    //             Cache::put('duoctot_user_by_codeRef_'.$request->codeRef,$payload,100000000);
    //             $userCodeRef = $model ? $payload : null;
    //         }
    //         if ($userCodeRef) {
    //             $existProductAffiliate = AffiliateProductModel::where([
    //                 'product_id'=>$item['id'],
    //                 'user_id'=>$userCodeRef['user_id']
    //             ])->first();
    //             if ($existProductAffiliate) {
    //                 $existProductAffiliate->increment('sum_click');

    //             } else {
    //                 (new AffiliateProductModel)->saveItem([
    //                     'product_id'=>$item['id'],
    //                     'user_id'=>$userCodeRef['user_id'],
    //                     'sum_click'=>1
    //                 ],['task'=>'add-item']);
    //             }
    //         }
    //     }
    //     $userInfo = (new UsersModel)->getItem(
    //         ['user_id'=>$item['user_id']],
    //         ['task'=>'get-item']
    //     );
    //     $albumImageCurrent = !empty($item['albumImageHash'])
    //         ? explode('|',$item['albumImageHash'])
    //         : [];
    //     // $productViewed = isset($_COOKIE["productViewed"])
    //     //     ? json_decode($_COOKIE["productViewed"],true)
    //     //     : [];
    //     // $productCurrent = [];
    //     // if (isset($productViewed[$item['id']])) {
    //     //     $productCurrent[$item['id']] = $productViewed[$item['id']];
    //     //     unset($productViewed[$item['id']]);
    //     // } else {
    //     //     $productCurrent[$item['id']] = [
    //     //         'product_id'=>$item->id,
    //     //         'name'=>$item->name,
    //     //         'price'=>$item->price,
    //     //         'image'=>$item->image,
    //     //         'unit'=>$item->unitProduct->name,
    //     //         'slug'=>$item->slug
    //     //     ];
    //     // }
    //     // $productViewed = $productCurrent + $productViewed;
    //     // if (count($productViewed) > 8) {
    //     //     array_pop($productViewed);
    //     // }
    //     // setcookie(
    //     //     "productViewed",
    //     //     json_encode($productViewed),
    //     //     time()+config('myconfig.time_cookie'),
    //     //     "/"
    //     // );
    //     // $_COOKIE["productViewed"] = json_encode($productViewed);
    //     $keyCache = 'duoctot_cache_product_data_'.$item['id'];
    //     $dataCache = Cache::get($keyCache);
    //     if (!empty($dataCache)) {
    //         $listProductRelate  = $dataCache['listProductRelate'];
    //         $ratingProduct      = $dataCache['ratingProduct'];
    //         $listUserHasProduct = $dataCache['listUserHasProduct'];
    //     } else {
    //         $listProductRelate = $this->model->listItems(
    //             ['cat_product_id'=>$item['cat_product_id'],'limit'=>4],
    //             ['task'=>'frontend-list-items']
    //         ) ?? [];
    //         // $commentProduct = (new CommentModel)->listItems(
    //         //     ['product_id'=>$item['id']],
    //         //     ['task'=>'list-items-frontend']
    //         // );
    //         $ratingProduct = (new CommentModel)->listItems(
    //             ['product_id'=>$item['id'],'rating'=>1],
    //             ['task'=>'list-items-frontend']
    //         );
    //         $listUserHasProduct = (new UsersModel)->listItems(
    //             ['product_id'=>$item['id']],
    //             ['task'=>'list-users-nha-cung-cap-has-product-id']
    //         );
    //         $dataCache = [
    //             'listProductRelate'=>$listProductRelate,
    //             'ratingProduct'=>$ratingProduct,
    //             'listUserHasProduct'=>$listUserHasProduct
    //         ];
    //         Cache::put($keyCache,$dataCache,100000000);
    //     }
    //     $params['id']=$item['id'];
    //     return view(
    //         $this->pathViewController.'detail',
    //         compact(
    //             'params',
    //             'item',
    //             'albumImageCurrent',
    //             'codeRef',
    //             'userInfo',
    //             'codeRefLogin',
    //             'listProductRelate',
    //             'ratingProduct',
    //             'listUserHasProduct'
    //         )
    //     );
    // }
    // public function detail(Request $request)
    // {
    //     $slug = $request->slug;
    //     $slugNormalize = Str::slug($slug);
    //     // User nhập hoa/thường, tiếng Việt, ký tự lạ
    //     if ($slug !== $slugNormalize) {
    //         return redirect()->to(
    //             url('/chi-tiet-san-pham/' . $slugNormalize . '.html'),
    //             301
    //         );
    //     }
    //     $session = $request->session();
    //     $codeRefLogin = '';
    //     $codeRefRegister = '';
    //     // user login
    //     if ($session->has('user')) {
    //         $userInfoCurrent = $session->get('user');
    //         $codeRefLogin    = $userInfoCurrent['codeRef'] ?? '';
    //         $codeRefRegister = $userInfoCurrent['ref_register'] ?? '';
    //         $cacheKey = 'duoctot_product_login_' . $slug;
    //         $item = Cache::remember($cacheKey, 3600, function () use ($slug) {
    //             return $this->model->getItem(
    //                 ['slug' => $slug],
    //                 ['task' => 'frontend-get-item-has-login']
    //             );
    //         });
    //     }else {
    //         $cacheKey = 'duoctot_product_guest_' . $slug;
    //         $item = Cache::remember($cacheKey, 3600, function () use ($slug) {
    //             return $this->model->getItem(
    //                 ['slug' => $slug],
    //                 ['task' => 'frontend-get-item']
    //             );
    //         });
    //     }
    //     if (!$item) {
    //         return redirect()->route('home');
    //     }
    //     $codeRef = $request->codeRef ?? ($session->get('codeRef') ?? $codeRefRegister);
    //     // redirect thêm codeRef
    //     if ((empty($request->codeRef) && session('codeRef')) || (empty($request->codeRef) && $codeRefRegister != '')) {
    //         return redirect()->route('fe.product.detail', [
    //             'slug'=>$slug,
    //             'codeRef'=>$codeRef
    //         ]);
    //     }
    //     if ($request->codeRef) {
    //         $cacheCodeRef = Cache::get('duoctot_user_by_codeRef_'.$request->codeRef);
    //         if ($cacheCodeRef !== null) {
    //             $userCodeRef = !empty($cacheCodeRef) ? $cacheCodeRef : null;
    //         } else {
    //             $model = UsersModel::where('codeRef',$request->codeRef)->first();
    //             $payload = $model ? $model->toArray() : [];
    //             Cache::put('duoctot_user_by_codeRef_'.$request->codeRef,$payload,100000000);
    //             $userCodeRef = $model ? $payload : null;
    //         }
    //         if ($userCodeRef) {
    //             $existProductAffiliate = AffiliateProductModel::where([
    //                 'product_id'=>$item['id'],
    //                 'user_id'=>$userCodeRef['user_id']
    //             ])->first();
    //             if ($existProductAffiliate) {
    //                 $existProductAffiliate->increment('sum_click');

    //             } else {
    //                 (new AffiliateProductModel)->saveItem([
    //                     'product_id'=>$item['id'],
    //                     'user_id'=>$userCodeRef['user_id'],
    //                     'sum_click'=>1
    //                 ],['task'=>'add-item']);
    //             }
    //         }
    //     }
    //     $albumImageCurrent = !empty($item['albumImageHash'])
    //         ? explode('|',$item['albumImageHash'])
    //         : [];
    //     $keyCache = 'duoctot_cache_product_data_'.$item['id'];
    //     $dataCache = Cache::get($keyCache);
    //     if (!empty($dataCache)) {
    //         $listProductRelate  = $dataCache['listProductRelate'];
    //         $ratingProduct      = $dataCache['ratingProduct'];
    //         $listUserHasProduct = $dataCache['listUserHasProduct'];
    //         $userInfo = $dataCache['userInfo'];
    //         $itemCatCurent = $dataCache['itemCatCurent'];
    //         $itemCatParentLevel1 = $dataCache['itemCatParentLevel1'];
    //         $itemCatParentLevel2 = $dataCache['itemCatParentLevel2'];
    //         $averageRating = $dataCache['averageRating'];
    //         $ratingPercentages = $dataCache['ratingPercentages'];
    //     } else {
    //         $listProductRelate = $this->model->listItems(
    //             ['cat_product_id'=>$item['cat_product_id'],'limit'=>4],
    //             ['task'=>'frontend-list-items']
    //         ) ?? [];
    //         $ratingProduct = (new CommentModel)->listItems(
    //             ['product_id'=>$item['id'],'rating'=>1],
    //             ['task'=>'list-items-frontend']
    //         );
    //         $listUserHasProduct = (new UsersModel)->listItems(
    //             ['product_id'=>$item['id']],
    //             ['task'=>'list-users-nha-cung-cap-has-product-id']
    //         );
    //         $userInfo = (new UsersModel)->getItem(
    //             ['user_id'=>$item['user_id']],
    //             ['task'=>'get-item']
    //         );
    //         $itemCatCurent = $item->catProduct;
    //         $idCatParentLevel1=$itemCatCurent['parent_id'];
    //         $itemCatParentLevel1=(new CatProductModel)->getItem(['parent_id'=>$idCatParentLevel1],['task'=>'get-item-parent']);
    //         $itemCatParentLevel2=(new CatProductModel)->getItem(['parent_id'=>$idCatParentLevel1,'up_level'=>2],['task'=>'get-item-parent']);
    //         $averageRating=(new CommentModel)->averageRating(['product_id'=>$item['id']],['task' => 'rating-star-average'])??'';
    //         $ratingPercentages=(new CommentModel)->ratingPercentages(['product_id'=>$item['id']],['task' => 'rating-percentage-star'])??[];
    //         $dataCache = [
    //             'listProductRelate'=>$listProductRelate,
    //             'ratingProduct'=>$ratingProduct,
    //             'listUserHasProduct'=>$listUserHasProduct,
    //             'userInfo'=>$userInfo,
    //             'itemCatCurent'=>$itemCatCurent,
    //             'itemCatParentLevel1'=>$itemCatParentLevel1,
    //             'itemCatParentLevel2'=>$itemCatParentLevel2,
    //             'averageRating'=>$averageRating,
    //             'ratingPercentages'=>$ratingPercentages,
    //         ];
    //         Cache::put($keyCache,$dataCache,100000000);
    //     }
    //     $params['id']=$item['id'];
    //     $title = $item['name'] ?? $item['title'] ?? $title ?? 'Sàn thương mại điện tử trong y dược số 1 Việt Nam';
    //     $imageItem = isset($item['image']) ? $item['image'] : 'images/shop/logo-favicon.png';
    //     $description = $item['description'] ?? $item['meta_description'] ?? 'Duoctot.com là một giải pháp cho các nhà thuốc, các doanh nghiệp, công ty dược phẩm tăng doanh thu một cách nhanh chóng.';
    //     $metaKeywords = $item['meta_keywords']?? 'Shop trực tuyến, mua hàng online, tư vấn dược phẩm, giao hàng tận nhà, giảm đau, vitamin bổ sung';
    //     $productCode = $item['description']??'';
    //     $price = $item['price']??'';
    //     return view(
    //         $this->pathViewController.'detail',
    //         compact(
    //             'params',
    //             'item',
    //             'albumImageCurrent',
    //             'codeRef',
    //             'userInfo',
    //             'codeRefLogin',
    //             'listProductRelate',
    //             'ratingProduct',
    //             'listUserHasProduct',
    //             'itemCatCurent',
    //             'itemCatParentLevel1',
    //             'itemCatParentLevel2',
    //             'averageRating',
    //             'ratingPercentages',
    //             'title',
    //             'imageItem',
    //             'description',
    //             'metaKeywords',
    //             'productCode',
    //             'price'
    //         )
    //     );
    // }
    public function detail(Request $request)
    {
        $slug = $request->slug;
        $slugNormalize = Str::slug($slug);
        if ($slug !== $slugNormalize) {
            return redirect()->to(
                url('/chi-tiet-san-pham/' . $slugNormalize . '.html'),
                301
            );
        }
        $session = $request->session();
        $codeRefLogin = '';
        $codeRefRegister = '';
        /*
        |--------------------------------------------------------------------------
        | 1. PRODUCT CACHE (LOGIN / GUEST)
        |--------------------------------------------------------------------------
        */
        if ($session->has('user')) {
            $userInfoCurrent = $session->get('user');
            $codeRefLogin    = $userInfoCurrent['codeRef'] ?? '';
            $codeRefRegister = $userInfoCurrent['ref_register'] ?? '';
            $item = Cache::tags(['duoctot_product', 'duoctot_product_detail', 'duoctot_product_login'])
                ->remember("duoctot_product_login_{$slug}", 3600, function () use ($slug) {
                    return $this->model->getItem(
                        ['slug' => $slug],
                        ['task' => 'frontend-get-item-has-login']
                    );
                });
        } else {
            $item = Cache::tags(['duoctot_product', 'duoctot_product_detail', 'duoctot_product_guest'])
                ->remember("duoctot_product_guest_{$slug}", 3600, function () use ($slug) {
                    return $this->model->getItem(
                        ['slug' => $slug],
                        ['task' => 'frontend-get-item']
                    );
                });
        }
        if (!$item) {
            return redirect()->route('home');
        }
        /*
        |--------------------------------------------------------------------------
        | 2. AFFILIATE CODE REF CACHE
        |--------------------------------------------------------------------------
        */
        $codeRef = $request->codeRef ?? ($session->get('codeRef') ?? $codeRefRegister);
        if ((empty($request->codeRef) && session('codeRef')) || (empty($request->codeRef) && $codeRefRegister != '')) {
            return redirect()->route('fe.product.detail', [
                'slug' => $slug,
                'codeRef' => $codeRef
            ]);
        }
        if ($request->codeRef) {
            $userCodeRef = Cache::tags(['duoctot_product', 'duoctot_product_user'])
                ->remember("duoctot_user_codeRef_{$request->codeRef}", 86400, function () use ($request) {
                    $model = UsersModel::where('codeRef', $request->codeRef)->first();
                    return $model ? $model->toArray() : null;
                });
            if ($userCodeRef) {
                $existProductAffiliate = AffiliateProductModel::where([
                    'product_id' => $item['id'],
                    'user_id' => $userCodeRef['user_id']
                ])->first();
                if ($existProductAffiliate) {
                    $existProductAffiliate->increment('sum_click');
                } else {
                    (new AffiliateProductModel)->saveItem([
                        'product_id' => $item['id'],
                        'user_id' => $userCodeRef['user_id'],
                        'sum_click' => 1
                    ], ['task' => 'add-item']);
                }
            }
        }
        /*
        |--------------------------------------------------------------------------
        | 3. ALBUM IMAGE
        |--------------------------------------------------------------------------
        */
        $albumImageCurrent = !empty($item['albumImageHash'])
            ? explode('|', $item['albumImageHash'])
            : [];
        /*
        |--------------------------------------------------------------------------
        | 4. BLOCK CACHE (RELATE + RATING + CATEGORY)
        |--------------------------------------------------------------------------
        */
        $productId = $item['id'];
        $dataCache = Cache::tags(['duoctot_product', 'duoctot_product_block'])
            ->remember("duoctot_product_block_{$productId}", 3600, function () use ($item) {
                $listProductRelate = $this->model->listItems(
                    ['cat_product_id' => $item['cat_product_id'], 'limit' => 4],
                    ['task' => 'frontend-list-items']
                ) ?? [];
                $ratingProduct = (new CommentModel)->listItems(
                    ['product_id' => $item['id'], 'rating' => 1],
                    ['task' => 'list-items-frontend']
                );
                $listUserHasProduct = (new UsersModel)->listItems(
                    ['product_id' => $item['id']],
                    ['task' => 'list-users-nha-cung-cap-has-product-id']
                );
                $userInfo = (new UsersModel)->getItem(
                    ['user_id' => $item['user_id']],
                    ['task' => 'get-item']
                );
                $itemCatCurent = $item->catProduct;
                $idCatParentLevel1 = $itemCatCurent['parent_id'];
                $itemCatParentLevel1 = (new CatProductModel)->getItem(
                    ['parent_id' => $idCatParentLevel1],
                    ['task' => 'get-item-parent']
                );
                $itemCatParentLevel2 = (new CatProductModel)->getItem(
                    ['parent_id' => $idCatParentLevel1, 'up_level' => 2],
                    ['task' => 'get-item-parent']
                );
                $averageRating = (new CommentModel)->averageRating(
                    ['product_id' => $item['id']],
                    ['task' => 'rating-star-average']
                ) ?? '';
                $ratingPercentages = (new CommentModel)->ratingPercentages(
                    ['product_id' => $item['id']],
                    ['task' => 'rating-percentage-star']
                ) ?? [];
                return compact(
                    'listProductRelate',
                    'ratingProduct',
                    'listUserHasProduct',
                    'userInfo',
                    'itemCatCurent',
                    'itemCatParentLevel1',
                    'itemCatParentLevel2',
                    'averageRating',
                    'ratingPercentages'
                );
            });
        extract($dataCache);
        /*
        |--------------------------------------------------------------------------
        | 5. SEO META
        |--------------------------------------------------------------------------
        */
        $params['id'] = $item['id'];
        $title = $item['name']
            ?? $item['title']
            ?? 'Sàn thương mại điện tử số 1 Việt Nam';
        $imageItem = $item['image'] ?? 'images/shop/logo-favicon.png';

        $description = $item['description']
            ?? $item['meta_description']
            ?? 'Duoctot.com giúp nhà thuốc và doanh nghiệp dược tăng doanh thu hiệu quả.';

        $metaKeywords = $item['meta_keywords']
            ?? 'Shop dược phẩm, mua thuốc online, tư vấn sức khỏe, giao hàng tận nơi';

        $productCode = $item['description'] ?? '';
        $price = $item['price'] ?? '';
        /*
        |--------------------------------------------------------------------------
        | 6. RETURN VIEW
        |--------------------------------------------------------------------------
        */
        return view(
            $this->pathViewController . 'detail',
            compact(
                'params',
                'item',
                'albumImageCurrent',
                'codeRef',
                'userInfo',
                'codeRefLogin',
                'listProductRelate',
                'ratingProduct',
                'listUserHasProduct',
                'itemCatCurent',
                'itemCatParentLevel1',
                'itemCatParentLevel2',
                'averageRating',
                'ratingPercentages',
                'title',
                'imageItem',
                'description',
                'metaKeywords',
                'productCode',
                'price'
            )
        );
    }
    public function searchProductAjax(Request $request)
    {
        $data = $request->all();
        $params['keyword'] = $request->keyword;
        $params['limit'] = 5;
        $keyword = $params['keyword'];
        $params['user_sell'] = $request->user_sell;
        $items = $this->model->listItems($params, ['task' => 'list-items-search']);
        return view("$this->moduleName.pages.prescrip.child_index.ls_product_search", compact('items', 'keyword'));
    }
    public function searchListProductShort(Request $request)
    {
        $data = $request->all();
        $params['keyword'] = $request->keyword;
        $keyword = $params['keyword'];
        $items = $this->model->listItems($params, ['task' => 'list-items-search']);
        return view("$this->moduleName.templates.list_product_short", compact('items', 'keyword'));
    }
    public function loadMoreProducts(Request $request)
    {
        $data = $request->all();
        $offset = $request->offset;
        $listParams = ['offset' => $offset, 'take' => 20];
        if ($type = $data['type'] ?? null) {
            $listParams['cat_product_id'] = $data['idCat'] ?? null;
        }
        if ($object = $data['object'] ?? null) {
            $listParams['type'] = $data['object'] ?? null;
        }
        if ($orderBy = $data['orderBy'] ?? null) {
            $listParams['order_by'] = $data['orderBy'] ?? null;
        }
        if ($data['listTrademarkId'] ?? null) {
            $listParams['group_trademark'] = $data['listTrademarkId'];
        }
        if ($data['listCountryId'] ?? null) {
            $listParams['group_country'] = $data['listCountryId'];
        }
        $listProductAddView = $this->model->listItems($listParams, ['task' => 'frontend-list-items']);
        $viewName = $this->moduleName;
        if ($type == 'product_cat') {
            $viewName .= '.pages.cat.partial.product';
        } else {
            $viewName .= '.partial.product';
        }
        return view($viewName, ['items' => $listProductAddView]);
    }
    // public function drugstore(Request $request, $slug)
    // {
    //     // Lấy thông tin người dùng từ slug
    //     $userInfo = UsersModel::where('slug', $slug)->first();
    //     if (!$userInfo || empty($slug)) {
    //         return redirect()->route('home');
    //     }
    //     $shopId = $userInfo['user_id'];
    //     // Danh sách sản phẩm mặc định
    //     //$defaultProducts = [2052, 1454, 2331, 2339, 4065, 3844, 2363, 2361, 2332, 2339, 4223, 4246, 1183, 4219];
    //     $defaultProducts=[];
    //     $listIdProductAdd = $defaultProducts;
    //     $listIdProductAddSelect = collect($userInfo->listIdProduct)->pluck('product_id')->toArray();
    //     // Điều kiện loại bỏ danh sách sản phẩm mặc định
    //     if ($userInfo['user_type_id'] == 9 || !empty($listIdProductAddSelect || $userInfo['user_type_id'] == 3 || $userInfo['user_type_id'] == 2)) {
    //         $listIdProductAdd = [];
    //     }
    //     // Loại bỏ sản phẩm nếu user nằm trong danh sách không có sản phẩm
    //     // $usersWithoutProductAdd = [1144150760, 1144150864, 1144150947];
    //     // if (in_array($userInfo['user_id'], $usersWithoutProductAdd)) {
    //     //     $listIdProductAdd = [];
    //     // }
    //     // Lưu mã giới thiệu nếu có
    //     if ($request->has('codeRef')) {
    //         $request->session()->put('codeRef', $request->query('codeRef'));
    //     }
    //     // Lấy danh sách sản phẩm theo group_id
    //     $params['group_id'] = array_merge($listIdProductAddSelect, $listIdProductAdd);
    //     $productDrugstore = $this->model->listItems([
    //         'group_id' => $params['group_id'],
    //         'user_id' => $shopId
    //     ], ['task' => 'frontend-list-item-shop']) ?? [];
    //     // Nếu tài khoản là loại nhập mã thì không hiển thị sản phẩm
    //     // if ($userInfo['type_account'] === 'code_import') {
    //     //     $productDrugstore = [];
    //     // }
    //     // Xử lý địa chỉ và bản đồ
    //     $address = $map = $ward = $district = $province = '';
    //     $details = $userInfo['details'] ?? [];
    //     if (!empty($details)) {
    //         $wardId     = $details['ward_id']     ?? null;
    //         $districtId = $details['district_id'] ?? null;
    //         $provinceId = $details['province_id'] ?? null;
    //         // Ưu tiên ward (đầy đủ nhất)
    //         if ($wardId) {
    //             $wardDetail = (new WardModel())->getItem(
    //                 ['id' => $wardId],
    //                 ['task' => 'get-item-full']
    //             );
    //             if (!empty($wardDetail)) {
    //                 $ward     = ' ' . ($wardDetail['name'] ?? '');
    //                 $district = ', ' . ($wardDetail['district']['name'] ?? '');
    //                 $province = ', ' . ($wardDetail['district']['province']['name'] ?? '');
    //             }
    //         }
    //         // Nếu KHÔNG có ward hoặc ward không tồn tại → fallback district + province
    //         if ($district === '' && $districtId) {
    //             $districtDetail = (new DistrictModel())->getItem(
    //                 ['id' => $districtId],
    //                 ['task' => 'get-item-full']
    //             );
    //             $district = ', ' . ($districtDetail['name'] ?? '');
    //         }
    //         if ($province === '' && $provinceId) {
    //             $provinceDetail = (new ProvinceModel())->getItem(
    //                 ['id' => $provinceId],
    //                 ['task' => 'get-item-full']
    //             );
    //             $province = ', ' . ($provinceDetail['name'] ?? '');
    //         }
    //         // Address & map
    //         $addressBase = $details['address'] ?? '';
    //         $address = trim($addressBase . $ward . $district . $province);
    //         $map     = $details['map'] ?? '';
    //     }
    //     // Tiêu đề trang
    //     $title = !empty($userInfo['fullname'])
    //         ? $userInfo['fullname']
    //         : 'DƯỢC TỐT là Nền tảng kết nối y dược nhà thuốc, phòng khám , bệnh nhân với công ty dược và thực phẩm chức năng uy tín nhất Việt nam';
    //     // Lấy đánh giá & bình luận shop
    //     $commentShop = (new CommentModel())->listItems([
    //         'shop_id' => $shopId
    //     ], ['task' => 'list-items-frontend']);

    //     $ratingShop = (new CommentModel())->listItems([
    //         'shop_id' => $shopId,
    //         'rating' => 1
    //     ], ['task' => 'list-items-frontend']);
    //     $productKhuyenMai = $this->model->listItems(['type' => 'khuyen_mai', 'user_id' => $shopId], ['task' => 'frontend-list-items'])->take(10);
    //     if (count($productKhuyenMai) < 2) {
    //         $listIdProductAddSelect = collect($userInfo->listIdProduct)->pluck('product_id')->toArray();
    //         $productKhuyenMai = $this->model->listItems([
    //             'group_id' => $listIdProductAddSelect,
    //             'user_id' => $shopId,
    //             'take' => 5,
    //             'random' => true,
    //         ], ['task' => 'frontend-list-item-shop']) ?? [];
    //     }
    //     $albumImageCurrent = !empty($userInfo['albumImageHash']) ? explode('|', $userInfo['albumImageHash']) : [];
    //     //return $albumImageCurrent;
    //     // Trả về view
    //     return view($this->pathViewController . 'drugstore', [
    //         'userInfo' => $userInfo,
    //         'productDrugstore' => $productDrugstore,
    //         'address' => $address,
    //         'map' => $map,
    //         'title' => $title,
    //         'commentShop' => $commentShop,
    //         'ratingShop' => $ratingShop,
    //         'productKhuyenMai' => $productKhuyenMai,
    //         'albumImageCurrent' => $albumImageCurrent
    //     ]);
    // }
    public function drugstore(Request $request, $slug)
    {
        if (empty($slug)) {
            return redirect()->route('home');
        }
        // lưu codeRef nếu có
        if ($request->has('codeRef')) {
            $request->session()->put('codeRef', $request->query('codeRef'));
        }
        $cacheKey = 'duoctot_drugstore_' . $slug;
        $data = Cache::tags('duoctot_drugstore')->remember($cacheKey, 1800, function () use ($slug) {
            $userInfo = UsersModel::where('slug', $slug)->first();
            if (!$userInfo) {
                return null;
            }
            $shopId = $userInfo->user_id;
            // PRODUCT ID LIST
            $listIdProduct = collect($userInfo->listIdProduct)
                ->pluck('product_id')
                ->toArray();
            // PRODUCT SHOP
            $productDrugstore = [];
            if ($userInfo->type_account !== 'code_import') {
                $productDrugstore = $this->model->listItems([
                    'group_id' => $listIdProduct,
                    'user_id'  => $shopId
                ], [
                    'task' => 'frontend-list-item-shop'
                ]) ?? [];
            }
            // ADDRESS
            $address = '';
            $map = '';
            $details = $userInfo->details ?? [];
            if (!empty($details)) {
                $addressBase = $details['address'] ?? '';
                $wardId     = $details['ward_id'] ?? null;
                $districtId = $details['district_id'] ?? null;
                $provinceId = $details['province_id'] ?? null;
                $ward = '';
                $district = '';
                $province = '';
                // ưu tiên ward
                if ($wardId) {
                    $wardDetail = WardModel::with('district.province')->find($wardId);
                    if ($wardDetail) {
                        $ward     = ' ' . $wardDetail->name;
                        $district = ', ' . ($wardDetail->district->name ?? '');
                        $province = ', ' . ($wardDetail->district->province->name ?? '');
                    }
                }
                // fallback district
                if ($district === '' && $districtId) {
                    $districtDetail = DistrictModel::with('province')->find($districtId);
                    if ($districtDetail) {
                        $district = ', ' . $districtDetail->name;
                        $province = ', ' . ($districtDetail->province->name ?? '');
                    }
                }
                // fallback province
                if ($province === '' && $provinceId) {
                    $provinceDetail = ProvinceModel::find($provinceId);
                    if ($provinceDetail) {
                        $province = ', ' . $provinceDetail->name;
                    }
                }
                $address = trim($addressBase . $ward . $district . $province);
                $map     = $details['map'] ?? '';
            }
            // COMMENT SHOP
            $ratingShop = (new CommentModel)->listItems([
                'shop_id' => $shopId,
                'rating'  => 1
            ], [
                'task' => 'list-items-frontend'
            ]);
            // PRODUCT KHUYẾN MÃI
            $productKhuyenMai = $this->model->listItems([
                'type'    => 'khuyen_mai',
                'user_id' => $shopId
            ], [
                'task' => 'frontend-list-items'
            ])->take(10);
            if (count($productKhuyenMai) < 2) {
                $productKhuyenMai = $this->model->listItems([
                    'group_id' => $listIdProduct,
                    'user_id'  => $shopId,
                    'take'     => 5,
                    'random'   => true
                ], [
                    'task' => 'frontend-list-item-shop'
                ]) ?? [];
            }
            $averageRating=(new CommentModel)->averageRating(['shop_id'=>$userInfo['user_id']],['task' => 'rating-star-average'])??'';
            $ratingPercentages=(new CommentModel)->ratingPercentages(['shop_id'=>$userInfo['user_id']],['task' => 'rating-percentage-star'])??[];
            // ALBUM
            $albumImageCurrent = !empty($userInfo->albumImageHash)
                ? explode('|', $userInfo->albumImageHash)
                : [];
            // TITLE
            $title = !empty($userInfo->fullname)
                ? $userInfo->fullname
                : 'Sàn thương mại điện tử trong y dược số 1 Việt Nam';
            $item['name']=$userInfo->fullname??'';
            $item['description']=$userInfo->fullname??'';
            
            $imageSrc = isset($userInfo['details']['image']) ? $userInfo['details']['image'] : route('home') . '/public/fileUpload/nhathuoc/6875c9e1945c0.jpg';
            if (isset($userInfo['details']['image']) && $userInfo['details']['image'] != ''){
            $imageSrc = route('home') .'/public'. $userInfo['details']['image'];
            } elseif ($userInfo['user_type_id'] == 2) {
                $imageSrc = route('home') . '/public/fileUpload/nhathuoc/6898c9b8bf789.jpg';
            }else{
                $imageSrc = route('home') . '/public/fileUpload/nhathuoc/nhathuocmau10.jpg';
            }
            $item['image']=$imageSrc;
            $imageMap = route('home') . '/public/fileUpload/nhathuoc/mapduphong.jpeg';
            $userType = $userInfo['user_type_id'] ?? null;
            $phone    = $userInfo['phone'] ?? '';
            $email    = $userInfo['email'] ?? 'Đang cập nhật';
            $defaultPhone = '0345488247';
            // Mặc định là email
            $phoneShop = $email;
            $isPhone   = false;
            // USER TYPE 9 → luôn dùng số mặc định
            if ($userType == 9) {
                $phoneShop = $defaultPhone;
                if (in_array($userInfo['user_id'], [1984151811, 1984152436, 1984152512])) {
                    $phoneShop = $userInfo['phone'] ?? '';
                }
                
                $isPhone   = true;
            } elseif ($userType == 6) {
                if (!empty($phone)) {
                    $len = strlen($phone);
                    if ($len > 3) {
                        $phoneShop = substr($phone, 0, -3) . '***';
                    } else {
                        $phoneShop = str_repeat('*', $len);
                    }
                } else {
                    // Không có phone → số mặc định
                    $phoneShop = $defaultPhone;
                }
                $isPhone = true;
            }else {
                if (!empty($phone)) {
                    $phoneShop = $phone;
                    $isPhone   = true;
                }
                // Không có phone → giữ email
            }
            // Chỉ format nếu là phone
            if ($isPhone) {
                $phoneShop = MyFunction::formatPhoneNumber($phoneShop);
                if (in_array($userInfo['user_id'], [1984152512])) {
                    $phoneShop = '0989966668 - 0902281251 - banquatang@vkdgroup.vn';
                }
            }
            return [
                'userInfo' => $userInfo,
                'productDrugstore' => $productDrugstore,
                'address' => $address,
                'map' => $map,
                'title' => $title,
                'ratingShop' => $ratingShop,
                'productKhuyenMai' => $productKhuyenMai,
                'albumImageCurrent' => $albumImageCurrent,
                'averageRating' => $averageRating,
                'ratingPercentages' => $ratingPercentages,
                'imageMap' => $imageMap,
                'phoneShop' => $phoneShop,
                'item' => $item,            
                'imageSrc' => $imageSrc,            
                'userType' => $userType,            
            ];
        });
        if (!$data) {
            return redirect()->route('home');
        }
        return view($this->pathViewController . 'drugstore', $data);
    }
    public function addCommentProduct(Request $request)
    {
        $data = $request->all();
        $params['user_id'] = $request->input('userId');
        $params['product_id'] = $request->input('productId');
        $params['shop_id'] = $request->input('shopId');
        $params['content'] = $request->input('content');
        $params['fullname'] = $request->input('fullname');
        $params['phone'] = $request->input('phone');
        $params['parent_id'] = $request->input('parentid');
        $params['rating'] = $request->input('rating') ?? null;
        $params['albumImage'] = $request->file('albumImage') ?? null;
        (new CommentModel)->saveItem($params, ['task' => 'add-item']);
        $productId=$params['product_id'];
        Cache::tags(['duoctot_product'])->flush();
        if ($request->rating != null) {
            if ($request->shopId) {
                Cache::tags('duoctot_drugstore')->flush();
                $ratingShop = (new CommentModel)->listItems(['shop_id' => $params['shop_id'], 'rating' => 1], ['task' => 'list-items-frontend']);
                $userInfo['user_id'] = $params['shop_id'];
                return view("$this->moduleName.pages.product.child_drugstore.content_rating", [
                    'ratingShop' => $ratingShop,
                    'userInfo' => $userInfo
                ]);
            } else {
                $ratingProduct = (new CommentModel)->listItems(['product_id' => $params['product_id'], 'rating' => 1], ['task' => 'list-items-frontend']);
                $item['id'] = $params['product_id'];
                return view("$this->moduleName.pages.product.child_detail.content_rating", [
                    'ratingProduct' => $ratingProduct,
                    'item' => $item
                ]);
            }
        } else {
            if ($request->shopId) {
                $commentShop = (new CommentModel)->listItems(['shop_id' => $params['shop_id']], ['task' => 'list-items-frontend']);
                $userInfo['id'] = $params['shop_id'];
                return view("$this->moduleName.pages.product.child_drugstore.content_comment", [
                    'commentShop' => $commentShop,
                    'shopId' => $params['shop_id']
                ]);
            } else {
                $commentProduct = (new CommentModel)->listItems(['product_id' => $params['product_id']], ['task' => 'list-items-frontend']);
                return view("$this->moduleName.pages.product.child_detail.content_comment", [
                    'commentProduct' => $commentProduct,
                    'productId' => $params['product_id']
                ]);
            }
        }
    }
    public function listShop(Request $request)
    {
        // Cache key theo full query (page + filter)
        $cacheKey = 'duoctot_list_shopchung_' . md5(json_encode($request->all()));
        $data = Cache::tags(['duoctot_shopchung'])->remember($cacheKey, 600, function () use ($request) {
            $phoneOfShopConfig = Cache::tags(['duoctot_config'])->remember('duoctot_config_hotline_duoc', 3600, function () {
                return ConfigModel::where('name', 'hotline_duoc')->value('content') ?? '';
            });
            $itemsProvince = (new ProvinceModel())->listItems(null, ['task' => 'admin-list-items-in-selectbox']);
            $itemsDistrict = [];
            $query = UsersModel::whereIn('user_type_id', [10])
                ->orderBy('user_id', 'DESC');
            // Cookie province
            if (!empty($_COOKIE['province'])) {
                $query->where('province_id', $this->getProvinceID($_COOKIE['province']));
            }
            // Province filter
            if ($request->input('province_id')) {
                $prv = ProvinceModel::find((int)$request->input('province_id'));
                if ($prv) {
                    $query->where('province_id', $prv->id);
                    $itemsDistrict = (new DistrictModel())->listItems(
                        ['parentID' => $prv->id],
                        ['task' => 'admin-list-items-in-selectbox']
                    );
                }
            }
            // District filter
            if ($request->input('district_id')) {
                $itemDistrict = DistrictModel::find((int)$request->input('district_id'));
                if ($itemDistrict) {
                    $arrUserID = UserValuesModel::where('value', $itemDistrict->id)
                        ->where('user_field', 'district_id')
                        ->pluck('user_id')
                        ->toArray();
                    $query->whereIn('user_id', $arrUserID);
                }
            }
            // Search
            if ($request->input('fullname')) {
                $fullname = htmlspecialchars($request->input('fullname'), ENT_QUOTES, 'UTF-8');
                $query->where(function ($q) use ($fullname) {
                    $q->where('fullname', 'like', "%$fullname%")
                        ->orWhere('phone', 'like', "%$fullname%");
                });
            }
            $items = $query->paginate(10);
            // Transform
            $items->getCollection()->transform(function ($val) use ($phoneOfShopConfig) {
                $val->imgThumb = !empty($val['details']['image'])
                    ? route('home') . '/public'.$val['details']['image']
                    : route('home') . '/public/fileUpload/nhathuoc/nhathuocmau10.jpg';

                $val->linkShop = route('fe.product.drugstore', $val['slug']);
                $val->address = $this->buildAddress($val['details'] ?? null);
                $phoneShop = $val['phone'] ?? $phoneOfShopConfig;
                if (!empty($phoneShop)) {
                    $len = strlen($phoneShop);
                    if ($len > 3) {
                        $phoneOfShopShow = substr($phoneShop, 0, -3) . '***';
                    } else {
                        $phoneOfShopShow = str_repeat('*', $len);
                    }
                } else {
                    $phoneOfShopShow = $phoneShop;
                }
                $val->phoneFormatted = MyFunction::formatPhoneNumber($phoneOfShopShow) ?? '';
                return $val;
            });
            return [
                'itemsProvinces' => $itemsProvince,
                'itemsDistricts' => $itemsDistrict,
                'items' => $items,
                'title' => 'Danh sách Shop Dược | Duoctot.com'
            ];
        });
        return view($this->pathViewController . 'ls_shop', $data);
    }
    public function listShopMomBaby(Request $request)
    {
        // Cache key theo full query (page + filter)
        $cacheKey = 'duoctot_list_mevabe_' . md5(json_encode($request->all()));
        $data = Cache::tags(['duoctot_mevabe'])->remember($cacheKey, 600, function () use ($request) {
            $phoneOfShopConfig = Cache::tags(['duoctot_config'])->remember('duoctot_config_hotline_duoc', 3600, function () {
                return ConfigModel::where('name', 'hotline_duoc')->value('content') ?? '';
            });
            $itemsProvince = (new ProvinceModel())->listItems(null, ['task' => 'admin-list-items-in-selectbox']);
            $itemsDistrict = [];
            $query = UsersModel::whereIn('user_type_id', [11])
                ->orderBy('user_id', 'DESC');
            // Cookie province
            if (!empty($_COOKIE['province'])) {
                $query->where('province_id', $this->getProvinceID($_COOKIE['province']));
            }
            // Province filter
            if ($request->input('province_id')) {
                $prv = ProvinceModel::find((int)$request->input('province_id'));
                if ($prv) {
                    $query->where('province_id', $prv->id);
                    $itemsDistrict = (new DistrictModel())->listItems(
                        ['parentID' => $prv->id],
                        ['task' => 'admin-list-items-in-selectbox']
                    );
                }
            }
            // District filter
            if ($request->input('district_id')) {
                $itemDistrict = DistrictModel::find((int)$request->input('district_id'));
                if ($itemDistrict) {
                    $arrUserID = UserValuesModel::where('value', $itemDistrict->id)
                        ->where('user_field', 'district_id')
                        ->pluck('user_id')
                        ->toArray();
                    $query->whereIn('user_id', $arrUserID);
                }
            }
            // Search
            if ($request->input('fullname')) {
                $fullname = htmlspecialchars($request->input('fullname'), ENT_QUOTES, 'UTF-8');
                $query->where(function ($q) use ($fullname) {
                    $q->where('fullname', 'like', "%$fullname%")
                        ->orWhere('phone', 'like', "%$fullname%");
                });
            }
            $items = $query->paginate(10);
            // Transform
            $items->getCollection()->transform(function ($val) use ($phoneOfShopConfig) {
                $val->imgThumb = !empty($val['details']['image'])
                    ? route('home') . '/public'.$val['details']['image']
                    : route('home') . '/public/fileUpload/nhathuoc/nhathuocmau10.jpg';

                $val->linkShop = route('fe.product.drugstore', $val['slug']);
                $val->address = $this->buildAddress($val['details'] ?? null);
                $phoneShop = $val['phone'] ?? $phoneOfShopConfig;
                if (!empty($phoneShop)) {
                    $len = strlen($phoneShop);
                    if ($len > 3) {
                        $phoneOfShopShow = substr($phoneShop, 0, -3) . '***';
                    } else {
                        $phoneOfShopShow = str_repeat('*', $len);
                    }
                } else {
                    $phoneOfShopShow = $phoneShop;
                }
                $val->phoneFormatted = MyFunction::formatPhoneNumber($phoneOfShopShow) ?? '';
                return $val;
            });
            return [
                'itemsProvinces' => $itemsProvince,
                'itemsDistricts' => $itemsDistrict,
                'items' => $items,
                'title' => 'Danh sách Mẹ và Bé | Duoctot.com'
            ];
        });
        return view($this->pathViewController . 'ls_shop', $data);
    }
    public function listTrinhDuocVien(Request $request)
    {
        // Cache key theo full query (page + filter)
        $cacheKey = 'duoctot_list_trinhduocvien_' . md5(json_encode($request->all()));
        $data = Cache::tags(['duoctot_trinhduocvien'])->remember($cacheKey, 600, function () use ($request) {
            $phoneOfShopConfig = Cache::tags(['duoctot_config'])->remember('duoctot_config_hotline_duoc', 3600, function () {
                return ConfigModel::where('name', 'hotline_duoc')->value('content') ?? '';
            });
            $itemsProvince = (new ProvinceModel())->listItems(null, ['task' => 'admin-list-items-in-selectbox']);
            $itemsDistrict = [];
            $query = UsersModel::whereIn('user_type_id', [6])
                ->orderBy('user_id', 'DESC');
            // Cookie province
            if (!empty($_COOKIE['province'])) {
                $query->where('province_id', $this->getProvinceID($_COOKIE['province']));
            }
            // Province filter
            if ($request->input('province_id')) {
                $prv = ProvinceModel::find((int)$request->input('province_id'));
                if ($prv) {
                    $query->where('province_id', $prv->id);
                    $itemsDistrict = (new DistrictModel())->listItems(
                        ['parentID' => $prv->id],
                        ['task' => 'admin-list-items-in-selectbox']
                    );
                }
            }
            // District filter
            if ($request->input('district_id')) {
                $itemDistrict = DistrictModel::find((int)$request->input('district_id'));
                if ($itemDistrict) {
                    $arrUserID = UserValuesModel::where('value', $itemDistrict->id)
                        ->where('user_field', 'district_id')
                        ->pluck('user_id')
                        ->toArray();
                    $query->whereIn('user_id', $arrUserID);
                }
            }
            // Search
            if ($request->input('fullname')) {
                $fullname = htmlspecialchars($request->input('fullname'), ENT_QUOTES, 'UTF-8');
                $query->where(function ($q) use ($fullname) {
                    $q->where('fullname', 'like', "%$fullname%")
                        ->orWhere('phone', 'like', "%$fullname%");
                });
            }
            $items = $query->paginate(10);
            // Transform
            $items->getCollection()->transform(function ($val) use ($phoneOfShopConfig) {
                $val->imgThumb = !empty($val['details']['image'])
                    ? route('home') . '/public'.$val['details']['image']
                    : route('home') . '/public/fileUpload/nhathuoc/nhathuocmau10.jpg';

                $val->linkShop = route('fe.product.drugstore', $val['slug']);
                $val->address = $this->buildAddress($val['details'] ?? null);
                $phoneShop = $val['phone'] ?? $phoneOfShopConfig;
                if (!empty($phoneShop)) {
                    $len = strlen($phoneShop);
                    if ($len > 3) {
                        $phoneOfShopShow = substr($phoneShop, 0, -3) . '***';
                    } else {
                        $phoneOfShopShow = str_repeat('*', $len);
                    }
                } else {
                    $phoneOfShopShow = $phoneShop;
                }
                $val->phoneFormatted = MyFunction::formatPhoneNumber($phoneOfShopShow) ?? '';
                return $val;
            });
            return [
                'itemsProvinces' => $itemsProvince,
                'itemsDistricts' => $itemsDistrict,
                'items' => $items,
                'title' => 'Danh sách Trình Dược Viên | Duoctot.com'
            ];
        });
        return view($this->pathViewController . 'ls_trinhduocvien', $data);
    }
    public function listDrugstore(Request $request)
    {
        // Cache key theo full query (page + filter)
        $cacheKey = 'duoctot_list_nhathuoc_' . md5(json_encode($request->all()));
        $data = Cache::tags(['duoctot_nhathuoc'])->remember($cacheKey, 600, function () use ($request) {
            $phoneOfShopConfig = Cache::tags(['duoctot_config'])->remember('duoctot_config_hotline_duoc', 3600, function () {
                return ConfigModel::where('name', 'hotline_duoc')->value('content') ?? '';
            });
            $itemsProvince = (new ProvinceModel())->listItems(null, ['task' => 'admin-list-items-in-selectbox']);
            $itemsDistrict = [];
            $query = UsersModel::whereIn('user_type_id', [4])
                ->orderBy('user_id', 'DESC');
            // Cookie province
            if (!empty($_COOKIE['province'])) {
                $query->where('province_id', $this->getProvinceID($_COOKIE['province']));
            }
            // Province filter
            if ($request->input('province_id')) {
                $prv = ProvinceModel::find((int)$request->input('province_id'));
                if ($prv) {
                    $query->where('province_id', $prv->id);
                    $itemsDistrict = (new DistrictModel())->listItems(
                        ['parentID' => $prv->id],
                        ['task' => 'admin-list-items-in-selectbox']
                    );
                }
            }
            // District filter
            if ($request->input('district_id')) {
                $itemDistrict = DistrictModel::find((int)$request->input('district_id'));
                if ($itemDistrict) {
                    $arrUserID = UserValuesModel::where('value', $itemDistrict->id)
                        ->where('user_field', 'district_id')
                        ->pluck('user_id')
                        ->toArray();
                    $query->whereIn('user_id', $arrUserID);
                }
            }
            // Search
            if ($request->input('fullname')) {
                $fullname = htmlspecialchars($request->input('fullname'), ENT_QUOTES, 'UTF-8');
                $query->where(function ($q) use ($fullname) {
                    $q->where('fullname', 'like', "%$fullname%")
                        ->orWhere('phone', 'like', "%$fullname%");
                });
            }
            $items = $query->paginate(10);
            // Transform
            $items->getCollection()->transform(function ($val) use ($phoneOfShopConfig) {
                $val->imgThumb = !empty($val['details']['image'])
                    ? route('home') .'/public'.$val['details']['image']
                    : route('home') . '/public/fileUpload/nhathuoc/nhathuocmau10.jpg';

                $val->linkShop = route('fe.product.drugstore', $val['slug']);
                $val->address = $this->buildAddress($val['details'] ?? null);
                $phoneOfShopShow = $val['phone'] ?? $phoneOfShopConfig;
                $val->phoneFormatted = MyFunction::formatPhoneNumber($phoneOfShopShow) ?? '';
                return $val;
            });
            return [
                'itemsProvinces' => $itemsProvince,
                'itemsDistricts' => $itemsDistrict,
                'items' => $items,
                'title' => 'Danh sách Nhà thuốc | Duoctot.com'
            ];
        });
        return view($this->pathViewController . 'ls_drugstore', $data);
    }
    public function listNhaCungCap(Request $request)
    {
        $itemsProvince = (new ProvinceModel())->listItems(null, ['task' => 'admin-list-items-in-selectbox']);
        $itemsDistrict = [];
        $query = UsersModel::whereIn('user_type_id', [9])->orderBy('user_id', 'DESC');
        if (isset($_COOKIE['province']) && $_COOKIE['province'] != "") {
            $query = $query->where('province_id', $this->getProvinceID($_COOKIE['province']));
        }
        if ($request->input('province_id') != null) {
            $prv = ProvinceModel::where('id', intval($request->input('province_id')))->first();

            if ($prv != null) {
                $query = $query->where('province_id', $prv->id);
            }
            $itemsDistrict = (new DistrictModel())->listItems(['parentID' =>  $prv->id], ['task' => 'admin-list-items-in-selectbox']);
        }
        if ($request->input('district_id') != null) {
            $itemDistrict = DistrictModel::where('id', intval($request->input('district_id')))->first();
            if ($itemDistrict != null) {
                $arrUserID = UserValuesModel::select('user_id')
                    ->where('value', $itemDistrict->id)
                    ->where('user_field', 'district_id')
                    ->pluck('user_id')->toArray();
                $query = $query->whereIn('user_id', $arrUserID);
            }
        }
        if ($request->input('fullname') != null) {
            $fullname = htmlspecialchars($request->input('fullname'), ENT_QUOTES, 'UTF-8');
            $query = $query->where(function ($q) use ($fullname) {
                $q->where([
                    ['fullname', 'like', "%$fullname%"],
                ])->orWhere([
                    ['phone', 'like', "%$fullname%"],
                ]);
            });
        }
        $items = $query->paginate(10);
        $title = 'Danh sách Nhà cung cấp | Duoctot.com';
        return view(
            $this->pathViewController . 'ls_nhacungcap',
            [
                'itemsProvinces' => $itemsProvince,
                'itemsDistricts' => $itemsDistrict,
                'items' => $items,
                'title' => $title
            ]
        );
    }
    public function listPhongKham(Request $request)
    {
        // Cache key theo full query (page + filter)
        $cacheKey = 'duoctot_list_phongkham_' . md5(json_encode($request->all()));
        $data = Cache::tags(['duoctot_phongkham'])->remember($cacheKey, 600, function () use ($request) {
            $phoneOfShopConfig = Cache::tags(['duoctot_config'])->remember('duoctot_config_hotline_duoc', 3600, function () {
                return ConfigModel::where('name', 'hotline_duoc')->value('content') ?? '';
            });
            $itemsProvince = (new ProvinceModel())->listItems(null, ['task' => 'admin-list-items-in-selectbox']);
            $itemsDistrict = [];
            $query = UsersModel::whereIn('user_type_id', [3])
                ->orderBy('user_id', 'DESC');
            // Cookie province
            if (!empty($_COOKIE['province'])) {
                $query->where('province_id', $this->getProvinceID($_COOKIE['province']));
            }
            // Province filter
            if ($request->input('province_id')) {
                $prv = ProvinceModel::find((int)$request->input('province_id'));
                if ($prv) {
                    $query->where('province_id', $prv->id);
                    $itemsDistrict = (new DistrictModel())->listItems(
                        ['parentID' => $prv->id],
                        ['task' => 'admin-list-items-in-selectbox']
                    );
                }
            }
            // District filter
            if ($request->input('district_id')) {
                $itemDistrict = DistrictModel::find((int)$request->input('district_id'));
                if ($itemDistrict) {
                    $arrUserID = UserValuesModel::where('value', $itemDistrict->id)
                        ->where('user_field', 'district_id')
                        ->pluck('user_id')
                        ->toArray();
                    $query->whereIn('user_id', $arrUserID);
                }
            }
            // Search
            if ($request->input('fullname')) {
                $fullname = htmlspecialchars($request->input('fullname'), ENT_QUOTES, 'UTF-8');
                $query->where(function ($q) use ($fullname) {
                    $q->where('fullname', 'like', "%$fullname%")
                        ->orWhere('phone', 'like', "%$fullname%");
                });
            }
            $items = $query->paginate(10);
            // Transform
            $items->getCollection()->transform(function ($val) use ($phoneOfShopConfig) {
                $val->imgThumb = !empty($val['details']['image'])
                    ? route('home') . '/public'.$val['details']['image']
                    : route('home') . '/public/fileUpload/nhathuoc/6898a7055dafb.jpg';

                $val->linkShop = route('fe.product.drugstore', $val['slug']);
                $val->address = $this->buildAddress($val['details'] ?? null);
                $phoneOfShopShow = $val['phone'] ?? $phoneOfShopConfig;
                $val->phoneFormatted = MyFunction::formatPhoneNumber($phoneOfShopShow) ?? '';
                return $val;
            });
            return [
                'itemsProvinces' => $itemsProvince,
                'itemsDistricts' => $itemsDistrict,
                'items' => $items,
                'title' => 'Danh sách Phòng Khám | Duoctot.com'
            ];
        });
        return view($this->pathViewController . 'ls_phongkham', $data);
    }
    public function listBenhVien(Request $request)
    {
        // Cache key theo full query (page + filter)
        $cacheKey = 'duoctot_list_benhvien_' . md5(json_encode($request->all()));
        $data = Cache::tags(['duoctot_benhvien'])->remember($cacheKey, 600, function () use ($request) {
            $phoneOfShopConfig = Cache::tags(['duoctot_config'])->remember('duoctot_config_hotline_duoc', 3600, function () {
                return ConfigModel::where('name', 'hotline_duoc')->value('content') ?? '';
            });
            $itemsProvince = (new ProvinceModel())->listItems(null, ['task' => 'admin-list-items-in-selectbox']);
            $itemsDistrict = [];
            $query = UsersModel::whereIn('user_type_id', [12])
                ->orderBy('user_id', 'DESC');
            // Cookie province
            if (!empty($_COOKIE['province'])) {
                $query->where('province_id', $this->getProvinceID($_COOKIE['province']));
            }
            // Province filter
            if ($request->input('province_id')) {
                $prv = ProvinceModel::find((int)$request->input('province_id'));
                if ($prv) {
                    $query->where('province_id', $prv->id);
                    $itemsDistrict = (new DistrictModel())->listItems(
                        ['parentID' => $prv->id],
                        ['task' => 'admin-list-items-in-selectbox']
                    );
                }
            }
            // District filter
            if ($request->input('district_id')) {
                $itemDistrict = DistrictModel::find((int)$request->input('district_id'));
                if ($itemDistrict) {
                    $arrUserID = UserValuesModel::where('value', $itemDistrict->id)
                        ->where('user_field', 'district_id')
                        ->pluck('user_id')
                        ->toArray();
                    $query->whereIn('user_id', $arrUserID);
                }
            }
            // Search
            if ($request->input('fullname')) {
                $fullname = htmlspecialchars($request->input('fullname'), ENT_QUOTES, 'UTF-8');
                $query->where(function ($q) use ($fullname) {
                    $q->where('fullname', 'like', "%$fullname%")
                        ->orWhere('phone', 'like', "%$fullname%");
                });
            }
            $items = $query->paginate(10);
            // Transform
            $items->getCollection()->transform(function ($val) use ($phoneOfShopConfig) {
                $val->imgThumb = !empty($val['details']['image'])
                    ? route('home') . '/public'.$val['details']['image']
                    : route('home') . '/public/fileUpload/nhathuoc/benh_vien_mac_dinh.jpg';

                $val->linkShop = route('fe.product.drugstore', $val['slug']);
                $val->address = $this->buildAddress($val['details'] ?? null);
                $phoneOfShopShow = $val['phone'] ?? $phoneOfShopConfig;
                $val->phoneFormatted = MyFunction::formatPhoneNumber($phoneOfShopShow) ?? '';
                return $val;
            });
            return [
                'itemsProvinces' => $itemsProvince,
                'itemsDistricts' => $itemsDistrict,
                'items' => $items,
                'title' => 'Danh sách Bệnh Viện | Duoctot.com'
            ];
        });        
        return view($this->pathViewController . 'ls_benhvien', $data);
    }
    public function listThamMyVien(Request $request)
    {
        // Cache key theo full query (page + filter)
        $cacheKey = 'duoctot_list_thammy_' . md5(json_encode($request->all()));
        $data = Cache::tags(['duoctot_thammy'])->remember($cacheKey, 600, function () use ($request) {
            $phoneOfShopConfig = Cache::tags(['duoctot_config'])->remember('duoctot_config_hotline_duoc', 3600, function () {
                return ConfigModel::where('name', 'hotline_duoc')->value('content') ?? '';
            });
            $itemsProvince = (new ProvinceModel())->listItems(null, ['task' => 'admin-list-items-in-selectbox']);
            $itemsDistrict = [];
            $query = UsersModel::whereIn('user_type_id', [8])
                ->orderBy('user_id', 'DESC');
            // Cookie province
            if (!empty($_COOKIE['province'])) {
                $query->where('province_id', $this->getProvinceID($_COOKIE['province']));
            }
            // Province filter
            if ($request->input('province_id')) {
                $prv = ProvinceModel::find((int)$request->input('province_id'));
                if ($prv) {
                    $query->where('province_id', $prv->id);
                    $itemsDistrict = (new DistrictModel())->listItems(
                        ['parentID' => $prv->id],
                        ['task' => 'admin-list-items-in-selectbox']
                    );
                }
            }
            // District filter
            if ($request->input('district_id')) {
                $itemDistrict = DistrictModel::find((int)$request->input('district_id'));
                if ($itemDistrict) {
                    $arrUserID = UserValuesModel::where('value', $itemDistrict->id)
                        ->where('user_field', 'district_id')
                        ->pluck('user_id')
                        ->toArray();
                    $query->whereIn('user_id', $arrUserID);
                }
            }
            // Search
            if ($request->input('fullname')) {
                $fullname = htmlspecialchars($request->input('fullname'), ENT_QUOTES, 'UTF-8');
                $query->where(function ($q) use ($fullname) {
                    $q->where('fullname', 'like', "%$fullname%")
                        ->orWhere('phone', 'like', "%$fullname%");
                });
            }
            $items = $query->paginate(10);
            // Transform
            $items->getCollection()->transform(function ($val) use ($phoneOfShopConfig) {
                $val->imgThumb = !empty($val['details']['image'])
                    ? route('home') . '/public'.$val['details']['image']
                    : route('home') . '/public/fileUpload/nhathuoc/6898a7055dafb.jpg';

                $val->linkShop = route('fe.product.drugstore', $val['slug']);
                $val->address = $this->buildAddress($val['details'] ?? null);
                $phoneOfShopShow = $val['phone'] ?? $phoneOfShopConfig;
                $val->phoneFormatted = MyFunction::formatPhoneNumber($phoneOfShopShow) ?? '';
                return $val;
            });
            return [
                'itemsProvinces' => $itemsProvince,
                'itemsDistricts' => $itemsDistrict,
                'items' => $items,
                'title' => 'Danh sách Thẩm Mỹ Viện | Duoctot.com'
            ];
        });        
        return view($this->pathViewController . 'ls_thammyvien', $data);
    }
    public function listBacSi(Request $request)
    {
        // Cache key theo full query (page + filter)
        $cacheKey = 'duoctot_list_bacsi_' . md5(json_encode($request->all()));
        $data = Cache::tags(['duoctot_bacsi'])->remember($cacheKey, 600, function () use ($request) {
            $phoneOfShopConfig = Cache::tags(['duoctot_config'])->remember('duoctot_config_hotline_duoc', 3600, function () {
                return ConfigModel::where('name', 'hotline_duoc')->value('content') ?? '';
            });
            $itemsProvince = (new ProvinceModel())->listItems(null, ['task' => 'admin-list-items-in-selectbox']);
            $itemsDistrict = [];
            $query = UsersModel::whereIn('user_type_id', [2])
                ->orderBy('user_id', 'DESC');
            // Cookie province
            if (!empty($_COOKIE['province'])) {
                $query->where('province_id', $this->getProvinceID($_COOKIE['province']));
            }
            // Province filter
            if ($request->input('province_id')) {
                $prv = ProvinceModel::find((int)$request->input('province_id'));
                if ($prv) {
                    $query->where('province_id', $prv->id);
                    $itemsDistrict = (new DistrictModel())->listItems(
                        ['parentID' => $prv->id],
                        ['task' => 'admin-list-items-in-selectbox']
                    );
                }
            }
            // District filter
            if ($request->input('district_id')) {
                $itemDistrict = DistrictModel::find((int)$request->input('district_id'));
                if ($itemDistrict) {
                    $arrUserID = UserValuesModel::where('value', $itemDistrict->id)
                        ->where('user_field', 'district_id')
                        ->pluck('user_id')
                        ->toArray();
                    $query->whereIn('user_id', $arrUserID);
                }
            }
            // Search
            if ($request->input('fullname')) {
                $fullname = htmlspecialchars($request->input('fullname'), ENT_QUOTES, 'UTF-8');
                $query->where(function ($q) use ($fullname) {
                    $q->where('fullname', 'like', "%$fullname%")
                        ->orWhere('phone', 'like', "%$fullname%");
                });
            }
            $items = $query->paginate(10);
            // Transform
            $items->getCollection()->transform(function ($val) use ($phoneOfShopConfig) {
                $val->imgThumb = !empty($val['details']['image'])
                    ? route('home') . '/public'.$val['details']['image']
                    : route('home') . '/public/fileUpload/nhathuoc/6898c9b8bf789.jpg';

                $val->linkShop = route('fe.product.drugstore', $val['slug']);
                $val->address = $this->buildAddress($val['details'] ?? null);
                $phoneOfShopShow = $val['phone'] ?? $phoneOfShopConfig;
                $val->phoneFormatted = MyFunction::formatPhoneNumber($phoneOfShopShow) ?? '';
                return $val;
            });
            return [
                'itemsProvinces' => $itemsProvince,
                'itemsDistricts' => $itemsDistrict,
                'items' => $items,
                'title' => 'Danh sách Bác Sĩ | Duoctot.com'
            ];
        });
        return view($this->pathViewController . 'ls_bacsi', $data);
    }
    public function contentIntroduce(Request $request)
    {
        return view($this->pathViewController . 'content_introduce');
    }
    private function buildAddress($details)
    {
        if (empty($details)) return '';
        $addressBase = trim($details['address'] ?? '');
        $wardId     = $details['ward_id'] ?? null;
        $districtId = $details['district_id'] ?? null;
        $provinceId = $details['province_id'] ?? null;
        $ward = '';
        $district = '';
        $province = '';
        // ===== 1. Ưu tiên ward =====
        if ($wardId) {
            $wardDetail = Cache::remember('ward_full_' . $wardId, 3600, function () use ($wardId) {
                return WardModel::with('district.province')->find($wardId) ?: '__null__';
            });
            if ($wardDetail !== '__null__' && $wardDetail) {
                $ward     = $wardDetail->name ?? '';
                $district = $wardDetail->district->name ?? '';
                $province = $wardDetail->district->province->name ?? '';
            }
        }
        // ===== 2. Fallback district =====
        if (empty($district) && $districtId) {
            $districtDetail = Cache::remember('district_full_' . $districtId, 3600, function () use ($districtId) {
                return DistrictModel::with('province')->find($districtId) ?: '__null__';
            });
            if ($districtDetail !== '__null__' && $districtDetail) {
                $district = $districtDetail->name ?? '';
                $province = $districtDetail->province->name ?? '';
            }
        }
        // ===== 3. Fallback province =====
        if (empty($province) && $provinceId) {
            $provinceDetail = Cache::remember('province_' . $provinceId, 3600, function () use ($provinceId) {
                return ProvinceModel::find($provinceId) ?: '__null__';
            });
            if ($provinceDetail !== '__null__' && $provinceDetail) {
                $province = $provinceDetail->name ?? '';
            }
        }
        // ===== 4. Build chuỗi =====
        $parts = [];
        if ($addressBase) $parts[] = $addressBase;
        if ($ward)        $parts[] = $ward;
        if ($district)    $parts[] = $district;
        if ($province)    $parts[] = $province;
        return !empty($parts) ? implode(', ', $parts) : '';
    }
}
