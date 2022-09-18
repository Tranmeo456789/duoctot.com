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
use App\Helpers\HttpClient;
use App\Http\Requests\RegisterRequest as RegisterRequest;
use App\Model\Shop\UsersModel as MainModel;
class UserController extends Controller
{
    public function register(RegisterRequest $request)
    {
        //if (!$request->ajax())  return redirect()->route('errors/notfound');

        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'status' => 200,
                'data' => null,
                'success' => false,
                'errors' => $request->validator->errors()
            ]);
        }
        $params = $request->all();
        $params['domain_register'] = config("myconfig.url.prod");
        if ($request->method() == 'POST') {
            $task   = "register";
        if (!str_contains($params['email'],'@')){
                $params['phone'] = $params['email'];
                unset($params['email']);
            }
            $userModel = new MainModel();
            $current_user = $userModel->saveItem($params, ['task' => $task]);

            if (!empty($current_user)){
                $request->session()->put('user', $current_user);
                return response()->json([
                    'status' => 200,
                    'success' => true,
                    'data' =>  $current_user,
                    'errors' => null,
                    'message' => 'Đăng kí thành công',
                    'redirect_url' => route('home')
                ], 200);
            }else{
                return response()->json([
                    'status' => 400,
                    'success' => false,
                    'data' => null,
                    'errors' => null,
                    'message' => 'Có lỗi xảy ra, vui lòng thử lại'
                ],400);
            }
        }
        return redirect()->route('errors/notfound');
    }
    // public function login(Request $request)
    // {
    //     $data = $request->all();
    //     $emaip = $request->emaip;
    //     $password=$request->password;
    //     $islogin=0;
    //     $users = User::all();
    //     $customers=CustomerModel::all();
    //     foreach ($users as $user) {
    //         if ($emaip == $user['email'] && $user['password'] ==  md5($password) or $user['phone'] == $emaip && $user['password'] ==  md5($password)) {
    //             $request->session()->put('islogin', true);
    //             $request->session()->put('id', $user['id']);
    //             $request->session()->put('name', $user['name']);
    //             $islogin = 1;
    //         }
    //     }
    //     foreach ($customers as $customer) {
    //         if ($emaip == $customer['email'] && $customer['password'] ==  md5($password) or $customer['phone'] == $emaip && $customer['password'] ==  md5($password)) {
    //             $request->session()->put('islogin', true);
    //             $request->session()->put('id', $customer['id']);
    //             $request->session()->put('name', $customer['name']);
    //             $islogin = 1;
    //         }
    //     }
    //     $result = array(
    //         'user' => $password,
    //         'islogin'=>$islogin,
    //     );
    //     return response()->json($result, 200);
    // }
    public function login(Request $request)
    {
        $post_data = [
            'username' => '0968020444',
            'password' => '111111'
        ];

        // $curl = curl_init();
        // curl_setopt_array($curl, array(
        //   CURLOPT_URL => 'http://tdoctor.xyz/api/v0.3/login',
        //   CURLOPT_RETURNTRANSFER => true,
        //   CURLOPT_ENCODING => '',
        //   CURLOPT_MAXREDIRS => 10,
        //   CURLOPT_TIMEOUT => 0,
        //   CURLOPT_FOLLOWLOCATION => true,
        //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //   CURLOPT_CUSTOMREQUEST => 'POST',
        //   CURLOPT_POSTFIELDS => json_encode($post_data),
        //   CURLOPT_HTTPHEADER => array(
        //     'Content-Type: application/json'
        //   ),
        // ));

        // $response = curl_exec($curl);
        $client = new GuzzleHttpClient();

        $apiRequest = $client->request('POST', 'http://tdoctor.xyz/api/v0.3/login', [
            'query' =>  $post_data ,
            // 'auth' => ['John', 'password777'],       //If authentication required
            // 'debug' => true                                  //If needed to debug
        ]);
        $content = json_decode($apiRequest->getBody()->getContents());
        return json_encode($content);
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
