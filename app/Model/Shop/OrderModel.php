<?php
namespace App\Model\Shop;
use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Model;
use App\Model\Shop\BackEndModel;
use Illuminate\Support\Str;
use Kalnoy\Nestedset\NodeTrait;
use App\Model\Shop\ProductModel;
use App\Model\Shop\CollaboratorsUserModel;
use App\Model\Shop\CollaboratorsClinicDoctor;
use App\Model\Shop\CustomerShopModel;
use DB;
use Session;
class OrderModel extends BackEndModel
{

    public function __construct() {
        $this->table               = 'orders';
        $this->controllerName      = 'order';
        $this->folderUpload        = '' ;
        $this->crudNotAccepted     = ['_token','btn_save','quantity'];
    }
    public function saveItem($params = null, $options = null)
    {
        if ($options['task'] == 'frontend-save-item'){
            DB::beginTransaction();
            try {
                $this->setCreatedHistory($params);
                $params['buyer'] = json_encode($params['buyer']);
                $params['invoice'] = isset($params['export_tax'])?json_encode($params['invoice']) :null;
                if ($params['delivery_method'] == 1){ //Nhận hàng tại nhà thuốc
                    $params['pharmacy'] = json_encode($params['pharmacy']);
                    $params['receive'] = null;
                }else{
                    $params['pharmacy'] = null;
                    $params['receive'] = json_encode($params['receive']);
                }
                $cart = \Session::get('cart');
                $params['info_product'] = $cart[$params['user_sell']]['product'];
                $params['info_product'] = json_encode($params['info_product']);
                $params['total'] = $cart[$params['user_sell']]['total'];
                $params['total_product'] = $cart[$params['user_sell']]['total_product'];
                $paramsCode = [
                    'type' => 'order',
                    'value' => date('Ymd')
                ];
                $params['code_order'] ='DHTD' . date('Ymd') . sprintf("%05d",self::getMaxCode($paramsCode));
                self::insert($this->prepareParams($params));

                //Cập nhật khách hàng
                $customer = CustomerShopModel::where('user_id',$params['user_id'])
                                            ->where('user_sell',$params['user_sell'])
                                            ->first();
                if (!empty($customer)){
                    CustomerShopModel::insert([
                        'user_id' => $params['user_id'],
                        'user_sell' => $params['user_sell']
                    ]);
                }

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
            $result = self::select('id','code_order','customer_id','total','info_product','qty_total','name','phone','address','address_detail','delivery_form','request_invoice','status','status_control','payment','created_at','updated_at')
                            ->where('code_order', $params['code_order'])->first();
        }
        return $result;
    }


}
