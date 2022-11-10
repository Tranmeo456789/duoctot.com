<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use App\Model\Shop\ProductModel;
use App\Model\Shop\SearchModel as MainModel;

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
    public function viewHome(Request $request,$keyword)
    {
        $params['keyword']=$keyword;
        $itemSearch=(new ProductModel)->listItems($params,['task'=>'list-items-search']);
        return view($this->pathViewController . 'view',['keyword'=>$keyword,'itemSearch'=>$itemSearch]);
    }
    public function saveHome(Request $request)
    {
        // save history keyword search
        if(!empty($request->input('btn_search')) && !empty($request->input('keyword'))){
            $params = $request->all();
            $itemExist = $this->model->getItem($params, ['task'=>'get-item']);
            $keywordHistory  = (isset($_COOKIE["keywordHistory"]))?json_decode($_COOKIE["keywordHistory"],true):[];
            $keywordCurrent = [];
        if (isset($keywordCurrent[$params['keyword']])){
            $keywordCurrent[$params['keyword']] = $keywordHistory[$params['keyword']];
            unset($keywordHistory[$params['keyword']]);
        }else{
            $keywordCurrent[$params['keyword']] = [
                'keyword' => $params['keyword'],
            ];
        }
        $keywordHistory = $keywordCurrent + $keywordHistory;
        if (count($keywordHistory) > 5){
            array_pop($keywordHistory);
        }
        setcookie("keywordHistory", json_encode($keywordHistory),time() + config('myconfig.time_cookie'), "/");
        $_COOKIE["keywordHistory"] = json_encode($keywordHistory);
        //save keyword search most
        if(isset($itemExist)){
            $params['id']=$itemExist['id'];
            $params['number_search'] = $itemExist['number_search'];
            $this->model->saveItem($params, ['task'=>'update-number-search-item']);
        }else{
            $this->model->saveItem($params, ['task'=>'add-item-home']);
        } 
            return redirect()->route('fe.search.viewHome',['keyword' => $params['keyword']]);
        }
        
    }
    public function deleteHistory(Request $request){
        $data = $request->all();
        setcookie( "keywordHistory", "", time()- 60, "/","", 0);
        return view("$this->moduleName.block.menu.child_menu_yes_search.form_search");
    }
}
