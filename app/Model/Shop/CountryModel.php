<?php

namespace App\Model\Shop;

use App\Model\Shop\BackEndModel;
use DB;

class CountryModel extends BackEndModel
{
    public function __construct() {
        $this->table               = 'country';
        $this->folderUpload        = '' ;
        $this->fieldSearchAccepted = ['name'];
        $this->crudNotAccepted     = ['_token','filter_status','search_field','search_value','page','currentStatus'];
    }

    public function listItems($params = null, $options = null) {
        $result = null;


        if($options['task'] == "admin-list-items-in-selectbox") {
            $query = $this->select('id', 'name')
                        ->where('status', '=', 'active' );
            if (isset($params['group_id'])){
                $query->whereIn('id',$params['group_id']);
            }
            $result = $query->orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        }

        return $result;
    }
}

