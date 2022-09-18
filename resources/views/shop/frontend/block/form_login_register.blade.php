<div class="form-login">
    <div class="header d-flex justify-content-between">
        <a class="titlek btn-register">Đăng Ký Thành Viên</a>
        <a class="titlen btn-login">Đăng Nhập Thành Viên</a>
        <button class="btn-closenk rimg-center"><img src="{{asset('images/shop/dn4.png')}}" alt=""></button>
    </div>
    <div class="d-flex justify-content-center">
        <div class="wp-content">
            {{ Form::open([
                'method'         => 'POST',
                'url'            => route('user.login'),
                'accept-charset' => 'UTF-8',
                'class'          => 'wp-content-login',
                'id'             => 'user_login' ])  }}
                <div class="content text-center">
                    <div class="phone-mail position-relative">
                        <input id="email" type="text" name="email" placeholder="Nhập số điện thoại / Email">
                        <div class="img-person"><img src="{{asset('images/shop/dk1.png')}}" alt=""></div>
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
                <div id="user_login" class="text-center mb-5"><button type="submit" name="btn-login" value="1" id="btn-logint">Đăng nhập</button></div>
                <p class="dkfn text-center btn-register">Để nhận ưu đãi hấp dẫn, <a class="dkfnc">Đăng ký thành viên</a></p>
            {{ Form::close() }}
            @include("$moduleName.block.form_register")
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