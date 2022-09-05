@extends('shop.layouts.backend')

@section('title', 'Ảnh sản phẩm')

@section('header_title', 'Ảnh sản phẩm')

@section('body_content')
<div class="row m-0">
    <div class="col-lg-5 col-sm-12 px-0">
        <div class="card">
            <div class="card-header font-weight-bold">
                Thêm ảnh sản phẩm<span class="text-danger">*</span>
            </div>
            <div class="card-body">
                <div class="container-fluid text-center">
                    <div class="content">
                        <div class="text-left">
                            <form action="{{route('dropzone.fupload')}}" class="dropzone" id="dropzoneForm" method="POST">
                                {!! csrf_field() !!}
                                <input type="hidden" name="id_product" id="get-idproduct" value="{{$products['id']}}">
                            </form>
                            <button type="" class="btn btn-info" id="submit-all1">Upload</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-7 col-sm-12 px-0">
        <div class="card">
            <div class="card-header font-weight-bold">
                Danh sách hình ảnh {{$products['name']}}
            </div>
            <div class="card-body">
                <div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        @php
                        $temp=0;
                        @endphp
                        <tbody id="list-img">
                            @foreach($imgs as $img)
                            @php
                            $temp++;
                            @endphp
                            <tr>
                                <th scope="row" style="width: 10%">{{$temp}}</th>
                                <td style="width: 70%"><img style="width:60px;height:60px" src="{{asset($img['image'])}}" alt=""></td>
                                <td style="width: 20%">
                                    <a href="{{route('product.img.delete',[$img->id,$products->id])}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
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