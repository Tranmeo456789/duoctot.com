<?php

namespace App\Http\Controllers\Shop\BackEnd;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function __construct(){
        session(['module_active'=>'order']);
    }
    public function add_order(){
        return view('shop.backend.order.add_order');
    }
    public function list_order(){
        return view('shop.backend.order.list_order');
    }
    public function detail_order(){
        return view('shop.backend.order.detail_order');
    }
    public function list_invoice(){
        return view('shop.backend.order.list_invoice');
    }
    public function detail_invoice(){
        return view('shop.backend.order.detail_invoice');
    }
}
