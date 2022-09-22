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
    public function getMaxCode($params = null, $options = null){
      $member =  DB::connection('mysql_share_data')
                    ->table('generated_code')
                    ->select('max_code')
                    ->where('type',$params['type'])
                    ->where('value',$params['value'])
                    ->first();
      if ($member){
          $member_id = $member->max_code + 1;
          DB::connection('mysql_share_data')
              ->table('generated_code')
              ->where('type',$params['type'])
              ->where('value',$params['value'])
              ->update(['max_code' => $member_id]);
      }else{
          $params['max_code'] = 1;
          DB::connection('mysql_share_data')
              ->table('generated_code')
              ->insert($params);
          $member_id = 1;
      }
      return $member_id;
    }
}
