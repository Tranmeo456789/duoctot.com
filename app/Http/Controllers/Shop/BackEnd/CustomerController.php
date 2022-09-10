<?php

namespace App\Http\Controllers\Shop\BackEnd;

use App\Model\Shop\CustomerModel as MainModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Shop\BackEnd\BackEndController;
use App\Model\Shop\Tinhthanhpho;
use App\Model\Shop\Xaphuongthitran;
use App\Model\Shop\Quanhuyen;
use App\Http\Requests\CustomerRequest as MainRequest;
class CustomerController extends BackEndController
{
    public function __construct()
    {
        $this->controllerName     = 'customer';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Khách hàng';
        $this->model = new MainModel();
        parent::__construct();
        session(['module_active'=>'customer']);
    }
    public function save(MainRequest $request)
    {
        if (!$request->ajax()) return view("errors." .  'notfound', []);
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'fail' => true,
                'errors' => $request->validator->errors()
            ]);
        }
        if ($request->method() == 'POST') {
            $params = $request->all();

            $task   = "add-item";
            $notify = "Thêm mới $this->pageTitle thành công!";

            if ($params['id'] != null) {
                $task   = "edit-item";
                $notify = "Cập nhật $this->pageTitle thành công!";
            }
            $this->model->saveItem($params, ['task' => $task]);
            $request->session()->put('app_notify', $notify);
            return response()->json([
                'fail' => false,
                'redirect_url' => route($this->controllerName),
                'message'      => $notify,
            ]);
        }
    }
    public function form(Request $request)
    {
        $item = null;
        if ($request->id !== null) {
            $params["id"] = $request->id;
            $item = $this->model->getItem($params, ['task' => 'get-item']);
        }
        $locals=Tinhthanhpho::all();
        $districts=Quanhuyen::all();
        return view($this->pathViewController .  'form', [
            'item'        => $item, 'locals'=> $locals,'districts'=>$districts
        ]);
    }
    public function locationAjax(Request $request){
        $data=$request->all();
        $output='';
        if($data['action']){
            if($data['action']=='city'){
                $output.='<option value="">--Chọn quận huyện--</option>';
                $select_province=Quanhuyen::where('matp', $data['maid'])->orderBy('maqh','asc')->get();
                foreach($select_province as $item6){
                    $output.='<option value="'.$item6->maqh.'">'.$item6->name.'</option>';
                }
            }else{
                $output.='<option value="">--Chọn xã phường--</option>';
                $select_wards=Xaphuongthitran::where('maqh', $data['maid'])->orderBy('xaid','asc')->get();
                foreach($select_wards as $item7){
                    $output.='<option value="'.$item7->xaid.'">'.$item7->name.'</option>';
                }
            }
        }
        echo $output;
    }
}
