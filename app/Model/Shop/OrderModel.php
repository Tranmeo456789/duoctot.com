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
use DB;
use Session;
class OrderModel extends BackEndModel
{
    use NodeTrait;
    protected $table  = 'orders';
    protected $guarded = [];
    protected $fieldSearchAccepted   = [
        'id','code_order','customer_id','total','info_product','qty_total','name','phone','address','address_detail','delivery_form','request_invoice','status','status_control','payment','created_at','updated_at'
      ];
    public function __construct() {
        $this->table               = 'orders';
        $this->controllerName      = 'order';
        $this->folderUpload        = '' ;
        $this->crudNotAccepted     = ['_token','btn_save'];
    }
    public function saveItem($params = null, $options = null)
    { 
        if ($options['task'] == 'save-item-frontend'){
            $params['created_at']    = date('Y-m-d H:i:s');
            self::insert($params);
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
