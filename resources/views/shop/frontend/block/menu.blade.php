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
                    <a href="">Hướng dẫn</a>
                    <p>Kết nối khám chữa bệnh tại nhà</p>
                </div>
            </div>
        </div>
    </div>
    <div id="head-top" class="clearfix position-relative">
        <div class="wp-inner clearfix">
            <a href="{{route('home')}}" title="" id="payment-link" class="fl-left"><img style="width:213px" src="{{asset('images/shop/logo_topbar2.png')}}" alt=""></a>
            <div id="" class="fl-left" style="margin-left:300px; padding-top:5px">
                <a title="" id="payment-link" class="search-history-order">
                    <div class="clearfix">
                        <div class="fl-left mr-2 pt-2">
                            <img style="width:26px" src="{{asset('images/shop/history.png')}}" alt="" srcset="">
                        </div>
                        <div class="fl-left">
                            <p>Tra cứu</p>
                            <p>Lịch sử đơn hàng</p>
                        </div>
                    </div>
                </a>
            </div>
            <div id="" class="fl-left" style="margin-left:30px;padding-top:15px;">
                <a href="{{route('fe.product.cart')}}" title="" id="payment-link" class="">
                    <div class="clearfix">
                        <div class="fl-left mr-2">
                            <img style="width:32px" src="{{asset('images/shop/cart.png')}}" alt="" srcset="">
                        </div>
                        <div class="fl-left pt-2">
                            <p>Giỏ hàng</p>
                        </div>
                    </div>
                </a>
            </div>
            @if(Session::has('islogin'))
            <div class="fl-right" style="margin-left:10px;padding-top:20px;">
                <div class="dropdown">
                    <button class="btn dropdown-toggle text-light" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Session::get('name')}}</button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Tài khoản</a>
                        <a class="dropdown-item" href="{{route('user.logout')}}">Thoát</a>
                    </div>
                </div>
            </div>
            @else
            <div id="" class="fl-right" style="margin-left:10px;padding-top:15px;">
                <a title="" id="payment-link" class="">
                    <div class="btn-register">Đăng ký</div>
                </a>
            </div>
            <div id="" class="fl-right" style="padding-top:15px;">
                <a title="" id="payment-link" class="">
                    <div class="btn-login">Đăng nhập</div>
                </a>
            </div>
            @endif
        </div>
        <div id="form-login-register">
            @include('shop.frontend.block.form_login_register')
        </div>
        <div id="search-order">
            <div class="header d-flex justify-content-between">
                <div class="tshorder">Tra cứu lịch sử đơn hàng</div>
                <button class="btn-closenk rimg-center"><img src="{{asset('images/shop/dn4.png')}}" alt=""></button>
            </div>
            <div class="d-flex justify-content-center">
                <div class="wp-content">
                    <form action="" class="wp-content-shorder">
                        <div class="content text-center">
                            <div class="mb-3 rimg-center"><img src="{{asset('images/shop/tclsdh.png')}}" alt="" style="display:block"></div>
                            <p class="nsdt">Nhập số điện thoại bạn dùng
                                để mua hàng tại T Doctor</p>
                            <div class="phone-mail position-relative">
                                <input type="text" placeholder="Nhập số điện thoại / Email">
                                <div class="img-person"><img src="{{asset('images/shop/dn1.png')}}" alt=""></div>
                            </div>
                        </div>
                        <div class="text-center"><input type="submit" name="btn-searchorder" value="Tiếp tục" id="btn-searchorder"></div>
                    </form>
                </div>
            </div>
        </div>
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
                        <li class="hrcart"><a href="{{route('fe.product.cart')}}">
                                <div class="rimg-center"><img src="{{asset('images/shop/cart.png')}}"></div>
                            </a></li>
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
                    <div class="position-relative ">
                        <ul id="main-menu" class="d-flex list-item">
                            @foreach ($_SESSION['cat_product'] as $item_cat1)
                            @if($item_cat1['parent_id']==0)
                            <li class="catc1">
                                <a href="{{route('fe.cat',$item_cat1->slug)}}">
                                    {{$item_cat1['name']}}
                                    <i class="fas fa-chevron-down arrow"></i>
                                </a>
                                <div class="content-submenu">
                                    <div class="px-0 position-relative right-fol" style="width:25%">
                                        <ul class="sub-menu1">
                                            @foreach ($_SESSION['cat_product'] as $item_sub_menu1)
                                            @if ($item_sub_menu1['parent_id'] == (int)$item_cat1['id'] )
                                            <li>
                                                <div class="himg-menu">
                                                    <div class="d-flex">
                                                        <div class="d-flex align-items-center pl-2">
                                                            <div class="rdimg rimg-centerw"><img src="{{asset('public/shop/uploads/images/product/'.$item_sub_menu1['image'])}}" alt=""></div>
                                                        </div>
                                                        <a href="{{route('fe.cat2',[$item_cat1->slug,$item_sub_menu1->slug])}}" title="" class="titlec2">{{$item_sub_menu1['name']}}</a>
                                                    </div>
                                                    <div class="sub-menu2 content-submenu-right">
                                                        <div id="cat_detail">
                                                            <ul class="body_catdetail clearfix">
                                                                @foreach ($_SESSION['cat_product'] as $item_submenu2)
                                                                @if ($item_submenu2['parent_id'] == $item_sub_menu1['id'])
                                                                <li class="">
                                                                    <a href="{{route('fe.cat3',[$item_cat1->slug,$item_sub_menu1->slug,$item_submenu2->slug])}}">
                                                                        <div class="item_cat4 d-flex">
                                                                            <div class="aimg rimg-centerx mr-1">
                                                                                <img src="{{asset('public/shop/uploads/images/product/'.$item_submenu2['image'])}}" alt="">
                                                                            </div>
                                                                            <div class="align-self-center"><span>{{$item_submenu2['name']}}</span></div>
                                                                        </div>
                                                                    </a>
                                                                </li>
                                                                @endif
                                                                @endforeach
                                                            </ul>
                                                            <div class="title-product-out d-flex justify-content-between my-3">
                                                                <div class="title_cathd">
                                                                    <h1>Sản phẩm nổi bật</h1>
                                                                    <img src="{{asset('images/shop/lua4.png')}}" alt="">
                                                                </div>
                                                                <a href="">Xem tất cả</a>
                                                            </div>
                                                            <div class="productimenu">
                                                                <ul class="">
                                                                    <div class="row">
                                                                        <div class="col-3 pl-3">
                                                                            <li>
                                                                                <div class="bimgm"><a href=""><img src="{{asset('images/shop/sri1.png')}}" alt=""></a></div>
                                                                                <div class="">
                                                                                    <a href="">Siro Bổ Phế Bối Mẫu Forte Mom And Baby...</a>
                                                                                    <h3 class="my-2">49.000đ/Chai</h3>
                                                                                </div>
                                                                            </li>
                                                                        </div>

                                                                    </div>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            @endif
                            @endforeach
                            <li class="">
                                <a href="">Nhà thuốc</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="flag pt-2">
                    <div class="position-relative">
                        <img src="{{asset('images/shop/flag.png')}}" alt="" srcset="">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tiếng Việt</button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Tiếng Anh</a>
                                <a class="dropdown-item" href="#">Tiếng Pháp</a>
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
            <div class="container-menures d-flex">
                <div class="rimg-center"><img src="{{asset('images/shop/news1.png')}}" alt=""></div>
                <h2>Tra cứu lịch sử đơn hàng</h2>
            </div>
        </div>

        <div class="list-menures">
            <h3>
                <div class="container-menures"><a href="">Trang chủ</a></div>
            </h3>
            <ul>
                @foreach ($_SESSION['cat_product'] as $item_cat1)
                @if($item_cat1['parent_id']==0)
                <li>
                    <div class="container-menures position-relative parentsmenu">
                        <div class=" pr-4">
                            <a href="">{{$item_cat1['name']}}</a>
                        </div>
                        <div class="iconmnrhv"><img src="{{asset('images/shop/arrowd.png')}}" alt=""></div>
                        <div class="submenu1res">
                            <ul>
                                @foreach ( $_SESSION['cat_product'] as $item_catres2)
                                @if ($item_catres2['parent_id'] == $item_cat1['id'])
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
                            <a href="">Nhà thuôc</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <div class="btn-advice container-menures">
            <a href="">
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