<?php
namespace App\Http\Controllers\Shop\Api;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Shop\Api\ApiController;
use App\Model\Shop\CatProductModel as MainModel;
use App\Model\Shop\ProductModel;
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
        // $token = $request->header('Tdoctor-Token');
        // $data_token = (JWTCustom::decode($token, $this->jwt_key, array('HS256')));
        // if ($data_token['message'] == 'OK') {
        //     $params['user'] =  json_decode(json_encode($data_token['payload']));
        //    // $this->res['data'] =  $params['user'];
        //     $request->session()->put('user', $params['user']);
        //     $params['limit']        = $this->limit;

        //     $this->res['data']  = $this->model->listItems($params,['task'=>'frontend-list-items-level-2']);
        // }
        $params['limit']=$this->limit;
        $this->res['data']  = $this->model->listItems($params,['task'=>'frontend-list-items-level-2']);
        $this->res['count']  = count($this->res['data']);
        return $this->setResponse($this->res);
    }
    public function getListCatProductLevel1(Request $request)
    {
        $this->res['data'] = null;
        $this->res['data'] = $this->model->listItems(['parent_id' => 1],['task'=>'frontend-list-items-by-parent-id']);
        return $this->setResponse($this->res);
    }
    public function getListByParent(Request $request)
    {
        $this->res['data'] = null;
        $params['parent_id'] = $request->parentID;
        // $token = $request->header('Tdoctor-Token');
        // $data_token = (JWTCustom::decode($token, $this->jwt_key, array('HS256')));
        // if ($data_token['message'] == 'OK') {
        //     $params['user'] =  json_decode(json_encode($data_token['payload']));
        //    // $this->res['data'] =  $params['user'];
        //     $request->session()->put('user', $params['user']);
        //     $params['limit']        = $this->limit;

        //     $this->res['data']  = $this->model->listItems($params,['task'=>'frontend-list-items-by-parent-id']);
        // }
        $this->res['data']  = $this->model->listItems(['parent_id' => $request->parentID],['task'=>'frontend-list-items-by-parent-id']);
        return $this->setResponse($this->res);
    }
    public function getListByDepthFrontEnd(Request $request){
        $params['limit']        = $this->limit;
        $params['depth'] = $request->depth;
        $this->res['data']  = $this->model->listItems($params,['task'=>'list-items-api-by-depth']);
        return $this->setResponse($this->res);
    }
    public function getListProductByCatId(Request $request){
        $params=[];
        $params['page'] = intval($request->page ?? 1);
        $params['perPage']=$request->perPage ?? 20;
        $params['cat_product_id'] = $request->catProductId ?? 1;
        $this->res['data'] = null;
        $this->res['data']=(new ProductModel())->listItems($params,['task'=>'frontend-list-items-api']);
        $this->res['count'] = count($this->res['data']);
        return $this->setResponse($this->res);
    }
    public function getListCatProductLevel1AndChild(Request $request)
    {
        $this->res['data'] = null;
        $this->res['data'] = $this->model->listItems(['parent_id' => 1],['task'=>'frontend-list-items-by-parent-id']);
        foreach ($this->res['data'] as $key => $value) {
            $this->res['data'][$key]['child'] = $this->model->listItems(['parent_id' => $value['id']],['task'=>'frontend-list-items-by-parent-id']);
        }
        return $this->setResponse($this->res);
    }
}
