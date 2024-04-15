<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Shop\CatProductModel;
use App\Model\Shop\AffiliateProductModel;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use App\Model\Shop\AffiliateModel;
use App\Model\Shop\CommentModel;
use App\Model\Shop\PostModel as MainModel;
use App\Model\Shop\UsersModel;
use Illuminate\Support\Facades\Cookie;
class PostController extends ShopFrontEndController
{
    public function __construct()
    {
        $this->controllerName     = 'post';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Tin tức';
        $this->model = new MainModel();
        parent::__construct();
    }
    public function index(Request $request){
        $items = $this->model->listItems( null , ['task' => 'frontend-list-items']);
        return view($this->pathViewController . 'index',compact('items'));
    }
    public function detail(Request $request){
        $slug = $request->slug;
        $item= $this->model->getItem(['slug'=>$slug],['task' => 'frontend-get-item']);
        return view($this->pathViewController . 'detail',compact('item'));
    }
}
