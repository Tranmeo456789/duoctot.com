@extends('shop.layouts.frontend')
@section('headadd')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/min/tiny-slider.js"></script>
<style>
    .prev-btn,.next-btn {top: 50%;transform: translateY(-50%);border: none;padding: 10px;cursor: pointer;z-index: 10;font-size: 30px;}
</style>
<script>document.addEventListener("DOMContentLoaded",function(){var s1=tns({container:".banner_doitac",items:1,slideBy:1,loop:!0,speed:400,autoplay:!0,autoplayTimeout:5e3,autoplayButtonOutput:!1,controls:!1,nav:!1,mouseDrag:!0,touch:!0,gutter:4,edgePadding:0,onInit:function(){document.querySelector(".banner_doitac").classList.remove("cS-hidden")}});var s2=tns({container:".banner_doitac_mobi",items:1,slideBy:1,loop:!0,speed:400,autoplay:!0,autoplayTimeout:5e3,autoplayButtonOutput:!1,controls:!1,nav:!1,mouseDrag:!0,touch:!0,gutter:4,edgePadding:0,onInit:function(){document.querySelector(".banner_doitac_mobi").classList.remove("cS-hidden")}});var s3=tns({container:".list_thumb_user",items:1,slideBy:1,loop:!0,speed:400,autoplay:!1,autoplayTimeout:5e3,autoplayButtonOutput:!1,controls:!1,nav:!1,mouseDrag:!0,touch:!0,gutter:4,edgePadding:0,autoHeight: !0,onInit:function(){document.querySelector(".list_thumb_user").classList.remove("cS-hidden")}});document.querySelector(".prev-btn").addEventListener("click",function(){s3.goTo("prev")});document.querySelector(".next-btn").addEventListener("click",function(){s3.goTo("next")})});</script>
<script>document.addEventListener("DOMContentLoaded",function(){var sliderPkTmv=tns({container:".banner_pk_tmv",items:1,slideBy:1,loop:!0,speed:400,autoplay:!0,autoplayTimeout:5e3,autoplayButtonOutput:!1,controls:!1,nav:!1,mouseDrag:!0,touch:!0,gutter:4,edgePadding:0,onInit:function(){document.querySelector(".banner_pk_tmv").classList.remove("cS-hidden")}})});</script>
@endsection
@section('content')
<div class="wp-inner mt-3 mt-lg-4">
    <h6 class="mb-4 font-weight-bold">THÔNG TIN SHOP</h6>
    <div class="mb-4">
        <div class="row">
            <div class="col-12">
                @include("$moduleName.pages.$controllerName.child_drugstore.list_thumb",['albumImageCurrent'=>$albumImageCurrent])
                <div class="mt-3 wp-info-shop text-center">
                    <h6 class="text-danger text-center font-weight-bold">{{$userInfo['fullname']??''}}</h6>
                    <p class="font-weight-bold">*Số lượng sản phẩm: <span>{{count($productDrugstore)}}</span></p>
                    <p class="font-weight-bold">*Địa chỉ: <span>{{$address??''}}</span></p>
                    <p class="font-weight-bold">*Số điện thoại / Email: <span>{{$phoneShop}}</span></p>
                </div>
            </div>
        </div>
    </div>
    @if(count($productKhuyenMai) > 0)
    <div class="mb-4">
        @include("$moduleName.templates.box_title_product",['title' => 'SẢN PHẨM KHUYẾN MÃI','classBackground'=>'bg-danger'])
        @include("$moduleName.pages.$controllerName.child_drugstore.list_product_khuyen_mai",['items'=>$productKhuyenMai])
    </div>
    @endif
    @if(count($productDrugstore) > 0)
    <div id="selling-product" class="parent-btn-view-add">
        @include("$moduleName.pages.$controllerName.child_drugstore.list_product",['productDrugstore'=>$productDrugstore])
    </div>
    <div class="comment-product">
        @include("$moduleName.pages.$controllerName.child_drugstore.comment_rating_drugstore")
    </div>
    @endif
    <div id="map-drugstore" class="text-centen my-4">
        @if(empty($map))
        <img style="width: 100%; height: 300px" src="{{$imageMap}}" alt="{{$userInfo['fullname']??''}}">
        @else
        {!! $map !!}
        @endif
    </div>
</div>
@if($userType==3 || $userType==8)
<div class="my-3">
    @include("$moduleName.pages.$controllerName.child_drugstore.banner_in_pk_tmv")
</div>
@endif
@include("$moduleName.templates.banner_doitac")
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