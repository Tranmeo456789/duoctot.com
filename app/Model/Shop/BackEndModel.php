<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DB;
use Illuminate\Support\Facades\Auth as Auth;

class BackEndModel extends Model
{

    public $timestamps = false;
    protected $controllerName   = '';
    protected $table            = '';
    protected $folderUpload     = '' ;
    protected $fieldSearchAccepted   = [
      'name'
    ];

    protected $crudNotAccepted = [
        '_token',
    ];

    public function prepareParams($params){
        return array_diff_key($params, array_flip($this->crudNotAccepted));
    }
    public function setCreatedHistory(&$params){
      $params['created_at']    = date('Y-m-d');
    }
    public function setModifiedHistory(&$params){
      $params['updated_at']    = date('Y-m-d');
    }
}
