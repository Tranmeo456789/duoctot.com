<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class SiteMapController extends ShopFrontEndController
{
    public function sitemapPage(){
        $urls = [
            ['loc' => 'https://tdoctor.net/sitemap_thuc-pham-chuc-nang.xml', 'lastmod' => Carbon::now()->toDateString()],
            ['loc' => 'https://tdoctor.net/sitemap_cham-soc-ca-nhan.xml', 'lastmod' => Carbon::now()->toDateString()],
            ['loc' => 'https://tdoctor.net/sitemap_thuoc.xml', 'lastmod' => Carbon::now()->toDateString()],
            ['loc' => 'https://tdoctor.net/sitemap_thiet-bi-y-te.xml', 'lastmod' => Carbon::now()->toDateString()],
            ['loc' => 'https://tdoctor.net/sitemap_me-va-be.xml', 'lastmod' => Carbon::now()->toDateString()],
            ['loc' => 'https://tdoctor.net/sitemap_tin-tuc.xml', 'lastmod' => Carbon::now()->toDateString()],
            ['loc' => 'https://tdoctor.net/sitemap_baiviet1.xml', 'lastmod' => Carbon::now()->toDateString()],
            ['loc' => 'https://tdoctor.net/sitemap_baiviet2.xml', 'lastmod' => Carbon::now()->toDateString()],
            ['loc' => 'https://tdoctor.net/sitemap_baiviet3.xml', 'lastmod' => Carbon::now()->toDateString()],
            ['loc' => 'https://tdoctor.net/sitemap_baiviet4.xml', 'lastmod' => Carbon::now()->toDateString()],
            ['loc' => 'https://tdoctor.net/sitemap_baiviet5.xml', 'lastmod' => Carbon::now()->toDateString()],
        ];
        return response()->view('shop.frontend.pages.home/sitemap', ['urls' => $urls])
                         ->header('Content-Type', 'application/xml');
    }
}
