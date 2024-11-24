@php
    $imageSrc = isset($userInfo['details']['image']) ? $userInfo['details']['image'] : route('home') . '/laravel-filemanager/fileUpload/nhathuoc/nhathuocmau10.jpg';
    if (isset($userInfo['details']['image']) && $userInfo['details']['image'] != ''){
        $imageSrc  = route('home') . $userInfo['details']['image'];
    } else{
        $imageSrc  = route('home') . '/laravel-filemanager/fileUpload/nhathuoc/nhathuocmau10.jpg';
    }
    $imageMap = route('home') . '/laravel-filemanager/fileUpload/nhathuoc/mapduphong.jpeg';
    $phoneContact = $userInfo['phone'] != '' ? $userInfo['phone'] : '0349444164';
    $phoneShop=implode('.', str_split($phoneContact, 4));
@endphp

@extends('shop.layouts.frontend')

@section('content')

<div class="wp-inner mt-3 mt-lg-4">
    <h6 class="mb-4">THÔNG TIN SHOP</h6>
    <div class="mb-4">
        <div class="row">
            <div class="cod-12 col-md-6">
                <div class="text-center"><img class="border border-secondary rounded" src="{{ $imageSrc }}" style="width: 300px;" alt=""></div>
                <div class="mt-3 wp-info-shop">
                    <h6 class="text-danger text-center font-weight-bold">{{$userInfo['fullname']??''}}</h6>
                    <p>*Số lượng sản phẩm: <span class="font-weight-bold">{{count($productDrugstore)}}</span></p>
                    <p>*Địa chỉ: <span class="font-weight-bold">{{$address??''}}</span></p>
                    <p>*Số điện thoại: <span class="font-weight-bold">{{$phoneShop}}</span></p>
                </div>
            </div>
            <div id="map-drugstore" class="cod-12 col-md-6">
                @if(empty($map))
                <img style="width: 100%; height: 300px" src="{{$imageMap}}" alt="{{$userInfo['fullname']??''}}">
                @else
                {!! $map !!}
                @endif
            </div>
        </div>
    </div>
    <div id="selling-product" class="parent-btn-view-add">
        @include("$moduleName.pages.$controllerName.child_drugstore.list_product",['productDrugstore'=>$productDrugstore])
    </div>
    <div class="comment-product">
        @include("$moduleName.pages.$controllerName.child_drugstore.comment_rating_drugstore")
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