<?php

namespace App\Http\Controllers\Shop\BackEnd;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function list_customer(){
        return view('shop.backend.customer.list_customer');
    }
    public function add_customer(){
        return view('shop.backend.customer.add_customer');
    }
}
