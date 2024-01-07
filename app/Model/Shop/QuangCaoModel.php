<?php

namespace App\Model\Shop;

use App\Model\Shop\BackEndModel;
use DB;

class QuangCaoModel extends BackEndModel
{
    protected $connection = 'mysql_share_data';
    protected $primaryKey = "id";
    public function __construct() {
        $this->table               = 'quangcao';
    }
}

