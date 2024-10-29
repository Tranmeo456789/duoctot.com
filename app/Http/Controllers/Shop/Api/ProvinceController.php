<?php
namespace App\Http\Controllers\Shop\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Shop\Api\ApiController;
use App\Model\Shop\ProvinceModel as MainModel;
use \Firebase\JWTCustom\JWTCustom as JWTCustom;

class ProvinceController extends ApiController
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
        $this->res['data']  = $model->listItems(null,['task'=>'list-items-in-selectbox-api']);
        return $this->setResponse($this->res);
    }
}