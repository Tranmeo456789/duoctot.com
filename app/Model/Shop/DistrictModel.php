<?php

namespace App\Model\Shop;

use App\Model\Shop\BackEndModel;
use DB;

class DistrictModel extends BackEndModel
{
    //protected $connection = 'mysql_share_data';
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
    public function getItem($params = null, $options = null) {
        $result = null;
        if($options['task'] == 'get-item-full') {
            $result = self::where('id', $params['id'])->first();
        }
        return $result;
    }
    public function province(){
        return $this->belongsTo('App\Model\Shop\ProvinceModel','province_id','id');
    }
    public function ward(){
        return $this->hasMany('App\Model\Shop\WardModel', 'district_id', 'id');
    }
}

