<?php
namespace App\Http\Controllers\Shop\Api;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Shop\Api\ApiController;
use App\Model\Shop\WarehouseModel as MainModel;
use \Firebase\JWTCustom\JWTCustom as JWTCustom;

class WarehouseController extends ApiController
{
    protected $limit;

    public function __construct(Request $request)
    {
        $this->limit = isset($request->limit) ? $request->limit : 50;
        $this->model = new MainModel();
    }


    public function getList(Request $request)
    {
        $this->res['data'] = null;
        $params['user_id'] = $request->user_id;
        $token = $request->header('Tdoctor-Token');
        $data_token = (JWTCustom::decode($token, $this->jwt_key, array('HS256')));
        if ($data_token['message'] == 'OK') {
            $params['user_id'] = intval($request->user_id);
            $params['filter']['district_id'] = intval($request->district_id);
            $params['filter']['province_id'] = intval($request->province_id);
            $this->res['data']  = $this->model->listItems($params,['task' => 'frontend-list-items']);
        }

        return $this->setResponse($this->res);
    }

}
