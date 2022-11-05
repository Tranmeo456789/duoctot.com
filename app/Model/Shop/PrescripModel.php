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
        $this->crudNotAccepted     = ['_token','task','number_product'];
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
    public function listItems($params = null, $options = null)
    {
        $result = null;     
        if ($options['task'] == "user-list-items") {
            $query = $this::select('id','info_product','is_prescrip','user_id','user_sell','buyer','province_id','district_id','ward_id','address','image','created_at')
                                ->where('id','>',1)
                                ->OfUser();
            
            if(isset($params['is_prescrip'])){
                $query->where('is_prescrip', $params['is_prescrip']);
            }
            if(isset($params['pagination'])){
                $query=$query->orderBy('id', 'desc')
                              ->paginate($params['pagination']['totalItemsPerPage']);
            }else{
                $query=$query->orderBy('id', 'desc')->get();
            }            
            $result =  $query;
        }
        return $result;
    }
    public function getItem($params = null, $options = null)
    {
        $result = null;
        if ($options['task'] == 'get-item-frontend') {
            $result = self::select('id','info_product','user_id','user_sell','buyer','province_id','district_id','ward_id','address')
                            ->where('id', $params['id'])
                            ->first();
        }
        if ($options['task'] == 'get-item-backend') {
            $result = self::select('id','info_product','user_id','user_sell','buyer','province_id','district_id','ward_id','address','created_at')
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
