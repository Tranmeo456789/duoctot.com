@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template as Template;
    use App\Helpers\MyFunction;
    $label            = config('myconfig.template.label');
    $formLabelAttr    = MyFunction::array_fill_muti_values(array_merge_recursive(
                            config('myconfig.template.form_element.label'),
                            ['class' => 'col-12 ']));
    $formInputAttr    = config('myconfig.template.form_element.input');
    $formInputWidth['widthInput']  =  'col-12';
    $inputHiddenID    = Form::hidden('id', $item['id']??null);
    $formSelect2Attr  = config('myconfig.template.form_element.select2');
    $ngayDatHang = MyFunction::formatDateFrontend($item['created_at']);
    $elements = [
       [
            'label'   => HTML::decode(Form::label('', 'Số lượng mặt hàng', $formLabelAttr)),
            'element' => Form::text('', count($item['info_product']??[]), array_merge($formInputAttr,['readonly' =>true])),
            'widthElement' => 'col-4'
        ],[
            'label'   => HTML::decode(Form::label('', 'Thời gian đặt hàng', $formLabelAttr)),
            'element' => Form::text('', $ngayDatHang, array_merge($formInputAttr,['readonly' =>true])),
            'widthElement' => 'col-4'
        ]
    ];
    $buyer=json_decode($item['buyer'], true);

@endphp
@extends('shop.layouts.backend')
@section('title',$pageTitle)
@section('content')
@include ("$moduleName.blocks.page_header", ['pageIndex' => false])
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-info">
                    @include("$moduleName.blocks.x_title", ['title' => 'Thông tin đơn thuốc'])
                    <div class="card-body">
                            <div class="row">
                                {!! FormTemplate::show($elements,$formInputWidth)  !!}
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                @include("$moduleName.pages.$controllerName.child_detail.info_customer",['item' => $buyer])
            </div>
            <div class="col-12">
                @include("$moduleName.pages.$controllerName.child_detail.list_product",['item' => $item['info_product']])
            </div>
            <div class="col-12">
                @include("$moduleName.pages.$controllerName.child_detail.list_img",['item' => $item['info_product']])
            </div>
        </div>
    </div>
</section>
@endsection