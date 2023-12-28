<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;
use App\Model\Shop\BackEndModel;
use DB;
use App\Helpers\MyFunction;
class CouponPaymentModel extends BackEndModel
{
    protected $casts = [
    ];
    public function __construct() {
        $this->table               = 'coupon_payment';
        $this->controllerName      = 'couponPayment';
        $this->folderUpload        = '' ;
        $this->crudNotAccepted     = ['_token','btn_save'];
    }
    public function scopeOfUser($query)
    {
        if (\Session::has('user')){
            $user = \Session::get('user');
            if($user['is_admin']==1 || $user['is_admin']==2){
                return  $query;
            }else{
                return  $query->where('user_id',$user->user_id);
            }
        }
        return $query;
    }
    public function scopeOfActive($query)
    {
        return  $query->whereNull('deleted_by');
    }
    public function listItems($params = null, $options = null) {
        $result = null;
        if($options['task'] == "user-list-items") {
            $query = $this::with('userRef')->select('id', 'code_ref', 'date','money','user_id',
                                    'created_at', 'updated_at')
                                    ->where('id','>',0);
            $result =  $query->ofUser()
                            ->ofActive()
                            ->orderBy('id', 'desc')
                            ->paginate($params['pagination']['totalItemsPerPage']);

        }
        return $result;
    }
    public function getItem($params = null, $options = null) {
        $result = null;
        if($options['task'] == 'get-item') {
            $result = self::select('id', 'code_ref', 'date','money','user_id',
                            'created_at', 'updated_at')
                            ->where('id','>',0)
                            ->ofUser()
                            ->ofActive()
                            ->where('id', $params['id'])->first();
        }
        return $result;
    }
    public function saveItem($params = null, $options = null) {
        if($options['task'] == 'add-item') {
            DB::beginTransaction();
            try {
                $this->setCreatedHistory($params);
                $paramsCode = [
                    'type' => 'import_coupon',
                    'value' => date('Ymd')
                ];
                $params['name'] = 'PTT' . date('Ymd') . sprintf("%05d",self::getMaxCode($paramsCode));
                $params['date'] = MyFunction::formatDateMySQL($params['date']);
                self::insert($this->prepareParams($params));
                DB::commit();
                return true;
            } catch (\Throwable $th) {
                DB::rollback();
                throw $th;
                return false;
            }
        }

        if($options['task'] == 'edit-item') {
            DB::beginTransaction();
            try {
                $this->setModifiedHistory($params);
                $item = self::find($params['id']);
                $params['date'] = MyFunction::formatDateMySQL($params['date']);
                self::where('id', $params['id'])->update($this->prepareParams($params));
                
                DB::commit();
                return true;
            } catch (\Throwable $th) {
                DB::rollback();
                throw $th;
                return false;
            }

        }
    }
    public function deleteItem($params = null, $options = null)
    {
        if($options['task'] == 'delete-item') {
            $item = self::find($params['id']);
            $item->deleted_at   = date('Y-m-d H:i:s');
            $item->deleted_by = \Session::get('user')['user_id'];
            $item->save();
        }
    }
    public function sumMoney($params = null, $options = null) {
        $query = self::query();
        if ($options['task'] == 'tinh-tong-tien-affiliate') {
            if (isset($params['code_ref'])) {
                $result = $query->where('code_ref', $params['code_ref']);
            }
        }
        $result = $query->sum('money');
        return $result;
    }
    public function userRef(){
        return $this->belongsTo('App\Model\Shop\UsersModel','user_id','user_id');
    }
}
