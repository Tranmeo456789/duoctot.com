<?php
namespace App\Http\Controllers\Shop\Api;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Shop\Api\ApiController;
use App\Model\Shop\DistrictModel;
use App\Model\Shop\OrderModel as MainModel;
use App\Model\Shop\OrderProductModel;
use App\Model\Shop\ProvinceModel;
use App\Model\Shop\UsersModel;
use App\Model\Shop\WardModel;
use \Firebase\JWTCustom\JWTCustom as JWTCustom;

class OrderController extends ApiController
{
    protected $limit;

    public function __construct(Request $request)
    {
        $this->limit = isset($request->limit) ? $request->limit : 50;
        $this->model = new MainModel();
    }

    public function getListFeaturer(Request $request)
    {
        $this->res['data'] = null;
        $params['parent_id'] = $request->parent_id;
        $token = $request->header('Tdoctor-Token');
        $data_token = (JWTCustom::decode($token, $this->jwt_key, array('HS256')));
        if ($data_token['message'] == 'OK') {
            $params['user'] =  json_decode(json_encode($data_token['payload']));
            $params['cat_product_id'] = intval($request->cat_product_id);
            $params['type'] = $request->type;
            $params['limit']        = $this->limit;
            $request->session()->put('user', $params['user']);
            $this->res['data']  = $this->model->listItems($params,['task'=>'frontend-list-items-featurer']);
        }

        return $this->setResponse($this->res);
    }
    public function getList(Request $request)
    {
        $this->res['data'] = null;
        $token = $request->header('Tdoctor-Token');

        $data_token = (JWTCustom::decode($token, $this->jwt_key, array('HS256')));
        if ($data_token['message'] == 'OK') {
            $params['user'] =  json_decode(json_encode($data_token['payload']));
            $params['status_order'] = $request->status_order ??'all';
            $params['limit']        = $this->limit;
            $request->session()->put('user', $params['user']);
            $this->res['data']  = $this->model->listItems($params,['task'=>'user-list-items-by-status']);
        }

        return $this->setResponse($this->res);
    }
    public function getListOrderOfUserLogin(Request $request)
    {
        $this->res['data'] = null;
        $token = $request->header('Tdoctor-Token');

        $data_token = (JWTCustom::decode($token, $this->jwt_key, array('HS256')));
        if ($data_token['message'] == 'OK') {
            $userLogin = (array)$data_token['payload'];
            $params['user_id'] = $userLogin['user_id'];
            $params['status_order'] = $request->status_order ??'all';
            $params['limit']        = $this->limit;
            $this->res['data']  = $this->model->listItems($params,['task'=>'list-items-api-user-login']);
        }

        return $this->setResponse($this->res);
    }
    public function getListOrder(Request $request)
    {
        $this->res['data'] = null;
        $token = $request->header('Tdoctor-Token');

        $data_token = (JWTCustom::decode($token, $this->jwt_key, array('HS256')));
        if ($data_token['message'] == 'OK') {
            $userLogin = (array)$data_token['payload'];
            $params['user_id'] = $userLogin['user_id'];
        }
        $params['status_order'] = $request->status_order ??'all';
        $params['search'] = $request->phone??'unknown';
        $params['page']        = $this->page??1;
        $params['perPage']        = $this->perPage??20;
        $this->res['data']  = $this->model->listItems($params,['task'=>'list-items-api']);
        return $this->setResponse($this->res);
    }
    public function detailOrder(Request $request)
    {
        $this->res['data'] = null;
        $params['code_order'] = $request->codeOrder??'unknown';
        $this->res['data']  = $this->model->getItem($params,['task'=>'get-item-frontend-code']);
        $this->res['data']['buyer']=json_decode($this->res['data']['buyer'], true);
        return $this->setResponse($this->res);
    }
    public function completed(Request $request)
    {
        $this->res['data'] = null;
        $params['parent_id'] = $request->parent_id;
        $token = $request->header('Tdoctor-Token');
        $data_token = (JWTCustom::decode($token, $this->jwt_key, array('HS256')));
        if ($data_token['message'] == 'OK') {
            $params = $request->all();
            $task   = "api-save-item";
            if ($this->model->saveItem($params, ['task' => $task])){
                return response()->json([
                    'status' => 200,
                    'success' => true,
                    'data' => null,
                    'message' => 'Đặt hàng thành công'
                ], 200);
            }
        }
        return response()->json([
            'status' => 200,
            'success' => false,
            'data' => null,
            'message' => 'Có lỗi trong quá trình đặt hàng'
        ], 200);
    }
    public function orderCompleted(Request $request){
        $params['user_sell'] = $request->idUserSell;
        $params['delivery_method'] = $request->deliveryMethod ?? 2;
        $params['payment'] = $request->paymentMethod ?? 1;
        $params['money_ship'] = '20000';
        $params['status_order'] = 'dangXuLy';
        $params['status_control'] = 'chuaThanhToan';
        $params['buyer']['gender']=$request->gender ?? 1;
        $params['buyer']['fullname']=$request->fullName ?? 'Unknown';
        $params['buyer']['phone']=$request->phone ?? 'Unknown';
        $params['receive']['province_id'] = $request->provinceId ?? null;
        $params['receive']['district_id'] = $request->districtId ?? null;
        $params['receive']['ward_id'] = $request->wardId ?? null;
        $params['receive']['address'] = $request->addressDetail ?? 'Unknown';
        $params['info_product'] = $request->arrListIdProduct ?? [];
        $params['total']=0;
        $params['total_product']=0;
        $token = $request->header('Tdoctor-Token');
        $data_token = (JWTCustom::decode($token, $this->jwt_key, array('HS256')));
        if ($data_token['message'] == 'OK') {
            $userCurrent =  (array)$data_token['payload'];
            $userLogin= (new UsersModel)->getItem(['user_id'=>$userCurrent['user_id']],['task'=>'get-item-api']);
            $codeRefLogin = $userLogin['ref_register']??'';
        }
        $codeRef=$params['ref_register']??($codeRefLogin ?? '');
        foreach($params['info_product']  as $k=>$val){
            $params['total'] += $val['total_money'];
            $params['total_product'] += $val['quantity'];
            $params['info_product'][$k]['codeRef']=$codeRef??'';
        }
        $province = ProvinceModel::find($params['receive']['province_id']);
        $district = DistrictModel::find($params['receive']['district_id']);
        $ward = WardModel::find($params['receive']['ward_id']);
        $address = $params['receive']['address'];
        if ($ward) {
            $address .= ', ' . $ward->name; 
        }
        if ($district) {
            $address .= ', ' . $district->name;
        }
        if ($province) {
            $address .= ', ' . $province->name;
        }
        $params['address_detail'] = $address;
        $codeOrder = $this->model->saveItem($params, ['task' => 'api-save-item']);
        if ($codeOrder){
            $orderCurrent=$this->model->getItem(['code_order'=>$codeOrder], ['task' => 'get-item-frontend-code']);
            foreach ($params['info_product'] as $value) {
                $paramsOrderProduct['order_id']=$orderCurrent['id'];
                $paramsOrderProduct['product_id']=$value['product_id'];
                $paramsOrderProduct['code_order']=$codeOrder;
                $paramsOrderProduct['status_order']='dangXuLy';
                $paramsOrderProduct['quantity']=$value['quantity'];
                $paramsOrderProduct['price']=$value['price'];
                $paramsOrderProduct['unit']=$value['unit_id'];
                $paramsOrderProduct['code_ref']=$value['codeRef'];
                (new OrderProductModel)->saveItem($paramsOrderProduct, ['task' => 'add-item']);
            }
            $orderCurrent['info_product']=array_values($orderCurrent['info_product']);
            $orderCurrent['buyer']=json_decode($orderCurrent['buyer'], true);
            return response()->json([
                'status' => 200,
                'success' => true,
                'data' => $orderCurrent,
                'message' => 'Đặt hàng thành công'
            ], 200);
        }
        return response()->json([
            'status' => 200,
            'success' => false,
            'data' => null,
            'message' => 'Có lỗi trong quá trình đặt hàng'
        ], 200);
    }
}
