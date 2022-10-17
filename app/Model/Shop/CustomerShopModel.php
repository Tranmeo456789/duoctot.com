<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;
use App\Model\Shop\BackEndModel;

class CustomerShopModel extends BackEndModel
{
    public function __construct() {
        $this->table               = 'customer_shop';
        $this->controllerName      = '';
        $this->folderUpload        = '' ;
        $this->crudNotAccepted     = ['_token','btn_save'];
    }


}
