<?php
namespace App\Http\Controllers\Shop\Api;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Shop\Api\ApiController;
use App\Model\Shop\AffiliateProductModel;
use App\Model\Shop\ProductModel as MainModel;
use \Firebase\JWTCustom\JWTCustom as JWTCustom;

class ProductController extends ApiController
{
    protected $limit;

    public function __construct(Request $request)
    {
        $this->limit = isset($request->limit) ? $request->limit : 50;
        $this->model = new MainModel();
    }
    public function getListProduct(Request $request){
        $params=[];
        $params['page']=$request->page ?? 1;
        $params['perPage']=$request->perPage ?? 20;
        $params['keyword']=$request->keywordSearch ?? '';
        $this->res['data'] = null;
        $this->res['data']  = $this->model->listItems($params,['task'=>'frontend-list-items-api']);
        return $this->setResponse($this->res);
    }
    public function getListProductInObject(Request $request){
        $params=[];
        $params['page']=$request->page ?? 1;
        $params['perPage']=$request->perPage ?? 20;
        $params['type']=$request->typeProduct ?? 'tre_em';
        $this->res['data'] = null;
        $this->res['data']  = $this->model->listItems($params,['task'=>'frontend-list-items-api']);
        return $this->setResponse($this->res);
    }
    public function getListProductFeaturer(Request $request){
        $params=[];
        $params['order_by'] = $request->order_by ?? 'san_pham_moi';
        $params['type']='noi_bat';
        $this->res['data'] = null;
        $this->res['data'] = $this->model->listItems($params,['task' => 'frontend-list-items-api'])->take(10);
        return $this->setResponse($this->res);
    }
    public function index(Request $request)
    {
        $this->res['data'] = null;
        $token = $request->header('Tdoctor-Token');
        $data_token = (JWTCustom::decode($token, $this->jwt_key, array('HS256')));

        if ($data_token['message'] == 'OK') {
            $params['user'] =  json_decode(json_encode($data_token['payload']));
            $params['cat_product_id'] = intval($request->cat_product_id);

            $request->session()->put('user', $params['user']);
            $params['limit']        = $this->limit;

            $this->res['data']  = $this->model->listItems($params,['task'=>'frontend-list-items']);
        }
        return $this->setResponse($this->res);
    }

    public function detail(Request $request)
    {
        $this->res['data'] = null;
        $params['parent_id'] = $request->parent_id;
        $params['id'] = intval($request->id);
        // $token = $request->header('Tdoctor-Token');
        // $data_token = (JWTCustom::decode($token, $this->jwt_key, array('HS256')));
        // if ($data_token['message'] == 'OK') {
        //     $params['user'] =  json_decode(json_encode($data_token['payload']));
        //     $request->session()->put('user', $params['user']);
        //     $this->res['data']  = $this->model->getItem($params,['task'=>'frontend-get-item-api']);
        // }
        $this->res['data']  = $this->model->getItem($params,['task'=>'frontend-get-item-api']);
        return $this->setResponse($this->res);
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
    public function getListFeaturerFrontEnd(Request $request){
        $params['type'] = $request->type ?? 'noi_bat';
        $params['limit']        = $request->limit ?? 'noi_bat';
        $this->res['data']  = $this->model->listItems($params,['task'=>'frontend-list-items-by-type']);
        return $this->setResponse($this->res);
    }
    public function getListProductByProductID(Request $request){
        $params['id'] = json_decode($request->id);

        $this->res['data']  = $this->model->listItems($params,['task'=>'frontend-list-items-by-id']);
        return $this->setResponse($this->res);
    }
    public function getListProductShowFrontEnd(Request $request){
        $params['limit'] = intval($request->limit)??6;
        $params['user_id'] = intval($request->user_id);

        $productAffifiate = AffiliateProductModel::where('user_id',$params['user_id'])
                                                ->whereNotIn('product_id',[1894,1895])
                                                ->pluck('product_id')->toArray();
        $productShop = MainModel::where('user_id',$params['user_id'])
                                        ->whereNotIn('id',[1894,1895])
                                        ->pluck('id')->toArray();
        $arrProductID= array_unique(array_merge($productAffifiate,$productShop));
        if (count($arrProductID) > 0){
            $data  = $this->model->listItems(['id' => $arrProductID,'limit' => $params['limit']],['task'=>'frontend-list-items-by-id']);
        }
        else{
            $data = $this->model->listItems(['type' => 'new','limit' => $params['limit']],['task'=>'frontend-list-items-by-type']);
        }

        $dataPermanent = $this->model->listItems(['groupID'=>[1894,1895]],['task'=>'frontend-list-items-by-groupID']);

        $this->res['data'] = array_merge($dataPermanent->toArray(),$data->toArray()['data']);
        return $this->setResponse($this->res);
    }


}
