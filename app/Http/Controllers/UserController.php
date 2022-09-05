<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;
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
        $isnumber = $request->input('isnumber');
        if ($isnumber == 1) {
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
        } else {
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

       
    }
    public function login(Request $request)
    {
        //$data=$request->all();
        //return $data['emaip'];
        $users = User::all();
        //$islogin = 0;
        foreach ($users as $user) {
            if ($user['email'] == $request->input('email') && $user['password'] ==  md5($request->input('password')) or $user['phone'] == $request->input('email') && $user['password'] ==  md5($request->input('password'))) {
                if ($user['customer_group'] == 'Nhà thuốc') {
                    return redirect('/backend');
                }
                $request->session()->put('islogin', true);
                $request->session()->put('name', $user['name']);
                return redirect()->back();
                $islogin = 1;
            }
        }
        return redirect()->back();
        $result =[
            'status'=>0,
            'message'=>'Thông tin đăng nhập không đúng',
        ];
        //echo json_encode($result);
    }
    public function logout(Request $request)
    {
        $request->session()->forget('islogin');
        $request->session()->forget('name');
        return redirect()->back();
    }
    public function isunique(Request $request)
    {
        $emails=[];
        $users = User::all();
        foreach($users as $user){
            $emails[]=$user['phone'];
            $emails[]=$user['email'];
        }
        $email=$request->input('email');
        if(in_array($email, $emails)){
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }
        
    }
}
