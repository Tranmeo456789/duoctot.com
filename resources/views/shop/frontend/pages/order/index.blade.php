@php
$status=[
['name'=>'Tất cả','slug'=>'tat_ca'],
['name'=>'Chưa hoàn tất','slug'=>'chua_hoan_tat'],
['name'=>'Hoàn tất','slug'=>'hoan_tat'],
['name'=>'Đã hủy','slug'=>'da_huy'],
['name'=>'Trả hàng','slug'=>'tra_hang'],
];
@endphp
@extends('shop.layouts.frontend')

@section('content')
<div class="position-relative" style="min-height: 600px;">
    <div class="banner mb-3">
        <picture>
            <source media="(max-width: 756px)" srcset="{{asset('images/shop//banner-QLTK-mb.png')}}">
            <img src="{{asset('images/shop/banner-QLTK.png')}}" alt="">
        </picture>
    </div>
    <div class="wp-inner">
        <div class="set-screen-600">
            <ul class="nav nav-pills mb-3 header-tab" id="pills-tab" role="tablist">
                @foreach($status as $item)
                <li class="nav-item wp-20 select-status-order" role="presentation" data-status="{{$item['slug']}}" data-href="{{route('fe.order.ajaxFliter')}}" data-phone="{{$phone??''}}">
                    <button class="nav-link {{$item['slug']=='tat_ca'?'active':''}} wp-100" data-toggle="pill" type="button" role="tab">{{$item['name']}}</button>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="table-order-frontend">
            @include("$moduleName.pages.order.partial.product_order_frontend")
        </div>
    </div>
    <div class="service-tdoctor mt-3 mt-lg-4">
        @include("$moduleName.templates.info_service")
    </div>
    <div class="local">
        @include("$moduleName.templates.local_drugstore")
    </div>
    <div class="wp-inner mt-3 mt-lg-4">
        <div class="feedback-customer">
            @include("$moduleName.templates.feedback_customer")
        </div>
    </div>
</div>
@endsection
<div class="wp-detail-order">
    @include("$moduleName.pages.order.child_index.detail_order")
</div>