@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template as Template;
    use App\Helpers\MyFunction;
    $label            = config('myconfig.template.label');
    $formLabelAttr    = MyFunction::array_fill_muti_values(array_merge_recursive(
                            config('myconfig.template.form_element.label'),
                            ['class' => 'col-12 ']));

    $formInputAttr    = config('myconfig.template.form_element.input');
    $formEditorAttr = config('myconfig.template.form_element.editor');
    $star             = config('myconfig.template.star');
    $formInputWidth['widthInput']  =  'col-12';
    $inputHiddenID    = Form::hidden('user_id', $item['user_id']??null);
    $inputFileDel     = isset($item['id'])?Form::hidden('file-del'):'';
    $formSelect2Attr  = config('myconfig.template.form_element.select2');
    $formSelect2GetChildAttr  = array_merge_recursive(
                                config('myconfig.template.form_element.select2'),
                                config('myconfig.template.form_element.get_child')
                            );
    $formSelect2GetChildAttr = MyFunction::array_fill_muti_values($formSelect2GetChildAttr);
    

    $linkGetListDistrict = route('district.getListByParentID',['parentID' => 'value_new']);
    $linkGetListWard = route('ward.getListByParentID',['parentID' => 'value_new']);
    $elements = [
        [
            'label'   => HTML::decode(Form::label('fullname', 'Họ và tên Editor' .  $star, $formLabelAttr)),
            'element' => Form::text('fullname', $item['fullname']??null, array_merge($formInputAttr,['placeholder'=>'Họ và tên'])),
            'widthElement' => 'col-12'
        ],[
            'label'   => HTML::decode(Form::label('email', 'Username' .  $star, $formLabelAttr)),
            'element' => Form::text('email', $item['email']??null, array_merge($formInputAttr,['placeholder'=>'Username'])),
            'widthElement' => 'col-12'
        ],
        [
            'label'   => HTML::decode(Form::label('password', 'Password' .  $star, $formLabelAttr)),
            'element' => Form::password('password', array_merge($formInputAttr,['placeholder'=>'Nhập Mật khẩu','style'=>'border-right:0px'])),
            'type' => 'input-password',
            'widthElement' => 'col-12'
        ]
        
    ];
    
    $elements = array_merge($elements,
        [
            [
                'element' => $inputHiddenID . $inputFileDel .Form::submit('Lưu', ['class'=>'btn btn-primary']),
                'type'    => "btn-submit-center"
            ]
        ]
    );
   
    $title = (!isset($item['user_id']) || $item['user_id'] == '')  ?'Thêm mới':'Sửa thông tin';
@endphp
@extends('shop.layouts.backend')
@section('title',$pageTitle)
@section('content')
@include ("$moduleName.blocks.page_header", ['pageIndex' => false])
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card card-primary">
                    @include("$moduleName.blocks.x_title", ['title' => $title])
                    <div class="card-body">
                        {{ Form::open([
                            'method'         => 'POST',
                            'url'            => route("editor.save"),
                            'accept-charset' => 'UTF-8',
                            'class'          => 'form-horizontal form-label-left',
                            'enctype'        => 'multipart/form-data',
                            'id'             => 'main-form' ])  }}
                            <div class="row">
                                {!! FormTemplate::show($elements,$formInputWidth)  !!}
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection