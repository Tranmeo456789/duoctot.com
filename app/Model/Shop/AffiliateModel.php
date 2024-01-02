<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;
use App\Model\Shop\BackEndModel;
use App\Model\Shop\WarehouseModel;
use App\Model\Shop\OrderModel;
use App\Model\Shop\ProductWarehouseModel;
use DB;
use App\Helpers\MyFunction;
class AffiliateModel extends BackEndModel
{
    protected $casts = [
        'info_bank' => 'array'
    ];
    public function __construct() {
        $this->table               = 'affiliate';
        $this->controllerName      = 'affiliate';
        $this->folderUpload        = '' ;
        $filedSearch               = array_key_exists($this->controllerName, config('myconfig.config.search')) ? $this->controllerName : 'default';
        $this->fieldSearchAccepted = array_diff(config('myconfig.config.search.' . $filedSearch),['all']);
        $this->crudNotAccepted     = ['_token','btn_save','password','fullname','phone','info_product'];
    }
    public function scopeOfUser($query)
    {
        if (\Session::has('user')){
            $user = \Session::get('user');
            if($user['is_admin']==1 || $user['is_admin']==2){
                return  $query;
            }else{
                return  $query->where('user_id',$user->user_id);
            }
        }
        return $query;
    }
    public function scopeOfActive($query)
    {
        return  $query->whereNull('deleted_by');
    }
    public function listItems($params = null, $options = null) {
        $result = null;
        if($options['task'] == "user-list-items") {
            $query = $this::select('id', 'code_ref','info_bank','link_comon','sum_click','user_id',
                                    'created_at', 'updated_at') ->where('id','>',1)
                            ->ofUser()->ofActive();
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
            $query->orderBy('created_at', 'desc');
            if (isset($params['pagination']['totalItemsPerPage'])){
                $result =  $query->paginate($params['pagination']['totalItemsPerPage']);
            }else{
                $result = $query->get();
            }
        }
        return $result;
    }
    public function getItem($params = null, $options = null) {
        $result = null;
        if($options['task'] == 'get-item') {
            $query = self::select('id', 'code_ref','info_bank','link_comon','sum_click','user_id',
            'created_at', 'updated_at')
                            ->where('id','>',0)
                            ->ofUser()
                            ->ofActive();
            if (isset($params['id'])){
                $query->where('id', $params['id']);
            }
            if (isset($params['code_ref'])){
                $query->where('code_ref', $params['code_ref']);
            }
            if (isset($params['user_id'])){
                $query->where('user_id', $params['user_id']);
            }
        }
        return $result= $query->first();
    }
    public function saveItem($params = null, $options = null) {
        if($options['task'] == 'add-item') {
            DB::beginTransaction();
            try {
                $this->setCreatedHistory($params);
                $paramsCode = [
                    'type' => 'affiliate',
                    'value' => date('Ymd')
                ];
                $params['code_ref'] = 'MDL' . date('Ymd') . sprintf("%05d",self::getMaxCode($paramsCode));
                self::insert($this->prepareParams($params));
                DB::commit();
                return $params['code_ref'];
            } catch (\Throwable $th) {
                DB::rollback();
                throw $th;
                return false;
            }
        }

        if($options['task'] == 'edit-item') {
            DB::beginTransaction();
            try {
                $this->setModifiedHistory($params);
                $item = self::find($params['id']);
                if(isset($params['info_bank'])){
                    $params['info_bank'] = json_encode($params['info_bank']);
                }
                self::where('id', $params['id'])->update($this->prepareParams($params));
                DB::commit();
                return true;
            } catch (\Throwable $th) {
                DB::rollback();
                throw $th;
                return false;
            }

        }
    }
    public function deleteItem($params = null, $options = null)
    {
        if($options['task'] == 'delete-item') {
            $item = self::find($params['id']);
            $item->deleted_at   = date('Y-m-d H:i:s');
            $item->deleted_by = \Session::get('user')['user_id'];
            $item->save();
        }
    }
    public function sumMoneyRefAffiliate($codeRef){
        $orders = OrderModel::select('info_product')->where('status_order','hoanTat')->get();
        $totalMoney = 0;
        foreach ($orders as $order) {
            $infoProductArray = $order->info_product;
            foreach($infoProductArray as $val){
                if ($val['codeRef'] == $codeRef) {
                    $discount=ProductModel::find($val['product_id'])->discount_ref;
                    $totalMoney+=($val['total_money']*$discount)/100;
                }
            }
            
        }
        return $totalMoney;
    }
    public function sumMoneyAProductRefAffiliate($codeRef,$idProduct){
        $orders = OrderModel::select('info_product')->where('status_order','hoanTat')->get();
        $totalMoney = 0;
        foreach ($orders as $order) {
            $infoProductArray = $order->info_product;
            foreach($infoProductArray as $val){
                if ($val['codeRef'] == $codeRef && $val['product_id']==$idProduct) {
                    $discount=ProductModel::find($val['product_id'])->discount_ref;
                    $totalMoney+=($val['total_money']*$discount)/100;
                }
            }
        }
        return $totalMoney;
    }
    public function sumQuantityRefAffiliate($codeRef){
        $orders = OrderModel::select('info_product')->where('status_order','hoanTat')->get();
        $sumQuantity = 0;
        foreach ($orders as $order) {
            $infoProductArray = $order->info_product;
            foreach($infoProductArray as $val){
                if ($val['codeRef'] == $codeRef) {
                    $sumQuantity+=$val['quantity'];
                }
            }
            
        }
        return $sumQuantity;
    }
    public function sumQuantityAProductRefAffiliate($codeRef,$idProduct){
        $orders = OrderModel::select('info_product')->where('status_order','hoanTat')->get();
        $sumQuantity = 0;
        foreach ($orders as $order) {
            $infoProductArray = $order->info_product;
            foreach($infoProductArray as $val){
                if ($val['codeRef'] == $codeRef && $val['product_id']==$idProduct) {
                    $sumQuantity+=$val['quantity'];
                }
            }
            
        }
        return $sumQuantity;
    }
    public function userRef(){
        return $this->belongsTo('App\Model\Shop\UsersModel','user_id','user_id');
    }
    public function listIdProduct(){
        return $this->hasMany('App\Model\Shop\AffiliateProductModel','code_ref','code_ref');
    }
}
