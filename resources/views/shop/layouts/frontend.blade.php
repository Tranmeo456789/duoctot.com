<!DOCTYPE html>
<html>
    <head>
        <title>Trang chủ shop</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" crossorigin="anonymous">
        <link href="{{ asset('/shop/frontend/reset.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('/shop/frontend/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('/shop/frontend/css/import/header.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('/shop/frontend/css/import/home.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('/shop/frontend/css/import/global.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('/shop/frontend/css/import/footer.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('/shop/frontend/responsive.css')}}" rel="stylesheet" type="text/css"/>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" ></script>       
        <script src="{{ asset('/shop/frontend/js/main.js')}}" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" ></script>
    </head>
    <body>
        <div id="site">
            <div id="container">
                <div id="header-wp">
                    <div id="head-top" class="clearfix">
                        <div class="wp-inner">
                            <a href="" title="" id="payment-link" class="fl-left"><img style="width:213px" src="{{asset('images/shop/logo_topbar1.png')}}" alt=""></a>
                            <div id="" class="fl-left" style="margin-left:300px; padding-top:5px">                             
                                    <a href="" title="" id="payment-link" class="">
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
                                    <a href="" title="" id="payment-link" class="">
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
                                <a href="" title="" id="payment-link" class="">
                                    <div class="btn-register">Đăng ký</div> 
                                </a>                              
                            </div>
                            <div id="" class="fl-right" style="padding-top:15px;">                             
                                <a href="" title="" id="payment-link" class="">
                                    <div class="btn-login">Đăng nhập</div> 
                                </a>                              
                            </div>
                            
                        </div>
                    </div>
                    <div id="head-body">
                        <div class="wp-inner">
                            <div class="fl-left">
                                <ul id="main-menu" class="d-flex">
                                    <li>
                                        <a href="">Thực phẩm chức năng</a>
                                    </li>
                                    <li>
                                        <a href="">Dược mỹ phẩm</a>
                                    </li>
                                    <li>
                                        <a href="">Chăm sóc cá nhân</a>
                                    </li>
                                    <li>
                                        <a href="">Thuốc</a>
                                    </li>
                                    <li>
                                        <a href="">Thiết bị y tế</a>
                                    </li>
                                    <li>
                                        <a href="">Bệnh</a>
                                    </li>
                                    <li>
                                        <a href="">Góc sức khỏe</a>
                                    </li>
                                    <li>
                                        <a href="">Nhà thuốc</a>
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="fl-right d-flex pt-2">
                                <img src="{{asset('images/shop/flag.png')}}" alt="" srcset="">
                                <p class="pt-2">Tiếng Việt</p>
                            </div>
                        </div>                              
                    </div>
                </div>
                <div id="main-content-wp" class="home-page clearfix">
                    @yield('content')
                </div>
                <div id="footer-wp" class="pb-5">
                    <div class="wp-inner">
                        <div class="row">
                            <div class="col-md-3">
                                <h1 class="mb-3">TDOCTOR</h1>
                                <p>Về chúng tôi</p>
                                <p>Liên hệ</p>
                                <p>Quy trình giải quyết tranh chấp</p>
                                <p>Chính sách bảo mật thông tin</p>
                                <p>Đăng ký bác sỹ</p>
                                <p>Đăng ký phòng khám</p>
                            </div>
                            <div class="col-md-3 social">
                                <h1 class="mb-1">Liên hệ</h1>
                                <div class="d-flex">
                                    <div class="icon-social">
                                        <img src="{{asset('images/shop/fb.png')}}" alt="">
                                    </div>
                                    <p>Facebook</p>
                                </div>
                                <div class="d-flex">
                                    <div class="icon-social">
                                        <img src="{{asset('images/shop/tw.png')}}" alt="">
                                    </div>
                                    <p>Twitter</p>
                                </div>
                                <div class="d-flex">
                                    <div class="icon-social">
                                        <img src="{{asset('images/shop/ins.png')}}" alt="">
                                    </div>
                                    <p>Linkedin</p>
                                </div>
                                <div class="d-flex">
                                    <div class="icon-social">
                                        <img src="{{asset('images/shop/yt.png')}}" alt="">
                                    </div>
                                    <p>Youtube</p>
                                </div>
                                <div class="d-flex">
                                    <div class="icon-social">
                                        <img src="{{asset('images/shop/in.png')}}" alt="">
                                    </div>
                                    <p>Instagram</p>
                                </div>    
                            </div>
                            <div class="col-md-6 social">
                                <h1 class="mb-1">Địa chỉ</h1>
                                <div class="d-flex">
                                    <div class="icon-social">
                                        <img src="{{asset('images/shop/dc1.png')}}" alt="">
                                    </div>
                                    <p>Trụ sở chính: P.1108, tòa nhà Gold Tower, 275 Nguyễn Trãi, Thanh Xuân, Hà Nội</p>
                                </div>
                                <div class="d-flex">
                                    <div class="icon-social">
                                        <img src="{{asset('images/shop/dc1.png')}}" alt="">
                                    </div>
                                    <p>Chi nhánh: Phòng 6.28, tòa nhà Everich Infinity, 290 An Dương Vương, phường 4, quận 5, Hồ Chí Minh</p>
                                </div>
                                <div class="d-flex">
                                    <div class="icon-social">
                                        <img src="{{asset('images/shop/dc2.png')}}" alt="">
                                    </div>
                                    <p>Email: tdoctorvn@gmail.com</p>
                                </div>
                                <div class="d-flex">
                                    <div class="icon-social">
                                        <img src="{{asset('images/shop/dc3.png')}}" alt="">
                                    </div>
                                    <p>Nơi đăng ký: 7F Huỳnh Tấn Phát, Thị trấn Nhà Bè, Huyện Nhà Bè, Hồ Chí Minh</p>
                                </div>
                                <div class="d-flex">
                                    <div class="icon-social">
                                        <img src="{{asset('images/shop/dc4.png')}}" alt="">
                                    </div>
                                    <p>Hotline: +84n393 157 234</p>
                                </div>  
                                <div class="d-flex">
                                    <div class="icon-social">
                                        <img src="{{asset('images/shop/dc5.png')}}" alt="">
                                    </div>
                                    <p>Skype: netbotvn</p>
                                </div>    
                            </div>
                        </div>
                    </div>   
                </div>
            </div>
        </div>
    </body>
</html>