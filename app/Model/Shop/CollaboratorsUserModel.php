<?php

namespace App\Model\Shop;

use App\Model\Shop\BackEndModel;
use DB;
use Hash;
use App\Helpers\Format;

class CollaboratorsUserModel extends BackEndModel
{
    protected $primaryKey = "user_id";
    public function __construct() {
        $this->table               = 'collaborators_user';
        $this->folderUpload        = '' ;
        $this->crudNotAccepted     = ['_token','isnumber','password_confirmation','password_old','submit','btn-register','details','task'];
    }

}
