<?php

namespace App\Model\Shop;

use App\Model\Shop\BackEndModel;
use DB;

class ConfigModel extends BackEndModel
{
    protected $connection = 'mysql_share_data';
    public function __construct() {
        $this->table               = 'config';
        $this->folderUpload        = '' ;

    }
}

