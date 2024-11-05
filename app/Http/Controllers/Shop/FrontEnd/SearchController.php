<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use App\Model\Shop\AffiliateModel;
use App\Model\Shop\AffiliateProductModel;
use App\Model\Shop\CatalogModel;
use App\Model\Shop\CatProductModel;
use App\Model\Shop\ProductModel;
use App\Model\Shop\OrderModel;
use App\Model\Shop\ProvinceModel;
use App\Model\Shop\DistrictModel;
use App\Model\Shop\WardModel;
use App\Model\Shop\OrderProductModel;
use App\Model\Shop\MyTableModel;
use App\Model\Shop\PostModel;
use App\Users;
use App\Model\Shop\UsersModel;
use App\Model\Shop\UserValuesModel;
use App\Model\Shop\SearchModel as MainModel;
use Illuminate\Support\Str;

class SearchController extends ShopFrontEndController
{
    public function __construct()
    {
        $this->controllerName     = 'search';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Tìm kiếm';
        $this->model = new MainModel();
        parent::__construct();
    }
    public function viewHome(Request $request, $keyword)
    {
        $params['keyword'] = $keyword;
        $itemSearch = (new ProductModel)->listItems($params, ['task' => 'list-items-search']);
        $title = 'Kết quả tìm kiếm';
        return view($this->pathViewController . 'view', ['keyword' => $keyword, 'itemSearch' => $itemSearch, 'title' => $title]);
    }
    public function saveHome(Request $request)
    {
        // save history keyword search
        if (!empty($request->input('btn_search')) && !empty($request->input('keyword')) && trim($request->input('keyword')) !== '') {
            $params = $request->all();
            $itemExist = $this->model->getItem($params, ['task' => 'get-item']);
            $keywordHistory  = (isset($_COOKIE["keywordHistory"])) ? json_decode($_COOKIE["keywordHistory"], true) : [];
            $keywordCurrent = [];
            if (isset($keywordCurrent[$params['keyword']])) {
                $keywordCurrent[$params['keyword']] = $keywordHistory[$params['keyword']];
                unset($keywordHistory[$params['keyword']]);
            } else {
                $keywordCurrent[$params['keyword']] = [
                    'keyword' => $params['keyword'],
                ];
            }
            $keywordHistory = $keywordCurrent + $keywordHistory;
            if (count($keywordHistory) > 5) {
                array_pop($keywordHistory);
            }
            setcookie("keywordHistory", json_encode($keywordHistory), time() + config('myconfig.time_cookie'), "/");
            $_COOKIE["keywordHistory"] = json_encode($keywordHistory);
            //save keyword search most
            if (isset($itemExist)) {
                $params['id'] = $itemExist['id'];
                $params['number_search'] = $itemExist['number_search'];
                $this->model->saveItem($params, ['task' => 'update-number-search-item']);
            } else {
                $this->model->saveItem($params, ['task' => 'add-item-home']);
            }
            return redirect()->route('fe.search.viewHome', ['keyword' => $params['keyword']]);
        } else {
            return redirect()->back();
        }
    }
    public function deleteHistory(Request $request)
    {
        $data = $request->all();
        setcookie("keywordHistory", "", time() - 60, "/", "", 0);
        return view("$this->moduleName.block.menu.child_menu_yes_search.list_history_keyword");
    }
    public function updateFieldSearchKeyword(Request $request)
    {
        $slugs = ProductModel::orderBy('id', 'desc')->pluck('slug');
        $urls = $slugs->map(function ($slug) {
            return 'https://tdoctor.net/chi-tiet-san-pham/' . $slug.'.html';
        });
        foreach ($urls as $url) {
            echo $url . '<br>';
        }
        // $orderAll = OrderModel::all();
        //     foreach ($orderAll as $order) {
        //         $receive = $order->receive;
        //         $province = ProvinceModel::find($receive['province_id']);
        //         $district = DistrictModel::find($receive['district_id']);
        //         $ward = WardModel::find($receive['ward_id']);
        //         $address = $receive['address'];
        //         if ($ward) {
        //             $address .= ', ' . $ward->name; 
        //         }
        //         if ($district) {
        //             $address .= ', ' . $district->name;
        //         }
        //         if ($province) {
        //             $address .= ', ' . $province->name;
        //         }
        //         $order->address_detail = $address;
        //         $order->save();
        //     }
        // return 'ok';
        //add products AffiliateProductModel
        // try {
        //     // Bắt đầu giao dịch
        //     DB::beginTransaction();
        //     // Lấy tất cả người dùng affiliate
        //     $usersAffilate = AffiliateModel::all();
        //     $listProductNeedAdd = [1909, 1910];
        //     $insertData = [];
        //     foreach ($usersAffilate as $user) {
        //         foreach ($listProductNeedAdd as $idProduct) {
        //             $insertData[] = [
        //                 'code_ref'   => $user->code_ref,
        //                 'product_id' => $idProduct,
        //                 'sum_click'  => 0,
        //                 'active'     => 1,
        //                 'user_id'    => $user->user_id,
        //             ];
        //         }
        //     }
        //     // Thực hiện batch insert
        //     AffiliateProductModel::insert($insertData);
        //     // Commit giao dịch nếu không có lỗi
        //     DB::commit();
        //     echo "Dữ liệu đã được thêm thành công.";
        // } catch (\Exception $e) {
        //     // Rollback giao dịch nếu có lỗi
        //     DB::rollback();
        //     // Xử lý lỗi
        //     echo "Đã xảy ra lỗi: " . $e->getMessage();
        // }

        //remove products AffiliateProductModel
        // $listProductNeedRemove = [1894, 1895, 1899, 1910];
        // try {
        //     $deletedRows = AffiliateProductModel::whereIn('product_id', $listProductNeedRemove)->delete();

        //     if ($deletedRows > 0) {
        //         echo "Đã xóa $deletedRows bản ghi thành công.";
        //     } else {
        //         echo "Không có bản ghi nào được xóa.";
        //     }
        // } catch (\Exception $e) {
        //     echo "Có lỗi xảy ra: " . $e->getMessage();
        // }
        //add keywords product search
        // if($request->product){
        //     try {
        //         DB::beginTransaction();
        //         $products = ProductModel::with('trademarkProduct')->select('id', 'name', 'benefit', 'trademark_id','user_id','cat_product_id')->where('status_product', 'da_duyet')->get();
        //         foreach ($products as $product) {
        //             $trademarkName = $product->trademarkProduct ? $product->trademarkProduct->name : '';
        //             $userSell = $product->userProduct ? $product->userProduct->fullname : '';
        //             $catProduct = $product->catProduct ? $product->catProduct->name : '';
        //             $keywordSearch = implode(' ', [
        //                 $trademarkName,
        //                 Str::ascii($trademarkName),
        //                 $userSell,
        //                 Str::ascii($userSell),
        //                 $catProduct,
        //                 Str::ascii($catProduct),
        //                 Str::ascii($product->name),
        //                 Str::ascii($product->benefit),
        //             ]);

        //             ProductModel::where('id', $product['id'])->update(['keyword_search' => $keywordSearch]);
        //         }
        //         DB::commit();
        //         return response()->json(['success' => true, 'message' => 'Cập nhật keyword product thành công']);
        //     } catch (\Exception $e) {
        //         DB::rollBack();
        //         return response()->json(['success' => false, 'message' => $e->getMessage()]);
        //     }
        // }else{
        //     try {
        //         DB::beginTransaction();
        //         $affiliates = AffiliateModel::with('userRef')->select('id', 'code_ref', 'user_id', 'info_user')->get();
        //         foreach ($affiliates as $affiliate) {
        //             $fullname = $affiliate->userRef ? $affiliate->userRef->fullname : '';
        //             $phone = $affiliate->userRef ? $affiliate->userRef->phone : '';
        //             $email = $affiliate->userRef ? $affiliate->userRef->email : '';
        //             $infoUser = implode(' ', [
        //                 $fullname,
        //                 $phone,
        //                 $email
        //             ]);
        //             AffiliateModel::where('id', $affiliate['id'])->update(['info_user' => $infoUser]);
        //         }
        //         DB::commit();
        //         return response()->json(['success' => true, 'message' => 'Cập nhật info user affiliate thành công']);
        //     } catch (\Exception $e) {
        //         DB::rollBack();
        //         return response()->json(['success' => false, 'message' => $e->getMessage()]);
        //     }
        // }

        // add infomation for table order_product
        // $listOrders = OrderModel::all();
        // try {
        //     foreach ($listOrders as $order) {
        //         foreach ($order['info_product'] as $product) {
        //             $paramsOrderProduct['order_id'] = $order['id']??'';
        //             $paramsOrderProduct['product_id'] = $product['product_id']??'';
        //             $paramsOrderProduct['code_order'] = $order['code_order']??'';
        //             $paramsOrderProduct['status_order'] = $order['status_order']??'dangXuLy';
        //             $paramsOrderProduct['quantity'] = $product['quantity']??0;
        //             $paramsOrderProduct['price'] = $product['price']?? 0;
        //             $paramsOrderProduct['unit'] = $product['unit_id']??'';
        //             $paramsOrderProduct['code_ref'] = $product['codeRef']??'';
        //             (new OrderProductModel)->saveItem($paramsOrderProduct, ['task' => 'add-item']);
        //         }
        //     }
        //     return "Thêm dữ liệu vào order_product ok!";
        // } catch (\Exception $e) {
        //     return "Đã xảy ra lỗi khi thêm dữ liệu vào cơ sở dữ liệu: " . $e->getMessage();
        // }

        //validate data nha thuoc len database mytable ở local
            // $userNeedAdd = MyTableModel::all();
            // foreach ($userNeedAdd as $record) {
            //     if (isset($record->D) && $record->D !== null) {
            //         if (strpos($record->D, '0') !== 0) {
            //             $record->D = '0' . $record->D;
            //         }
            //     }
            //     $record->E = 79; //tinh
            //     $record->save();
            // }
            // return $userNeedAdd;
        //add lên bảng user
            //$userNeedAdd = MyTableModel::orderBy('A')->skip(3000)->take(1000)->get();
            // $userNeedAdd = MyTableModel::orderBy('A')->take(479)->get();
            // $count = 1;
            // try {
            //     $successCount = 0;
            //     $failureCount = 0;
            //     $maxRecords = 479; // Giới hạn số bản ghi tối đa cần thêm
            //     foreach ($userNeedAdd as $val) {
            //         if ($successCount >= $maxRecords) {
            //             break; 
            //         }
            //         $params = [
            //             'domain_register' => 'shop.tdoctor.vn',
            //             'fullname' => $val['C'],
            //             'phone' => $val['D'],
            //             'password' => 1234567,
            //             'province_id' => $val['E'],
            //             'district_id' => 783,
            //             'user_type_id' => 4,
            //             'gender' => 3,
            //             'paid' => 1,
            //             'type_account'=>'code_import',
            //             'details' => [
            //                 'member_id' => $val['A'],
            //                 'province_id' => $val['E'],
            //                 'district_id' => 783,
            //                 'ward_id' => '',
            //                 'address' => $val['B'],
            //                 'sell_area' => 0,
            //                 'tax_code' => '',
            //                 'person_represent' => '',
            //                 'map' => "<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d250625.17483345352!2d106.34226217030678!3d11.037249425292385!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310b2d148b9dcd1f%3A0xf325fa2562fcf1b1!2zQ-G7pyBDaGksIEjhu5MgQ2jDrSBNaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1729045618230!5m2!1svi!2s\" width=\"100%\" height=\"340px\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>",
            //                 'slug' => Str::slug($val['C']),
            //                 'image' => "/laravel-filemanager/fileUpload/nhathuoc/nhathuocmau" . $count . ".jpg",
            //             ]
            //         ];
            //         $count++;
            //         if ($count > 10) {
            //             $count = 1;
            //         }
            //         $currentIdUser = (new UsersModel())->saveItem($params, ['task' => 'register']);
            
            //         if ($currentIdUser) {
            //             //$currentIdDelete = UserValuesModel::where('user_id', $currentIdUser)->delete();
            
            //             foreach ($params['details'] as $key => $value) {
            //                 $paramsUserValue = [
            //                     'user_id' => $currentIdUser,
            //                     'user_field' => $key,
            //                     'value' => $value
            //                 ];
            //                 UserValuesModel::insert((new UsersModel())->prepareParams($paramsUserValue));
            //             }
            //             echo "Thêm người dùng thành công: " . $val['A'] . "<br>";
            //             $successCount++;
            //         } else {
            //             echo "Thêm người dùng thất bại: " . $val['A'] . "<br>";
            //             $failureCount++;
            //         }
            //     }
            //     return "Thêm dữ liệu thành công! Số bản ghi thành công: $successCount, Số bản ghi thất bại: $failureCount.";
            // } catch (\Exception $e) {
            //     return "Đã xảy ra lỗi khi thêm dữ liệu vào cơ sở dữ liệu: " . $e->getMessage();
            // }        
            // return 1;
    }
}
