@extends('shop.layouts.frontend')
@section('headadd')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/min/tiny-slider.js"></script>
<script>
    document.addEventListener("DOMContentLoaded",function(){tns({container:".banner_doitac",items:1,slideBy:"page",loop:!0,speed:1e3,autoplay:!0,autoplayTimeout:5e3,autoplayButtonOutput:!1,controls:!1,nav:!1,mouseDrag:!0,gutter:0,onInit:function(){document.querySelector(".banner_doitac").classList.remove("cS-hidden")}}),tns({container:".banner_doitac_mobi",items:1,slideBy:"page",loop:!0,speed:1e3,autoplay:!0,autoplayTimeout:5e3,autoplayButtonOutput:!1,controls:!1,nav:!1,mouseDrag:!0,gutter:0,onInit:function(){document.querySelector(".banner_doitac_mobi").classList.remove("cS-hidden")}})});
</script>
@endsection
@section('content')
<div class="wp-inner mt-2 mt-lg-3">
    @include("$moduleName.templates.box_title_product",['title' => 'CHỌN NHÀ CUNG CẤP','classBackground'=>'bg-danger'])
    @include("$moduleName.pages.$controllerName.child_index.chon_nha_cung_cap",['items'=>$productcers])
</div>
<div class="container-slider mt-3 mt-lg-4 pl-0 pl-lg-2 mb-2">
    <div class="row">
        <div class="col-12">
            <div class="d-none d-md-block" style="height:285px">
                <div class="banner_doitac cS-hidden">
                    <!-- <div class="swiper-slide text-center">
                        <img src="{{asset('laravel-filemanager/fileUpload/banner/bn_duoctot5.jpg')}}" alt="tdoctor" class="img-fluid">
                    </div> -->
                    <div class="swiper-slide text-center">
                        <img src="{{asset('laravel-filemanager/fileUpload/banner/bn_duoctot6.jpg')}}" alt="tdoctor" class="img-fluid" width="700" height="285">
                    </div>
                    <div class="swiper-slide text-center">
                        <img src="{{asset('laravel-filemanager/fileUpload/banner/bn_duoctot7.jpg')}}" alt="tdoctor" class="img-fluid" width="700" height="285">
                    </div>
                    <div class="swiper-slide text-center">
                        <img src="{{asset('laravel-filemanager/fileUpload/banner/bn_duoctot8.jpg')}}" alt="tdoctor" class="img-fluid" width="700" height="285">
                    </div>
                    <div class="swiper-slide text-center">
                        <img src="{{asset('laravel-filemanager/fileUpload/banner/bn_duoctot9.jpg')}}" alt="tdoctor" class="img-fluid" width="700" height="285">
                    </div>
                    <div class="swiper-slide text-center">
                        <img src="{{asset('laravel-filemanager/fileUpload/banner/bn_duoctot10.jpg')}}" alt="tdoctor" class="img-fluid" width="700" height="285">
                    </div>
                    <div class="swiper-slide text-center">
                        <img src="{{asset('laravel-filemanager/fileUpload/banner/bn_duoctot12.jpg')}}" alt="tdoctor" class="img-fluid" width="700" height="285">
                    </div>
                </div>
            </div>
            <div class="d-block d-md-none" style="height:145px">
                <div class="banner_doitac_mobi cS-hidden">
                    <div class="swiper-slide text-center">
                        <img src="{{asset('laravel-filemanager/fileUpload/banner/bn_duoctot6.jpg')}}" alt="tdoctor" class="img-fluid" width="428" height="145">
                    </div>
                    <div class="swiper-slide text-center">
                        <img src="{{asset('laravel-filemanager/fileUpload/banner/bn_duoctot7.jpg')}}" alt="tdoctor" class="img-fluid" width="428" height="145">
                    </div>
                    <div class="swiper-slide text-center">
                        <img src="{{asset('laravel-filemanager/fileUpload/banner/bn_duoctot8.jpg')}}" alt="tdoctor" class="img-fluid" width="428" height="145">
                    </div>
                    <div class="swiper-slide text-center">
                        <img src="{{asset('laravel-filemanager/fileUpload/banner/bn_duoctot9.jpg')}}" alt="tdoctor" class="img-fluid" width="428" height="145">
                    </div>
                    <div class="swiper-slide text-center">
                        <img src="{{asset('laravel-filemanager/fileUpload/banner/bn_duoctot10.jpg')}}" alt="tdoctor" class="img-fluid" width="428" height="145">
                    </div>
                    <div class="swiper-slide text-center">
                        <img src="{{asset('laravel-filemanager/fileUpload/banner/bn_duoctot12.jpg')}}" alt="tdoctor" class="img-fluid" width="428" height="145">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="wp-inner">
    <h1 class="d-none">DƯỢC TỐT là Nền tảng kết nối y dược nhà thuốc, phòng khám , bệnh nhân với công ty dược và thực phẩm chức năng uy tín nhất Việt nam</h1>
    <div id="hisd" class="position-relative">
        <div class="d-flex justify-content-center">
            <div id="form-search" class="d-flex justify-content-center">
                @include("$moduleName.pages.$controllerName.child_index.search")
            </div>
        </div>
    </div>
</div>
<div class="wp-inner mt-3 mt-lg-4">
    @include("$moduleName.templates.box_title_product",['title' => 'Giá sốc','classBackground'=>'bg-danger'])
    @include("$moduleName.pages.$controllerName.child_index.list_product_gia_soc",['items'=>$itemsProduct['best']])
</div>
<div class="wp-inner mt-3 mt-lg-4">
    @include("$moduleName.templates.box_title_product",['title' => 'CHỌN THƯƠNG HIỆU','classBackground'=>'bg-danger'])
    @include("$moduleName.pages.$controllerName.child_index.chon_thuong_hieu")
</div>
<div class="wp-inner mt-3 mt-lg-4">
    @include("$moduleName.templates.box_title_product",['title' => 'SẢN PHẨM KHUYẾN MÃI','classBackground'=>'bg-danger'])
    @include("$moduleName.pages.$controllerName.child_index.list_product_khuyen_mai",['items'=>$itemsProduct['goi_y']])
</div>
<div class="wp-inner mt-3 mt-lg-4">
    @include("$moduleName.templates.box_title_product",['title' => 'SẢN PHẨM MỚI/ BÁN CHẠY','classBackground'=>'bg-danger'])
    @include("$moduleName.pages.$controllerName.child_index.list_product_moi_ban_chay",['items'=>$itemsProduct['new']])
</div>

<div class="lc-mask-search"></div>
@endsection