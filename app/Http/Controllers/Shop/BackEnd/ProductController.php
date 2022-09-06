<?php

namespace App\Http\Controllers\Shop\BackEnd;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Shop\Unit;
use App\Model\Shop\Producer;
use App\Model\Shop\Product;
use App\Model\Shop\Size;
use App\Model\Shop\Warehouse;
use App\Model\Shop\Img_product;
use App\Model\Shop\Cat_product;
use App\Model\Shop\Feature_product;
use Faker\Provider\File;
use Illuminate\Support\Facades\File as FacadesFile;

class ProductController extends Controller
{
    //san pham
    public function add_product(Request $request)
    {
        
        if ($request->input('btnadd_product')) {         
            $this->validate(
                $request,
                [
                    'name' => 'required|string|min:1',
                    'type_product' => 'required',
                    'code_product' => 'required',
                    'cat_product' => 'required',
                    'producer' => 'required',
                    'price' => 'required |numeric',
                    'price_vat' => 'required | numeric',
                    'packing' => 'required',
                    'trademark'=>'required',
                    'inventory' => 'required',
                    'images' => 'required',
                    'info-general' => 'required',
                    'longs' => 'numeric',
                    'wides' => 'numeric',
                    'highs' => 'numeric',
                    'mass' => 'numeric',
                    'benefit'=>'required'
                ],
                [
                    'required' => ':attribute không được để trống',
                    'min' => ':attribute có độ dài ít nhất :min ký tự',
                    'array' => ':attribute không được để trống',
                    'image' => ':attribute có dạng jpeg, png, bmp, gif, svg',
                    'numeric' => ':attribute có dạng số',
                ],
                [
                    'name' => 'Tên sản phẩm',
                    'type_product' => 'Loại sản phẩm',
                    'code_product' => 'Mã sản phẩm',
                    'cat_product' => 'Danh mục sản phẩm',
                    'producer' => 'Nhà sản xuất',
                    'price' => 'Giá bán',
                    'price_vat' => 'Giá bán',
                    'packing' => 'Quy cách đóng gói',
                    'inventory' => 'Tồn trong kho',
                    'images' => 'Hình ảnh',
                    'info-general' => 'Thông tin chung',
                    'trademark'=>'Thương hiệu sản phẩm',
                    'benefit'=>'Công dụng'
                ]
            );
            if ($request->input('longs') && $request->input('wides') && $request->input('highs') && $request->input('mass')) {
                Size::create(
                    [
                        'longs' => $request->input('longs'),
                        'wides' => $request->input('wides'),
                        'highs' => $request->input('highs'),
                        'mass' => $request->input('mass'),
                    ]
                );
            }
            $local_buy = implode(',', $request->input('listlocals'));
            $size_lasts =  Size::latest('id')->first()->toArray();
            $arr = (array)$size_lasts;
            $id_size = $arr['id'];
            Product::create(
                [
                    'name' => $request->input('name'),
                    'type' => $request->input('type_product'),
                    'code' => $request->input('code_product'),
                    'cat_id' => $request->input('cat_product'),
                    'producer_id' => (int)$request->input('producer'),
                    'size_id' => $id_size,
                    'tick' => $request->input('proper'),
                    'type_price' => $request->input('type_price'),
                    'price' => $request->input('price'),
                    'price_vat' => $request->input('price_vat'),
                    'coefficient' => $request->input('coefficient'),
                    'type_vat' => $request->input('type_vat'),
                    'packing' => $request->input('packing'),
                    'unit' => $request->input('unit'),
                    'local_buy' => $local_buy,
                    'amout_max' => $request->input('amout_max'),
                    'inventory' => $request->input('inventory'),
                    'general_info' => $request->input('info-general'),
                    'point' => $request->input('inherent'),
                    'dosage' => $request->input('amout'),
                    'contraindication' => $request->input('contraindications'),
                    'trademark'=>$request->input('trademark'),
                    'dosage_forms'=>$request->input('dosage_forms'),
                    'made_country'=>$request->input('made_country'),
                    'specification'=>$request->input('specification'),
                    'benefit'=>$request->input('benefit'),
                ]
            );
             $product_lasts =  Product::latest('id')->first()->toArray();
             $arrproduct = (array) $product_lasts;
             $id_product = $arrproduct['id'];
             $list_item=$request->input('feature');
            $strfeature = implode(',', $list_item);
            Feature_product::create(
                [
                    'name' => $strfeature,
                    'product_id'=>$id_product,
                ]
            );
            $image = '';
            if ($request->hasFile('images')) {
                $file = $request->images;              
                $filename = $file->getClientOriginalName();             
                $path = $file->move('public/shop/uploads/images/product', $file->getClientOriginalName());               
                $image = $filename;
                Img_product::create(
                    [
                        'image' => $image,
                        'product_id'=>$id_product,
                    ]
                );
            }
             return redirect('backend/danh-sach-san-pham')->with('status', 'Thêm sản phẩm thành công');
        } else {
            $producers = Producer::all();
            $units = Unit::all();
            $warehouses = Warehouse::all();
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
            $product_cats = data_tree1($data, 0);
            return view('shop.backend.product.add_product', compact('producers', 'units', 'warehouses','product_cats'));
        }
    }
    public function edit_product(Request $request,$id){
        if ($request->input('btnupdate_product')) {           
            $this->validate(
                $request,
                [
                    'name' => 'required|string|min:1',
                    'type_product' => 'required',
                    'code_product' => 'required',
                    'cat_product' => 'required',
                    'producer' => 'required',
                    'price' => 'required |numeric',
                    'price_vat' => 'required | numeric',
                    'packing' => 'required',
                    'inventory' => 'required',
                    'images' => 'required|image',
                    'info-general' => 'required',
                    'longs' => 'numeric',
                    'wides' => 'numeric',
                    'highs' => 'numeric',
                    'mass' => 'numeric',
                ],
                [
                    'required' => ':attribute không được để trống',
                    'min' => ':attribute có độ dài ít nhất :min ký tự',
                    'array' => ':attribute không được để trống',
                    'image' => ':attribute có dạng jpeg, png, bmp, gif, svg',
                    'numeric' => ':attribute có dạng số',
                ],
                [
                    'name' => 'Tên sản phẩm',
                    'type_product' => 'Loại sản phẩm',
                    'code_product' => 'Mã sản phẩm',
                    'cat_product' => 'Danh mục sản phẩm',
                    'producer' => 'Nhà sản xuất',
                    'price' => 'Giá bán',
                    'price_vat' => 'Giá bán',
                    'packing' => 'Quy cách đóng gói',
                    'inventory' => 'Tồn trong kho',
                    'images' => 'Hình ảnh',
                    'info-general' => 'Thông tin chung'
                ]
            );
            if ($request->input('longs') && $request->input('wides') && $request->input('highs') && $request->input('mass')) {
                Size::where('id', Product::find($id)->size_id)->update(
                    [
                        'longs' => $request->input('longs'),
                        'wides' => $request->input('wides'),
                        'highs' => $request->input('highs'),
                        'mass' => $request->input('mass'),
    
                    ]
                );
            }
            $local_buy = implode(',', $request->input('listlocals'));
            Product::where('id', $id)->update(
                [
                    'name' => $request->input('name'),
                    'type' => $request->input('type_product'),
                    'code' => $request->input('code_product'),
                    'cat_id' => $request->input('cat_product'),
                    'producer_id' => (int)$request->input('producer'),
                    'size_id' => Product::find($id)->size_id,
                    'tick' => $request->input('proper'),
                    'type_price' => $request->input('type_price'),
                    'price' => $request->input('price'),
                    'price_vat' => $request->input('price_vat'),
                    'coefficient' => $request->input('coefficient'),
                    'type_vat' => $request->input('type_vat'),
                    'packing' => $request->input('packing'),
                    'unit' => $request->input('unit'),
                    'local_buy' => $local_buy,
                    'amout_max' => $request->input('amout_max'),
                    'inventory' => $request->input('inventory'),
                    'general_info' => $request->input('info-general'),
                    'point' => $request->input('inherent'),
                    'dosage' => $request->input('amout'),
                    'contraindication' => $request->input('contraindications'),

                ]
            );
             $product_lasts =  Product::latest('id')->first()->toArray();
             $arrproduct = (array) $product_lasts;
             $id_product = $arrproduct['id'];
            $image = '';
            if ($request->hasFile('images')) {
                $file = $request->images;              
                $filename = $file->getClientOriginalName();             
                $path = $file->move('public/shop/uploads/images/product', $file->getClientOriginalName());               
                $image = 'public/shop/uploads/images/product/' . $filename;
                Img_product::create(
                    [
                        'image' => $image,
                        'product_id'=>$id_product,
                    ]
                );
            }
             return redirect('backend/danh-sach-san-pham')->with('status', 'Sửa sản phẩm thành công');
        } else {
            $sizes=Size::all();
            $product=Product::find($id);
            $producers = Producer::all();
            $units = Unit::all();
            $warehouses = Warehouse::all();
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
            $product_cats = data_tree1($data, 0);
            return view('shop.backend.product.edit_product', compact('producers', 'units', 'warehouses','product','sizes','product_cats'));
        }
    }
    public function list_product()
    {   
        $products=Product::paginate(10);        
        return view('shop.backend.product.list_product',compact('products'));
    }
    public function delete_product($id)
    {   
        Product::where('id', $id)->forceDelete();
        return redirect('backend/danh-sach-san-pham')->with('status', 'Bản ghi đã xóa vĩnh viễn!');
    }
    //don vi tinh
    public function unit()
    {

        $units = Unit::paginate(10);
        return view('shop.backend.product.unit_product', compact('units'));
    }
    public function unit_store(Request $request)
    {
        if ($request->input('btn_add_unit')) {
            $this->validate(
                $request,
                [
                    'name_unit' => 'required|string|min:1',
                ],
                [
                    'required' => ':attribute không được để trống',
                    'min' => ':attribute có độ dài ít nhất :min ký tự',
                ],
                [
                    'name_unit' => 'Tên đơn vị tính',
                ]
            );
            Unit::create(
                [
                    'name_unit' => $request->input('name_unit'),
                ]
            );
            return redirect('backend/don-vi-tinh')->with('status', 'Thêm đơn vị tính thành công');
        }
    }
    public function unit_delete($id)
    {
        Unit::where('id_unit', $id)->forceDelete();
        return redirect('backend/don-vi-tinh')->with('status', 'Bản ghi đã xóa vĩnh viễn!');
    }
    // ảnh sản phẩm
    public function img_product($id){
        $imgs=Product::find($id)->imgs;
        $imgs=$imgs[0]->image;
        $imgs = explode(",",$imgs);
        $products=Product::find($id);  
        return view('shop.backend.product.images_product',compact('products','imgs'));
    }
    public function addimg_product(Request $request,$id){
        if ($request->input('btnadd_img')) {
            $this->validate(
                $request,
                [
                    'images' => 'required|image',
                ],
                [
                    'required' => ':attribute không được để trống',
                    'image' => ':attribute có dạng jpeg, png, bmp, gif, svg',
                ],
                [
                    'images' => 'Hình ảnh',
                ]
            );
            // if ($request->hasFile('images')) {
            //     $file = $request->images;              
            //     $filename = $file->getClientOriginalName();             
            //     $path = $file->move('public/shop/uploads/images/product', $file->getClientOriginalName());               
            //     $image = 'public/shop/uploads/images/product/' . $filename;
            //     Img_product::create(
            //         [
            //             'image' => $image,
            //             'product_id'=>$id,
            //         ]
            //     );
            //     return redirect()->route('product.img', ['id'=>$id])->with('status','Thêm hình ảnh thành công');   
            // }
        }
    }
    public function deleteimg_product($id,$id_product){       
        $product=Product::find($id_product);
        $imgs=$product->imgs;
        $imgs=$imgs[0]->image;
        $imgms = explode(",",$imgs);     
        //\File::delete(public_path('shop/uploads/images/product/' .  $imgms[$id]));
        unset($imgms[$id]);      
        $imgs=implode(',', $imgms);
        Img_product::where('product_id', $id_product)->update(
            [
                'image' => $imgs,  
                'product_id'=>$id_product         

            ]
        );      
        return redirect()->route('product.img', ['id'=>$id_product])->with('status', 'Bản ghi đã xóa vĩnh viễn!');
    }
}
