<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use App\Model\Shop\WarehouseModel as MainModel;
class WarehouseController extends ShopFrontEndController
{
    public function __construct()
    {
        $this->controllerName     = 'warehouse';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Kho hàng';
        $this->model = new MainModel();
        parent::__construct();

    }
    public function getList(Request $request){
       $params['user_id'] = intval($request->user_id);
       $params['filter']['district_id'] = intval($request->filter_district_id);
       $params['filter']['province_id'] = intval($request->filter_pharmacy_province_id);
       $items = $this->model->listItems($params,['task' => 'frontend-list-items']);

       return view("$this->moduleName.pages.cart.child_view.receive_store",
            compact('params','items'));
    }

}
