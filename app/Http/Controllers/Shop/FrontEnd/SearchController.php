<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use App\Model\Shop\CatProductModel;
use App\Model\Shop\ProductModel;
use App\Model\Shop\ProvinceModel;
use App\Model\Shop\DistrictModel;
use App\Model\Shop\WardModel;
use App\Model\Shop\UsersModel;
use App\Model\Shop\WarehouseModel;
class SearchController extends ShopFrontEndController
{
    public function __construct()
    {
        $this->controllerName     = 'search';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'tìm kiếm';
        parent::__construct();
       
    }
    public function viewHome(Request $request)
    {
        return view($this->pathViewController . 'view');
    }
    public function saveHome(Request $request)
    {
        if(!empty($request->input('btn-search')) && !empty($request->input('keyword'))){
            return('Lưu nội dung');
        }
        
    }
}
