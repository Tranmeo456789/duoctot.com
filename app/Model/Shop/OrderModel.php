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
            return  $query->where('user_sell',$user->user_id);
        }
        return $query;
    }

    public function listItems($params = null, $options = null)
    {
        $result = null;
        if ($options['task'] == "user-list-items") {
            $query = $this::with('userBuy')
                                ->select('id','code_order','total','created_at','status_order','user_id')
                                ->where('id','>',1)
                                ->OfUser();
            if ((isset($params['filter']['status_order'])) && ($params['filter']['status_order'] != 'all')) {
                $query = $query->where('status_order',$params['filter']['status_order']);
            }
            $result =  $query->orderBy('id', 'desc')
                              ->paginate($params['pagination']['totalItemsPerPage']);
        }
        return $result;
    }
    public function getItem($params = null, $options = null)
    {
        $result = null;
        if ($options['task'] == 'get-item') {
            $result = self::select('id','code_order','total','created_at','status_order','user_id',
                            'info_product','pharmacy','total_product')
                            ->where('id', $params['id'])
                            ->OfUser()
                            ->first();

        }
        if ($options['task'] == 'get-item-for-update-product-in-store') {
            $result = self::select('id','info_product')
                            ->where('id', $params['id'])
                            ->OfUser()
                            ->first();
        }
        return $result;
    }
    public function countItems($params = null, $options  = null) {

        $result = null;
        if($options['task'] == 'admin-count-items-group-by-status-order') {
            $query = $this::groupBy('status_order')
                            ->select(DB::raw('status_order , COUNT(id) as count') )
                            ->where('id','>',1)
                            ->OfUser();
            $query = $this->search($query, $params);
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
                $params['invoice'] = isset($params['export_tax'])?json_encode($params['invoice']) :null;
                if ($params['delivery_method'] == 1){ //Nhận hàng tại nhà thuốc
                    $params['pharmacy'] = json_encode($params['pharmacy']);
                    $params['receive'] = null;
                }else{
                    $params['pharmacy'] = null;
                    $params['receive'] = json_encode($params['receive']);
                }
                $cart = \Session::get('cart');
                $params['info_product'] = $cart[$params['user_sell']]['product'];
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
                $customer = CustomerShopModel::where('user_id',$params['user_id'])
                                            ->where('user_sell',$params['user_sell'])
                                            ->first();
                if (empty($customer)){
                    CustomerShopModel::insert([
                        'user_id' => $params['user_id'],
                        'user_sell' => $params['user_sell']
                    ]);
                }

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
                $params['created_at']    = date('Y-m-d H:i:s');
                $params['created_by'] =  $params['user_id'];

                $params['buyer'] = json_encode($params['buyer']);
                $params['invoice'] = (isset($params['export_tax']) && ($params['export_tax'] == 1))?$params['invoice'] :null;
                if ($params['delivery_method'] == 1){ //Nhận hàng tại nhà thuốc
                    $params['pharmacy'] = json_encode($params['pharmacy']);
                    $params['receive'] = null;
                }else{
                    $params['pharmacy'] = null;
                    $params['receive'] = json_encode($params['receive']);
                }

                // $params['info_product'] = $cart[$params['user_sell']]['product'];
                 $params['info_product'] = json_encode($params['info_product']);
                //$params['total'] = $cart[$params['user_sell']]['total'];
                //$params['total_product'] = $cart[$params['user_sell']]['total_product'];
                $paramsCode = [
                    'type' => 'order',
                    'value' => date('Ymd')
                ];
                $params['code_order'] ='DHTD' . date('Ymd') . sprintf("%05d",self::getMaxCode($paramsCode));
                self::insert($this->prepareParams($params));

                //Cập nhật khách hàng
                $customer = CustomerShopModel::where('user_id',$params['user_id'])
                                            ->where('user_sell',$params['user_sell'])
                                            ->first();
                if (empty($customer)){
                    CustomerShopModel::insert([
                        'user_id' => $params['user_id'],
                        'user_sell' => $params['user_sell']
                    ]);
                }

                DB::commit();
                return true;
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
                    (new ProductWarehouseModel())->saveItem(['warehouse_id'=>$params['warehouse_id'],
                    'list_products'=>$item->info_product],
                    ['task' => 'output-warehouse']);
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

}
