@extends('shop.layouts.frontend')

@section('content')
<div class="wp-inner mt-2">
        <div class="row">
            <div class="col-md-12">
                <div class="" id="breadcrumb-wp">
                    @include("$moduleName.pages.$controllerName.child_index.breadcrumb")
                </div>
            </div>
            <div class="col-md-3 trademark">
                @include("$moduleName.pages.$controllerName.child_index.listbox_selectfull")                     
            </div>
            <div class="col-md-9">
                <div class="product-of-cat">
                    @include("$moduleName.pages.$controllerName.child_index.product_of_cat") 
                </div>
                <div id="product-covid" class="mt-5 p-4 sellingr">
                    @include("$moduleName.pages.$controllerName.child_index.sellingr")                       
                </div>
                <div class="cat-product-out mt-5">
                    @include("$moduleName.pages.$controllerName.child_index.cat_product")
                </div>
            </div>
        </div>
    </div>
    <div class="new-view mt-5">
         @include("$moduleName.pages.$controllerName.child_index.new_view")
    </div>
    <div class="info-tdoctor mt-5">
        @include("$moduleName.pages.$controllerName.child_index.info_tdoctor")
    </div>
    <div class="wp-inner mt-5" style="">
        @include("$moduleName.pages.$controllerName.child_index.info_app")
    </div>
    <div class="service-tdoctor mt-5">
        @include("$moduleName.pages.$controllerName.child_index.info_service")
    </div>
    <div class="local">
        @include("$moduleName.pages.$controllerName.child_index.local_drugstore")
    </div>
    <div class="wp-inner mt-5" style="">
        <div class="feedback-customer">
            @include("$moduleName.pages.$controllerName.child_index.feedback_customer")
        </div>
    </div>

@endsection

