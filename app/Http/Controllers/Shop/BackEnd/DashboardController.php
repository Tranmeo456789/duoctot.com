<?php


namespace App\Http\Controllers\Shop\BackEnd;

use Illuminate\Http\Request;
use App\Model\Shop\OrderModel;
use App\Model\Shop\ProductModel;
use App\Helpers\MyFunction;
use App\Http\Controllers\Shop\BackEnd\BackEndController;
use App\Model\Shop\AffiliateModel;
use App\Model\Shop\UsersModel;
use \Firebase\JWTCustom\JWTCustom as JWTCustom;
use DB;
class DashboardController extends BackEndController
{
    protected $jwt_key = 'anHAzy7CeVuL8ybwt4epOUH5NQXYocpBXQwWGalzU6xRSkD0lAUOsRChzC8fTS6ETSH2J3KpgQbnlPvdMVe7oNcuPQzTkPHfUx88';
    public function __construct()
    {
        $this->controllerName     = 'dashboard';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Thống kê bán hàng';
        parent::__construct();
    }
    public function index(Request $request){
        $params['day']=date("Y-m-d");
        $sum_money_day=0;
        $sum_quantity=0;
        $sum_money=0;     
        $session = $request->session();
        if($request->token){
            $token = $request->token;
            $data_token = (JWTCustom::decode($token, $this->jwt_key, array('HS256')));
            $listRoom=[];
            if ($data_token['message'] == 'OK') {
                $userInfoId = ((array)$data_token['payload'])['user_id'];
                $userInfo=UsersModel::where('user_id',$userInfoId)->first();
                $request->session()->put('web_view', 1);
                $request->session()->put('user',$userInfo);
            }else{
                return view('shop.frontend.pages.error.page_404'); 
            }
        }
        $order_day=(new OrderModel)->listItems($params, ['task' => 'user-list-items-in-day']);
        if(!empty($order_day)){
            $sum_money_day = $order_day->sum('total');
        }     
        $itemStatusOrderCount = (new OrderModel)->countItems($params, ['task' => 'admin-count-items-group-by-status-order']);
        //$sum_quantity=(new ProductModel())->sumNumberItems($params, ['task' => 'sum-quantity-product-in-warehouse-of-user-id']);
        //$sum_money=(new ProductModel())->sumNumberItems($params, ['task' => 'sum-money-product-in-warehouse-of-user-id']);
        $sum_quantity=100;
        $sum_money=100000000;
        $session = $request->session();
        $itemOrder=(new OrderModel())->listItems(null, ['task' => 'user-list-items']);
         if(!empty($itemOrder)){
             $total_revenue=$itemOrder->sum('total');
         }
         $session->forget('params.search');
         $session->forget('params.filter');
        return view($this->pathViewController .  'index',compact('order_day','sum_money_day','sum_quantity','sum_money','total_revenue','itemStatusOrderCount'));
    }
    public function filterInDay(Request $request){
        $data = $request->all();
        $day_start=$request->day_start;
        $day_end=$request->day_end;
        $params['filter_in_day']['day_start']=MyFunction::formatDateLikeMySQL($day_start);
        $params['filter_in_day']['day_end']=MyFunction::formatDateLikeMySQL($day_end);
        $itemOrder=(new OrderModel())->listItems($params, ['task' => 'user-list-items']);
        $total_revenue=0;
        if(!empty($itemOrder)){
            $total_revenue=$itemOrder->sum('total');
        }
        $result = array(  
             'total_revenue'=>$total_revenue
          );
          return response()->json($result, 200);
        //   return view($this->pathViewController.'child_index.revenue_sell', [
        //     'total_revenue' => $total_revenue,
        // ]);
    }
}
