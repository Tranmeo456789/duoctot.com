<?php

namespace App\Model\Shop;

use App\Model\Shop\BackEndModel;
use DB;
use Illuminate\Support\Facades\Cache;
class DistrictModel extends BackEndModel
{
    public function __construct() {
        $this->table               = 'district';
    }

    public function listItems($params = null, $options = null)
    {
        $result = null;
        if (in_array($options['task'], ["admin-list-items-in-selectbox", "list-items-in-selectbox-api"])) {
            $parentID = $params['parentID'] ?? 0;
            $cacheKey = "duoctot_districts_of_province_{$parentID}";
            $result = Cache::remember($cacheKey, 86400, function () use ($parentID) { 
                $query = $this->select('id', 'name')
                    ->orderBy('name', 'asc');

                if ($parentID) {
                    $query->where('province_id', $parentID);
                }
                return $query->pluck('name', 'id')->toArray();
            });
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

