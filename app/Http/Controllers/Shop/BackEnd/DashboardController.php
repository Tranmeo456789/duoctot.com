<?php

namespace App\Http\Controllers\Shop\BackEnd;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct(){
        session(['module_active'=>'dashboard']);
    }
        
    public function index(){
        return view('shop.backend.dashboard');
    }
}
