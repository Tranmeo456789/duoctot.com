<?php
namespace App\Http\Controllers\Shop\Api;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Shop\Api\ApiController;
use App\Model\Shop\CatProductModel as MainModel;
use \Firebase\JWTCustom\JWTCustom as JWTCustom;

class CatProductController extends ApiController
{
    protected $limit;
    public function __construct(Request $request)
    {
        $this->limit = isset($request->limit) ? $request->limit : 50;
        $this->model = new MainModel();
    }

    public function index(Request $request)
    {
        $this->res['data'] = null;
        $token = $request->header('Tdoctor-Token');
        $data_token = (JWTCustom::decode($token, $this->jwt_key, array('HS256')));
        if ($data_token['message'] == 'OK') {
            $params['user'] =  json_decode(json_encode($data_token['payload']));
           // $this->res['data'] =  $params['user'];
            $request->session()->put('user', $params['user']);
            $params['limit']        = $this->limit;

            $this->res['data']  = $this->model->listItems($params,['task'=>'frontend-list-items-level-2']);
        }
        return $this->setResponse($this->res);
    }

    public function getListByParent(Request $request)
    {
        $this->res['data'] = null;
        $params['parent_id'] = $request->parent_id;
        $token = $request->header('Tdoctor-Token');
        $data_token = (JWTCustom::decode($token, $this->jwt_key, array('HS256')));
        if ($data_token['message'] == 'OK') {
            $params['user'] =  json_decode(json_encode($data_token['payload']));
           // $this->res['data'] =  $params['user'];
            $request->session()->put('user', $params['user']);
            $params['limit']        = $this->limit;

            $this->res['data']  = $this->model->listItems($params,['task'=>'frontend-list-items-by-parent-id']);
        }
        return $this->setResponse($this->res);
    }
    public function getListByDepthFrontEnd(Request $request){
        $params['limit']        = $this->limit;
        $desiredDepth = $request->depth;
        $data  = $this->model->listItems($params,['task'=>'list-items-api-by-depth']);
        $filteredData = array_filter($data, function ($item) use ($desiredDepth) {
            return isset($item['depth']) && $item['depth'] == $desiredDepth;
        });
        return $filteredData;
        $this->res['data']=$filteredData;
        return $this->setResponse($this->res);
    }
}
