<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;
use App\Model\Shop\BackEndModel;
use Illuminate\Support\Facades\Log;
class PrescriptionModel extends BackEndModel
{
    protected $casts = [
        'info_product'   => 'array'
    ];
    public function __construct() {
        $this->table               = 'prescriptions';
        $this->controllerName      = 'prescription';
        $this->folderUpload        = '' ;
        $this->crudNotAccepted     = ['_token','btn_save'];
    }

    public function listItems($params = null, $options = null) {
        $result = null;
        if($options['task'] == "user-list-items") {
            $query = $this::select('id', 'code','phone','fullname','address','created_by', 'created_at', 'updated_at');
            $result =  $query->orderBy('id', 'desc')
                            ->paginate($params['pagination']['totalItemsPerPage']);
        }
        if($options['task'] == "admin-list-items-in-selectbox") {
            $query = $this->select('id', 'fullname');
            if (isset($params['arrID'])){
                $query->whereIn('id', $params['arrID']);
            }
            $result = $query->orderBy('id', 'asc')
                            ->pluck('fullname', 'id')->toArray();
        }
        return $result;
    }
    public function getItem($params = null, $options = null) {
        $result = null;
        if($options['task'] == 'get-item') {
            $result = self::select('id', 'code','phone','fullname','date_birth','weight','gender','number_bhyt','cccd','phone','info_product','user_id','address','note','created_by','updated_by', 'created_at', 'updated_at')
                            ->where('id', $params['id'])->first();
        }
        return $result;
    }
    public function saveItem($params = null, $options = null) {

        if($options['task'] == 'add-item') {
            $this->setCreatedHistory($params);
            self::insert($this->prepareParams($params));
        }

        if($options['task'] == 'edit-item') {
            $this->setModifiedHistory($params);
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }
    }
    public function deleteItem($params = null, $options = null)
    {
        if($options['task'] == 'delete-item') {
           self::where('id', $params['id'])->delete();
        }
    }
}
