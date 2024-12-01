<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Model\Shop\CustomerModel;
use Illuminate\Session\SessionInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Helpers\HttpClient;
use App\Model\Shop\UsersModel;
use App\Http\Requests\UserRequest as MainRequest;
use App\Users as MainModel;
class UserController extends Controller
{
    public function register(MainRequest $request)
    {
        if (!$request->ajax())  return redirect()->route('errors/notfound');

        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'status' => 200,
                'data' => null,
                'success' => false,
                'errors' => $request->validator->errors()
            ]);
        }
        $params = $request->all();
        $pointAdd=0;
        $numImportCodeRef=0;
        $params['domain_register'] = config("myconfig.url.prod");
        if ($request->method() == 'POST') {
            $task   = "register";
            if (!str_contains($params['email'],'@')){
                $params['phone'] = $params['email'];
                unset($params['email']);
            }
            $userModel = new MainModel();
            $current_user = $userModel->saveItem($params, ['task' => $task]);
            if(!empty($params['ref_register'])){
                $userShareCodeRef = UsersModel::where('codeRef', $params['ref_register'])->first();
                if($userShareCodeRef){
                    $pointAdd=10;
                    $numImportCodeRef=1;
                    (new UsersModel)->saveItem(['user_id'=>$userShareCodeRef->user_id,'reward_points'=>$userShareCodeRef->reward_points + $pointAdd], ['task' => 'update-item-api']);
                }
            }
            (new UsersModel)->saveItem(['user_id'=>$current_user->user_id,'codeRef' => 'T'.$current_user->user_id,'reward_points'=>$pointAdd,'num_import_code_ref'=>$numImportCodeRef], ['task' => 'update-item-api']);
            $current_user = UsersModel::where('user_id', $current_user->user_id)->first();
            if (!empty($current_user)){
                $request->session()->put('user', $current_user);
                return response()->json([
                    'status' => 200,
                    'success' => true,
                    'data' =>  $current_user,
                    'errors' => null,
                    'message' => 'Đăng kí thành công',
                    'redirect_url' => route('home'),
                    'rotate_effect' => true,
                ], 200);
            }else{
                return response()->json([
                    'status' => 200,
                    'success' => false,
                    'data' =>  null,
                    'errors' => null,
                    'message' => 'Có lỗi xảy ra, vui lòng thử lại'
                ], 200);
            }
        }
        return redirect()->route('errors/notfound');
    }

    public function login(MainRequest $request)
    {
        if (!$request->ajax())  return redirect()->route('errors/notfound');
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
            if (!str_contains($params['email'],'@')){
                $params['phone'] = $params['email'];
                unset($params['email']);
            }
            $userModel = new MainModel();
            $current_user = $userModel->getItem($params, ['task' => 'user-login']);
            if ($current_user){ //Nếu tồn tại login thành công
                $request->session()->put('user', $current_user);
                return response()->json([
                    'status' => 200,
                    'success' => true,
                    'data' => $current_user,
                    'errors' => null,
                    'message' => 'Đăng nhập thành công',
                    'redirect_url' => route('home'),
                    'rotate_effect' => true,
                ], 200);
            }
            return response()->json([
                'status' => 200,
                'success' => false,
                'data' =>  null,
                'errors' => ['authentication' => 'Số điện thoại/Email hoặc Mật khẩu không đúng'],
                'message' => 'Authentication failed'
            ], 200);
        }

        return redirect()->route('errors/notfound');
    }
    public function logout(Request $request)
    {
        $request->session()->forget('user');
        return redirect()->route('home');
    }
    public function logoutbe(Request $request)
    {
        $request->session()->forget('islogin');
        $request->session()->forget('name');
        return redirect('https://tdoctor.vn');
    }
    // public function isunique(Request $request)
    // {
    //     $emails = []
    //     $users = User::all();
    //     foreach ($users as $user) {
    //         $emails[] = $user['phone'];
    //         $emails[] = $user['email'];
    //     }
    //     $email = $request->input('email');
    //     if (in_array($email, $emails)) {
    //         echo json_encode(true);
    //     } else {
    //         echo json_encode(false);
    //     }
    // }
}
