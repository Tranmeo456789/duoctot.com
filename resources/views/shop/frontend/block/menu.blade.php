<div id="header-wp" class="position-relative">
    <div class="head_topon d-flex justify-content-center py-1">
        <div class="d-flex justify-content-center align-middle">
            <span class="circle-ripple"></span>
            <p>Kết nối khám chữa bệnh tại nhà với các bác sĩ online</p>
            <a href="">Xem hướng dẫn</a>
        </div>
    </div>
    <div id="head-top" class="clearfix position-relative">
        <div class="wp-inner">
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
                <a href="{{url('gio-hang')}}" title="" id="payment-link" class="">
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
                            <div class="text-center"><input type="submit" name="btn-forget" value="Tiếp tục" id="btn-forget"></div>
                        </form>
                    </div>
                </div>
        </div>
    </div>
    <div id="head-top-respon">
        <div class="wp-inner presp">
            <div class="d-flex justify-content-between">
                <div id="btnmenu-resp"><i class="fas fa-bars"></i></div>
                <div class="logotop"><a href="{{route('home')}}"><img style="width:213px" src="{{asset('images/shop/logo_topbar2.png')}}" alt=""></a></div>
                <ul class="d-flex">
                    <li class="hrcart"><a href=""><img style="width:32px" src="{{asset('images/shop/cart.png')}}" alt="" srcset=""></a></li>
                    <li class="hruse"><a href=""><i class="fas fa-user"></i></a></li>
                    <li class="hrflag">
                        <div class=" d-flex">
                            <img src="{{asset('images/shop/coviet.png')}}" alt="" srcset="">
                            <p class=""><span><i class="fas fa-angle-down"></i></span></p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="ipsp">
                <input type="text" placeholder="Nhập từ khóa...">
                <img src="{{asset('images/shop/icsp.png')}}" alt="">
            </div>
        </div>
    </div>
    <div id="head-body">
        <div class="wp-inner" id="category-product-wp">
            <div class="d-flex justify-content-between">
                <div class="menu-top1">
                    <div class="position-relative">
                        <ul id="main-menu" class="d-flex list-item">
                            <li class="catc1">
                                <a href="{{route('fe.cat')}}">
                                    Thực phẩm chức năng
                                    <i class="fas fa-chevron-down arrow"></i>
                                </a>
                                <div class="content-submenu row">
                                    <div class="col-md-4 px-0">
                                        <ul class="sub-menu1">
                                            <li>
                                                <div class="himg-menu">
                                                    <div class="rdimg"><img src="{{asset('images/shop/sm1.png')}}" alt=""></div>
                                                    <a href="{{route('fe.cat3')}}" title="">Sinh lý nội tiết tố</a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="himg-menu">
                                                    <div class="rdimg"><img src="{{asset('images/shop/sm2.png')}}" alt=""></div>
                                                    <a href="{{route('fe.cat3')}}" title="">Sức khỏe tim mạch</a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="himg-menu">
                                                    <div class="rdimg"><img src="{{asset('images/shop/sm3.png')}}" alt=""></div>
                                                    <a href="{{route('fe.cat3')}}" title="">Hỗ trợ tiêu hóa</a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="himg-menu">
                                                    <div class="rdimg"><img src="{{asset('images/shop/sm4.png')}}" alt=""></div>
                                                    <a href="{{route('fe.cat3')}}" title="">Thần kinh não</a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="himg-menu">
                                                    <div class="rdimg"><img src="{{asset('images/shop/sm5.png')}}" alt=""></div>
                                                    <a href="{{route('fe.cat3')}}" title="">Hỗ trợ điều trị</a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="himg-menu">
                                                    <div class="rdimg"><img src="{{asset('images/shop/sm6.png')}}" alt=""></div>
                                                    <a href="{{route('fe.cat3')}}" title="">Cải thiện tăng cường chức năng</a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="himg-menu">
                                                    <div class="rdimg"><img src="{{asset('images/shop/sm7.png')}}" alt=""></div>
                                                    <a href="{{route('fe.cat3')}}" title="">Thảo dược và thực phẩm tự nhiên</a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="himg-menu">
                                                    <div class="rdimg"><img src="{{asset('images/shop/sm8.png')}}" alt=""></div>
                                                    <a href="{{route('fe.cat3')}}" title="">Hỗ trợ làm đẹp</a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="himg-menu">
                                                    <div class="rdimg"><img src="{{asset('images/shop/sm9.png')}}" alt=""></div>
                                                    <a href="{{route('fe.cat3')}}" title="">Vitamin và khoáng chất</a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="himg-menu">
                                                    <div class="rdimg"><img src="{{asset('images/shop/sm10.png')}}" alt=""></div>
                                                    <a href="{{route('fe.cat3')}}" title="">Dinh dưỡng</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-8 content-submenu-right">
                                        <div class="">
                                            <div id="cat_detail">
                                                <ul class="body_catdetail clearfix">
                                                    <li class="py-2">
                                                        <a href="{{route('fe.cat4')}}">
                                                            <div class="item_cat4">
                                                                <div class="aimg">
                                                                    <img src="{{asset('images/shop/sl1.png')}}" alt="">
                                                                </div>
                                                                <span>Sinh lý nam</span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="py-2">
                                                        <a href="{{route('fe.cat4')}}">
                                                            <div class="item_cat4">
                                                                <div class="aimg">
                                                                    <img src="{{asset('images/shop/sl2.png')}}" alt="">
                                                                </div>
                                                                <span>Sinh lý nữ</span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="py-2">
                                                        <a href="{{route('fe.cat4')}}">
                                                            <div class="item_cat4">
                                                                <div class="aimg">
                                                                    <img src="{{asset('images/shop/sl3.png')}}" alt="">
                                                                </div>
                                                                <span>Hỗ trợ thần kinh</span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="py-2">
                                                        <a href="{{route('fe.cat4')}}">
                                                            <div class="item_cat4">
                                                                <div class="aimg">
                                                                    <img src="{{asset('images/shop/sl4.png')}}" alt="">
                                                                </div>
                                                                <span>Cân bằng nội tiết tố</span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="py-2">
                                                        <a href="{{route('fe.cat4')}}">
                                                            <div class="item_cat4">
                                                                <div class="aimg">
                                                                    <img src="{{asset('images/shop/sl5.png')}}" alt="">
                                                                </div>
                                                                <span>Sức khỏe tình dục</span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div class="title-product-out d-flex justify-content-between my-3">
                                                    <div class="title_cathd">
                                                        <h1>Sản phẩm nổi bật</h1>
                                                        <img src="{{asset('images/shop/lua4.png')}}" alt="">
                                                    </div>
                                                    <a href="">Xem tất cả</a>
                                                </div>
                                                <div id="productimenu pb-3">
                                                    <ul class="">
                                                        <div class="row">
                                                            <div class="col-3 pl-3">
                                                                <li>
                                                                    <div class="bimgm"><img src="{{asset('images/shop/sri1.png')}}" alt=""></div>
                                                                    <div class="">
                                                                        <a href="{{route('fe.product.detail')}}">Siro Bổ Phế Bối Mẫu Forte Mom And Baby...</a>
                                                                        <h3 class="my-2">49.000đ/Chai</h3>
                                                                    </div>
                                                                </li>
                                                            </div>
                                                            <div class="col-3 pl-3">
                                                                <li>
                                                                    <div class="bimgm"><img src="{{asset('images/shop/sri1.png')}}" alt=""></div>
                                                                    <div class="">
                                                                        <a href="{{route('fe.product.detail')}}">Siro Bổ Phế Bối Mẫu Forte Mom And Baby...</a>
                                                                        <h3 class="my-2">49.000đ/Chai</h3>
                                                                    </div>
                                                                </li>
                                                            </div>
                                                            <div class="col-3 pl-3">
                                                                <li>
                                                                    <div class="bimgm"><img src="{{asset('images/shop/sri1.png')}}" alt=""></div>
                                                                    <div class="">
                                                                        <a href="{{route('fe.product.detail')}}">Siro Bổ Phế Bối Mẫu Forte Mom And Baby...</a>
                                                                        <h3 class="my-2">49.000đ/Chai</h3>
                                                                    </div>
                                                                </li>
                                                            </div>
                                                            <div class="col-3 pl-3">
                                                                <li>
                                                                    <div class="bimgm"><img src="{{asset('images/shop/sri1.png')}}" alt=""></div>
                                                                    <div class="">
                                                                        <a href="{{route('fe.product.detail')}}">Siro Bổ Phế Bối Mẫu Forte Mom And Baby...</a>
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
                                </div>
                            </li>
                            <li class="">
                                <a href="{{route('fe.cat')}}">Dược mỹ phẩm</a>
                            </li>
                            <li class="">
                                <a href="{{route('fe.cat')}}">Chăm sóc cá nhân</a>
                            </li>
                            <li class="">
                                <a href="">Thuốc</a>
                            </li>
                            <li class="catc1">
                                <a href="{{route('fe.cat')}}">Thiết bị y tế
                                    <i class="fas fa-chevron-down arrow"></i>
                                </a>
                                <div class="content-submenu row">
                                    <div class="col-md-4 px-0">
                                        <ul class="sub-menu1">
                                            <li>
                                                <div class="himg-menu">
                                                    <div class="rdimg"><img src="{{asset('images/shop/sm1.png')}}" alt=""></div>
                                                    <a href="{{route('fe.cat3')}}" title="">Dụng cụ y tế</a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="himg-menu">
                                                    <div class="rdimg"><img src="{{asset('images/shop/sm2.png')}}" alt=""></div>
                                                    <a href="{{route('fe.cat3')}}" title="">Khẩu trang</a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="himg-menu">
                                                    <div class="rdimg"><img src="{{asset('images/shop/sm3.png')}}" alt=""></div>
                                                    <a href="{{route('fe.cat3')}}" title="">Dụng cụ theo dõi</a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="himg-menu">
                                                    <div class="rdimg"><img src="{{asset('images/shop/sm4.png')}}" alt=""></div>
                                                    <a href="{{route('fe.cat3')}}" title="">Dụng cụ sơ cứu</a>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="himg-menu">
                                                    <div class="rdimg"><img src="{{asset('images/shop/sm10.png')}}" alt=""></div>
                                                    <a href="{{route('fe.cat3')}}" title="">Dinh dưỡng</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-8 content-submenu-right">
                                        <div class="">
                                            <div id="cat_detail">
                                                <ul class="body_catdetail clearfix">
                                                    <li class="py-2">
                                                        <a href="{{route('fe.cat4')}}">
                                                            <div class="item_cat4">
                                                                <div class="aimg">
                                                                    <img src="{{asset('images/shop/sl1.png')}}" alt="">
                                                                </div>
                                                                <span>Sinh lý nam</span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="py-2">
                                                        <a href="{{route('fe.cat4')}}">
                                                            <div class="item_cat4">
                                                                <div class="aimg">
                                                                    <img src="{{asset('images/shop/sl2.png')}}" alt="">
                                                                </div>
                                                                <span>Sinh lý nữ</span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="py-2">
                                                        <a href="{{route('fe.cat4')}}">
                                                            <div class="item_cat4">
                                                                <div class="aimg">
                                                                    <img src="{{asset('images/shop/sl3.png')}}" alt="">
                                                                </div>
                                                                <span>Hỗ trợ thần kinh</span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="py-2">
                                                        <a href="{{route('fe.cat4')}}">
                                                            <div class="item_cat4">
                                                                <div class="aimg">
                                                                    <img src="{{asset('images/shop/sl4.png')}}" alt="">
                                                                </div>
                                                                <span>Cân bằng nội tiết tố</span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="py-2">
                                                        <a href="{{route('fe.cat4')}}">
                                                            <div class="item_cat4">
                                                                <div class="aimg">
                                                                    <img src="{{asset('images/shop/sl5.png')}}" alt="">
                                                                </div>
                                                                <span>Sức khỏe tình dục</span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div class="title-product-out d-flex justify-content-between my-3">
                                                    <div class="title_cathd">
                                                        <h1>Sản phẩm nổi bật</h1>
                                                        <img src="{{asset('images/shop/lua4.png')}}" alt="">
                                                    </div>
                                                    <a href="">Xem tất cả</a>
                                                </div>
                                                <div id="productimenu">
                                                    <ul class="">
                                                        <div class="row">
                                                            <div class="col-3 pl-3">
                                                                <li>
                                                                    <div class="bimgm"><img src="{{asset('images/shop/sri1.png')}}" alt=""></div>
                                                                    <div class="">
                                                                        <a href="">Siro Bổ Phế Bối Mẫu Forte Mom And Baby...</a>
                                                                        <h3 class="my-2">49.000đ/Chai</h3>
                                                                    </div>
                                                                </li>
                                                            </div>
                                                            <div class="col-3 pr-3">
                                                                <li>
                                                                    <div class="bimgm"><img src="{{asset('images/shop/sri1.png')}}" alt=""></div>
                                                                    <div class="">
                                                                        <a href="">Siro Bổ Phế Bối Mẫu Forte Mom And Baby...</a>
                                                                        <h3 class="my-2">49.000đ/Chai</h3>
                                                                    </div>
                                                                </li>
                                                            </div>
                                                            <div class="col-3 pr-3">
                                                                <li>
                                                                    <div class="bimgm"><img src="{{asset('images/shop/sri1.png')}}" alt=""></div>
                                                                    <div class="">
                                                                        <a href="">Siro Bổ Phế Bối Mẫu Forte Mom And Baby...</a>
                                                                        <h3 class="my-2">49.000đ/Chai</h3>
                                                                    </div>
                                                                </li>
                                                            </div>
                                                            <div class="col-3 pr-3">
                                                                <li>
                                                                    <div class="bimgm"><img src="{{asset('images/shop/sri1.png')}}" alt=""></div>
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
                                </div>
                            </li>
                            <li class="">
                                <a href="{{route('fe.cat')}}">Bệnh</a>
                            </li>
                            <li class="">
                                <a href="{{route('fe.cat')}}">Góc sức khỏe</a>
                            </li>
                            <li class="">
                                <a href="{{route('fe.cat')}}">Nhà thuốc</a>
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
    <div class="black-content"></div>
    <div class="black-screen"></div>
</div>