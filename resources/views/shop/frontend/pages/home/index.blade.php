@extends('shop.layouts.frontend')

@section('content')
    <div class="section" id="slider-wp">
        <div class="section-detail">
        <div class="item">
                <img src="https://images.fpt.shop/unsafe/fit-in/1600x400/filters:quality(80):fill(white)/nhathuoclongchau.com/upload/slide/1658467715-tm6o-dac-quyen-mua-hang-1k.png" alt="" class="img-fluid" style="width:100%">
            </div>
            <div class="item">
                <img src="https://images.fpt.shop/unsafe/fit-in/1600x400/filters:quality(80):fill(white)/nhathuoclongchau.com/upload/slide/1658467715-tm6o-dac-quyen-mua-hang-1k.png" alt="" class="img-fluid" style="width:100%">
            </div>
            <div class="item">
                <img src="https://images.fpt.shop/unsafe/fit-in/1600x400/filters:quality(80):fill(white)/nhathuoclongchau.com/upload/slide/1659455646-rU5F-sua-tam-em-be-cetaphil-uu-dai-doc-quyen.png" alt="" class="img-fluid" style="width:100%">
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
        <div id="buy-medicine" class="mt-5">
            @include("$moduleName.pages.$controllerName.child_index.buy_medicine")
        </div>
        <div id="featured-category" class="mt-5">
            @include("$moduleName.pages.$controllerName.child_index.featured_category")
        </div>
    </div>
    <div id="productsl" class="mt-5 py-4 product_hcovid">
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
    <!-- <div id="qadoctor" class="mt-3 pb-5">
        @include("$moduleName.pages.$controllerName.child_index.qadoctor")
    </div> -->
    <div class="wp-inner">
        @include("$moduleName.pages.$controllerName.child_index.news")
    </div>
    <!-- <div class="info-tdoctor mt-5">
        @include("$moduleName.templates.info_tdoctor")
    </div> -->
    <!-- <div class="wp-inner mt-5">
        @include("$moduleName.templates.info_app")
    </div> -->
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

