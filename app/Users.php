<?php

namespace App;

use App\Model\Shop\BackEndModel;
use DB;
use Hash;
use App\Helpers\Format;

use Illuminate\Support\Str;
class Users extends BackEndModel
{
    protected $hidden = [
        'password'
    ];
    public function __construct() {
        $this->table               = 'user';
        $this->folderUpload        = '' ;
        $this->crudNotAccepted     = ['_token','isnumber','password_confirmation','password_old','submit','btn-register','task'];
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
                $details['slug']= Str::slug($params['fullname']);
                if (isset($details['sell_area'])){
                    $details['sell_area'] = ($details['sell_area'] != '')? json_encode($details['sell_area'],JSON_NUMERIC_CHECK ): NULL;;
                }
                $params['province_id'] = $details['province_id'];
                $user = self::where('user_id', $params['user_id'])->first();
                $params['details'] = json_encode($details,JSON_NUMERIC_CHECK);
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
    public function answers(){
    	return $this->hasOne('App\Answer','answer_user_id');
    }
    public function type(){
    	return $this->hasOne('App\UserType','user_type_id');
    }
    public function review(){
    	return $this->hasMany('App\Review','user_id');
    }
    public function doctor() {
    	return $this->hasOne('App\Doctor','user_id');
    }
    public function clinic(){
    	return $this->hasOne('App\Clinic','user_id');
    }
    public function orders(){
        return $this->hasMany('App\Model\UserOrder','user_id');
    }

    // Thắng add 20181107 start
    public function patient(){
        return $this->hasOne('App\Patient','user_id');
    }
}
