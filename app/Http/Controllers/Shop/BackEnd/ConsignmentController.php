<?php

namespace App\Http\Controllers\Shop\BackEnd;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ConsignmentController extends Controller
{
    
    public function index(){
        $pageTitle='Danh sách phiếu gửi hàng';
        $moduleName='shop.backend';
        return view('shop.backend.consignment.index',compact('pageTitle','moduleName'));
    }
    public function add(){
        $pageTitle='Thêm phiếu gửi hàng';
        $moduleName='shop.backend';
        return view('shop.backend.consignment.add_consignment',compact('pageTitle','moduleName'));
    }
    public function detail(){
        $pageTitle='Chi tiết phiếu gửi hàng';
        $moduleName='shop.backend';
        return view('shop.backend.consignment.detail_consignment',compact('pageTitle','moduleName'));
    }
}
