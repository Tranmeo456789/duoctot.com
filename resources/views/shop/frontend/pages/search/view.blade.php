@extends('shop.layouts.frontend_search_in_menu')
@section('headadd')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/min/tiny-slider.js"></script>
<style>
    .prev-btn,.next-btn {top: 50%;transform: translateY(-50%);border: none;padding: 10px;cursor: pointer;z-index: 10;font-size: 30px;}
</style>
<script>document.addEventListener("DOMContentLoaded",function(){var s1=tns({container:".banner_doitac",items:1,slideBy:1,loop:!0,speed:400,autoplay:!0,autoplayTimeout:5e3,autoplayButtonOutput:!1,controls:!1,nav:!1,mouseDrag:!0,touch:!0,gutter:4,edgePadding:0,onInit:function(){document.querySelector(".banner_doitac").classList.remove("cS-hidden")}});var s2=tns({container:".banner_doitac_mobi",items:1,slideBy:1,loop:!0,speed:400,autoplay:!0,autoplayTimeout:5e3,autoplayButtonOutput:!1,controls:!1,nav:!1,mouseDrag:!0,touch:!0,gutter:4,edgePadding:0,onInit:function(){document.querySelector(".banner_doitac_mobi").classList.remove("cS-hidden")}});var s3=tns({container:".list_thumb_user",items:1,slideBy:1,loop:!0,speed:400,autoplay:!1,autoplayTimeout:5e3,autoplayButtonOutput:!1,controls:!1,nav:!1,mouseDrag:!0,touch:!0,gutter:4,edgePadding:0,autoHeight: !0,onInit:function(){document.querySelector(".list_thumb_user").classList.remove("cS-hidden")}});document.querySelector(".prev-btn").addEventListener("click",function(){s3.goTo("prev")});document.querySelector(".next-btn").addEventListener("click",function(){s3.goTo("next")})});</script>
@endsection
@section('content')
<div>
    <div class="wp-inner">
        @if(count($itemSearch) > 0)
       <div class="title-header-search">Tìm thấy <span class="font-weight-bold">{{count($itemSearch)}}</span> kết quả với từ khóa "<span class="font-weight-bold">{{$keyword}}</span>"</div>
       @else
       <div class="title-header-search">Không tìm thấy kết quả với từ khóa "<span class="font-weight-bold">{{$keyword}}</span>"</div>
       <div class="lc-searchpost-inner py-2">
            <p class="font-weight-bold">Hãy thử lại bằng cách:</p>
            <ul class="list-group">
                <li>* Kiểm tra lỗi chính tả của từ khoá đã nhập</li>
                <li>* Thử lại bằng từ khoá khác</li>
                <li>* Thử lại bằng những từ khoá tổng quát hơn</li>
                <li>* Thử lại bằng những từ khoá ngắn gọn hơn</li>
            </ul>
       </div>
       @endif
    </div>
</div>
<div class="cbr py-2">
    <div class="wp-inner">
        <div class="search-result">
            @include("$moduleName.templates.list_product",['items'=>$itemSearch])
        </div>
    </div>
</div>
@include("$moduleName.templates.banner_doitac")
<div class="local">
    @include("$moduleName.templates.local_drugstore")
</div>
<div class="wp-inner mt-3 mt-lg-4">
    <div class="feedback-customer">
        @include("$moduleName.templates.feedback_customer")
    </div>
</div>
@endsection