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
}

