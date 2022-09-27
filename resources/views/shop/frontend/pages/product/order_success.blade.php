@extends('shop.layouts.frontend')

@section('content')
<div class="cbr py-4">
    <div class="wp-inner">
        <div class="wp-order-success">
            <div class="text-center box-dhtc">
                <span class="icon-order-success">
                    <i class="fas fa-check"></i>
                </span>
                <h2 class="title-dhtc">Đặt hàng thành công</h2>
                <p>Quý khách có thể theo dõi tình trạng đơn hàng bằng cách</p>
                <p><span class="font-weight-bold">"Tra cứu đơn hàng"</span> ngay bên dưới</p>
            </div>
            <div class="title-info-order">
                <h1 class=" pd-order">Thông tin giao hàng</h1>
            </div>
            <div class="item-info">
                <table class="table pd-order mb-0" id="tbList">
                    <tbody>
                        <tr class="bb_order">
                            <td style="width: 30%">Số đơn hàng</td>
                            <td style="width: 70%" class='name'>{{$orders[0]['code_order']}}<a href=""><span class="search-ttdh">Tra cứu đơn hàng</span></a></td>
                        </tr>
                        <tr class="bb_order">
                            <td style="width: 30%">Họ và tên người đặt</td>
                            <td style="width: 70%" class='name'>{{$orders[0]['name']}}</td>
                        </tr>
                        <tr class="bb_order pb-1">
                            <td style="width: 30%">Số điện thoại người đặt</td>
                            <td style="width: 70%" class='name'>{{$orders[0]['phone']}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="title-info-order">
                <h1 class=" pd-order">Thông tin nhận hàng & thanh toán</h1>
            </div>
            <div class="item-info">
                <table class="table pd-order mb-0" id="tbList">
                    <tbody>
                        <tr class="bb_order">
                            <td style="width: 30%">Họ và tên người nhận</td>
                            <td style="width: 70%" class='name'>{{$orders[0]['name']}}</td>
                        </tr>
                        <tr class="bb_order">
                            <td style="width: 30%">Số điện thoại người nhận</td>
                            <td style="width: 70%" class='name'>{{$orders[0]['phone']}}</td>
                        </tr>
                        <tr class="bb_order">
                            <td style="width: 30%">Nhận hàng tại</td>
                            <td style="width: 70%" class='name'>{{$orders[0]['address_detail']}},{{$orders[0]['address']}}</td>
                        </tr>
                        <tr class="bb_order">
                            <td style="width: 30%">Phương thức thanh toán</td>
                            <td style="width: 70%" class='name'>Chưa thanh toán</td>
                        </tr>
                        <tr class="bb_order">
                            <td style="width: 30%">Thời gian dự kiến</td>
                            <td style="width: 70%" class='name'>Có hàng trước 15h00 ngày 20/9/2022</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="item-info">
                <table class="table pd-order mb-0" id="tbList">
                    <thead>
                        <tr>
                            <th scope="col" colspan="2">Thông tin đơn hàng</th>
                            <th scope="col">Đơn vị</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $index=0;
                        @endphp
                        @foreach($ls_product_order as $product)
                       
                        <tr class="bb_order">
                        <td style="width: 10%" class='name'><div class="rimg-center img-60"><div><img src="{{asset($product['image'])}}" alt=""></div></div></td>
                            <td style="width: 48%">
                                <div class="d-flex">
                                    <p class="namep-order">{{$product['name']}}</p>
                                </div>
                            </td>
                            <td style="width: 16%" class='name'>{{$product['unit']}}</td>
                            <td style="width: 10%">{{$list_qty[$index]}}</td>
                            <td style="width: 16%" class='text-right'>{{ number_format( $product['price']*$list_qty[$index], 0, "" ,"." )}}đ</td>
                        </tr>
                        @php
                        $index++;
                        @endphp
                        @endforeach
                        <tr class="bb_order">
                            <td colspan="3" style="width: 16%" class="text-right">Tổng tiền</td>
                            <td style="width: 16%" class='text-right'>{{ number_format( $orders[0]['total'], 0, "" ,"." )}}đ</td>
                        </tr>
                        <tr class="bb_order">
                            <td colspan="3" style="width: 16%" class="text-right font-weight-bold">Cần thanh toán</td>
                            <td style="width: 16%" class='text-right font-weight-bold'>{{ number_format( $orders[0]['total'], 0, "" ,"." )}}đ</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="text-center mt-2">
                <a href="{{route('home')}}" class="exit-home-order">VỀ TRANG CHỦ</a>
            </div>
        </div>
    </div>
</div>


@endsection