<?php

namespace App\Model\Shop;

use App\Model\Shop\BackEndModel;
use DB;
use Illuminate\Support\Facades\Cache;
class WardModel extends BackEndModel
{
    public function __construct() {
        $this->table               = 'ward';
    }

    public function listItems($params = null, $options = null)
    {
        $result = null;
        if ($options['task'] == "admin-list-items-in-selectbox") {
            $parentID = $params['parentID'] ?? 0; // district_id
            $cacheKey = "duoctot_wards_of_district_{$parentID}";
            $result = Cache::remember($cacheKey, 86400, function () use ($parentID) { // cache 1 ngày
                $query = $this->select('id', 'name')->orderBy('name', 'asc');
                if ($parentID) {
                    $query->where('district_id', $parentID);
                }
                return $query->pluck('name', 'id')->toArray();
            });
        }
        if ($options['task'] == "list-items-in-selectbox-api") {
            $parentID = $params['parentID'] ?? 0;
            $cacheKey = "duoctot_wards_of_district_api_{$parentID}";

            $result = Cache::remember($cacheKey, 86400, function () use ($parentID) {
                $query = $this->select('id', 'name')->orderBy('name', 'asc');
                if ($parentID) {
                    $query->where('district_id', $parentID);
                }
                return $query->get()->toArray();
            });
        }
        return $result;
    }
    public function getItem($params = null, $options = null) {
        $result = null;
        if($options['task'] == 'get-item-full') {
            $result = self::with(['district','district.province'])
                            ->select('id', 'name','district_id')
                            ->where('id', $params['id'])->first();
        }
        return $result;
    }
    public function district(){
        return $this->belongsTo('App\Model\Shop\DistrictModel','district_id');
    }
}

