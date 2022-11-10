<div class="form-login">
    <div class="header d-flex justify-content-between">
        <a class="titlek btn-register">Đăng Ký <span class="text-member">Thành Viên</span></a>
        <a class="titlen btn-login">Đăng Nhập <span class="text-member">Thành Viên</span></a>
        <button class="btn-closenk rimg-center"><img src="{{asset('images/shop/dn4.png')}}" alt=""></button>
    </div>
    <div class="d-flex justify-content-center">
        <div class="wp-content">
            @include("$moduleName.block.child_form_login_register.form_login")
            @include("$moduleName.block.child_form_login_register.form_register")
            <form action="" class="wp-content-forgetpw">
                <div class="content text-center">
                    <div class="qpassword mb-3"><a>Quên mật khẩu</a></div>
                    <div class="phone-mail position-relative clearfix">
                        <input type="text" name="name" id="name" placeholder="Nhập tên *">
                        <div class="img-person"><img src="{{asset('images/shop/dn1.png')}}" alt=""></div>
                    </div>
                    <div class="phone-mail position-relative">
                        <input type="text" placeholder="Nhập số điện thoại / Email">
                        <div class="img-person"><img src="{{asset('images/shop/dk1.png')}}" alt=""></div>
                    </div>
                </div>
                <div class="text-center"><input type="submit" name="btn-forget" value="Gửi" id="btn-forget"></div>
            </form>
        </div>
    </div>
</div>