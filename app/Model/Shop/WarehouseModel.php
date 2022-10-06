<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;
use App\Model\Shop\BackEndModel;
use App\Model\Shop\Tinhthanhpho;
use App\Model\Shop\Quanhuyen;
use Session;
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
            return  $query->where('user_id',$user->user_id);
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
                        ->where('id','>',1)
                        ->OfUser()
                        ->orderBy('name', 'asc');
            $result = $query->pluck('name', 'id')->toArray();
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
    public function getItem($params = null, $options = null) {
        $result = null;
        if($options['task'] == 'get-item') {
            $user = Session::get('user');
            $query = self::select('id', 'name','local','address','province_id','district_id','ward_id')
                            ->where('id', $params['id'])
                            ->OfUser();
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
            self::find($id)->productWarehouse()->attach($productIDs);
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
    public function productWarehouse()
    {
        return $this->belongsToMany(ProductModel::class,'product_warehouse','warehouse_id','product_id');
    }
}
