@extends('shop.layouts.backend')

@section('title', 'Chi tiết đơn hàng')

@section('header_title', 'Chi tiết đơn hàng')

@section('body_content')

<div class="card mt-2 ml-1">
    <div class="card-header font-weight-bold bg-info text-light">
        Thông tin đơn hàng
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label for="intro">Mã đơn hàng</label>
                    <input class="form-control" type="text" name="" id="" value="{{$order[0]->code_order}}" disabled>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="intro">Trạng thái</label>
                    <input class="form-control" type="text" name="" id="" value="{{$order[0]->status}}" disabled>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="intro">Tổng tiền</label>
                    <input class="form-control" type="text" name="" id="" value="{{ number_format( $order[0]['total'], 0, '' ,'.' )}}đ" disabled>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label for="intro">Số lượng sản phẩm</label>
                    <input class="form-control" type="text" name="" id="" value="{{$order[0]->qty_total}}" disabled>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="intro">Số lượng mặt hàng</label>
                    <input class="form-control" type="text" name="" id="" value="{{count($list_qty)}}" disabled>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="intro">Hình thức thanh toán</label>
                    <input class="form-control" type="text" name="" id="" value="{{$order[0]->payment}}" disabled>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label for="intro">Hình thức giao hàng</label>
                    <input class="form-control" type="text" name="" id="" value="Giao hàng tiêu chuẩn" disabled>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="intro">Ghi chú</label>
                    <input class="form-control" type="text" name="" id="" value="" disabled>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="intro">Ngày tạo</label>
                    <input class="form-control" type="text" name="" id="" value="{{$order[0]->created_at}}" disabled>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card mt-2 ml-1">
    <div class="card-header font-weight-bold bg-info text-light">
        Sản phẩm đã đặt
    </div>
    <div class="card-body">
        <table class="table table-striped table-checkall" style="font-size:14px!important; border: none; table-layout: auto;width: 100%">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Mã sản phẩm</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Số lượng đặt</th>
                    <th scope="col">Số lượng giao</th>
                    <th scope="col">Tổng doanh thu</th>
                </tr>
            </thead>
            <tbody>
                @php
                $index=0;
                @endphp
                @foreach($ls_product_order as $product)
                @php
                $img_product = explode(',', $product['image']);
                @endphp
                <tr class="">
                    <td style="width: 7%">{{$product->id}}</td>
                    <td style="width: 13%">{{$product->code}}</td>
                    <td style="width: 22%" class="font-weight-bold">{{$product->name}}</td>
                    <td style="width: 10%"><div class="rimg-center img-60"><img src="{{asset('public/shop/uploads/images/product/'.$img_product[0])}}" alt=""></div></td>
                    <td style="width: 10%">{{ number_format( $product['price'], 0, "" ,"." )}}đ</td>
                    <td style="width: 12%" class="text-center">{{$list_qty[$index]}}</td>
                    <td style="width: 12%">{{$list_qty[$index]}}</td>
                    <td style="width: 14%">{{ number_format( $product['price']*$list_qty[$index], 0, "" ,"." )}}đ</td>
                </tr>
                @php
                $index++;
                @endphp
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection