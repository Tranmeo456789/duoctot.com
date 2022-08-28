<?php

namespace App\Http\Controllers\Shop\BackEnd;

use App\Model\Shop\Producer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProducerController extends Controller
{
    public function list()
    {
        $producers = Producer::paginate(10);
        return view('shop.backend.producer.list', compact('producers'));
    }
    public function add(Request $request)
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
        }else{
            return view('shop.backend.producer.add');
        }       
    }
    public function edit(Request $request, $id)
    {     
        if ($request->input('btn_update_producer')) {
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
            Producer::where('id_producer', $id)->update(
                [
                    'name_producer' => $request->input('name_producer'),

                ]
            );
            return redirect('backend/danh-sach-nha-san-xuat')->with('status', 'Cập nhật nhà sản xuất thành công');
        }else{
            $producer = Producer::find($id);
            return view('shop.backend.producer.edit', compact('producer'));
        }   
    }
    function delete($id)
    {
        Producer::where('id_producer', $id)->forceDelete();
        return redirect('backend/danh-sach-nha-san-xuat')->with('status', 'Bản ghi đã xóa vĩnh viễn!');
    }
}
