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

    public function listItems($params = null, $options = null) {
        $result = null;
        $user = Session::get('user');
        if($options['task'] == "user-list-items") {
            $query = $this::select('id', 'name','local', 'created_at', 'updated_at');

            $result =  $query->orderBy('id', 'desc')->where('user_id',$user->user_id)
                            ->paginate($params['pagination']['totalItemsPerPage']);

        }
        return $result;
    }
    public function getItem($params = null, $options = null) {
        $result = null;
        if($options['task'] == 'get-item') {
            $result = self::select('id', 'name','local')
                            ->where('id', $params['id'])->first();
        }
        return $result;
    }
    public function saveItem($params = null, $options = null) {

        if($options['task'] == 'add-item') {
            $this->setCreatedHistory($params);
            $wards=Xaphuongthitran::where('xaid',(int)$params['wards'])->get();      
             $ward=$wards[0]->name; 
             $districts=Quanhuyen::where('maqh',(int)$params['district'])->get(); 
             $district=$districts[0]->name;
             $local1s=Tinhthanhpho::where('matp',(int)$params['local'])->get(); 
             $local1=$local1s[0]->name;
            $local=$ward.','.$district.','.$local1;
            self::insert([
                'name' => $params['name'],
                'local' => $local,      
            ]);
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
