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
    $inputHiddenID    = Form::hidden('id', $item['id']??null);
    $inputFileDel     = isset($item['id'])?Form::hidden('file-del'):'';
    $formSelect2Attr  = config('myconfig.template.form_element.select2');
    $formSelect2GetChildAttr  = array_merge_recursive(
                                config('myconfig.template.form_element.select2'),
                                config('myconfig.template.form_element.get_child')
                            );
    $formSelect2GetChildAttr = MyFunction::array_fill_muti_values($formSelect2GetChildAttr);
    

    $linkGetListDistrict = route('district.getListByParentID',['parentID' => 'value_new']);
    $linkGetListWard = route('ward.getListByParentID',['parentID' => 'value_new']);
    $itemsTypeUser = [
                '1' => 'Bệnh nhân',
                '2' => 'Phòng khám',
                '3' => 'Bác sĩ',
                '4' => 'Nhà thuốc'
            ];
    $elements = [
        [
            'label'   => HTML::decode(Form::label('fullname', 'Họ và tên người dùng' .  $star, $formLabelAttr)),
            'element' => Form::text('fullname', $item['fullname']??null, array_merge($formInputAttr,['placeholder'=>'Họ và tên người dùng'])),
            'widthElement' => 'col-12'
        ],[
            'label'   => HTML::decode(Form::label('phone', 'Số điện thoại' .  $star, $formLabelAttr)),
            'element' => Form::text('phone', $item['phone']??null, array_merge($formInputAttr,['placeholder'=>'Số điện thoại'])),
            'widthElement' => 'col-6'
        ],[
            'label'   => HTML::decode(Form::label('email', 'Email' .  $star, $formLabelAttr)),
            'element' => Form::text('email', $item['email']??null, array_merge($formInputAttr,['placeholder'=>'Email'])),
            'widthElement' => 'col-6'
        ],
        [
            'label'   => HTML::decode(Form::label('user_type_id', $label['user_type_id'] .  $star , $formLabelAttr)),
            'element' => Form::select('user_type_id',$itemsTypeUser, $item['user_type_id']??null, array_merge($formSelect2Attr,['style' =>'width:100%'])),
            'widthElement' => 'col-6'
        ],
        [
            'label'   => HTML::decode(Form::label('details[province_id]', $label['province_id'] , $formLabelAttr)),
            'element' => Form::select('details[province_id]',$itemsProvince, $details['province_id']??($item['province_id']??null), array_merge($formSelect2GetChildAttr,['id' =>'details[province_id]','style' =>'width:100%','data-href'=>$linkGetListDistrict,'data-target' => '#district_id'])),
            'widthElement' => 'col-4'
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
   
    $title = (!isset($item['id']) || $item['id'] == '')  ?'Thêm mới':'Sửa thông tin';
@endphp
@extends('shop.layouts.backend')
@section('title',$pageTitle)
@section('content')
@include ("$moduleName.blocks.page_header", ['pageIndex' => false])
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    @include("$moduleName.blocks.x_title", ['title' => $title])
                    <div class="card-body">
                        {{ Form::open([
                            'method'         => 'POST',
                            'url'            => route("$controllerName.save"),
                            'accept-charset' => 'UTF-8',
                            'class'          => 'form-horizontal form-label-left',
                            'enctype'        => 'multipart/form-data',
                            'id'             => 'main-form1' ])  }}
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