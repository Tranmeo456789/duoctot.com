<?php

namespace App\Http\Controllers\Shop\BackEnd;

use Illuminate\Http\Request;
use App\Model\Shop\Warehouse;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class WarehouseController extends Controller
{
    public function index()
    {
        return view('shop.backend.warehouse.index');
    }
    public function add(Request $request)
    {
        if ($request->input('btn_add_warehouse')) {
            $this->validate(
                $request,
                [
                    'name' => 'required|string|min:1',
                    'local' => 'required',
                ],
                [
                    'required' => ':attribute không được để trống',
                    'min' => ':attribute có độ dài ít nhất :min ký tự',
                ],
                [
                    'name' => 'Tên kho hàng',
                ]
            );
            Warehouse::create(
                [
                    'name' => $request->input('name'),
                    'local' => $request->input('local'),
                ]
            );
            return redirect('backend/danh-sach-kho-hang')->with('status', 'Thêm kho hàng thành công');
        } else {
            return view('shop.backend.warehouse.add');
        }
    }
    public function list(){
        $warehouses=Warehouse::paginate(10);
        return view('shop.backend.warehouse.list',compact('warehouses'));
    }
    public function edit(Request $request,$id)
    {
        if ($request->input('btn_update_warehouse')) {
            $this->validate(
                $request,
                [
                    'name' => 'required|string|min:1',
                    'local' => 'required',
                ],
                [
                    'required' => ':attribute không được để trống',
                    'min' => ':attribute có độ dài ít nhất :min ký tự',
                ],
                [
                    'name' => 'Tên kho hàng',
                ]
            );
            Warehouse::where('id', $id)->update(
                [
                    'name' => $request->input('name'),
                    'local' => $request->input('local'),
                ]
            );
            return redirect('backend/danh-sach-kho-hang')->with('status', 'Cập nhật kho hàng thành công');
        }else{
            $warehouse = Warehouse::find($id);
            return view('shop.backend.warehouse.edit', compact('warehouse'));
        }   
    }
    function delete($id)
    {
        Warehouse::where('id', $id)->forceDelete();
        return redirect('backend/danh-sach-kho-hang')->with('status', 'Bản ghi đã xóa vĩnh viễn!');
    }
}
