@extends('shop.layouts.frontend')

@section('content')
<div class="container-slider mt-0 mt-lg-2 pl-0 pl-lg-2">
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="d-none d-md-block">
                <ul class="banner_doitac list-unstyled cS-hidden">
                    <li class="text-center">
                        <img src="{{asset('images/shop/banner2.jpeg')}}" alt="tdoctor" class="img-fluid" style="width: 100%;">
                    </li>
                    <!-- <li class="text-center">
                        <img src="{{asset('images/shop/banner3.jpeg')}}" alt="tdoctor" class="img-fluid" loading="lazy" style="width: 100%;">
                    </li> -->
                    <li class="text-center">
                        <img src="{{asset('images/shop/banner4.jpeg')}}" alt="tdoctor" class="img-fluid" style="width: 100%;">
                    </li>
                    <li class="text-center">
                        <img src="{{asset('images/shop/banner5.jpeg')}}" alt="tdoctor" class="img-fluid" style="width: 100%;">
                    </li>
                    <li class="text-center">
                        <img src="{{asset('images/shop/banner6.jpeg')}}" alt="tdoctor" class="img-fluid" style="width: 100%;">
                    </li>
                    <!-- <li class="text-center">
                        <img src="{{asset('images/shop/banner7.jpeg')}}" alt="tdoctor" class="img-fluid" loading="lazy" style="width: 100%;">
                    </li>
                    <li class="text-center">
                        <img src="{{asset('images/shop/banner8.jpeg')}}" alt="tdoctor" class="img-fluid" loading="lazy" style="width: 100%;">
                    </li>
                    <li class="text-center">
                        <img src="{{asset('images/shop/banner9.jpeg')}}" alt="tdoctor" class="img-fluid" loading="lazy" style="width: 100%;">
                    </li>
                    <li class="text-center">
                        <img src="{{asset('images/shop/banner10.jpeg')}}" alt="tdoctor" class="img-fluid" loading="lazy" style="width: 100%;">
                    </li>
                    <li class="text-center">
                        <img src="{{asset('images/shop/banner1.jpeg')}}" alt="tdoctor" class="img-fluid" loading="lazy" style="width: 100%;">
                    </li> -->
                </ul>
            </div>
            <div class="d-block d-md-none">
                <ul class="banner_doitac list-unstyled cS-hidden">
                    <li class="text-center">
                        <img src="{{asset('images/shop/banner2_mobi.jpeg')}}" alt="tdoctor" class="img-fluid" style="width: 100%;">
                    </li>
                    <!-- <li class="text-center">
                        <img src="{{asset('images/shop/banner3_mobi.jpeg')}}" alt="tdoctor" class="img-fluid" loading="lazy" style="width: 100%;">
                    </li> -->
                    <li class="text-center">
                        <img src="{{asset('images/shop/banner4_mobi.jpeg')}}" alt="tdoctor" class="img-fluid" style="width: 100%;">
                    </li>
                    <li class="text-center">
                        <img src="{{asset('images/shop/banner5_mobi.jpeg')}}" alt="tdoctor" class="img-fluid" style="width: 100%;">
                    </li>
                    <li class="text-center">
                        <img src="{{asset('images/shop/banner6_mobi.jpeg')}}" alt="tdoctor" class="img-fluid" style="width: 100%;">
                    </li>
                    <!-- <li class="text-center">
                        <img src="{{asset('images/shop/banner7_mobi.jpeg')}}" alt="tdoctor" class="img-fluid" loading="lazy" style="width: 100%;">
                    </li>
                    <li class="text-center">
                        <img src="{{asset('images/shop/banner8_mobi.jpeg')}}" alt="tdoctor" class="img-fluid" loading="lazy" style="width: 100%;">
                    </li>
                    <li class="text-center">
                        <img src="{{asset('images/shop/banner9_mobi.jpeg')}}" alt="tdoctor" class="img-fluid" loading="lazy" style="width: 100%;">
                    </li>
                    <li class="text-center">
                        <img src="{{asset('images/shop/banner10_mobi.jpeg')}}" alt="tdoctor" class="img-fluid" loading="lazy" style="width: 100%;">
                    </li>
                    <li class="text-center">
                        <img src="{{asset('images/shop/banner1_mobi.jpeg')}}" alt="tdoctor" class="img-fluid" loading="lazy" style="width: 100%;">
                    </li> -->
                </ul>
            </div>
        </div>
        <div class="d-none d-lg-block col-lg-3">
            <div>
                <img src="{{asset('images/shop/banner-right-home.jpg')}}" alt="tdotor" class="img-fluid" style="width:100%">
            </div>
        </div>
    </div>
</div>
<div class="wp-inner">
    <h1 class="d-none">Sàn thương mại điện tử trong y dược Tdoctor</h1>
    <div id="hisd" class="position-relative">
        <div class="d-flex justify-content-center">
            <div id="form-search" class="d-flex justify-content-center">
                @include("$moduleName.pages.$controllerName.child_index.search")
            </div>
        </div>
    </div>
    <div id="buy-medicine" class="mt-0 pt-0 mt-md-3 pt-md-3">
        @include("$moduleName.pages.$controllerName.child_index.buy_medicine")
    </div>
    <!-- <div id="doi-tac" class="mt-0 pt-0 mt-md-3 pt-md-3">
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
            @include("$moduleName.templates.box_title_product",['title' => 'Sản phẩm nổi bật','classBackground'=>'bg-danger'])
            <ul class="list-item">
                @include("$moduleName.partial.product",['items'=>$itemsProduct['best']])
            </ul>
        </div>
    </div>
</div>
<div class="wp-inner mt-3 mt-lg-4">
    <div id="selling-product" class="parent-btn-view-add">
        @include("$moduleName.pages.$controllerName.child_index.best_selling_product")
        @include("$moduleName.block.btn_view_add",['countProduct'=>$couterSumProduct])
    </div>
</div>
@if(count($product_covid)>0)
<div class="product-backround  mt-3 mt-lg-4 py-4">
    <div class="wp-inner">
        @include("$moduleName.templates.box_title_product",['title' => 'Sản phẩm hậu covid','classBackground'=>'bg-danger'])
        @include("$moduleName.templates.list_product",['items'=>$product_covid])
    </div>
</div>
@endif
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