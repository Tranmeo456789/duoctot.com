<?php

namespace App\Model\Shop;

use App\Model\Shop\BackEndModel;
use DB;
use Hash;
use App\Helpers\Format;

class UsersModel extends BackEndModel
{
    protected $connection = 'mysql_share_data';
    protected $hidden = [
        'password'
    ];
    public function __construct() {
        $this->table               = 'user';
        $this->folderUpload        = '' ;
        $this->crudNotAccepted     = ['_token','isnumber','password_confirmation','password_old','submit','btn-register'];
    }
    public function getItem($params = null, $options = null) {
        $result = null;

        if($options['task'] == 'get-item') {
            $query = self::where('user_id', $params['user_id']);
        }
        $result = $query->first();
        return $result;
    }
    public function saveItem($params = null, $options = null) {

        if($options['task'] == 'register') {
            $params['password']  = Hash::make($params['password']);
            if (!isset($params['user_type_id']) || $params['user_type_id'] == ''){
                $params['user_type_id'] = 1;
            }
            $params['user_id'] = $this->insertGetId($this->prepareParams($params));
            if (is_numeric($params['user_id'])){
                return self::getItem(['user_id'=>$params['user_id']],['task' => 'get-item']);
            }
            return false;
        }
    }


}
