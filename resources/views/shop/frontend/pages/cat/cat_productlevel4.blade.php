@extends('shop.layouts.frontend')

@section('content')
<div class="wp-inner mt-2">
    <div class="row">
        <div class="col-md-12">
            <div class="" id="breadcrumb-wp">
                @include("$moduleName.pages.$controllerName.child_index.breadcrumb4")
            </div>
        </div>
        <div class="col-md-3 trademark">
            @include("$moduleName.pages.$controllerName.child_index.listbox_select")
        </div>
        <div class="col-md-9">
            <div class="cat-product-out mt-5">
                @include("$moduleName.pages.$controllerName.child_index.cat_product")
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="new-view mt-5">
                @include("$moduleName.pages.$controllerName.child_index.new_view")
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