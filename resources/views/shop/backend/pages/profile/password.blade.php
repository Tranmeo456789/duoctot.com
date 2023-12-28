@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\MyFunction;
    $label            = config('myconfig.template.label');
    $formLabelAttr    = array_merge_recursive(
                            config('myconfig.template.form_element.label'),
                            ['class' => 'col-12']
                        );
    $formLabelAttr = MyFunction::array_fill_muti_values($formLabelAttr);

    $formInputAttr    = config('myconfig.template.form_element.input');
    $formSelect2Attr  = config('myconfig.template.form_element.select2');
    $formSelect2GetChildAttr  = array_merge_recursive(
                                config('myconfig.template.form_element.select2'),
                                config('myconfig.template.form_element.get_child')
                            );
    $formSelect2GetChildAttr = MyFunction::array_fill_muti_values($formSelect2GetChildAttr);
    $star             = config('myconfig.template.star');
    $formInputWidth['widthInput']  =  'col-12';
    $inputHiddenID    = Form::hidden('user_id', Session::get('user')['user_id']??null);
    $inputHiddenTask    = Form::hidden('task', 'change-password');
    $elements = [
        [
            'label'   => HTML::decode(Form::label('password_old', 'Mật khẩu cũ' .  $star, $formLabelAttr)),
            'element' => Form::password('password_old', array_merge($formInputAttr,['placeholder'=>'Nhập Mật khẩu cũ','style'=>'border-right:0px'])),
            'type' => 'input-password',
            'widthElement' => 'col-12 p-0'
        ],[
            'label'   => HTML::decode(Form::label('password', 'Mật khẩu mới' .  $star, $formLabelAttr)),
            'element' => Form::password('password', array_merge($formInputAttr,['placeholder'=>'Nhập Mật khẩu mới','style'=>'border-right:0px'])),
            'type' => 'input-password',
            'widthElement' => 'col-12 p-0'
        ],[
            'label'   => HTML::decode(Form::label('password_confirmation', 'Nhập lại Mật khẩu mới' .  $star, $formLabelAttr)),
            'element' => Form::password('password_confirmation', array_merge($formInputAttr,['placeholder'=>'Nhập lại Mật khẩu mới','style'=>'border-right:0px'])),
            'type' => 'input-password',
            'widthElement' => 'col-12 p-0'
        ],[
            'element' => $inputHiddenID .  $inputHiddenTask .Form::submit('Cập nhật', ['class'=>'btn btn-primary']),
            'type'    => "btn-submit-center"
        ]
    ];

    $title = 'Cập nhật thông tin';
@endphp
@extends('shop.layouts.backend')
@section('title',$pageTitle)
@section('content')
@include ("$moduleName.blocks.page_header", ['pageIndex' => false,'hidePageIndex'=>true])
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="card card-primary">
                    @include("$moduleName.blocks.x_title", ['title' => 'Thay đổi mật khẩu'])
                    <div class="card-body">
                        {{ Form::open([
                            'method'         => 'POST',
                            'url'            => route("$controllerName.saveChangePassword"),
                            'accept-charset' => 'UTF-8',
                            'class'          => 'form-horizontal form-label-left',
                            'id'             => 'main-form' ])  }}
                            <div class="row">
                                {!! FormTemplate::show($elements,$formInputWidth)  !!}
                                <div>
                                    <p><span class="text-danger">Lưu ý:</span> Mật khẩu cần thỏa mãn các điều kiện sau</p>
                                    <p>- Có độ dài ít nhất 6 ký tự</p>
                                    <p>- Không được trùng với mật khẩu cũ</p>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection