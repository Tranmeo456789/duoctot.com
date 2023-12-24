<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;
use App\Model\Shop\BackEndModel;
use App\Model\Shop\WarehouseModel;
use App\Model\Shop\ProductWarehouseModel;
use DB;
use App\Helpers\MyFunction;
class AffiliateModel extends BackEndModel
{
    protected $casts = [
        'info_product'   => 'array',
        'info_ref'=>'array'
    ];
    public function __construct() {
        $this->table               = 'affiliate';
        $this->controllerName      = 'affiliate';
        $this->folderUpload        = '' ;
        $filedSearch               = array_key_exists($this->controllerName, config('myconfig.config.search')) ? $this->controllerName : 'default';
        $this->fieldSearchAccepted = array_diff(config('myconfig.config.search.' . $filedSearch),['all']);
        $this->crudNotAccepted     = ['_token','btn_save'];
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
            $query = $this::select('id', 'code_ref', 'info_ref','info_product','user_id',
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
            $result = self::select('id', 'code_ref', 'info_ref','info_product','user_id',
            'created_at', 'updated_at')
                            ->where('id','>',0)
                            ->ofUser()
                            ->ofActive()
                            ->where('id', $params['id'])->first();
        }
        return $result;
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
                $list_products = $params['info_product'];
                if (count($list_products['product_id']) > 0){
                    $arrProduct = [];
                    foreach($list_products['product_id'] as $key=>$val){
                        $arrProduct[$list_products['product_id'][$key]] = [
                            'product_id' => $list_products['product_id'][$key],
                            'discount' => $list_products['discount'][$key],
                        ];
                    }
                    $list_products = $arrProduct;
                    $params['info_product'] = json_encode($arrProduct);
                }
                $params['info_ref']=json_encode($params['info_ref']);
                $params['user_id'] = '';
                
                self::insert($this->prepareParams($params));
                DB::commit();
                return true;
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

                $list_products = $params['info_product'];
                if (count($list_products['product_id']) > 0){
                    $arrProduct = [];
                    foreach($list_products['product_id'] as $key=>$val){
                        $arrProduct[$list_products['product_id'][$key]] = [
                            'product_id' => $list_products['product_id'][$key],
                            'discount' => $list_products['discount'][$key],
                        ];
                    }
                    $list_products = $arrProduct;
                    $params['info_product'] = json_encode($arrProduct);
                }
                $params['info_ref']=json_encode($params['info_ref']);
                $params['user_id'] = '';

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
            (new ProductWarehouseModel())->saveItem(['warehouse_id'=>$item->warehouse_id,
                                                            'list_products'=>$item->list_products],
                                                        ['task' => 'output-warehouse']);
        }
    }
    
}
