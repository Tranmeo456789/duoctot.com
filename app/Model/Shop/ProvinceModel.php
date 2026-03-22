<?php

namespace App\Model\Shop;

use App\Model\Shop\BackEndModel;
use DB;
use Illuminate\Support\Facades\Cache;
class ProvinceModel extends BackEndModel
{
    public function __construct() {
        $this->table               = 'province';
        $this->folderUpload        = '' ;

    }

    public function listItems($params = null, $options = null)
    {
        $result = null;
        if ($options['task'] == "admin-list-items-in-selectbox") {
            return Cache::remember('duoctot_province_selectbox_admin', 86400, function () {
                return $this->select('id', 'name')
                    ->orderBy('name', 'asc')
                    ->pluck('name', 'id')
                    ->toArray();
            });
        }
        if ($options['task'] == "list-items-in-selectbox-api") {
            return Cache::remember('duoctot_province_selectbox_api', 86400, function () {
                return $this->with('districts')
                    ->select('id', 'name')
                    ->orderBy('name', 'asc')
                    ->get();
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
    public function district(){
        return $this->hasMany('App\Model\Shop\DistrictModel', 'province_id', 'id');
    }
    public function districts()
    {
        return $this->hasMany('App\Model\Shop\DistrictModel', 'province_id', 'id')
                    ->select('id', 'name', 'province_id') 
                    ->with(['ward:id,name,district_id']); 
    }
}

