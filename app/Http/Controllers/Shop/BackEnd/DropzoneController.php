<?php

namespace App\Http\Controllers\Shop\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Shop\Img_product;
use App\Model\Shop\ProducerModel;
use App\Model\Shop\ProductModel;
use Illuminate\Support\Facades\File as FacadesFile;
use League\Flysystem\File;

class DropzoneController extends Controller
{
    public function upload(Request $request)
    {
        $mem = $request->all();
        $dataimg = $request->name_img;

        $id = $request->id_product;       
        $imgs=implode(',', $dataimg);

        $products = ProductModel::find($id);
        $img_products=$products->image;
        $imgs=$img_products.','.$imgs;
        ProductModel::where('id', $id)->update(
           [
               'image' => $imgs,     
            ]
        );  
        $img_products = explode(",", $imgs);
        $temp = 0;
        $list_img = '';
         foreach($img_products as $img_product) {
            $temp++;
            $list_img .= '          
            <tr>
            <th scope="row" style="width: 10%">' . $temp . '</th>
            <td style="width: 70%"><img style="width:60px;height:60px" src="'.asset('public/shop/uploads/images/product/'.$img_product).'" alt=""></td>
            <td style="width: 20%">
                <a href="'.route('dropzone.img.delete',[$temp,$id]). '" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete" ><i class="fa fa-trash"></i></a>
            </td>
        </tr>';
        }
        $result = array(
            'list_img' => $list_img,
            'img'=>$img_products

        );
        return response()->json($result, 200);
    }
    public function fupload(Request $request)
    {
        $image = $request->file('file');
        $filename = $image->getClientOriginalName(); 
        $image->move(public_path('shop/uploads/images/product'), $filename);
    }
    public function list_img($id){
        $products=ProductModel::find($id);
       
        $imgs = explode(",",$products->image);
        return view('shop.backend.pages.product.img_product',compact('products','imgs'));
    }
    public function deleteimg_product($id,$id_product){       
        $product=ProductModel::find($id_product);
        $imgms = explode(",",$product->image);       
        //\File::delete(public_path('shop/uploads/images/product/' .  $imgms[$id]));
        unset($imgms[$id-1]);
        $imgs=implode(',', $imgms);       
        ProductModel::where('id', $id_product)->update(
            [
                'image' => $imgs,        
            ]
        );      
        return redirect()->route('dropzone.list_img', ['id'=>$id_product]);
    }
}
