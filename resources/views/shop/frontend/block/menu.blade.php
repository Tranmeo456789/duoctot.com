<div id="header-wp">
    <div class="head_topon d-flex justify-content-center py-1">
        <div class="d-flex justify-content-center align-middle">
            <span class="circle-ripple"></span>
            <p>Kết nối khám chữa bệnh tại nhà với các bác sĩ online</p>
            <a href="">Xem hướng dẫn</a>
        </div>
    </div>
    <div id="head-top" class="clearfix">
        <div class="wp-inner">
                <a href="{{route('home')}}" title="" id="payment-link" class="fl-left"><img style="width:213px" src="{{asset('images/shop/logo_topbar2.png')}}" alt=""></a>
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
    <div id="head-top-respon" >
        <div class="wp-inner presp">
            <div class="d-flex justify-content-between">
                <div id="btnmenu-resp"><i class="fas fa-bars"></i></div>
                <div class="logotop"><a href="{{route('home')}}"><img style="width:213px" src="{{asset('images/shop/logo_topbar2.png')}}" alt=""></a></div>
                <ul  class="d-flex">
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
        <div class="wp-inner clearfix" id="category-product-wp">
            <div class="fl-left">
                <ul id="main-menu" class="d-flex list-item">
                    <li>
                        <a href="{{route('fe.cat')}}">Thực phẩm chức năng</a>
                        <ul class="sub-menu sub-menu1">
                                <li>
                                    <a href="{{route('fe.cat3')}}" title="">Sức khỏe tim mạch</a>
                                    <ul class="sub-menu">
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
                                        </div>
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{route('fe.cat3')}}" title="">Sinh lý nội tiết tố</a>
                                    <ul class="sub-menu">
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
                                        </div>
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{route('fe.cat3')}}" title="">Hỗ trợ tiêu hóa</a>
                                    <ul class="sub-menu">
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
                                        </div>
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{route('fe.cat3')}}" title="">Hỗ trợ điều trị</a></a>
                                    <ul class="sub-menu">
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
                                        </div>
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{route('fe.cat3')}}" title="">Hỗ trợ làm đẹp</a></a>
                                    <ul class="sub-menu">
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
                                        </div>
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{route('fe.cat3')}}" title="">Dinh dưỡng</a></a>
                                </li>
                                <li>
                                    <a href="{{route('fe.cat3')}}" title="">Cải thiện tăng cường chức năng</a></a>
                                </li>
                            </ul>

                    </li>
                    <li>
                        <a href="{{route('fe.cat')}}">Dược mỹ phẩm</a>
                    </li>
                    <li>
                        <a href="{{route('fe.cat')}}">Chăm sóc cá nhân</a>
                    </li>
                    <li>
                        <a href="">Thuốc</a>
                    </li>
                    <li>
                        <a href="{{route('fe.cat')}}">Thiết bị y tế</a>
                    </li>
                    <li>
                        <a href="{{route('fe.cat')}}">Bệnh</a>
                    </li>
                    <li>
                        <a href="{{route('fe.cat')}}">Góc sức khỏe</a>
                    </li>
                    <li>
                        <a href="{{route('fe.cat')}}">Nhà thuốc</a>
                    </li>
                </ul>
            </div>
            <div class="fl-right d-flex pt-1">
                <img src="{{asset('images/shop/flag.png')}}" alt="" srcset="">
                <p class="pt-2">Tiếng Việt <span><i class="fas fa-angle-down"></i></span></p>
            </div>
        </div>
    </div>
</div>