<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;
use App\Model\Shop\CustomerModel;
use App\Model\Shop\OrderModel;
use App\Model\Shop\UsersModel;
use App\Model\Shop\ProvinceModel;
use App\Model\Shop\WardModel;
use App\Model\Shop\DistrictModel;
use App\Model\Shop\CatProductModel;
use App\Model\Shop\ProductModel;
use App\Http\Requests;
use App\Http\Requests\UserRequest as MainRequest;
use App\Model\Shop\PrescripModel as MainModel;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use App\Model\Shop\PrescripModel;
use Session;
use DB;
use Illuminate\Support\Str;
class PrescripController extends ShopFrontEndController
{
    public function __construct()
    {
        $this->controllerName     = 'prescrip';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Đơn SP';
        $this->model = new MainModel();
        parent::__construct();
    }
    public function index(Request $request)
    {
        $user =[];
        $session = $request->session();
        $details =[];
        if ($session->has('user')){
            $user = (new UsersModel())->getItem(['user_id'=>$session->get('user.user_id')],['task' => 'get-item']);
        }
        $itemsProvince = (new ProvinceModel())->listItems(null,['task'=>'admin-list-items-in-selectbox']);
        $params['province_id'] = (isset($details['province_id']) && ($details['province_id']!=0))?$details['province_id']:((isset($user->province_id) && ($user->province_id != 0)) ? $user->province_id:0);
        $itemsDistrict = [];
        if ($params['province_id']  != 0){
            $itemsDistrict = (new DistrictModel())->listItems(['parentID' => $params['province_id']],
                                                                ['task'=>'admin-list-items-in-selectbox']);
        }
        $params['district_id'] = (isset($details['district_id']) && ($details['district_id'] != 0))?$details['district_id']:((isset($user->district_id) && ($user->district_id != 0)) ? $user->district_id:0);
        $itemsWard = [];
        if ($params['district_id']  != 0){
            $itemsWard = (new WardModel())->listItems(['parentID' => $params['district_id']],
                                                                ['task'=>'admin-list-items-in-selectbox']);
        }
        $stores = (new UsersModel())->listItems(['user_type_id'=>4],['task'=>'list-store-select-of-shop']);
        return redirect()->route('home');
        return view($this->pathViewController . 'index',compact('user','stores'));
    }
    public function save(Request $request){
        if ($request->method() == 'POST') {
            $params = $request->all();
            $params['user_id']=null;
            if (Session::has('user')){
                $user = Session::get('user');
               $params['user_id']=$user->user_id;
                
            }  
            if ($request->has('name_store')) {
                $params['user_sell'] = $request->input('name_store');
            } 
            $this->model->saveItem($params,['task'=>'frontend-save-item']);
            $last_record = PrescripModel::latest('id')->first()->toArray();
            return redirect()->route('fe.prescrip.prescripCustomer', ['id' => $last_record['id']]);
        }     
    }
    public function prescripCustomer(Request $request,$id){
        $params['id']=$id;
        $prescrip=$this->model->getItem($params,['task'=>'get-item-frontend']); 
        $address='';
        $ward_detail=(new WardModel())->getItem(['id'=>$prescrip['ward_id']],['task' => 'get-item-full']);
        $ward=$ward_detail['name'];$district=$ward_detail['district']['name'];$province=$ward_detail['district']['province']['name'];
        $address=$prescrip['address'].', '.$ward.', '.$district.', '.$province;
        return view($this->pathViewController . 'prescrip_customer',compact('prescrip','address'));
    }

    
}
