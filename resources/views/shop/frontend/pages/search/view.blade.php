@extends('shop.layouts.frontend_search_in_menu')
@section('headadd')
<style>
    .prev-btn,.next-btn {top: 50%;transform: translateY(-50%);border: none;padding: 10px;cursor: pointer;z-index: 10;font-size: 30px;}
.search-user-item {display: flex;align-items: center;text-decoration: none;color: #333;border: 1px solid #eee;border-radius: 5px;background: #fff;}
.search-user-item:hover {
    background: #f8f8f8;
    text-decoration: none;
}
.search-user-avatar {
    width: 55px;
    height: 55px;
    object-fit: cover;
    border-radius: 50%;
    flex-shrink: 0;
}
.search-user-name {
    font-size: 15px;
    font-weight: 600;
}
</style>
<script>document.addEventListener("DOMContentLoaded",function(){if(document.querySelector(".banner_doitac")){var s1=tns({container:".banner_doitac",items:1,slideBy:1,loop:!0,speed:400,autoplay:!0,autoplayTimeout:5e3,autoplayButtonOutput:!1,controls:!1,nav:!1,mouseDrag:!0,touch:!0,gutter:4,edgePadding:0,onInit:function(){document.querySelector(".banner_doitac").classList.remove("cS-hidden")}})}if(document.querySelector(".banner_doitac_mobi")){var s2=tns({container:".banner_doitac_mobi",items:1,slideBy:1,loop:!0,speed:400,autoplay:!0,autoplayTimeout:5e3,autoplayButtonOutput:!1,controls:!1,nav:!1,mouseDrag:!0,touch:!0,gutter:4,edgePadding:0,onInit:function(){document.querySelector(".banner_doitac_mobi").classList.remove("cS-hidden")}})}var s3;if(document.querySelector(".list_thumb_user")){s3=tns({container:".list_thumb_user",items:1,slideBy:1,loop:!0,speed:400,autoplay:!1,autoplayTimeout:5e3,autoplayButtonOutput:!1,controls:!1,nav:!1,mouseDrag:!0,touch:!0,gutter:4,edgePadding:0,autoHeight:!0,onInit:function(){document.querySelector(".list_thumb_user").classList.remove("cS-hidden")}})}var pb=document.querySelector(".prev-btn"),nb=document.querySelector(".next-btn");if(s3&&pb)pb.addEventListener("click",function(){s3.goTo("prev")});if(s3&&nb)nb.addEventListener("click",function(){s3.goTo("next")})});</script>
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
            @if(isset($userSearch) && $userSearch->count() > 0)
                <div class="search-users mb-3">
                    @foreach($userSearch as $user)
                        <a href="{{ $user->linkShop }}" class="search-user-item d-flex align-items-center mb-2 p-2">
                            <img src="{{ $user->imgThumb }}" alt="{{ $user->fullname }}" class="search-user-avatar mr-3">
                            <span class="search-user-name">
                                {{ $user->fullname }}
                            </span>
                        </a>
                    @endforeach
                </div>
            @endif
            @include("$moduleName.templates.list_product",['items'=>$itemSearch])
        </div>
    </div>
</div>
<div class="local">
    @include("$moduleName.templates.local_drugstore")
</div>
<div class="wp-inner mt-3 mt-lg-4">
    <div class="feedback-customer">
        @include("$moduleName.templates.feedback_customer")
    </div>
</div>
@endsection