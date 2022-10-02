@extends('shop.layouts.backend')

@section('title',$pageTitle)
@section('content')

<section class="content">
    @include("$moduleName.blocks.notify")
    <div class="text-center py-2">
        <span class="noti-statusorrder text-success"></span>
    </div>
    <div class="container-fluid ">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-primary">
                    @include("$moduleName.blocks.x_title", ['title' => 'Danh sách đơn hàng'])
                    <div class="card-header">
                        <div class=" font-weight-bold">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 titlehearder">
                                    <div class="form-search form-inline">
                                        <form action="#" style="width:100%">
                                            <input type="" id="input-search-after" style="width:100%" class="form-control form-search" placeholder="Nhập mã đơn hàng để tìm kiếm">
                                        </form>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-12">
                                    <div class="text-capitalize">
                                        <label for="">Thời gian:</label>
                                        <input type="date" class="border-top-0 border-left-0 border-right-0"> ~ <input type="date" class="border-top-0 border-left-0 border-right-0">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="set-withscreen">
                        <div class="list_orderm">
                            <div class="card-body">
                                <div class="analytic status-order status-product" style="font-size:14px">
                                    <a class="text-primary active-status">Tất cả<span class="text-muted">(10)</span></a>
                                    <a class="text-primary">Đã xác nhận<span class="text-muted">(20)</span></a>
                                    <a class="text-primary">Đang xử lý<span class="text-muted">(20)</span></a>
                                    <a class="text-primary">Đang giao hàng<span class="text-muted">(20)</span></a>
                                    <a class="text-primary">Đã giao hàng<span class="text-muted">(20)</span></a>
                                    <a class="text-primary">Hoàn tất<span class="text-muted">(20)</span></a>
                                    <a class="text-primary">Đã hủy<span class="text-muted">(20)</span></a>
                                </div>
                                <table class="table table-striped table-checkall" style="font-size:14px!important; border: none; table-layout: auto;width: 100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">Mã đơn hàng</th>
                                            <th scope="col">Doanh thu</th>
                                            <th scope="col">Ngày đặt hàng</th>
                                            <th scope="col">Trạng thái đơn hàng</th>
                                            <th scope="col">Trạng thái đối soát</th>
                                            <th scope="col" class="text-center">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                        <tr class="">
                                            <td style="width: 20%"><a href="{{route('order.detail',$order->code_order)}}">{{$order->code_order}}</a></td>
                                            <td style="width: 16%">{{ number_format( $order['total'], 0, "" ,"." )}}đ</td>
                                            <td style="width: 16%">{{substr($order->created_at, 8, 2)}}-{{substr($order->created_at, 5, 2)}}-{{substr($order->created_at, 0, 4)}}</td>
                                            <td style="width: 16%">
                                                @php
                                                $status_curent = $order->status;
                                                foreach ($list_status as $k => $item) {
                                                if ($status_curent == $item) {
                                                unset($list_status[$k]);
                                                }
                                                }
                                                @endphp
                                                <form action="" method="GET">
                                                    {!! csrf_field() !!}
                                                    <select name="status_order" data-id="{{$order->id}}" class="label-order custom-select sources update-status">
                                                        <option value="{{$order->status}}">{{$order->status}}</option>
                                                        @foreach ($list_status as $item9)
                                                        <option value="{{$item9}}">{{$item9}}</option>
                                                        @endforeach
                                                    </select>
                                                </form>
                                                @php
                                                $list_status[]=$order->status;
                                                @endphp
                                            </td>
                                            <td style="width: 16%" class="{{$order->status == 'Đã thanh toán'?'text-success':'text-danger'}}">{{$order->status_control}}</td>
                                            <td style="width: 16%" class="text-center">
                                                <a href="{{route('order.detail',$order->code_order)}}" class="btn btn-info btn-sm rounded-0 text-white " type="button" data-toggle="tooltip" data-placement="top" title="Xem chi tiết đơn hàng"><i class="fas fa-eye rounded-circle"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{$orders->links()}}

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection