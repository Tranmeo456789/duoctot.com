<?php

namespace App\Http\Controllers\Shop\BackEnd;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Shop\Unit;
class ProductController extends Controller
{
    //san pham
    public function add_product(){
        return view('shop.backend.product.add_product');
    }

    public function list_product(){
        return view('shop.backend.product.list_product');
    }
    //don vi tinh
    public function unit(){

        $units=Unit::paginate(10);
        return view('shop.backend.product.unit_product',compact('units'));
    }
    public function unit_store(Request $request){
        if($request->input('btn_add_unit')){
            $this->validate(
                $request,
                [
                'name_unit' => 'required|string|min:1',
                ],
                [
                    'required'=>':attribute không được để trống',
                    'min'=>':attribute có độ dài ít nhất :min ký tự',                  
                ],
                [
                    'name_unit'=>'Tên đơn vị tính',
                ]
            );           
            Unit::create(
                [                
                    'name_unit' => $request->input('name_unit'),    
                ]
              );
            return redirect('backend/don-vi-tinh')->with('status','Thêm đơn vị tính thành công');
        }        
    }
    function unit_delete($id){
        Unit::where('id_unit',$id)->forceDelete();
        return redirect('backend/don-vi-tinh')->with('status','Bản ghi đã xóa vĩnh viễn!');
    }
}
