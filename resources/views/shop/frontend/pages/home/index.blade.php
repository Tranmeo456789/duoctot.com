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
    <div id="buy-medicine" class="mt-0 pt-0 mt-md-3 pt-md-3">
        @include("$moduleName.pages.$controllerName.child_index.buy_medicine")
    </div>
</div>
<div id="feature-product-wp">
    <div class="product-backround  mt-3 mt-lg-5 py-4">
        <div class="wp-inner">
            @include("$moduleName.templates.box_title_product",['title' => 'Sản phẩm mới','classBackground'=>'bg-danger'])
            <ul class="list-item">
                @include("$moduleName.partial.product",['items'=>$itemsProduct['new']])
            </ul>
        </div>
    </div>
</div>
<div class="wp-inner mt-3 mt-lg-5">
    <div id="selling-product">
        @include("$moduleName.pages.$controllerName.child_index.best_selling_product")
    </div>
    <div id="ls-product-view-add">
        @include("$moduleName.pages.$controllerName.child_index.ls_product_view_add")
    </div>
    <div class="text-center mt-3">
        <span class="view-add-product" data-offset="20" data-href="{{route('fe.product.loadMoreProducts')}}">Xem thêm(20 sp)</span>
    </div>
</div>
@if(count($product_covid)>0)
<div class="product-backround  mt-3 mt-lg-5 py-4">
    <div class="wp-inner">
        @include("$moduleName.templates.box_title_product",['title' => 'Sản phẩm hậu covid','classBackground'=>'bg-danger'])
        @include("$moduleName.templates.list_product",['items'=>$product_covid])
    </div>
</div>
@endif
<div class="wp-inner mt-5">
    <div id="product-by-object">
        @include("$moduleName.pages.$controllerName.child_index.product_by_object")
    </div>
</div>
<div class="wp-inner">
    @include("$moduleName.pages.$controllerName.child_index.news")
</div>
<div class="service-tdoctor mt-3 mt-lg-5">
    @include("$moduleName.templates.info_service")
</div>
<div class="local">
    @include("$moduleName.templates.local_drugstore")
</div>
<div class="wp-inner mt-3 mt-lg-5">
    <div class="feedback-customer">
        @include("$moduleName.templates.feedback_customer")
    </div>
</div>
<div class="lc-mask-search"></div>
@endsection