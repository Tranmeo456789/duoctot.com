@extends('shop.layouts.frontend')

@section('content')
<div class="section" id="slider-wp">
    <div class="section-detail">
        <div class="item">
            <img src="{{asset('images/shop/banner1.png')}}" alt="" class="img-fluid" style="width:100%">
        </div>
        <div class="item">
            <img src="{{asset('images/shop/banner2.png')}}" alt="" class="img-fluid" style="width:100%">
        </div>
        <div class="item">
            <img src="{{asset('images/shop/banner3.png')}}" alt="" class="img-fluid" style="width:100%">
        </div>
    </div>
</div>
<div class="wp-inner">
    <div id="hisd" class="position-relative">
        <div class="d-flex justify-content-center">
            <div id="form-search" class="d-flex justify-content-center">
                @include("$moduleName.pages.$controllerName.child_index.search")
            </div>
        </div>
    </div>
    <div id="buy-medicine" class="mt-3">
        @include("$moduleName.pages.$controllerName.child_index.buy_medicine")
    </div>
    {{--
    <div id="featured-category" class="mt-5">
        @include("$moduleName.pages.$controllerName.child_index.featured_category")
    </div>
    --}}
</div>
<div class="product-backround  mt-5 py-4">
    <div class="wp-inner">
        <div id="new-product" class="list-product">
            @include("$moduleName.templates.box_title_product",['title' => 'Sản phẩm mới','featured' => true])
            @include("$moduleName.templates.list_product",['items' => $itemsProduct['new']])
        </div>
    </div>
</div>

<div class="mt-5 product_hcovid">
    <div class="wp-inner">
        @include("$moduleName.pages.$controllerName.child_index.product_covid")
    </div>
</div>
<div class="wp-inner mt-5">
    <div id="selling-product">
        @include("$moduleName.templates.selling_product")
    </div>
    <div id="selling-product" class="mt-5">
        @include("$moduleName.pages.$controllerName.child_index.product_in_object")
    </div>
</div>


<div class="wp-inner">
    @include("$moduleName.pages.$controllerName.child_index.news")
</div>
<div class="service-tdoctor mt-5">
    @include("$moduleName.templates.info_service")
</div>
<div class="local">
    @include("$moduleName.templates.local_drugstore")
</div>
<div class="wp-inner mt-5">
    <div class="feedback-customer">
        @include("$moduleName.templates.feedback_customer")
    </div>
</div>
<div class="lc-mask-search"></div>
@endsection