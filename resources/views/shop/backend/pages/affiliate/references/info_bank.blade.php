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
    
    $star             = config('myconfig.template.star');
    $formInputWidth['widthInput']  =  'col-12';
    $inputHiddenID    = Form::hidden('user_id', $item['user_id']??null);
    $inputHiddenTask    = Form::hidden('task', 'update-item');

    $linkGetListDistrict = route('district.getListByParentID',['parentID' => 'value_new']);
    $linkGetListWard = route('ward.getListByParentID',['parentID' => 'value_new']);

    $elements = [
        [
            'label'   => HTML::decode(Form::label('fullname', 'Họ và tên' .  $star, $formLabelAttr)),
            'element' => Form::text('info_bank[fullname]', $item['fullname']??null, array_merge($formInputAttr,['placeholder'=>'Họ tên'])),
            'widthElement' => 'col-12 col-md-6'
        ],
        [
            'label'   => HTML::decode(Form::label('STK', 'STK ngân hàng' .  $star, $formLabelAttr)),
            'element' => Form::text('info_bank[stk_bank]', $item['stk_bank']??null, array_merge($formInputAttr,['placeholder'=>'Số tài khoản ngân hàng'])),
            'widthElement' => 'col-12 col-md-6'
        ],
        [
            'label'   => HTML::decode(Form::label('name_bank', 'Tên ngân hàng' .  $star, $formLabelAttr)),
            'element' => Form::text('info_bank[name_bank]', $item['name_bank']??null, array_merge($formInputAttr,['placeholder'=>'Nhập tên ngân hàng'])),
            'widthElement' => 'col-12'
        ],
        [
            'element' => $inputHiddenID  . $inputHiddenTask .Form::submit('Cập nhật', ['class'=>'btn btn-primary']),
            'type'    => "btn-submit-center"
        ]
    ];

    $title = 'Cập nhật thông tin ngân hàng';
@endphp
@extends('shop.layouts.backend')
@section('title',$pageTitle)
@section('content')
@include ("$moduleName.blocks.page_header", ['pageIndex' => false,'hidePageIndex'=>true])
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            @include("$moduleName.blocks.x_title", ['title' => 'Cập nhật thông tin ngân hàng'])
            <div class="card-body">
            {{ Form::open([
                'method'         => 'POST',
                'url'            => route("affiliate.saveInfoBank"),
                'accept-charset' => 'UTF-8',
                'class'          => 'form-horizontal form-label-left',
                'id'             => 'main-form' ])  }}
                <div class="row">
                    {!! FormTemplate::show($elements,$formInputWidth)  !!}
                </div>
            {{ Form::close() }}
            </div>
        </div>
    </div>
</section>
@endsection