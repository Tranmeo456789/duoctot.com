<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Http\Requests;
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
        if(!empty($request->input('btn_search')) && !empty($request->input('keyword'))){
            $params = $request->all();
            $itemExist = $this->model->getItem($params, ['task'=>'get-item']);
            //return($itemExist['number_search']);
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
}
