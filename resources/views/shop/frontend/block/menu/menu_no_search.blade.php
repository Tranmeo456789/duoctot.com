@extends('shop.frontend.block.menu.menu_layout')

@section('header_top')
        <div class="wp-inner clearfix">
            <a href="{{route('home')}}" title="" id="payment-link" class="fl-left"><img style="width:213px" src="{{asset('images/shop/logo_topbar2.png')}}" alt=""></a>
            <div id="" class="fl-left" style="margin-left:300px; padding-top:5px">
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
            <div id="cart-load" class="fl-left" style="margin-left:30px;padding-top:15px;">
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
            @if(Session::has('user'))
            <div class="float-right" style="margin-left:10px;padding-top:20px;">
                <div class="dropdown">
                    <button class="btn dropdown-toggle text-light" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                        {{Session::get('user')['fullname']}}
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{route('dashboard')}}">Tài khoản</a>
                        <a class="dropdown-item" href="{{route('user.logout')}}">Thoát</a>
                    </div>
                </div>
            </div>
            @else
            <div id="" class="fl-right" style="margin-left:10px;padding-top:12px;">
                <a title="" id="payment-link" class="">
                    <div class="btn-register">Đăng ký</div>
                </a>
            </div>
            <div id="" class="fl-right" style="padding-top:12px;">
                <a title="" id="payment-link" class="">
                    <div class="btn-login">Đăng nhập</div>
                </a>
            </div>
            @endif
        </div>
@endsection