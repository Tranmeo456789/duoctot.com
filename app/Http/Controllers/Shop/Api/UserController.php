<?php
namespace App\Http\Controllers\Shop\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Shop\Api\ApiController;
use App\Model\Shop\AffiliateModel;
use App\Model\Shop\ClinicModel;
use App\Model\Shop\CollaboratorsUserModel;
use App\Model\Shop\DistrictModel;
use App\Model\Shop\DoctorModel;
use App\Model\Shop\UsersModel as MainModel;
use App\Model\Shop\UsersModel;
use App\Model\Shop\ProductModel;
use App\Model\Shop\ProvinceModel;
use App\Model\Shop\UserValuesModel;
use App\Model\Shop\UserTokenModel;
use App\Model\Shop\WardModel;
use App\Model\Shop\DoctorSpecialityModel;
use App\Model\Shop\DoctorServiceModel;
use App\Model\Shop\ConfigModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use \Firebase\JWTCustom\JWTCustom as JWTCustom;
class UserController extends ApiController
{
    protected $limit;
    protected $jwt_key = 'anHAzy7CeVuL8ybwt4epOUH5NQXYocpBXQwWGalzU6xRSkD0lAUOsRChzC8fTS6ETSH2J3KpgQbnlPvdMVe7oNcuPQzTkPHfUx88';
    public function __construct(Request $request)
    {
        $this->limit = isset($request->limit) ? $request->limit : 50;
        $this->model = new MainModel();
    }
    public function register(Request $rq){
        $email = null;//$rq->mobile_phone;
        $email_info = $rq->mobile_phone;
        $phone = $rq->mobile_phone;
        $name = $rq->fullName;
        $slug= Str::slug($name)??'';
        $password = $rq->password;
        $present = "";
        $type = $rq->user_type_id ?? 1;
        $gender = "";
        $type_account=$rq->check_terms ?? '';
        $domain_register=$rq->domain_register ?? '';
        $ref_register=$rq->ref_register ?? '';
        if($rq->has('present')){
            $present = $rq->ngt;
        }
        if($rq->has('gender')){
            $gender = $rq->gender;
        }
        if ( $phone != null && $name != null && $password != null) {
            if($email != null){
                $user = UsersModel::where('email', '=', $email)->orWhere(function ($query) use ($phone) {
                    $query->where('phone', $phone)->where('phone', '!=', '0');
                })->first();
            }else{
                $user = UsersModel::orWhere(function ($query) use ($phone) {
                            $query->where('email', $phone)->where('email', '!=', null);
                        })
                        ->orWhere(function ($query) use ($phone) {
                            $query->where('phone', $phone)->where('phone', '!=', 0);
                        })
                        ->orWhere(function ($query) use ($phone) {
                            $query->where('phone', ('0'.$phone))->where('phone', '!=', 0);
                        })
                        ->first();
            }
            if ($user == null) {
                $user = new UsersModel;
                if($email == null){
                    $user->email = '';
                }else{
                    $user->email = $email;
                }
                $user->email_info = $email_info;
                $user->fullname = $name;
                $user->phone = $phone;
                $user->gender = $gender;
                $user->address = 'Việt Nam';
                $user->password = Hash::make($password);
                if (isset($rq->refer_id) && $rq->refer_id != ''){
                    $referId = $rq->refer_id;
                    $user->refer_id = $referId;
                }
                if($email != null && (preg_match('/^[^0-9][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $email) == 0  || strlen($email) < 6) ) {
                    return response()->json(array('success' => false, 'detail' => 'Vui lòng nhập đúng email'), 200);
                }
                $user->user_type_id = $type;
                $user->paid = 1;
                $user->type_account = $type_account;
                $user->domain_register = $domain_register;
                $user->ref_register = $ref_register;
                $user->slug = $slug;
                if ($user->save()) {
                    if($email != null){
                        $user = UsersModel::where('email', '=', $email)->orWhere(function ($query) use ($phone) {
                            $query->where('phone', $phone)->where('phone', '!=', '0');
                        })->first();
                    }else{
                        $user = UsersModel::orWhere(function ($query) use ($phone) {
                                    $query->where('email', $phone)->where('email', '!=', null);
                                })
                                ->orWhere(function ($query) use ($phone) {
                                    $query->where('phone', $phone)->where('phone', '!=', 0);
                                })
                                ->orWhere(function ($query) use ($phone) {
                                    $query->where('phone', ('0'.$phone))->where('phone', '!=', 0);
                                })
                                ->first();
                    }
                    // Tạo dữ liệu partient tài khoản
                    $patientNew = $user->createPatient();
                    $patientNew->save();
                    if ($present != null && $present != "") {
                        $user->present = $present;
                        $user->save();
                        $collaboratorsUser = CollaboratorsUserModel::where('code', $present)->first();
                        if ($collaboratorsUser != null) {
                            $patientNew->balance += $collaboratorsUser->promotion;
                            $patientNew->save();
                        }
                    }
                    if ($user->user_type_id == 1) {
                        $patientNew = $user->createPatient();
                        $patientNew->save();
                        if ($present != null && $present != "") {
                            $user->present = $present;
                            $user->save();
                            $collaboratorsUser = CollaboratorsUserModel::where('code', $present)->first();
                            if ($collaboratorsUser != null) {
                                $patientNew->balance += $collaboratorsUser->promotion;
                                $patientNew->save();
                            }
                        }
                    } else if ($user->user_type_id == 2) {
                        $doctor = new DoctorModel;
                        $doctor->doctor_name = 'BS ' . $user->fullname;
                        $doctor->doctor_url = $this->to_slug('BS ' . $user->fullname);
                        $doctor->user_id = $user->user_id;
                        $doctor->experience = '<ul><li>20 năm bệnh viện Chợ rẫy</li></ul>';
                        $doctor->training = '<ul><li>Đại học y dược HCM</li></ul>';
                        $doctor->doctor_address = 'Hồ Chí Minh';
                        $doctor->profile_image = '246170446bacsi.jpg';
                        $doctor->doctor_timework = '7h đến 19h';
                        $doctor->doctor_clinic = 'bv Đại Học Y Dược';
                        if ($doctor->save()) {
                            $docsp = new DoctorSpecialityModel;
                            $docsp->doctor_id = $doctor->doctor_id;
                            $docsp->speciality_id = 1;
                            $docsp->save();
                            $docser = new DoctorServiceModel;
                            $docser->doctor_id = $doctor->doctor_id;
                            $docser->service_id = 1;
                            $docser->save();
                        }
                    } else if ($user->user_type_id == 3) {
                        $image = $user->avatar;
                        $address = $user->address;
                        $clinic = new ClinicModel();
                        $clinic->user_id = $user->user_id;
                        $clinic->clinic_name = $user->fullname;
                        if ($image == null) {
                            $image = "";
                        }
                        $clinic->profile_image = $image;
                        if ($address == null) {
                            $address = "Việt Nam";
                        }
                        $clinic->clinic_address = $address;
                        $clinic->save();
                    } else if ($user->user_type_id == 4) {
                        $patientNew = $user->createPatient();
                        $patientNew->save();
                        if ($present != null && $present != "") {
                            $user->present = $present;
                            $user->save();
                            $collaboratorsUser = CollaboratorsUserModel::where('code', $present)->first();
                            if ($collaboratorsUser != null) {
                                $patientNew->balance += $collaboratorsUser->promotion;
                                $patientNew->save();
                            }
                        }
                    }
                    $pointAdd=0;
                    $numImportCodeRef=0;
                    if(!empty($ref_register)){
                        $userShareCodeRef = UsersModel::where('codeRef', $ref_register)->first();
                        if($userShareCodeRef){
                            $pointAdd=10;
                            $numImportCodeRef=1;
                            (new UsersModel)->saveItem(['user_id'=>$userShareCodeRef->user_id,'reward_points'=>$userShareCodeRef->reward_points + $pointAdd], ['task' => 'update-item-api']);
                        }
                    }
                    $this->model->saveItem(['user_id'=>$user->user_id,'codeRef' => 'T'.$user->user_id,'reward_points'=>$pointAdd,'num_import_code_ref'=>$numImportCodeRef], ['task' => 'update-item-api']);
                    $current_user= $this->model->getItem(['user_id'=>$user->user_id],['task'=>'get-item-api']);
                    $data = JWTCustom::encode($current_user, $this->jwt_key);
                    return response()->json([
                        'status' => 200,
                        'success' => true,
                        'data' => array(
                            'token' => $data,
                            'current_user' => $current_user
                        ),
                        'message' => 'Đăng kí thành công'
                    ], 200);
                }

            } else {
                return response()->json(array('status' => 400, 'success' => false, 'data' => null, 'message' => 'Email/Phone này đã có người sử dụng, vui lòng kiểm tra lại.'), 400);
            }
        } else {
            return response()->json(array('status' => 400, 'success' => false, 'data' => null, 'message' => 'Số điện thoại và mật khẩu không được để trống'), 400);
        }
        return response()->json(array('status' => 400, 'success' => false, 'data' => null, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'), 400);
    }
    public function login(Request $request){
        $params['email'] = $request->username ?? 'Uknown';
        $params['password'] = $request->password ?? 'Uknown';
        if (!str_contains($params['email'],'@')){
            $params['phone'] = $params['email'];
            unset($params['email']);
        }
        $userModel = new MainModel();
        $current_user = $userModel->getItem($params, ['task' => 'user-login']);
        if ($current_user!= null) {
            $dataToken = JWTCustom::encode($current_user, $this->jwt_key);
            $currentUser=$this->model->getItem(['user_id'=>$current_user['user_id']],['task'=>'get-item-api']);
            return response()->json([
                'status' => 200,
                'success' => true,
                'data' => array(
                    'token' => $dataToken,
                    'current_user' => $currentUser
                ),
                'detail' => 'success'
            ], 200);
        }
        return response()->json([
            'success' => false,
            'data' => NULL,
            'detail' => 'Tài khoản hoặc mật khẩu chưa đúng, vui lòng thử lại!'
        ]);    
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
        $tokenDevice = trim($request->device_token);
        $tokenDatabase = '';
        $data_token = (JWTCustom::decode($token, $this->jwt_key, array('HS256')));
        if ($data_token['message'] == 'OK') {
            $params['user'] =  (array)$data_token['payload'];
            $exists = UserTokenModel::where('user_id', $params['user']['user_id'])
            ->where('token', $tokenDevice)
            ->first();
            $existingToken = UserTokenModel::where('token', $tokenDevice)->first();
            $existingUser = UserTokenModel::where('user_id', $params['user']['user_id'])->first();
            if (!$exists) {
                $paramsToken['user_id']=$params['user']['user_id'];
                $paramsToken['token']=$tokenDevice;
                if($existingToken){
                    UserTokenModel::where('token', $tokenDevice)->update(
                        ['user_id' => $params['user']['user_id']]
                    );
                }else{
                    (new UserTokenModel)->saveItem($paramsToken,['task'=>'add-item']);
                }
            }
            $userToken = UserTokenModel::where('user_id', $params['user']['user_id'])->first();
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
    public function updateInfoUser(Request $request)
    {
        $params=[];
        $this->res['data'] = null;
        $params['fullname'] = $request->fullname??'';
        $params['phone'] = $request->phone??'';
        $params['email'] = filter_var($request->email ?? '', FILTER_VALIDATE_EMAIL) ? $request->email : '';
        $params['ref_register'] = $request->ref_register??'';
        $token = $request->header('Tdoctor-Token');
        $data_token = (JWTCustom::decode($token, $this->jwt_key, array('HS256')));
        if ($data_token['message'] == 'OK') {
            $userCurrent =  (array)$data_token['payload'];
            $params['user_id'] = $userCurrent['user_id'];
            if(!empty($params['ref_register'])){
                $userShareCodeRef = UsersModel::where('codeRef', $params['ref_register'])->first();
                if($userShareCodeRef){
                    $userLogin = UsersModel::where('user_id',$userCurrent['user_id'])->first();
                    if($userLogin['num_import_code_ref'] < 2){
                        $pointAdd=10;
                        $params['reward_points'] = $userLogin['reward_points']+$pointAdd;
                        $params['num_import_code_ref'] =  $userLogin['num_import_code_ref']+1;
                        (new UsersModel)->saveItem(['user_id'=>$userShareCodeRef->user_id,'reward_points'=>$userShareCodeRef->reward_points + $pointAdd], ['task' => 'update-item-api']);
                    }
                }
            }
            $this->model->saveItem($params,['task'=>'update-item-api']);
            $this->res['data']= null;
        }
        return $this->setResponse($this->res);
    }
    public function getInfoUser(Request $request)
    {
        $params=[];
        $this->res['data'] = [];
        $token = $request->header('Tdoctor-Token');
        Log::info('token',['token' => $token]);
        $data_token = (JWTCustom::decode($token, $this->jwt_key, array('HS256')));
        if ($data_token['message'] == 'OK') {
            $userCurrent =  (array)$data_token['payload'];
            $infoUserCurrent=$this->model->getItem(['user_id'=>$userCurrent['user_id']],['task'=>'get-item-api']);
            $fullname = $infoUserCurrent['fullname'] ?? 'Tdoctor';
            $textFirstUrlShare = 'Mời bạn vào link này để đăng ký tài khoản sau đó tải App Tdoctor trên Store để tham gia là thành viên của '. $fullname .' để được hỗ trợ và hưởng nhiều ưu đãi
';
            $urlShare = url('/') . '?codeRef=' . $infoUserCurrent['codeRef'] .'&formRegister=1';
            $urlShare = $textFirstUrlShare . $urlShare;
            $infoUserCurrent->url_share = $urlShare;
            $this->res['data']= $infoUserCurrent;
        }
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
    public function getInfoConfig(Request $request)
    {
        $this->res['data'] = null;
        $config = ConfigModel::where('id', 11)->first();
        $this->res['data'] = $config;
        return $this->setResponse($this->res);
    }
}
