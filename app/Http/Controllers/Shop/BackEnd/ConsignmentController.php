<?php

namespace App\Http\Controllers\Shop\BackEnd;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ConsignmentController extends Controller
{
    public function index(){
        return view('shop.backend.consignment.index');
    }
    public function add(){
        return view('shop.backend.consignment.add_consignment');
    }
    public function detail(){
        return view('shop.backend.consignment.detail_consignment');
    }
}
