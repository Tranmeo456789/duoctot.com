<?php

namespace App\Http\Controllers\Shop\BackEnd;

use App\Model\Shop\Producer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProducerController extends Controller
{
    public function list_producer()
    {
        $producers = Producer::paginate(10);
        return view('shop.backend.producer.list_producer', compact('producers'));
    }
    public function add_producer()
    {

        return view('shop.backend.producer.add_producer');
    }
    function store_producer(Request $request)
    {

        if ($request->input('btn_add_producer')) {

            $this->validate(
                $request,
                [
                    'name_producer' => 'required|string|min:1',

                ],
                [
                    'required' => ':attribute không được để trống',
                    'min' => ':attribute có độ dài ít nhất :min ký tự',
                ],
                [
                        'name_producer'=>'Tên nhà sản xuất',
               ]

            );
            Producer::create(
                [                
                    'name_producer' => $request->input('name_producer'),    
                ]
              );
            return redirect('backend/danh-sach-nha-san-xuat')->with('status','Thêm nhà sản xuất thành công');
        }
    }
    public function edit_producer($id)
    {
        $producer = Producer::find($id);
        return view('shop.backend.producer.edit_producer', compact('producer'));
    }
    function update_producer(Request $request, $id)
    {
        if ($request->input('btn_update_producer')) {
            $request->validate(
                [
                    'name_producer' => 'required|string|min:1',
                ],
                [
                    'required' => ':attribute không được để trống',
                    'min' => ':attribute có độ dài ít nhất :min ký tự',
                ],
                [
                    'name_producer' => 'Tên nhà sản xuất',
                ]
            );
            Producer::where('id_producer', $id)->update(
                [
                    'name_producer' => $request->input('name_producer'),

                ]
            );
            return redirect('backend/danh-sach-nha-san-xuat')->with('status', 'Cập nhật nhà sản xuất thành công');
        }
    }
    function delete_producer($id)
    {
        Producer::where('id_producer', $id)->forceDelete();
        return redirect('backend/danh-sach-nha-san-xuat')->with('status', 'Bản ghi đã xóa vĩnh viễn!');
    }
}
