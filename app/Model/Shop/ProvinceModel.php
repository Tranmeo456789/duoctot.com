<?php

namespace App\Model\Shop;

use App\Model\Shop\BackEndModel;
use DB;

class ProvinceModel extends BackEndModel
{
    protected $connection = 'mysql_share_data';
    public function __construct() {
        $this->table               = 'province';
        $this->folderUpload        = '' ;

    }

    public function listItems($params = null, $options = null) {
        $result = null;
        if($options['task'] == "admin-list-items-in-selectbox") {
            $query = $this->select('id', 'name')
                        ->orderBy('name', 'asc');
            $result = $query->pluck('name', 'id')->toArray();
        }

        return $result;
    }

    public function district(){
        return $this->hasMany('App\Models\DistrictModel', 'province_id', 'id');
    }
}

