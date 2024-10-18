<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use App\Model\Shop\ProductModel;
use App\Model\Shop\PostModel;

class SiteMapController extends ShopFrontEndController
{
    public function sitemapPage(){
        $products = (new ProductModel())->listItems(null, ['task' => 'frontend-list-items-simple'])->take(200);
        $urls = [
            ['loc' => 'https://tdoctor.net/danh-muc-thuoc/thuc-pham-chuc-nang', 'lastmod' => Carbon::now()->toDateString()],
            ['loc' => 'https://tdoctor.net/danh-muc-thuoc/cham-soc-ca-nhan', 'lastmod' => Carbon::now()->toDateString()],
            ['loc' => 'https://tdoctor.net/danh-muc-thuoc/thuoc', 'lastmod' => Carbon::now()->toDateString()],
            ['loc' => 'https://tdoctor.net/danh-muc-thuoc/thiet-bi-y-te', 'lastmod' => Carbon::now()->toDateString()],
            ['loc' => 'https://tdoctor.net/danh-muc-thuoc/me-va-be', 'lastmod' => Carbon::now()->toDateString()],
            ['loc' => 'https://tdoctor.net/tin-tuc', 'lastmod' => Carbon::now()->toDateString()],
            ['loc' => 'https://tdoctor.net/danh-sach-nha-thuoc', 'lastmod' => Carbon::now()->toDateString()],
            ['loc' => 'https://tdoctor.net/danh-sach-shop', 'lastmod' => Carbon::now()->toDateString()],
            ['loc' => 'https://tdoctor.net/danh-muc-thuoc/thuc-pham-chuc-nang/sinh-ly-noi-tiet-to', 'lastmod' => Carbon::now()->toDateString()],
            ['loc' => 'https://tdoctor.net/danh-muc-thuoc/thuc-pham-chuc-nang/suc-khoe-tim-mach', 'lastmod' => Carbon::now()->toDateString()],
            ['loc' => 'https://tdoctor.net/danh-muc-thuoc/thuc-pham-chuc-nang/ho-tro-tieu-hoa', 'lastmod' => Carbon::now()->toDateString()],
            ['loc' => 'https://tdoctor.net/danh-muc-thuoc/thuc-pham-chuc-nang/than-kinh-nao', 'lastmod' => Carbon::now()->toDateString()],
            ['loc' => 'https://tdoctor.net/danh-muc-thuoc/thuc-pham-chuc-nang/cai-thien-tang-cuong-chuc-nang', 'lastmod' => Carbon::now()->toDateString()],
            ['loc' => 'https://tdoctor.net/danh-muc-thuoc/thuc-pham-chuc-nang/thao-duoc-thuc-pham-tu-nhien', 'lastmod' => Carbon::now()->toDateString()],
            ['loc' => 'https://tdoctor.net/danh-muc-thuoc/thuc-pham-chuc-nang/tham-my-ho-tro-lam-dep', 'lastmod' => Carbon::now()->toDateString()],
            ['loc' => 'https://tdoctor.net/danh-muc-thuoc/thuc-pham-chuc-nang/dinh-duong-vitamin-khoang-chat', 'lastmod' => Carbon::now()->toDateString()],
            ['loc' => 'https://tdoctor.net/danh-muc-thuoc/thuc-pham-chuc-nang/ung-thu', 'lastmod' => Carbon::now()->toDateString()],
            ['loc' => 'https://tdoctor.net/danh-muc-thuoc/thuc-pham-chuc-nang/xuong-khop', 'lastmod' => Carbon::now()->toDateString()],
            ['loc' => 'https://tdoctor.net/danh-muc-thuoc/thuc-pham-chuc-nang/tai-mui-hong', 'lastmod' => Carbon::now()->toDateString()],
            ['loc' => 'https://tdoctor.net/danh-muc-thuoc/thuc-pham-chuc-nang/phu-khoa', 'lastmod' => Carbon::now()->toDateString()],
            ['loc' => 'https://tdoctor.net/danh-muc-thuoc/thuc-pham-chuc-nang/than-tiet-nieu', 'lastmod' => Carbon::now()->toDateString()]
        ];
        return response()->view('shop.frontend.pages.home/sitemap', ['urls' => $urls])
                         ->header('Content-Type', 'application/xml');
    }
}
