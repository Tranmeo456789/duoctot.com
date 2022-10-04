<?php

namespace App\Model\Shop;
use Session;
use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Model;
use App\Model\Shop\BackEndModel;
use App\Model\Shop\Size;
use Illuminate\Support\Str;
class ProductModel extends BackEndModel
{
    protected $casts = [
        'tick'   => 'array',
        'featurer' =>'array',
        'sell_area' => 'array'
    ];
    public function __construct()
    {
        $this->table               = 'products';
        $this->controllerName      = 'product';
        $this->folderUpload        = 'product';
        $this->crudNotAccepted     = ['_token', 'btn_save','file-del','files'];
    }
    public function listItems($params = null, $options = null)
    {
        $result = null;
        $user = Session::get('user');
        if ($options['task'] == "user-list-items") {
            $query = $this::select('id','name','type','code','cat_product_id','producer_id',
                                    'tick','type_price','price','price_vat','coefficient',
                                    'type_vat','packing','unit_id','sell_area','amout_max',
                                    'inventory','inventory_min','general_info','prescribe','dosage','trademark_id',
                                    'dosage_forms','country_id','specification','benefit',
                                    'preserve','note','image','featurer','long','user_id','wide','high',
                                    'mass', 'created_at', 'updated_at');
            $result =  $query->orderBy('id', 'desc')->where('user_id',$user->user_id)
                ->paginate($params['pagination']['totalItemsPerPage']);
        }
        return $result;
    }
    public function listItemsNoPaginate(){
        $result = null;
        $user = Session::get('user');
        $query = $this::select('id','name','type','code','cat_product_id','producer_id',
        'tick','type_price','price','price_vat','coefficient',
        'type_vat','packing','unit_id','sell_area','amout_max',
        'inventory','inventory_min','general_info','prescribe','dosage','trademark_id',
        'dosage_forms','country_id','specification','benefit',
        'preserve','note','image','featurer','long','user_id','wide','high',
        'mass', 'created_at', 'updated_at');
        $result =  $query->orderBy('id', 'desc')->where('user_id',$user->user_id)->get();
        return $result;
    }
    public function listItemsAllNoPaginate(){
        $result = null;
        $user = Session::get('user');
        $query = $this::select('id','name','type','code','cat_product_id','producer_id',
        'tick','type_price','price','price_vat','coefficient',
        'type_vat','packing','unit_id','sell_area','amout_max',
        'inventory','inventory_min','general_info','prescribe','dosage','trademark_id',
        'dosage_forms','country_id','specification','benefit',
        'preserve','note','image','featurer','long','user_id','wide','high',
        'mass', 'created_at', 'updated_at');
        $result =  $query->orderBy('id', 'desc')->get();
        return $result;
    }
    public function getItem($params = null, $options = null)
    {
        $result = null;
        if ($options['task'] == 'get-item') {
            $result = self::select('id','name','type','code','cat_product_id','producer_id',
                                    'tick','type_price','price','price_vat','coefficient',
                                    'type_vat','packing','unit_id','sell_area','amout_max',
                                    'inventory','inventory_min','general_info','prescribe','dosage','trademark_id',
                                    'dosage_forms','country_id','specification','benefit',
                                    'preserve','note','image','albumImage','albumImageHash','user_id','featurer','long','wide','high',
                                    'mass')
                            ->where('id', $params['id'])
                            ->first();
        }
        return $result;
    }
    public function saveItem($params = null, $options = null)
    {
        if ($options['task'] == 'add-item') {
            $this->setCreatedHistory($params);
            $params['tick'] = isset($params['tick'])?json_encode($params['tick']): NULL;
            $params['featurer'] = isset($params['featurer'])?json_encode($params['featurer']): NULL;
            $params['user_id'] = \Session::get('user')['user_id'];

            if (isset($params['albumImage'])) {
                $resultFileUpload       = $this->uploadFile($params['albumImage']);
                $params['albumImage']   = $resultFileUpload['fileAttach'];
                $params['albumImageHash']     = $resultFileUpload['fileHash'];
            }

            $params['sell_area'] = ($params['sell_area'] != '')? json_encode($params['sell_area'],JSON_NUMERIC_CHECK ): NULL;
            self::insert($this->prepareParams($params));
        }
        if ($options['task'] == 'edit-item') {
            $this->setModifiedHistory($params);
            $item = self::getItem($params,['task'=>'get-item']);
            $this->updateFileUpload($item,$params,'albumImage');
            $params['tick'] = isset($params['tick'])?json_encode($params['tick']): NULL;
            $params['featurer'] = isset($params['featurer'])?json_encode($params['featurer']): NULL;
            $params['sell_area'] = ($params['sell_area'] != '')? json_encode($params['sell_area'],JSON_NUMERIC_CHECK ): NULL;

            self::where('id', $params['id'])->update($this->prepareParams($params));
        }
    }
    public function deleteItem($params = null, $options = null)
    {
        if($options['task'] == 'delete-item') {
           self::where('id', $params['id'])->delete();
        }
    }
    public function unitProduct(){
        return $this->belongsTo('App\Model\Shop\UnitModel','unit_id','id');
    }
    public function trademarkProduct(){
        return $this->belongsTo('App\Model\Shop\TrademarkModel','trademark_id','id');
    }
    public function catProduct(){
        return $this->belongsTo('App\Model\Shop\CatProductModel');
    }
    public function countryProduct(){
        return $this->belongsTo('App\Model\Shop\CountryModel','country_id','id');
    }
    public function userProduct(){
        return $this->belongsTo('App\Model\Shop\UsersModel','user_id','user_id');
    }
    // public function userProduct(){
    //     return $this->belongsTo('App\Model\Shop\UsersModel','user_id','id');
    // }


}
