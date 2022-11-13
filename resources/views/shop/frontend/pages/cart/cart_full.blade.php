@extends('shop.layouts.frontend')
@section('content')
<div class="cbr">
    <div class="wp-inner">
        <div class="d-block py-3">
            <a href="{{route('home')}}" class="contine_order"><i class="fas fa-angle-left"></i> Tiếp tục mua hàng</a>
        </div>
        @php
        $number_product = '';
        $message = '';
        if (!isset($itemsCart)){
        $itemsCart = [];
        if (isset($_COOKIE['cart'])){
        $itemsCart = json_decode($_COOKIE['cart'],true);
        $number_product = array_sum(array_column($itemsCart, 'total_product'));
        }
        }else{
        $number_product = array_sum(array_column($itemsCart, 'total_product'));
        $message = "Thêm thành công sản phẩm vào giỏ hàng";
        }
        $classMessage = ($message != '')?'d-block':'d-none';
        $classNumberCartMenu = ($number_product != '')?'d-block':'d-none';
        @endphp
        <div class="wp-cart-full">
            <div class="position-relative">
                <ul class="list-cart-mini">
                    @foreach ($itemsCart as $keyCart =>$valCart)
                    <li class="user-seller user-seller-{{$keyCart}}" data-id={{$keyCart}}>
                        <p class="name_seller">{!! $valCart['name'] !!}</p>
                        <ul class="list-product-in-cart">
                            @foreach ($valCart['product'] as $product)
                            @include ("$moduleName.pages.cart.partial.item_product_in_cart_mini",['item' => $product,'user_sell' => $keyCart])
                            @endforeach
                        </ul>
                        <div class="text-right"><a href="{{route('fe.product.viewcart',['user_sell' => $keyCart])}}" class="btn btn-sm btn-success btn-view-cart">Mua hàng</a></div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="new-view">
                    @include("$moduleName.templates.new_view")
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