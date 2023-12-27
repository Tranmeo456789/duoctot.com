<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;
use App\Model\Shop\BackEndModel;
use DB;
use App\Helpers\MyFunction;
class AffiliateProductModel extends BackEndModel
{
    public function __construct() {
        $this->table               = 'affiliate_product';
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
                if(isset($params['info_product'])){
                    $params['info_product'] = json_encode($params['info_product']);
                }
                if(isset($params['info_bank'])){
                    $params['info_bank'] = json_encode($params['info_bank']);
                }
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
    
}
