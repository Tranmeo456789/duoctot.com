<?php
namespace App\Http\Controllers\Shop\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Shop\Api\ApiController;
use App\Model\Shop\DistrictModel as MainModel;
use \Firebase\JWTCustom\JWTCustom as JWTCustom;

class DistrictController extends ApiController
{
    protected $limit;

    public function __construct(Request $request)
    {
        $this->limit = isset($request->limit) ? $request->limit : 50;
        $this->model = new MainModel();
    }

    public function getList(Request $request)
    {
        $model = new MainModel();
        $params["parentID"]   = intval($request->parentID);
        $this->res['data']  = $model->listItems($params,['task'=>'list-items-in-selectbox-api']);
        return $this->setResponse($this->res);
    }
}