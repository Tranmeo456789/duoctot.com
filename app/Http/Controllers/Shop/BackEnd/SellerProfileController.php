<?php

namespace App\Http\Controllers\Shop\BackEnd;

use Illuminate\Http\Request;
use App\Model\Shop\CustomerModel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class SellerProfileController extends Controller
{
    function __construct()
    {
    }
    public function index(){ 
        if(Session::has('islogin')){  
            $customer=CustomerModel::find(Session::get('id'));
            //return($customer->name);
        }
        return view('shop.backend.seller-profile.info-seller',compact('customer'));
    }
    public function change_password(){
        return view('shop.backend.seller-profile.change-password');
    }
    public function setting(){
        return view('shop.backend.seller-profile.setting');
    }

}
