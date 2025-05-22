@php
    use App\Helpers\MyFunction;

    $imageSrc = isset($userInfo['details']['image']) ? $userInfo['details']['image'] : route('home') . '/laravel-filemanager/fileUpload/nhathuoc/nhathuocmau10.jpg';
    if (isset($userInfo['details']['image']) && $userInfo['details']['image'] != ''){
        $imageSrc  = route('home') . $userInfo['details']['image'];
    } else{
        $imageSrc  = route('home') . '/laravel-filemanager/fileUpload/nhathuoc/nhathuocmau10.jpg';
    }
    $imageMap = route('home') . '/laravel-filemanager/fileUpload/nhathuoc/mapduphong.jpeg';
    $phoneShop = '0393167234';
    if($userInfo['user_type_id'] == 4 && !empty($userInfo['phone'])){
        $phoneShop = $userInfo['phone'];
    }
    if($userInfo['user_type_id'] == 6 || $userInfo['user_type_id'] == 11){
        $phoneShop = $userInfo['phone'];
    }
    $phoneShop=MyFunction::formatPhoneNumber($phoneShop);
@endphp

@extends('shop.layouts.frontend')
@section('headadd')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/min/tiny-slider.js"></script>
<script>
    document.addEventListener("DOMContentLoaded",function(){tns({container:".banner_doitac",items:1,slideBy:"page",loop:!0,speed:1e3,autoplay:!0,autoplayTimeout:3e3,autoplayButtonOutput:!1,controls:!1,nav:!1,mouseDrag:!0,gutter:0,onInit:function(){document.querySelector(".banner_doitac").classList.remove("cS-hidden")}}),tns({container:".banner_doitac_mobi",items:1,slideBy:"page",loop:!0,speed:1e3,autoplay:!0,autoplayTimeout:3e3,autoplayButtonOutput:!1,controls:!1,nav:!1,mouseDrag:!0,gutter:0,onInit:function(){document.querySelector(".banner_doitac_mobi").classList.remove("cS-hidden")}})});
</script>
@endsection
@section('content')
<div class="wp-inner mt-3 mt-lg-4">
    <h6 class="mb-4">THÔNG TIN SHOP</h6>
    <div class="mb-4">
        <div class="row">
            <div class="cod-12 col-md-6 pb-3">
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
    @if(count($productDrugstore) > 0)
    <div id="selling-product" class="parent-btn-view-add">
        @include("$moduleName.pages.$controllerName.child_drugstore.list_product",['productDrugstore'=>$productDrugstore])
    </div>
    <div class="comment-product">
        @include("$moduleName.pages.$controllerName.child_drugstore.comment_rating_drugstore")
    </div>
    @endif
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
@include("$moduleName.templates.banner_doitac")
<div class="lc-mask-search"></div>
@endsection