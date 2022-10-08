@extends('shop.layouts.frontend')
@section('content')
<div class="cbr">
    <div class="wp-inner">
        @if(Session::has('cart'))
        @if(count(Session::get('cart')) > 0)
        <div class="cbh1"><a href="{{route('home')}}"><i class="fas fa-angle-left"></i> Tiếp tục mua hàng</a></div>
            @include("$moduleName.pages.$controllerName.child_product.form_info_buy")
        @else
            @include("$moduleName.pages.$controllerName.child_product.cart_null")
        @endif
        @else
            @include("$moduleName.pages.$controllerName.child_product.cart_null")
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="new-view">
                    @include("$moduleName.pages.$controllerName.child_product.new_view")
                </div>
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