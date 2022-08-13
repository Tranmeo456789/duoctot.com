<?php

namespace App\Http\Controllers\Shop\BackEnd;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WarehouseController extends Controller
{
    public function index(){
        return view('shop.backend.warehouse.index');
    }
}
