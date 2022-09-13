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
        $data = $request->all();
        $emaip = $request->emaip;
        $password=$request->password;
        $islogin=0;
        $users = User::all();
        $customers=CustomerModel::all();
        foreach ($users as $user) {
            if ($emaip == $user['email'] && $user['password'] ==  md5($password) or $user['phone'] == $emaip && $user['password'] ==  md5($password)) {
                $request->session()->put('islogin', true);
                $request->session()->put('id', $user['id']);
                $request->session()->put('name', $user['name']);
                $islogin = 1;
            }
        }
        foreach ($customers as $customer) {
            if ($emaip == $customer['email'] && $customer['password'] ==  md5($password) or $customer['phone'] == $emaip && $customer['password'] ==  md5($password)) {
                $request->session()->put('islogin', true);
                $request->session()->put('id', $customer['id']);
                $request->session()->put('name', $customer['name']);
                $islogin = 1;
            }
        }
        $result = array(
            'user' => $password,
            'islogin'=>$islogin,      
        );
        return response()->json($result, 200);
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
