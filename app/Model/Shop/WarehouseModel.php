<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;
use App\Model\Shop\BackEndModel;
use App\Model\Shop\Tinhthanhpho;
use App\Model\Shop\Quanhuyen;
use Session;
use App\Model\Shop\Xaphuongthitran;
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
        $user = Session::get('user');
        if($options['task'] == "user-list-items") {
            $query = $this::select('id', 'name','address', 'created_at', 'updated_at');

            $result =  $query->orderBy('id', 'desc')->where('user_id',$user->user_id)
                            ->paginate($params['pagination']['totalItemsPerPage']);

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
            self::insert($this->prepareParams($params));
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
}
