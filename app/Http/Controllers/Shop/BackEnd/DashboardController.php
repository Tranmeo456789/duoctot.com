<?php


namespace App\Http\Controllers\Shop\BackEnd;

use Illuminate\Http\Request;
use App\Model\Shop\OrderModel;
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
        $date_current=date("Y-m-d");$sum=0;
        $order_day=(new OrderModel)->listItems(null, ['task' => 'user-list-items-in-day']);
        if(!empty($order_day)){
            $sum = $order_day->sum('total');
        }
             
        //return($sum);
        return view($this->pathViewController .  'index',compact('order_day','sum'));
    }
}
