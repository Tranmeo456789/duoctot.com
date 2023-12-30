<?php

namespace App\Model\Shop;
use Session;
use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Model;
use App\Model\Shop\BackEndModel;
use App\Model\Shop\WarehouseModel;
use App\Model\Shop\CatProductModel;
use App\Helpers\HttpClient;
use Illuminate\Support\Str;
use DB;
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
        $filedSearch               = array_key_exists($this->controllerName, config('myconfig.config.search')) ? $this->controllerName : 'default';
        $this->fieldSearchAccepted = array_diff(config('myconfig.config.search.' . $filedSearch),['all']);
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
            if($user['is_admin']==1 || $user['is_admin']==2){
                return  $query;
            }else{
                return  $query->where('user_id',$user->user_id);
            }
        }
        return $query;
    }
    public function listItems($params = null, $options = null)
    {
        $result = null;
        $user = Session::get('user');
        if ($options['task'] == "user-list-items") {
            $query = $this::with('unitProduct')
                            ->select('id','name','type','code','cat_product_id','producer_id',
                                    'tick','type_price','price','price_vat','percent_discount','coefficient',
                                    'type_vat','packing','expiration_date','unit_id','sell_area','amout_max',
                                    'inventory','inventory_min','general_info','prescribe','dosage','trademark_id',
                                    'dosage_forms','country_id','specification','benefit','elements',
                                    'preserve','note','image','featurer','long','user_id','status_product','slug','wide','high',
                                    'mass','quantity_in_stock','discount_ref','created_at', 'updated_at')->where('id','>',1)
                                    ->ofUser();
            if (isset($params['group_id'])){
                $query->whereIn('id',$params['group_id']);
            }
            if ((isset($params['filter']['status_product'])) && ($params['filter']['status_product'] != 'all')) {
                $query = $query->where('status_product',$params['filter']['status_product']);
            }
            if (isset($params['search']['value']) && ($params['search']['value'] !== ""))  {
                if($params['search']['field'] == "all") {
                    $query->where(function($query) use ($params){
                        foreach($this->fieldSearchAccepted as $column){
                            $query->orWhereRaw("LOWER($column)" . ' LIKE BINARY ' .  "LOWER('%{$params['search']['value']}%')" );
                        }
                    });
                } else if(in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                        $query->whereRaw("LOWER({$params['search']['field']})" . " LIKE BINARY " .  "LOWER('%{$params['search']['value']}%')" );
                }
            }
            $query->orderBy('created_at', 'desc');
            if (isset($params['pagination']['totalItemsPerPage'])){
                $result =  $query->paginate($params['pagination']['totalItemsPerPage']);
            }else{
                $result = $query->get();
            }

        }

        if ($options['task'] == "user-list-items-in-warehouse") {
            $query = $this::with('productWarehouse')
                            ->select('id','name','code','image','quantity_in_stock','slug')
                            ->where('id','>',1)
                            ->ofUser();
            $result =  $query->orderBy('id', 'desc')
                              ->paginate($params['pagination']['totalItemsPerPage']);
        }
        if ($options['task'] == "user-list-items-in-warehouse-no-pagination") {
            $query = $this::with('productWarehouse')
                            ->select('id','name','code','price','image','quantity_in_stock','user_id','slug')
                            ->where('id','>',1)
                            ->ofUser();
            $result =  $query->orderBy('id', 'desc')
                              ->get();
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
                                    'tick','type_price','price','price_vat','percent_discount','coefficient',
                                    'type_vat','packing','expiration_date','unit_id','sell_area','amout_max',
                                    'inventory','inventory_min','general_info','prescribe','dosage','trademark_id',
                                    'dosage_forms','country_id','specification','benefit','elements',
                                    'preserve','note','image','albumImage','albumImageHash','user_id','featurer','slug','long','wide','high',
                                    'mass','discount_ref')
                                ->where('id','>',1)->where('status_product','da_duyet');
            if (isset($params['cat_product_id']) && ($params['cat_product_id'] != 0)){
                $query->whereIn('cat_product_id', CatProductModel::getChild($params['cat_product_id']));
            }
            if(isset($params['offset'])){
                $query->skip($params['offset']);
            }
            if(isset($params['take'])){
                $query->take($params['take']);
            }
            $query->OfCollaboratorCode()->orderBy('id', 'desc');
            if(isset($params['limit'])){
                $result=$query->paginate($params['limit']);
            }else{
                $result =  $query->get();
            }
        }
        if ($options['task'] == "frontend-list-items-simple") {
            $query = $this::select('id','name','slug')
                                ->where('id','>',1)->where('status_product','da_duyet');
            $query->OfCollaboratorCode()->orderBy('id', 'desc');
            if(isset($params['limit'])){
                $result=$query->paginate($params['limit']);
            }else{
                $result =  $query->get();
            }
        }
        if ($options['task'] == "frontend-list-items-featurer") {
            $type = $params['type'];
            $query = $this::select('id','name','type','code','cat_product_id','producer_id',
                                    'tick','type_price','price','price_vat','percent_discount','coefficient',
                                    'type_vat','packing','expiration_date','unit_id','sell_area','amout_max',
                                    'inventory','inventory_min','general_info','prescribe','dosage','trademark_id',
                                    'dosage_forms','country_id','specification','benefit','elements',
                                    'preserve','note','image','albumImage','albumImageHash','user_id','featurer','slug','long','wide','high',
                                    'mass','discount_ref')
                                 //   ->whereRaw("JSON_CONTAINS(`featurer`, '\"{$params['type']}\"')");
                                    ->whereRaw("FIND_IN_SET('\"{$params['type']}\"',REPLACE(REPLACE(`featurer`, '[',''),']',''))")->where('status_product','da_duyet');
            if (isset($params['cat_product_id']) && ($params['cat_product_id'] != 0)){
                $query->whereIn('cat_product_id', CatProductModel::getChild($params['cat_product_id']));
            }

            $query->OfCollaboratorCode();
            $result =  $query->orderBy('id', 'desc')
                             ->paginate($params['limit']);
        }
        if ($options['task'] == "frontend-list-items-by-type") {
            $type = $params['type'];
            $query = $this::with('unitProduct')->select('id','name','type','code','cat_product_id','producer_id',
                                    'tick','type_price','price','price_vat','percent_discount','coefficient',
                                    'type_vat','packing','expiration_date','unit_id','sell_area','amout_max',
                                    'inventory','inventory_min','general_info','prescribe','dosage','trademark_id',
                                    'dosage_forms','country_id','specification','benefit','elements',
                                    'preserve','note','image','albumImage','albumImageHash','user_id','featurer','slug','long','wide','high',
                                    'mass','discount_ref')
                                 //   ->whereRaw("JSON_CONTAINS(`featurer`, '\"{$params['type']}\"')");
                                    ->whereRaw("FIND_IN_SET('\"{$params['type']}\"',REPLACE(REPLACE(`featurer`, '[',''),']',''))")->where('status_product','da_duyet');
            if (isset($params['cat_product_id']) && ($params['cat_product_id'] != 0)){
                $query->whereIn('cat_product_id', CatProductModel::getChild($params['cat_product_id']));
            }

            $query->OfCollaboratorCode();
            $result =  $query->orderBy('id', 'desc')
                             ->paginate($params['limit']);
        }
        if ($options['task'] == "frontend-list-items-by-id") {
            logger($params);
            $query = $this::with('unitProduct')->select('id','name','type','code','cat_product_id','producer_id',
                                    'tick','type_price','price','price_vat','percent_discount','coefficient',
                                    'type_vat','packing','expiration_date','unit_id','sell_area','amout_max',
                                    'inventory','inventory_min','general_info','prescribe','dosage','trademark_id',
                                    'dosage_forms','country_id','specification','benefit','elements',
                                    'preserve','note','image','albumImage','albumImageHash','user_id','featurer','slug','long','wide','high',
                                    'mass','discount_ref')
                                    ->whereIn("id",$params['id'])
                                    ->where('status_product','da_duyet');


          //  $query->OfCollaboratorCode();
          $result =  $query->orderBy('id', 'desc')
                            ->paginate(10);
        }
        if($options['task'] == "admin-list-items-in-selectbox") {
            $query = $this->select('id', 'name')
                        ->where('id','>',1)
                        ->OfUser()
                        ->orderBy('name', 'asc');
            $result = $query->pluck('name', 'id')->toArray();
        }
        if($options['task'] == "list-items-search") {
            $query = $this::with('unitProduct')->select('id','name','image','price','percent_discount','unit_id','slug');
            if(isset($params['keyword'])){
                $query->where('name','LIKE', "%{$params['keyword']}%");
            }
            if(isset($params['user_sell'])){
                $query->where('user_id',$params['user_sell']);
            }
            $query->orderBy('id', 'asc');
            if(isset($params['limit'])){
                $query->limit($params['limit']);
            }
            $result = $query->get();
        }
        return $result;
    }
    public function listItemsNoPaginate(){
        $result = null;
        $user = Session::get('user');
        $query = $this::select('id','name','type','code','cat_product_id','producer_id',
        'tick','type_price','price','price_vat','percent_discount','coefficient',
        'type_vat','packing','expiration_date','unit_id','sell_area','amout_max',
        'inventory','inventory_min','general_info','prescribe','dosage','trademark_id',
        'dosage_forms','country_id','specification','benefit','elements',
        'preserve','note','image','featurer','slug','long','user_id','wide','high',
        'mass','discount_ref', 'created_at', 'updated_at');
        $result =  $query->orderBy('id', 'desc')->where('user_id',$user->user_id)->get();
        return $result;
    }
    public function listItemsAllNoPaginate(){
        $result = null;
        $user = Session::get('user');
        $query = $this::select('id','name','type','code','cat_product_id','producer_id',
        'tick','type_price','price','price_vat','percent_discount','coefficient',
        'type_vat','packing','expiration_date','unit_id','sell_area','amout_max',
        'inventory','inventory_min','general_info','prescribe','dosage','trademark_id',
        'dosage_forms','country_id','specification','benefit','elements',
        'preserve','note','image','featurer','slug','long','user_id','wide','high',
        'mass','discount_ref', 'created_at', 'updated_at');
        $result =  $query->orderBy('id', 'desc')->get();
        return $result;
    }
    public function getItem($params = null, $options = null)
    {
        $result = null;
        if ($options['task'] == 'get-item') {
            $result = self::select('id','name','type','code','cat_product_id','producer_id',
                                    'tick','type_price','price','price_vat','percent_discount','coefficient',
                                    'type_vat','packing','expiration_date','unit_id','sell_area','amout_max',
                                    'inventory','inventory_min','general_info','prescribe','dosage','trademark_id',
                                    'dosage_forms','country_id','specification','benefit','elements',
                                    'preserve','note','image','albumImage','albumImageHash','user_id','featurer','slug','long','wide','high',
                                    'mass','discount_ref')
                            ->where('id', $params['id'])
                            ->OfCollaboratorCode()
                            ->first();
        }
        if ($options['task'] == 'get-item-simple') {
            $result = self::with('unitProduct')->select('id','name','unit_id','price','slug')
                            ->where('id', $params['id'])
                            ->OfUser()
                            ->first();
        }

        if ($options['task'] == 'frontend-get-item') {
            $query = self::with('unitProduct')
                            ->select('id','name','type','code','cat_product_id','producer_id',
                                    'tick','type_price','price','price_vat','percent_discount','coefficient',
                                    'type_vat','packing','expiration_date','unit_id','sell_area','amout_max',
                                    'inventory','inventory_min','general_info','prescribe','dosage','trademark_id',
                                    'dosage_forms','country_id','specification','benefit','elements',
                                    'preserve','note','image','albumImage','albumImageHash','user_id','featurer','slug','long','wide','high',
                                    'mass','discount_ref');
            if(isset($params['id'])){
                $query->where('id', $params['id']);
            }
            if(isset($params['slug'])){
                $query->where('slug', $params['slug']);
            }
            $result = $query->first();
        }
        return $result;
    }
    public function countItems($params = null, $options  = null) {

        $result = null;
        if($options['task'] == 'admin-count-items-group-by-user-id') {
            $query = $this::groupBy('user_id')
                            ->select(DB::raw('user_id , COUNT(id) as count'))
                            ->where('id','>',1)->where('user_id',$params['user_id']);
            if(isset($params['filter_in_day'])){
                $query->whereBetween('created_at', ["{$params['filter_in_day']['day_start']}", "{$params['filter_in_day']['day_end']}"]);
            }
            $result = $query->get()->toArray();
        }
        if($options['task'] == 'admin-count-items-group-by-status-product') {
            $query = $this::groupBy('status_product')
                            ->select(DB::raw('status_product , COUNT(id) as count') )
                            ->where('id','>',1)
                            ->OfUser();

            $result = $query->get()->toArray();
        }
         if($options['task'] == 'count-items-all-product-frontend') {
            $query = $this::groupBy('status_product')
                    ->select(DB::raw('status_product, COUNT(id) as count'))
                    ->where('id', '>', 1)
                    ->where('status_product', 'da_duyet');

            $result = $query->get()->toArray();
        }
        if ($options['task'] == "count-number-product-in-cat") {
            $query = $this::select('id','name')
                            ->where('status_product','da_duyet')
                            ->whereIn('cat_product_id', CatProductModel::getChild($params['cat_product_id']))->get();

            $result =  count($query);
        }
        return $result;
    }
    public function sumNumberItems($params = null, $options  = null){
        if ($options['task'] == "sum-quantity-product-in-warehouse-of-user-id") {
            $query = $this::with('productWarehouse')
                            ->select('id','price','quantity_in_stock','user_id','created_at')
                            ->where('id','>',1)->OfUser();
            if(isset($params['filter_in_day'])){
                $query->whereBetween('created_at', ["{$params['filter_in_day']['day_start']}", "{$params['filter_in_day']['day_end']}"]);
            }
            $result =  $query->get()->sum('quantity_in_stock');
        }
        if ($options['task'] == "sum-money-product-in-warehouse-of-user-id") {
            $query = $this::with('productWarehouse')
                            ->select('id','price','quantity_in_stock','user_id','created_at')
                            ->where('id','>',1)->OfUser();
            if(isset($params['filter_in_day'])){
                $query->whereBetween('created_at', ["{$params['filter_in_day']['day_start']}", "{$params['filter_in_day']['day_end']}"]);
            }
            $result = $query->select(DB::raw('SUM(price * quantity_in_stock) as total'))->get()->first()->total;
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
            $params['status_product'] = 'cho_kiem_duyet';
            $params['sell_area'] = (isset($params['sell_area']) && $params['sell_area'] !== '') ? json_encode($params['sell_area'], JSON_NUMERIC_CHECK) : 0;
            $catProduct = CatProductModel::find($params['cat_product_id']);
            if ($catProduct){
                $params['cat_product_parent_id'] = $catProduct->parent_id;
            }
            $id = self::insertGetId ($this->prepareParams($params));
            $wareHouseIDs = (new WarehouseModel())->listItems(null,['task' =>'user-list-all-items']);
            self::find($id)->warehouse()->attach($wareHouseIDs);
        }
        if ($options['task'] == 'edit-item') {
            $this->setModifiedHistory($params);
            $item = self::getItem($params,['task'=>'get-item']);
            $this->updateFileUpload($item,$params,'albumImage');
            $params['tick'] = isset($params['tick'])?json_encode($params['tick'],JSON_NUMERIC_CHECK ): NULL;
            $params['featurer'] = isset($params['featurer'])?json_encode($params['featurer']): NULL;
            $params['sell_area'] = (isset($params['sell_area']) && $params['sell_area'] !== '') ? json_encode($params['sell_area'], JSON_NUMERIC_CHECK) : 0;
            $catProduct = CatProductModel::find($params['cat_product_id']);
            if ($catProduct){
                $params['cat_product_parent_id'] = $catProduct->parent_id;
            }
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }
        if($options['task'] == 'update-status-item-of-admin'){
            self::where('id', $params['id'])->update(['status_product' => $params['status_product']]);
        }
    }
    public function uploadToImgBB($imageUrl)
    {
        $apiKey = '859e29f6b43b74159e2097b463992b32';
        $imgBBUrl = 'https://api.imgbb.com/1/upload';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $imgBBUrl . '?expiration=600&key=' . $apiKey);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        $fileContents = file_get_contents($imageUrl);
        $postData = array('image' => base64_encode($fileContents));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        if ($err) {
            echo 'cURL Error: ' . $err;
            return null;
        } else {
            $responseData = json_decode($response, true);
            if (isset($responseData['data']['url'])) {
                return $responseData['data']['url'];
            } else {
                echo 'Error from imgBB: ' . print_r($responseData, true);
                return null;
            }
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

    public function warehouse()
    {
        return $this->belongsToMany(WarehouseModel::class,'product_warehouse','product_id','warehouse_id');
    }
    public function productWarehouse()
    {
        return $this->hasMany(ProductWarehouseModel::class,'product_id','id');
    }
}
