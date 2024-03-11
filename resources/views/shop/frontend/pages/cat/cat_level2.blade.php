@extends('shop.layouts.frontend')

@section('content')
    <div class="wp-inner mt-2">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="" id="breadcrumb-wp">
                        @include("$moduleName.pages.$controllerName.child_cat_level2.breadcrumb")
                    </div>
                    <div id="cat_detail" class="">
                        @include("$moduleName.pages.$controllerName.child_cat_level2.list_cat_child")
                    </div>
                    <!-- <div>
                        @include("$moduleName.pages.$controllerName.templates.product_selling")
                    </div> -->
                </div>
                <div class="col-12">
                    <div class="box-filter-advanced row">
                        <div class="col-xl-3 trademark">
                            @include("$moduleName.pages.$controllerName.templates.listbox_select")
                        </div>
                        <div class="col-12 col-xl-9">
                            <div class="cat-product-out">
                                @include("$moduleName.pages.$controllerName.templates.product_highlight")
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-3">
                    @include("$moduleName.templates.list_product_new_view")
                    </div>
                </div>
            </div>     
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
    @include("$moduleName.pages.$controllerName.templates.modal_filter")
@endsection

