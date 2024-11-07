<?php

namespace App\Model\Shop;

use App\Model\Shop\BackEndModel;
use DB;
use Hash;
use App\Helpers\Format;

class UserTokenModel extends BackEndModel
{
    public function __construct() {
        $this->table               = 'user_token';
        $this->folderUpload        = '' ;
        $this->crudNotAccepted     = ['_token','isnumber','password_confirmation','password_old','submit','btn-register'];
    }
    public function saveItem($params = null, $options = null)
    {
        if ($options['task'] == 'add-item') {
            self::setCreatedHistory($params);
            $tokenId = self::insertGetId ($this->prepareParams($params));
        }
        if ($options['task'] == 'edit-item') {
            $this->setModifiedHistory($params);
            self::getItem($params,['task'=>'get-item']);
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }
    }
}
