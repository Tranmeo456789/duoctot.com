@extends('shop.layouts.backend')

@section('title',$pageTitle)
@section('content')

<div class="card mt-2 ml-1">
    <div class="card-header font-weight-bold bg-info text-light">
        Thông tin đơn hàng
    </div>
    <div class="card-body pt-0">
        <div class="row">         
            <div class="col-12 text-center py-2">
                <span class="noti-statusorrder text-success"></span>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="intro">Mã đơn hàng</label>
                    <input class="form-control" type="text" name="" id="" value="{{$order[0]->code_order}}" disabled>
                </div>
            </div>
            <div class="col-4">
                <form action="" method="GET">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label for="intro"  class="label-order">Trạng thái</label>
                        <select name="status_order" data-id="{{$order[0]->id}}" class="form-control update-status">
                            <option value="{{$order[0]->status}}">{{$order[0]->status}}</option>
                            @foreach ($list_status as $item9)
                                <option value="{{$item9}}" >{{$item9}}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
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
                    <label for="intro">Thời gian đặt hàng</label>
                    <input class="form-control" type="text" name="" id="" value="{{substr($order[0]->created_at, 10, 9)}} {{substr($order[0]->created_at, 8, 2)}}-{{substr($order[0]->created_at, 5, 2)}}-{{substr($order[0]->created_at, 0, 4)}}" disabled>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card mt-2 ml-1">
    <div class="card-header font-weight-bold bg-info text-light">
        Thông tin khách hàng
    </div>
    <div class="card-body">
        <table class="table table-striped table-checkall" style="font-size:14px!important; border: none; table-layout: auto;width: 100%">
            <thead>
                <tr>
                    <th scope="col">Họ và tên</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Email</th>
                    <th scope="col">Địa chỉ</th>
                </tr>
            </thead>
            <tbody>   
                <tr class="">
                    <td style="width: 20%">{{$customer->name}}</td>
                    <td style="width: 20%">{{$customer->phone}}</td>
                    <td style="width: 20%">{{$customer->email}}</td>
                    <td style="width: 40%">{{$customer->address_detail}}<span>,</span>{{$customer->address}}</td>
                </tr>
            </tbody>
        </table>
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
                    <td style="width: 10%">
                        <div class="rimg-center img-60"><img src="{{asset($product['image'])}}" alt=""></div>
                    </td>
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