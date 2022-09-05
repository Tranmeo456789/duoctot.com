@extends('shop.layouts.backend')

@section('title', 'Thêm kho hàng')

@section('header_title', 'Thêm kho hàng')

@section('body_content')
<div class="card">
    <div class="card-header font-weight-bold">
        Thêm kho hàng
    </div>
    <div class="card-body">
        <form action="{{route('warehouse.store')}}" method="POST">
            {!! csrf_field() !!}
            <div class="row">
                <div class="form-group col-12">
                    <label for="name">Tên kho hàng<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="name" id="" placeholder="Nhập tên kho hàng" autocomplete="off">
                    @if($errors->has('name'))
                    <small class="text-danger">{{$errors->first('name')}}</small>
                    @endif
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="form-group">
                        <label for="intro">Vị trí kho hàng<span class="text-danger">*</span></label>
                        <select class="form-control" id="" name="local">
                            <option value="Hà Nội">Hà Nội</option>
                            <option value="Tp Hồ Chí Minh">Tp Hồ Chí Minh</option>
                            <option value="Đà Nẵng">Đà Nẵng</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="text-center"><button type="submit" name="btn_add_warehouse" value="1" class="btn btn-primary">Thêm mới</button></div>
        </form>
    </div>
</div>
@endsection