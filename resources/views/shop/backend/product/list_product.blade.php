@extends('shop.layouts.backend')

@section('title', 'Danh sách sản phẩm')

@section('header_title', 'Danh sách sản phẩm')

@section('body_content')
<div class="card">
@if (session('status'))
    <div class="alert alert-success text-center export-noti">{{session('status')}}</div>
    @endif
    <div class="card-header font-weight-bold">
        <div class="row">
            <div class="col-lg-8 col-sm-12 titlehearder align-self-center d-flex">
                <h5 class="m-0">Danh sách sản phẩm</h5>
            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="form-search form-inline">
                    <form action="#" style="width:100%">
                        <input type="" id="input-search-after" style="width:100%" class="form-control form-search" placeholder="Nhập tên sản phẩm để tìm kiếm">
                        <button class="search-product"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="set-withscreen ">
        <div class="list-productwp">
            <div class="card-body">
                <div class="analytic status-product">
                    <a class="text-primary active-status">Tất cả<span class="text-muted">(10)</span></a>
                    <a class="text-primary">Đang bán<span class="text-muted">(5)</span></a>
                    <a class="text-primary">Ngừng bán<span class="text-muted">(20)</span></a>
                    <a class="text-primary">Tạm hết hàng<span class="text-muted">(20)</span></a>
                    <a class="text-primary">Gần hết hàng<span class="text-muted">(20)</span></a>
                    <a class="text-primary">Chờ kiểm duyệt<span class="text-muted">(20)</span></a>
                    <a class="text-primary">Từ chối<span class="text-muted">(20)</span></a>
                </div>
                <table class="table table-striped table-checkall" style="font-size:14px!important; border: none; table-layout: auto;width: 100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Đơn vị</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Tổng đơn đặt hàng</th>
                            <th scope="col">Tồn trong kho của tôi</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    @php
                        $temp=0;
                    @endphp
                    <tbody>
                        @foreach ($products as $product)
                        @php
                        $temp++;
                        @endphp
                        <tr class="">
                            <td style="width: 3%">{{$temp}}</td>
                            <td style="width: 35%">
                                <div class="d-flex">
                                    <div class="d-flex align-items-center">
                                        <img style="width:40px" src="{{asset($product->imgs['0']['image'])}}" alt="">
                                    </div>
                                    <div class="info-product ml-3">
                                        <p class="text-success font-weight-bold">{{$product['name']}}</p>
                                        <p>ID: {{$product['id']}}</p>
                                        <p>Mã: {{$product['code']}}</p>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 5%">{{$product['unit']}}</td>
                            <td style="width: 11%">{{$product['create_at']}}</td>
                            <td style="width: 10%">0</td>
                            <td style="width: 13%">{{$product['inventory']}}</td>
                            <td style="width: 8%"><span class="badge badge-success">Chờ kiểm duyệt</span></td>
                            <td style="width: 15%">
                                <a href="" class="btn btn-info btn-sm rounded-0 text-white " type="button" data-toggle="tooltip" data-placement="top" title="Xem sản phẩm trên web"><i class="fas fa-eye rounded-circle"></i></a>
                                <a href="{{route('product.edit',$product->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Sửa sản phẩm"><i class="fa fa-edit"></i></a>
                                <a href="{{route('product.delete',$product->id)}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                <a href="{{route('product.img',$product->id)}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Thêm ảnh sản phẩm"><i class="fas fa-plus"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$products->links()}}
            </div>
        </div>
    </div>

</div>
@endsection