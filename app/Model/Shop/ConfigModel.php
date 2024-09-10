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
    public function listItems($params = null, $options = null){
        $result = [];
        if ($options['task'] == 'list-items'){
            $result = self::select()
                        ->whereIn('name',['hotline','amount_one_minute','amount_one_sms'])
                        ->get();
        }
        if ($options['task'] == 'list-items-payment-info'){
            $result = self::select()
                        ->where('name','payment_info')
                        ->first()->toArray();
            $result['content'] =  json_decode($result['content'], true);
        }

        return $result;
    }
}

