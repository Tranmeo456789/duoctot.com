<?php

namespace App\Model\Shop;

use App\Model\Shop\BackEndModel;
use DB;

class DistrictModel extends BackEndModel
{
    protected $connection = 'mysql_share_data';
    public function __construct() {
        $this->table               = 'district';
    }

    public function listItems($params = null, $options = null) {
        $result = null;
        if($options['task'] == "admin-list-items-in-selectbox") {
            $query = $this->select('id', 'name')
                        ->orderBy('name', 'asc');
            if (isset($params['parentID'])){
                $query->where('province_id', $params['parentID']);
            }
            $result = $query->pluck('name', 'id')->toArray();
        }

        return $result;
    }

    public function province(){
        return $this->belongsTo('App\Models\ProvinceModel','province_id')->select(array('id', 'name'));
    }
    public function ward(){
        return $this->hasMany('App\Models\WardModel', 'district_id', 'id');
    }
}

