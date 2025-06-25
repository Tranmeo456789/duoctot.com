@extends('shop.frontend.block.menu.menu_layout')

@section('header_top')
        <div class="wp-inner clearfix">
            <a href="{{route('home')}}" title="" id="payment-link" class="fl-left"><img style="width:213px;height:51px" src="{{asset('images/shop/logo_duoctot.jpg')}}" alt="tdoctor"></a>
            <!-- <div class="fl-left ml-4 font-weight-bold" style="font-size: 20px; color:red;padding-top:24px;">
                <span>Hotline </span><a href="tel:0393167234" style="font-size: 26px; color:red;">0393.167.234</a>
            </div> -->
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
            <div id="" class="fl-right" style="margin-left:10px;padding-top:12px;">
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
            <div id="cart-load" class="fl-right" style="margin-left:30px;padding-top:15px;margin-right:20px;">
                <div class="icon-cart-menu">
                    <a href="{{route('fe.product.cartFull')}}" title="" id="payment-link" class="">
                        <div class="clearfix icon_cart">
                            <!-- <div class="fl-left mr-2">
                                <img style="width:32px" src="{{asset('images/shop/cart.png')}}" alt="">
                            </div> -->
                            <div class="fl-left mr-2">
                                <i class="fas fa-shopping-cart icon-top"></i>
                            </div>
                            <div class="fl-left pt-1">
                                <p>@lang('lang.cart')</p>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-cart-info">
                        @include("$moduleName.templates.menu_cart")
                    </div>
                </div>
            </div>
            <div class="fl-right" style="margin-left:100px; padding-top:15px">
                <a href="{{route('fe.order.formSearch')}}" id="payment-link" class="search-history-order">
                    <div class="clearfix">
                        <!-- <div class="fl-left mr-2 pt-2">
                            <img style="width:26px" src="{{asset('images/shop/history.png')}}" alt="">
                        </div> -->
                        <div class="mr-2 fl-left">
                            <i class="fas fa-file-alt icon-top"></i>
                        </div>
                        <div class="pt-1 fl-left">
                            <p>@lang('lang.order_history')</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
@endsection