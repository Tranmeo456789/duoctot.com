<?php

namespace App\Model\Shop;
use Session;
use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Model;
use App\Model\Shop\BackEndModel;
use App\Model\Shop\WarehouseModel;
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
    public function scopeOfCollaboratorCode($query)
    {
        if (\Session::has('user')){
            $user = \Session::get('user');

            $refer_id = $user->refer_id ;
            $collaborator = CollaboratorsUserModel::where('code',$refer_id)->first();

            if ($collaborator)  {
                $collaborator_code = $collaborator->code;

                $arrUserID = CollaboratorsClinicDoctor::select("user_id")
                                ->where("collaborators_clinic_doctor.collaborator_code",$collaborator_code)
                                ->first();

                if (!empty($arrUserID)) {
                    $query->whereIn('user_id',$arrUserID->user_id);
                }
            }
        }

        return $query;
    }
    public function scopeOfUser($query)
    {
        if (\Session::has('user')){
            $user = \Session::get('user');
            return  $query->where('user_id',$user->user_id);
        }
        return $query;
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
                                    'mass','quantity_in_stock','created_at', 'updated_at');
            $result =  $query->orderBy('id', 'desc')->where('user_id',$user->user_id)
                              ->paginate($params['pagination']['totalItemsPerPage']);
        }
        if ($options['task'] == 'user-list-all-items'){

            $result = $this::selectRaw("id as product_id")
                                    ->where('id','>',1)
                                    ->ofUser()
                                    ->get()
                                    ->toArray();
        }
        if ($options['task'] == "frontend-list-items") {
            $query = $this::select('id','name','type','code','cat_product_id','producer_id',
                                    'tick','type_price','price','price_vat','coefficient',
                                    'type_vat','packing','unit_id','sell_area','amout_max',
                                    'inventory','inventory_min','general_info','prescribe','dosage','trademark_id',
                                    'dosage_forms','country_id','specification','benefit',
                                    'preserve','note','image','albumImage','albumImageHash','user_id','featurer','long','wide','high',
                                    'mass');
            if (isset($params['cat_product_id']) && ($params['cat_product_id'] != 0)){
                $query->where('cat_product_id',$params['cat_product_id']);
            }
        //    $query->OfCollaboratorCode();
            $result =  $query->orderBy('id', 'desc')
                             ->paginate($params['limit']);
        }
        // if ($options['task'] == "frontend-list-itemss-featurer") {
        //     $type = $params['type'];
        //     $query = $this::select('id','name','type','code','cat_product_id','producer_id',
        //                             'tick','type_price','price','price_vat','coefficient',
        //                             'type_vat','packing','unit_id','sell_area','amout_max',
        //                             'inventory','inventory_min','general_info','prescribe','dosage','trademark_id',
        //                             'dosage_forms','country_id','specification','benefit',
        //                             'preserve','note','image','albumImage','albumImageHash','user_id','featurer','long','wide','high',
        //                             'mass')
        //                             //->whereRaw("JSON_CONTAINS(`featurer`, '" . $params['type'] . "')");;
        //                             ->whereRaw("FIND_IN_SET('$type',REPLACE(REPLACE(`featurer`, '[',''),']',''))");
        //     if (isset($params['cat_product_id']) && ($params['cat_product_id'] != 0)){
        //         $query->where('cat_product_id',$params['cat_product_id']);
        //     }

        //    // $query->OfCollaboratorCode();
        //     $result =  $query->orderBy('id', 'desc')
        //                      ->paginate($params['limit']);
        // }
        if($options['task'] == "admin-list-items-in-selectbox") {
            $query = $this->select('id', 'name')
                        ->where('id','>',1)
                        ->OfUser()
                        ->orderBy('name', 'asc');
            $result = $query->pluck('name', 'id')->toArray();
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
                            ->OfCollaboratorCode()
                            ->first();
        }
        if ($options['task'] == 'get-item-simple') {
            $result = self::with('unitProduct')->select('id','name','unit_id','price')
                            ->where('id', $params['id'])
                            ->OfUser()
                            ->first();
        }

        if ($options['task'] == 'frontend-get-item') {
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
            $params['tick'] = isset($params['tick'])?json_encode($params['tick'],JSON_NUMERIC_CHECK ): NULL;
            $params['featurer'] = isset($params['featurer'])?json_encode($params['featurer']): NULL;
            $params['user_id'] = \Session::get('user')['user_id'];

            if (isset($params['albumImage'])) {
                $resultFileUpload       = $this->uploadFile($params['albumImage']);
                $params['albumImage']   = $resultFileUpload['fileAttach'];
                $params['albumImageHash']     = $resultFileUpload['fileHash'];
            }
            $params['sell_area'] = ($params['sell_area'] != '')? json_encode($params['sell_area'],JSON_NUMERIC_CHECK ): NULL;
            $catProduct = CatProductModel::find($params['cat_product_id']);
            if ($catProduct){
                $params['cat_product_parent_id'] = $catProduct->parent_id;
            }
            $id = self::insertGetId ($this->prepareParams($params));
            $wareHouseIDs = (new WarehouseModel())->listItems(null,['task' =>'user-list-all-items']);
            self::find($id)->productWarehouse()->attach($wareHouseIDs);
        }
        if ($options['task'] == 'edit-item') {
            $this->setModifiedHistory($params);
            $item = self::getItem($params,['task'=>'get-item']);
            $this->updateFileUpload($item,$params,'albumImage');
            $params['tick'] = isset($params['tick'])?json_encode($params['tick'],JSON_NUMERIC_CHECK ): NULL;
            $params['featurer'] = isset($params['featurer'])?json_encode($params['featurer']): NULL;
            $params['sell_area'] = ($params['sell_area'] != '')? json_encode($params['sell_area'],JSON_NUMERIC_CHECK ): NULL;
            $catProduct = CatProductModel::find($params['cat_product_id']);
            if ($catProduct){
                $params['cat_product_parent_id'] = $catProduct->parent_id;
            }
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

    public function productWarehouse()
    {
        return $this->belongsToMany(WarehouseModel::class,'product_warehouse','product_id','warehouse_id');
    }

}
