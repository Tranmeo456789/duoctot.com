@extends('shop.layouts.frontend')

@section('content')

    <div style="">
        <img src="{{asset('images/shop/header1920.png')}}" alt="" class="img-fluid">
    </div>
    <div class="wp-inner">
<<<<<<< HEAD
        <div id="hisd">
            <div class="d-flex justify-content-center">
                <div id="form-search" class="d-flex justify-content-center">
                    @include("$moduleName.pages.$controllerName.child_home.search")
                </div>
            </div>
        </div>  
=======
        <div id="form-search" class="d-flex justify-content-center">
            @include("$moduleName.pages.$controllerName.child_index.search")
        </div>
>>>>>>> 0993db1ee923d3cf16a6a3700e4cf6d69d0e2e1d
        <div id="service-doctor">
            @include("$moduleName.pages.$controllerName.child_index.service")
        </div>
        <div id="buy-medicine" class="mt-5">
            @include("$moduleName.pages.$controllerName.child_index.buy_medicine")
        </div>
        <div id="featured-category" class="mt-5">
            @include("$moduleName.pages.$controllerName.child_index.featured_category")
        </div>
    </div>
    <div id="product-covid" class="mt-5 py-4">
        @include("$moduleName.pages.$controllerName.child_index.product_covid")
    </div>
    <div class="wp-inner mt-5">
        <div id="selling-product">
            @include("$moduleName..templates.selling_product")
        </div>
        <div id="selling-product" class="mt-5">
            @include("$moduleName.pages.$controllerName.child_index.subject_product")
        </div>
    </div>
    <div id="qadoctor" class="mt-3 pb-5">
        @include("$moduleName.pages.$controllerName.child_index.qadoctor")
    </div>
    <div class="wp-inner">
        @include("$moduleName.pages.$controllerName.child_index.news")
    </div>
    <div class="info-tdoctor mt-5">
        @include("$moduleName.templates.info_tdoctor")
    </div>
    <div class="wp-inner mt-5" style="">
        @include("$moduleName.templates.info_app")
    </div>
    <div class="service-tdoctor mt-5">
        @include("$moduleName.templates.info_service")
    </div>
    <div class="local">
        @include("$moduleName.templates.local_drugstore")
    </div>
    <div class="wp-inner mt-5" style="">
        <div class="feedback-customer">
            @include("$moduleName.templates.feedback_customer")
        </div>
    </div>

@endsection

