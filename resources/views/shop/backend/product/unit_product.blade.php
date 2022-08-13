@extends('shop.layouts.backend')

@section('title', 'Đơn vị tính')

@section('header_title', 'Đơn vị tính')

@section('body_content') 
    <div class="row m-0 mt-3">
        <div class="col-4 pr-1">
            <div class="card">
                <div class="card-header font-weight-bold">
                   Đơn vị tính
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success text-center">{{session('status')}}</div>
                    @endif
                    <form action="{{route('unit.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Đơn vị tính</label>
                            <input class="form-control" type="text" name="name_unit" id="" autocomplete="off">
                            @error('name_unit')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <button type="submit" name="btn_add_unit" value="1" class="btn btn-primary">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-8 pl-0">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Danh sách đơn vị tính
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Tên đơn vị tính</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        @php
                            $temp=0;
                        @endphp
                        <tbody>
                            @foreach ($units as $unit)
                                @php
                                    $temp++;
                                @endphp
                                <tr>
                                    <th scope="row" style="width: 10%">{{$temp}}</th>
                                    <td style="width: 70%">{{$unit->name_unit}}</td>
                                    <td style="width: 20%">
                                        <a href="{{route('unit.delete',$unit->id_unit)}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Bạn có chắc chắn xóa bản ghi này ?')"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$units->links()}}
                </div>
            </div>
        </div>       
    </div>
@endsection