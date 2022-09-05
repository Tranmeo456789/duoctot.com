<div class="form-login">
    <div class="header d-flex justify-content-between">
        <a class="titlek btn-register">Đăng Ký Thành Viên</a>
        <a class="titlen btn-login">Đăng Nhập Thành Viên</a>
        <button class="btn-closenk rimg-center"><img src="{{asset('images/shop/dn4.png')}}" alt=""></button>
    </div>
    <div class="d-flex justify-content-center">
        <div class="wp-content">
            <form action="{{route('user.login')}}" class="wp-content-login" id="user_login" method="POST">
            {!! csrf_field() !!}
                <div class="content text-center">
                    <div class="phone-mail position-relative">
                        <input id="inputphel" type="text" name="email" placeholder="Nhập số điện thoại / Email">
                        <div class="img-person"><img src="{{asset('images/shop/dn1.png')}}" alt=""></div>
                    </div>
                    <div class="password position-relative">
                        <input id="password" type="password" name="password" placeholder="Nhập mật khẩu">
                        <div class="imgk rimg-center"><img src="{{asset('images/shop/dn2.png')}}" alt=""></div>
                        <div class="imgm rimg-center"><img src="{{asset('images/shop/dn3.png')}}" alt=""></div>
                    </div>
                    <div class="qpassword"><a>Quên mật khẩu</a></div>
                </div>
                <div class="remember-login d-flex">
                    <input type="checkbox"><label for="">Giữ tôi đăng nhập</label>
                </div>
                <!-- <div id="user_login" class="text-center mb-5"><input type="" name="btn-login" value="Đăng nhập" id="btn-logint"></div> -->
                <div id="user_login" class="text-center mb-5"><button type="submit" name="btn-login" value="1" id="btn-logint">Đăng nhập</button></div>
                <p class="dkfn text-center btn-register">Để nhận ưu đãi hấp dẫn, <a class="dkfnc">Đăng ký thành viên</a></p>
            </form>
            <form action="{{route('user.register')}}" class="wp-content-register" id="user_register" method="POST">
                {!! csrf_field() !!}
                <div class="content text-center">
                    <div class="phone-mail position-relative clearfix">
                        <input type="text" name="name" id="name" placeholder="Nhập tên *">
                        <div class="img-person"><img src="{{asset('images/shop/dn1.png')}}" alt=""></div>
                    </div>
                    <!-- @if ($errors->has('name'))
                    <small class="text-danger">{{$errors->first('name')}}</small>
                    @endif -->
                    <div class="phone-mail position-relative">
                        <input id="inputphel1" type="text" name="email" placeholder="Nhập số điện thoại / Email *">
                        <div class="img-person"><img src="{{asset('images/shop/dk1.png')}}" alt=""></div>
                        <input type="hidden" id="isnumber" name="isnumber" value="0">
                    </div>
                    <div class="password position-relative">
                        <input type="password" name="password" placeholder="Nhập mật khẩu">
                        <div class="imgk rimg-center"><img src="{{asset('images/shop/dn2.png')}}" alt=""></div>
                        <div class="imgm rimg-center"><img src="{{asset('images/shop/dn3.png')}}" alt=""></div>
                    </div>
                    <div class="phone-mail position-relative slectdk">
                        <div class="form-group mb-0">
                            <select class="form-control mb-0" name="local">
                                <option value="Thành phố Hà Nội">Thành phố Hà Nội</option>
                                <option value="Thành phố Hà Nội">Thành phố Hà Nội</option>
                                <option value="Tỉnh Cao Bằng">Tỉnh Cao Bằng</option>
                            </select>
                        </div>
                        <div class="img-person"><img src="{{asset('images/shop/dk2.png')}}" alt=""></div>
                    </div>
                    <div class="phone-mail position-relative">
                        <input type="text" name="code" placeholder="Nhập mã người giới thiệu">
                        <div class="img-person"><img src="{{asset('images/shop/dk3.png')}}" alt=""></div>
                    </div>
                </div>
                <div class="slectnkb form-group">
                    <div class="row m-0">
                        <div class="col-md-6 p-0">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="selectdk" id="sl1" value="Nhà thuốc">
                                <label class="form-check-label" for="sl1">Nhà thuốc</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="selectdk" id="sl2" value="Bệnh nhân" checked>
                                <label class="form-check-label" for="sl2">Bệnh nhân</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="selectdk" id="sl3" value="Phòng khám">
                                <label class="form-check-label" for="">Phòng khám</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="selectdk" id="sl4" value="Phòng khám">
                                <label class="form-check-label" for="">Phòng khám</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="selectdk" id="sl5" value="Bệnh viện">
                                <label class="form-check-label" for="">Bệnh viện</label>
                            </div>
                        </div>
                        <div class="col-md-6 p-0">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="selectdk" id="sl6" value="Trung tâm y tế">
                                <label class="form-check-label" for="">Trung tâm y tế</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="selectdk" id="sl7" value="Nha khoa">
                                <label class="form-check-label" for="">Nha khoa</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="selectdk" id="sl8" value="Thẩm mỹ viện">
                                <label class="form-check-label" for="">Thẩm mỹ viện</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="selectdk" id="sl9" value="Công ty dược phẩm">
                                <label class="form-check-label" for="">Công ty dược phẩm</label>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="dkgp">Để tài khoản được kích hoạt, quý khách hàng vui lòng cung cấp cho T Doctor đầy đủ các giấy phép theo quy định của pháp luật.</p>
                <div class="remember-login d-flex">
                    <input id="check-rules" type="checkbox"><label for="">Tôi đã đọc và đồng ý với <a href="" class="text-info">Điều khoản sử dụng*</a></label>
                </div>
                <p class="dkfn text-center btn-login mb-4">Nếu đã có tài khoản, vui lòng <a class="dkfnc ">Đăng nhập</a></p>
                <div class="text-center" id="dang-ky"><input type="submit" name="btn-register" value="Tạo tài khoản" id="btn-register" disabled></div>
            </form>
            <form action="" class="wp-content-forgetpw">
                <div class="content text-center">
                    <div class="qpassword mb-3"><a>Quên mật khẩu</a></div>
                    <div class="phone-mail position-relative">
                        <input type="text" placeholder="Nhập số điện thoại / Email">
                        <div class="img-person"><img src="{{asset('images/shop/dn1.png')}}" alt=""></div>
                    </div>
                </div>
                <div class="text-center"><input type="submit" name="btn-forget" value="Gửi" id="btn-forget"></div>
            </form>
        </div>
    </div>
</div>