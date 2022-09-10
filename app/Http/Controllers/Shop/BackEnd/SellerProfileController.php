<?php

namespace App\Http\Controllers\Shop\BackEnd;

use Illuminate\Http\Request;
use App\Model\Shop\CustomerModel;
use App\Model\Shop\Tinhthanhpho;
use App\Model\Shop\WarehouseModel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class SellerProfileController extends Controller
{
    function __construct()
    {
        session(['module_active'=>'sellerprofile']);
    }
    public function index(){ 
        $customer=[];
        if(Session::has('islogin')){  
            $customer=CustomerModel::find(Session::get('id'));                
        }
        $locals=Tinhthanhpho::all();$warehouses=WarehouseModel::all();
        return view('shop.backend.seller-profile.info-seller',compact('customer','locals','warehouses'));
    }
    public function save(){

        //return('ok');
    }
    public function change_password(){
        return view('shop.backend.seller-profile.change-password');
    }
    public function setting(){
        return view('shop.backend.seller-profile.setting');
    }

}
