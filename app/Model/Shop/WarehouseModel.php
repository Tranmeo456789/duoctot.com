<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;
use App\Model\Shop\BackEndModel;
use App\Model\Shop\Tinhthanhpho;
use App\Model\Shop\Quanhuyen;
use Session;
use DB;
use App\Model\Shop\Xaphuongthitran;
use App\Model\Shop\ProductModel;
class WarehouseModel extends BackEndModel
{
    public function __construct() {
        $this->table               = 'warehouses';
        $this->controllerName      = 'warehouse';
        $this->folderUpload        = '' ;
        $this->crudNotAccepted     = ['_token','btn_save'];
    }
    public function scopeOfUser($query)
    {
        if (\Session::has('user')){
            $user = \Session::get('user');
            if($user['is_admin']==1){
                return  $query;
            }else{
                return  $query->where('user_id',$user->user_id);
            }        
        }
        return $query;
    }
    public function listItems($params = null, $options = null) {
        $result = null;
        if($options['task'] == "user-list-items") {
            $query = $this::select('id', 'name','address', 'created_at', 'updated_at')
                                ->where('id','>',1)
                                ->OfUser();
            $result =  $query->orderBy('id', 'desc')
                            ->paginate($params['pagination']['totalItemsPerPage']);

        }
        if ($options['task'] == 'user-list-all-items'){
            $result = $this::selectRaw("id as warehouse_id")
                                    ->where('id','>',1)
                                    ->ofUser()
                                    ->get()
                                    ->toArray();
        }
        if($options['task'] == "admin-list-items-in-selectbox") {
            $query = $this->select('id', 'name')
                        ->where('id','>',1);
            if(isset($params['user_id'])){
                $query=$query->where('user_id',$params['user_id']);
            }
            $result = $query->orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        }
        if ($options['task'] == 'frontend-list-items'){
            $query = $this::with(['province','district'])
                                ->select('id', 'name','address','province_id','district_id')
                                ->where('id','>',1)
                                ->where('user_id',$params['user_id']);
            if (isset($params['filter']['province_id']) && ($params['filter']['province_id'] != 0)){
                $query->where('province_id',$params['filter']['province_id']);
            }
            if (isset($params['filter']['district_id']) && ($params['filter']['district_id'] != 0)){
                $query->where('district_id',$params['filter']['district_id']);
            }

            $result = $query->get();
        }
        return $result;
    }
    public function listItemsNoPaginate(){
        $result = null;
        $user = Session::get('user');
        $query = $this::select('id', 'name','local','user_id','product_id', 'created_at', 'updated_at');
        $result =  $query->orderBy('id', 'desc')->where('user_id',$user->user_id)->get();
        return $result;
    }
    public function countItems($params = null, $options  = null) {
        $result = null;
        if($options['task'] == 'admin-count-items-group-by-user-id') {
            $query = $this::groupBy('user_id')
                            ->select(DB::raw('user_id , COUNT(id) as count'))
                            ->where('id','>',1);
            if(isset($params['user_id'])){
                $query->where('user_id',$params['user_id']);
            }           
            if(isset($params['filter_in_day'])){
                $query->whereBetween('created_at', ["{$params['filter_in_day']['day_start']}", "{$params['filter_in_day']['day_end']}"]);
            }
            $result = $query->get()->toArray();
        }
        return $result;
    }
    public function getItem($params = null, $options = null) {
        $result = null;
        if($options['task'] == 'get-item') {
            $user = Session::get('user');
            $query = self::select('id', 'name','local','address','province_id','district_id','ward_id')
                            ->where('id', $params['id'])
                            ->OfUser();
            $result =  $query->first();
        }
        if($options['task'] == 'get-item-of-id') {
            $query = self::select('id', 'name','local','address','province_id','district_id','ward_id')
                            ->where('id', $params['id']);
            $result =  $query->first();
        }
        return $result ;
    }
    public function saveItem($params = null, $options = null) {

        if($options['task'] == 'add-item') {
            $this->setCreatedHistory($params);
            $itemWard = (new WardModel())->getItem(['id'=>$params['ward_id']],['task' => 'get-item-full']);
            $params['address'] = ($params['local'] != '')?$params['local'] . ', ':'';
            $params['address'] .= $itemWard->name . ', ' . $itemWard->district->name . ', ' . $itemWard->district->province->name;
            $user = Session::get('user');
            $params['user_id'] = $user->user_id;
            $id = self::insertGetId ($this->prepareParams($params));
            $productIDs = (new ProductModel())->listItems(null,['task' =>'user-list-all-items']);
            self::find($id)->products()->attach($productIDs);
        }

        if($options['task'] == 'edit-item') {
            $this->setModifiedHistory($params);
            $itemWard = (new WardModel())->getItem(['id'=>$params['ward_id']],['task' => 'get-item-full']);
            $params['address'] = ($params['local'] != '')?$params['local'] . ', ':'';
            $params['address'] .= $itemWard->name . ', ' . $itemWard->district->name . ', ' . $itemWard->district->province->name;
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }

        if($options['task'] == 'update-product') {
            self::where('id', $params['id'])->update(
                [
                    'product_id' => $params['product_id']
                ]
            );
        }
    }
    public function deleteItem($params = null, $options = null)
    {
        if($options['task'] == 'delete-item') {
           self::where('id', $params['id'])->delete();
        }
    }
    public function products()
    {
        return $this->belongsToMany(ProductModel::class,'product_warehouse','warehouse_id','product_id');
    }
    public function district(){
        return $this->belongsTo('App\Model\Shop\DistrictModel','district_id');
    }
    public function province(){
        return $this->belongsTo('App\Model\Shop\ProvinceModel','province_id','id');
    }
}
