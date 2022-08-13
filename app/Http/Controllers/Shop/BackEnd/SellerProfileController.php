<?php

namespace App\Http\Controllers\Shop\BackEnd;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SellerProfileController extends Controller
{
    function __construct()
    {
    }
    public function index(){
        return view('shop.backend.seller-profile.info-seller');
    }
    public function change_password(){
        return view('shop.backend.seller-profile.change-password');
    }
    public function setting(){
        return view('shop.backend.seller-profile.setting');
    }

}
