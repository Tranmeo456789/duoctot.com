<?php

namespace App\Model\Shop;

use App\Model\Shop\BackEndModel;
use DB;

class MyTableModel extends BackEndModel
{
    protected $primaryKey = "A";
    public function __construct() {
        $this->table               = 'mytable';
    }
}

