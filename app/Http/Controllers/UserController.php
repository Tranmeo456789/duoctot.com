<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Model\Shop\User;
use Illuminate\Session\SessionInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Symfony\Component\HttpFoundation\Session\Session;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $isnumber=$request->input('isnumber');
        if($isnumber==1){
            User::create(
                [
                    'name' => $request->input('name'),
                    'phone' => $request->input('email'),
                    'local' => $request->input('local'),
                    'customer_group' => $request->input('selectdk'),
                    'code' => $request->input('code'),
                    'password' => md5($request->input('password')),
                ]
            );
        }else{
            User::create(
                [
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'local' => $request->input('local'),
                    'customer_group' => $request->input('selectdk'),
                    'code' => $request->input('code'),
                    'password' => md5($request->input('password')),
                ]
            );
        }
         return redirect()->back();

        // if ($request->input('btn-register')) {

        //     $rules = [
        //         'name' => 'required',
        //     ];
        //     $messages = [
        //         'name.required' => 'name là trường bắt buộc',
        //     ];

        //     $validator = Validator::make($request->all(), $rules, $messages);
        //     if ($validator->fails()) {
        //         return response()->json([
        //             'error' => true,
        //             'message' => $validator->errors()
        //         ], 200);
        //         // return redirect()->back()->withErrors($validator)->withInput();
        //     }else{
        //         return('du lieu nhap dung');
        //     }
        // }
    }
    public function login(Request $request)
    {
        $users = User::all();
        foreach ($users as $user) {
            if ($user['email'] == $request->input('email') && $user['password'] ==  md5($request->input('password')) or $user['phone'] == $request->input('email') && $user['password'] ==  md5($request->input('password'))) {
                if($user['customer_group']=='Nhà thuốc'){
                    return redirect('/backend');
                }
                $request->session()->put('islogin', true);
                $request->session()->put('name', $user['name']);         
            }     
        }
        
        return redirect()->back();

       
        // if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
        //     return('nhap dung');
        // }else{
        //     return('m=nhap sai');
        // }
    }
    public function logout(Request $request){
        $request->session()->forget('islogin');
        $request->session()->forget('name');
        return redirect()->back();
    }
    public function isunique(){
        $users=User::all();
 
        $requestedEmail  = $_REQUEST['email'];
        return($requestedEmail);
    
     }
}
