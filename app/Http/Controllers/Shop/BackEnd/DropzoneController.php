<?php

namespace App\Http\Controllers\Shop\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Shop\Img_product;
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

        $img_products = Img_product::where('product_id', $id)->get();
        $img_products=$img_products[0]->image;
        $imgs=$img_products.','.$imgs;
        Img_product::where('product_id', $id)->update(
            [
                'image' => $imgs,  
                'product_id'=>$id,    

            ]
        );  
        $img_products = Img_product::where('product_id', $id)->get();
        $img_products=$img_products[0]->image;
         $img_products = explode(",", $img_products);
        $temp = 0;
        $list_img = '';
        foreach ($img_products as $k=>$img_product) {
            $temp++;
            $list_img .= '          
            <tr>
            <th scope="row" style="width: 10%">' . $temp . '</th>
            <td style="width: 70%"><img style="width:60px;height:60px" src="'.asset('public/shop/uploads/images/product/'.$img_product).'" alt=""></td>
            <td style="width: 20%">
                <a href="'.route('product.img.delete',[$temp-1,$id]). '" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete" ><i class="fa fa-trash"></i></a>
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
}
