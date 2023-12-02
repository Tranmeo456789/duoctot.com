@extends('shop.layouts.frontend')
@section('content')
<div class="cbr">
    <div class="wp-inner">
        @if(!empty($item))
            <div class="d-block py-3">
                <a href="{{route('home')}}" class="contine_order"><i class="fas fa-angle-left"></i> Tiếp tục mua hàng</a>
            </div>
            @include("$moduleName.pages.$controllerName.child_view.form_info")
        @else
            @include("$moduleName.pages.$controllerName.child_view.cart_null")
        @endif

        <div>
             @include("$moduleName.templates.list_product_new_view")
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