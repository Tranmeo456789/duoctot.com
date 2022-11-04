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
use App\Model\Shop\ProductWarehouseModel;
use DB;
use Session;
class PrescripModel extends BackEndModel
{
    protected $casts = [
        'info_product'   => 'array',
        'pharmacy' =>'array',
        'receive' => 'array'
    ];
    public function __construct() {
        $this->table               = 'prescrips';
        $this->controllerName      = 'prescrip';
        $this->folderUpload        = '' ;
        $this->crudNotAccepted     = ['_token','task'];
    }
    public function scopeOfUser($query)
    {
        if (\Session::has('user')){
            $user = \Session::get('user');
            if($user['is_admin']==1){
                return  $query;
            }else{
                return  $query->where('user_sell',$user->user_id);
            }
            
        }
        return $query;
    }

    public function getItem($params = null, $options = null)
    {
        $result = null;
        if ($options['task'] == 'get-item-frontend') {
            $result = self::select('id','info_product','user_id','user_sell','buyer','province_id',
                            'district_id','ward_id','address')
                            ->where('id', $params['id'])
                            ->first();
        }
        return $result;
    }
  
  
    public function saveItem($params = null, $options = null)
    {
        if ($options['task'] == 'frontend-save-item'){
                $this->setCreatedHistory($params);
                if(isset($params['info_product'])){
                    $params['info_product'] = json_encode($params['info_product']);
                }
                $params['buyer'] = json_encode($params['buyer']); 
                             
                self::insert($this->prepareParams($params));
        }
    }

    public function userBuy(){
        return $this->belongsTo('App\Model\Shop\UsersModel','user_id','user_id');
    }
    
}
