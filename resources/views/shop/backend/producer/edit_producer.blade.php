@extends('shop.layouts.backend')

@section('title', 'Sửa nhà sản xuất')

@section('header_title', 'Sửa nhà sản xuất')

@section('body_content') 
    <div class="card mt-2 ml-1">
        <div class="card-header font-weight-bold">
            Sửa nhà sản xuất
        </div>
        <div class="card-body">
            <form action="{{route('producer.update',$producer->id_producer)}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Tên nhà sản xuất<span class="text-danger" >*</span></label>
                    <input class="form-control" type="text" name="name_producer" value="{{$producer->name_producer}}" id="" placeholder="Nhập tên nhà sản xuất" autocomplete="off" >
                    @error('name_producer')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>                            
                <div class="text-center"><button type="submit" name="btn_update_producer" value="1" class="btn btn-primary">Cập nhật</button></div>
            </form>
        </div>
    </div>

@endsection