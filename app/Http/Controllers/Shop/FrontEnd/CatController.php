<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use App\Model\Shop\Cat_productModel;
use App\Model\Shop\Tinhthanhpho;
use App\Model\Shop\ProductModel;
include "app/Helper/data.php";
class CatController extends ShopFrontEndController
{
    public function __construct()
    {
        $this->controllerName     = 'cat';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'danh mục';
        parent::__construct();
        $data = Cat_productModel::all();
        $_SESSION['local']=$local=Tinhthanhpho::all();
        $_SESSION['cat_product']= $catps = data_tree1($data, 0);
    }
    public function index($slug){
        $catcs=Cat_productModel::where('slug',$slug)->get();
        $catc=$catcs[0];

        return view($this->pathViewController . 'index',compact('catc'));
    }
    public function cat_level2($slug,$slug1){
        $catc1s=Cat_productModel::where('slug',$slug1)->get();
        $catc1=$catc1s[0];
        return view($this->pathViewController . 'cat_productlevel3',compact('catc1'));
    }
    public function cat_level3($slug,$slug1,$slug2){
        
        $cat2cs=Cat_productModel::where('slug',$slug2)->get();     
        $products=ProductModel::where('cat_id',$cat2cs[0]['id'])->get();   
       if($products->count() > 0){
        $product=$products[0];$img = explode(",", $product->image);
       }else{
        $product=[];$img=[];
       }
        $catc2=$cat2cs[0];
        return view($this->pathViewController . 'cat_productlevel4',compact('catc2','product','img'));
    }
}
