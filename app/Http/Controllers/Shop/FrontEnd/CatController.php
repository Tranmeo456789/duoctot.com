<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use App\Model\Shop\Cat_productModel;
use App\Model\Shop\CatProductModel;
use App\Model\Shop\Tinhthanhpho;
use App\Model\Shop\ProductModel;

include "app/Helpers/data.php";

class CatController extends ShopFrontEndController
{
    public function __construct()
    {
        $this->controllerName     = 'cat';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'danh mục';
        parent::__construct();
        $data = CatProductModel::all();
        $_SESSION['local'] = $local = Tinhthanhpho::all();
        $_SESSION['cat_product'] = $catps = data_tree1($data, 0);
    }
    public function index($slug)
    {
        $catcs = CatProductModel::where('slug', $slug)->get();
        $catc = $catcs[0];
        $products=product_of_cat($catc->id);
        return view($this->pathViewController . 'index', compact('catc','products'));
    }
    public function cat_level2($slug, $slug1)
    {      
        
        $catc1s = CatProductModel::where('slug', $slug1)->get();
        $catc1 = $catc1s[0];
        //return(parent_cat($catc1->id)->name);
        $products=product_of_cat($catc1->id);
        return view($this->pathViewController . 'cat_productlevel3', compact('catc1','products'));
    }
    public function cat_level3($slug, $slug1, $slug2)
    {
        $cat2cs = CatProductModel::where('slug', $slug2)->get();
        $catc2 = $cat2cs[0];
        $products=product_of_cat($catc2->id);
        return view($this->pathViewController . 'cat_productlevel4', compact('catc2', 'products'));
    }
}
