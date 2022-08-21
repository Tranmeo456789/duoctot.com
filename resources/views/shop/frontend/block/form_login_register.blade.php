<div class="form-login">
    <div class="header d-flex justify-content-between">
        <a class="titlek btn-register">Đăng Ký Thành Viên</a>
        <a class="titlen btn-login">Đăng Nhập Thành Viên</a>
        <button class="btn-closenk rimg-center"><img src="{{asset('images/shop/dn4.png')}}" alt=""></button>
    </div>
    <div class="d-flex justify-content-center">
        <div class="wp-content">
            <form action="" class="wp-content-login">
                <div class="content text-center">
                    <div class="phone-mail position-relative">
                        <input type="text" placeholder="Nhập số điện thoại / Email">
                        <div class="img-person"><img src="{{asset('images/shop/dn1.png')}}" alt=""></div>
                    </div>
                    <div class="password position-relative">
                        <input type="password" placeholder="Nhập mật khẩu">
                        <div class="imgk rimg-center"><img src="{{asset('images/shop/dn2.png')}}" alt=""></div>
                        <div class="imgm rimg-center"><img src="{{asset('images/shop/dn3.png')}}" alt=""></div>
                    </div>
                    <div class="qpassword"><a>Quên mật khẩu</a></div>
                </div>
                <div class="remember-login d-flex">
                    <input type="checkbox"><label for="">Giữ tôi đăng nhập</label>
                </div>
                <div class="text-center mb-5"><input type="submit" name="btn-login" value="Đăng nhập" id="btn-logint"></div>
                <p class="dkfn text-center btn-register">Để nhận ưu đãi hấp dẫn, <a class="dkfnc">Đăng ký thành viên</a></p>
            </form>
            <form action="" class="wp-content-register">
                <div class="content text-center">
                    <div class="phone-mail position-relative">
                        <input type="text" name="" placeholder="Nhập tên *">
                        <div class="img-person"><img src="{{asset('images/shop/dn1.png')}}" alt=""></div>
                    </div>
                    <div class="phone-mail position-relative">
                        <input type="text" name="" placeholder="Nhập số điện thoại / Email *">
                        <div class="img-person"><img src="{{asset('images/shop/dk1.png')}}" alt=""></div>
                    </div>
                    <div class="password position-relative">
                        <input type="password" placeholder="Nhập mật khẩu">
                        <div class="imgk rimg-center"><img src="{{asset('images/shop/dn2.png')}}" alt=""></div>
                        <div class="imgm rimg-center"><img src="{{asset('images/shop/dn3.png')}}" alt=""></div>
                    </div>
                    <div class="phone-mail position-relative slectdk">
                        <div class="form-group mb-0">
                            <select class="form-control mb-0">
                                <option value="">Tỉnh / Thành Phố</option>
                                <option value="">Thành phố Hà Nội</option>
                                <option value="">Tỉnh Cao Bằng</option>
                            </select>
                        </div>
                        <div class="img-person"><img src="{{asset('images/shop/dk2.png')}}" alt=""></div>
                    </div>
                    <div class="phone-mail position-relative">
                        <input type="text" name="" placeholder="Nhập mã người giới thiệu">
                        <div class="img-person"><img src="{{asset('images/shop/dk3.png')}}" alt=""></div>
                    </div>
                </div>
                <div class="slectnkb form-group">
                    <div class="row m-0">
                        <div class="col-md-6 p-0">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="selectdk" id="sl1" value="">
                                <label class="form-check-label" for="sl1">Nhà thuốc</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="selectdk" id="sl2" value="" checked>
                                <label class="form-check-label" for="sl2">Bệnh nhân</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="selectdk" id="sl3" value="">
                                <label class="form-check-label" for="">Phòng khám</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="selectdk" id="sl4" value="">
                                <label class="form-check-label" for="">Quầy thuốc</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="selectdk" id="sl4" value="">
                                <label class="form-check-label" for="">Bệnh viện</label>
                            </div>
                        </div>
                        <div class="col-md-6 p-0">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="selectdk" id="sl6" value="">
                                <label class="form-check-label" for="">Trung tâm y tế</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="selectdk" id="sl7" value="">
                                <label class="form-check-label" for="">Nha khoa</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="selectdk" id="sl8" value="">
                                <label class="form-check-label" for="">Thẩm mỹ viện</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="selectdk" id="sl9" value="">
                                <label class="form-check-label" for="">Công ty dược phẩm</label>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="dkgp">Để tài khoản được kích hoạt, quý khách hàng vui lòng cung cấp cho T Doctor đầy đủ các giấy phép theo quy định của pháp luật.</p>
                <div class="remember-login d-flex">
                    <input type="checkbox"><label for="">Tôi đã đọc và đồng ý với <a href="" class="text-info">Điều khoản sử dụng*</a></label>
                </div>
                <p class="dkfn text-center btn-login mb-4">Nếu đã có tài khoản, vui lòng <a class="dkfnc ">Đăng nhập</a></p>
                <div class="text-center"><input type="submit" name="btn-login" value="Tạo tài khoản" id="btn-logint"></div>

            </form>
            <form action="" class="wp-content-forgetpw">
                <div class="content text-center">
                    <div class="qpassword mb-3"><a>Quên mật khẩu</a></div>
                    <div class="phone-mail position-relative">
                        <input type="text" placeholder="Nhập số điện thoại / Email">
                        <div class="img-person"><img src="{{asset('images/shop/dn1.png')}}" alt=""></div>
                    </div>
                </div>
                <div class="text-center"><input type="submit" name="btn-forget" value="Gửi" id="btn-logint"></div>
            </form>
        </div>
    </div>
</div>