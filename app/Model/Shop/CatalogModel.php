<?php

namespace App\Model\Shop;

use App\Model\Shop\BackEndModel;
use DB;

class CatalogModel extends BackEndModel
{
    protected $connection = 'mysql_share_data';
    protected $primaryKey = "catalog_id";
    public function __construct() {
        $this->table               = 'catalog';
    }
    public function listItems($params = null, $options = null) {
        $result = null;
        if($options['task'] == "admin-list-items-in-selectbox") {
            $query = $this->select('id', 'name');
            if (isset($params['arrID'])){
                $query->whereIn('id', $params['arrID']);
            }
            $result = $query->orderBy('id', 'asc')
                            ->pluck('name', 'id')->toArray();
        }
        return $result;
    }
    public function getItem($params = null, $options = null)
    {
        $result = null;
        if ($options['task'] == 'get-item') {
            $result = self::select('id','name')
                            ->where('id', $params['id'])
                            ->first();
        }
        return $result;
    }
}

