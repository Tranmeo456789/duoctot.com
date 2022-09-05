@extends('shop.layouts.backend')

@section('title', 'Danh sách nhà sản xuất')

@section('header_title', 'Danh sách nhà sản xuất')

@section('body_content')

<div class="card">
    @if (session('status'))
    <div class="alert alert-success text-center export-noti">{{session('status')}}</div>
    @endif
    <div class="card-header font-weight-bold">
        Danh sách kho hàng
    </div>
    <div class="set-withscreen">
        <div class="card-body list-productwp">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Tên kho hàng</th>
                        <th scope="col">Vị trí kho</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                @php
                    $temp=0;
                @endphp
                <tbody>
                    @foreach ($warehouses as $warehouse)
                    @php
                        $temp++;
                    @endphp
                    <tr>
                        <th scope="row" style="width: 10%">{{$temp}}</th>
                        <td style="width: 40%">{{$warehouse->name}}</td>
                        <td style="width: 30%">{{$warehouse->local}}</td>
                        <td style="width: 20%">
                            <a href="{{route('warehouse.edit',$warehouse->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="fa fa-edit"></i></a>
                            <a href="{{route('warehouse.delete',$warehouse->id)}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Xóa" onclick="return confirm('Bạn có chắc chắn xóa bản ghi này ?')"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$warehouses->links()}}
        </div>
    </div>
</div>
@endsection