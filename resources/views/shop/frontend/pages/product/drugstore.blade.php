@php
    $imageSrc = isset($userInfo['details']['image']) ? $userInfo['details']['image'] : 'https://bcp.cdnchinhphu.vn/Uploaded/nguyenthikimlien/2018_05_02/b503ae41ddf217eb13c3e4757362181a_thuoc3.jpg';
@endphp
@extends('shop.layouts.frontend')

@section('content')

<div class="wp-inner mt-3 mt-lg-4">
    <h6 class="mb-4">THÔNG TIN SHOP</h6>
    <div class="mb-4">
        <div class="row">
            <div class="cod-12 col-md-6">
                <div class="text-center"><img class="border border-secondary rounded" src="{{ $imageSrc }}" style="width: 300px;" alt=""></div>
                <div class="mt-3">
                    <h6 class="text-danger text-center font-weight-bold">{{$userInfo['fullname']??''}}</h6>
                    <p>*Số lượng sản phẩm: {{count($productDrugstore)+count($productAffiliate)}}</p>
                    <p>*Địa chỉ: {{$address??''}}</p>
                    <p>*Số điện thoại: {{$userInfo['phone'] ??''}}</p>
                </div>
            </div>
            <div class="cod-12 col-md-6">
                @if(empty($map))
                <img style="width: 100%; height: 300px" src="https://images.fpt.shop/unsafe/filters:quality(5)/fptshop.com.vn/uploads/images/tin-tuc/154470/Originals/Google%20Map%20l%C3%A0%20g%C3%AC%20h%C3%ACnh%201.jpg" alt="">
                @else
                {!! $map !!}
                @endif
            </div>
        </div>
    </div>
    <div id="selling-product" class="parent-btn-view-add">
        @include("$moduleName.pages.$controllerName.child_drugstore.list_product",['productDrugstore'=>$productDrugstore,'productAffiliate'=>$productAffiliate])
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
<div class="lc-mask-search"></div>
@endsection