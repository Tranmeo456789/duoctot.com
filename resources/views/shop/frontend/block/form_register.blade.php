@php
    use App\Helpers\Form as FormTemplate;
    $label            = config('myconfig.template.label');
    $formLabelAttr    = config('myconfig.template.form_element.label');
    $formInputAttr    = config('myconfig.template.form_element.input');
    $formSelect2Attr  = config('myconfig.template.form_element.select2');
    $formInputWidth['widthInput']  =  'col-12 p-0';

    $elements = [
        [
            'label'   => '',
            'element' => Form::text('fullname', null, array_merge($formInputAttr,['placeholder'=>'Nhập Họ tên *'])),
            'type' => 'input-group-addon-image-before',
            'image' => asset('images/shop/ic_name.png'),
            'widthElement' => 'col-12 p-0',
            'styleFormGroup' => 'has-border',
        ],[
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
        ],[
            'label'   => '',
            'element' => Form::select('province_id',$itemsProvince, null, array_merge($formSelect2Attr,['style' =>'width:90%'])),
            'type' => 'input-group-addon-image-before',
            'image' => asset('images/shop/ic_address.png'),
            'widthElement' => 'col-12 p-0',
            'styleFormGroup' => 'has-border',
        ],[
            'label'   => '',
            'element' => Form::text('refer_id', null, array_merge($formInputAttr,['placeholder'=>'Nhập Mã code (không bắt buộc)'])),
            'type' => 'input-group-addon-image-before',
            'image' => asset('images/shop/ic_code.png'),
            'widthElement' => 'col-12 p-0',
            'styleFormGroup' => 'has-border',
        ],
    ];
    $arrTypeUser = config('myconfig.template.type_user');
    foreach($arrTypeUser as $key_user => $type_user){
        $elements[] = [
            'label'   => Form::label('name', $type_user, $formLabelAttr),
            'element' => Form::radio('user_type_id', $key_user,false ,array_merge($formInputAttr)),
            'type' =>'inline-text-right',
            'widthElement' => 'col-6 p-0',
            'styleFormGroup' => 'mb-2 h-35',
        ];
    }

@endphp
{{ Form::open([
    'method'         => 'POST',
    'url'            => route('user.register'),
    'accept-charset' => 'UTF-8',
    'class'          => 'wp-content-register',
    'id'             => 'user_register' ])  }}
    <div class="content text-center">
        <div class="row">
            {!! FormTemplate::show($elements,$formInputWidth)  !!}

            <p class="dkgp py-2">Để tài khoản được kích hoạt, quý khách hàng vui lòng cung cấp cho TDoctor đầy đủ các giấy phép theo quy định của pháp luật.</p>

            <div class="remember-login d-flex">
                <input id="check-rules" type="checkbox"><label for="">Tôi đã đọc và đồng ý với <a href="" class="text-info">Điều khoản sử dụng*</a></label>
            </div>
            <p class="dkfn text-center btn-login mb-2">Nếu đã có tài khoản, vui lòng <a class="dkfnc ">Đăng nhập</a></p>
            <div class="col-12 text-center" id="dang-ky">
                <input type="submit" name="btn-register" value="Tạo tài khoản" id="btn-register" disabled>
            </div>
        </div>
    </div>
{{ Form::close() }}

