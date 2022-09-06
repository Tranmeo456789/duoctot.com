<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Shop\Cat_product;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use App\Model\Shop\Product;

class CatController extends ShopFrontEndController
{
    public function __construct()
    {
        $this->controllerName     = 'cat';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'danh mục';
        parent::__construct();
        $data = Cat_product::all();
        function data_tree1($data, $parent_id = 0, $level = 0)
        {
            $result = [];
            foreach ($data as $item) {
                if ($parent_id == $item['parent_id']) {
                    $item['level'] = $level;
                    $result[] = $item;
                    $child = data_tree1($data, $item['id'], $level + 1);
                    $result = array_merge($result, $child);
                }
            }
            return $result;
        }
        $_SESSION['cat_product']= $catps = data_tree1($data, 0);
    }
    public function index($slug){
        $catcs=Cat_product::where('slug',$slug)->get();
        $catc=$catcs[0];

        return view($this->pathViewController . 'index',compact('catc'));
    }
    public function cat_level2($slug,$slug1){
        $catc1s=Cat_product::where('slug',$slug1)->get();
        $catc1=$catc1s[0];
        return view($this->pathViewController . 'cat_productlevel3',compact('catc1'));
    }
    public function cat_level3($slug,$slug1,$slug2){
        $cat2cs=Cat_product::where('slug',$slug2)->get();
        $products=Product::where('cat_id',$cat2cs[0]['id'])->get();
        
        $catc2s=Cat_product::where('slug',$slug2)->get();
        $catc2=$catc2s[0];
        return view($this->pathViewController . 'cat_productlevel4',compact('catc2','products'));
    }
}
