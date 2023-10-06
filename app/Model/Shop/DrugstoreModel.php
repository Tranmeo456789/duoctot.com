<?php

namespace App\Model\Shop;

use App\Model\Shop\BackEndModel;
use DB;

class DrugstoreModel extends BackEndModel
{
    protected $connection = 'mysql_share_data';
    protected $primaryKey = "drugstore_id";
    public function __construct() {
        $this->table               = 'drugstore';
    }

    public function listItems($params = null, $options = null){
        $result = [];

        if ($options['task'] == 'list-items-for-search'){
            $query = self::select('drugstore.drugstore_id as id','drugstore.drugstore_name as name','drugstore.profile_image',
            'drugstore.drugstore_address as address','drugstore.drugstore_url',
            'drugstore.created_at');

            if (isset($params['province']) && $params['province'] != ''){
                $query->where('province_id', $params['province']);
            }

            $result = $query->orderBy("$this->table.drugstore_id", 'desc')
                        ->paginate($params['limit']);
        }
        return $result;
    }

}

