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
        $this->crudNotAccepted     = ['_token','isnumber','password_confirmation','password_old','submit','btn-register','details','task'];
    }
    public function getItem($params = null, $options = null) {
        $result = null;

        if($options['task'] == 'get-item') {
            $result = self::where('user_id', $params['user_id'])->first();
        }
        if($options['task'] == 'user-login') {
            if (isset($params['email'])){
                $result = self::where('email', $params['email'])->first();
            }else{
                $result = self::where('phone', $params['phone'])->first();
            }
            if ($result) {
                if (Hash::check($params['password'],$result['password'])){
                    return $result;
                }else{
                    return null;
                }
            }
        }
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
                $paramsCode = [
                    'type' => 'user_type_id',
                    'value' => $params[ 'user_type_id']
                ];
                $member_id = self::getMaxCode($paramsCode);
                $paramsUserValue =[
                    'user_id' =>$params['user_id'],
                    'user_field' =>'member_id',
                    'value' =>$member_id
                ];
                \App\Model\Shop\UserValuesModel::insert($this->prepareParams($paramsUserValue));
                return self::getItem(['user_id'=>$params['user_id']],['task' => 'get-item']);
            }
            return false;
        }
        if($options['task'] == 'update-item'){
            $details = $params['details'];
            $params['province_id'] =$details['province_id'];
            DB::beginTransaction();
            try {
                $details = $params['details'];
                if (isset($details['sell_area'])){
                    $details['sell_area'] = ($details['sell_area'] != '')? json_encode($details['sell_area'],JSON_NUMERIC_CHECK ): NULL;;
                }
                $params['province_id'] = $details['province_id'];
                $user = self::where('user_id', $params['user_id'])->first();
                self::where('user_id', $params['user_id'])->update($this->prepareParams($params));
                $paramsUserValue =[];
                \App\Model\Shop\UserValuesModel::where('user_id', $params['user_id'])->delete();
                foreach ($details as $key => $value){
                    $paramsUserValue =[
                        'user_id' =>$params['user_id'],
                        'user_field' =>$key,
                        'value' =>$value
                    ];
                    \App\Model\Shop\UserValuesModel::insert($this->prepareParams($paramsUserValue));
                }
                DB::commit();
                return true;
            } catch (\Throwable $th) {
                DB::rollback();
                return false;
                throw $th;
            }
        }
        if($options['task'] == 'change-password') {
            DB::beginTransaction();
            try {
                $password       = Hash::make($params['password']);
                self::where('user_id', $params['user_id'])->update(['password' => $password]);
                DB::commit();
                return true;
            } catch (\Throwable $th) {
                DB::rollback();
                return false;
                throw $th;
            }

        }
    }
    public function details()
    {
        return $this->hasMany(\App\Model\Shop\UserValuesModel::class,'user_id','user_id')
                    ->select('user_id','user_field','value');
    }
    public function listItems($params = null, $options = null)
    {
        $result = null;
        if($options['task'] == "list-store-select-province") {
            $result =  self::where([
                ['user_type_id', $params['user_type_id']],
                ['province_id', $params['province_id']]
            ])->get();                    
        }
        if($options['task'] == "list-store-select-district") {
            $result =  self::where([
                ['user_type_id', $params['user_type_id']],
                ['district_id', $params['district_id']]
            ])->get();                    
        }
        if($options['task'] == "list-user-all") {
            $query = $this::select('user_id','email','fullname','phone','user_type_id','gender');
            $query->orderBy('user_id', 'desc');
            if (isset($params['pagination']['totalItemsPerPage'])){
                $result =  $query->paginate($params['pagination']['totalItemsPerPage']);
            }else{
                $result = $query->get();
            }              
        }
        return $result;
    }
    public function type_user($type_user_id=1)
    {
        $type_user = '';
        switch ($type_user_id)
        {
            case 2 :
                $type_user = 'Bác sĩ';
                break;
            case 3:
                $type_user = 'Phòng khám';
                break;
            case 4:
                $type_user = 'Nhà thuốc';
                break;
            default:
            $type_user = 'Bệnh nhân';
                break;
        }
        return $type_user;

    }
}
