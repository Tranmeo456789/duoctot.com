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
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Cache;

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
    public function detail(Request $request)
    {
        $slug = $request->slug;
        $session = $request->session();
        $codeRefLogin = '';
        $codeRefRegister = '';
        // user login
        if ($session->has('user')) {
            $userInfoCurrent = $session->get('user');
            $codeRefLogin    = $userInfoCurrent['codeRef'] ?? '';
            $codeRefRegister = $userInfoCurrent['ref_register'] ?? '';
            $cacheKey = 'duoctot_product_login_' . $slug;
            $item = Cache::remember($cacheKey, 3600, function () use ($slug) {
                return $this->model->getItem(
                    ['slug' => $slug],
                    ['task' => 'frontend-get-item-has-login']
                );
            });
        }else {
            $cacheKey = 'duoctot_product_guest_' . $slug;
            $item = Cache::remember($cacheKey, 3600, function () use ($slug) {
                return $this->model->getItem(
                    ['slug' => $slug],
                    ['task' => 'frontend-get-item']
                );
            });
        }
        if (!$item) {
            return redirect()->route('home');
        }
        $codeRef = $request->codeRef ?? ($session->get('codeRef') ?? $codeRefRegister);
        // redirect thêm codeRef
        if ((empty($request->codeRef) && session('codeRef')) || (empty($request->codeRef) && $codeRefRegister != '')) {
            return redirect()->route('fe.product.detail', [
                'slug'=>$slug,
                'codeRef'=>$codeRef
            ]);
        }
        if ($request->codeRef) {
            $cacheCodeRef = Cache::get('duoctot_user_by_codeRef_'.$request->codeRef);
            if ($cacheCodeRef !== null) {
                $userCodeRef = !empty($cacheCodeRef) ? $cacheCodeRef : null;
            } else {
                $model = UsersModel::where('codeRef',$request->codeRef)->first();
                $payload = $model ? $model->toArray() : [];
                Cache::put('duoctot_user_by_codeRef_'.$request->codeRef,$payload,100000000);
                $userCodeRef = $model ? $payload : null;
            }
            if ($userCodeRef) {
                $existProductAffiliate = AffiliateProductModel::where([
                    'product_id'=>$item['id'],
                    'user_id'=>$userCodeRef['user_id']
                ])->first();
                if ($existProductAffiliate) {
                    $existProductAffiliate->increment('sum_click');

                } else {
                    (new AffiliateProductModel)->saveItem([
                        'product_id'=>$item['id'],
                        'user_id'=>$userCodeRef['user_id'],
                        'sum_click'=>1
                    ],['task'=>'add-item']);
                }
            }
        }
        $albumImageCurrent = !empty($item['albumImageHash'])
            ? explode('|',$item['albumImageHash'])
            : [];
        $keyCache = 'duoctot_cache_product_data_'.$item['id'];
        $dataCache = Cache::get($keyCache);
        if (!empty($dataCache)) {
            $listProductRelate  = $dataCache['listProductRelate'];
            $ratingProduct      = $dataCache['ratingProduct'];
            $listUserHasProduct = $dataCache['listUserHasProduct'];
            $userInfo = $dataCache['userInfo'];
            $itemCatCurent = $dataCache['itemCatCurent'];
            $itemCatParentLevel1 = $dataCache['itemCatParentLevel1'];
            $itemCatParentLevel2 = $dataCache['itemCatParentLevel2'];
            $averageRating = $dataCache['averageRating'];
            $ratingPercentages = $dataCache['ratingPercentages'];
        } else {
            $listProductRelate = $this->model->listItems(
                ['cat_product_id'=>$item['cat_product_id'],'limit'=>4],
                ['task'=>'frontend-list-items']
            ) ?? [];
            $ratingProduct = (new CommentModel)->listItems(
                ['product_id'=>$item['id'],'rating'=>1],
                ['task'=>'list-items-frontend']
            );
            $listUserHasProduct = (new UsersModel)->listItems(
                ['product_id'=>$item['id']],
                ['task'=>'list-users-nha-cung-cap-has-product-id']
            );
            $userInfo = (new UsersModel)->getItem(
                ['user_id'=>$item['user_id']],
                ['task'=>'get-item']
            );
            $itemCatCurent = $item->catProduct;
            $idCatParentLevel1=$itemCatCurent['parent_id'];
            $itemCatParentLevel1=(new CatProductModel)->getItem(['parent_id'=>$idCatParentLevel1],['task'=>'get-item-parent']);
            $itemCatParentLevel2=(new CatProductModel)->getItem(['parent_id'=>$idCatParentLevel1,'up_level'=>2],['task'=>'get-item-parent']);
            $averageRating=(new CommentModel)->averageRating(['product_id'=>$item['id']],['task' => 'rating-star-average'])??'';
            $ratingPercentages=(new CommentModel)->ratingPercentages(['product_id'=>$item['id']],['task' => 'rating-percentage-star'])??[];
            $dataCache = [
                'listProductRelate'=>$listProductRelate,
                'ratingProduct'=>$ratingProduct,
                'listUserHasProduct'=>$listUserHasProduct,
                'userInfo'=>$userInfo,
                'itemCatCurent'=>$itemCatCurent,
                'itemCatParentLevel1'=>$itemCatParentLevel1,
                'itemCatParentLevel2'=>$itemCatParentLevel2,
                'averageRating'=>$averageRating,
                'ratingPercentages'=>$ratingPercentages,
            ];
            Cache::put($keyCache,$dataCache,100000000);
        }
        $params['id']=$item['id'];
        return view(
            $this->pathViewController.'detail',
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
        $data = Cache::remember($cacheKey, 1800, function () use ($slug) {
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
        if ($request->rating != null) {
            if ($request->shopId) {
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
        $itemsProvince = (new ProvinceModel())->listItems(null, ['task' => 'admin-list-items-in-selectbox']);
        $itemsDistrict = [];
        $query = UsersModel::whereIn('user_type_id', [10])->orderBy('user_id', 'DESC');
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
        $title = 'Danh sách Shop dược | Duoctot.com';
        return view(
            $this->pathViewController . 'ls_shop',
            [
                'itemsProvinces' => $itemsProvince,
                'itemsDistricts' => $itemsDistrict,
                'items' => $items,
                'title' => $title
            ]
        );
    }
    public function listShopMomBaby(Request $request)
    {
        $itemsProvince = (new ProvinceModel())->listItems(null, ['task' => 'admin-list-items-in-selectbox']);
        $itemsDistrict = [];
        $query = UsersModel::whereIn('user_type_id', [11])->orderBy('user_id', 'DESC');
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
        $title = 'Danh sách Shop Mẹ và Bé | Duoctot.com';
        return view(
            $this->pathViewController . 'ls_shop',
            [
                'itemsProvinces' => $itemsProvince,
                'itemsDistricts' => $itemsDistrict,
                'items' => $items,
                'title' => $title
            ]
        );
    }
    public function listTrinhDuocVien(Request $request)
    {
        $itemsProvince = (new ProvinceModel())->listItems(null, ['task' => 'admin-list-items-in-selectbox']);
        $itemsDistrict = [];
        $query = UsersModel::whereIn('user_type_id', [6])->orderBy('user_id', 'DESC');
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
        $title = 'Danh sách Shop Trình dược viên | Duoctot.com';
        return view(
            $this->pathViewController . 'ls_trinhduocvien',
            [
                'itemsProvinces' => $itemsProvince,
                'itemsDistricts' => $itemsDistrict,
                'items' => $items,
                'title' => $title
            ]
        );
    }
    public function listDrugstore(Request $request)
    {
        $itemsProvince = (new ProvinceModel())->listItems(null, ['task' => 'admin-list-items-in-selectbox']);
        $itemsDistrict = [];
        //$query = UsersModel::whereIn('user_type_id', [4])->orderBy('user_id', 'DESC')->where('type_account','<>','code_import');
        $query = UsersModel::whereIn('user_type_id', [4])->orderBy('user_id', 'DESC');
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
        $title = 'Danh sách Nhà thuốc | Duoctot.com';
        return view(
            $this->pathViewController . 'ls_drugstore',
            [
                'itemsProvinces' => $itemsProvince,
                'itemsDistricts' => $itemsDistrict,
                'items' => $items,
                'title' => $title
            ]
        );
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
        $itemsProvince = (new ProvinceModel())->listItems(null, ['task' => 'admin-list-items-in-selectbox']);
        $itemsDistrict = [];
        $query = UsersModel::whereIn('user_type_id', [3])->orderBy('user_id', 'DESC');
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
        $title = 'Danh sách Phòng Khám | Duoctot.com';
        return view(
            $this->pathViewController . 'ls_phongkham',
            [
                'itemsProvinces' => $itemsProvince,
                'itemsDistricts' => $itemsDistrict,
                'items' => $items,
                'title' => $title
            ]
        );
    }
    public function listThamMyVien(Request $request)
    {
        $itemsProvince = (new ProvinceModel())->listItems(null, ['task' => 'admin-list-items-in-selectbox']);
        $itemsDistrict = [];
        $query = UsersModel::whereIn('user_type_id', [8])->orderBy('user_id', 'DESC');
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
        $title = 'Danh sách Thẩm Mỹ Viện | Duoctot.com';
        return view(
            $this->pathViewController . 'ls_thammyvien',
            [
                'itemsProvinces' => $itemsProvince,
                'itemsDistricts' => $itemsDistrict,
                'items' => $items,
                'title' => $title
            ]
        );
    }
    public function listBacSi(Request $request)
    {
        $itemsProvince = (new ProvinceModel())->listItems(null, ['task' => 'admin-list-items-in-selectbox']);
        $itemsDistrict = [];
        $query = UsersModel::whereIn('user_type_id', [2])->orderBy('user_id', 'DESC');
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
        $title = 'Danh sách Bác Sĩ | Duoctot.com';
        return view(
            $this->pathViewController . 'ls_bacsi',
            [
                'itemsProvinces' => $itemsProvince,
                'itemsDistricts' => $itemsDistrict,
                'items' => $items,
                'title' => $title
            ]
        );
    }
    public function contentIntroduce(Request $request)
    {
        return view($this->pathViewController . 'content_introduce');
    }
}
