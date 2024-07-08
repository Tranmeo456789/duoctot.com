<?php

namespace App\Model\Shop;

use App\Model\Shop\BackEndModel;
use App\Model\Shop\PostModel;
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
            $query = self::select('id','name','name_url');
            if (isset($params['id'])){
                $query=$query->where('id', $params['id']);
            }
            if (isset($params['name_url'])){
                $query=$query->where('name_url', $params['name_url']);
            }
            $result=  $query->first();
        }
        return $result;
    }
}

