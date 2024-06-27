<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class SiteMapController extends ShopFrontEndController
{
    public function sitemapPage()
    {

        $time = Carbon::now()->toDateString();

        $publicPath = public_path();
        // Tạo nội dung cho sitemapindex
        $sitemapIndexContent = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $sitemapIndexContent .= '<sitemapindex xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd">' . PHP_EOL;
        // Thêm các liên kết tới các tệp sitemap con
        $sitemapIndexContent .= $this->generateSitemapEntry('https://tdoctor.net/sitemap_thuc-pham-chuc-nang.xml', Carbon::now()->toDateString());
        $sitemapIndexContent .= $this->generateSitemapEntry('https://tdoctor.net/sitemap_thuoc.xml', Carbon::now()->toDateString());
        $sitemapIndexContent .= $this->generateSitemapEntry('https://tdoctor.net/sitemap_cham-soc-ca-nhan.xml', Carbon::now()->toDateString());
        $sitemapIndexContent .= $this->generateSitemapEntry('https://tdoctor.net/sitemap_thiet-bi_y-te.xml', Carbon::now()->toDateString());
        $sitemapIndexContent .= $this->generateSitemapEntry('https://tdoctor.net/me-va-be.xml', Carbon::now()->toDateString());
        $sitemapIndexContent .= $this->generateSitemapEntry('https://tdoctor.net/sitemap_tin-tuc.xml', Carbon::now()->toDateString());
        // Thêm các tệp sitemap khác tương tự ở đây
        $sitemapIndexContent .= '</sitemapindex>';
        // Ghi đè nội dung mới lên tệp sitemap.xml
        File::put($publicPath . '/sitemap.xml', $sitemapIndexContent);
        // Trả về nội dung của sitemapindex
        return Response::make($sitemapIndexContent, 200, [
            'Content-Type' => 'text/xml'
        ]);
    }

    protected function generateSitemapEntry($loc, $lastmod)
    {
        return "\t<sitemap>" . PHP_EOL .
            "\t\t<loc>" . $loc . "</loc>" . PHP_EOL .
            "\t\t<lastmod>" . $lastmod . "</lastmod>" . PHP_EOL .
            "\t</sitemap>" . PHP_EOL;
    }
}
