@extends('shop.frontend.block.menu.menu_layout')

@section('header_top')
<div class="wp-inner clearfix">
    <a href="{{route('home')}}" title="" id="payment-link" class="fl-left"><img style="width:213px" src="{{asset('images/shop/logo_topbar2.png')}}" alt=""></a>
    <div class="fl-left wp-search-menu">
        @include('shop.frontend.block.menu.child_menu_yes_search.form_search')
    </div>
    <div id="cart-load" class="fl-right" style="padding-top:15px;">
        <div class="icon-cart-menu">
            <a href="{{route('fe.product.cart')}}" title="" id="payment-link" class="">
                <div class="clearfix icon_cart">
                    <div class="fl-left mr-2">
                        <img style="width:32px" src="{{asset('images/shop/cart.png')}}" alt="">
                    </div>
                    <div class="fl-left pt-2">
                        <p>Giỏ hàng</p>
                    </div>
                </div>
            </a>
            <div class="dropdown-cart-info">
                @include("$moduleName.templates.menu_cart")
            </div>
        </div>
    </div>
    <div id="" class="fl-right" style="margin-right:50px; padding-top:5px">
        <a href="{{route('fe.order.list')}}" id="payment-link" class="search-history-order">
            <div class="clearfix">
                <div class="fl-left mr-2 pt-2">
                    <img style="width:26px" src="{{asset('images/shop/history.png')}}" alt="">
                </div>
                <div class="fl-left">
                    <p>Tra cứu</p>
                    <p>Lịch sử đơn hàng</p>
                </div>
            </div>
        </a>
    </div>

</div>
@endsection