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
    public function detail(Request $request)
    {
        $slug = $request->slug;
        $codeRefRegister = '';
        $session = $request->session();
        if ($session->has('user')) {
            $userInfoCurrent = $request->session()->get('user');
            $userInfoCurrent = (new UsersModel)->getItem(['user_id' => $userInfoCurrent['user_id']], ['task' => 'get-item']);
            $codeRefLogin = $userInfoCurrent['codeRef'];
            $codeRefRegister = $userInfoCurrent['ref_register'] ?? '';
        } else {
            $codeRefLogin = '';
        }
        $codeRef = $request->codeRef ?? ($request->session()->get('codeRef') ?? $codeRefRegister);
        if ((empty($request->codeRef) && session('codeRef')) || (empty($request->codeRef) && $codeRefRegister != '')) {
            return redirect()->route('fe.product.detail', ['slug' => $slug, 'codeRef' => $codeRef]);
        }
        $item = $this->model->getItem(['slug' => $slug], ['task' => 'frontend-get-item']);
        if (!$item) {
            return redirect()->route('home');
        }
        if ($request->codeRef) {
            $userCodeRef = UsersModel::where('codeRef', $request->codeRef)->first();
            if ($userCodeRef) {
                $existProductAffiliate = AffiliateProductModel::where('product_id', $item['id'])->where('user_id', $userCodeRef['user_id'])->first();
                if ($existProductAffiliate) {
                    $existProductAffiliate->increment('sum_click');
                } else {
                    (new AffiliateProductModel)->saveItem(['product_id' => $item['id'], 'user_id' => $userCodeRef['user_id'], 'sum_click' => 1], ['task' => 'add-item']);
                }
            }
        }
        $userInfo = (new UsersModel)->getItem(['user_id' => $item['user_id']], ['task' => 'get-item']);
        $albumImageCurrent = !empty($item['albumImageHash']) ? explode('|', $item['albumImageHash']) : [];
        $productViewed  = (isset($_COOKIE["productViewed"])) ? json_decode($_COOKIE["productViewed"], true) : [];
        $productCurrent = [];
        if (isset($productViewed[$item['id']])) {
            $productCurrent[$item['id']] = $productViewed[$item['id']];
            unset($productViewed[$item['id']]);
        } else {
            $productCurrent[$item['id']] = [
                'product_id' => $item->id,
                'name'       => $item->name,
                'price'      => $item->price,
                'image'      => $item->image,
                'unit'       => $item->unitProduct->name,
                'slug' => $item->slug
            ];
        }
        $productViewed = $productCurrent + $productViewed;
        $params['id'] = $item['id'];
        if (count($productViewed) > 8) {
            array_pop($productViewed);
        }
        setcookie("productViewed", json_encode($productViewed), time() + config('myconfig.time_cookie'), "/");
        $_COOKIE["productViewed"] = json_encode($productViewed);
        $listProductRelate = $this->model->listItems(['cat_product_id' => $item['cat_product_id'], 'limit' => 4], ['task' => 'frontend-list-items']) ?? [];
        $commentProduct = (new CommentModel)->listItems(['product_id' => $item['id']], ['task' => 'list-items-frontend']);
        $ratingProduct = (new CommentModel)->listItems(['product_id' => $item['id'], 'rating' => 1], ['task' => 'list-items-frontend']);
        $productId = $item['id'] ?? '';
        $listUserHasProduct = (new UsersModel)->listItems(['product_id' => $productId], ['task' => 'list-users-nha-cung-cap-has-product-id']);
        //return $listUserHasProduct;
        return view($this->pathViewController . 'detail', compact('params', 'item', 'albumImageCurrent', 'codeRef', 'userInfo', 'codeRefLogin', 'listProductRelate', 'commentProduct', 'ratingProduct', 'listUserHasProduct'));
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
    public function drugstore(Request $request, $slug)
    {
        // Lấy thông tin người dùng từ slug
        $userInfo = UsersModel::where('slug', $slug)->first();
        if (!$userInfo || empty($slug)) {
            return redirect()->route('home');
        }
        $shopId = $userInfo['user_id'];
        // Danh sách sản phẩm mặc định
        $defaultProducts = [2052, 1454, 2331, 2339, 4065, 3844, 2363, 2361, 2332, 2339, 4223, 4246, 1183, 4219];
        $listIdProductAdd = $defaultProducts;
        $listIdProductAddSelect = collect($userInfo->listIdProduct)->pluck('product_id')->toArray();
        // Điều kiện loại bỏ danh sách sản phẩm mặc định
        if ($userInfo['user_type_id'] == 9 || !empty($listIdProductAddSelect)) {
            $listIdProductAdd = [];
        }
        // Loại bỏ sản phẩm nếu user nằm trong danh sách không có sản phẩm
        $usersWithoutProductAdd = [1144150760];
        if (in_array($userInfo['user_id'], $usersWithoutProductAdd)) {
            $listIdProductAdd = [];
        }
        // Lưu mã giới thiệu nếu có
        if ($request->has('codeRef')) {
            $request->session()->put('codeRef', $request->query('codeRef'));
        }
        // Lấy danh sách sản phẩm theo group_id
        $params['group_id'] = array_merge($listIdProductAddSelect, $listIdProductAdd);
        $productDrugstore = $this->model->listItems([
            'group_id' => $params['group_id'],
            'user_id' => $shopId
        ], ['task' => 'frontend-list-item-shop']) ?? [];
        // Nếu tài khoản là loại nhập mã thì không hiển thị sản phẩm
        if ($userInfo['type_account'] === 'code_import') {
            $productDrugstore = [];
        }
        // Xử lý địa chỉ và bản đồ
        $address = $map = $ward = $district = $province = '';
        if (isset($userInfo['details'])) {
            $details = $userInfo['details'];
            $wardDetail = (new WardModel())->getItem(['id' => $details['ward_id']], ['task' => 'get-item-full']);
            if ($wardDetail) {
                $ward = ' ' . ($wardDetail['name'] ?? '');
                $district = ', ' . ($wardDetail['district']['name'] ?? '');
                $province = ', ' . ($wardDetail['district']['province']['name'] ?? '');
            } else {
                $districtDetail = (new ProvinceModel())->getItem(['id' => $details['district_id']], ['task' => 'get-item-full']);
                $provinceDetail = (new ProvinceModel())->getItem(['id' => $details['province_id']], ['task' => 'get-item-full']);

                $district = ', ' . ($districtDetail['name'] ?? '');
                $province = ', ' . ($provinceDetail['name'] ?? '');
            }
            $address = $details['address'] . $ward . $district . $province;
            $map = $details['map'] ?? '';
        }
        // Tiêu đề trang
        $title = !empty($userInfo['fullname'])
            ? $userInfo['fullname']
            : 'Sàn thương mại điện tử trong y dược số 1 Việt Nam';

        // Lấy đánh giá & bình luận shop
        $commentShop = (new CommentModel())->listItems([
            'shop_id' => $shopId
        ], ['task' => 'list-items-frontend']);

        $ratingShop = (new CommentModel())->listItems([
            'shop_id' => $shopId,
            'rating' => 1
        ], ['task' => 'list-items-frontend']);
        // Trả về view
        return view($this->pathViewController . 'drugstore', [
            'userInfo' => $userInfo,
            'productDrugstore' => $productDrugstore,
            'address' => $address,
            'map' => $map,
            'title' => $title,
            'commentShop' => $commentShop,
            'ratingShop' => $ratingShop
        ]);
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
        $title = 'Danh sách Shop dược | Tdoctor';
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
        $title = 'Danh sách Shop Mẹ và Bé | Tdoctor';
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
        $title = 'Danh sách Shop Trình dược viên | Tdoctor';
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
        $title = 'Danh sách Nhà thuốc | Tdoctor';
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
        $title = 'Danh sách Nhà cung cấp | Tdoctor';
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

    public function contentIntroduce(Request $request)
    {
        return view($this->pathViewController . 'content_introduce');
    }
}
