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
use App\Model\Shop\CommentModel;
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
use Illuminate\Support\Facades\Cache;
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
            $keyword=$params['keyword'];
            $itemSearch = (new ProductModel)->listItems($params, ['task' => 'list-items-search']);
            $title = 'Kết quả tìm kiếm';
            return view($this->pathViewController . 'view', ['keyword' => $keyword, 'itemSearch' => $itemSearch, 'title' => $title]);
        } else {
            return redirect()->back();
        }
    }
    // public function search(Request $request)
    // {
    //     $keyword = trim($request->input('keyword'));
    //     if (empty($keyword)) {
    //         return redirect()->back();
    //     }
    //     $params['keyword'] = $keyword;
    //     // Lưu lịch sử tìm kiếm
    //     $keywordHistory = isset($_COOKIE["keywordHistory"])
    //         ? json_decode($_COOKIE["keywordHistory"], true)
    //         : [];
    //     $keywordCurrent = [];
    //     $keywordCurrent[$keyword] = [
    //         'keyword' => $keyword
    //     ];
    //     unset($keywordHistory[$keyword]);
    //     $keywordHistory = $keywordCurrent + $keywordHistory;
    //     if (count($keywordHistory) > 5) {
    //         array_pop($keywordHistory);
    //     }
    //     setcookie(
    //         "keywordHistory",
    //         json_encode($keywordHistory),
    //         time() + config('myconfig.time_cookie'),
    //         "/"
    //     );
    //     $_COOKIE["keywordHistory"] = json_encode($keywordHistory);
    //     // Save keyword search most
    //     // $itemExist = $this->model->getItem($params, ['task' => 'get-item']);
    //     // if ($itemExist) {
    //     //     $params['id'] = $itemExist['id'];
    //     //     $params['number_search'] = $itemExist['number_search'];
    //     //     $this->model->saveItem($params, [
    //     //         'task' => 'update-number-search-item'
    //     //     ]);
    //     // } else {
    //     //     $this->model->saveItem($params, [
    //     //         'task' => 'add-item-home'
    //     //     ]);
    //     // }
    //     //Cache::forget('duoctot_search_login_'.$keyword);
    //     //Cache::forget('duoctot_search_guest_'.$keyword);
    //     // Lấy sản phẩm
    //     $session = $request->session();
    //     if ($session->has('user')) {
    //         $cacheKey = 'duoctot_search_login_'.$keyword;
    //         $itemSearch = Cache::tags('duoctot_search')->remember($cacheKey, 1800, function () use ($params) {
    //             return (new ProductModel)->listItems($params, [
    //                 'task' => 'list-items-search-user-has-login'
    //             ]);
    //         });
    //     } else {
    //         $cacheKey = 'duoctot_search_guest_'.$keyword;
    //         $itemSearch = Cache::tags('duoctot_search')->remember($cacheKey, 1800, function () use ($params) {
    //             return (new ProductModel)->listItems($params, [
    //                 'task' => 'list-items-search'
    //             ]);
    //         });
    //     }
    //     $title = 'Kết quả tìm kiếm';
    //     return view(
    //         $this->pathViewController . 'view',
    //         compact('keyword', 'itemSearch', 'title')
    //     );
    // }
    
    // public function search(Request $request)
    // {
    //     $keyword = trim($request->input('keyword'));

    //     if (empty($keyword)) {
    //         return redirect()->back();
    //     }

    //     $params['keyword'] = $keyword;

    //     // 1. Lưu lịch sử tìm kiếm
    //     $keywordHistory = isset($_COOKIE["keywordHistory"])
    //         ? json_decode($_COOKIE["keywordHistory"], true)
    //         : [];

    //     if (!is_array($keywordHistory)) {
    //         $keywordHistory = [];
    //     }

    //     $keywordCurrent = [
    //         $keyword => ['keyword' => $keyword]
    //     ];

    //     unset($keywordHistory[$keyword]);
    //     $keywordHistory = $keywordCurrent + $keywordHistory;

    //     if (count($keywordHistory) > 5) {
    //         array_pop($keywordHistory);
    //     }

    //     setcookie(
    //         "keywordHistory",
    //         json_encode($keywordHistory),
    //         time() + config('myconfig.time_cookie'),
    //         "/"
    //     );

    //     $_COOKIE["keywordHistory"] = json_encode($keywordHistory);

    //     // 2. Tìm sản phẩm - giữ nguyên logic hiện tại
    //     $session = $request->session();

    //     if ($session->has('user')) {
    //         $cacheKey = 'duoctot_search_login_' . $keyword;

    //         $itemSearch = Cache::tags('duoctot_search')->remember(
    //             $cacheKey,
    //             1800,
    //             function () use ($params) {
    //                 return (new ProductModel)->listItems($params, [
    //                     'task' => 'list-items-search-user-has-login'
    //                 ]);
    //             }
    //         );
    //     } else {
    //         $cacheKey = 'duoctot_search_guest_' . $keyword;

    //         $itemSearch = Cache::tags('duoctot_search')->remember(
    //             $cacheKey,
    //             1800,
    //             function () use ($params) {
    //                 return (new ProductModel)->listItems($params, [
    //                     'task' => 'list-items-search'
    //                 ]);
    //             }
    //         );
    //     }

    //     // 3. Tách từ khóa để tìm theo từng từ
    //     $words = preg_split('/\s+/u', $keyword);
    //     $words = array_values(array_unique(array_filter($words)));

    //     // 4. Tìm người dùng theo tên hoặc số điện thoại
    //     $userSearch = UsersModel::with('details')
    //         ->whereIn('user_type_id', [2, 3, 4, 5, 9])
    //         ->where(function ($query) use ($keyword, $words) {
    //             $query->where('fullname', 'like', '%' . $keyword . '%')
    //                 ->orWhere('phone', 'like', '%' . $keyword . '%');

    //             foreach ($words as $word) {
    //                 $query->orWhere('fullname', 'like', '%' . $word . '%');
    //             }
    //         })
    //         ->get();

    //     // 5. Xếp hạng: khớp đầy đủ trước, nhiều từ khớp hơn xếp cao hơn
    //     $keywordLower = mb_strtolower($keyword, 'UTF-8');

    //     $userSearch = $userSearch->map(function ($user) use ($keywordLower, $words) {
    //         $fullname = mb_strtolower(trim($user->fullname), 'UTF-8');
    //         $matchedWords = 0;

    //         foreach ($words as $word) {
    //             if (mb_stripos($fullname, $word, 0, 'UTF-8') !== false) {
    //                 $matchedWords++;
    //             }
    //         }

    //         if ($fullname === $keywordLower) {
    //             $user->searchRank = 1000;
    //         } elseif ($matchedWords > 0) {
    //             $user->searchRank = $matchedWords;
    //         } else {
    //             $user->searchRank = 0;
    //         }

    //         return $user;
    //     })->sortByDesc('searchRank')->take(20)->values();

    //     // 6. Chuẩn bị ảnh đại diện, đường dẫn và địa chỉ
    //     $userSearch->transform(function ($user) {
    //         // Ảnh đại diện
    //         if (!empty($user['details']['image'])) {
    //             $user->imgThumb = route('home') . '/public' . $user['details']['image'];
    //         } else {
    //             if ($user['user_type_id'] == 3) {
    //                 $imageSrc = '/public/fileUpload/nhathuoc/6880e04c0fa57.jpg';
    //             } elseif ($user['user_type_id'] == 2) {
    //                 $imageSrc = '/public/fileUpload/nhathuoc/6898c9b8bf789.jpg';
    //             } elseif ($user['user_type_id'] == 4) {
    //                 $imageSrc = '/public/fileUpload/nhathuoc/nhathuocmau11.jpg';
    //             } elseif ($user['user_type_id'] == 8) {
    //                 $imageSrc = '/public/fileUpload/nhathuoc/spa_tham_my_vien_mau.jpg';
    //             } elseif ($user['user_type_id'] == 11) {
    //                 $imageSrc = '/public/fileUpload/nhathuoc/shop_me_va_be.jpg';
    //             } else {
    //                 $imageSrc = '/public/fileUpload/nhathuoc/nhathuocmau10.jpg';
    //             }

    //             $user->imgThumb = route('home') . $imageSrc;
    //         }

    //         // Đường dẫn trang người dùng/nhà thuốc
    //         $user->linkShop = route('fe.product.drugstore', $user['slug']);

    //         // Địa chỉ: sử dụng hàm buildAddress giống trang danh sách nhà thuốc
    //         $user->address = $this->buildAddress($user['details'] ?? null);

    //         return $user;
    //     });

    //     // 7. Trả dữ liệu ra giao diện
    //     $title = 'Kết quả tìm kiếm';

    //     return view(
    //         $this->pathViewController . 'view',
    //         compact('keyword', 'itemSearch', 'userSearch', 'title')
    //     );
    // }
    public function search(Request $request)
    {
        $keyword = trim($request->input('keyword'));
        if (empty($keyword)) {
            return redirect()->back();
        }
        $params['keyword'] = $keyword;
        // 1. Lưu lịch sử tìm kiếm
        $keywordHistory = isset($_COOKIE["keywordHistory"])
            ? json_decode($_COOKIE["keywordHistory"], true)
            : [];
        if (!is_array($keywordHistory)) {
            $keywordHistory = [];
        }
        $keywordCurrent = [
            $keyword => ['keyword' => $keyword]
        ];
        unset($keywordHistory[$keyword]);
        $keywordHistory = $keywordCurrent + $keywordHistory;
        if (count($keywordHistory) > 5) {
            array_pop($keywordHistory);
        }
        setcookie(
            "keywordHistory",
            json_encode($keywordHistory),
            time() + config('myconfig.time_cookie'),
            "/"
        );
        $_COOKIE["keywordHistory"] = json_encode($keywordHistory);
        // 2. Tìm sản phẩm - giữ nguyên logic cũ
        $session = $request->session();
        if ($session->has('user')) {
            $cacheKey = 'duoctot_search_login_' . $keyword;
            $itemSearch = Cache::tags('duoctot_search')->remember(
                $cacheKey,
                1800,
                function () use ($params) {
                    return (new ProductModel)->listItems($params, [
                        'task' => 'list-items-search-user-has-login'
                    ]);
                }
            );
        } else {
            $cacheKey = 'duoctot_search_guest_' . $keyword;
            $itemSearch = Cache::tags('duoctot_search')->remember(
                $cacheKey,
                1800,
                function () use ($params) {
                    return (new ProductModel)->listItems($params, [
                        'task' => 'list-items-search'
                    ]);
                }
            );
        }
        // Ưu tiên sản phẩm của user_id = 1984152952 lên đầu
        $itemSearch = collect($itemSearch)->sortBy(function ($item) {
            return (int) ($item['user_id'] ?? 0) === 1984152952 ? 0 : 1;
        })->values();
        // 3. Tách từ khóa để tìm thêm kết quả gần đúng
        // Vẫn giữ nguyên $keyword để ưu tiên tìm nguyên cụm trước
        $words = preg_split('/\s+/u', $keyword);
        $words = array_values(array_unique(array_filter($words)));
        // 4. Tìm người dùng theo tên hoặc số điện thoại
        $userSearch = UsersModel::with('details')
            ->whereIn('user_type_id', [2, 3, 4, 5, 9])
            ->where(function ($query) use ($keyword, $words) {
                // Tìm nguyên cụm từ khóa
                $query->where('fullname', 'like', '%' . $keyword . '%')
                    ->orWhere('phone', 'like', '%' . $keyword . '%');
                // Tìm thêm theo từng từ
                foreach ($words as $word) {
                    $query->orWhere('fullname', 'like', '%' . $word . '%');
                }
            })
            ->get();
        // 5. Xếp hạng kết quả tìm kiếm
        $keywordLower = mb_strtolower($keyword, 'UTF-8');
        $userSearch = $userSearch->map(function ($user) use ($keywordLower, $words) {
            $fullname = mb_strtolower(trim($user->fullname), 'UTF-8');
            $matchedWords = 0;
            foreach ($words as $word) {
                $wordLower = mb_strtolower($word, 'UTF-8');
                if (mb_stripos($fullname, $wordLower, 0, 'UTF-8') !== false) {
                    $matchedWords++;
                }
            }
            // Ưu tiên theo thứ tự:
            // 1000: Tên khớp chính xác toàn bộ từ khóa
            // 900: Tên chứa nguyên cụm từ khóa
            // Sau đó: Tên khớp nhiều từ hơn
            if ($fullname === $keywordLower) {
                $user->searchRank = 1000;
            } elseif (mb_stripos($fullname, $keywordLower, 0, 'UTF-8') !== false) {
                $user->searchRank = 900;
            } else {
                $user->searchRank = $matchedWords;
            }
            return $user;
        })->sortByDesc('searchRank')->take(10)->values();
        // 6. Chuẩn bị ảnh đại diện, đường dẫn và địa chỉ
        $userSearch->transform(function ($user) {
            // Ảnh đại diện
            if (!empty($user['details']['image'])) {
                $user->imgThumb = route('home') . '/public' . $user['details']['image'];
            } else {
                if ($user['user_type_id'] == 3) {
                    $imageSrc = '/public/fileUpload/nhathuoc/6880e04c0fa57.jpg';
                } elseif ($user['user_type_id'] == 2) {
                    $imageSrc = '/public/fileUpload/nhathuoc/6898c9b8bf789.jpg';
                } elseif ($user['user_type_id'] == 4) {
                    $imageSrc = '/public/fileUpload/nhathuoc/nhathuocmau11.jpg';
                } elseif ($user['user_type_id'] == 8) {
                    $imageSrc = '/public/fileUpload/nhathuoc/spa_tham_my_vien_mau.jpg';
                } elseif ($user['user_type_id'] == 11) {
                    $imageSrc = '/public/fileUpload/nhathuoc/shop_me_va_be.jpg';
                } else {
                    $imageSrc = '/public/fileUpload/nhathuoc/nhathuocmau10.jpg';
                }
                $user->imgThumb = route('home') . $imageSrc;
            }
            // Đường dẫn trang nhà thuốc/người dùng
            $user->linkShop = route('fe.product.drugstore', $user['slug']);
            // Địa chỉ giống cách xây dựng trong listDrugstore()
            $user->address = $this->buildAddress($user['details'] ?? null);
            return $user;
        });
        // 7. Trả dữ liệu ra giao diện
        $title = 'Kết quả tìm kiếm';
        $totalProduct = count($itemSearch);
        $totalUser = isset($userSearch) ? $userSearch->count() : 0;
        $totalResult = $totalProduct + $totalUser;
        return view(
            $this->pathViewController . 'view',
            compact('keyword', 'itemSearch', 'userSearch', 'title','totalResult')
        );
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
    public function deleteHistory(Request $request)
    {
        $data = $request->all();
        setcookie("keywordHistory", "", time() - 60, "/", "", 0);
        return view("$this->moduleName.block.menu.child_menu_yes_search.list_history_keyword");
    }
    public function updateFieldSearchKeyword(Request $request)
    {
        // $newImage = '/laravel-filemanager/fileUpload/nhathuoc/6898c9b8bf789.jpg';
        // UsersModel::where('user_type_id', 2)
        //     ->orderBy('user_id') // Sắp xếp theo cột user_id để tránh lỗi
        //     ->chunk(500, function ($users) use ($newImage) {
        //         foreach ($users as $user) {
        //             $details = $user->details ?? [];
        //             $details['image'] = $newImage;
        //             UsersModel::where('user_id', $user->user_id)
        //                 ->update(['details' => json_encode($details, JSON_UNESCAPED_UNICODE)]);
        //         }
        //     });
        // return 'Đã cập nhật ảnh thành công';
        // $count = UsersModel::where('fullname', 'like', '%nam%')->where('user_type_id', 8)
        // ->update(['user_type_id' => 1]);

        // return "Đã cập nhật $count thẩm mỹ";
        // sửa comment
        // $comments = CommentModel::select('id', 'product_id')
        //     ->where('fullname', 'Nguyễn Văn Sanh')
        //     ->get();
        // $productIdUpdated = []; // Mảng lưu các product_id đã đổi rồi
        // foreach ($comments as $val) {
        //     if (in_array($val['product_id'], $productIdUpdated)) {
        //         continue; // Nếu sản phẩm đã đổi comment thì bỏ qua
        //     }
        //     $params = [
        //         'id'          => $val['id'],
        //         'fullname'    => 'Quyết Thắng',
        //         'user_id'     => '',
        //         'phone'       => '0983526438',
        //         'content'     => 'Đúng như mô tả',
        //         'rating'      => 5,
        //         'parent_id'   => 0,
        //         'product_id'  => $val['product_id'],
        //         'created_at'  => '2024-08-20 00:00:00', // Thay đổi ngày tạo comment
        //     ];
        //     (new CommentModel)->saveItem($params, ['task' => 'edit-item']);
        //     $productIdUpdated[] = $val['product_id']; // Ghi nhớ sản phẩm đã đổi
        // }
        // return 'Thay tên thành công';

        //xóa comment thừa
        // $fullnames = ['Đinh Văn Lượng', 'Duy Điều', 'Trần Thanh Sang', 'Lê Văn Sơn','Văn Thạch']; // danh sách tên cần xử lý
        // foreach ($fullnames as $fullname) {
        //     $comments = CommentModel::select('id', 'shop_id', 'product_id')
        //         ->where('fullname', $fullname)
        //         ->orderBy('id') // Giữ lại comment có id nhỏ nhất
        //         ->get();
        //     $grouped = [];
        //     foreach ($comments as $comment) {
        //         $key = $comment['shop_id'] . '_' . $comment['product_id'];
        //         if (!isset($grouped[$key])) {
        //             // Giữ lại comment đầu tiên cho mỗi shop_id và product_id
        //             $grouped[$key] = $comment['id'];
        //         }
        //     }
        //     $idsToKeep = array_values($grouped);
        //     CommentModel::where('fullname', $fullname)
        //         ->whereNotIn('id', $idsToKeep)
        //         ->delete();
        // }
        // return 'Đã xóa bớt các comment trùng lặp cho các tên trong danh sách.';
        // lấy sitemap product
        // $slugs = ProductModel::orderBy('id', 'asc')
        // ->whereIn('status_product', ['da_duyet', 'sp_an'])
        // ->skip(11000)
        // ->take(1000)
        // ->pluck('slug');
        // $urls = $slugs->map(function ($slug) {
        //     return 'https://duoctot.com/chi-tiet-san-pham/' . $slug.'.html';
        // });
        // foreach ($urls as $url) {
        //     echo $url . '<br>';
        // }
        // return 1;

        // lấy sitemap post
        // $slugs = PostModel::orderBy('id', 'asc')->where('status_post','da_duyet')
        // ->take(1000)
        // ->pluck('slug');
        // $urls = $slugs->map(function ($slug) {
        //     return 'https://duoctot.com/tin-tuc/' . $slug.'.html';
        // });
        // foreach ($urls as $url) {
        //     echo $url . '<br>';
        // }
        // return 1;

        // lấy sitemap user
        // $slugs = UsersModel::where('user_type_id',12)->orderBy('user_id', 'asc')
        // ->take(1000)
        // ->pluck('slug');
        // $urls = $slugs->map(function ($slug) {
        //     return 'https://duoctot.com/' . $slug.'.html';
        // });
        // foreach ($urls as $url) {
        //     echo $url . '<br>';
        // }
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
        if($request->product){
            try {
                $batchSize = 2000;
                ProductModel::with('trademarkProduct')
                    ->select('id', 'name', 'benefit', 'trademark_id', 'user_id', 'cat_product_id', 'elements', 'approver_by')
                    ->chunkById($batchSize, function ($products) {
                        DB::beginTransaction();
                        try {
                            foreach ($products as $product) {
                                $trademarkName = $product->trademarkProduct ? $product->trademarkProduct->name : '';
                                $userSell = $product->userProduct ? $product->userProduct->fullname : '';
                                $userApprover = $product->userApproverProduct ? $product->userApproverProduct->fullname : '';
                                $catProduct = $product->catProduct ? $product->catProduct->name : '';
                                $keywordSearch = implode(' ', [
                                    $trademarkName,
                                    Str::ascii($trademarkName),
                                    $userSell,
                                    $userApprover,
                                    Str::ascii($userSell),
                                    $catProduct,
                                    Str::ascii($catProduct),
                                    Str::ascii($product->name),
                                    Str::ascii($product->benefit),
                                    Str::ascii($product->elements),
                                ]);

                                ProductModel::where('id', $product->id)->update(['keyword_search' => $keywordSearch]);
                            }
                            DB::commit();
                        } catch (\Exception $e) {
                            DB::rollBack();
                            throw $e; // ném ra ngoài để dừng toàn bộ tiến trình, tránh chạy tiếp khi có lỗi
                        }
                    });
                return response()->json(['success' => true, 'message' => 'Cập nhật keyword product thành công']);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => $e->getMessage()]);
            }
        }else if($request->cat){
            try {
                DB::beginTransaction();

                $products = ProductModel::select('id', 'name','user_id','cat_product_id','show_price')->get();
                $arrIdCatThuoc = [139,149,150,162,151,152,153,154,184,157,158,159,163,181,187,188,161,164,165,197,203,204,178,148,160,183,175,189,205,207,209]; // đã loại bỏ trùng
                foreach ($products as $product) {
                    $catId = (int)$product['cat_product_id']; // Ép kiểu int
                    $showPrice = in_array($catId, $arrIdCatThuoc) ? 1 : 1;
                    ProductModel::where('id', $product['id'])->update(['show_price' => $showPrice]);
                }
                DB::commit();
                return response()->json(['success' => true, 'message' => 'Ẩn giá thuốc thành công']);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['success' => false, 'message' => $e->getMessage()]);
            }
        }else if ($request->thay_ncc) {
            $LsIdProductChange = range(8922,8922);
            $idNCCNew = 1984152952;
            $newWarehouseId = 398;

            // Cập nhật bảng products
            ProductModel::whereIn('id', $LsIdProductChange)->update([
                'user_id'    => $idNCCNew,
                'created_by' => $idNCCNew,
            ]);

            // Cập nhật bảng product_warehouse
            DB::table('product_warehouse')
                ->whereIn('product_id', $LsIdProductChange)
                ->update(['warehouse_id' => $newWarehouseId]);

            return 'Đã thay đổi NCC và kho thành công';
        }
        else if ($request->an_ncc) {
            $idNCCHideProduct = 1984151214;
            $products = ProductModel::where('user_id', $idNCCHideProduct)->get();
            foreach ($products as $product) {
                $slug = $product->slug;
                Cache::forget('duoctot_product_guest_' . $slug);
                Cache::forget('duoctot_product_login_' . $slug);
            }
            ProductModel::where('user_id', $idNCCHideProduct)->update([
                'status_product' => 'tu_choi'
            ]);
            return 'Ẩn sp + clear cache thành công';
        }else if($request->hienlai_sp_thuoc){
        $restoreStatuses = array(112 => 'da_duyet', 235 => 'da_duyet', 264 => 'da_duyet', 265 => 'da_duyet', 266 => 'da_duyet', 298 => 'da_duyet', 321 => 'da_duyet', 350 => 'da_duyet', 369 => 'da_duyet', 396 => 'da_duyet', 397 => 'da_duyet', 401 => 'da_duyet', 418 => 'da_duyet', 419 => 'da_duyet', 421 => 'da_duyet', 422 => 'da_duyet', 425 => 'da_duyet', 429 => 'da_duyet', 430 => 'da_duyet', 433 => 'da_duyet', 434 => 'da_duyet', 435 => 'da_duyet', 436 => 'da_duyet', 437 => 'da_duyet', 438 => 'da_duyet', 439 => 'da_duyet', 445 => 'da_duyet', 446 => 'da_duyet', 447 => 'da_duyet', 448 => 'da_duyet', 449 => 'da_duyet', 452 => 'da_duyet', 453 => 'da_duyet', 454 => 'da_duyet', 455 => 'da_duyet', 456 => 'da_duyet', 457 => 'da_duyet', 458 => 'da_duyet', 460 => 'da_duyet', 461 => 'da_duyet', 462 => 'da_duyet', 478 => 'da_duyet', 507 => 'da_duyet', 547 => 'da_duyet', 548 => 'da_duyet', 549 => 'da_duyet', 550 => 'da_duyet', 551 => 'da_duyet', 555 => 'da_duyet', 574 => 'da_duyet', 636 => 'da_duyet', 637 => 'da_duyet', 638 => 'da_duyet', 640 => 'da_duyet', 642 => 'da_duyet', 643 => 'da_duyet', 657 => 'da_duyet', 658 => 'da_duyet', 659 => 'da_duyet', 676 => 'da_duyet', 677 => 'da_duyet', 678 => 'da_duyet', 679 => 'da_duyet', 680 => 'da_duyet', 681 => 'da_duyet', 692 => 'da_duyet', 696 => 'da_duyet', 715 => 'da_duyet', 719 => 'da_duyet', 759 => 'da_duyet', 766 => 'da_duyet', 772 => 'da_duyet', 780 => 'da_duyet', 781 => 'da_duyet', 783 => 'da_duyet', 784 => 'da_duyet', 785 => 'da_duyet', 786 => 'da_duyet', 787 => 'da_duyet', 788 => 'da_duyet', 789 => 'da_duyet', 790 => 'da_duyet', 791 => 'da_duyet', 792 => 'da_duyet', 793 => 'da_duyet', 794 => 'da_duyet', 795 => 'da_duyet', 796 => 'da_duyet', 797 => 'da_duyet', 802 => 'da_duyet', 821 => 'da_duyet', 839 => 'da_duyet', 888 => 'da_duyet', 889 => 'da_duyet', 890 => 'da_duyet', 891 => 'da_duyet', 892 => 'da_duyet', 893 => 'da_duyet', 894 => 'da_duyet', 895 => 'da_duyet', 896 => 'da_duyet', 955 => 'da_duyet', 957 => 'da_duyet', 958 => 'da_duyet', 967 => 'da_duyet', 968 => 'da_duyet', 969 => 'da_duyet', 970 => 'tu_choi', 971 => 'da_duyet', 972 => 'da_duyet', 973 => 'da_duyet', 975 => 'da_duyet', 976 => 'da_duyet', 977 => 'da_duyet', 978 => 'tu_choi', 979 => 'da_duyet', 980 => 'da_duyet', 981 => 'da_duyet', 982 => 'da_duyet', 983 => 'da_duyet', 984 => 'da_duyet', 985 => 'da_duyet', 986 => 'da_duyet', 987 => 'tu_choi', 988 => 'tu_choi', 989 => 'da_duyet', 990 => 'da_duyet', 991 => 'da_duyet', 992 => 'da_duyet', 993 => 'da_duyet', 994 => 'da_duyet', 995 => 'da_duyet', 996 => 'da_duyet', 997 => 'da_duyet', 998 => 'da_duyet', 999 => 'da_duyet', 1000 => 'tu_choi', 1001 => 'da_duyet', 1002 => 'da_duyet', 1003 => 'da_duyet', 1004 => 'da_duyet', 1005 => 'da_duyet', 1027 => 'da_duyet', 1028 => 'da_duyet', 1029 => 'da_duyet', 1030 => 'da_duyet', 1031 => 'da_duyet', 1032 => 'da_duyet', 1033 => 'da_duyet', 1034 => 'da_duyet', 1035 => 'da_duyet', 1036 => 'da_duyet', 1037 => 'da_duyet', 1038 => 'da_duyet', 1039 => 'da_duyet', 1040 => 'da_duyet', 1041 => 'da_duyet', 1042 => 'da_duyet', 1043 => 'da_duyet', 1044 => 'da_duyet', 1045 => 'da_duyet', 1046 => 'da_duyet', 1047 => 'da_duyet', 1048 => 'da_duyet', 1049 => 'da_duyet', 1050 => 'da_duyet', 1051 => 'da_duyet', 1052 => 'da_duyet', 1053 => 'da_duyet', 1054 => 'da_duyet', 1055 => 'da_duyet', 1056 => 'da_duyet', 1057 => 'da_duyet', 1058 => 'da_duyet', 1059 => 'da_duyet', 1060 => 'da_duyet', 1061 => 'da_duyet', 1062 => 'da_duyet', 1065 => 'da_duyet', 1066 => 'da_duyet', 1068 => 'da_duyet', 1078 => 'da_duyet', 1081 => 'da_duyet', 1083 => 'da_duyet', 1085 => 'da_duyet', 1088 => 'da_duyet', 1089 => 'da_duyet', 1090 => 'da_duyet', 1091 => 'da_duyet', 1092 => 'da_duyet', 1093 => 'da_duyet', 1094 => 'da_duyet', 1095 => 'da_duyet', 1096 => 'da_duyet', 1097 => 'da_duyet', 1098 => 'da_duyet', 1099 => 'da_duyet', 1100 => 'da_duyet', 1101 => 'da_duyet', 1102 => 'da_duyet', 1103 => 'da_duyet', 1104 => 'da_duyet', 1105 => 'da_duyet', 1106 => 'da_duyet', 1107 => 'da_duyet', 1108 => 'da_duyet', 1109 => 'da_duyet', 1110 => 'da_duyet', 1111 => 'da_duyet', 1113 => 'da_duyet', 1114 => 'da_duyet', 1115 => 'da_duyet', 1116 => 'da_duyet', 1117 => 'da_duyet', 1118 => 'da_duyet', 1119 => 'da_duyet', 1120 => 'da_duyet', 1121 => 'da_duyet', 1122 => 'da_duyet', 1123 => 'da_duyet', 1124 => 'da_duyet', 1125 => 'da_duyet', 1126 => 'da_duyet', 1127 => 'da_duyet', 1131 => 'da_duyet', 1140 => 'da_duyet', 1163 => 'da_duyet', 1165 => 'da_duyet', 1187 => 'da_duyet', 1188 => 'da_duyet', 1192 => 'da_duyet', 1194 => 'da_duyet', 1205 => 'tu_choi', 1206 => 'da_duyet', 1207 => 'tu_choi', 1208 => 'tu_choi', 1209 => 'da_duyet', 1210 => 'da_duyet', 1215 => 'da_duyet', 1223 => 'da_duyet', 1229 => 'da_duyet', 1233 => 'da_duyet', 1234 => 'da_duyet', 1239 => 'da_duyet', 1247 => 'da_duyet', 1253 => 'da_duyet', 1261 => 'da_duyet', 1267 => 'da_duyet', 1268 => 'da_duyet', 1269 => 'da_duyet', 1270 => 'da_duyet', 1271 => 'da_duyet', 1272 => 'da_duyet', 1273 => 'da_duyet', 1274 => 'da_duyet', 1277 => 'da_duyet', 1304 => 'da_duyet', 1308 => 'da_duyet', 1309 => 'da_duyet', 1311 => 'da_duyet', 1312 => 'da_duyet', 1313 => 'tu_choi', 1323 => 'da_duyet', 1325 => 'da_duyet', 1326 => 'da_duyet', 1327 => 'da_duyet', 1328 => 'da_duyet', 1329 => 'da_duyet', 1330 => 'da_duyet', 1332 => 'da_duyet', 1333 => 'da_duyet', 1334 => 'da_duyet', 1335 => 'da_duyet', 1340 => 'da_duyet', 1343 => 'da_duyet', 1344 => 'da_duyet', 1345 => 'da_duyet', 1346 => 'da_duyet', 1347 => 'da_duyet', 1348 => 'da_duyet', 1349 => 'da_duyet', 1350 => 'da_duyet', 1357 => 'da_duyet', 1358 => 'da_duyet', 1359 => 'da_duyet', 1360 => 'da_duyet', 1361 => 'da_duyet', 1362 => 'da_duyet', 1365 => 'da_duyet', 1366 => 'da_duyet', 1382 => 'da_duyet', 1383 => 'da_duyet', 1384 => 'da_duyet', 1385 => 'da_duyet', 1386 => 'da_duyet', 1387 => 'da_duyet', 1388 => 'da_duyet', 1389 => 'da_duyet', 1390 => 'da_duyet', 1391 => 'da_duyet', 1394 => 'da_duyet', 1396 => 'da_duyet', 1398 => 'da_duyet', 1403 => 'da_duyet', 1404 => 'da_duyet', 1405 => 'da_duyet', 1406 => 'da_duyet', 1407 => 'da_duyet', 1408 => 'da_duyet', 1409 => 'da_duyet', 1410 => 'da_duyet', 1411 => 'da_duyet', 1412 => 'da_duyet', 1413 => 'da_duyet', 1414 => 'da_duyet', 1415 => 'da_duyet', 1416 => 'da_duyet', 1417 => 'tu_choi', 1419 => 'da_duyet', 1455 => 'da_duyet', 1464 => 'da_duyet', 1465 => 'da_duyet', 1466 => 'da_duyet', 1471 => 'da_duyet', 1478 => 'da_duyet', 1479 => 'tu_choi', 1481 => 'da_duyet', 1482 => 'da_duyet', 1490 => 'da_duyet', 1491 => 'da_duyet', 1492 => 'da_duyet', 1493 => 'da_duyet', 1494 => 'da_duyet', 1495 => 'da_duyet', 1496 => 'da_duyet', 1497 => 'da_duyet', 1498 => 'da_duyet', 1500 => 'da_duyet', 1501 => 'da_duyet', 1502 => 'da_duyet', 1503 => 'da_duyet', 1504 => 'da_duyet', 1505 => 'da_duyet', 1506 => 'da_duyet', 1507 => 'da_duyet', 1508 => 'da_duyet', 1532 => 'da_duyet', 1567 => 'tu_choi', 1568 => 'tu_choi', 1569 => 'tu_choi', 1570 => 'tu_choi', 1649 => 'tu_choi', 1650 => 'da_duyet', 1652 => 'da_duyet', 1655 => 'da_duyet', 1656 => 'da_duyet', 1657 => 'da_duyet', 1658 => 'da_duyet', 1660 => 'tu_choi', 1661 => 'da_duyet', 1662 => 'da_duyet', 1663 => 'da_duyet', 1664 => 'tu_choi', 1665 => 'da_duyet', 1666 => 'da_duyet', 1667 => 'da_duyet', 1668 => 'da_duyet', 1670 => 'tu_choi', 1671 => 'da_duyet', 1673 => 'da_duyet', 1674 => 'da_duyet', 1675 => 'tu_choi', 1676 => 'da_duyet', 1678 => 'da_duyet', 1679 => 'da_duyet', 1680 => 'da_duyet', 1681 => 'da_duyet', 1682 => 'da_duyet', 1686 => 'da_duyet', 1687 => 'da_duyet', 1689 => 'tu_choi', 1690 => 'da_duyet', 1691 => 'da_duyet', 1692 => 'da_duyet', 1693 => 'da_duyet', 1694 => 'da_duyet', 1695 => 'da_duyet', 1696 => 'da_duyet', 1697 => 'da_duyet', 1698 => 'da_duyet', 1700 => 'da_duyet', 1702 => 'da_duyet', 1703 => 'da_duyet', 1704 => 'da_duyet', 1705 => 'da_duyet', 1706 => 'da_duyet', 1707 => 'da_duyet', 1709 => 'da_duyet', 1710 => 'da_duyet', 1712 => 'da_duyet', 1715 => 'da_duyet', 1718 => 'da_duyet', 1725 => 'da_duyet', 1726 => 'da_duyet', 1728 => 'da_duyet', 1739 => 'da_duyet', 1740 => 'da_duyet', 1742 => 'da_duyet', 1743 => 'da_duyet', 1744 => 'da_duyet', 1745 => 'da_duyet', 1746 => 'da_duyet', 1748 => 'da_duyet', 1749 => 'da_duyet', 1750 => 'da_duyet', 1752 => 'da_duyet', 1753 => 'da_duyet', 1754 => 'da_duyet', 1755 => 'da_duyet', 1756 => 'da_duyet', 1757 => 'da_duyet', 1758 => 'da_duyet', 1759 => 'da_duyet', 1760 => 'da_duyet', 1761 => 'da_duyet', 1763 => 'da_duyet', 1764 => 'da_duyet', 1765 => 'da_duyet', 1766 => 'da_duyet', 1770 => 'da_duyet', 1771 => 'da_duyet', 1775 => 'da_duyet', 1776 => 'da_duyet', 1777 => 'da_duyet', 1779 => 'da_duyet', 1780 => 'da_duyet', 1781 => 'da_duyet', 1782 => 'da_duyet', 1783 => 'da_duyet', 1785 => 'da_duyet', 1787 => 'da_duyet', 1788 => 'da_duyet', 1790 => 'da_duyet', 1791 => 'da_duyet', 1795 => 'tu_choi', 1796 => 'da_duyet', 1798 => 'da_duyet', 1799 => 'da_duyet', 1800 => 'da_duyet', 1801 => 'da_duyet', 1802 => 'da_duyet', 1803 => 'da_duyet', 1804 => 'da_duyet', 1806 => 'da_duyet', 1808 => 'tu_choi', 1810 => 'da_duyet', 1812 => 'da_duyet', 1813 => 'tu_choi', 1815 => 'da_duyet', 1816 => 'da_duyet', 1817 => 'da_duyet', 1818 => 'da_duyet', 1819 => 'tu_choi', 1824 => 'da_duyet', 1825 => 'da_duyet', 1826 => 'da_duyet', 1828 => 'da_duyet', 1830 => 'da_duyet', 1831 => 'da_duyet', 1833 => 'da_duyet', 1835 => 'da_duyet', 1839 => 'da_duyet', 1840 => 'da_duyet', 1841 => 'da_duyet', 1842 => 'da_duyet', 1844 => 'da_duyet', 1845 => 'da_duyet', 1847 => 'da_duyet', 1849 => 'da_duyet', 1851 => 'da_duyet', 1852 => 'da_duyet', 1855 => 'da_duyet', 1856 => 'da_duyet', 1859 => 'da_duyet', 1860 => 'tu_choi', 1861 => 'da_duyet', 1862 => 'da_duyet', 1864 => 'da_duyet', 1865 => 'da_duyet', 1866 => 'da_duyet', 1867 => 'da_duyet', 1869 => 'da_duyet', 1871 => 'da_duyet', 1872 => 'da_duyet', 1873 => 'da_duyet', 1875 => 'da_duyet', 1877 => 'tu_choi', 1879 => 'da_duyet', 1880 => 'da_duyet', 1881 => 'da_duyet', 1882 => 'da_duyet', 1884 => 'da_duyet', 1885 => 'da_duyet', 1900 => 'da_duyet', 1920 => 'da_duyet', 1921 => 'da_duyet', 1935 => 'tu_choi', 1936 => 'da_duyet', 1937 => 'da_duyet', 1938 => 'da_duyet', 1939 => 'da_duyet', 1940 => 'da_duyet', 1941 => 'da_duyet', 1942 => 'da_duyet', 1943 => 'da_duyet', 1947 => 'da_duyet', 1952 => 'da_duyet', 1953 => 'da_duyet', 1954 => 'da_duyet', 1955 => 'tu_choi', 1968 => 'da_duyet', 1972 => 'da_duyet', 1973 => 'da_duyet', 1974 => 'da_duyet', 1975 => 'tu_choi', 1997 => 'da_duyet', 2017 => 'da_duyet', 2018 => 'da_duyet', 2019 => 'da_duyet', 2020 => 'da_duyet', 2021 => 'da_duyet', 2022 => 'da_duyet', 2024 => 'da_duyet', 2034 => 'da_duyet', 2037 => 'da_duyet', 2042 => 'da_duyet', 2048 => 'da_duyet', 2049 => 'da_duyet', 2050 => 'da_duyet', 2052 => 'da_duyet', 2053 => 'da_duyet', 2054 => 'da_duyet', 2056 => 'da_duyet', 2057 => 'da_duyet', 2058 => 'da_duyet', 2059 => 'da_duyet', 2060 => 'da_duyet', 2062 => 'da_duyet', 2063 => 'da_duyet', 2073 => 'da_duyet', 2148 => 'da_duyet', 2161 => 'da_duyet', 2170 => 'da_duyet', 2172 => 'da_duyet', 2175 => 'tu_choi', 2176 => 'da_duyet', 2177 => 'da_duyet', 2241 => 'da_duyet', 2250 => 'da_duyet', 2251 => 'da_duyet', 2252 => 'da_duyet', 2253 => 'da_duyet', 2258 => 'da_duyet', 2270 => 'da_duyet', 2271 => 'da_duyet', 2314 => 'da_duyet', 2315 => 'da_duyet', 2316 => 'da_duyet', 2317 => 'da_duyet', 2324 => 'da_duyet', 2325 => 'da_duyet', 2326 => 'da_duyet', 2327 => 'da_duyet', 2328 => 'da_duyet', 2329 => 'da_duyet', 2333 => 'da_duyet', 2334 => 'da_duyet', 2348 => 'da_duyet', 2349 => 'da_duyet', 2350 => 'da_duyet', 2383 => 'da_duyet', 2384 => 'da_duyet', 2385 => 'da_duyet', 2386 => 'da_duyet', 2387 => 'da_duyet', 2388 => 'da_duyet', 2390 => 'da_duyet', 2391 => 'da_duyet', 2393 => 'da_duyet', 2394 => 'da_duyet', 2395 => 'da_duyet', 2396 => 'da_duyet', 2397 => 'da_duyet', 2398 => 'da_duyet', 2399 => 'da_duyet', 2419 => 'da_duyet', 2421 => 'da_duyet', 2436 => 'da_duyet', 2437 => 'da_duyet', 2438 => 'da_duyet', 2439 => 'da_duyet', 2440 => 'da_duyet', 2441 => 'da_duyet', 2442 => 'da_duyet', 2443 => 'da_duyet', 2444 => 'da_duyet', 2445 => 'da_duyet', 2446 => 'da_duyet', 2447 => 'da_duyet', 2448 => 'da_duyet', 2449 => 'da_duyet', 2450 => 'da_duyet', 2451 => 'da_duyet', 2452 => 'da_duyet', 2453 => 'da_duyet', 2454 => 'da_duyet', 2455 => 'da_duyet', 2456 => 'da_duyet', 2463 => 'da_duyet', 2464 => 'da_duyet', 2465 => 'da_duyet', 2466 => 'da_duyet', 2467 => 'da_duyet', 2468 => 'da_duyet', 2487 => 'da_duyet', 2488 => 'da_duyet', 2489 => 'da_duyet', 2490 => 'da_duyet', 2491 => 'da_duyet', 2492 => 'da_duyet', 2493 => 'da_duyet', 2500 => 'da_duyet', 2501 => 'da_duyet', 2502 => 'da_duyet', 2503 => 'da_duyet', 2504 => 'da_duyet', 2505 => 'da_duyet', 2506 => 'da_duyet', 2507 => 'da_duyet', 2508 => 'da_duyet', 2509 => 'da_duyet', 2510 => 'da_duyet', 2511 => 'da_duyet', 2512 => 'da_duyet', 2513 => 'da_duyet', 2514 => 'da_duyet', 2515 => 'da_duyet', 2516 => 'da_duyet', 2517 => 'da_duyet', 2518 => 'da_duyet', 2519 => 'da_duyet', 2520 => 'da_duyet', 2521 => 'tu_choi', 2522 => 'da_duyet', 2523 => 'da_duyet', 2524 => 'da_duyet', 2525 => 'da_duyet', 2526 => 'tu_choi', 2527 => 'tu_choi', 2528 => 'da_duyet', 2529 => 'da_duyet', 2530 => 'da_duyet', 2531 => 'da_duyet', 2532 => 'da_duyet', 2533 => 'da_duyet', 2534 => 'da_duyet', 2535 => 'da_duyet', 2536 => 'da_duyet', 2537 => 'da_duyet', 2550 => 'da_duyet', 2551 => 'da_duyet', 2552 => 'da_duyet', 2553 => 'da_duyet', 2554 => 'da_duyet', 2555 => 'da_duyet', 2556 => 'da_duyet', 2557 => 'tu_choi', 2558 => 'da_duyet', 2559 => 'tu_choi', 2560 => 'da_duyet', 2561 => 'da_duyet', 2562 => 'da_duyet', 2563 => 'da_duyet', 2564 => 'da_duyet', 2565 => 'da_duyet', 2566 => 'da_duyet', 2567 => 'da_duyet', 2568 => 'da_duyet', 2569 => 'da_duyet', 2570 => 'tu_choi', 2571 => 'da_duyet', 2572 => 'da_duyet', 2573 => 'da_duyet', 2575 => 'da_duyet', 2576 => 'da_duyet', 2577 => 'da_duyet', 2578 => 'da_duyet', 2579 => 'da_duyet', 2580 => 'da_duyet', 2581 => 'da_duyet', 2582 => 'da_duyet', 2583 => 'da_duyet', 2584 => 'da_duyet', 2585 => 'da_duyet', 2586 => 'da_duyet', 2587 => 'tu_choi', 2588 => 'da_duyet', 2589 => 'da_duyet', 2590 => 'da_duyet', 2591 => 'da_duyet', 2592 => 'da_duyet', 2593 => 'da_duyet', 2594 => 'da_duyet', 2595 => 'da_duyet', 2596 => 'da_duyet', 2597 => 'da_duyet', 2598 => 'da_duyet', 2599 => 'da_duyet', 2600 => 'da_duyet', 2601 => 'da_duyet', 2602 => 'da_duyet', 2603 => 'tu_choi', 2604 => 'da_duyet', 2605 => 'da_duyet', 2606 => 'da_duyet', 2607 => 'da_duyet', 2608 => 'da_duyet', 2609 => 'da_duyet', 2610 => 'da_duyet', 2611 => 'da_duyet', 2612 => 'da_duyet', 2613 => 'da_duyet', 2614 => 'da_duyet', 2615 => 'da_duyet', 2616 => 'da_duyet', 2617 => 'da_duyet', 2618 => 'da_duyet', 2619 => 'da_duyet', 2620 => 'da_duyet', 2621 => 'da_duyet', 2622 => 'da_duyet', 2623 => 'da_duyet', 2624 => 'da_duyet', 2625 => 'da_duyet', 2626 => 'da_duyet', 2627 => 'da_duyet', 2628 => 'da_duyet', 2629 => 'da_duyet', 2630 => 'da_duyet', 2631 => 'da_duyet', 2632 => 'da_duyet', 2633 => 'da_duyet', 2634 => 'da_duyet', 2635 => 'da_duyet', 2636 => 'da_duyet', 2637 => 'da_duyet', 2638 => 'da_duyet', 2640 => 'da_duyet', 2641 => 'da_duyet', 2642 => 'da_duyet', 2643 => 'da_duyet', 2644 => 'da_duyet', 2645 => 'da_duyet', 2646 => 'da_duyet', 2647 => 'da_duyet', 2648 => 'da_duyet', 2649 => 'da_duyet', 2650 => 'da_duyet', 2651 => 'da_duyet', 2652 => 'da_duyet', 2653 => 'da_duyet', 2654 => 'da_duyet', 2655 => 'da_duyet', 2656 => 'da_duyet', 2657 => 'da_duyet', 2658 => 'da_duyet', 2659 => 'da_duyet', 2660 => 'da_duyet', 2661 => 'da_duyet', 2662 => 'tu_choi', 2663 => 'da_duyet', 2664 => 'da_duyet', 2665 => 'da_duyet', 2666 => 'da_duyet', 2667 => 'da_duyet', 2668 => 'da_duyet', 2669 => 'da_duyet', 2670 => 'da_duyet', 2671 => 'da_duyet', 2672 => 'da_duyet', 2673 => 'da_duyet', 2674 => 'da_duyet', 2675 => 'da_duyet', 2676 => 'da_duyet', 2677 => 'da_duyet', 2678 => 'da_duyet', 2679 => 'da_duyet', 2680 => 'da_duyet', 2681 => 'da_duyet', 2682 => 'da_duyet', 2683 => 'da_duyet', 2684 => 'da_duyet', 2685 => 'da_duyet', 2686 => 'da_duyet', 2687 => 'da_duyet', 2688 => 'da_duyet', 2689 => 'da_duyet', 2690 => 'da_duyet', 2691 => 'da_duyet', 2692 => 'da_duyet', 2693 => 'da_duyet', 2694 => 'da_duyet', 2695 => 'da_duyet', 2696 => 'da_duyet', 2697 => 'da_duyet', 2698 => 'da_duyet', 2699 => 'tu_choi', 2700 => 'tu_choi', 2701 => 'da_duyet', 2702 => 'da_duyet', 2703 => 'da_duyet', 2704 => 'da_duyet', 2705 => 'da_duyet', 2706 => 'da_duyet', 2707 => 'da_duyet', 2708 => 'da_duyet', 2709 => 'da_duyet', 2710 => 'da_duyet', 2711 => 'da_duyet', 2712 => 'da_duyet', 2713 => 'da_duyet', 2714 => 'da_duyet', 2715 => 'da_duyet', 2716 => 'da_duyet', 2717 => 'da_duyet', 2718 => 'da_duyet', 2719 => 'da_duyet', 2720 => 'da_duyet', 2721 => 'da_duyet', 2722 => 'da_duyet', 2723 => 'da_duyet', 2724 => 'da_duyet', 2725 => 'da_duyet', 2726 => 'da_duyet', 2727 => 'da_duyet', 2728 => 'da_duyet', 2729 => 'da_duyet', 2730 => 'da_duyet', 2731 => 'da_duyet', 2732 => 'da_duyet', 2733 => 'da_duyet', 2734 => 'da_duyet', 2735 => 'da_duyet', 2737 => 'da_duyet', 2738 => 'da_duyet', 2739 => 'da_duyet', 2740 => 'da_duyet', 2741 => 'da_duyet', 2742 => 'da_duyet', 2743 => 'da_duyet', 2744 => 'da_duyet', 2746 => 'da_duyet', 2747 => 'da_duyet', 2748 => 'da_duyet', 2749 => 'da_duyet', 2750 => 'da_duyet', 2751 => 'da_duyet', 2752 => 'da_duyet', 2753 => 'da_duyet', 2754 => 'da_duyet', 2755 => 'da_duyet', 2756 => 'da_duyet', 2757 => 'da_duyet', 2758 => 'da_duyet', 2759 => 'da_duyet', 2760 => 'da_duyet', 2761 => 'da_duyet', 2763 => 'da_duyet', 2764 => 'da_duyet', 2765 => 'da_duyet', 2766 => 'da_duyet', 2767 => 'da_duyet', 2768 => 'da_duyet', 2769 => 'da_duyet', 2770 => 'da_duyet', 2771 => 'da_duyet', 2772 => 'da_duyet', 2773 => 'tu_choi', 2774 => 'da_duyet', 2775 => 'da_duyet', 2776 => 'da_duyet', 2777 => 'da_duyet', 2778 => 'da_duyet', 2779 => 'da_duyet', 2780 => 'tu_choi', 2781 => 'da_duyet', 2782 => 'da_duyet', 2783 => 'da_duyet', 2784 => 'da_duyet', 2785 => 'da_duyet', 2786 => 'da_duyet', 2787 => 'da_duyet', 2788 => 'da_duyet', 2789 => 'da_duyet', 2790 => 'da_duyet', 2791 => 'da_duyet', 2792 => 'da_duyet', 2793 => 'da_duyet', 2794 => 'da_duyet', 2795 => 'da_duyet', 2804 => 'da_duyet', 2805 => 'da_duyet', 2806 => 'da_duyet', 2807 => 'da_duyet', 2808 => 'da_duyet', 2809 => 'da_duyet', 2810 => 'da_duyet', 2811 => 'da_duyet', 2812 => 'da_duyet', 2813 => 'da_duyet', 2814 => 'da_duyet', 2815 => 'da_duyet', 2816 => 'da_duyet', 2817 => 'da_duyet', 2819 => 'da_duyet', 2820 => 'da_duyet', 2821 => 'da_duyet', 2822 => 'da_duyet', 2823 => 'da_duyet', 2824 => 'da_duyet', 2825 => 'da_duyet', 2826 => 'da_duyet', 2827 => 'da_duyet', 2828 => 'da_duyet', 2829 => 'da_duyet', 2830 => 'da_duyet', 2831 => 'da_duyet', 2832 => 'da_duyet', 2833 => 'da_duyet', 2834 => 'da_duyet', 2835 => 'da_duyet', 2836 => 'da_duyet', 2837 => 'da_duyet', 2838 => 'da_duyet', 2839 => 'da_duyet', 2840 => 'da_duyet', 2841 => 'tu_choi', 2842 => 'da_duyet', 2843 => 'da_duyet', 2844 => 'da_duyet', 2845 => 'da_duyet', 2846 => 'da_duyet', 2847 => 'da_duyet', 2848 => 'da_duyet', 2849 => 'da_duyet', 2850 => 'da_duyet', 2851 => 'da_duyet', 2852 => 'da_duyet', 2853 => 'da_duyet', 2854 => 'da_duyet', 2855 => 'da_duyet', 2856 => 'da_duyet', 2857 => 'da_duyet', 2858 => 'tu_choi', 2859 => 'da_duyet', 2860 => 'da_duyet', 2861 => 'da_duyet', 2862 => 'da_duyet', 2863 => 'da_duyet', 2864 => 'da_duyet', 2865 => 'da_duyet', 2866 => 'da_duyet', 2867 => 'da_duyet', 2869 => 'da_duyet', 2870 => 'da_duyet', 2871 => 'da_duyet', 2872 => 'da_duyet', 2873 => 'da_duyet', 2874 => 'da_duyet', 2875 => 'da_duyet', 2876 => 'da_duyet', 2877 => 'da_duyet', 2878 => 'da_duyet', 2879 => 'da_duyet', 2880 => 'da_duyet', 2881 => 'da_duyet', 2882 => 'da_duyet', 2883 => 'da_duyet', 2884 => 'da_duyet', 2885 => 'tu_choi', 2888 => 'da_duyet', 2890 => 'da_duyet', 2891 => 'da_duyet', 2892 => 'da_duyet', 2893 => 'da_duyet', 2894 => 'da_duyet', 2895 => 'da_duyet', 2896 => 'da_duyet', 2897 => 'da_duyet', 2898 => 'da_duyet', 2899 => 'da_duyet', 2900 => 'tu_choi', 2901 => 'da_duyet', 2902 => 'da_duyet', 2903 => 'da_duyet', 2904 => 'da_duyet', 2905 => 'da_duyet', 2906 => 'tu_choi', 2907 => 'tu_choi', 2908 => 'da_duyet', 2909 => 'da_duyet', 2910 => 'da_duyet', 2911 => 'da_duyet', 2912 => 'da_duyet', 2913 => 'da_duyet', 2914 => 'da_duyet', 2915 => 'da_duyet', 2916 => 'da_duyet', 2917 => 'da_duyet', 2918 => 'da_duyet', 2919 => 'da_duyet', 2920 => 'da_duyet', 2921 => 'tu_choi', 2922 => 'da_duyet', 2923 => 'da_duyet', 2924 => 'da_duyet', 2928 => 'da_duyet', 2929 => 'da_duyet', 2930 => 'da_duyet', 2931 => 'da_duyet', 2932 => 'da_duyet', 2933 => 'da_duyet', 2934 => 'da_duyet', 2935 => 'da_duyet', 2936 => 'da_duyet', 2937 => 'da_duyet', 2938 => 'da_duyet', 2939 => 'da_duyet', 2940 => 'da_duyet', 2941 => 'da_duyet', 2942 => 'da_duyet', 2943 => 'da_duyet', 2944 => 'da_duyet', 2945 => 'da_duyet', 2946 => 'da_duyet', 2947 => 'da_duyet', 2948 => 'da_duyet', 2949 => 'da_duyet', 2950 => 'da_duyet', 2951 => 'da_duyet', 2952 => 'da_duyet', 2953 => 'tu_choi', 2954 => 'da_duyet', 2955 => 'da_duyet', 2956 => 'da_duyet', 2957 => 'da_duyet', 2958 => 'da_duyet', 2959 => 'da_duyet', 2960 => 'da_duyet', 2961 => 'da_duyet', 2962 => 'da_duyet', 2963 => 'da_duyet', 2964 => 'da_duyet', 2965 => 'da_duyet', 2966 => 'da_duyet', 2967 => 'da_duyet', 2968 => 'da_duyet', 2969 => 'da_duyet', 2970 => 'da_duyet', 2971 => 'da_duyet', 2972 => 'da_duyet', 2973 => 'da_duyet', 2974 => 'da_duyet', 2975 => 'da_duyet', 2976 => 'da_duyet', 2977 => 'da_duyet', 2978 => 'da_duyet', 2979 => 'da_duyet', 2980 => 'da_duyet', 2981 => 'da_duyet', 2982 => 'da_duyet', 2983 => 'da_duyet', 2984 => 'da_duyet', 2985 => 'da_duyet', 2986 => 'da_duyet', 2987 => 'da_duyet', 2988 => 'da_duyet', 2989 => 'da_duyet', 2990 => 'da_duyet', 2991 => 'da_duyet', 2992 => 'tu_choi', 2993 => 'da_duyet', 2994 => 'da_duyet', 2995 => 'da_duyet', 2996 => 'da_duyet', 2997 => 'da_duyet', 2998 => 'da_duyet', 3000 => 'da_duyet', 3002 => 'da_duyet', 3004 => 'da_duyet', 3005 => 'da_duyet', 3006 => 'da_duyet', 3007 => 'da_duyet', 3008 => 'da_duyet', 3010 => 'da_duyet', 3011 => 'da_duyet', 3012 => 'da_duyet', 3013 => 'da_duyet', 3014 => 'da_duyet', 3015 => 'da_duyet', 3016 => 'da_duyet', 3017 => 'da_duyet', 3018 => 'tu_choi', 3019 => 'da_duyet', 3020 => 'tu_choi', 3021 => 'da_duyet', 3022 => 'da_duyet', 3023 => 'da_duyet', 3025 => 'da_duyet', 3026 => 'da_duyet', 3027 => 'da_duyet', 3029 => 'da_duyet', 3030 => 'da_duyet', 3031 => 'tu_choi', 3032 => 'da_duyet', 3033 => 'da_duyet', 3034 => 'da_duyet', 3035 => 'da_duyet', 3036 => 'da_duyet', 3037 => 'da_duyet', 3038 => 'da_duyet', 3039 => 'da_duyet', 3040 => 'da_duyet', 3041 => 'da_duyet', 3044 => 'da_duyet', 3045 => 'da_duyet', 3046 => 'da_duyet', 3047 => 'da_duyet', 3048 => 'da_duyet', 3049 => 'da_duyet', 3050 => 'da_duyet', 3051 => 'da_duyet', 3052 => 'da_duyet', 3053 => 'da_duyet', 3054 => 'da_duyet', 3055 => 'da_duyet', 3056 => 'da_duyet', 3057 => 'da_duyet', 3058 => 'da_duyet', 3059 => 'da_duyet', 3060 => 'da_duyet', 3061 => 'da_duyet', 3062 => 'tu_choi', 3063 => 'da_duyet', 3064 => 'da_duyet', 3065 => 'da_duyet', 3066 => 'da_duyet', 3067 => 'da_duyet', 3068 => 'da_duyet', 3069 => 'da_duyet', 3070 => 'da_duyet', 3071 => 'da_duyet', 3072 => 'da_duyet', 3073 => 'da_duyet', 3074 => 'da_duyet', 3075 => 'da_duyet', 3076 => 'da_duyet', 3077 => 'da_duyet', 3078 => 'da_duyet', 3079 => 'da_duyet', 3080 => 'da_duyet', 3081 => 'da_duyet', 3082 => 'da_duyet', 3083 => 'da_duyet', 3084 => 'da_duyet', 3085 => 'da_duyet', 3086 => 'da_duyet', 3087 => 'da_duyet', 3088 => 'da_duyet', 3089 => 'da_duyet', 3090 => 'da_duyet', 3091 => 'da_duyet', 3092 => 'da_duyet', 3093 => 'da_duyet', 3094 => 'da_duyet', 3095 => 'da_duyet', 3096 => 'da_duyet', 3097 => 'da_duyet', 3098 => 'da_duyet', 3099 => 'da_duyet', 3100 => 'da_duyet', 3101 => 'da_duyet', 3102 => 'da_duyet', 3103 => 'da_duyet', 3104 => 'da_duyet', 3105 => 'da_duyet', 3106 => 'da_duyet', 3107 => 'da_duyet', 3108 => 'da_duyet', 3109 => 'da_duyet', 3110 => 'da_duyet', 3111 => 'da_duyet', 3112 => 'da_duyet', 3113 => 'da_duyet', 3114 => 'da_duyet', 3115 => 'da_duyet', 3116 => 'da_duyet', 3117 => 'da_duyet', 3118 => 'da_duyet', 3125 => 'da_duyet', 3126 => 'da_duyet', 3127 => 'da_duyet', 3128 => 'da_duyet', 3129 => 'da_duyet', 3130 => 'da_duyet', 3131 => 'da_duyet', 3132 => 'da_duyet', 3133 => 'da_duyet', 3134 => 'da_duyet', 3136 => 'da_duyet', 3137 => 'da_duyet', 3141 => 'da_duyet', 3143 => 'da_duyet', 3154 => 'da_duyet', 3155 => 'da_duyet', 3156 => 'da_duyet', 3158 => 'da_duyet', 3161 => 'da_duyet', 3177 => 'da_duyet', 3180 => 'da_duyet', 3181 => 'da_duyet', 3187 => 'da_duyet', 3188 => 'da_duyet', 3190 => 'da_duyet', 3192 => 'da_duyet', 3193 => 'da_duyet', 3195 => 'da_duyet', 3196 => 'da_duyet', 3198 => 'da_duyet', 3199 => 'da_duyet', 3202 => 'da_duyet', 3204 => 'da_duyet', 3213 => 'da_duyet', 3215 => 'da_duyet', 3216 => 'da_duyet', 3218 => 'da_duyet', 3221 => 'da_duyet', 3223 => 'da_duyet', 3225 => 'da_duyet', 3226 => 'da_duyet', 3232 => 'da_duyet', 3233 => 'da_duyet', 3235 => 'da_duyet', 3237 => 'da_duyet', 3242 => 'da_duyet', 3245 => 'da_duyet', 3246 => 'da_duyet', 3247 => 'da_duyet', 3248 => 'da_duyet', 3249 => 'da_duyet', 3250 => 'da_duyet', 3251 => 'da_duyet', 3254 => 'da_duyet', 3256 => 'da_duyet', 3257 => 'da_duyet', 3263 => 'da_duyet', 3268 => 'da_duyet', 3270 => 'da_duyet', 3276 => 'da_duyet', 3278 => 'da_duyet', 3280 => 'da_duyet', 3281 => 'da_duyet', 3283 => 'da_duyet', 3285 => 'da_duyet', 3286 => 'da_duyet', 3287 => 'da_duyet', 3289 => 'da_duyet', 3290 => 'da_duyet', 3292 => 'da_duyet', 3293 => 'da_duyet', 3303 => 'da_duyet', 3308 => 'da_duyet', 3311 => 'da_duyet', 3314 => 'da_duyet', 3315 => 'da_duyet', 3316 => 'da_duyet', 3318 => 'da_duyet', 3319 => 'da_duyet', 3320 => 'da_duyet', 3321 => 'da_duyet', 3322 => 'da_duyet', 3324 => 'da_duyet', 3333 => 'tu_choi', 3335 => 'da_duyet', 3337 => 'da_duyet', 3338 => 'tu_choi', 3339 => 'da_duyet', 3341 => 'da_duyet', 3343 => 'da_duyet', 3344 => 'da_duyet', 3345 => 'tu_choi', 3349 => 'da_duyet', 3350 => 'tu_choi', 3354 => 'tu_choi', 3359 => 'da_duyet', 3360 => 'da_duyet', 3361 => 'da_duyet', 3362 => 'da_duyet', 3363 => 'da_duyet', 3364 => 'da_duyet', 3365 => 'da_duyet', 3366 => 'da_duyet', 3367 => 'da_duyet', 3368 => 'da_duyet', 3370 => 'da_duyet', 3371 => 'da_duyet', 3372 => 'da_duyet', 3373 => 'da_duyet', 3374 => 'da_duyet', 3375 => 'tu_choi', 3376 => 'tu_choi', 3377 => 'da_duyet', 3378 => 'da_duyet', 3380 => 'da_duyet', 3382 => 'da_duyet', 3383 => 'da_duyet', 3384 => 'da_duyet', 3386 => 'da_duyet', 3388 => 'da_duyet', 3389 => 'da_duyet', 3390 => 'da_duyet', 3391 => 'da_duyet', 3392 => 'da_duyet', 3393 => 'tu_choi', 3394 => 'tu_choi', 3395 => 'tu_choi', 3396 => 'tu_choi', 3397 => 'tu_choi', 3398 => 'tu_choi', 3399 => 'tu_choi', 3401 => 'da_duyet', 3402 => 'da_duyet', 3404 => 'da_duyet', 3406 => 'da_duyet', 3409 => 'da_duyet', 3411 => 'da_duyet', 3416 => 'da_duyet', 3417 => 'da_duyet', 3418 => 'da_duyet', 3419 => 'da_duyet', 3420 => 'da_duyet', 3422 => 'da_duyet', 3423 => 'da_duyet', 3426 => 'da_duyet', 3427 => 'da_duyet', 3428 => 'da_duyet', 3429 => 'da_duyet', 3431 => 'da_duyet', 3432 => 'da_duyet', 3433 => 'da_duyet', 3436 => 'da_duyet', 3437 => 'da_duyet', 3439 => 'da_duyet', 3440 => 'da_duyet', 3441 => 'da_duyet', 3442 => 'da_duyet', 3444 => 'da_duyet', 3449 => 'da_duyet', 3453 => 'da_duyet', 3454 => 'da_duyet', 3455 => 'da_duyet', 3456 => 'da_duyet', 3458 => 'da_duyet', 3459 => 'da_duyet', 3460 => 'da_duyet', 3464 => 'da_duyet', 3465 => 'da_duyet', 3475 => 'da_duyet', 3477 => 'da_duyet', 3478 => 'da_duyet', 3481 => 'da_duyet', 3482 => 'da_duyet', 3483 => 'da_duyet', 3486 => 'da_duyet', 3488 => 'da_duyet', 3489 => 'da_duyet', 3490 => 'da_duyet', 3491 => 'da_duyet', 3492 => 'da_duyet', 3495 => 'da_duyet', 3498 => 'da_duyet', 3499 => 'da_duyet', 3501 => 'da_duyet', 3503 => 'da_duyet', 3505 => 'da_duyet', 3506 => 'da_duyet', 3507 => 'da_duyet', 3508 => 'da_duyet', 3510 => 'da_duyet', 3511 => 'da_duyet', 3512 => 'da_duyet', 3513 => 'da_duyet', 3514 => 'da_duyet', 3515 => 'da_duyet', 3516 => 'da_duyet', 3520 => 'da_duyet', 3521 => 'da_duyet', 3523 => 'da_duyet', 3524 => 'da_duyet', 3525 => 'da_duyet', 3527 => 'da_duyet', 3528 => 'da_duyet', 3529 => 'da_duyet', 3530 => 'da_duyet', 3531 => 'da_duyet', 3532 => 'da_duyet', 3533 => 'da_duyet', 3534 => 'da_duyet', 3535 => 'da_duyet', 3536 => 'da_duyet', 3537 => 'da_duyet', 3538 => 'da_duyet', 3539 => 'da_duyet', 3540 => 'da_duyet', 3541 => 'da_duyet', 3542 => 'da_duyet', 3543 => 'da_duyet', 3544 => 'da_duyet', 3545 => 'da_duyet', 3546 => 'da_duyet', 3547 => 'da_duyet', 3548 => 'da_duyet', 3549 => 'da_duyet', 3550 => 'da_duyet', 3551 => 'da_duyet', 3552 => 'da_duyet', 3553 => 'da_duyet', 3555 => 'da_duyet', 3561 => 'da_duyet', 3566 => 'da_duyet', 3568 => 'da_duyet', 3577 => 'da_duyet', 3580 => 'da_duyet', 3585 => 'da_duyet', 3587 => 'da_duyet', 3591 => 'tu_choi', 3594 => 'da_duyet', 3596 => 'da_duyet', 3597 => 'da_duyet', 3598 => 'da_duyet', 3601 => 'da_duyet', 3602 => 'da_duyet', 3603 => 'da_duyet', 3604 => 'da_duyet', 3605 => 'da_duyet', 3607 => 'da_duyet', 3608 => 'da_duyet', 3609 => 'da_duyet', 3610 => 'da_duyet', 3612 => 'da_duyet', 3617 => 'da_duyet', 3618 => 'da_duyet', 3625 => 'da_duyet', 3629 => 'da_duyet', 3630 => 'da_duyet', 3631 => 'da_duyet', 3633 => 'da_duyet', 3644 => 'da_duyet', 3655 => 'da_duyet', 3656 => 'da_duyet', 3657 => 'da_duyet', 3658 => 'da_duyet', 3659 => 'da_duyet', 3660 => 'da_duyet', 3661 => 'da_duyet', 3662 => 'da_duyet', 3663 => 'da_duyet', 3664 => 'da_duyet', 3665 => 'da_duyet', 3666 => 'da_duyet', 3667 => 'da_duyet', 3668 => 'da_duyet', 3669 => 'da_duyet', 3670 => 'da_duyet', 3671 => 'da_duyet', 3672 => 'da_duyet', 3673 => 'da_duyet', 3674 => 'da_duyet', 3676 => 'da_duyet', 3677 => 'da_duyet', 3678 => 'da_duyet', 3679 => 'da_duyet', 3680 => 'da_duyet', 3681 => 'da_duyet', 3682 => 'da_duyet', 3683 => 'da_duyet', 3684 => 'da_duyet', 3685 => 'da_duyet', 3686 => 'da_duyet', 3687 => 'da_duyet', 3688 => 'da_duyet', 3689 => 'da_duyet', 3690 => 'da_duyet', 3691 => 'da_duyet', 3692 => 'da_duyet', 3693 => 'da_duyet', 3694 => 'da_duyet', 3695 => 'da_duyet', 3696 => 'da_duyet', 3697 => 'da_duyet', 3699 => 'da_duyet', 3700 => 'da_duyet', 3701 => 'da_duyet', 3702 => 'da_duyet', 3703 => 'da_duyet', 3704 => 'da_duyet', 3705 => 'da_duyet', 3706 => 'da_duyet', 3707 => 'da_duyet', 3708 => 'da_duyet', 3709 => 'da_duyet', 3710 => 'da_duyet', 3711 => 'da_duyet', 3716 => 'da_duyet', 3717 => 'da_duyet', 3718 => 'da_duyet', 3719 => 'da_duyet', 3720 => 'da_duyet', 3721 => 'da_duyet', 3722 => 'da_duyet', 3723 => 'da_duyet', 3724 => 'da_duyet', 3725 => 'da_duyet', 3726 => 'da_duyet', 3727 => 'da_duyet', 3728 => 'da_duyet', 3729 => 'da_duyet', 3730 => 'da_duyet', 3731 => 'da_duyet', 3732 => 'da_duyet', 3733 => 'da_duyet', 3734 => 'da_duyet', 3735 => 'da_duyet', 3736 => 'da_duyet', 3737 => 'da_duyet', 3740 => 'da_duyet', 3742 => 'da_duyet', 3746 => 'da_duyet', 3748 => 'da_duyet', 3749 => 'da_duyet', 3750 => 'da_duyet', 3751 => 'da_duyet', 3752 => 'da_duyet', 3753 => 'da_duyet', 3754 => 'da_duyet', 3755 => 'da_duyet', 3756 => 'da_duyet', 3757 => 'da_duyet', 3758 => 'tu_choi', 3759 => 'da_duyet', 3760 => 'da_duyet', 3761 => 'da_duyet', 3762 => 'da_duyet', 3763 => 'da_duyet', 3764 => 'da_duyet', 3766 => 'da_duyet', 3767 => 'da_duyet', 3768 => 'da_duyet', 3770 => 'da_duyet', 3771 => 'da_duyet', 3772 => 'da_duyet', 3774 => 'da_duyet', 3775 => 'da_duyet', 3781 => 'da_duyet', 3782 => 'da_duyet', 3783 => 'da_duyet', 3784 => 'da_duyet', 3785 => 'da_duyet', 3786 => 'da_duyet', 3787 => 'da_duyet', 3788 => 'da_duyet', 3789 => 'da_duyet', 3790 => 'da_duyet', 3791 => 'da_duyet', 3792 => 'da_duyet', 3799 => 'da_duyet', 3800 => 'da_duyet', 3802 => 'da_duyet', 3804 => 'da_duyet', 3805 => 'da_duyet', 3806 => 'da_duyet', 3807 => 'da_duyet', 3808 => 'da_duyet', 3809 => 'da_duyet', 3810 => 'da_duyet', 3811 => 'da_duyet', 3812 => 'da_duyet', 3813 => 'da_duyet', 3814 => 'da_duyet', 3815 => 'da_duyet', 3816 => 'da_duyet', 3817 => 'da_duyet', 3818 => 'da_duyet', 3819 => 'da_duyet', 3821 => 'da_duyet', 3822 => 'da_duyet', 3823 => 'da_duyet', 3824 => 'da_duyet', 3825 => 'da_duyet', 3826 => 'da_duyet', 3827 => 'da_duyet', 3828 => 'da_duyet', 3829 => 'da_duyet', 3830 => 'da_duyet', 3831 => 'da_duyet', 3832 => 'da_duyet', 3837 => 'da_duyet', 3859 => 'da_duyet', 3886 => 'da_duyet', 3905 => 'da_duyet', 3925 => 'da_duyet', 3926 => 'da_duyet', 3932 => 'da_duyet', 3940 => 'da_duyet', 3957 => 'da_duyet', 3958 => 'da_duyet', 3959 => 'da_duyet', 3960 => 'tu_choi', 3961 => 'da_duyet', 3962 => 'da_duyet', 3963 => 'da_duyet', 3964 => 'da_duyet', 3965 => 'da_duyet', 3966 => 'da_duyet', 3967 => 'da_duyet', 3968 => 'da_duyet', 3969 => 'da_duyet', 3970 => 'da_duyet', 3971 => 'da_duyet', 3972 => 'da_duyet', 3973 => 'da_duyet', 3974 => 'da_duyet', 3975 => 'da_duyet', 3976 => 'da_duyet', 3977 => 'da_duyet', 3978 => 'da_duyet', 3979 => 'da_duyet', 3980 => 'da_duyet', 3981 => 'da_duyet', 3982 => 'da_duyet', 3983 => 'da_duyet', 3984 => 'da_duyet', 3985 => 'da_duyet', 3986 => 'da_duyet', 3987 => 'da_duyet', 3988 => 'da_duyet', 3989 => 'da_duyet', 3990 => 'da_duyet', 3991 => 'da_duyet', 3992 => 'da_duyet', 3993 => 'da_duyet', 3994 => 'da_duyet', 3995 => 'da_duyet', 3996 => 'da_duyet', 3997 => 'da_duyet', 3998 => 'da_duyet', 3999 => 'da_duyet', 4000 => 'da_duyet', 4001 => 'da_duyet', 4002 => 'da_duyet', 4003 => 'da_duyet', 4004 => 'da_duyet', 4005 => 'da_duyet', 4006 => 'da_duyet', 4007 => 'da_duyet', 4009 => 'da_duyet', 4014 => 'da_duyet', 4016 => 'da_duyet', 4017 => 'da_duyet', 4020 => 'da_duyet', 4021 => 'da_duyet', 4022 => 'da_duyet', 4023 => 'da_duyet', 4024 => 'da_duyet', 4025 => 'da_duyet', 4026 => 'da_duyet', 4028 => 'da_duyet', 4031 => 'da_duyet', 4032 => 'da_duyet', 4033 => 'da_duyet', 4034 => 'da_duyet', 4036 => 'da_duyet', 4040 => 'da_duyet', 4041 => 'da_duyet', 4042 => 'da_duyet', 4045 => 'da_duyet', 4046 => 'da_duyet', 4047 => 'da_duyet', 4048 => 'da_duyet', 4049 => 'da_duyet', 4050 => 'da_duyet', 4051 => 'da_duyet', 4053 => 'da_duyet', 4054 => 'da_duyet', 4055 => 'da_duyet', 4060 => 'da_duyet', 4061 => 'da_duyet', 4062 => 'da_duyet', 4063 => 'da_duyet', 4064 => 'da_duyet', 4067 => 'da_duyet', 4070 => 'da_duyet', 4071 => 'da_duyet', 4072 => 'da_duyet', 4074 => 'da_duyet', 4075 => 'da_duyet', 4077 => 'da_duyet', 4078 => 'da_duyet', 4079 => 'da_duyet', 4080 => 'da_duyet', 4086 => 'da_duyet', 4106 => 'da_duyet', 4107 => 'da_duyet', 4108 => 'da_duyet', 4109 => 'da_duyet', 4110 => 'da_duyet', 4111 => 'da_duyet', 4112 => 'da_duyet', 4113 => 'da_duyet', 4115 => 'da_duyet', 4116 => 'da_duyet', 4121 => 'da_duyet', 4122 => 'da_duyet', 4123 => 'da_duyet', 4124 => 'da_duyet', 4125 => 'da_duyet', 4126 => 'da_duyet', 4127 => 'da_duyet', 4128 => 'da_duyet', 4129 => 'da_duyet', 4130 => 'da_duyet', 4142 => 'da_duyet', 4144 => 'da_duyet', 4145 => 'da_duyet', 4146 => 'da_duyet', 4147 => 'da_duyet', 4148 => 'da_duyet', 4149 => 'da_duyet', 4150 => 'da_duyet', 4152 => 'da_duyet', 4154 => 'da_duyet', 4157 => 'da_duyet', 4158 => 'da_duyet', 4159 => 'da_duyet', 4161 => 'da_duyet', 4162 => 'da_duyet', 4164 => 'da_duyet', 4165 => 'da_duyet', 4166 => 'da_duyet', 4167 => 'da_duyet', 4169 => 'da_duyet', 4170 => 'da_duyet', 4171 => 'da_duyet', 4172 => 'da_duyet', 4173 => 'da_duyet', 4174 => 'da_duyet', 4176 => 'da_duyet', 4177 => 'da_duyet', 4178 => 'da_duyet', 4179 => 'da_duyet', 4180 => 'da_duyet', 4181 => 'da_duyet', 4183 => 'da_duyet', 4184 => 'da_duyet', 4185 => 'da_duyet', 4186 => 'da_duyet', 4187 => 'da_duyet', 4188 => 'da_duyet', 4189 => 'da_duyet', 4194 => 'da_duyet', 4195 => 'da_duyet', 4196 => 'da_duyet', 4197 => 'da_duyet', 4200 => 'da_duyet', 4203 => 'da_duyet', 4204 => 'da_duyet', 4205 => 'da_duyet', 4206 => 'da_duyet', 4207 => 'da_duyet', 4208 => 'da_duyet', 4209 => 'da_duyet', 4210 => 'da_duyet', 4211 => 'da_duyet', 4212 => 'da_duyet', 4213 => 'da_duyet', 4214 => 'da_duyet', 4216 => 'da_duyet', 4217 => 'da_duyet', 4224 => 'da_duyet', 4225 => 'da_duyet', 4228 => 'da_duyet', 4229 => 'da_duyet', 4232 => 'da_duyet', 4233 => 'da_duyet', 4235 => 'da_duyet', 4236 => 'da_duyet', 4239 => 'da_duyet', 4247 => 'da_duyet', 4248 => 'da_duyet', 4249 => 'da_duyet', 4250 => 'da_duyet', 4252 => 'da_duyet', 4253 => 'da_duyet', 4255 => 'da_duyet', 4256 => 'da_duyet', 4257 => 'da_duyet', 4261 => 'da_duyet', 4262 => 'da_duyet', 4273 => 'da_duyet', 4274 => 'da_duyet', 4275 => 'da_duyet', 4276 => 'da_duyet', 4277 => 'da_duyet', 4278 => 'da_duyet', 4279 => 'da_duyet', 4280 => 'da_duyet', 4281 => 'da_duyet', 4282 => 'da_duyet', 4283 => 'da_duyet', 4284 => 'da_duyet', 4285 => 'da_duyet', 4286 => 'da_duyet', 4290 => 'da_duyet', 4292 => 'da_duyet', 4293 => 'da_duyet', 4294 => 'da_duyet', 4298 => 'da_duyet', 4302 => 'da_duyet', 4312 => 'da_duyet', 4313 => 'da_duyet', 4317 => 'da_duyet', 4318 => 'da_duyet', 4319 => 'da_duyet', 4320 => 'da_duyet', 4321 => 'da_duyet', 4322 => 'da_duyet', 4323 => 'da_duyet', 4324 => 'da_duyet', 4327 => 'da_duyet', 4335 => 'da_duyet', 4348 => 'da_duyet', 4352 => 'da_duyet', 4354 => 'da_duyet', 4358 => 'da_duyet', 4362 => 'da_duyet', 4363 => 'da_duyet', 4364 => 'da_duyet', 4365 => 'da_duyet', 4366 => 'da_duyet', 4374 => 'da_duyet', 4376 => 'da_duyet', 4377 => 'da_duyet', 4378 => 'da_duyet', 4379 => 'da_duyet', 4380 => 'da_duyet', 4386 => 'da_duyet', 4387 => 'da_duyet', 4389 => 'da_duyet', 4391 => 'da_duyet', 4399 => 'da_duyet', 4400 => 'da_duyet', 4402 => 'da_duyet', 4403 => 'da_duyet', 4404 => 'da_duyet', 4405 => 'da_duyet', 4406 => 'da_duyet', 4407 => 'da_duyet', 4408 => 'da_duyet', 4409 => 'da_duyet', 4410 => 'da_duyet', 4412 => 'da_duyet', 4413 => 'da_duyet', 4414 => 'da_duyet', 4415 => 'da_duyet', 4417 => 'da_duyet', 4419 => 'da_duyet', 4420 => 'da_duyet', 4421 => 'da_duyet', 4422 => 'da_duyet', 4424 => 'da_duyet', 4425 => 'da_duyet', 4426 => 'da_duyet', 4427 => 'da_duyet', 4428 => 'da_duyet', 4429 => 'da_duyet', 4430 => 'da_duyet', 4431 => 'da_duyet', 4432 => 'da_duyet', 4433 => 'da_duyet', 4434 => 'da_duyet', 4435 => 'da_duyet', 4436 => 'da_duyet', 4437 => 'da_duyet', 4438 => 'da_duyet', 4439 => 'da_duyet', 4440 => 'da_duyet', 4441 => 'da_duyet', 4442 => 'da_duyet', 4443 => 'da_duyet', 4444 => 'da_duyet', 4453 => 'da_duyet', 4454 => 'da_duyet', 4455 => 'da_duyet', 4457 => 'da_duyet', 4458 => 'da_duyet', 4459 => 'da_duyet', 4460 => 'da_duyet', 4461 => 'da_duyet', 4462 => 'da_duyet', 4463 => 'da_duyet', 4465 => 'da_duyet', 4466 => 'da_duyet', 4467 => 'da_duyet', 4468 => 'da_duyet', 4469 => 'da_duyet', 4470 => 'da_duyet', 4472 => 'da_duyet', 4473 => 'tu_choi', 4474 => 'da_duyet', 4475 => 'da_duyet', 4476 => 'da_duyet', 4477 => 'da_duyet', 4478 => 'da_duyet', 4479 => 'da_duyet', 4480 => 'da_duyet', 4481 => 'da_duyet', 4482 => 'da_duyet', 4483 => 'da_duyet', 4484 => 'da_duyet', 4485 => 'da_duyet', 4486 => 'da_duyet', 4487 => 'da_duyet', 4488 => 'da_duyet', 4489 => 'da_duyet', 4490 => 'da_duyet', 4491 => 'da_duyet', 4492 => 'da_duyet', 4496 => 'da_duyet', 4500 => 'tu_choi', 4503 => 'tu_choi', 4507 => 'da_duyet', 4508 => 'da_duyet', 4509 => 'da_duyet', 4510 => 'da_duyet', 4511 => 'da_duyet', 4512 => 'da_duyet', 4517 => 'da_duyet', 4518 => 'da_duyet', 4519 => 'da_duyet', 4520 => 'da_duyet', 4521 => 'da_duyet', 4522 => 'da_duyet', 4523 => 'da_duyet', 4524 => 'da_duyet', 4525 => 'da_duyet', 4526 => 'da_duyet', 4527 => 'da_duyet', 4528 => 'da_duyet', 4529 => 'da_duyet', 4530 => 'da_duyet', 4532 => 'da_duyet', 4533 => 'da_duyet', 4534 => 'da_duyet', 4535 => 'da_duyet', 4542 => 'da_duyet', 4544 => 'da_duyet', 4545 => 'da_duyet', 4546 => 'da_duyet', 4547 => 'da_duyet', 4548 => 'da_duyet', 4549 => 'da_duyet', 4550 => 'da_duyet', 4551 => 'da_duyet', 4552 => 'da_duyet', 4553 => 'da_duyet', 4554 => 'da_duyet', 4555 => 'da_duyet', 4557 => 'da_duyet', 4558 => 'da_duyet', 4560 => 'da_duyet', 4561 => 'da_duyet', 4562 => 'da_duyet', 4564 => 'da_duyet', 4565 => 'da_duyet', 4566 => 'da_duyet', 4567 => 'da_duyet', 4568 => 'da_duyet', 4569 => 'da_duyet', 4570 => 'da_duyet', 4571 => 'da_duyet', 4572 => 'da_duyet', 4573 => 'da_duyet', 4574 => 'da_duyet', 4575 => 'da_duyet', 4578 => 'da_duyet', 4579 => 'da_duyet', 4580 => 'da_duyet', 4581 => 'da_duyet', 4582 => 'da_duyet', 4583 => 'da_duyet', 4584 => 'da_duyet', 4585 => 'da_duyet', 4586 => 'da_duyet', 4587 => 'da_duyet', 4588 => 'da_duyet', 4589 => 'da_duyet', 4590 => 'da_duyet', 4591 => 'da_duyet', 4592 => 'da_duyet', 4593 => 'da_duyet', 4594 => 'da_duyet', 4595 => 'da_duyet', 4596 => 'da_duyet', 4597 => 'da_duyet', 4598 => 'da_duyet', 4599 => 'da_duyet', 4600 => 'da_duyet', 4602 => 'da_duyet', 4603 => 'da_duyet', 4604 => 'da_duyet', 4605 => 'da_duyet', 4606 => 'da_duyet', 4607 => 'da_duyet', 4608 => 'da_duyet', 4609 => 'da_duyet', 4610 => 'tu_choi', 4616 => 'da_duyet', 4617 => 'da_duyet', 4618 => 'da_duyet', 4619 => 'da_duyet', 4621 => 'da_duyet', 4622 => 'da_duyet', 4623 => 'da_duyet', 4624 => 'da_duyet', 4625 => 'da_duyet', 4626 => 'da_duyet', 4627 => 'da_duyet', 4628 => 'da_duyet', 4629 => 'da_duyet', 4630 => 'da_duyet', 4631 => 'da_duyet', 4632 => 'da_duyet', 4633 => 'da_duyet', 4634 => 'da_duyet', 4635 => 'tu_choi', 4636 => 'da_duyet', 4637 => 'da_duyet', 4638 => 'da_duyet', 4639 => 'da_duyet', 4640 => 'da_duyet', 4641 => 'da_duyet', 4642 => 'da_duyet', 4643 => 'da_duyet', 4646 => 'da_duyet', 4647 => 'da_duyet', 4648 => 'da_duyet', 4650 => 'tu_choi', 4651 => 'da_duyet', 4652 => 'da_duyet', 4653 => 'da_duyet', 4654 => 'da_duyet', 4655 => 'da_duyet', 4656 => 'da_duyet', 4657 => 'da_duyet', 4658 => 'da_duyet', 4659 => 'da_duyet', 4660 => 'da_duyet', 4661 => 'da_duyet', 4662 => 'da_duyet', 4663 => 'da_duyet', 4664 => 'da_duyet', 4665 => 'da_duyet', 4666 => 'da_duyet', 4667 => 'da_duyet', 4668 => 'da_duyet', 4669 => 'da_duyet', 4670 => 'da_duyet', 4671 => 'da_duyet', 4672 => 'da_duyet', 4673 => 'da_duyet', 4674 => 'da_duyet', 4675 => 'da_duyet', 4676 => 'da_duyet', 4677 => 'da_duyet', 4678 => 'da_duyet', 4679 => 'da_duyet', 4680 => 'da_duyet', 4681 => 'da_duyet', 4682 => 'da_duyet', 4683 => 'da_duyet', 4684 => 'da_duyet', 4685 => 'da_duyet', 4686 => 'da_duyet', 4687 => 'da_duyet', 4688 => 'da_duyet', 4689 => 'da_duyet', 4690 => 'da_duyet', 4691 => 'da_duyet', 4692 => 'da_duyet', 4693 => 'da_duyet', 4694 => 'da_duyet', 4695 => 'da_duyet', 4696 => 'da_duyet', 4697 => 'da_duyet', 4700 => 'da_duyet', 4701 => 'da_duyet', 4702 => 'da_duyet', 4703 => 'da_duyet', 4704 => 'da_duyet', 4705 => 'da_duyet', 4706 => 'da_duyet', 4707 => 'da_duyet', 4708 => 'da_duyet', 4709 => 'da_duyet', 4710 => 'da_duyet', 4711 => 'da_duyet', 4712 => 'da_duyet', 4713 => 'da_duyet', 4714 => 'da_duyet', 4716 => 'da_duyet', 4721 => 'da_duyet', 4722 => 'tu_choi', 4723 => 'da_duyet', 4724 => 'da_duyet', 4725 => 'da_duyet', 4726 => 'da_duyet', 4741 => 'da_duyet', 4742 => 'da_duyet', 4748 => 'da_duyet', 4749 => 'da_duyet', 4750 => 'da_duyet', 4751 => 'da_duyet', 4752 => 'da_duyet', 4753 => 'da_duyet', 4754 => 'da_duyet', 4760 => 'da_duyet', 4761 => 'da_duyet', 4762 => 'da_duyet', 4763 => 'da_duyet', 4764 => 'da_duyet', 4765 => 'da_duyet', 4768 => 'da_duyet', 4769 => 'da_duyet', 4770 => 'da_duyet', 4771 => 'da_duyet', 4772 => 'da_duyet', 4773 => 'da_duyet', 4774 => 'da_duyet', 4775 => 'da_duyet', 4776 => 'da_duyet', 4777 => 'da_duyet', 4778 => 'da_duyet', 4779 => 'da_duyet', 4780 => 'da_duyet', 4781 => 'da_duyet', 4782 => 'da_duyet', 4783 => 'da_duyet', 4784 => 'da_duyet', 4785 => 'da_duyet', 4786 => 'da_duyet', 4787 => 'da_duyet', 4788 => 'da_duyet', 4789 => 'da_duyet', 4790 => 'da_duyet', 4791 => 'da_duyet', 4792 => 'da_duyet', 4798 => 'da_duyet', 4799 => 'da_duyet', 4800 => 'da_duyet', 4801 => 'da_duyet', 4802 => 'da_duyet', 4803 => 'da_duyet', 4804 => 'da_duyet', 4805 => 'da_duyet', 4806 => 'da_duyet', 4807 => 'da_duyet', 4808 => 'da_duyet', 4809 => 'da_duyet', 4810 => 'da_duyet', 4811 => 'da_duyet', 4812 => 'da_duyet', 4813 => 'da_duyet', 4814 => 'da_duyet', 4815 => 'da_duyet', 4816 => 'da_duyet', 4817 => 'da_duyet', 4818 => 'da_duyet', 4819 => 'da_duyet', 4820 => 'da_duyet', 4821 => 'da_duyet', 4822 => 'da_duyet', 4823 => 'da_duyet', 4824 => 'da_duyet', 4825 => 'da_duyet', 4826 => 'da_duyet', 4827 => 'da_duyet', 4830 => 'da_duyet', 4850 => 'da_duyet', 4851 => 'da_duyet', 4852 => 'da_duyet', 4853 => 'da_duyet', 4854 => 'da_duyet', 4855 => 'da_duyet', 4856 => 'da_duyet', 4857 => 'da_duyet', 4858 => 'da_duyet', 4859 => 'da_duyet', 4861 => 'da_duyet', 4875 => 'da_duyet', 4880 => 'da_duyet', 4881 => 'tu_choi', 4882 => 'da_duyet', 4883 => 'da_duyet', 4884 => 'da_duyet', 4885 => 'da_duyet', 4886 => 'da_duyet', 4918 => 'tu_choi', 4920 => 'da_duyet', 4921 => 'da_duyet', 4922 => 'da_duyet', 4923 => 'da_duyet', 4924 => 'da_duyet', 4925 => 'da_duyet', 4926 => 'da_duyet', 4927 => 'da_duyet', 4928 => 'da_duyet', 4929 => 'da_duyet', 4930 => 'da_duyet', 4931 => 'da_duyet', 4932 => 'da_duyet', 4933 => 'da_duyet', 4934 => 'da_duyet', 4935 => 'da_duyet', 4936 => 'da_duyet', 4937 => 'da_duyet', 4938 => 'da_duyet', 4939 => 'da_duyet', 4940 => 'da_duyet', 4941 => 'da_duyet', 4942 => 'da_duyet', 4943 => 'da_duyet', 4944 => 'da_duyet', 4945 => 'da_duyet', 4946 => 'da_duyet', 4947 => 'da_duyet', 4948 => 'da_duyet', 4949 => 'da_duyet', 4950 => 'da_duyet', 4951 => 'da_duyet', 4952 => 'da_duyet', 4953 => 'da_duyet', 4954 => 'da_duyet', 4955 => 'da_duyet', 4956 => 'da_duyet', 4957 => 'da_duyet', 4958 => 'da_duyet', 4959 => 'da_duyet', 4960 => 'da_duyet', 4961 => 'da_duyet', 4962 => 'da_duyet', 4963 => 'da_duyet', 4964 => 'da_duyet', 4965 => 'da_duyet', 4966 => 'da_duyet', 4967 => 'da_duyet', 4968 => 'da_duyet', 4969 => 'da_duyet', 4970 => 'da_duyet', 4971 => 'da_duyet', 4972 => 'da_duyet', 4973 => 'da_duyet', 4974 => 'da_duyet', 4975 => 'da_duyet', 4976 => 'da_duyet', 4977 => 'da_duyet', 4978 => 'da_duyet', 4979 => 'da_duyet', 4980 => 'tu_choi', 4985 => 'da_duyet', 4988 => 'da_duyet', 4990 => 'da_duyet', 4991 => 'da_duyet', 4992 => 'da_duyet', 4993 => 'da_duyet', 4994 => 'da_duyet', 4995 => 'da_duyet', 4999 => 'da_duyet', 5000 => 'da_duyet', 5001 => 'da_duyet', 5002 => 'da_duyet', 5003 => 'da_duyet', 5004 => 'da_duyet', 5005 => 'da_duyet', 5006 => 'da_duyet', 5007 => 'da_duyet', 5008 => 'da_duyet', 5009 => 'da_duyet', 5010 => 'da_duyet', 5011 => 'da_duyet', 5012 => 'da_duyet', 5013 => 'da_duyet', 5014 => 'da_duyet', 5015 => 'da_duyet', 5016 => 'da_duyet', 5017 => 'da_duyet', 5018 => 'da_duyet', 5019 => 'da_duyet', 5021 => 'da_duyet', 5022 => 'da_duyet', 5023 => 'da_duyet', 5024 => 'da_duyet', 5025 => 'da_duyet', 5026 => 'da_duyet', 5027 => 'da_duyet', 5032 => 'da_duyet', 5033 => 'da_duyet', 5035 => 'da_duyet', 5037 => 'da_duyet', 5040 => 'da_duyet', 5041 => 'da_duyet', 5042 => 'da_duyet', 5049 => 'da_duyet', 5050 => 'da_duyet', 5051 => 'da_duyet', 5052 => 'da_duyet', 5053 => 'da_duyet', 5054 => 'da_duyet', 5055 => 'da_duyet', 5056 => 'da_duyet', 5057 => 'da_duyet', 5058 => 'da_duyet', 5059 => 'da_duyet', 5060 => 'da_duyet', 5061 => 'da_duyet', 5062 => 'da_duyet', 5063 => 'da_duyet', 5064 => 'da_duyet', 5065 => 'da_duyet', 5066 => 'da_duyet', 5067 => 'da_duyet', 5068 => 'da_duyet', 5069 => 'da_duyet', 5070 => 'da_duyet', 5071 => 'da_duyet', 5072 => 'da_duyet', 5073 => 'da_duyet', 5074 => 'da_duyet', 5075 => 'da_duyet', 5076 => 'da_duyet', 5077 => 'da_duyet', 5078 => 'da_duyet', 5079 => 'da_duyet', 5080 => 'da_duyet', 5081 => 'da_duyet', 5082 => 'da_duyet', 5083 => 'da_duyet', 5084 => 'da_duyet', 5085 => 'da_duyet', 5086 => 'da_duyet', 5087 => 'da_duyet', 5088 => 'da_duyet', 5089 => 'da_duyet', 5090 => 'da_duyet', 5091 => 'da_duyet', 5093 => 'da_duyet', 5094 => 'da_duyet', 5095 => 'da_duyet', 5096 => 'da_duyet', 5097 => 'da_duyet', 5098 => 'da_duyet', 5099 => 'da_duyet', 5100 => 'da_duyet', 5101 => 'da_duyet', 5103 => 'da_duyet', 5104 => 'da_duyet', 5105 => 'da_duyet', 5107 => 'da_duyet', 5108 => 'da_duyet', 5115 => 'da_duyet', 5116 => 'da_duyet', 5117 => 'da_duyet', 5118 => 'da_duyet', 5119 => 'da_duyet', 5120 => 'da_duyet', 5121 => 'da_duyet', 5122 => 'da_duyet', 5123 => 'da_duyet', 5124 => 'da_duyet', 5125 => 'da_duyet', 5126 => 'da_duyet', 5127 => 'da_duyet', 5128 => 'da_duyet', 5129 => 'da_duyet', 5130 => 'da_duyet', 5131 => 'da_duyet', 5139 => 'da_duyet', 5140 => 'da_duyet', 5141 => 'da_duyet', 5146 => 'da_duyet', 5150 => 'da_duyet', 5152 => 'da_duyet', 5159 => 'da_duyet', 5160 => 'da_duyet', 5161 => 'da_duyet', 5162 => 'da_duyet', 5163 => 'da_duyet', 5164 => 'da_duyet', 5165 => 'da_duyet', 5166 => 'da_duyet', 5169 => 'tu_choi', 5174 => 'da_duyet', 5175 => 'da_duyet', 5176 => 'da_duyet', 5177 => 'da_duyet', 5181 => 'da_duyet', 5186 => 'da_duyet', 5187 => 'da_duyet', 5189 => 'da_duyet', 5197 => 'da_duyet', 5201 => 'da_duyet', 5204 => 'da_duyet', 5205 => 'da_duyet', 5206 => 'da_duyet', 5207 => 'da_duyet', 5208 => 'da_duyet', 5209 => 'da_duyet', 5210 => 'da_duyet', 5213 => 'da_duyet', 5214 => 'da_duyet', 5215 => 'da_duyet', 5216 => 'da_duyet', 5217 => 'da_duyet', 5218 => 'da_duyet', 5219 => 'da_duyet', 5221 => 'da_duyet', 5222 => 'da_duyet', 5224 => 'da_duyet', 5225 => 'da_duyet', 5226 => 'da_duyet', 5227 => 'da_duyet', 5228 => 'da_duyet', 5229 => 'da_duyet', 5230 => 'da_duyet', 5231 => 'da_duyet', 5242 => 'da_duyet', 5243 => 'da_duyet', 5248 => 'da_duyet', 5261 => 'da_duyet', 5262 => 'da_duyet', 5264 => 'da_duyet', 5266 => 'da_duyet', 5276 => 'da_duyet', 5279 => 'da_duyet', 5280 => 'da_duyet', 5282 => 'da_duyet', 5285 => 'da_duyet', 5287 => 'da_duyet', 5288 => 'da_duyet', 5289 => 'da_duyet', 5290 => 'da_duyet', 5292 => 'da_duyet', 5293 => 'da_duyet', 5294 => 'da_duyet', 5296 => 'da_duyet', 5297 => 'da_duyet', 5298 => 'da_duyet', 5299 => 'da_duyet', 5309 => 'da_duyet', 5310 => 'da_duyet', 5312 => 'da_duyet', 5313 => 'da_duyet', 5314 => 'da_duyet', 5315 => 'da_duyet', 5316 => 'da_duyet', 5317 => 'da_duyet', 5318 => 'da_duyet', 5319 => 'da_duyet', 5320 => 'da_duyet', 5321 => 'da_duyet', 5322 => 'da_duyet', 5323 => 'da_duyet', 5325 => 'da_duyet', 5326 => 'da_duyet', 5327 => 'da_duyet', 5328 => 'da_duyet', 5329 => 'da_duyet', 5330 => 'da_duyet', 5335 => 'da_duyet', 5336 => 'da_duyet', 5337 => 'da_duyet', 5351 => 'da_duyet', 5352 => 'da_duyet', 5353 => 'tu_choi', 5354 => 'da_duyet', 5355 => 'da_duyet', 5367 => 'tu_choi', 5393 => 'da_duyet', 5394 => 'da_duyet', 5395 => 'da_duyet', 5401 => 'da_duyet', 5415 => 'da_duyet', 5429 => 'da_duyet', 5430 => 'da_duyet', 5431 => 'da_duyet', 5432 => 'da_duyet', 5433 => 'da_duyet', 5435 => 'da_duyet', 5437 => 'da_duyet', 5438 => 'da_duyet', 5439 => 'da_duyet', 5440 => 'da_duyet', 5441 => 'da_duyet', 5442 => 'da_duyet', 5445 => 'da_duyet', 5446 => 'da_duyet', 5447 => 'da_duyet', 5448 => 'da_duyet', 5449 => 'da_duyet', 5450 => 'da_duyet', 5451 => 'da_duyet', 5452 => 'da_duyet', 5453 => 'da_duyet', 5454 => 'da_duyet', 5455 => 'da_duyet', 5456 => 'da_duyet', 5457 => 'da_duyet', 5458 => 'da_duyet', 5459 => 'da_duyet', 5460 => 'da_duyet', 5461 => 'da_duyet', 5462 => 'da_duyet', 5463 => 'da_duyet', 5464 => 'da_duyet', 5465 => 'da_duyet', 5466 => 'da_duyet', 5467 => 'da_duyet', 5468 => 'da_duyet', 5469 => 'da_duyet', 5470 => 'da_duyet', 5471 => 'da_duyet', 5472 => 'da_duyet', 5473 => 'da_duyet', 5474 => 'da_duyet', 5475 => 'da_duyet', 5476 => 'da_duyet', 5477 => 'da_duyet', 5478 => 'da_duyet', 5479 => 'da_duyet', 5480 => 'da_duyet', 5482 => 'da_duyet', 5483 => 'da_duyet', 5484 => 'da_duyet', 5485 => 'da_duyet', 5493 => 'da_duyet', 5495 => 'da_duyet', 5496 => 'da_duyet', 5497 => 'da_duyet', 5498 => 'da_duyet', 5499 => 'da_duyet', 5500 => 'da_duyet', 5501 => 'da_duyet', 5502 => 'da_duyet', 5503 => 'da_duyet', 5504 => 'da_duyet', 5505 => 'da_duyet', 5506 => 'da_duyet', 5507 => 'da_duyet', 5508 => 'da_duyet', 5509 => 'da_duyet', 5510 => 'da_duyet', 5511 => 'da_duyet', 5512 => 'da_duyet', 5513 => 'da_duyet', 5514 => 'da_duyet', 5515 => 'da_duyet', 5516 => 'da_duyet', 5517 => 'da_duyet', 5518 => 'da_duyet', 5519 => 'da_duyet', 5520 => 'da_duyet', 5521 => 'da_duyet', 5522 => 'da_duyet', 5523 => 'da_duyet', 5524 => 'da_duyet', 5525 => 'da_duyet', 5526 => 'da_duyet', 5527 => 'da_duyet', 5528 => 'da_duyet', 5529 => 'da_duyet', 5530 => 'da_duyet', 5531 => 'da_duyet', 5532 => 'da_duyet', 5533 => 'da_duyet', 5534 => 'da_duyet', 5535 => 'da_duyet', 5536 => 'da_duyet', 5537 => 'da_duyet', 5538 => 'da_duyet', 5539 => 'da_duyet', 5540 => 'da_duyet', 5541 => 'da_duyet', 5542 => 'da_duyet', 5543 => 'da_duyet', 5544 => 'da_duyet', 5545 => 'da_duyet', 5546 => 'da_duyet', 5549 => 'da_duyet', 5552 => 'tu_choi', 5553 => 'da_duyet', 5554 => 'da_duyet', 5562 => 'da_duyet', 5564 => 'da_duyet', 5565 => 'da_duyet', 5566 => 'da_duyet', 5567 => 'da_duyet', 5568 => 'da_duyet', 5569 => 'da_duyet', 5570 => 'da_duyet', 5571 => 'da_duyet', 5572 => 'da_duyet', 5573 => 'da_duyet', 5574 => 'da_duyet', 5575 => 'da_duyet', 5576 => 'da_duyet', 5577 => 'da_duyet', 5578 => 'da_duyet', 5579 => 'da_duyet', 5580 => 'da_duyet', 5583 => 'da_duyet', 5584 => 'da_duyet', 5585 => 'da_duyet', 5586 => 'da_duyet', 5587 => 'da_duyet', 5588 => 'da_duyet', 5589 => 'da_duyet', 5590 => 'da_duyet', 5591 => 'da_duyet', 5592 => 'da_duyet', 5593 => 'da_duyet', 5594 => 'da_duyet', 5595 => 'da_duyet', 5596 => 'da_duyet', 5597 => 'da_duyet', 5598 => 'da_duyet', 5599 => 'da_duyet', 5600 => 'da_duyet', 5601 => 'da_duyet', 5602 => 'da_duyet', 5603 => 'da_duyet', 5606 => 'da_duyet', 5607 => 'da_duyet', 5609 => 'da_duyet', 5610 => 'da_duyet', 5611 => 'da_duyet', 5614 => 'da_duyet', 5615 => 'da_duyet', 5616 => 'da_duyet', 5617 => 'da_duyet', 5618 => 'tu_choi', 5619 => 'da_duyet', 5620 => 'da_duyet', 5621 => 'da_duyet', 5622 => 'da_duyet', 5626 => 'da_duyet', 5629 => 'da_duyet', 5630 => 'da_duyet', 5631 => 'da_duyet', 5632 => 'da_duyet', 5633 => 'da_duyet', 5634 => 'da_duyet', 5635 => 'da_duyet', 5636 => 'da_duyet', 5637 => 'da_duyet', 5638 => 'da_duyet', 5639 => 'da_duyet', 5640 => 'da_duyet', 5641 => 'da_duyet', 5642 => 'da_duyet', 5643 => 'da_duyet', 5644 => 'da_duyet', 5645 => 'da_duyet', 5646 => 'da_duyet', 5647 => 'da_duyet', 5648 => 'da_duyet', 5649 => 'da_duyet', 5650 => 'da_duyet', 5651 => 'da_duyet', 5652 => 'da_duyet', 5653 => 'da_duyet', 5654 => 'da_duyet', 5655 => 'da_duyet', 5656 => 'da_duyet', 5657 => 'da_duyet', 5658 => 'da_duyet', 5659 => 'da_duyet', 5660 => 'da_duyet', 5661 => 'da_duyet', 5662 => 'da_duyet', 5663 => 'da_duyet', 5664 => 'da_duyet', 5665 => 'da_duyet', 5666 => 'da_duyet', 5667 => 'da_duyet', 5668 => 'da_duyet', 5669 => 'da_duyet', 5670 => 'da_duyet', 5671 => 'da_duyet', 5672 => 'da_duyet', 5673 => 'da_duyet', 5674 => 'da_duyet', 5675 => 'da_duyet', 5676 => 'da_duyet', 5677 => 'da_duyet', 5678 => 'da_duyet', 5679 => 'da_duyet', 5680 => 'da_duyet', 5689 => 'da_duyet', 5690 => 'da_duyet', 5691 => 'da_duyet', 5692 => 'da_duyet', 5693 => 'da_duyet', 5694 => 'da_duyet', 5695 => 'da_duyet', 5696 => 'da_duyet', 5697 => 'da_duyet', 5698 => 'da_duyet', 5699 => 'da_duyet', 5700 => 'da_duyet', 5701 => 'da_duyet', 5702 => 'da_duyet', 5703 => 'da_duyet', 5704 => 'da_duyet', 5705 => 'da_duyet', 5706 => 'da_duyet', 5707 => 'da_duyet', 5708 => 'da_duyet', 5709 => 'da_duyet', 5710 => 'da_duyet', 5711 => 'da_duyet', 5712 => 'da_duyet', 5715 => 'da_duyet', 5716 => 'da_duyet', 5717 => 'da_duyet', 5718 => 'da_duyet', 5719 => 'da_duyet', 5720 => 'da_duyet', 5721 => 'da_duyet', 5722 => 'da_duyet', 5723 => 'da_duyet', 5725 => 'da_duyet', 5726 => 'da_duyet', 5727 => 'da_duyet', 5728 => 'da_duyet', 5729 => 'da_duyet', 5730 => 'da_duyet', 5731 => 'da_duyet', 5732 => 'da_duyet', 5733 => 'da_duyet', 5746 => 'da_duyet', 5768 => 'da_duyet', 5781 => 'da_duyet', 5816 => 'da_duyet', 5817 => 'da_duyet', 5818 => 'da_duyet', 5819 => 'da_duyet', 5820 => 'da_duyet', 5821 => 'da_duyet', 5824 => 'da_duyet', 5827 => 'da_duyet', 5838 => 'da_duyet', 5839 => 'da_duyet', 5840 => 'da_duyet', 5841 => 'da_duyet', 5845 => 'da_duyet', 5846 => 'da_duyet', 5847 => 'da_duyet', 5848 => 'da_duyet', 5849 => 'da_duyet', 5850 => 'da_duyet', 5852 => 'da_duyet', 5856 => 'da_duyet', 5857 => 'da_duyet', 5858 => 'da_duyet', 5859 => 'da_duyet', 5860 => 'da_duyet', 5872 => 'da_duyet', 5873 => 'da_duyet', 5875 => 'da_duyet', 5876 => 'da_duyet', 5880 => 'da_duyet', 5886 => 'da_duyet', 5888 => 'da_duyet', 5889 => 'tu_choi', 5890 => 'da_duyet', 5891 => 'da_duyet', 5892 => 'da_duyet', 5893 => 'da_duyet', 5895 => 'da_duyet', 5896 => 'da_duyet', 5898 => 'da_duyet', 5899 => 'da_duyet', 5902 => 'da_duyet', 5903 => 'da_duyet', 5904 => 'da_duyet', 5905 => 'da_duyet', 5906 => 'da_duyet', 5907 => 'da_duyet', 5909 => 'da_duyet', 5910 => 'da_duyet', 5911 => 'da_duyet', 5912 => 'da_duyet', 5916 => 'da_duyet', 5917 => 'da_duyet', 5918 => 'da_duyet', 5922 => 'da_duyet', 5923 => 'da_duyet', 5924 => 'da_duyet', 5925 => 'da_duyet', 5926 => 'da_duyet', 5928 => 'tu_choi', 5934 => 'da_duyet', 5935 => 'da_duyet', 5936 => 'da_duyet', 5937 => 'da_duyet', 5938 => 'da_duyet', 5942 => 'da_duyet', 5943 => 'da_duyet', 5944 => 'da_duyet', 5945 => 'da_duyet', 5946 => 'da_duyet', 5949 => 'da_duyet', 5958 => 'da_duyet', 5959 => 'da_duyet', 5960 => 'da_duyet', 5962 => 'da_duyet', 5963 => 'da_duyet', 5964 => 'da_duyet', 5965 => 'da_duyet', 5967 => 'da_duyet', 5969 => 'da_duyet', 5973 => 'da_duyet', 5974 => 'da_duyet', 5975 => 'da_duyet', 5976 => 'da_duyet', 5977 => 'da_duyet', 5978 => 'da_duyet', 5979 => 'da_duyet', 5980 => 'da_duyet', 5985 => 'da_duyet', 5986 => 'da_duyet', 5987 => 'da_duyet', 5988 => 'da_duyet', 5990 => 'da_duyet', 5993 => 'da_duyet', 5994 => 'da_duyet', 5996 => 'da_duyet', 5997 => 'da_duyet', 5998 => 'da_duyet', 5999 => 'da_duyet', 6000 => 'da_duyet', 6001 => 'da_duyet', 6002 => 'da_duyet', 6006 => 'da_duyet', 6009 => 'da_duyet', 6010 => 'da_duyet', 6011 => 'da_duyet', 6012 => 'da_duyet', 6016 => 'da_duyet', 6017 => 'da_duyet', 6019 => 'da_duyet', 6020 => 'da_duyet', 6021 => 'da_duyet', 6022 => 'da_duyet', 6023 => 'da_duyet', 6027 => 'da_duyet', 6028 => 'da_duyet', 6030 => 'da_duyet', 6031 => 'da_duyet', 6034 => 'da_duyet', 6035 => 'da_duyet', 6036 => 'tu_choi', 6037 => 'da_duyet', 6038 => 'da_duyet', 6039 => 'da_duyet', 6040 => 'da_duyet', 6041 => 'da_duyet', 6042 => 'da_duyet', 6043 => 'da_duyet', 6045 => 'da_duyet', 6046 => 'da_duyet', 6047 => 'da_duyet', 6054 => 'da_duyet', 6055 => 'da_duyet', 6059 => 'da_duyet', 6065 => 'da_duyet', 6066 => 'da_duyet', 6069 => 'da_duyet', 6070 => 'da_duyet', 6072 => 'da_duyet', 6075 => 'da_duyet', 6076 => 'da_duyet', 6078 => 'da_duyet', 6079 => 'da_duyet', 6081 => 'da_duyet', 6085 => 'da_duyet', 6086 => 'da_duyet', 6087 => 'da_duyet', 6088 => 'da_duyet', 6089 => 'da_duyet', 6090 => 'da_duyet', 6091 => 'tu_choi', 6092 => 'tu_choi', 6093 => 'da_duyet', 6094 => 'da_duyet', 6095 => 'da_duyet', 6096 => 'da_duyet', 6097 => 'da_duyet', 6098 => 'da_duyet', 6099 => 'da_duyet', 6100 => 'da_duyet', 6101 => 'da_duyet', 6102 => 'da_duyet', 6103 => 'da_duyet', 6104 => 'da_duyet', 6105 => 'tu_choi', 6106 => 'da_duyet', 6107 => 'da_duyet', 6108 => 'da_duyet', 6109 => 'da_duyet', 6110 => 'da_duyet', 6111 => 'da_duyet', 6112 => 'da_duyet', 6113 => 'tu_choi', 6114 => 'da_duyet', 6115 => 'da_duyet', 6116 => 'da_duyet', 6117 => 'da_duyet', 6118 => 'da_duyet', 6119 => 'da_duyet', 6120 => 'da_duyet', 6123 => 'da_duyet', 6124 => 'da_duyet', 6125 => 'da_duyet', 6126 => 'da_duyet', 6127 => 'da_duyet', 6128 => 'da_duyet', 6136 => 'da_duyet', 6137 => 'da_duyet', 6138 => 'da_duyet', 6139 => 'da_duyet', 6140 => 'da_duyet', 6141 => 'da_duyet', 6142 => 'da_duyet', 6143 => 'da_duyet', 6147 => 'da_duyet', 6148 => 'da_duyet', 6154 => 'da_duyet', 6156 => 'da_duyet', 6162 => 'da_duyet', 6174 => 'da_duyet', 6194 => 'da_duyet', 6195 => 'da_duyet', 6213 => 'da_duyet', 6217 => 'da_duyet', 6218 => 'da_duyet', 6219 => 'da_duyet', 6220 => 'da_duyet', 6221 => 'da_duyet', 6222 => 'da_duyet', 6223 => 'da_duyet', 6224 => 'da_duyet', 6240 => 'da_duyet', 6241 => 'da_duyet', 6258 => 'da_duyet', 6261 => 'da_duyet', 6271 => 'da_duyet', 6273 => 'da_duyet', 6276 => 'da_duyet', 6284 => 'da_duyet', 6285 => 'da_duyet', 6286 => 'da_duyet', 6287 => 'da_duyet', 6288 => 'da_duyet', 6289 => 'da_duyet', 6290 => 'da_duyet', 6291 => 'da_duyet', 6292 => 'da_duyet', 6293 => 'da_duyet', 6294 => 'da_duyet', 6295 => 'da_duyet', 6296 => 'da_duyet', 6297 => 'da_duyet', 6299 => 'da_duyet', 6300 => 'da_duyet', 6301 => 'da_duyet', 6302 => 'da_duyet', 6304 => 'da_duyet', 6305 => 'da_duyet', 6306 => 'da_duyet', 6307 => 'da_duyet', 6318 => 'da_duyet', 6322 => 'da_duyet', 6323 => 'da_duyet', 6324 => 'da_duyet', 6325 => 'da_duyet', 6326 => 'da_duyet', 6327 => 'da_duyet', 6328 => 'da_duyet', 6331 => 'da_duyet', 6332 => 'da_duyet', 6333 => 'da_duyet', 6334 => 'da_duyet', 6335 => 'da_duyet', 6336 => 'da_duyet', 6337 => 'da_duyet', 6338 => 'da_duyet', 6339 => 'da_duyet', 6340 => 'da_duyet', 6341 => 'da_duyet', 6342 => 'da_duyet', 6343 => 'da_duyet', 6344 => 'da_duyet', 6345 => 'da_duyet', 6346 => 'da_duyet', 6347 => 'da_duyet', 6348 => 'da_duyet', 6349 => 'da_duyet', 6350 => 'da_duyet', 6353 => 'da_duyet', 6357 => 'da_duyet', 6358 => 'da_duyet', 6359 => 'da_duyet', 6362 => 'da_duyet', 6366 => 'da_duyet', 6371 => 'da_duyet', 6375 => 'da_duyet', 6376 => 'da_duyet', 6378 => 'da_duyet', 6379 => 'da_duyet', 6380 => 'da_duyet', 6383 => 'da_duyet', 6384 => 'da_duyet', 6385 => 'da_duyet', 6386 => 'da_duyet', 6387 => 'da_duyet', 6388 => 'da_duyet', 6389 => 'da_duyet', 6390 => 'da_duyet', 6391 => 'da_duyet', 6392 => 'da_duyet', 6393 => 'da_duyet', 6395 => 'da_duyet', 6397 => 'da_duyet', 6398 => 'da_duyet', 6399 => 'da_duyet', 6400 => 'da_duyet', 6401 => 'da_duyet', 6402 => 'da_duyet', 6403 => 'da_duyet', 6404 => 'da_duyet', 6405 => 'da_duyet', 6406 => 'da_duyet', 6407 => 'da_duyet', 6408 => 'da_duyet', 6409 => 'da_duyet', 6411 => 'tu_choi', 6426 => 'da_duyet', 6444 => 'da_duyet', 6449 => 'da_duyet', 6450 => 'da_duyet', 6451 => 'da_duyet', 6452 => 'da_duyet', 6454 => 'da_duyet', 6456 => 'da_duyet', 6457 => 'da_duyet', 6458 => 'da_duyet', 6459 => 'da_duyet', 6460 => 'da_duyet', 6461 => 'da_duyet', 6462 => 'da_duyet', 6463 => 'da_duyet', 6464 => 'da_duyet', 6465 => 'da_duyet', 6466 => 'da_duyet', 6467 => 'da_duyet', 6468 => 'da_duyet', 6469 => 'da_duyet', 6470 => 'da_duyet', 6471 => 'da_duyet', 6472 => 'da_duyet', 6473 => 'da_duyet', 6474 => 'da_duyet', 6475 => 'da_duyet', 6476 => 'da_duyet', 6477 => 'da_duyet', 6478 => 'da_duyet', 6479 => 'da_duyet', 6480 => 'tu_choi', 6481 => 'da_duyet', 6482 => 'da_duyet', 6483 => 'da_duyet', 6485 => 'da_duyet', 6487 => 'da_duyet', 6488 => 'da_duyet', 6490 => 'da_duyet', 6491 => 'da_duyet', 6492 => 'da_duyet', 6493 => 'da_duyet', 6494 => 'da_duyet', 6496 => 'da_duyet', 6497 => 'da_duyet', 6501 => 'da_duyet', 6503 => 'da_duyet', 6512 => 'da_duyet', 6513 => 'da_duyet', 6514 => 'da_duyet', 6515 => 'da_duyet', 6516 => 'da_duyet', 6517 => 'da_duyet', 6518 => 'da_duyet', 6519 => 'da_duyet', 6520 => 'da_duyet', 6521 => 'da_duyet', 6522 => 'da_duyet', 6523 => 'da_duyet', 6524 => 'da_duyet', 6525 => 'da_duyet', 6526 => 'da_duyet', 6527 => 'da_duyet', 6528 => 'da_duyet', 6529 => 'da_duyet', 6530 => 'da_duyet', 6535 => 'da_duyet', 6544 => 'da_duyet', 6545 => 'da_duyet', 6546 => 'da_duyet', 6547 => 'da_duyet', 6548 => 'da_duyet', 6549 => 'da_duyet', 6550 => 'da_duyet', 6552 => 'da_duyet', 6556 => 'da_duyet', 6557 => 'da_duyet', 6558 => 'tu_choi', 6559 => 'da_duyet', 6560 => 'da_duyet', 6561 => 'da_duyet', 6562 => 'da_duyet', 6563 => 'da_duyet', 6564 => 'da_duyet', 6565 => 'da_duyet', 6566 => 'da_duyet', 6567 => 'da_duyet', 6572 => 'da_duyet', 6573 => 'da_duyet', 6574 => 'da_duyet', 6575 => 'da_duyet', 6578 => 'da_duyet', 6579 => 'da_duyet', 6581 => 'da_duyet', 6584 => 'da_duyet', 6588 => 'da_duyet', 6591 => 'da_duyet', 6592 => 'da_duyet', 6593 => 'da_duyet', 6594 => 'da_duyet', 6595 => 'da_duyet', 6596 => 'da_duyet', 6597 => 'da_duyet', 6598 => 'da_duyet', 6599 => 'da_duyet', 6600 => 'da_duyet', 6601 => 'da_duyet', 6602 => 'da_duyet', 6605 => 'da_duyet', 6606 => 'da_duyet', 6607 => 'da_duyet', 6609 => 'da_duyet', 6610 => 'da_duyet', 6611 => 'da_duyet', 6612 => 'da_duyet', 6613 => 'da_duyet', 6614 => 'da_duyet', 6616 => 'da_duyet', 6617 => 'da_duyet', 6622 => 'da_duyet', 6623 => 'da_duyet', 6624 => 'da_duyet', 6625 => 'da_duyet', 6626 => 'da_duyet', 6627 => 'da_duyet', 6628 => 'da_duyet', 6631 => 'da_duyet', 6632 => 'da_duyet', 6634 => 'da_duyet', 6635 => 'da_duyet', 6637 => 'da_duyet', 6642 => 'da_duyet', 6643 => 'da_duyet', 6644 => 'da_duyet', 6645 => 'da_duyet', 6646 => 'da_duyet', 6648 => 'da_duyet', 6649 => 'da_duyet', 6650 => 'da_duyet', 6651 => 'da_duyet', 6652 => 'da_duyet', 6653 => 'da_duyet', 6654 => 'da_duyet', 6655 => 'da_duyet', 6656 => 'da_duyet', 6657 => 'da_duyet', 6658 => 'da_duyet', 6659 => 'da_duyet', 6660 => 'da_duyet', 6661 => 'da_duyet', 6663 => 'da_duyet', 6664 => 'da_duyet', 6665 => 'da_duyet', 6666 => 'da_duyet', 6667 => 'da_duyet', 6668 => 'da_duyet', 6669 => 'da_duyet', 6671 => 'da_duyet', 6672 => 'da_duyet', 6673 => 'da_duyet', 6674 => 'da_duyet', 6675 => 'da_duyet', 6676 => 'da_duyet', 6677 => 'da_duyet', 6678 => 'da_duyet', 6679 => 'da_duyet', 6680 => 'da_duyet', 6681 => 'da_duyet', 6682 => 'da_duyet', 6683 => 'da_duyet', 6684 => 'da_duyet', 6685 => 'da_duyet', 6686 => 'da_duyet', 6687 => 'da_duyet', 6688 => 'da_duyet', 6689 => 'da_duyet', 6690 => 'da_duyet', 6691 => 'da_duyet', 6692 => 'da_duyet', 6693 => 'da_duyet', 6694 => 'da_duyet', 6695 => 'da_duyet', 6696 => 'da_duyet', 6697 => 'da_duyet', 6698 => 'da_duyet', 6699 => 'da_duyet', 6700 => 'da_duyet', 6701 => 'da_duyet', 6702 => 'da_duyet', 6705 => 'da_duyet', 6706 => 'da_duyet', 6707 => 'da_duyet', 6708 => 'da_duyet', 6710 => 'da_duyet', 6711 => 'da_duyet', 6712 => 'da_duyet', 6713 => 'da_duyet', 6715 => 'da_duyet', 6716 => 'da_duyet', 6717 => 'da_duyet', 6725 => 'da_duyet', 6744 => 'da_duyet', 6804 => 'da_duyet', 6829 => 'da_duyet', 6830 => 'da_duyet', 6832 => 'da_duyet', 6835 => 'da_duyet', 6851 => 'da_duyet', 6852 => 'da_duyet', 6853 => 'da_duyet', 6855 => 'da_duyet', 6856 => 'da_duyet', 6857 => 'da_duyet', 6858 => 'da_duyet', 6859 => 'da_duyet', 6860 => 'da_duyet', 6861 => 'da_duyet', 6862 => 'da_duyet', 6863 => 'da_duyet', 6864 => 'da_duyet', 6866 => 'da_duyet', 6867 => 'da_duyet', 6900 => 'da_duyet', 6901 => 'da_duyet', 6902 => 'da_duyet', 6903 => 'da_duyet', 6915 => 'da_duyet', 6916 => 'da_duyet', 6917 => 'da_duyet', 6918 => 'da_duyet', 6920 => 'da_duyet', 6921 => 'da_duyet', 6922 => 'da_duyet', 6923 => 'da_duyet', 6924 => 'da_duyet', 6925 => 'da_duyet', 6928 => 'da_duyet', 6929 => 'da_duyet', 6930 => 'da_duyet', 6931 => 'da_duyet', 6932 => 'da_duyet', 6943 => 'da_duyet', 6954 => 'da_duyet', 6966 => 'da_duyet', 6967 => 'da_duyet', 6974 => 'da_duyet', 6975 => 'da_duyet', 6976 => 'da_duyet', 6978 => 'da_duyet', 6980 => 'da_duyet', 6982 => 'da_duyet', 6983 => 'da_duyet', 6984 => 'da_duyet', 6985 => 'da_duyet', 6986 => 'da_duyet', 6987 => 'da_duyet', 6989 => 'da_duyet', 6990 => 'da_duyet', 6991 => 'da_duyet', 6993 => 'da_duyet', 6994 => 'da_duyet', 6995 => 'da_duyet', 6996 => 'da_duyet', 6997 => 'da_duyet', 6998 => 'da_duyet', 6999 => 'da_duyet', 7000 => 'da_duyet', 7001 => 'da_duyet', 7003 => 'da_duyet', 7005 => 'da_duyet', 7006 => 'da_duyet', 7007 => 'da_duyet', 7008 => 'da_duyet', 7010 => 'da_duyet', 7011 => 'da_duyet', 7012 => 'da_duyet', 7013 => 'da_duyet', 7014 => 'da_duyet', 7017 => 'da_duyet', 7018 => 'da_duyet', 7019 => 'da_duyet', 7020 => 'da_duyet', 7021 => 'da_duyet', 7022 => 'da_duyet', 7023 => 'da_duyet', 7024 => 'da_duyet', 7025 => 'da_duyet', 7027 => 'da_duyet', 7028 => 'da_duyet', 7032 => 'da_duyet', 7033 => 'da_duyet', 7034 => 'da_duyet', 7035 => 'da_duyet', 7045 => 'da_duyet', 7052 => 'da_duyet', 7065 => 'da_duyet', 7070 => 'da_duyet', 7071 => 'da_duyet', 7073 => 'da_duyet', 7074 => 'da_duyet', 7075 => 'da_duyet', 7077 => 'da_duyet', 7078 => 'da_duyet', 7084 => 'da_duyet', 7090 => 'da_duyet', 7099 => 'da_duyet', 7101 => 'tu_choi', 7102 => 'da_duyet', 7103 => 'da_duyet', 7108 => 'da_duyet', 7109 => 'da_duyet', 7110 => 'da_duyet', 7111 => 'da_duyet', 7112 => 'da_duyet', 7115 => 'da_duyet', 7117 => 'da_duyet', 7122 => 'da_duyet', 7124 => 'da_duyet', 7126 => 'da_duyet', 7127 => 'da_duyet', 7128 => 'da_duyet', 7129 => 'da_duyet', 7131 => 'da_duyet', 7132 => 'da_duyet', 7133 => 'da_duyet', 7134 => 'da_duyet', 7135 => 'da_duyet', 7136 => 'da_duyet', 7137 => 'da_duyet', 7138 => 'da_duyet', 7139 => 'da_duyet', 7140 => 'da_duyet', 7141 => 'da_duyet', 7142 => 'da_duyet', 7143 => 'da_duyet', 7144 => 'da_duyet', 7146 => 'da_duyet', 7147 => 'da_duyet', 7148 => 'da_duyet', 7149 => 'da_duyet', 7150 => 'da_duyet', 7152 => 'da_duyet', 7154 => 'da_duyet', 7155 => 'da_duyet', 7156 => 'da_duyet', 7158 => 'da_duyet', 7159 => 'da_duyet', 7161 => 'da_duyet', 7162 => 'da_duyet', 7163 => 'da_duyet', 7164 => 'da_duyet', 7165 => 'da_duyet', 7166 => 'da_duyet', 7167 => 'da_duyet', 7168 => 'da_duyet', 7169 => 'da_duyet', 7170 => 'da_duyet', 7171 => 'da_duyet', 7172 => 'da_duyet', 7173 => 'da_duyet', 7174 => 'da_duyet', 7175 => 'da_duyet', 7176 => 'da_duyet', 7177 => 'da_duyet', 7178 => 'da_duyet', 7179 => 'da_duyet', 7181 => 'da_duyet', 7182 => 'da_duyet', 7183 => 'da_duyet', 7184 => 'da_duyet', 7185 => 'da_duyet', 7186 => 'da_duyet', 7187 => 'da_duyet', 7188 => 'da_duyet', 7189 => 'da_duyet', 7190 => 'da_duyet', 7191 => 'da_duyet', 7192 => 'da_duyet', 7194 => 'tu_choi', 7195 => 'da_duyet', 7196 => 'da_duyet', 7197 => 'da_duyet', 7198 => 'da_duyet', 7199 => 'da_duyet', 7200 => 'da_duyet', 7201 => 'da_duyet', 7202 => 'da_duyet', 7203 => 'da_duyet', 7204 => 'da_duyet', 7205 => 'da_duyet', 7206 => 'da_duyet', 7207 => 'da_duyet', 7208 => 'da_duyet', 7209 => 'tu_choi', 7212 => 'tu_choi', 7214 => 'tu_choi', 7215 => 'tu_choi', 7217 => 'da_duyet', 7218 => 'da_duyet', 7219 => 'da_duyet', 7220 => 'da_duyet', 7221 => 'da_duyet', 7222 => 'da_duyet', 7224 => 'da_duyet', 7225 => 'da_duyet', 7226 => 'da_duyet', 7227 => 'da_duyet', 7228 => 'da_duyet', 7229 => 'da_duyet', 7230 => 'da_duyet', 7231 => 'da_duyet', 7232 => 'da_duyet', 7233 => 'da_duyet', 7234 => 'da_duyet', 7235 => 'da_duyet', 7236 => 'da_duyet', 7237 => 'da_duyet', 7238 => 'da_duyet', 7239 => 'da_duyet', 7240 => 'da_duyet', 7241 => 'da_duyet', 7242 => 'da_duyet', 7243 => 'da_duyet', 7244 => 'da_duyet', 7245 => 'da_duyet', 7250 => 'da_duyet', 7252 => 'da_duyet', 7253 => 'da_duyet', 7259 => 'da_duyet', 7264 => 'da_duyet', 7265 => 'tu_choi', 7266 => 'tu_choi', 7267 => 'tu_choi', 7268 => 'tu_choi', 7271 => 'da_duyet', 7274 => 'da_duyet', 7276 => 'tu_choi', 7277 => 'tu_choi', 7280 => 'tu_choi', 7283 => 'tu_choi', 7284 => 'da_duyet', 7285 => 'da_duyet', 7286 => 'da_duyet', 7287 => 'da_duyet', 7288 => 'da_duyet', 7289 => 'da_duyet', 7290 => 'da_duyet', 7296 => 'da_duyet', 7297 => 'da_duyet', 7300 => 'da_duyet', 7301 => 'da_duyet', 7305 => 'da_duyet', 7317 => 'da_duyet', 7318 => 'da_duyet', 7319 => 'da_duyet', 7320 => 'da_duyet', 7321 => 'da_duyet', 7323 => 'da_duyet', 7324 => 'da_duyet', 7325 => 'da_duyet', 7326 => 'da_duyet', 7327 => 'da_duyet', 7328 => 'da_duyet', 7329 => 'da_duyet', 7330 => 'da_duyet', 7331 => 'da_duyet', 7332 => 'da_duyet', 7341 => 'da_duyet', 7345 => 'da_duyet', 7347 => 'da_duyet', 7348 => 'da_duyet', 7351 => 'da_duyet', 7354 => 'da_duyet', 7357 => 'tu_choi', 7358 => 'da_duyet', 7359 => 'da_duyet', 7360 => 'da_duyet', 7361 => 'da_duyet', 7362 => 'da_duyet', 7368 => 'da_duyet', 7371 => 'da_duyet', 7377 => 'da_duyet', 7378 => 'da_duyet', 7380 => 'da_duyet', 7381 => 'da_duyet', 7386 => 'da_duyet', 7400 => 'da_duyet', 7401 => 'da_duyet', 7402 => 'da_duyet', 7419 => 'da_duyet', 7421 => 'da_duyet', 7422 => 'da_duyet', 7425 => 'da_duyet', 7428 => 'da_duyet', 7430 => 'da_duyet', 7431 => 'da_duyet', 7434 => 'da_duyet', 7435 => 'da_duyet', 7437 => 'da_duyet', 7438 => 'da_duyet', 7441 => 'da_duyet', 7449 => 'da_duyet', 7451 => 'da_duyet', 7454 => 'da_duyet', 7457 => 'da_duyet', 7458 => 'da_duyet', 7459 => 'da_duyet', 7460 => 'da_duyet', 7461 => 'da_duyet', 7466 => 'da_duyet', 7468 => 'da_duyet', 7469 => 'da_duyet', 7471 => 'da_duyet', 7472 => 'da_duyet', 7473 => 'da_duyet', 7474 => 'da_duyet', 7476 => 'da_duyet', 7477 => 'da_duyet', 7478 => 'da_duyet', 7480 => 'da_duyet', 7481 => 'da_duyet', 7482 => 'da_duyet', 7483 => 'da_duyet', 7484 => 'da_duyet', 7485 => 'da_duyet', 7486 => 'da_duyet', 7487 => 'da_duyet', 7488 => 'da_duyet', 7489 => 'da_duyet', 7491 => 'da_duyet', 7496 => 'da_duyet', 7497 => 'da_duyet', 7500 => 'da_duyet', 7510 => 'da_duyet', 7511 => 'da_duyet', 7512 => 'da_duyet', 7521 => 'da_duyet', 7522 => 'da_duyet', 7526 => 'da_duyet', 7527 => 'da_duyet', 7528 => 'da_duyet', 7529 => 'da_duyet', 7530 => 'da_duyet', 7531 => 'da_duyet', 7532 => 'da_duyet', 7533 => 'da_duyet', 7540 => 'da_duyet', 7566 => 'da_duyet', 7567 => 'da_duyet', 7568 => 'da_duyet', 7569 => 'da_duyet', 7571 => 'da_duyet', 7572 => 'da_duyet', 7573 => 'da_duyet', 7574 => 'da_duyet', 7575 => 'da_duyet', 7577 => 'da_duyet', 7578 => 'da_duyet', 7579 => 'da_duyet', 7580 => 'da_duyet', 7581 => 'da_duyet', 7585 => 'da_duyet', 7586 => 'da_duyet', 7587 => 'da_duyet', 7588 => 'da_duyet', 7589 => 'da_duyet', 7590 => 'da_duyet', 7591 => 'da_duyet', 7592 => 'da_duyet', 7597 => 'da_duyet', 7600 => 'da_duyet', 7601 => 'da_duyet', 7634 => 'da_duyet', 7636 => 'da_duyet', 7637 => 'da_duyet', 7639 => 'da_duyet', 7641 => 'da_duyet', 7643 => 'da_duyet', 7647 => 'da_duyet', 7649 => 'da_duyet', 7651 => 'da_duyet', 7653 => 'da_duyet', 7655 => 'da_duyet', 7659 => 'da_duyet', 7672 => 'da_duyet', 7702 => 'da_duyet', 7704 => 'da_duyet', 7705 => 'da_duyet', 7706 => 'da_duyet', 7707 => 'da_duyet', 7708 => 'da_duyet', 7714 => 'da_duyet', 7715 => 'da_duyet', 7716 => 'da_duyet', 7722 => 'da_duyet', 7727 => 'da_duyet', 7728 => 'da_duyet', 7731 => 'da_duyet', 7739 => 'da_duyet', 7740 => 'tu_choi', 7741 => 'da_duyet', 7742 => 'da_duyet', 7748 => 'da_duyet', 7768 => 'da_duyet', 7769 => 'da_duyet', 7770 => 'da_duyet', 7771 => 'da_duyet', 7772 => 'tu_choi', 7773 => 'tu_choi', 7774 => 'tu_choi', 7775 => 'da_duyet', 7776 => 'da_duyet', 7777 => 'da_duyet', 7778 => 'da_duyet', 7779 => 'da_duyet', 7780 => 'da_duyet', 7782 => 'tu_choi', 7783 => 'tu_choi', 7784 => 'da_duyet', 7785 => 'da_duyet', 7786 => 'da_duyet', 7787 => 'da_duyet', 7788 => 'da_duyet', 7789 => 'da_duyet', 7790 => 'da_duyet', 7796 => 'tu_choi', 7801 => 'tu_choi', 7804 => 'tu_choi', 7818 => 'tu_choi', 7819 => 'tu_choi', 7847 => 'da_duyet', 7848 => 'da_duyet', 7849 => 'da_duyet', 7850 => 'da_duyet', 7851 => 'da_duyet', 7854 => 'da_duyet', 7855 => 'da_duyet', 7857 => 'da_duyet', 7859 => 'da_duyet', 7861 => 'da_duyet', 7865 => 'da_duyet', 7867 => 'da_duyet', 7870 => 'da_duyet', 7872 => 'da_duyet', 7873 => 'da_duyet', 7874 => 'da_duyet', 7876 => 'da_duyet', 7877 => 'da_duyet', 7878 => 'da_duyet', 7880 => 'da_duyet', 7881 => 'da_duyet', 7882 => 'da_duyet', 7883 => 'da_duyet', 7884 => 'da_duyet', 7885 => 'da_duyet', 7886 => 'da_duyet', 7891 => 'da_duyet', 7892 => 'da_duyet', 7893 => 'da_duyet', 7895 => 'da_duyet', 7896 => 'da_duyet', 7898 => 'da_duyet', 7902 => 'da_duyet', 7905 => 'da_duyet', 7906 => 'da_duyet', 7907 => 'da_duyet', 7909 => 'da_duyet', 7911 => 'da_duyet', 7912 => 'da_duyet', 7914 => 'da_duyet', 7915 => 'da_duyet', 7916 => 'da_duyet', 7918 => 'da_duyet', 7919 => 'da_duyet', 7921 => 'da_duyet', 7922 => 'da_duyet', 7924 => 'tu_choi', 7925 => 'tu_choi', 7929 => 'tu_choi', 7930 => 'tu_choi', 7932 => 'tu_choi', 7933 => 'tu_choi', 7934 => 'tu_choi', 7935 => 'tu_choi', 7936 => 'tu_choi', 7938 => 'tu_choi', 7941 => 'tu_choi', 7943 => 'tu_choi', 7945 => 'tu_choi', 7947 => 'tu_choi', 7948 => 'tu_choi', 7949 => 'tu_choi', 7950 => 'tu_choi', 7951 => 'tu_choi', 7952 => 'tu_choi', 7954 => 'da_duyet', 7961 => 'da_duyet', 7965 => 'tu_choi', 7966 => 'tu_choi', 7967 => 'tu_choi', 7968 => 'tu_choi', 7969 => 'tu_choi', 7970 => 'tu_choi', 7971 => 'tu_choi', 7972 => 'tu_choi', 7978 => 'tu_choi', 7979 => 'tu_choi', 7980 => 'tu_choi', 7981 => 'tu_choi', 7984 => 'tu_choi', 7987 => 'tu_choi', 7988 => 'tu_choi', 7989 => 'tu_choi', 7990 => 'tu_choi', 7991 => 'tu_choi', 7992 => 'tu_choi', 7993 => 'tu_choi', 7994 => 'tu_choi', 7996 => 'tu_choi', 7997 => 'tu_choi', 8000 => 'tu_choi', 8001 => 'tu_choi', 8002 => 'tu_choi', 8003 => 'tu_choi', 8004 => 'tu_choi', 8007 => 'tu_choi', 8008 => 'tu_choi', 8009 => 'tu_choi', 8010 => 'tu_choi', 8011 => 'tu_choi', 8012 => 'tu_choi', 8014 => 'tu_choi', 8015 => 'tu_choi', 8016 => 'tu_choi', 8017 => 'tu_choi', 8019 => 'tu_choi', 8020 => 'tu_choi', 8022 => 'tu_choi', 8027 => 'tu_choi', 8028 => 'tu_choi', 8029 => 'tu_choi', 8032 => 'tu_choi', 8033 => 'tu_choi', 8034 => 'tu_choi', 8035 => 'tu_choi', 8036 => 'tu_choi', 8037 => 'tu_choi', 8038 => 'tu_choi', 8039 => 'tu_choi', 8040 => 'tu_choi', 8041 => 'tu_choi', 8042 => 'tu_choi', 8043 => 'tu_choi', 8044 => 'tu_choi', 8045 => 'tu_choi', 8046 => 'tu_choi', 8047 => 'tu_choi', 8048 => 'tu_choi', 8049 => 'tu_choi', 8050 => 'tu_choi', 8054 => 'tu_choi', 8055 => 'tu_choi', 8056 => 'tu_choi', 8057 => 'tu_choi', 8058 => 'tu_choi', 8061 => 'da_duyet', 8062 => 'da_duyet', 8064 => 'da_duyet', 8065 => 'da_duyet', 8066 => 'da_duyet', 8067 => 'da_duyet', 8070 => 'da_duyet', 8072 => 'da_duyet', 8074 => 'da_duyet', 8075 => 'da_duyet', 8076 => 'da_duyet', 8077 => 'da_duyet', 8078 => 'da_duyet', 8081 => 'da_duyet', 8082 => 'da_duyet', 8085 => 'da_duyet', 8086 => 'da_duyet', 8087 => 'da_duyet', 8088 => 'da_duyet', 8089 => 'tu_choi', 8092 => 'da_duyet', 8093 => 'da_duyet', 8094 => 'tu_choi', 8095 => 'tu_choi', 8096 => 'da_duyet', 8097 => 'da_duyet', 8102 => 'da_duyet', 8104 => 'da_duyet', 8105 => 'da_duyet', 8107 => 'da_duyet', 8109 => 'da_duyet', 8112 => 'da_duyet', 8113 => 'da_duyet', 8114 => 'da_duyet', 8116 => 'da_duyet', 8119 => 'da_duyet', 8123 => 'da_duyet', 8125 => 'da_duyet', 8130 => 'da_duyet', 8132 => 'da_duyet', 8135 => 'da_duyet', 8138 => 'da_duyet', 8140 => 'da_duyet', 8142 => 'da_duyet', 8143 => 'da_duyet', 8145 => 'da_duyet', 8146 => 'da_duyet', 8147 => 'da_duyet', 8148 => 'da_duyet', 8150 => 'da_duyet', 8152 => 'da_duyet', 8154 => 'da_duyet', 8156 => 'da_duyet', 8159 => 'da_duyet', 8160 => 'da_duyet', 8164 => 'da_duyet', 8165 => 'da_duyet', 8166 => 'da_duyet', 8167 => 'da_duyet', 8170 => 'da_duyet', 8172 => 'da_duyet', 8173 => 'da_duyet', 8175 => 'da_duyet', 8176 => 'da_duyet', 8178 => 'da_duyet', 8179 => 'da_duyet', 8181 => 'da_duyet', 8182 => 'da_duyet', 8185 => 'da_duyet', 8186 => 'da_duyet', 8187 => 'da_duyet', 8188 => 'da_duyet', 8189 => 'da_duyet', 8190 => 'da_duyet', 8192 => 'da_duyet', 8193 => 'da_duyet', 8195 => 'da_duyet', 8196 => 'da_duyet', 8197 => 'da_duyet', 8200 => 'da_duyet', 8203 => 'da_duyet', 8208 => 'da_duyet', 8209 => 'da_duyet', 8210 => 'da_duyet', 8214 => 'da_duyet', 8215 => 'da_duyet', 8217 => 'da_duyet', 8218 => 'da_duyet', 8219 => 'da_duyet', 8220 => 'da_duyet', 8221 => 'da_duyet', 8227 => 'da_duyet', 8230 => 'da_duyet', 8232 => 'da_duyet', 8234 => 'da_duyet', 8236 => 'da_duyet', 8238 => 'da_duyet', 8239 => 'da_duyet', 8240 => 'da_duyet', 8243 => 'da_duyet', 8245 => 'da_duyet', 8246 => 'da_duyet', 8247 => 'da_duyet', 8249 => 'da_duyet', 8251 => 'da_duyet', 8254 => 'da_duyet', 8255 => 'da_duyet', 8256 => 'da_duyet', 8258 => 'da_duyet', 8259 => 'da_duyet', 8262 => 'da_duyet', 8263 => 'da_duyet', 8265 => 'da_duyet', 8266 => 'da_duyet', 8267 => 'da_duyet', 8270 => 'da_duyet', 8274 => 'da_duyet', 8280 => 'da_duyet', 8281 => 'da_duyet', 8283 => 'da_duyet', 8284 => 'da_duyet', 8286 => 'da_duyet', 8287 => 'da_duyet', 8288 => 'da_duyet', 8289 => 'da_duyet', 8290 => 'da_duyet', 8293 => 'da_duyet', 8294 => 'da_duyet', 8296 => 'da_duyet', 8297 => 'da_duyet', 8300 => 'da_duyet', 8302 => 'da_duyet', 8304 => 'da_duyet', 8308 => 'tu_choi', 8309 => 'tu_choi', 8310 => 'tu_choi', 8311 => 'tu_choi', 8312 => 'tu_choi', 8313 => 'tu_choi', 8314 => 'tu_choi', 8315 => 'tu_choi', 8316 => 'tu_choi', 8317 => 'tu_choi', 8318 => 'da_duyet', 8320 => 'da_duyet', 8321 => 'da_duyet', 8323 => 'da_duyet', 8325 => 'da_duyet', 8326 => 'da_duyet', 8328 => 'da_duyet', 8329 => 'da_duyet', 8331 => 'da_duyet', 8333 => 'da_duyet', 8335 => 'da_duyet', 8337 => 'da_duyet', 8338 => 'da_duyet', 8339 => 'da_duyet', 8340 => 'da_duyet', 8341 => 'da_duyet', 8342 => 'da_duyet', 8343 => 'da_duyet', 8345 => 'da_duyet', 8346 => 'da_duyet', 8348 => 'tu_choi', 8349 => 'tu_choi', 8350 => 'tu_choi', 8351 => 'tu_choi', 8352 => 'tu_choi', 8353 => 'tu_choi', 8354 => 'tu_choi', 8355 => 'tu_choi', 8356 => 'tu_choi', 8357 => 'tu_choi', 8358 => 'tu_choi', 8359 => 'tu_choi', 8360 => 'tu_choi', 8361 => 'tu_choi', 8362 => 'tu_choi', 8363 => 'tu_choi', 8364 => 'da_duyet', 8365 => 'da_duyet', 8366 => 'da_duyet', 8368 => 'da_duyet', 8370 => 'tu_choi', 8371 => 'tu_choi', 8372 => 'tu_choi', 8374 => 'tu_choi', 8375 => 'tu_choi', 8376 => 'tu_choi', 8377 => 'tu_choi', 8378 => 'da_duyet', 8379 => 'da_duyet', 8380 => 'da_duyet', 8381 => 'tu_choi', 8382 => 'tu_choi', 8384 => 'tu_choi', 8385 => 'tu_choi', 8386 => 'tu_choi', 8387 => 'tu_choi', 8388 => 'tu_choi', 8390 => 'da_duyet', 8391 => 'da_duyet', 8392 => 'da_duyet', 8393 => 'da_duyet', 8394 => 'da_duyet', 8396 => 'da_duyet', 8397 => 'da_duyet', 8400 => 'da_duyet', 8401 => 'da_duyet', 8404 => 'da_duyet', 8405 => 'da_duyet', 8407 => 'da_duyet', 8409 => 'da_duyet', 8410 => 'da_duyet', 8411 => 'da_duyet', 8415 => 'da_duyet', 8416 => 'da_duyet', 8417 => 'da_duyet', 8419 => 'da_duyet', 8420 => 'da_duyet', 8421 => 'da_duyet', 8425 => 'da_duyet', 8426 => 'da_duyet', 8427 => 'da_duyet', 8430 => 'da_duyet', 8431 => 'da_duyet', 8434 => 'da_duyet', 8435 => 'da_duyet', 8438 => 'da_duyet', 8439 => 'da_duyet', 8440 => 'da_duyet', 8443 => 'da_duyet', 8447 => 'da_duyet', 8448 => 'da_duyet', 8450 => 'da_duyet', 8451 => 'da_duyet', 8454 => 'da_duyet', 8455 => 'da_duyet', 8457 => 'da_duyet', 8459 => 'da_duyet', 8460 => 'da_duyet', 8461 => 'da_duyet', 8462 => 'da_duyet', 8464 => 'da_duyet', 8465 => 'da_duyet', 8466 => 'da_duyet', 8467 => 'da_duyet', 8469 => 'da_duyet', 8471 => 'da_duyet', 8473 => 'da_duyet', 8474 => 'da_duyet', 8475 => 'da_duyet', 8476 => 'da_duyet', 8477 => 'da_duyet', 8478 => 'da_duyet', 8479 => 'da_duyet', 8480 => 'da_duyet', 8483 => 'da_duyet', 8484 => 'da_duyet', 8485 => 'da_duyet', 8487 => 'da_duyet', 8488 => 'da_duyet', 8489 => 'da_duyet', 8490 => 'da_duyet', 8492 => 'da_duyet', 8493 => 'da_duyet', 8495 => 'da_duyet', 8497 => 'da_duyet', 8500 => 'da_duyet', 8501 => 'da_duyet', 8503 => 'da_duyet', 8504 => 'da_duyet', 8505 => 'da_duyet', 8506 => 'da_duyet', 8507 => 'da_duyet', 8509 => 'da_duyet', 8510 => 'da_duyet', 8511 => 'da_duyet', 8514 => 'da_duyet', 8516 => 'da_duyet', 8518 => 'da_duyet', 8519 => 'da_duyet', 8522 => 'da_duyet', 8523 => 'da_duyet', 8527 => 'da_duyet', 8528 => 'da_duyet', 8530 => 'da_duyet', 8531 => 'da_duyet', 8532 => 'da_duyet', 8533 => 'da_duyet', 8537 => 'da_duyet', 8540 => 'da_duyet', 8543 => 'da_duyet', 8544 => 'da_duyet', 8545 => 'da_duyet', 8549 => 'da_duyet', 8550 => 'da_duyet', 8552 => 'da_duyet', 8553 => 'da_duyet', 8557 => 'da_duyet', 8559 => 'da_duyet', 8561 => 'da_duyet', 8563 => 'da_duyet', 8564 => 'da_duyet', 8565 => 'da_duyet', 8568 => 'da_duyet', 8569 => 'da_duyet', 8571 => 'da_duyet', 8573 => 'da_duyet', 8574 => 'da_duyet', 8575 => 'da_duyet', 8576 => 'da_duyet', 8577 => 'da_duyet', 8578 => 'da_duyet', 8579 => 'da_duyet', 8580 => 'da_duyet', 8584 => 'da_duyet', 8586 => 'da_duyet', 8587 => 'da_duyet', 8588 => 'da_duyet', 8589 => 'da_duyet', 8590 => 'da_duyet', 8592 => 'da_duyet', 8594 => 'da_duyet', 8595 => 'da_duyet', 8596 => 'da_duyet', 8598 => 'da_duyet', 8604 => 'da_duyet', 8605 => 'da_duyet', 8606 => 'da_duyet', 8610 => 'da_duyet', 8612 => 'da_duyet', 8615 => 'da_duyet', 8616 => 'da_duyet', 8617 => 'da_duyet', 8618 => 'da_duyet', 8622 => 'da_duyet', 8623 => 'da_duyet', 8624 => 'da_duyet', 8625 => 'da_duyet', 8626 => 'da_duyet', 8627 => 'da_duyet', 8628 => 'da_duyet', 8629 => 'da_duyet', 8630 => 'da_duyet', 8635 => 'da_duyet', 8636 => 'da_duyet', 8642 => 'da_duyet', 8643 => 'da_duyet', 8644 => 'da_duyet', 8645 => 'da_duyet', 8646 => 'da_duyet', 8647 => 'da_duyet', 8650 => 'da_duyet', 8651 => 'da_duyet', 8654 => 'da_duyet', 8655 => 'da_duyet', 8656 => 'da_duyet', 8657 => 'da_duyet', 8658 => 'da_duyet', 8659 => 'da_duyet', 8660 => 'da_duyet', 8662 => 'da_duyet', 8663 => 'da_duyet', 8667 => 'da_duyet', 8668 => 'da_duyet', 8669 => 'da_duyet', 8670 => 'da_duyet', 8672 => 'da_duyet', 8674 => 'da_duyet', 8675 => 'da_duyet', 8676 => 'da_duyet', 8677 => 'da_duyet', 8687 => 'da_duyet', 8690 => 'da_duyet', 8691 => 'da_duyet', 8707 => 'da_duyet', 8725 => 'da_duyet', 8726 => 'da_duyet', 8727 => 'da_duyet', 8729 => 'da_duyet', 8730 => 'da_duyet', 8731 => 'da_duyet', 8732 => 'da_duyet', 8733 => 'da_duyet', 8736 => 'da_duyet', 8740 => 'da_duyet', 8746 => 'da_duyet', 8747 => 'da_duyet', 8748 => 'da_duyet', 8755 => 'da_duyet', 8756 => 'da_duyet', 8757 => 'da_duyet', 8761 => 'da_duyet', 8762 => 'da_duyet', 8763 => 'da_duyet', 8764 => 'da_duyet', 8765 => 'da_duyet', 8767 => 'da_duyet', 8768 => 'da_duyet', 8769 => 'da_duyet', 8772 => 'da_duyet', 8775 => 'da_duyet', 8776 => 'da_duyet', 8777 => 'da_duyet', 8778 => 'da_duyet', 8779 => 'da_duyet', 8780 => 'da_duyet', 8781 => 'da_duyet', 8783 => 'da_duyet', 8784 => 'da_duyet', 8785 => 'da_duyet', 8786 => 'da_duyet', 8787 => 'da_duyet', 8788 => 'da_duyet', 8790 => 'da_duyet', 8791 => 'da_duyet', 8793 => 'da_duyet', 8794 => 'da_duyet', 8795 => 'da_duyet', 8796 => 'da_duyet', 8802 => 'da_duyet', 8808 => 'da_duyet', 8809 => 'da_duyet', 8810 => 'da_duyet', 8811 => 'da_duyet', 8812 => 'da_duyet', 8813 => 'da_duyet', 8814 => 'da_duyet', 8815 => 'da_duyet', 8816 => 'da_duyet', 8817 => 'da_duyet', 8825 => 'da_duyet', 8839 => 'da_duyet', 8840 => 'da_duyet', 8848 => 'da_duyet', 8850 => 'da_duyet', 8853 => 'da_duyet', 8857 => 'da_duyet', 8869 => 'da_duyet', 8870 => 'da_duyet', 8871 => 'da_duyet', 8873 => 'da_duyet', 8875 => 'da_duyet', 8876 => 'da_duyet', 8878 => 'da_duyet', 8879 => 'da_duyet', 8880 => 'da_duyet', 8881 => 'da_duyet', 8888 => 'da_duyet', 8889 => 'da_duyet', 8891 => 'da_duyet', 8894 => 'da_duyet', 8895 => 'da_duyet', 8899 => 'da_duyet', 8902 => 'da_duyet', 8904 => 'da_duyet', 8906 => 'da_duyet', 8910 => 'da_duyet', 8911 => 'da_duyet', 8912 => 'da_duyet', 8913 => 'da_duyet', 8914 => 'da_duyet', 8917 => 'da_duyet', 8919 => 'da_duyet', 8920 => 'da_duyet', 8921 => 'da_duyet', 8923 => 'da_duyet', 8924 => 'da_duyet', 8925 => 'da_duyet', 8929 => 'da_duyet', 8930 => 'da_duyet', 8931 => 'da_duyet', 8934 => 'da_duyet', 8935 => 'da_duyet', 8937 => 'da_duyet', 8941 => 'da_duyet', 8942 => 'da_duyet', 8947 => 'da_duyet', 8948 => 'da_duyet', 8949 => 'da_duyet', 8950 => 'da_duyet', 8951 => 'da_duyet', 8952 => 'da_duyet', 8954 => 'da_duyet', 8958 => 'da_duyet', 8961 => 'da_duyet', 8963 => 'da_duyet', 8966 => 'da_duyet', 8967 => 'da_duyet', 8968 => 'da_duyet', 8970 => 'da_duyet', 8971 => 'da_duyet', 8972 => 'da_duyet', 8973 => 'da_duyet', 8974 => 'da_duyet', 8977 => 'da_duyet', 8979 => 'da_duyet', 8982 => 'da_duyet', 8983 => 'da_duyet', 8985 => 'da_duyet', 8988 => 'da_duyet', 8989 => 'da_duyet', 8990 => 'da_duyet', 8991 => 'da_duyet', 8992 => 'da_duyet', 8994 => 'da_duyet', 8996 => 'da_duyet', 8997 => 'da_duyet', 8998 => 'da_duyet', 9001 => 'da_duyet', 9002 => 'da_duyet', 9005 => 'da_duyet', 9009 => 'da_duyet', 9010 => 'da_duyet', 9012 => 'da_duyet', 9013 => 'da_duyet', 9015 => 'da_duyet', 9019 => 'da_duyet', 9021 => 'da_duyet', 9022 => 'da_duyet', 9024 => 'da_duyet', 9025 => 'da_duyet', 9027 => 'da_duyet', 9028 => 'da_duyet', 9030 => 'da_duyet', 9031 => 'da_duyet', 9035 => 'da_duyet', 9037 => 'da_duyet', 9038 => 'da_duyet', 9039 => 'da_duyet', 9040 => 'da_duyet', 9041 => 'da_duyet', 9043 => 'da_duyet', 9045 => 'da_duyet', 9046 => 'da_duyet', 9050 => 'da_duyet', 9051 => 'da_duyet', 9053 => 'da_duyet', 9054 => 'da_duyet', 9055 => 'da_duyet', 9056 => 'da_duyet', 9059 => 'da_duyet', 9060 => 'da_duyet', 9061 => 'da_duyet', 9064 => 'da_duyet', 9065 => 'da_duyet', 9067 => 'da_duyet', 9070 => 'da_duyet', 9071 => 'da_duyet', 9074 => 'da_duyet', 9077 => 'da_duyet', 9078 => 'da_duyet', 9082 => 'da_duyet', 9083 => 'da_duyet', 9084 => 'da_duyet', 9085 => 'da_duyet', 9086 => 'da_duyet', 9087 => 'da_duyet', 9088 => 'da_duyet', 9089 => 'da_duyet', 9091 => 'da_duyet', 9092 => 'da_duyet', 9093 => 'da_duyet', 9094 => 'da_duyet', 9095 => 'da_duyet', 9096 => 'da_duyet', 9097 => 'da_duyet', 9098 => 'da_duyet', 9099 => 'da_duyet', 9100 => 'da_duyet', 9101 => 'da_duyet', 9102 => 'da_duyet', 9103 => 'da_duyet', 9104 => 'da_duyet', 9105 => 'da_duyet', 9106 => 'da_duyet', 9107 => 'da_duyet', 9108 => 'da_duyet', 9110 => 'da_duyet', 9111 => 'da_duyet', 9135 => 'da_duyet', 9137 => 'da_duyet', 9139 => 'da_duyet', 9140 => 'da_duyet', 9141 => 'da_duyet', 9144 => 'da_duyet', 9145 => 'da_duyet', 9147 => 'da_duyet', 9149 => 'da_duyet', 9150 => 'da_duyet', 9154 => 'da_duyet', 9156 => 'da_duyet', 9158 => 'da_duyet', 9165 => 'da_duyet', 9167 => 'da_duyet', 9169 => 'da_duyet', 9173 => 'da_duyet', 9174 => 'da_duyet', 9175 => 'da_duyet', 9179 => 'da_duyet', 9180 => 'da_duyet', 9182 => 'da_duyet', 9183 => 'da_duyet', 9184 => 'da_duyet', 9186 => 'da_duyet', 9208 => 'da_duyet', 9213 => 'da_duyet', 9214 => 'da_duyet', 9215 => 'da_duyet', 9216 => 'da_duyet', 9217 => 'da_duyet', 9218 => 'da_duyet', 9219 => 'da_duyet', 9221 => 'da_duyet', 9223 => 'da_duyet', 9224 => 'da_duyet', 9226 => 'da_duyet', 9228 => 'da_duyet', 9229 => 'da_duyet', 9230 => 'da_duyet', 9231 => 'da_duyet', 9240 => 'da_duyet', 9242 => 'da_duyet', 9244 => 'da_duyet', 9246 => 'da_duyet', 9248 => 'da_duyet', 9249 => 'da_duyet', 9250 => 'da_duyet', 9251 => 'da_duyet', 9252 => 'da_duyet', 9253 => 'da_duyet', 9255 => 'da_duyet', 9256 => 'da_duyet', 9257 => 'da_duyet', 9259 => 'da_duyet', 9262 => 'da_duyet', 9263 => 'da_duyet', 9264 => 'da_duyet', 9265 => 'da_duyet', 9267 => 'da_duyet', 9268 => 'da_duyet', 9269 => 'da_duyet', 9270 => 'da_duyet', 9271 => 'da_duyet', 9272 => 'da_duyet', 9274 => 'da_duyet', 9276 => 'da_duyet', 9277 => 'da_duyet', 9278 => 'da_duyet', 9279 => 'da_duyet', 9280 => 'da_duyet', 9282 => 'da_duyet', 9283 => 'da_duyet', 9287 => 'da_duyet', 9288 => 'da_duyet', 9291 => 'da_duyet', 9292 => 'da_duyet', 9293 => 'da_duyet', 9294 => 'da_duyet', 9295 => 'da_duyet', 9297 => 'da_duyet', 9301 => 'da_duyet', 9304 => 'da_duyet', 9307 => 'da_duyet', 9309 => 'da_duyet', 9310 => 'da_duyet', 9311 => 'da_duyet', 9313 => 'da_duyet', 9314 => 'da_duyet', 9315 => 'da_duyet', 9316 => 'da_duyet', 9317 => 'da_duyet', 9318 => 'da_duyet', 9319 => 'da_duyet', 9324 => 'da_duyet', 9326 => 'da_duyet', 9327 => 'da_duyet', 9329 => 'da_duyet', 9330 => 'da_duyet', 9332 => 'da_duyet', 9336 => 'da_duyet', 9337 => 'da_duyet', 9338 => 'da_duyet', 9339 => 'da_duyet', 9371 => 'da_duyet', 9372 => 'da_duyet', 9373 => 'da_duyet', 9385 => 'da_duyet', 9397 => 'da_duyet', 9405 => 'da_duyet', 9408 => 'da_duyet', 9422 => 'da_duyet', 9432 => 'da_duyet', 9433 => 'da_duyet', 9434 => 'da_duyet', 9435 => 'da_duyet', 9436 => 'da_duyet', 9437 => 'da_duyet', 9438 => 'da_duyet', 9439 => 'da_duyet', 9450 => 'da_duyet', 9451 => 'da_duyet', 9452 => 'da_duyet', 9453 => 'da_duyet', 9457 => 'da_duyet', 9458 => 'da_duyet', 9459 => 'tu_choi', 9460 => 'da_duyet', 9461 => 'da_duyet', 9462 => 'da_duyet', 9463 => 'da_duyet', 9464 => 'da_duyet', 9465 => 'da_duyet', 9466 => 'da_duyet', 9467 => 'da_duyet', 9470 => 'da_duyet', 9481 => 'da_duyet', 9482 => 'da_duyet', 9483 => 'da_duyet', 9484 => 'da_duyet', 9485 => 'da_duyet', 9486 => 'da_duyet', 9487 => 'da_duyet', 9489 => 'da_duyet', 9499 => 'da_duyet', 9500 => 'da_duyet', 9501 => 'da_duyet', 9502 => 'da_duyet', 9503 => 'da_duyet', 9504 => 'da_duyet', 9505 => 'da_duyet', 9506 => 'da_duyet', 9507 => 'da_duyet', 9518 => 'da_duyet', 9519 => 'da_duyet', 9528 => 'da_duyet', 9529 => 'da_duyet', 9560 => 'da_duyet', 9572 => 'da_duyet', 9573 => 'da_duyet', 9574 => 'da_duyet', 9575 => 'da_duyet', 9576 => 'da_duyet', 9579 => 'da_duyet', 9583 => 'da_duyet', 9584 => 'da_duyet', 9593 => 'da_duyet', 9596 => 'da_duyet', 9598 => 'da_duyet', 9600 => 'da_duyet', 9615 => 'da_duyet', 9629 => 'da_duyet', 9630 => 'da_duyet', 9631 => 'da_duyet', 9632 => 'da_duyet', 9633 => 'da_duyet', 9639 => 'da_duyet', 9640 => 'da_duyet', 9642 => 'da_duyet', 9659 => 'da_duyet', 9660 => 'da_duyet', 9661 => 'da_duyet', 9662 => 'da_duyet', 9678 => 'tu_choi', 9679 => 'da_duyet', 9681 => 'da_duyet', 9682 => 'da_duyet', 9683 => 'da_duyet', 9684 => 'da_duyet', 9693 => 'da_duyet', 9694 => 'da_duyet', 9695 => 'da_duyet', 9696 => 'da_duyet', 9697 => 'da_duyet', 9698 => 'da_duyet', 9701 => 'da_duyet', 9709 => 'da_duyet', 9711 => 'da_duyet', 9712 => 'da_duyet', 9713 => 'da_duyet', 9714 => 'da_duyet', 9715 => 'da_duyet', 9716 => 'da_duyet', 9719 => 'tu_choi', 9720 => 'da_duyet', 9721 => 'da_duyet', 9722 => 'da_duyet', 9723 => 'da_duyet', 9724 => 'da_duyet', 9725 => 'da_duyet', 9726 => 'da_duyet', 9727 => 'da_duyet', 9728 => 'da_duyet', 9730 => 'da_duyet', 9732 => 'da_duyet', 9734 => 'da_duyet', 9736 => 'da_duyet', 9755 => 'da_duyet', 9756 => 'da_duyet', 9757 => 'da_duyet', 9767 => 'da_duyet', 9768 => 'da_duyet', 9779 => 'da_duyet', 9809 => 'da_duyet', 9831 => 'da_duyet', 9859 => 'da_duyet', 9864 => 'da_duyet', 9903 => 'da_duyet', 9904 => 'da_duyet', 9908 => 'da_duyet', 9909 => 'tu_choi', 9920 => 'da_duyet', 9921 => 'da_duyet', 9927 => 'da_duyet', 9928 => 'da_duyet', 9930 => 'da_duyet', 9931 => 'da_duyet', 9934 => 'da_duyet', 9936 => 'da_duyet', 9937 => 'da_duyet', 9938 => 'da_duyet', 9939 => 'da_duyet', 9940 => 'da_duyet', 9941 => 'da_duyet', 9942 => 'da_duyet', 9943 => 'da_duyet', 9944 => 'da_duyet', 9946 => 'da_duyet', 9948 => 'da_duyet', 9950 => 'da_duyet', 9952 => 'da_duyet', 9953 => 'da_duyet', 9954 => 'da_duyet', 9957 => 'da_duyet', 9958 => 'da_duyet', 9959 => 'da_duyet', 9963 => 'da_duyet', 9964 => 'da_duyet', 9965 => 'da_duyet', 9969 => 'da_duyet', 9970 => 'da_duyet', 9971 => 'da_duyet', 9972 => 'da_duyet', 9973 => 'da_duyet', 9974 => 'da_duyet', 9975 => 'tu_choi', 9976 => 'da_duyet', 9977 => 'da_duyet', 9978 => 'da_duyet', 9979 => 'da_duyet', 9980 => 'da_duyet', 9981 => 'da_duyet', 9982 => 'da_duyet', 9983 => 'da_duyet', 9984 => 'tu_choi', 9988 => 'da_duyet', 9989 => 'da_duyet', 9991 => 'da_duyet', 9992 => 'da_duyet', 9993 => 'da_duyet', 9994 => 'da_duyet', 9995 => 'da_duyet', 9996 => 'da_duyet', 10001 => 'da_duyet', 10002 => 'da_duyet', 10003 => 'da_duyet', 10004 => 'da_duyet', 10005 => 'da_duyet', 10011 => 'da_duyet', 10012 => 'da_duyet', 10013 => 'tu_choi', 10029 => 'da_duyet', 10032 => 'da_duyet', 10034 => 'da_duyet', 10047 => 'da_duyet', 10048 => 'da_duyet', 10049 => 'da_duyet', 10050 => 'da_duyet', 10051 => 'da_duyet', 10052 => 'da_duyet', 10053 => 'tu_choi', 10054 => 'tu_choi', 10055 => 'da_duyet', 10057 => 'da_duyet', 10058 => 'da_duyet', 10059 => 'da_duyet', 10060 => 'da_duyet', 10062 => 'da_duyet', 10063 => 'da_duyet', 10065 => 'da_duyet', 10066 => 'da_duyet', 10067 => 'da_duyet', 10068 => 'da_duyet', 10069 => 'da_duyet', 10070 => 'da_duyet', 10071 => 'da_duyet', 10072 => 'da_duyet', 10073 => 'da_duyet', 10075 => 'da_duyet', 10076 => 'da_duyet', 10077 => 'da_duyet', 10078 => 'da_duyet', 10079 => 'da_duyet', 10080 => 'da_duyet', 10081 => 'da_duyet', 10082 => 'da_duyet', 10083 => 'da_duyet', 10084 => 'da_duyet', 10085 => 'da_duyet', 10086 => 'da_duyet', 10087 => 'da_duyet', 10088 => 'da_duyet', 10089 => 'da_duyet', 10090 => 'da_duyet', 10093 => 'da_duyet', 10094 => 'da_duyet', 10102 => 'da_duyet', 10112 => 'da_duyet', 10113 => 'da_duyet', 10114 => 'da_duyet', 10115 => 'da_duyet', 10116 => 'da_duyet', 10117 => 'da_duyet', 10128 => 'da_duyet', 10130 => 'da_duyet', 10131 => 'da_duyet', 10134 => 'da_duyet', 10144 => 'da_duyet', 10147 => 'da_duyet', 10151 => 'da_duyet', 10152 => 'da_duyet', 10153 => 'da_duyet', 10154 => 'da_duyet', 10155 => 'da_duyet', 10156 => 'da_duyet', 10157 => 'da_duyet', 10158 => 'da_duyet', 10159 => 'da_duyet', 10160 => 'da_duyet', 10161 => 'da_duyet', 10162 => 'da_duyet', 10163 => 'da_duyet', 10164 => 'da_duyet', 10165 => 'da_duyet', 10168 => 'da_duyet', 10169 => 'da_duyet', 10170 => 'da_duyet', 10171 => 'da_duyet', 10172 => 'da_duyet', 10173 => 'da_duyet', 10174 => 'da_duyet', 10175 => 'da_duyet', 10176 => 'da_duyet', 10177 => 'da_duyet', 10178 => 'da_duyet', 10179 => 'da_duyet', 10180 => 'da_duyet', 10181 => 'da_duyet', 10182 => 'da_duyet', 10184 => 'da_duyet', 10185 => 'tu_choi', 10186 => 'da_duyet', 10187 => 'tu_choi', 10188 => 'da_duyet', 10189 => 'da_duyet', 10190 => 'da_duyet', 10191 => 'da_duyet', 10192 => 'da_duyet', 10193 => 'da_duyet', 10194 => 'da_duyet', 10195 => 'da_duyet', 10196 => 'tu_choi', 10197 => 'da_duyet', 10198 => 'da_duyet', 10202 => 'da_duyet', 10203 => 'da_duyet', 10204 => 'da_duyet', 10205 => 'tu_choi', 10206 => 'da_duyet', 10207 => 'da_duyet', 10208 => 'da_duyet', 10209 => 'da_duyet', 10211 => 'da_duyet', 10214 => 'da_duyet', 10215 => 'da_duyet', 10217 => 'da_duyet', 10218 => 'da_duyet', 10219 => 'da_duyet', 10224 => 'da_duyet', 10227 => 'da_duyet', 10247 => 'da_duyet', 10250 => 'da_duyet', 10251 => 'da_duyet', 10252 => 'da_duyet', 10253 => 'da_duyet', 10254 => 'da_duyet', 10255 => 'da_duyet', 10256 => 'da_duyet', 10257 => 'da_duyet', 10258 => 'da_duyet', 10259 => 'da_duyet', 10260 => 'da_duyet', 10261 => 'da_duyet', 10262 => 'da_duyet', 10263 => 'da_duyet', 10264 => 'da_duyet', 10265 => 'da_duyet', 10266 => 'da_duyet', 10267 => 'da_duyet', 10268 => 'da_duyet', 10269 => 'da_duyet', 10270 => 'tu_choi', 10271 => 'da_duyet', 10272 => 'da_duyet', 10273 => 'da_duyet', 10274 => 'da_duyet', 10275 => 'da_duyet', 10276 => 'da_duyet', 10277 => 'da_duyet', 10278 => 'da_duyet', 10279 => 'da_duyet', 10280 => 'da_duyet', 10281 => 'da_duyet', 10282 => 'da_duyet', 10283 => 'da_duyet', 10284 => 'da_duyet', 10285 => 'da_duyet', 10286 => 'da_duyet', 10287 => 'da_duyet', 10313 => 'da_duyet', 10326 => 'tu_choi', 10327 => 'da_duyet', 10328 => 'da_duyet', 10329 => 'da_duyet', 10330 => 'da_duyet', 10331 => 'da_duyet', 10332 => 'da_duyet', 10333 => 'tu_choi', 10334 => 'da_duyet', 10335 => 'tu_choi', 10336 => 'da_duyet', 10337 => 'tu_choi', 10338 => 'da_duyet', 10339 => 'da_duyet', 10340 => 'tu_choi', 10341 => 'da_duyet', 10342 => 'da_duyet', 10343 => 'tu_choi', 10344 => 'da_duyet', 10345 => 'da_duyet', 10346 => 'tu_choi', 10347 => 'da_duyet', 10348 => 'da_duyet', 10349 => 'da_duyet', 10350 => 'da_duyet', 10351 => 'da_duyet', 10352 => 'da_duyet', 10356 => 'tu_choi', 10357 => 'da_duyet', 10358 => 'da_duyet', 10359 => 'da_duyet', 10360 => 'tu_choi', 10361 => 'da_duyet', 10362 => 'da_duyet', 10363 => 'tu_choi', 10364 => 'tu_choi', 10365 => 'da_duyet', 10366 => 'tu_choi', 10367 => 'da_duyet', 10368 => 'tu_choi', 10369 => 'tu_choi', 10370 => 'da_duyet', 10371 => 'da_duyet', 10372 => 'tu_choi', 10373 => 'da_duyet', 10374 => 'da_duyet', 10375 => 'da_duyet', 10376 => 'da_duyet', 10377 => 'da_duyet', 10378 => 'da_duyet', 10379 => 'da_duyet', 10380 => 'da_duyet', 10381 => 'da_duyet', 10382 => 'da_duyet', 10383 => 'da_duyet', 10388 => 'da_duyet', 10389 => 'da_duyet', 10390 => 'da_duyet', 10391 => 'da_duyet', 10395 => 'da_duyet', 10396 => 'da_duyet', 10397 => 'da_duyet', 10398 => 'da_duyet', 10399 => 'da_duyet', 10400 => 'da_duyet', 10401 => 'da_duyet', 10402 => 'da_duyet', 10403 => 'da_duyet', 10404 => 'da_duyet', 10405 => 'da_duyet', 10407 => 'da_duyet', 10408 => 'da_duyet', 10409 => 'da_duyet', 10410 => 'da_duyet', 10413 => 'da_duyet', 10417 => 'da_duyet', 10418 => 'da_duyet', 10419 => 'da_duyet', 10420 => 'da_duyet', 10421 => 'da_duyet', 10422 => 'da_duyet', 10423 => 'da_duyet', 10424 => 'da_duyet', 10425 => 'da_duyet', 10426 => 'da_duyet', 10427 => 'da_duyet', 10428 => 'da_duyet', 10429 => 'da_duyet', 10430 => 'da_duyet', 10431 => 'da_duyet', 10432 => 'da_duyet', 10433 => 'da_duyet', 10434 => 'da_duyet', 10435 => 'da_duyet', 10436 => 'da_duyet', 10437 => 'da_duyet', 10438 => 'da_duyet', 10439 => 'da_duyet', 10440 => 'da_duyet', 10441 => 'da_duyet', 10444 => 'da_duyet', 10445 => 'da_duyet', 10446 => 'da_duyet', 10447 => 'da_duyet', 10449 => 'da_duyet', 10473 => 'da_duyet', 10475 => 'da_duyet', 10476 => 'da_duyet', 10477 => 'da_duyet', 10479 => 'da_duyet', 10480 => 'da_duyet', 10481 => 'da_duyet', 10482 => 'da_duyet', 10484 => 'da_duyet', 10489 => 'da_duyet', 10490 => 'da_duyet', 10491 => 'da_duyet', 10497 => 'da_duyet', 10498 => 'da_duyet', 10499 => 'da_duyet', 10500 => 'da_duyet', 10502 => 'da_duyet', 10503 => 'da_duyet', 10504 => 'da_duyet', 10505 => 'da_duyet', 10506 => 'da_duyet', 10507 => 'da_duyet', 10510 => 'da_duyet', 10511 => 'da_duyet', 10512 => 'da_duyet', 10513 => 'da_duyet', 10514 => 'da_duyet', 10515 => 'da_duyet', 10516 => 'da_duyet', 10517 => 'da_duyet', 10518 => 'da_duyet', 10519 => 'da_duyet', 10521 => 'da_duyet', 10524 => 'da_duyet', 10525 => 'da_duyet', 10530 => 'da_duyet', 10533 => 'da_duyet', 10534 => 'da_duyet', 10538 => 'da_duyet', 10540 => 'da_duyet', 10542 => 'da_duyet', 10543 => 'da_duyet', 10546 => 'da_duyet', 10547 => 'da_duyet', 10548 => 'tu_choi', 10551 => 'da_duyet', 10552 => 'da_duyet', 10553 => 'da_duyet', 10554 => 'da_duyet', 10555 => 'tu_choi', 10556 => 'tu_choi', 10558 => 'da_duyet', 10561 => 'da_duyet', 10562 => 'da_duyet', 10563 => 'da_duyet', 10564 => 'da_duyet', 10565 => 'da_duyet', 10566 => 'da_duyet', 10569 => 'da_duyet', 10576 => 'da_duyet', 10577 => 'da_duyet', 10578 => 'tu_choi', 10579 => 'da_duyet', 10582 => 'da_duyet', 10587 => 'da_duyet', 10588 => 'da_duyet', 10589 => 'da_duyet', 10590 => 'da_duyet', 10591 => 'da_duyet', 10592 => 'da_duyet', 10593 => 'da_duyet', 10594 => 'da_duyet', 10595 => 'da_duyet', 10596 => 'da_duyet', 10598 => 'da_duyet', 10599 => 'da_duyet', 10605 => 'da_duyet', 10606 => 'da_duyet', 10607 => 'da_duyet', 10629 => 'da_duyet', 10650 => 'da_duyet', 10651 => 'da_duyet', 10652 => 'da_duyet', 10653 => 'tu_choi', 10654 => 'da_duyet', 10670 => 'da_duyet', 10671 => 'da_duyet', 10677 => 'da_duyet', 10679 => 'da_duyet', 10683 => 'da_duyet', 10698 => 'da_duyet', 10700 => 'da_duyet', 10703 => 'da_duyet', 10773 => 'da_duyet', 10776 => 'da_duyet', 10778 => 'da_duyet', 10800 => 'da_duyet', 10807 => 'da_duyet', 10832 => 'da_duyet', 10833 => 'da_duyet', 10834 => 'da_duyet', 10835 => 'da_duyet', 10836 => 'da_duyet', 10837 => 'da_duyet', 10838 => 'da_duyet', 10839 => 'da_duyet', 10840 => 'da_duyet', 10844 => 'da_duyet', 10850 => 'da_duyet', 10852 => 'da_duyet', 10863 => 'da_duyet', 10900 => 'da_duyet', 10901 => 'da_duyet', 10911 => 'da_duyet', 10914 => 'da_duyet', 10915 => 'da_duyet', 10921 => 'da_duyet', 10939 => 'da_duyet', 10959 => 'da_duyet', 10961 => 'da_duyet', 10984 => 'da_duyet', 11002 => 'da_duyet', 11013 => 'da_duyet', 11025 => 'da_duyet', 11036 => 'da_duyet', 11037 => 'da_duyet', 11038 => 'da_duyet', 11039 => 'da_duyet', 11040 => 'tu_choi', 11041 => 'da_duyet', 11044 => 'da_duyet', 11056 => 'da_duyet', 11070 => 'da_duyet', 11076 => 'da_duyet', 11086 => 'da_duyet', 11088 => 'da_duyet', 11105 => 'da_duyet', 11114 => 'da_duyet', 11125 => 'da_duyet', 11135 => 'da_duyet', 11136 => 'da_duyet', 11138 => 'da_duyet', 11140 => 'da_duyet', 11155 => 'da_duyet', 11168 => 'da_duyet', 11171 => 'da_duyet', 11173 => 'da_duyet', 11174 => 'da_duyet', 11175 => 'da_duyet', 11176 => 'tu_choi', 11179 => 'da_duyet', 11180 => 'da_duyet', 11181 => 'da_duyet', 11183 => 'da_duyet', 11185 => 'da_duyet', 11186 => 'da_duyet', 11187 => 'da_duyet', 11188 => 'da_duyet', 11189 => 'da_duyet', 11190 => 'da_duyet', 11193 => 'da_duyet', 11194 => 'da_duyet', 11197 => 'da_duyet', 11208 => 'da_duyet', 11212 => 'da_duyet', 11216 => 'da_duyet', 11222 => 'da_duyet', 11223 => 'da_duyet', 11224 => 'da_duyet', 11225 => 'da_duyet', 11227 => 'da_duyet', 11230 => 'da_duyet', 11232 => 'da_duyet', 11247 => 'da_duyet', 11252 => 'da_duyet', 11255 => 'da_duyet', 11258 => 'da_duyet', 11260 => 'da_duyet', 11261 => 'da_duyet', 11262 => 'da_duyet', 11270 => 'da_duyet', 11280 => 'da_duyet', 11281 => 'da_duyet', 11299 => 'da_duyet', 11301 => 'da_duyet', 11318 => 'da_duyet', 11319 => 'da_duyet', 11330 => 'da_duyet', 11332 => 'da_duyet', 11336 => 'da_duyet', 11342 => 'da_duyet', 11343 => 'da_duyet', 11344 => 'da_duyet', 11345 => 'da_duyet', 11348 => 'da_duyet', 11350 => 'da_duyet', 11351 => 'da_duyet', 11352 => 'da_duyet', 11356 => 'da_duyet', 11357 => 'da_duyet', 11358 => 'da_duyet', 11359 => 'da_duyet', 11361 => 'da_duyet', 11364 => 'da_duyet', 11365 => 'da_duyet', 11366 => 'da_duyet', 11368 => 'da_duyet', 11372 => 'da_duyet', 11383 => 'da_duyet', 11384 => 'da_duyet', 11385 => 'da_duyet', 11389 => 'da_duyet', 11393 => 'da_duyet', 11394 => 'da_duyet', 11401 => 'da_duyet', 11402 => 'da_duyet', 11415 => 'da_duyet', 11416 => 'da_duyet', 11418 => 'da_duyet', 11419 => 'da_duyet', 11421 => 'da_duyet', 11423 => 'da_duyet', 11424 => 'da_duyet', 11435 => 'da_duyet', 11437 => 'da_duyet', 11456 => 'da_duyet', 11464 => 'da_duyet', 11522 => 'da_duyet', 11526 => 'da_duyet', 11539 => 'da_duyet', 11542 => 'da_duyet', 11547 => 'da_duyet', 11560 => 'da_duyet', 11570 => 'da_duyet', 11577 => 'da_duyet', 11582 => 'da_duyet', 11587 => 'da_duyet', 11589 => 'da_duyet', 11593 => 'da_duyet', 11595 => 'da_duyet', 11600 => 'da_duyet', 11602 => 'da_duyet', 11607 => 'da_duyet', 11629 => 'da_duyet', 11645 => 'da_duyet', 11654 => 'da_duyet', 11655 => 'da_duyet', 11660 => 'da_duyet', 11670 => 'da_duyet', 11672 => 'da_duyet', 11674 => 'da_duyet', 11675 => 'da_duyet', 11679 => 'da_duyet', 11680 => 'da_duyet', 11681 => 'da_duyet', 11682 => 'da_duyet', 11686 => 'da_duyet', 11687 => 'da_duyet', 11688 => 'da_duyet', 11690 => 'da_duyet', 11691 => 'da_duyet', 11692 => 'da_duyet', 11693 => 'da_duyet', 11694 => 'da_duyet', 11695 => 'da_duyet', 11696 => 'da_duyet', 11697 => 'da_duyet', 11735 => 'da_duyet', 11743 => 'da_duyet', 11745 => 'da_duyet', 11746 => 'da_duyet', 11750 => 'da_duyet', 11752 => 'da_duyet', 11755 => 'da_duyet', 11757 => 'da_duyet', 11758 => 'da_duyet', 11762 => 'da_duyet', 11763 => 'da_duyet', 11765 => 'da_duyet', 11766 => 'da_duyet', 11773 => 'da_duyet', 11789 => 'tu_choi', 11794 => 'da_duyet', 11795 => 'da_duyet', 11796 => 'da_duyet', 11799 => 'da_duyet', 11812 => 'da_duyet', 11813 => 'da_duyet', 11816 => 'da_duyet', 11890 => 'da_duyet', 11891 => 'da_duyet', 11892 => 'da_duyet', 11937 => 'da_duyet', 11944 => 'da_duyet', 11956 => 'da_duyet', 11959 => 'da_duyet', 11960 => 'da_duyet', 11961 => 'da_duyet', 11962 => 'da_duyet', 11963 => 'da_duyet', 11965 => 'da_duyet', 11970 => 'da_duyet', 11972 => 'da_duyet', 11976 => 'da_duyet', 11977 => 'da_duyet', 11979 => 'da_duyet', 11980 => 'da_duyet', 11981 => 'da_duyet', 11982 => 'da_duyet', 11983 => 'da_duyet', 11984 => 'da_duyet', 11985 => 'tu_choi', 11987 => 'da_duyet', 11991 => 'da_duyet', 12003 => 'da_duyet', 12006 => 'da_duyet', 12007 => 'da_duyet', 12008 => 'da_duyet', 12010 => 'da_duyet', 12012 => 'da_duyet', 12014 => 'da_duyet', 12016 => 'da_duyet', 12017 => 'da_duyet', 12019 => 'da_duyet', 12020 => 'tu_choi', 12021 => 'da_duyet', 12022 => 'da_duyet', 12025 => 'da_duyet', 12028 => 'da_duyet', 12029 => 'da_duyet', 12030 => 'da_duyet', 12032 => 'da_duyet', 12033 => 'da_duyet', 12034 => 'da_duyet', 12037 => 'da_duyet', 12039 => 'da_duyet', 12040 => 'da_duyet', 12041 => 'da_duyet', 12045 => 'da_duyet', 12046 => 'da_duyet', 12047 => 'da_duyet', 12056 => 'da_duyet', 12059 => 'da_duyet', 12066 => 'da_duyet', 12071 => 'da_duyet', 12074 => 'da_duyet', 12079 => 'da_duyet', 12081 => 'da_duyet', 12082 => 'da_duyet', 12083 => 'da_duyet', 12086 => 'da_duyet', 12091 => 'da_duyet', 12092 => 'da_duyet', 12093 => 'da_duyet', 12095 => 'da_duyet', 12097 => 'da_duyet', 12098 => 'da_duyet', 12099 => 'da_duyet', 12100 => 'da_duyet', 12103 => 'da_duyet', 12108 => 'da_duyet', 12110 => 'da_duyet', 12131 => 'da_duyet', 12132 => 'da_duyet', 12141 => 'da_duyet', 12142 => 'da_duyet', 12143 => 'da_duyet');
    $count = 0;
    foreach (array_chunk($restoreStatuses, 500, true) as $chunk) {
        $case = 'CASE id ';
        foreach ($chunk as $id => $status) {
            $case .= 'WHEN ' . (int) $id . " THEN '" . $status . "' ";
        }
        $ids = array_map('intval', array_keys($chunk));
        DB::statement('UPDATE products SET status_product = ' . $case . 'ELSE status_product END WHERE id IN (' . implode(',', $ids) . ')');

        $products = DB::table('products')->select('slug')->whereIn('id', $ids)->get();
        foreach ($products as $product) {
            if ($product->slug) {
                Cache::forget('duoctot_product_guest_' . $product->slug);
                Cache::forget('duoctot_product_login_' . $product->slug);
            }
        }
        $count += count($ids);
    }
    return 'Đã khôi phục ' . $count . ' sản phẩm!';
        }
        else if($request->an_sp_thuoc){
            // Danh sách ID danh mục cần ẩn sản phẩm
            //$catProductIds = [33,143,144,139, 149,150,162,151,152,152,154,184,157,158,159,163,187,153,188,161,164,165,197,203,178,148,160,183,175,189,205,207,209];
            $catProductIds = [143,144,197];
            // Chỉ lấy sản phẩm đúng điều kiện và đang được duyệt
            $query = ProductModel::where('status_product', 'da_duyet')
                ->where(function ($q) use ($catProductIds) {
                    $q->whereIn('cat_product_id', $catProductIds)
                    ->orWhere('name', 'LIKE', '%điều trị ung thư%');
                });
            // Lưu ID và trạng thái cũ để sau này khôi phục
            $restoreStatuses = array();
            $query->select('id', 'slug', 'status_product')
                ->chunk(500, function ($products) use (&$restoreStatuses) {
                    foreach ($products as $product) {
                        $restoreStatuses[$product->id] = $product->status_product;

                        Cache::forget('duoctot_product_guest_' . $product->slug);
                        Cache::forget('duoctot_product_login_' . $product->slug);
                    }
                });
            // Lưu danh sách ID và trạng thái cũ vào file JSON
            $file = storage_path('app/restore_product_statuses.json');
            file_put_contents(
                $file,
                json_encode($restoreStatuses, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
            );
            // Chỉ cập nhật các ID vừa lưu
            if (!empty($restoreStatuses)) {
                ProductModel::whereIn('id', array_keys($restoreStatuses))
                    ->update(array('status_product' => 'sp_an'));
            }
            return 'Đã ẩn ' . count($restoreStatuses) .
                ' sản phẩm. Đã lưu ID và trạng thái cũ tại storage/app/restore_product_statuses.json';
        }
        else if ($request->gia_0ncc) {
            $idNCC0Product = 1144150836;
            $products = ProductModel::where('user_id', $idNCC0Product)->get();
            foreach ($products as $product) {
                $slug = $product->slug;
            }
            ProductModel::where('user_id', $idNCC0Product)->update([
                'show_price' => '2'
            ]);
            return 'giá 0d thành công';
        }
        else if ($request->thay_image) {
            $start = 178;
            $end = 813;
            $table = 'post';
            $contentColumn = 'content';
            $imageColumn = 'image';
            $domain = 'https://duoctot.com';
            // Đặt true để LƯU THẬT vào DB, để false để chỉ xem trước (không lưu)
            $apply = $request->apply ? true : false;
            $rows = DB::table($table)
                ->whereBetween('id', [$start, $end])
                ->select('id', $contentColumn, $imageColumn)
                ->orderBy('id')
                ->get();
            $logLines = [];
            $countChanged = 0;
            $countSkippedNoImage = 0;
            $countSkippedZeroImg = 0;
            $countSkippedMultiImg = 0;
            $countSkippedSameAlready = 0;
            foreach ($rows as $row) {
                $id = $row->id;
                $content = $row->{$contentColumn} ?? '';
                $imagePath = $row->{$imageColumn} ?? '';
                if (empty($imagePath)) {
                    $countSkippedNoImage++;
                    continue;
                }
                if (empty($content)) {
                    $countSkippedZeroImg++;
                    continue;
                }
                // Đếm số thẻ <img> trong content
                preg_match_all('/<img[^>]+src=["\']([^"\']+)["\'][^>]*>/i', $content, $matches);
                $imgCount = count($matches[0]);
                if ($imgCount === 0) {
                    $countSkippedZeroImg++;
                    continue;
                }
                if ($imgCount > 1) {
                    $countSkippedMultiImg++;
                    continue;
                }
                // Chỉ có đúng 1 ảnh -> lấy src hiện tại
                $oldSrc = $matches[1][0];
                // Xây link mới: full URL = domain + path (path trong cột image)
                $normalizedPath = '/' . ltrim($imagePath, '/');
                $newSrc = $domain . $normalizedPath;
                if ($oldSrc === $newSrc) {
                    $countSkippedSameAlready++;
                    continue;
                }
                // Thay src cũ bằng src mới trong content
                $oldImgTag = $matches[0][0];
                $newImgTag = str_replace($oldSrc, $newSrc, $oldImgTag);
                $newContent = str_replace($oldImgTag, $newImgTag, $content);
                $logLines[] = "ID {$id} | OLD: {$oldSrc} | NEW: {$newSrc}";
                $countChanged++;
                if ($apply) {
                    DB::table($table)->where('id', $id)->update([$contentColumn => $newContent]);
                }
            }
            return response()->json([
                'mode' => $apply ? 'APPLIED (đã lưu vào DB)' : 'PREVIEW (chưa lưu, thêm ?apply=1 để lưu thật)',
                'total_rows_scanned' => $rows->count(),
                'will_change_or_changed' => $countChanged,
                'skipped_no_image_column' => $countSkippedNoImage,
                'skipped_zero_img_in_content' => $countSkippedZeroImg,
                'skipped_multi_img_in_content' => $countSkippedMultiImg,
                'skipped_already_same' => $countSkippedSameAlready,
                'detail' => $logLines,
            ]);
        }
        else if($request->shop){
            // add comment shop
            $comments = CommentModel::select('id', 'shop_id')->get()->groupBy('shop_id');
            $users = UsersModel::where('user_type_id','=',9)->pluck('user_id');
            $names = ['Đinh Văn Lượng', 'Duy Điều', 'Trần Thanh Sang', 'Lê Văn Sơn', 'Văn Thạch'];
            $phones = ['0936766560', '0988776655', '0911223344', '0977888999', '0909000001'];
            $contents = [
                'Cảm ơn sản phẩm của Shop, tôi đã dùng và thấy tốt',
                'Đã nhận hàng và dùng ổn Shop tư vấn nhiệt tình',
                'Dịch vụ giao hàng chu đáo',
                'Dịch vụ quá tốt có tư vấn miễn phí qua app Tdoctor',
                'Sản phẩm tốt. Cám ơn đã phân phối'
            ];
            $ratings = [4, 5, 5, 4, 5];
            $created_at = ['2020-04-24 00:00:00', '2023-06-15 00:00:00', '2022-01-05 00:00:00', '2024-07-09 00:00:00', '2022-09-14 00:00:00'];
            foreach ($users as $userId) {
                // Nếu shop này CHƯA có comment thì mới thêm
                    for ($i = 0; $i < 5; $i++) {
                        $params = [
                            'fullname'   => $names[$i],
                            'user_id'    => '',
                            'phone'      => $phones[$i],
                            'content'    => $contents[$i],
                            'rating'     => $ratings[$i],
                            'parent_id'  => 0,
                            'shop_id' => $userId,
                            'created_at' => $created_at[$i]
                        ];
                        (new CommentModel)->saveItem($params, ['task' => 'add-item']);
                    }
            }
            return 'Đã thêm 5 comment cho các Shop chưa có comment';
        }else{
            try {
                DB::beginTransaction();
                $affiliates = AffiliateModel::with('userRef')->select('id', 'code_ref', 'user_id', 'info_user')->get();
                foreach ($affiliates as $affiliate) {
                    $fullname = $affiliate->userRef ? $affiliate->userRef->fullname : '';
                    $phone = $affiliate->userRef ? $affiliate->userRef->phone : '';
                    $email = $affiliate->userRef ? $affiliate->userRef->email : '';
                    $infoUser = implode(' ', [
                        $fullname,
                        $phone,
                        $email
                    ]);
                    AffiliateModel::where('id', $affiliate['id'])->update(['info_user' => $infoUser]);
                }
                DB::commit();
                return response()->json(['success' => true, 'message' => 'Cập nhật info user affiliate thành công']);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['success' => false, 'message' => $e->getMessage()]);
            }
        }

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
        //     $record->save();
        // }
        // return 'ok';
        //add lên bảng user
        //$userNeedAdd = MyTableModel::orderBy('A')->skip(3000)->take(1000)->get();
        // $userNeedAdd = MyTableModel::orderBy('A')->take(173)->get();
        // $count = 1;
        // try {
        //     $successCount = 0;
        //     $failureCount = 0;
        //     $maxRecords = 173; // Giới hạn số bản ghi tối đa cần thêm
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
        //             'district_id' => '',
        //             'user_type_id' => $val['F'],
        //             'gender' => 3,
        //             'paid' => 1,
        //             'type_account'=>'code_import',
        //             'details' => [
        //                 'member_id' => $val['A'],
        //                 'province_id' => $val['E'],
        //                 'district_id' => '',
        //                 'ward_id' => '',
        //                 'address' => $val['B'],
        //                 'sell_area' => 0,
        //                 'tax_code' => '',
        //                 'person_represent' => '',
        //                 'map' => $val['G'],
        //                 'slug' => Str::slug($val['C']),
        //                 'image' => "/laravel-filemanager/fileUpload/nhathuoc/nhathuocmau" . $count . ".jpg",
        //             ]
        //         ];
        //         $count++;
        //         if ($count > 10) {
        //             $count = 1;
        //         }
        //         $currentIdUser = (new UsersModel())->saveItem($params, ['task' => 'register']);
        //         $userCurrent = UsersModel::select('user_id','fullname')->where('user_id', $currentIdUser)->first();
        //         $slugInName = Str::slug($userCurrent['fullname']);
        //         $codeRef = 'T'. $userCurrent['user_id'];
        //         UsersModel::where('user_id', $currentIdUser)->update(['slug' => $slugInName,'codeRef' => $codeRef]);
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
