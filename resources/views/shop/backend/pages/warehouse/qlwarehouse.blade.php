@extends('shop.layouts.backend')

@section('title', 'Quản lý kho hàng')

@section('header_title', 'Quản lý kho hàng')

@section('body_content')
<div class="card">
    <div class="card-header font-weight-bold">
        <div class="row">
            <div class="col-xl-6 col-lg-6">
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
            <div class="card-body table-warehouse">
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr>
                            <th scope="col" rowspan="2" class="text-center">Sản phẩm</th>
                            @foreach($warehouses as $warehouse)
                            <th scope="col" colspan="2" class="text-center">{{$warehouse['name']}}</th>
                            @endforeach
                        </tr>
                        <tr>
                            @foreach($warehouses as $warehouse)
                            <th scope="col" class="text-center">TỒN KHO KHẢ DỤNG</th>
                            <th scope="col" class="text-center">SỐ LƯỢNG CẦN NHẬP</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        @php
                        $img_product = explode(',', $product['image']);
                        @endphp
                        <tr class="">
                            <td style="width: 40%">
                                <div class="d-flex">
                                    <img style="width:60px;height:60px" src="{{asset('public/shop/uploads/images/product/'.$img_product[0])}}" alt="">
                                    <div class="info-product ml-3">
                                        <p class="text-success font-weight-bold">{{$product['name']}}</p>
                                        <p>ID: {{$product['id']}}</p>
                                        <p>Mã: {{$product['code']}}</p>
                                    </div>
                                </div>
                            </td>
                            @foreach($warehouses as $k=>$warehouse)
                            <td style="width: 15%" class="text-center">{{$numper_products[$k][$product['id']]}}</td>
                            <td style="width: 15%" class="text-center text-danger">3</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection