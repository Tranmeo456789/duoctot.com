@extends('shop.frontend.block.menu.menu_layout')

@section('header_top')
<div class="wp-inner clearfix">
    <a href="{{route('home')}}" title="" id="" class="fl-left" style="padding-top: 25px;">
        <img style="width:220px" src="{{asset('images/shop/logo_duoctot.jpg')}}" alt="tdoctor">
    </a>
    <div class="fl-left wp-search-menu" style="padding-top: 30px;">
        @include('shop.frontend.block.menu.child_menu_yes_search.form_search')
    </div>
    <div class="fl-right">
        <div>
            @if(Session::has('user'))
            <div class="float-right" style="margin-left:10px;padding-top:20px;">
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                        {{Session::get('user')['fullname']}}
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{route('dashboard')}}">@lang('lang.account')</a>
                        <a class="dropdown-item" href="{{route('user.logout')}}">@lang('lang.log_out')</a>
                    </div>
                </div>
            </div>
            @else
            <div id="" class="fl-right" style="margin-left:25px;padding-top:12px;">
                <a title="" id="payment-link" class="">
                    <div class="btn-register">@lang('lang.register')</div>
                </a>
            </div>
            <div id="" class="fl-right" style="padding-top:12px;">
                <a title="" id="payment-link" class="">
                    <div class="btn-login">@lang('lang.login')</div>
                </a>
            </div>
            @endif
        </div>
        <div>
            <div id="cart-load" class="fl-right" style="padding-top:15px;">
                <div class="icon-cart-menu">
                    <a href="{{route('fe.product.cartFull')}}" title="" id="payment-link" class="">
                        <div class="clearfix icon_cart">
                            <div class="fl-left mr-2">
                                <i class="fas fa-shopping-cart icon-top"></i>
                            </div>
                            <div class="fl-left pt-1">
                                <p>Giỏ hàng</p>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-cart-info">
                        @include("$moduleName.templates.menu_cart")
                    </div>
                </div>
            </div>
            <div id="" class="fl-right" style="margin-right:30px; padding-top:15px">
                <a href="{{route('fe.order.formSearch')}}" id="payment-link" class="search-history-order">
                    <div class="clearfix">
                        <div class="fl-left mr-2">
                            <i class="fas fa-file-alt icon-top"></i>
                        </div>
                        <div class="fl-left pt-1">
                            <p>Tra cứu đơn hàng</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection