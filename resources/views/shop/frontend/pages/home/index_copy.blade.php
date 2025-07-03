@extends('shop.layouts.frontend')

@section('content')
<div class="container-slider mt-0 mt-lg-2 pl-0 pl-lg-2">
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="d-none d-md-block">
                <ul class="banner_doitac list-unstyled cS-hidden">
                    <li class="text-center">
                        <a href="https://tdoctor.net/chi-tiet-san-pham/bot-phyto-precollagen-vitac-biotin-3500.html">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner11.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="https://tdoctor.net/chi-tiet-san-pham/bot-phyto-precollagen-vitac-biotin-3500.html">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner11.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="d-block d-md-none">
                <ul class="banner_doitac list-unstyled cS-hidden">
                    <li class="text-center">
                        <a href="https://tdoctor.net/chi-tiet-san-pham/bot-phyto-precollagen-vitac-biotin-3500.html">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner16_mobi.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="https://tdoctor.net/chi-tiet-san-pham/bot-phyto-precollagen-vitac-biotin-3500.html">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner16_mobi.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="d-none d-lg-block col-lg-4">
            <div>
                <a href="https://tdoctor.net/danh-muc/cham-soc-ca-nhan/duoc-my-pham-trang-diem"><img src="{{asset('images/shop/banner-right-home1.webp')}}" alt="tdotor" class="img-fluid"></a>
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
    <!-- <div id="buy-medicine" class="mt-2 pt-2">
        @include("$moduleName.pages.$controllerName.child_index.buy_medicine")
    </div> -->
    <!-- <div id="doi-tac" class="mt-2 pt-2">
        @include("$moduleName.pages.$controllerName.child_index.banner_shop")
    </div> -->
</div>
<div id="feature-product-wp">
    <!-- <div class="product-backround  mt-3 mt-lg-4 py-4">
        <div class="wp-inner">
            @include("$moduleName.templates.box_title_product",['title' => 'Sản phẩm mới','classBackground'=>'bg-danger'])
            <ul class="list-item">
                @include("$moduleName.partial.product",['items'=>$itemsProduct['new']])
            </ul>
        </div>
    </div> -->
    <div class="mt-3 mt-lg-4">
        <div class="wp-inner">
            @include("$moduleName.templates.box_title_product",['title' => 'Giá sốc','classBackground'=>'bg-danger'])
            <!-- <ul class="list-item">
                @include("$moduleName.partial.product",['items'=>$itemsProduct['best']])
            </ul> -->
            @include("$moduleName.templates.list_product",['items'=>$itemsProduct['best']])
        </div>
    </div>
</div>
<div class="wp-inner mt-3 mt-lg-4">
    <div id="selling-product" class="parent-btn-view-add">
        @include("$moduleName.pages.$controllerName.child_index.best_selling_product")
        @include("$moduleName.block.btn_view_add",['countProduct'=>$couterSumProduct])
    </div>
</div>
<!-- @if(count($product_covid)>0)
<div class="product-backround  mt-3 mt-lg-4 py-4">
    <div class="wp-inner">
        @include("$moduleName.templates.box_title_product",['title' => 'Sản phẩm hậu covid','classBackground'=>'bg-danger'])
        @include("$moduleName.templates.list_product",['items'=>$product_covid])
    </div>
</div>
@endif -->
<div class="wp-inner mt-3 mt-lg-4">
    <div id="product-by-object" class="parent-btn-view-add">
        @include("$moduleName.pages.$controllerName.child_index.product_by_object")
    </div>
</div>
<div class="wp-inner">
    @include("$moduleName.pages.$controllerName.child_index.news")
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