@extends('shop.layouts.frontend')

@section('content')
<div class="position-relative" style="min-height: 600px;">
    <div class="bg-prescrip">
        <picture>
            <source media="(max-width: 992px)" srcset="{{asset('images/shop/bg-donthuoc-mb.png')}}">
            <img src="{{asset('images/shop/bg-donthuoc.png')}}" alt="">
        </picture>
    </div>
    <div class="py-4">
        <div class="winner">
            <div class="header-prescrip">
                <h1>Mua Thuốc Dễ Dàng Tại Tdoctor</h1>
                <p>Đến với Tdoctor, bạn sẽ mua được đúng loại thuốc <br> theo đơn cùng dịch vụ tư vấn đến từ đội ngũ dược sĩ</p>
            </div>
        </div>
        <div class="">
            <div class="wp-order-success">
                <div class="image-prescrip">
                    <picture class="txt-center">
                        <img src="{{asset('images/shop/nhapdonthuoc-final.png')}}" alt="">
                    </picture>
                </div>
                <div class="text-center box-dhtc">
                    <p class="font-weight-bold">Nhà thuốc Tdoctor đã nhận được thông tin của quý khách</p>
                    <p>Dược sỹ nhà thuốc sẽ liên hệ trong vòng</p>
                    <p> 3- 10 phút để tư vấn và xác nhận đặt hàng của bạn</p>
                </div>
                @if(isset($prescrip['info_product']) && count($prescrip['info_product'])>0)
                <div class="title-info-order">
                    <h3 class=" pd-order">Đơn thuốc</h3>
                </div>
                <div class="item-info">
                    <table class="table pd-order mb-0" id="tbList">
                        <tbody>
                            @php
                            $temp=0;
                            $customer=json_decode($prescrip['buyer'], true);
                            @endphp
                            @foreach($prescrip['info_product'] as $item)
                            @php
                            $temp++;
                            @endphp
                            <tr class="bb_order">
                                <td><span>{{$temp}}. </span>{{$item}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
                @php
                $customer=json_decode($prescrip['buyer'], true);
                @endphp
                <div class="title-info-order">
                    <h3 class=" pd-order">Thông tin khách hàng</h3>
                </div>
                <div class="item-info">
                    <table class="table pd-order mb-0" id="tbList">
                        <tbody>
                            <tr class="bb_order">
                                <td style="width: 30%">Họ và tên</td>
                                <td style="width: 70%" class='name'>{{$customer['fullname']}}</td>
                            </tr>
                            <tr class="bb_order">
                                <td style="width: 30%">Số điện thoại</td>
                                <td style="width: 70%" class='name'>{{$customer['phone']}}</td>
                            </tr>
                            <tr class="bb_order">
                                <td style="width: 30%">Địa chỉ</td>
                                <td style="width: 70%" class='name'>{{$address}}</td>
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
</div>


@endsection