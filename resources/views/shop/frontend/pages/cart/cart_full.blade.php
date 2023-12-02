@extends('shop.layouts.frontend_search_in_menu')
@section('content')
<div class="cbr">
        <div class="d-block py-3 wp-inner">
            <a href="{{route('home')}}" class="contine_order"><i class="fas fa-angle-left"></i> Tiếp tục mua hàng</a>
        </div>
        @include ("$moduleName.pages.cart.child_cart_full.list_product")
        <div class="wp-inner">
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