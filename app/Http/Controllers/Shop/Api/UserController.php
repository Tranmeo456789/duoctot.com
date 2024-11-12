<?php
namespace App\Http\Controllers\Shop\Api;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Shop\Api\ApiController;
use App\Model\Shop\AffiliateModel;
use App\Model\Shop\DistrictModel;
use App\Model\Shop\UsersModel as MainModel;
use App\Model\Shop\ProductModel;
use App\Model\Shop\ProvinceModel;
use App\Model\Shop\UserValuesModel;
use App\Model\Shop\UserTokenModel;
use App\Model\Shop\WardModel;
use \Firebase\JWTCustom\JWTCustom as JWTCustom;
class UserController extends ApiController
{
    protected $limit;
    public function __construct(Request $request)
    {
        $this->limit = isset($request->limit) ? $request->limit : 50;
        $this->model = new MainModel();
    }
    public function register(Request $request){

    }
    public function login(Request $request){
        
    }
    public function detailShop(Request $request){
        $params=[];
        $this->res['data'] = null;
        $params['user_id'] = $request->userID ?? 9999999;
        $userCurrent= $this->model->getItem($params,['task'=>'get-item']);
        $productDrugstore=[];
        $listIdProductAdd=[1901, 1902, 1903, 1904, 1905, 1906, 1907, 1908, 1909, 1910];
        if (isset($userInfo['user_type_id']) && $userInfo['user_type_id'] == 9) {
            $listIdProductAdd = [];
        } 
        $paramsProduct['user_id']=$params['user_id'];
        $paramsProduct['page']=$request->page;
        $paramsProduct['perPage'] = $request->perPage;
        $paramsProduct['group_id'] = $listIdProductAdd;
        $productDrugstore = (new ProductModel)->listItems($paramsProduct, ['task' => 'frontend-list-item-shop-api']);
        $item = AffiliateModel::where('user_id', $params['user_id'])->first();
        if ($item) {
            $listIdProductAdd = [];
            $params['group_id'] = array_merge(collect($item->listIdProduct)->pluck('product_id')->toArray(), $listIdProductAdd);
            $paramsProduct['group_id'] = $params['group_id'];
            $productDrugstore = (new ProductModel)->listItems($paramsProduct, ['task' => 'frontend-list-item-shop-api'])??[];
        } 
        $address='';
        $map='';
        $ward='';
        if(isset($userCurrent['details'])){
            $ward_detail=(new WardModel())->getItem(['id'=> $userCurrent['details']['ward_id']],['task' => 'get-item-full']);
            if($ward_detail){
                $ward = isset($ward_detail['name']) ? ' ' . $ward_detail['name'] : '';
                $district = isset($ward_detail['district']['name']) ? ', ' . $ward_detail['district']['name'] : '';
                $province = isset($ward_detail['district']['province']['name']) ? ', ' . $ward_detail['district']['province']['name'] : '';
            }else{
                $province_detail=(new ProvinceModel)->getItem(['id'=> $userCurrent['details']['province_id']],['task' => 'get-item-full']);
                $province = isset($province_detail['name']) ? ', ' . $province_detail['name'] : '';
                $district_detail=(new ProvinceModel)->getItem(['id'=> $userCurrent['details']['district_id']],['task' => 'get-item-full']);
                $district = isset($district_detail['name']) ? ', ' . $district_detail['name'] : '';
            }
            $address=$userCurrent['details']['address'].$ward.$district.$province;
            $map=isset($userCurrent['details']['map']) ? $userCurrent['details']['map'] : '';
        }
        $data=[
            'user_id'=>$params['user_id'],
            'fullname'=>$userCurrent['fullname'],
            'phone'=>$userCurrent['phone'],
            'email'=>$userCurrent['email'],
            'address'=>$address,
            'map'=>$map,
            'countProduct'=> count($productDrugstore),
            'listProducs'=>$productDrugstore
        ];
        $this->res['data']= $data;
        return $this->setResponse($this->res);
    }
    public function sendDeviceToken(Request $request){
        $this->res['data']['device_token'] = 'chua co';
        $token = $request->header('Tdoctor-Token');
        $tokenDatabase = '';
        $data_token = (JWTCustom::decode($token, $this->jwt_key, array('HS256')));
        if ($data_token['message'] == 'OK') {
            $params['user'] =  json_decode(json_encode($data_token['payload']));
            $tokenDevice = trim($request->device_token);
            $exists = UserTokenModel::where('user_id', $params['user']->user_id)->first();
            if (!$exists) {
                $paramsToken['user_id']=$params['user']->user_id;
                $paramsToken['token']=$tokenDevice;
                (new UserTokenModel)->saveItem($paramsToken,['task'=>'add-item']);
            }else{
                UserTokenModel::where('user_id', $params['user']->user_id)->update(
                    ['token' => $tokenDevice]
                );
            }
            $userToken = UserTokenModel::where('user_id', $params['user']->user_id)->first();
            if ($userToken) {
                $this->res['data']['device_token'] = $userToken->token;
                $this->res['message'] = 'Đã lưu device token thành công';
            } else {
                $this->res['data']['device_token'] = 'chua co';
                $this->res['message'] = 'Chưa lưu được device token';
            }
        }
        return $this->setResponse($this->res);
    }
    
