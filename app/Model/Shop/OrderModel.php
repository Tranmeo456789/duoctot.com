<?php
namespace App\Model\Shop;
use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Model;
use App\Model\Shop\BackEndModel;
use Illuminate\Support\Str;
use Kalnoy\Nestedset\NodeTrait;
use App\Model\Shop\ProductModel;
use App\Model\Shop\CollaboratorsUserModel;
use App\Model\Shop\CollaboratorsClinicDoctor;
use App\Model\Shop\CustomerShopModel;
use App\Model\Shop\ProductWarehouseModel;
use App\Model\Shop\ProvinceModel;
use App\Model\Shop\DistrictModel;
use App\Model\Shop\WardModel;
use DB;
use Session;
class OrderModel extends BackEndModel
{
    protected $casts = [
        'info_product'   => 'array',
        'pharmacy' =>'array',
        'receive' => 'array'
    ];
    public function __construct() {
        $this->table               = 'orders';
        $this->controllerName      = 'order';
        $this->folderUpload        = '' ;
        $filedSearch               = array_key_exists($this->controllerName, config('myconfig.config.search')) ? $this->controllerName : 'default';
        $this->fieldSearchAccepted = array_diff(config('myconfig.config.search.' . $filedSearch),['all']);
        $this->crudNotAccepted     = ['_token','btn_save','quantity','currentValue','warehouse_id'];
    }
    public function search($query,$params){
        if (isset($params['search']['value'] ) && ($params['search']['value'] !== "")) {
            if($params['search']['field'] == "all") {
                $query->where(function($query) use ($params){
                    foreach($this->fieldSearchAccepted as $column){
                        $query->orWhereRaw("LOWER($column)" . ' LIKE BINARY ' .  "LOWER('%{$params['search']['value']}%')" );
                    }
                });
            } else if(in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->whereRaw("LOWER({$params['search']['field']})" . " LIKE BINARY " .  "LOWER('%{$params['search']['value']}%')" );
            }
        }
        return $query;
    }
    public function scopeOfUser($query)
    {
        if (\Session::has('user')){
            $user = \Session::get('user');
            $user = UsersModel::where('user_id', $user->user_id)->first();
            if($user['is_admin']==1){
                return  $query;
            }else{
                $codeRef=$user->codeRef ?? 'MCNULL';
                return  $query->where('user_sell',$user->user_id)->orWhere('info_product', 'LIKE', "%$codeRef%");
            }

        }
        return $query;
    }

