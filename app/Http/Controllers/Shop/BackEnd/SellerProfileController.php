<?php

namespace App\Http\Controllers\Shop\BackEnd;

use Illuminate\Http\Request;
use App\Model\Shop\CustomerModel;
use App\Model\Shop\Tinhthanhpho;
use App\Model\Shop\WarehouseModel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use DB;
use Illuminate\Support\Facades\Session;

class SellerProfileController extends Controller
{
    function __construct()
    {
        session(['module_active' => 'sellerprofile']);
    }
    public function index()
    {
        $customer = [];
        if (Session::has('islogin')) {
            $customer = CustomerModel::find(Session::get('id'));
        }
        $locals = Tinhthanhpho::all();
        $warehouses = WarehouseModel::all();
        return view('shop.backend.seller-profile.info-seller', compact('customer', 'locals', 'warehouses'));
    }
    public function save()
    {

        //return('ok');
    }
    public function change_password(Request $request)
    {
        if ($request->input('btnupdate-password')) {
            $messages = [
                'password_curent.required' => 'Trường này không được để trống',
                'password_curent.min' => 'Mật khẩu ít nhất 6 ký tự',
                'password.required' => 'Trường này không được để trống',
                'password.min' => 'Mật khẩu ít nhất 6 ký tự',
                'password.confirmed' => 'Xác nhận mật khẩu không đúng',
                'password_confirmation.required' => 'Trường này không được để trống',
                'password_confirmation.min' => 'Mật khẩu ít nhất 6 ký tự',             
            ];

            $this->validate($request, [
                'password_curent' => 'required|min:6',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|min:6',
            ], $messages);
            $id=2;
            if(Session::has('islogin')){
                $id = Session::get('id');
            }
            
            $is_password = DB::table('customers')->where([
                ['password', '=', md5($request->input('password_curent'))],
                ['id', $id],
            ])->get();
            if(!empty($is_password)){
                CustomerModel::where('id',$id)->insert([
                    'password'=> md5($request->input('password')),
                ]);
                return redirect()->route('seller.password')->with('status','Cập nhật mật khẩu thành công');
            }else{
                return redirect()->route('seller.password')->with('error','Mật khẩu hiện tại không đúng !');
            }
            
        }
        return view('shop.backend.seller-profile.change-password');
    }
    public function setting()
    {
        return view('shop.backend.seller-profile.setting');
    }
}