    public function detailUser(Request $request)
    {
        $params=[];
        $this->res['data'] = null;
        $params['user_id'] = $request->userID;
        $this->res['data']= $this->model->getItem($params,['task'=>'get-item']);
        return $this->setResponse($this->res);
    }
    public function getListShop(Request $request)
    {
        $this->res['data'] = null;
        $params['parent_id'] = $request->parentID;
        $query = $this->model::whereIn('user_type_id', [10])->orderBy('user_id', 'DESC');
        if ($request->provinceID != null) {
            $prv = ProvinceModel::where('id', intval($request->provinceID))->first();
            if ($prv != null) {
                $query = $query->where('province_id', $prv->id);
            }
            $itemsDistrict= (new DistrictModel())->listItems(['parentID' =>  $prv->id],['task'=>'admin-list-items-in-selectbox']);
            $this->res['listDistrict']  = $itemsDistrict;
        }
        if ($request->districtID != null) {
            $itemDistrict = DistrictModel::where('id', intval($request->districtID))->first();
            if ($itemDistrict != null) {
                $arrUserID = UserValuesModel::select('user_id')
                                            ->where('value',$itemDistrict->id)
                                            ->where('user_field','district_id')
                                            ->pluck('user_id')->toArray();
                $query = $query->whereIn('user_id',$arrUserID);
            }
        }
        if ($request->keyWordNameOrPhone != null) {
            $fullname = htmlspecialchars($request->keyWordNameOrPhone, ENT_QUOTES, 'UTF-8');
            $query = $query->where(function($q) use ($fullname) {
                $q->where([
                    ['fullname', 'like', "%$fullname%"],
                ])->orWhere([
                    ['phone', 'like', "%$fullname%"],
                ]);
            });
        }
        $perPage = 10;
        $currentPage = intval($request->page ?? 1);
        $queryResults = $query->paginate($perPage, ['*'], 'page', $currentPage);
        $this->res['data'] = $queryResults;
        return $this->setResponse($this->res);
    }
    public function getListDrugstore(Request $request)
    {
        $this->res['data'] = null;
        $params['parent_id'] = $request->parentID;
        $query = $this->model::whereIn('user_type_id', [4])->orderBy('user_id', 'DESC');
        if ($request->provinceID != null) {
            $prv = ProvinceModel::where('id', intval($request->provinceID))->first();
            if ($prv != null) {
                $query = $query->where('province_id', $prv->id);
            }
            $itemsDistrict= (new DistrictModel())->listItems(['parentID' =>  $prv->id],['task'=>'admin-list-items-in-selectbox']);
            $this->res['listDistrict']  = $itemsDistrict;
        }
        if ($request->districtID != null) {
            $itemDistrict = DistrictModel::where('id', intval($request->districtID))->first();
            if ($itemDistrict != null) {
                $arrUserID = UserValuesModel::select('user_id')
                                            ->where('value',$itemDistrict->id)
                                            ->where('user_field','district_id')
                                            ->pluck('user_id')->toArray();
                $query = $query->whereIn('user_id',$arrUserID);
            }
        }
        if ($request->keyWordNameOrPhone != null) {
            $fullname = htmlspecialchars($request->keyWordNameOrPhone, ENT_QUOTES, 'UTF-8');
            $query = $query->where(function($q) use ($fullname) {
                $q->where([
                    ['fullname', 'like', "%$fullname%"],
                ])->orWhere([
                    ['phone', 'like', "%$fullname%"],
                ]);
            });
        }
        $perPage = 10;
        $currentPage = intval($request->page ?? 1);
        $queryResults = $query->paginate($perPage, ['*'], 'page', $currentPage);
        $this->res['data'] = $queryResults;
        return $this->setResponse($this->res);
    }
}
