<div id="header-wp" class="position-relative">
    <div class="head_topon">
        <div class="wp-inner">
            <div class="d-flex justify-content-center">
                <div class="d-flex justify-content-center">
                    <div class="d-flex align-items-center"><span class="circle-ripple"></span></div>
                    <p>Kết nối khám chữa bệnh tại nhà với các bác sĩ online</p>
                    <a href="">Xem hướng dẫn</a>
                </div>
            </div>
        </div>
    </div>
    <div class="head_topon_reponsive">
        <div class="wp-inner">
            <div class="d-flex justify-content-center">
                <div class="d-flex justify-content-center">
                    <div><span class="circle-ripple"></span></div>
                    <a href="" class="tt-respon">Hướng dẫn</a>
                    <p>Kết nối khám chữa bệnh tại nhà</p>
                </div>
            </div>
        </div>
        <div class="fix1screen">
            <div class="wp-cart-res">
                @include("$moduleName.templates.menu_cart")
            </div>
        </div>
        <div class="black-res-screen"></div>
    </div>
    <div id="head-top" class="clearfix position-relative">
        <div class="wp-inner clearfix">
            <a href="{{route('home')}}" title="" id="payment-link" class="fl-left"><img style="width:213px" src="{{asset('images/shop/logo_topbar2.png')}}" alt=""></a>
            <div class="fl-left wp-search-menu">
                <form action="{{route('fe.search.saveHome')}}" method="POST">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <div class="d-flex">
                        <div class="wp-input-search">
                            <input type="text" name="keyword" class="input-search-info" value="{{$keyword??''}}" placeholder="Nhập tìm thuốc, TPCN, bệnh lý...">
                        </div>
                        <div class="wp-btn-search">
                            <button type="submit" class="btn-search-home btn" name="btn_search" value="1" disabled="disabled">
                                <img src="{{asset('images/shop/icon-search.png')}}" alt="">
                            </button>
                        </div>
                        
                    </div>
                </form>
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
    </div>
    <div id="form-login-register">
        @include('shop.frontend.block.form_login_register')
    </div>
    <div id="head-top-respon">
        <div class="wp-inner presp">
            <div class="wp-iconmn">
                <div class="d-flex justify-content-between">
                    <div id="btnmenu-resp" class="rimg-center"><img src="{{asset('images/shop/nb3.png')}}" alt=""></div>
                    <div class="logotop"><a href="{{route('home')}}">
                            <div class="rimg-center"><img src="{{asset('images/shop/logo_topbar2.png')}}" alt=""></div>
                        </a></div>
                    <ul class="d-flex align-items-center">
                        <li class="hrcart">
                            <a href="{{route('fe.product.cart')}}">
                                <div class="rimg-center">
                                    <img src="{{asset('images/shop/cart.png')}}">
                                </div>
                            </a>
                            @if(Session::has('cart'))
                            @if(count(Session::get('cart')) > 0 )
                            <span class="number_cartmenu">{{count(Session::get('cart'))}}</span>
                            @endif
                            @endif
                        </li>
                        <li class="hruse"><a href="">
                                <div class="rimg-center"><img src="{{asset('images/shop/mr1.png')}}" alt=""></div>
                            </a></li>
                        <li class="hrflag">
                            <div class="rimg-center">
                                <img src="{{asset('images/shop/corp.png')}}" alt="" srcset="">
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="ipsp">
                <input type="text" placeholder="Nhập tìm thuốc, TPCN, bệnh lý ...">
                <div class="rimg-center"></div><img src="{{asset('images/shop/icsp.png')}}" alt="">
            </div>
        </div>
    </div>
    <div id="head-body">
        <div class="wp-inner" id="category-product-wp">
            <div class="d-flex justify-content-between">
                <div class="menu-top1">
                    <div class="position-relative main-menu">
                        @include('shop.frontend.block.submenu')
                    </div>
                </div>
                <div class="flag pt-2">
                    <div class="position-relative">
                        <img src="{{asset('images/shop/flag.png')}}" alt="" srcset="">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tiếng Việt</button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{route('dashboard')}}">Tiếng Anh</a>
                                <a class="dropdown-item" href="{{route('user.logout')}}">Tiếng Pháp</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="head-body-respon">
        <div class="tlogo-menu position-relative">
            <div class="rimg-startm"><img src="{{asset('images/shop/logo_topbar2.png')}}" alt=""></div>
            <div class="rimg-center closem" id="closem"><img src="{{asset('images/shop/closem.png')}}" alt=""></div>
        </div>
        <div class="body-responhoder">
            <a href="{{route('fe.order.list')}}">
                <div class="container-menures d-flex">
                    <div class="rimg-center"><img src="{{asset('images/shop/news1.png')}}" alt=""></div>
                    <h2>Tra cứu lịch sử đơn hàng</h2>
                </div>
            </a>
        </div>

        <div class="list-menures">
            @include('shop.frontend.block.submenu_responsive')
        </div>

        <div class="btn-advice container-menures">
            <a href="" class="btn-refree">
                <div class="d-flex">
                    <div class="rimg-center mr-1"><img src="{{asset('images/shop/mess.png')}}" alt=""></div>
                    <span>Nhận tư vấn miễn phí</span>
                </div>
            </a>
        </div>

    </div>

    <div class="black-content"></div>
    <div class="black-screen"></div>
</div>