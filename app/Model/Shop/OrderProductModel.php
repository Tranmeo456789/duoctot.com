<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;
use App\Model\Shop\BackEndModel;
use DB;
class OrderProductModel extends BackEndModel
{
    public function __construct() {
        $this->table               = 'order_product';
        $this->controllerName      = '';
        $this->folderUpload        = '';
        $this->crudNotAccepted     = [];
    }
    public function saveItem($params = null, $options = null) {
        if($options['task'] == 'add-item') {
            DB::beginTransaction();
            try {
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
                self::where('order_id', $params['order_id'])->update($this->prepareParams($params));
                DB::commit();
                return true;
            } catch (\Throwable $th) {
                DB::rollback();
                throw $th;
                return false;
            }

        }
    }
    public function getItem($params = null, $options = null) {
        $result = null;
        if($options['task'] == 'get-item') {
            $query = self::select('id','order_id','product_id','code_order','status_order','quantity','price','unit','code_ref')
                            ->where('id','>',0);
            if (isset($params['product_id'])){
                $query->where('product_id', $params['product_id']);
            }
            if(isset($params['code_ref'])){
                $query->where('code_ref', $params['code_ref']);
            }
        }
        return $result= $query->first();
    }
}
