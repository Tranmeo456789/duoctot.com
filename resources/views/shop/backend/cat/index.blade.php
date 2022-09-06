@extends('shop.layouts.backend')

@section('title', 'Danh mục sản phẩm')

@section('header_title', 'Danh mục sản phẩm')

@section('body_content')
<div class="row m-0">
    <div class="col-lg-4 col-sm-12 px-0">
        <div class="card">
            <div class="card-header font-weight-bold">
                Thêm mới danh mục
            </div>
            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success text-center">{{session('status')}}</div>
                @endif
                <form action="{{route('cat_product.add')}}" method="POST" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label for="">Tên danh mục</label>
                        <input class="form-control" type="text" name="name" value="" id="" autocomplete="off">
                        @if($errors->has('name'))
                        <small class="text-danger">{{$errors->first('name')}}</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="intro">Chọn danh mục cha</label>
                        <select id="" class="form-control" name="cat_parent">
                            <option value="0">Chọn danh mục</option>
                            @foreach($product_cats as $catp1)
                            @if($catp1['level'] == 0 )
                            <option value="{{$catp1->id}}" class="font-weight-bold">{{$catp1->name}}</option>
                            @endif
                            @if($catp1['level'] == 1)
                            <option value="{{$catp1->id}}">{{ str_repeat('-', $catp1['level']) }}{{$catp1->name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Hình ảnh danh mục</label>
                        <input type="file" class="form-control" name="image" />
                        @if($errors->has('image'))
                        <small class="text-danger">{{$errors->first('image')}}</small>
                        @endif
                    </div>
                    <button type="submit" name="btn_add_catproduct" value="1" class="btn btn-primary">Thêm mới</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-sm-12 px-0">
        <div class="card">
            <div class="card-header font-weight-bold">
                Danh sách danh mục({{$num_cat}})
            </div>
            <div class="card-body">
            <div class="" style="height: 60vh;overflow-y: scroll;">
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
                                <th scope="row" style="width: 20%">
                                    <div><img src="{{asset('public/shop/uploads/images/product/'.$catp['image'])}}" alt="" style="width:30px;"></div>
                                </th>
                                <td style="width: 20%">
                                    <a href="{{route('cat_product.edit',$catp->slug)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Sửa danh mục sản phẩm"><i class="fa fa-edit"></i></a>
                                    <a href="{{route('cat_product.delete',$catp->id)}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Bạn có chắc chắn xóa bản ghi này ?')"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection