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

        //$images = \File::allFiles(public_path('images'));

        //$images->move(public_path('images'),  $request->name_img);
        for ($i = 0; $i < count($dataimg); $i++) {

            Img_product::create(
                [
                    'image' => 'public/shop/uploads/images/product/' . $dataimg[$i],
                    'product_id' => $id,
                ]
            );
        }

        $img_products = Img_product::where('product_id', $id)->get();
        $temp = 0;
        $list_img = '';
        foreach ($img_products as $img_product) {
            $temp++;
            $list_img .= '          
            <tr>
                <th scope="row" style="width: 10%">' . $temp . '</th>
                <td style="width: 70%"><img style="width:60px;height:60px" src="' . asset($img_product->image) . '" alt=""></td>
                <td style="width: 20%">
                    <a href="' . route('product.img.delete', [$img_product->id, $id]) . '" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete" ><i class="fa fa-trash"></i></a>
                </td>
            </tr>';
        }
        $result = array(
            'list_img' => $list_img,
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
