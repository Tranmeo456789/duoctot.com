<?php
namespace App\Http\Controllers\Shop\Api;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Shop\Api\ApiController;
use App\Model\Shop\DistrictModel;
use App\Model\Shop\UsersModel as MainModel;
use App\Model\Shop\ProductModel;
use App\Model\Shop\ProvinceModel;
use App\Model\Shop\UserValuesModel;
use App\Model\Shop\UserTokenModel;
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
    public function sendDeviceToken(Request $request){
        $this->res['data'] = null;
        $token = $request->header('Tdoctor-Token');

        $data_token = (JWTCustom::decode($token, $this->jwt_key, array('HS256')));
        if ($data_token['message'] == 'OK') {
            $params['user'] =  json_decode(json_encode($data_token['payload']));
            if ($request->device_token && !empty($request->device_token)) {
                $tokenDevice = $request->device_token;
                $exists = UserTokenModel::where('token', $tokenDevice) ->where('user_id', $params['user']->user_id)->exists();
                if (!$exists) {
                    UserTokenModel::where('user_id', $params['user']->user_id)->delete();
                    UserTokenModel::where('token', $tokenDevice)->delete();
                    $paramsToken['user_id']=$params['user']->user_id;
                    $paramsToken['token']=$tokenDevice;
                    (new UserTokenModel)->saveItem($paramsToken,['task'=>'add-item']);
                }
            }
            $request->session()->put('user', $params['user']);
            $this->res['data']  = [];
            $this->res['message']  = ['đã lưu divice token thành công'];
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
