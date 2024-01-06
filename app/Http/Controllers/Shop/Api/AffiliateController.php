<?php
namespace App\Http\Controllers\Shop\Api;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Shop\Api\ApiController;
use App\Model\Shop\AffiliateModel as MainModel;
use \Firebase\JWTCustom\JWTCustom as JWTCustom;

class AffiliateController extends ApiController
{
    protected $limit;

    public function __construct(Request $request)
    {
        $this->limit = isset($request->limit) ? $request->limit : 50;
        $this->model = new MainModel();
    }


    public function getItem(Request $request){
        $params['user_id'] = intval($request->user_id);

        $productAffifiate = MainModel::with('listIdProduct')
                                    ->where('user_id',$params['user_id'])->first();
        $this->res['data'] = $productAffifiate;

        return $this->setResponse($this->res);
    }


}
