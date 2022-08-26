@extends('shop.layouts.frontend')

@section('content')
<div class="cbr pt-4">
    <div class="wp-inner">
        <div class="wp-cart-null d-flex justify-content-center">
            <div class="cart-null text-center">
                <div><img src="{{asset('images/shop/cn1.png')}}" alt=""></div>
                <h1>Chưa có sản phẩm nào trong giỏ hàng</h1>
                <a href="">TIẾP TỤC MUA SẮM</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="new-view mt-5">
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