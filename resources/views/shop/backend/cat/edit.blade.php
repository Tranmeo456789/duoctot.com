@extends('shop.layouts.backend')

@section('title', 'Danh mục sản phẩm')

@section('header_title', 'Danh mục sản phẩm')

@section('body_content')
<div class="row m-0">
    <div class="col-lg-4 col-sm-12 px-0">
        <div class="card">
            <div class="card-header font-weight-bold">
                Cập nhật danh mục
            </div>
            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success text-center">{{session('status')}}</div>
                @endif
                <form action="{{route('cat_product.update',$catpc->slug)}}" method="POST" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label for="">Tên danh mục</label>
                        <input class="form-control" type="text" name="name" value="{{$catpc->name}}" id="" autocomplete="off">
                        @if($errors->has('name'))
                        <small class="text-danger">{{$errors->first('name')}}</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="intro">Chọn danh mục cha</label>
                        <select id="" class="form-control" name="cat_parent">
                            <option value="0">Chọn danh mục</option>
                            @foreach($product_cats as $catp1)
                                <option value="{{$catp1->id}}">{{ str_repeat('-', $catp1['level']) }}{{$catp1->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Hình ảnh danh mục<span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="image" />
                        @if($errors->has('image'))
                        <small class="text-danger">{{$errors->first('image')}}</small>
                        @endif
                    </div>
                    <button type="submit" name="btn_update_catproduct" value="1" class="btn btn-primary">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-sm-12 px-0">
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between">
                <h6 class="mb-0">Danh sách danh mục({{$num_cat}})</h6>
                <div class="d-flex align-items-center">
                    <a href="{{route('cat_product.list')}}" class="bg-success text-light" style="padding: 2px 8px;border-radius: 9px;font-size: 13px;">Thêm mới</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">STT</th>
                            <th scope="col">Tên danh mục</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    @php
                    $temp=0;
                    @endphp
                    <tbody>
                    @foreach ($product_cats as $catp)
                        @php
                        $temp++;
                        @endphp
                        <tr>
                            <th scope="row" style="width: 10%">{{$temp}}</th>
                            <td style="width: 50%">{{ str_repeat('-', $catp['level']) }}{{$catp['name']}}</td>
                            <th scope="row" style="width: 20%"><div><img src="{{asset($catp['image'])}}" alt="" style="width:30px;"></div></th>
                            <td style="width: 20%">
                                <a href="{{route('cat_product.edit',$catp->slug)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Sửa danh mục sản phẩm"><i class="fa fa-edit"></i></a>
                                <a href="{{route('cat_product.delete',$catp->id)}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Bạn có chắc chắn xóa bản ghi này ?')"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$catps->links()}}
            </div>
        </div>
    </div>
</div>
@endsection