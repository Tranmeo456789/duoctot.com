<?php

namespace App\Http\Controllers\Shop\BackEnd;
use Illuminate\Http\Request;
use App\Http\Controllers\Shop\BackEnd\BackEndController;
use App\Model\Shop\ProductModel;
use App\Model\Shop\UsersModel;
use App\Helpers\MyFunction;
use App\Model\Shop\OrderModel;
use DB;
use Session;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
class RevenueController extends BackEndController
{
    public function __construct()
    {
        $this->controllerName     = 'revenue';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Quản lý doanh thu';
        parent::__construct();
    }
    public function index_admin(Request $request){
        $session = $request->session();
        if ($session->has('currentController') &&  ($session->get('currentController') != $this->controllerName)) {
            $session->forget('params');
        } else {
            $session->put('currentController', $this->controllerName);
        }
        $session->put('params.pagination.totalItemsPerPage', $this->totalItemsPerPage);
        $this->params     = $session->get('params');
        $pageTitle='Quản lý doanh thu';$this->params['user_type_id']=3;
        $items=(new UsersModel)->listItems($this->params, ['task'  => 'admin-list-items-of-shop']);
        return view($this->pathViewController .  'index_admin', [
            //'params'           => $this->params,
            'items'            => $items,
            'pageTitle'=>$pageTitle
        ]);
    } 
}
