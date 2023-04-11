<div id="header-wp" class="position-relative">
    <div class="head_topon">
        <div class="wp-inner">
            <div class="d-flex justify-content-center">
                <div class="d-flex justify-content-center">
                    <div class="d-flex align-items-center"><span class="circle-ripple"></span></div>
                    <p>@lang('lang.connecting_home_medical_with_online_doctors')</p>
                    <a href="">@lang('lang.instruction')</a>
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
                    <p class="p-head-topon">Kết nối khám chữa bệnh tại nhà</p>
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
        @yield('header_top')
        <!-- <div id="search-order">
            <div class="header d-flex justify-content-between">
                <a href="{{route('fe.order.list')}}">
                    <div class="tshorder">Tra cứu lịch sử đơn hàng</div>
                    <button class="btn-closenk rimg-center"><img src="{{asset('images/shop/dn4.png')}}" alt=""></button>
                </a>
            </div>
            <div class="d-flex justify-content-center">
                <div class="wp-content">
                    <form action="" class="wp-content-shorder">
                        <div class="content text-center">
                            <div class="mb-3 rimg-center"><img src="{{asset('images/shop/tclsdh.png')}}" alt="" style="display:block"></div>
                            <p class="nsdt">Nhập số điện thoại bạn dùng
                                để mua hàng tại TDoctor</p>
                            <div class="phone-mail position-relative">
                                <input type="text" placeholder="Nhập số điện thoại / Email">
                                <div class="img-person"><img src="{{asset('images/shop/dn1.png')}}" alt=""></div>
                            </div>
                        </div>
                        <div class="text-center"><input type="submit" name="btn-searchorder" value="Tiếp tục" id="btn-searchorder"></div>
                    </form>
                </div>
            </div>
        </div> -->
    </div>
    <div id="form-login-register">
        @include('shop.frontend.block.form_login_register')
    </div>
    <div id="head-top-respon">
        @include("$moduleName.block.box_responsive.box_head_top_responsive")
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
                        @if(session()->has('locale'))
                            <img src="{{asset('images/shop/')}}/fg_{{session()->get('locale')}}.png">
                        @else
                            <img src="{{asset('images/shop/flag.png')}}">
                        @endif
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('lang.language')</button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{url('lang/vi')}}">@lang('lang.vietnam')</a>
                                <a class="dropdown-item" href="{{url('lang/en')}}">@lang('lang.english')</a>
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
        @if((Session::has('user') && Session::get('user')['user_type_id'] != 9) || Session::get('user')==null)
            <div class="body-responhoder">
                <a href="{{route('fe.order.list')}}">
                    <div class="container-menures d-flex">
                        <div class="rimg-center"><img src="{{asset('images/shop/news1.png')}}" alt=""></div>
                        <h2>Tra cứu lịch sử đơn hàng</h2>
                    </div>
                </a>
            </div>
        @endif
        <div class="list-menures">
            @include('shop.frontend.block.box_responsive.submenu_responsive')
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

</div>