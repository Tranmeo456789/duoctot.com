<?php

namespace App\Http\Controllers\Shop\Backend;

use Illuminate\Http\Request;
use App\Model\Shop\Cat_product;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class Cat_productController extends Controller
{
    public function index()
    {
        $catps = Cat_product::paginate(10);
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
        $num_cat = Cat_product::all()->count();
        return view('shop.backend.cat.index', compact('catps', 'num_cat', 'product_cats'));
    }
    public function add(Request $request)
    {
        if ($request->input('btn_add_catproduct')) {
            $this->validate(
                $request,
                [
                    'name' => 'required|unique:cat_products|string|min:1',
                    'image'=>'image'
                ],
                [
                    'unique' => ':attribute đã tồn tại',
                    'required' => ':attribute không được để trống',
                    'min' => ':attribute có độ dài ít nhất :min ký tự',
                    'image' => ':attribute có dạng hình ảnh'
                ],
                [
                    'name' => 'Tên danh mục',
                    'image' => 'Trường này'
                ]
            );
            $image = '';
            if ($request->hasFile('image')) {
                $file = $request->image;
                $filename = $file->getClientOriginalName();
                $path = $file->move('public/shop/uploads/images/product', $file->getClientOriginalName());
                $image = 'public/shop/uploads/images/product/' . $filename;
            }
            Cat_product::create(
                [
                    'name' => $request->input('name'),
                    'image' => $image,
                    'parent_id' => $request->input('cat_parent'),
                    'slug'  => Str::slug($request->input('name')),
                ]
            );
            return redirect('backend/danh-sach-danh-muc-san-pham')->with('status', 'Thêm danh mục thành công');
        }
    }
    public function edit(Request $request, $slug)
    {
        if ($request->input('btn_update_catproduct')) {
            $catpcs = Cat_product::where('slug', $slug)->get();
            if($request->input('name')==$catpcs[0]->name){
                $this->validate(
                    $request,
                    [
                        'name' => 'required|string|min:1',
                        'image' => 'image'
                    ],
                    [
                        'required' => ':attribute không được để trống',
                        'min' => ':attribute có độ dài ít nhất :min ký tự',
                        'image' => ':attribute có dạng hình ảnh'
                    ],
                    [
                        'name' => 'Tên danh mục',
                        'image' => 'Trường này'
                    ]
                );
            }else{
                $this->validate(
                    $request,
                    [
                        'name' => 'required|unique:cat_products|string|min:1',
                        'image' => 'image'
                    ],
                    [
                        'unique' => ':attribute đã tồn tại',
                        'required' => ':attribute không được để trống',
                        'min' => ':attribute có độ dài ít nhất :min ký tự',
                        'image' => ':attribute có dạng hình ảnh'
                    ],
                    [
                        'name' => 'Tên danh mục',
                        'image' => 'Trường này'
                    ]
                );
            }
            
            $image = '';
            if ($request->hasFile('image')) {
                $file = $request->image;
                $filename = $file->getClientOriginalName();
                $path = $file->move('public/shop/uploads/images/product', $file->getClientOriginalName());
                $image = 'public/shop/uploads/images/product/' . $filename;
            }
            Cat_product::where('slug', $slug)->update(
                [
                    'name' => $request->input('name'),
                    'image' => $image,
                    'parent_id' => $request->input('cat_parent'),
                    'slug'  => Str::slug($request->input('name')),
                ]
            );
            return redirect('backend/danh-sach-danh-muc-san-pham')->with('status', 'Cập nhật danh mục thành công');
        } else {
            $catps = Cat_product::paginate(10);
            $catpcs = Cat_product::where('slug', $slug)->get();
            $catpc = $catpcs[0];
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
            $num_cat = Cat_product::all()->count();
            return view('shop.backend.cat.edit', compact('catps', 'catpc', 'num_cat', 'product_cats'));
        }
    }
    public function delete($id)
    {
        Cat_product::where('id', $id)->forceDelete();
        return redirect('backend/danh-sach-danh-muc-san-pham')->with('status', 'Xóa danh mục thành công');
    }
}
