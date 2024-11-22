<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;
use App\Model\Shop\BackEndModel;
use DB;
use App\Helpers\MyFunction;
class ShopProductAddModel extends BackEndModel
{
    public function __construct() {
        $this->table               = 'shop_product_add';
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
                $this->setModifiedHistory($params);
                $item = self::find($params['id']);
               
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
    public function getItem($params = null, $options = null) {
        $result = null;
        if($options['task'] == 'get-item') {
            $query = self::select('id', 'product_id','user_id')
                            ->where('id','>',0);
            if (isset($params['product_id'])){
                $query->where('product_id', $params['product_id']);
            }
        }
        return $result= $query->first();
    }
}
