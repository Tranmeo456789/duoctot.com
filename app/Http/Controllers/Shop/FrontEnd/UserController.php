<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use App\Model\Shop\UsersModel as MainModel;
use App\Model\Shop\UsersModel;
use Illuminate\Support\Facades\Cookie;
class UserController extends ShopFrontEndController
{
    public function __construct()
    {
        $this->controllerName     = 'user';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Tư vấn người dùng tham gia Tdoctor';
        $this->model = new MainModel();
        parent::__construct();
    }
    public function invitationFromUser(Request $request){
        $codeRef = $request->codeRef;
        if(empty($codeRef)){
            return redirect()->to(route('home'));
        }
        $infoUserRef = UsersModel::where('codeRef', $codeRef)->first();
        $imageSrc = isset($infoUserRef['details']['image']) ? $infoUserRef['details']['image'] : route('home') . '/laravel-filemanager/fileUpload/nhathuoc/nhathuocmau10.jpg';
        if (isset($infoUserRef['details']['image']) && $infoUserRef['details']['image'] != ''){
            $imageSrc  = route('home') . $infoUserRef['details']['image'];
        } else{
            $imageSrc  = route('home') . '/laravel-filemanager/fileUpload/nhathuoc/nhathuocmau10.jpg';
        }
        $urlShare = url('/') . '?codeRef=' . $codeRef .'&formRegister=1';
        return view($this->pathViewController . 'invitation_from_user',[
            'infoUserRef' => $infoUserRef,
            'urlShare' => $urlShare,
            'codeRef' => $codeRef,
            'imageSrc' => $imageSrc
        ]);
    }

    public function infoUserRef(Request $request){
        $codeRef = $request->codeRef;
        if(empty($codeRef)){
            return redirect()->to(route('home'));
        }
        $infoUserRef = UsersModel::where('codeRef', $codeRef)->first();
        $urlShare = url('/') . '?codeRef=' . $codeRef .'&formRegister=1';
        $imageSrc = isset($infoUserRef['details']['image']) ? $infoUserRef['details']['image'] : route('home') . '/laravel-filemanager/fileUpload/nhathuoc/nhathuocmau10.jpg';
        if (isset($infoUserRef['details']['image']) && $infoUserRef['details']['image'] != ''){
            $imageSrc  = route('home') . $infoUserRef['details']['image'];
        } else{
            $imageSrc  = route('home') . '/laravel-filemanager/fileUpload/nhathuoc/nhathuocmau10.jpg';
        }
        return view($this->pathViewController . 'detail_user_ref',[
            'infoUserRef' => $infoUserRef,
            'urlShare' => $urlShare,
            'imageSrc' => $imageSrc
        ]);
    }
}
