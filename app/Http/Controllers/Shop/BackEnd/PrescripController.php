<?php

namespace App\Http\Controllers\Shop\BackEnd;
use Illuminate\Http\Request;
use App\Model\Shop\WarehouseModel;
use App\Model\Shop\ProductModel;
use App\Model\Shop\WardModel;
use App\Model\Shop\UsersModel;
use App\Http\Requests;
use App\Http\Controllers\Shop\BackEnd\BackEndController;
use App\Model\Shop\PrescripModel as MainModel;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
class PrescripController extends BackEndController
{
    public function __construct()
    {
        $this->controllerName     = 'prescrip';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Đơn thuốc theo toa';
        $this->model = new MainModel();
        parent::__construct();
    }
    public function index(Request $request)
    {
        $session = $request->session();
        if ($session->has('currentController') &&  ($session->get('currentController') != $this->controllerName)) {
            $session->forget('params');
        } else {
            $session->put('currentController', $this->controllerName);
        }
        $session->put('params.pagination.totalItemsPerPage', $this->totalItemsPerPage);
        $this->params     = $session->get('params');
        $this->params['is_prescrip']=1;
        $items            = $this->model->listItems($this->params, ['task'  => 'user-list-items']);
        if ($items->currentPage() > $items->lastPage()) {
            $lastPage = $items->lastPage();
            Paginator::currentPageResolver(function () use ($lastPage) {
                return $lastPage;
            });
            $items              = $this->model->listItems($this->params, ['task'  => 'user-list-items']);
        }    
        return view($this->pathViewController .  'index',[
            'params'           => $this->params,
            'items'            => $items,
        ]);
    }
    public function detail(Request $request)
    {
        $params['id']= intval($request->id);
        $item= $this->model->getItem($params,['task' => 'get-item-backend']);
        $address='';
        $ward_detail=(new WardModel())->getItem(['id'=>$item['ward_id']],['task' => 'get-item-full']);
        $ward=$ward_detail['name'];$district=$ward_detail['district']['name'];$province=$ward_detail['district']['province']['name'];
        $address=$item['address'].', '.$ward.', '.$district.', '.$province;
        $albumImageCurrent=!empty($item['albumImageHash']) ? explode('|', $item['albumImageHash']) : [];
        $pageTitle ='Chi tiết đơn thuốc';
        return view($this->pathViewController .  'detail',
                 compact('item','pageTitle','address','albumImageCurrent'));
    }
 
   
    
}
