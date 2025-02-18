@php
    use App\Helpers\Form as FormTemplate;
    $label            = config('myconfig.template.label');
    $formLabelAttr    = config('myconfig.template.form_element.label');
    $formInputAttr    = config('myconfig.template.form_element.input');
    $formInputWidth['widthInput']  =  'col-12 p-0';

    $inputHiddenTask    = Form::hidden('task', 'login');
    $elements = [
        [
            'label'   => '',
            'element' => Form::text('email', null, array_merge($formInputAttr,['placeholder'=>'Nhập Số điện thoại / Email *','id'=>'email'])),
            'type' => 'input-group-addon-image-before',
            'image' => asset('images/shop/ic_phone.png'),
            'widthElement' => 'col-12 p-0',
            'styleFormGroup' => 'has-border',
        ],[
            'label'   => '',
            'element' => Form::password('password', array_merge($formInputAttr,['placeholder'=>'Nhập Mật khẩu *'])),
            'type' => 'password-with-image-before',
            'image' => asset('images/shop/ic_password.png'),
            'widthElement' => 'col-12 p-0',
            'styleFormGroup' => 'has-border',
        ]
    ];
@endphp
{{ Form::open([
    'method'         => 'POST',
    'url'            => route('user.login'),
    'accept-charset' => 'UTF-8',
    'class'          => 'wp-content-login form-input-group form-in-modal user-login',
    'id'             => 'main-form' ])  }}
    <div class="content text-center">
        <div class="row">
            {!! FormTemplate::show($elements,$formInputWidth)  !!}
            <!-- <div class="qpassword col-12"><a>Quên mật khẩu</a></div> -->
            <div class="col-12">Quên mật khẩu liên hệ 0393.167.234 !</div>
            <div class="remember-login d-flex">
                <input type="checkbox"><label for="">Giữ tôi đăng nhập</label>
            </div>
            <div id="user_login" class="text-center col-12">
                {{$inputHiddenTask }}
                <button type="submit" name="btn-login" value="1" id="btn-logint" class="btn btn-info">Đăng nhập</button>
            </div>
            <p class="dkfn text-center btn-register">Để nhận ưu đãi hấp dẫn, <a class="dkfnc">Đăng ký thành viên</a></p>
        </div>
    </div>
{{ Form::close() }}

