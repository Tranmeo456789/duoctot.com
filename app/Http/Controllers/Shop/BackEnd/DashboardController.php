<?php


namespace App\Http\Controllers\Shop\BackEnd;

use Illuminate\Http\Request;
use App\Model\Shop\OrderModel;
use App\Model\Shop\ProductModel;
use App\Http\Controllers\Shop\BackEnd\BackEndController;
use DB;
class DashboardController extends BackEndController
{
    public function __construct()
    {
        $this->controllerName     = 'dashboard';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Thống kê bán hàng';
        parent::__construct();
    }
    public function index(Request $request){
        $params['day']=date("Y-m-d");$sum_money_day=0;$sum_quantity=0; $sum_money=0;     
        $order_day=(new OrderModel)->listItems($params, ['task' => 'user-list-items-in-day']);
        if(!empty($order_day)){
            $sum_money_day = $order_day->sum('total');
        }
        $itemsProduct = (new ProductModel())->listItems(null, ['task' => 'user-list-items-in-warehouse-no-pagination']);    
        if(!empty($itemsProduct)){
            $sum_quantity=$itemsProduct->sum('quantity_in_stock');
            $sum_money=$itemsProduct->sum('price');
        }
        
        //return($sum_money);
        return view($this->pathViewController .  'index',compact('order_day','sum_money_day','sum_quantity','sum_money'));
    }
}
