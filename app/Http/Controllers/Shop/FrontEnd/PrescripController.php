<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;
use App\Model\Shop\CustomerModel;
use App\Model\Shop\OrderModel;
use App\Model\Shop\Tinhthanhpho;
use App\Model\Shop\Xaphuongthitran;
use App\Model\Shop\Quanhuyen;
use App\Model\Shop\Cat_productModel;
use App\Model\Shop\CatProductModel;
use App\Model\Shop\ProductModel;
use App\Http\Requests;
use App\Http\Requests\UserRequest as MainRequest;
use App\Model\Shop\UsersModel as MainModel;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use Session;
use DB;
use Illuminate\Support\Str;
session_start();
include "app/Helpers/data.php";
class PrescripController extends ShopFrontEndController
{
    public function __construct()
    {
        $this->controllerName     = 'prescrip';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Đơn thuốc';
        $this->model = new MainModel();
        parent::__construct();
        $data = CatProductModel::all();
        $_SESSION['local'] = $local = Tinhthanhpho::all();

        $_SESSION['cat_product'] = $catps = data_tree1($data, 0);
    }
    public function index(Request $request)
    {
       
        return view($this->pathViewController . 'index');
    }
    
}
