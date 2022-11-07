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
            <h3>
                <div class="container-menures"><a href="">Trang chủ</a></div>
            </h3>
            <ul>
                @foreach ($_SESSION['cat_product'] as $itemLevel1)
                @if($itemLevel1['parent_id']==1)
                <li>
                    <div class="container-menures position-relative parentsmenu">
                        <div class=" pr-4">
                            <a href="">{{$itemLevel1['name']}}</a>
                        </div>
                        <div class="iconmnrhv"><img src="{{asset('images/shop/arrowd.png')}}" alt=""></div>
                        <div class="submenu1res">
                            <ul>
                                @foreach ( $_SESSION['cat_product'] as $item_catres2)
                                @if ($item_catres2['parent_id'] == $itemLevel1['id'])
                                <li><a href="">{{$item_catres2['name']}}</a></li>
                                @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </li>
                @endif
                @endforeach
                <li>
                    <div class="container-menures position-relative parentsmenu">
                        <div class=" pr-4">
                            <a href="">Nhà thuốc</a>
                        </div>
                    </div>
                </li>
                @if(Session::has('user'))
                <li>
                    <div class="container-menures position-relative parentsmenu">
                        <div class=" pr-4">
                            <a href="{{route('dashboard')}}">Tài khoản</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="container-menures position-relative parentsmenu">
                        <div class=" pr-4">
                            <a href="{{route('user.logout')}}">Đăng xuất</a>
                        </div>
                    </div>
                </li>
                @else
                <li>
                    <div class="container-menures position-relative parentsmenu">
                        <div class=" pr-4">
                            <a class="btn-register-res">Đăng ký</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="container-menures position-relative parentsmenu">
                        <div class=" pr-4">
                            <a class="btn-login-res">Đăng nhập</a>
                        </div>
                    </div>
                </li>
                @endif
            </ul>
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