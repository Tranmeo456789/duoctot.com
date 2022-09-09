<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Model\Shop\User;
use App\Model\Shop\CustomerModel;
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
            CustomerModel::insert(
                [
                    'name' => $request->input('name'),
                    'phone' => $request->input('email'),
                    'address' => $request->input('local'),
                    'customer_group' => $request->input('selectdk'),
                    'referral_code' => $request->input('code'),
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
            CustomerModel::insert(
                [
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'address' => $request->input('local'),
                    'customer_group' => $request->input('selectdk'),
                    'referral_code' => $request->input('code'),
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
        $customers=CustomerModel::all();
        //$islogin = 0;
        foreach ($users as $user) {
            if ($user['email'] == $request->input('email') && $user['password'] ==  md5($request->input('password')) or $user['phone'] == $request->input('email') && $user['password'] ==  md5($request->input('password'))) {
                $request->session()->put('islogin', true);
                $request->session()->put('id', $user['id']);
                $request->session()->put('name', $user['name']);
                $islogin = 1;
                if ($user['customer_group'] == 'Nhà thuốc') {
                    return redirect('/backend');
                }
                return redirect()->back();
            }
        }
        foreach ($customers as $customer) {
            if ($customer['email'] == $request->input('email') && $customer['password'] ==  md5($request->input('password')) or $customer['phone'] == $request->input('email') && $customer['password'] ==  md5($request->input('password'))) {
                $request->session()->put('islogin', true);
                $request->session()->put('id', $customer['id']);
                $request->session()->put('name', $customer['name']);
                $islogin = 1;
                if ($customer['customer_group'] == 'Nhà thuốc') {
                    return redirect('/backend');
                }
                return redirect()->back();
            }
        }
        return redirect()->back();
        $result = [
            'status' => 0,
            'message' => 'Thông tin đăng nhập không đúng',
        ];
        //echo json_encode($result);
    }
    public function logout(Request $request)
    {
        $request->session()->forget('islogin');
        $request->session()->forget('name');
        return redirect()->back();
    }
    public function logoutbe(Request $request)
    {
        $request->session()->forget('islogin');
        $request->session()->forget('name');
        return redirect('https://tdoctor.vn');
    }
    public function isunique(Request $request)
    {
        $emails = [];
        $users = User::all();
        foreach ($users as $user) {
            $emails[] = $user['phone'];
            $emails[] = $user['email'];
        }
        $email = $request->input('email');
        if (in_array($email, $emails)) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }
}