    public function listItems($params = null, $options = null)
    {
        $result = null;
        if($options['task'] == "user-list-items-frontend"){
            $query = $this::select('id','code_order','total','total_product','created_at','status_order','user_id','buyer','payment','status_control')
                                ->where('user_id',$params['user_id']);
            switch ($params['status'])
            {
                case 'chua_hoan_tat' :
                    $query = $query->whereIn('status_order',['choThanhToan','dangXuLy','daXacNhan','dangGiaoHang','daGiaoHang']);
                    break;
                case 'hoan_tat' :
                    $query = $query->whereIn('status_order',['hoanTat']);
                    break;
                case 'da_huy' :
                    $query = $query->whereIn('status_order',['daHuy']);
                    break;
                case 'tra_hang' :
                    $query = $query->whereIn('status_order',['traHang']);
                    break;
                default:
                $query = $query;
                    break;
            }
            $result =  $query->orderBy('id', 'desc')->get();
        }
        if ($options['task'] == "user-list-items") {
            $query = $this::with('userBuy')
                                ->select('id','code_order','total','created_at','status_order','user_id','buyer','payment','status_control')
                                ->where('id','>',1)->OfUser();
            if ((isset($params['filter']['status_order'])) && ($params['filter']['status_order'] != 'all')) {
                $query = $query->where('status_order',$params['filter']['status_order']);
            }
            if(isset($params['filter_in_day'])){
                $query->whereBetween('created_at', ["{$params['filter_in_day']['day_start']}", "{$params['filter_in_day']['day_end']}"]);
            }
            if (isset($params['search']['value']) && ($params['search']['value'] !== ""))  {
                if($params['search']['field'] == "all") {
                    $query->where(function($query) use ($params){
                        foreach($this->fieldSearchAccepted as $column){
                            $query->orWhereRaw("LOWER($column)" . ' LIKE BINARY ' .  "LOWER('%{$params['search']['value']}%')" );
                        }
                    });
                } else if(in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                        $query->whereRaw("LOWER({$params['search']['field']})" . " LIKE BINARY " .  "LOWER('%{$params['search']['value']}%')" );
                }
            }
            if(isset($params['pagination'])){
                $query=$query->orderBy('id', 'desc')
                              ->paginate($params['pagination']['totalItemsPerPage']);
            }else{
                $query=$query->orderBy('id', 'desc')->get();
            }

            $result =  $query;
        }
        if ($options['task'] == "user-list-items-affiliate") {
            $query = $this::with('userBuy')
                                ->select('id','code_order','total','created_at','status_order','user_id','buyer','payment','status_control')
                                ->where('id','>',1);
            if ((isset($params['code_ref']))) {
                $codeRef=$params['code_ref'];
                if($params['user_type_id'] > 4){
                    $query = $query->OfUser()
                    ->orWhere('info_product', 'LIKE', "%$codeRef%");
                }else{
                    $query = $query->where('info_product', 'LIKE', "%$codeRef%");
                }
            }             
            if ((isset($params['filter']['status_order'])) && ($params['filter']['status_order'] != 'all')) {
                $query = $query->where('status_order',$params['filter']['status_order']);
            }
            if(isset($params['filter_in_day'])){
                $query->whereBetween('created_at', ["{$params['filter_in_day']['day_start']}", "{$params['filter_in_day']['day_end']}"]);
            }
            if(isset($params['pagination'])){
                $query=$query->orderBy('id', 'desc')
                              ->paginate($params['pagination']['totalItemsPerPage']);
            }else{
                $query=$query->orderBy('id', 'desc')->get();
            }

            $result =  $query;
        }
        if ($options['task'] == "user-list-items-by-status"){
            $query = $this::with('userBuy','userSell')
                                ->select('id','code_order','total_product','info_product','total','created_at','buyer','receive','status_order','payment','status_control','user_id','user_sell')
                                ->where('created_by',$params['user']->user_id);
            if ((isset($params['status_order'])) && ($params['status_order'] != 'all')) {
                $query = $query->where('status_order',$params['filter']['status_order']);
            }
            if(isset($params['pagination'])){
                $query=$query->orderBy('id', 'desc')
                              ->paginate($params['pagination']['totalItemsPerPage']);
            }else{
                $query=$query->orderBy('id', 'desc')->get();
            }
            $result =  $query;
        }
        if($options['task'] == "user-list-items-in-day"){
            $query = $this::with('userBuy')
            ->select('id','code_order','total','created_at','status_order','user_id','payment','status_control')
            ->where('id','>',1)->where('created_at','LIKE', "%{$params['day']}%");
            if ((isset($params['code_ref']))) {
                $codeRef=$params['code_ref'];
                if($params['user_type_id'] > 4){
                    $query = $query->OfUser()
                    ->whereDate('created_at', $params['day']);
                }else{
                    $query = $query->where('info_product', 'LIKE', "%$codeRef%");
                }
            }else{
                $query = $query->OfUser();
            }  
            $result =  $query->orderBy('id', 'desc')->get();
        }
        if ($options['task'] == "list-items-in-phone") {
            $query = $this::select('id','code_order','total','created_at','status_order','payment','status_control','user_id','delivery_method','receive',
            'info_product','buyer','pharmacy','total_product')
                                ->where('id','>',1);
            if(isset($params['search'])){
                $query=$this::where('buyer','LIKE', "%{$params['search']}%");
            } 
            if(isset($params['status'])){
                switch ($params['status'])
                {
                    case 'chua_hoan_tat' :
                        $query = $query->whereIn('status_order',['choThanhToan','dangXuLy','daXacNhan','dangGiaoHang','daGiaoHang']);
                        break;
                    case 'hoan_tat' :
                        $query = $query->whereIn('status_order',['hoanTat']);
                        break;
                    case 'da_huy' :
                        $query = $query->whereIn('status_order',['daHuy']);
                        break;
                    case 'tra_hang' :
                        $query = $query->whereIn('status_order',['traHang']);
                        break;
                    default:
                    $query = $query;
                        break;
                }
            }          
            if(isset($params['pagination'])){
                $query=$query->orderBy('id', 'desc')
                              ->paginate($params['pagination']['totalItemsPerPage']);
            }else{
                $query=$query->orderBy('id', 'desc')->get();
            }

            $result =  $query;
        }
        if ($options['task'] == "list-items-api") {
            $query = $this::select('id','code_order','total','created_at','status_order','total_product');
            if(isset($params['search'])){
                $query=$this::where('buyer','LIKE', "%{$params['search']}%");
            } 
            if(isset($params['status_order'])){
                switch ($params['status_order'])
                {
                    case 'chua_hoan_tat' :
                        $query = $query->whereIn('status_order',['choThanhToan','dangXuLy','daXacNhan','dangGiaoHang','daGiaoHang']);
                        break;
                    case 'hoan_tat' :
                        $query = $query->whereIn('status_order',['hoanTat']);
                        break;
                    case 'da_huy' :
                        $query = $query->whereIn('status_order',['daHuy']);
                        break;
                    case 'tra_hang' :
                        $query = $query->whereIn('status_order',['traHang']);
                        break;
                    default:
                    $query = $query;
                        break;
                }
            }          
            if (isset($params['page']) && isset($params['perPage'])) {
                $query = $query->orderBy('id', 'desc')->paginate($params['perPage'],['id','code_order','total','created_at','status_order','total_product'], 'page', $params['page']);
            }else{
                $query=$query->orderBy('id', 'desc')->get();
            }
            $result =  $query;
        }
        return $result;
    }
    public function getItem($params = null, $options = null)
    {
        $result = null;
        if ($options['task'] == 'get-item-frontend') {
            $result = self::select('id','code_order','total','money_ship','created_at','status_order','payment','status_control','user_id','user_sell',
                            'info_product','buyer','pharmacy','total_product','delivery_method','receive')
                            ->where('id', $params['id'])
                            ->first();
        }
        if ($options['task'] == 'get-item-frontend-code') {
            $result = self::select('id','code_order','total','money_ship','created_at','status_order','payment','status_control','user_id','user_sell',
            'info_product','buyer','pharmacy','total_product','delivery_method','receive','address_detail')
                            ->where('code_order', $params['code_order'])
                            ->first();
        }
        if ($options['task'] == 'get-item') {
            $result = self::with('userBuy')
                            ->select('id','code_order','total','money_ship','created_at','status_order','payment','status_control','user_id','user_sell',
                            'info_product','buyer','pharmacy','total_product','delivery_method','receive')
                            ->where('id', $params['id'])
                            ->first();

        }
        if ($options['task'] == 'get-item-for-update-product-in-store') {
            $result = self::select('id','info_product')
                            ->where('id', $params['id'])
                            ->OfUser()
                            ->first();
        }
        if ($options['task'] == 'get-item-last') {
            $result = self::select('id','code_order')->orderBy('id', 'DESC')->first()->toArray();
        }
        return $result;
    }
    public function sumColumItems($params = null, $options  = null){
        $result = null;
        if($options['task'] == 'admin-sum-money-items-group-by-total-in-user-sell') {
            $query = $this::select('id','total','created_at','status_order','user_sell')
                            ->where('id','>',1);
            if(isset($params['user_sell'])){
                $query->where('user_sell',$params['user_sell']);
            }
            if(isset($params['filter_in_day'])){
                $query->whereBetween('created_at', ["{$params['filter_in_day']['day_start']}", "{$params['filter_in_day']['day_end']}"]);
            }
            $result = $query->get()->sum('total');
        }
        return $result;
    }
    public function countItems($params = null, $options  = null) {
        $result = null;
        if($options['task'] == 'admin-count-items-group-by-status-order') {
            $query = $this::groupBy('status_order')
                            ->select(DB::raw('status_order , COUNT(id) as count') )
                            ->where('id','>',1);
            if ((isset($params['code_ref']))) {
                $codeRef=$params['code_ref'];
                if($params['user_type_id'] > 4){
                    $query = $query->OfUser()
                    ->orWhere('info_product', 'LIKE', "%$codeRef%");
                }else{
                    $query = $query->where('info_product', 'LIKE', "%$codeRef%");
                }
            }else{
                $query=$query->OfUser();
            }
            $query = $this->search($query, $params);
            $result = $query->get()->toArray();
        }
        if($options['task'] == 'admin-count-items-status-order') {
            $query = $this::groupBy('status_order')
                            ->select(DB::raw('status_order , COUNT(id) as count') )
                            ->where('id','>',1)->where('status_order',$params['status_order']);
            if ((isset($params['code_ref']))) {
                $codeRef=$params['code_ref'];
                if($params['user_type_id'] > 4){
                    $query = $query->OfUser()
                    ->orWhere('info_product', 'LIKE', "%$codeRef%");
                }else{
                    $query = $query->where('info_product', 'LIKE', "%$codeRef%");
                }
            }else{
                $query=$query->OfUser();
            }
            $result = $query->get()->toArray();
        }
        if($options['task'] == 'admin-count-items-of-user-sell') {
            $query = $this::groupBy('user_sell')
                            ->select(DB::raw('user_sell , COUNT(id) as count') )
                            ->where('id','>',1)->where('user_sell',$params['user_sell']);
            if(isset($params['status_order'])){
                if($params['status_order']!='all'){
                    $query->where('status_order',$params['status_order']);
                }
            }
            if(isset($params['filter_in_day'])){
                $query->whereBetween('created_at', ["{$params['filter_in_day']['day_start']}", "{$params['filter_in_day']['day_end']}"]);
            }
            $result = $query->get()->toArray();
        }
        return $result;
    }
    public function saveItem($params = null, $options = null)
    {
        if ($options['task'] == 'frontend-save-item'){
            DB::beginTransaction();
            try {
                $this->setCreatedHistory($params);
                $params['buyer'] = json_encode($params['buyer']);
                //$params['invoice'] = isset($params['export_tax'])?json_encode($params['invoice']) :null;
                if ($params['delivery_method'] == 1){ //Nhận hàng tại nhà thuốc
                    $params['pharmacy'] = json_encode($params['pharmacy']);
                    $params['receive'] = null;
                }else{
                    $province = ProvinceModel::find($params['receive']['province_id']);
                    $district = DistrictModel::find($params['receive']['district_id']);
                    $ward = WardModel::find($params['receive']['ward_id']);
                    $address = $params['receive']['address'];
                    if ($ward) {
                        $address .= ', ' . $ward->name; 
                    }
                    if ($district) {
                        $address .= ', ' . $district->name;
                    }
                    if ($province) {
                        $address .= ', ' . $province->name;
                    }
                    $params['address_detail'] = $address;
                    $params['pharmacy'] = null;
                    $params['receive'] = json_encode($params['receive']);
                }
                $cart = \Session::get('cart');
                //$params['info_product'] = $cart[$params['user_sell']]['product'];
                $params['info_product'] = json_encode($params['info_product']);
                $params['total'] = $cart[$params['user_sell']]['total'];
                $params['total_product'] = $cart[$params['user_sell']]['total_product'];
                $paramsCode = [
                    'type' => 'order',
                    'value' => date('Ymd')
                ];
                $params['code_order'] ='DHTD' . date('Ymd') . sprintf("%05d",self::getMaxCode($paramsCode));
                self::insert($this->prepareParams($params));

                //Cập nhật khách hàng
                // $customer = CustomerShopModel::where('user_id',$params['user_id'])
                //                             ->where('user_sell',$params['user_sell'])
                //                             ->first();
                // if (empty($customer)){
                //     CustomerShopModel::insert([
                //         'user_id' => $params['user_id'],
                //         'user_sell' => $params['user_sell']
                //     ]);
                // }

                DB::commit();
                return true;
            } catch (\Throwable $th) {
                DB::rollback();
                throw $th;
                return false;
            }
        }
        if ($options['task'] == 'api-save-item'){
            DB::beginTransaction();
            try {
                $this->setCreatedHistory($params);
                $params['buyer'] = json_encode($params['buyer']);
                $params['receive'] = json_encode($params['receive']);
                $params['info_product'] = json_encode($params['info_product']);
                $paramsCode = [
                    'type' => 'order',
                    'value' => date('Ymd')
                ];
                $params['code_order'] ='DHTD' . date('Ymd') . sprintf("%05d",self::getMaxCode($paramsCode));
                self::insert($this->prepareParams($params));
                DB::commit();
                return $params['code_order'];
            } catch (\Throwable $th) {
                DB::rollback();
                throw $th;
                return false;
            }
        }
        if($options['task'] == 'change-status-order') {
            $params['status_order'] = $params['currentValue'];
            $this->setModifiedHistory($params);
            self::where('id', $params['id'])->update($this->prepareParams($params));
            if ($params['currentValue'] == 'hoanTat'){ // Cập nhật lại số lượng đơn hàng

            }
        }
        if ($options['task'] == 'update-item'){
            DB::beginTransaction();
            try {
                $this->setModifiedHistory($params);
                self::where('id', $params['id'])->update($this->prepareParams($params));
                $item = self::getItem(['id' => $params['id']], ['task' => 'get-item']);
                if ($params['status_order'] == 'hoanTat'){ // Cập nhật lại số lượng đơn hàng
                    (new ProductWarehouseModel())->saveItem(['warehouse_id'=>$params['warehouse_id'],'list_products'=>$item->info_product],['task' => 'output-warehouse']);
                    if(!empty($item->user_id)){
                        $currentUser= (new UsersModel())->getItem(['user_id'=>$item->user_id],['task'=>'get-item']);
                        if ($currentUser && isset($currentUser->reward_points)) {
                            $rewardPoints=$currentUser->reward_points + 10;
                        (new UsersModel())->saveItem(['user_id'=>$currentUser->user_id,'reward_points' => $rewardPoints], ['task' => 'update-item-api']);
                        }
                    }
                    // cập nhật điểm thưởng cho affiliate nếu có
                    $listProductOrder=$item->listProductInOrder();
                    foreach($listProductOrder as $productOrder){
                        if(!empty($productOrder->code_ref)){
                            $currentUser= (new UsersModel())->getItem(['codeRef'=>$productOrder->code_ref],['task'=>'get-item-code-ref']);
                            if ($currentUser && isset($currentUser->reward_points)) {
                                $rewardPoints=$currentUser->reward_points + 10;
                                (new UsersModel())->saveItem(['user_id'=>$currentUser->user_id,'reward_points' => $rewardPoints], ['task' => 'update-item-api']);
                            }
                        }
                    }
                }
                DB::commit();
                return true;
            } catch (\Throwable $th) {
                DB::rollback();
                throw $th;
                return false;
            }
        }
    }

    public function userBuy(){
        return $this->belongsTo('App\Model\Shop\UsersModel','user_id','user_id');
    }
    public function userSell(){
        return $this->belongsTo('App\Model\Shop\UsersModel','user_sell','user_id');
    }
    public function listProductInOrder(){
        return $this->hasMany('App\Model\Shop\OrderProductModel','order_id','id');
    }
}
