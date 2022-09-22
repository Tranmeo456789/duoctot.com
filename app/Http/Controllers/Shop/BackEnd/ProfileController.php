<?php

namespace App\Http\Controllers\Shop\BackEnd;
use App\Http\Controllers\Shop\BackEnd\BackEndController;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests\UserRequest as MainRequest;
use App\Model\Shop\UsersModel as MainModel;
use App\Model\Shop\ProvinceModel;
use App\Model\Shop\DistrictModel;
use App\Model\Shop\WardModel;
class ProfileController extends BackEndController
{
    public function __construct()
    {
        $this->controllerName     = 'profile';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Thông tin người dùng';
        $this->model = new MainModel();
        parent::__construct();
    }
    public function info(Request $request)
    {
        $session = $request->session();
        $item = [];
        if ($session->has('user')) {
            $item = $this->model->getItem(['user_id'=>$session->get('user.user_id')],['task' => 'get-item']);
        }
        $details = $item->details->pluck('value','user_field')->toArray()??[];

        $itemsProvince = (new ProvinceModel())->listItems(null,['task'=>'admin-list-items-in-selectbox']);
        $params['province_id'] = (isset($details['province_id']) && ($details['province_id']!=0))?$details['province_id']:((isset($item->province_id) && ($item->province_id != 0)) ? $item->province_id:0);
        $itemsDistrict = [];
        if ($params['province_id']  != 0){
            $itemsDistrict = (new DistrictModel())->listItems(['parentID' => $params['province_id']],
                                                                ['task'=>'admin-list-items-in-selectbox']);
        }

        $params['district_id'] = (isset($details['district_id']) && ($details['district_id'] != 0))?$details['district_id']:((isset($item->district_id) && ($item->district_id != 0)) ? $item->district_id:0);
        $itemsWard = [];
        if ($params['district_id']  != 0){
            $itemsWard = (new WardModel())->listItems(['parentID' => $params['district_id']],
                                                                ['task'=>'admin-list-items-in-selectbox']);
        }
        return view($this->pathViewController .  'info',
                    compact('item', 'itemsProvince' ,'itemsDistrict','itemsWard')
                );
    }
    public function save(MainRequest $request)
    {
        if (!$request->ajax()) return view("errors." .  'notfound', []);
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'status' => 200,
                'data' => null,
                'success' => false,
                'errors' => $request->validator->errors()
            ]);
        }
        if ($request->method() == 'POST') {
            $params = $request->all();

            $task   = $params['task'];
            $notify = "Cập nhật $this->pageTitle thành công!";
            $redirect_url = route($this->controllerName .'.info');
            if ($task == 'change-password') {
                $notify = "Thay đổi mật khẩu thành công!";
                $redirect_url = route($this->controllerName .'.password');
            }
            if ($this->model->saveItem($params, ['task' => $task])){
                $request->session()->put('app_notify', $notify);
                $userModel = new MainModel();
                $current_user = $this->model->getItem(['user_id']=>$params['user_id'], ['task' => 'get-item']);
                $request->session()->put('user', $current_user);
                return response()->json([
                    'status' => 200,
                    'success' => true,
                    'data' =>  null,
                    'errors' => null,
                    'message' => $notify,
                    'redirect_url' => $redirect_url
                ], 200);
            }else{
                return response()->json([
                    'status' => 200,
                    'success' => false,
                    'data' =>  null,
                    'errors' => null,
                    'message' => 'Có lỗi xảy ra trong quá trình cập nhật thông tin',
                    'redirect_url' => ''
                ], 200);
            }

        }
    }
    public function change_password(Request $request)
    {
        return view($this->pathViewController .  'password');
    }
    public function setting()
    {
        return view('shop.backend.profile.setting');
    }
}
