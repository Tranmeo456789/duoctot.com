<?php
namespace App\Http\Controllers\Shop\Api;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Shop\Api\ApiController;
use App\Model\Shop\AffiliateProductModel;
use App\Model\Shop\PostModel as MainModel;
use App\Model\Shop\QuangCaoModel;
use \Firebase\JWTCustom\JWTCustom as JWTCustom;

class PostController extends ApiController
{
    protected $limit;

    public function __construct(Request $request)
    {
        $this->limit = isset($request->limit) ? $request->limit : 50;
        $this->model = new MainModel();
    }
    public function getListPost(Request $request){
        $params=[];
        if(isset($request->catPostId)){
            $params['cat_post_id']=$request->catPostId;
        }
        $params['page']=$request->page ?? 1;
        $params['perPage']=$request->perPage ?? 20;
        $this->res['data'] = null;
        $this->res['data']  = $this->model->listItems($params,['task'=>'frontend-list-items-api']);
        return $this->setResponse($this->res);
    }
    public function detailPost(Request $request){
        $params=[];
        if(isset($request->idPost)){
            $params['id']=$request->idPost;
        }
        $this->res['data'] = null;
        $this->res['data']  = $this->model->getItem($params,['task'=>'get-item']);
        return $this->setResponse($this->res);
    }
    public function getListBannerPageHome(Request $request){
        $params=[];
        $params['group_id'] = [14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30];
        $urlImage = asset('laravel-filemanager/fileUpload/banner/');
        $listBannerPageHome = (new QuangCaoModel)->listItems($params,['task'=>'list-items-api']);
        if($listBannerPageHome){
            foreach($listBannerPageHome as $key => $value){
                $listBannerPageHome[$key]['urlImage'] = $urlImage.'/'.$value['banner_mobile'];
                unset($listBannerPageHome[$key]['banner_mobile']);
            }
        }
        $this->res['data']  = $listBannerPageHome;
        return $this->setResponse($this->res);
    }
}
