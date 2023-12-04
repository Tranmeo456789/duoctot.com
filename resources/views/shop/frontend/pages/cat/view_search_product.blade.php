@extends('shop.layouts.frontend')

@section('content')
<div class="wp-inner mt-2">
    <div class="" id="breadcrumb-wp">
        @include("$moduleName.pages.$controllerName.child_cat_level2.breadcrumb")
    </div>
    <div class="mb-3">
        @include("$moduleName.pages.$controllerName.child_view_search_product.form_search")
    </div>
    <div class="mb-3">
        @include("$moduleName.templates.box_title_product",['title' => 'Thuốc thông dụng','classBackground'=>'bg-danger'])
    </div>
    <div class="mb-3">
        @include("$moduleName.pages.$controllerName.child_view_search_product.list_product",['items'=>$productAlls])
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

@endsection