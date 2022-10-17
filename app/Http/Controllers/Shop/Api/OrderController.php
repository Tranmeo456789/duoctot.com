<?php
namespace App\Http\Controllers\Shop\Api;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Shop\Api\ApiController;
use App\Model\Shop\OrderModel as MainModel;
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
}
