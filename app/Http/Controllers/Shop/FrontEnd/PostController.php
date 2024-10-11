<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Shop\CatalogModel;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use App\Model\Shop\PostModel as MainModel;
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
        if (!$item) {
            return redirect()->route('home');
        }
        $listItemRelate = $this->model->where('id', '!=', $item['id'])->where('cat_post_id', $item['cat_post_id'])->take(4)->get();

        return view($this->pathViewController . 'detail',
        [
            'item' => $item,
            'listItemRelate' => $listItemRelate,            
        ]
    );
    }
    public function listPostOfCat(Request $request){
        $slug = $request->slug;
        $itemCat= (new CatalogModel)->getItem(['name_url'=>$slug],['task' => 'frontend-get-item']);
        $params['cat_post_id'] = $itemCat['id'];
        $listPostOfCat=$this->model->listItems( $params , ['task' => 'frontend-list-items']);
        return view($this->pathViewController . 'list_post_cat',
            [
                'items' => $listPostOfCat,
                'itemCat' => $itemCat
            ]
        );
    }
}
