<?php

namespace App\Model\Shop;

use App\Model\Shop\BackEndModel;
use DB;

class QuangCaoModel extends BackEndModel
{
    protected $primaryKey = "id";
    public function __construct() {
        $this->table               = 'quangcao';
    }
    public function listItems($params = null, $options = null)
    {
        $result = null;
        if ($options['task'] == "list-items-api") {
            $query = $this::select('id','name','banner_mobile','product_id');
            if (isset($params['group_id'])){
                $query->whereIn('id',$params['group_id']);
            }
            if (isset($params['pagination']['totalItemsPerPage'])){
                $result =  $query->paginate($params['pagination']['totalItemsPerPage']);
            }else{
                $result = $query->get();
            }
        }
        return $result;
    }
}

