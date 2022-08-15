@extends('shop.layouts.frontend')

@section('content')
    <div style="">
        <img src="{{asset('images/shop/header1920.png')}}" alt="" class="img-fluid">
    </div>
    <div class="wp-inner">
        <div id="form-search" class="d-flex justify-content-center">
            @include("$moduleName.pages.$controllerName.child_home.search")
        </div>
        <div id="service-doctor">
            @include("$moduleName.pages.$controllerName.child_home.service")
        </div>
        <div id="buy-medicine" class="mt-5">
            @include("$moduleName.pages.$controllerName.child_home.buy_medicine")
        </div>
        <div id="featured-category" class="mt-5">
            @include("$moduleName.pages.$controllerName.child_home.featured_category")
        </div>
    </div>
    <div id="product-covid" class="mt-5 py-4">
        @include("$moduleName.pages.$controllerName.child_home.product_covid")
    </div>
    <div class="wp-inner mt-5">
        <div id="selling-product">
            @include("$moduleName.pages.$controllerName.child_home.selling_product")
        </div>
        <div id="selling-product" class="mt-5">
            @include("$moduleName.pages.$controllerName.child_home.subject_product")
        </div>
    </div>
    <div id="qadoctor" class="mt-3 pb-5">
        @include("$moduleName.pages.$controllerName.child_home.qadoctor")
    </div>
    <div class="wp-inner">
        @include("$moduleName.pages.$controllerName.child_home.news")
    </div>
    <div class="info-tdoctor mt-5">
        @include("$moduleName.pages.$controllerName.child_home.info_tdoctor")
    </div>
    <div class="wp-inner mt-5" style="">
        @include("$moduleName.pages.$controllerName.child_home.info_app")
    </div>
    <div class="service-tdoctor mt-5">
        @include("$moduleName.pages.$controllerName.child_home.info_service")
    </div>
    <div class="local">
        @include("$moduleName.pages.$controllerName.child_home.local_drugstore")
    </div>
    <div class="wp-inner mt-5" style="">
        <div class="feedback-customer">
            @include("$moduleName.pages.$controllerName.child_home.feedback_customer")
        </div>
    </div>

@endsection

