<div class="form-login">
    <div class="header d-flex justify-content-between">
        <a class="titlek btn-register">Đăng Ký <span class="text-member">Thành Viên</span></a>
        <a class="titlen btn-login">Đăng Nhập <span class="text-member">Thành Viên</span></a>
        <button class="btn-closenk rimg-center"><img src="{{asset('images/shop/dn4.png')}}" alt=""></button>
    </div>
    <div class="d-flex justify-content-center">
        <div class="wp-content position-relative">
            @include("$moduleName.block.child_form_login_register.form_login")
            @include("$moduleName.block.child_form_login_register.form_register")
            <div class="rotate-effect">
                <svg id="svg-spinner" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 48 48">
                    <circle cx="24" cy="4" r="4" fill="#00688B"/>
                    <circle cx="12.19" cy="7.86" r="3.7" fill="#00688B"/>
                    <circle cx="5.02" cy="17.68" r="3.4" fill="#00688B"/>
                    <circle cx="5.02" cy="30.32" r="3.2" fill="#00688B"/>
                    <circle cx="12.19" cy="40.14" r="3.0" fill="#00688B"/>
                    <circle cx="24" cy="44" r="2.7" fill="#00688B"/>
                    <circle cx="35.81" cy="40.14" r="2.3" fill="#00688B"/>
                    <circle cx="42.98" cy="30.32" r="2.0" fill="#00688B"/>
                    <circle cx="42.98" cy="17.68" r="1.8" fill="#00688B"/>
                    <circle cx="35.81" cy="7.86" r="1.5" fill="#00688B"/>
                </svg>
            </div>
            <div class="overlay"></div>
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