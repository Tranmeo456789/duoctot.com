@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\MyFunction;
    use App\Model\Shop\ProductModel;

    $label            = config('myconfig.template.label');
    $formLabelAttr    = MyFunction::array_fill_muti_values(array_merge_recursive(
                            config('myconfig.template.form_element.label'),
                            ['class' => 'col-12 ']));
    $formInputAttr    = config('myconfig.template.form_element.input');
    $formNumberAttr    = config('myconfig.template.form_element.input_number');
    $formSelect2Attr  = config('myconfig.template.form_element.select2');
    $star             = config('myconfig.template.star');
    $inputHiddenID    = Form::hidden('id', $item['id']??null);
    $date = isset($item['date']) ? MyFunction::formatDateFrontend($item['date']) : (new DateTime())->format('d/m/Y');
    $linkGetProduct = route('product.getItem',['id' => 'value_new']);
    $formInputWidth['widthInput']  =  'col-12';
    $elements = [
        [
            'label'   => HTML::decode(Form::label('code_ref', 'Mã đại lý' .  $star, $formLabelAttr)),
            'element' => Form::text('code_ref', $item['code_ref']??null, array_merge($formInputAttr,['placeholder'=>'Mã đại lý','readonly'=>true])),
            'widthElement' => 'col-4'
        ],[
            'label'   => HTML::decode(Form::label('name_ref', 'Tên đại lý' .  $star, $formLabelAttr)),
            'element' => Form::text('info_ref[name]', $item['info_ref']['name']??null, array_merge($formInputAttr,['placeholder'=>'Tên đại lý'])),
            'widthElement' => 'col-4'
        ],[
            'label'   => HTML::decode(Form::label('phone_ref', 'Số điện thoại đại lý' .  $star, $formLabelAttr)),
            'element' => Form::text('info_ref[phone]', $item['info_ref']['phone']??null, array_merge($formInputAttr,['placeholder'=>'Số điện thoại đại lý'])),
            'widthElement' => 'col-4'
        ],[
            'label'   => HTML::decode(Form::label('', 'Danh sách sản phẩm chiết khấu %'  .  $star, $formLabelAttr)),
            'element' => '',
            'widthElement' => 'col-12'
        ],[
            'label'   => HTML::decode(Form::label('', 'Tên thuốc', $formLabelAttr)),
            'element' => '',
            'widthElement' => 'col-5 p-0 text-center'
        ],[
            'label'   => HTML::decode(Form::label('', 'Chiết khấu(%)', $formLabelAttr)),
            'element' => '',
            'widthElement' => 'col-2 p-0 text-center'
        ],[
            'label'   => HTML::decode(Form::label('', 'Link affiliate thuốc', $formLabelAttr)),
            'element' => '',
            'widthElement' => 'col-4 p-0 text-center'
        ],[
            'label'   => HTML::decode(Form::label('', '', $formLabelAttr)),
            'element' => '',
            'widthElement' => 'col-1 p-0 text-center'
        ]
    ];

    $elementsDetails = [];
    if (isset($item['info_product']) && (count($item['info_product']) > 0)) {
        foreach($item['info_product'] as $keyProduct => $product) {
            $getSlugProduct = ProductModel::select('slug')->find($product['product_id']);
            $linkAffiliate=route('fe.product.detail', ['slug' => $getSlugProduct['slug'], 'codeRef' => $item['code_ref']]);
            $elementsDetails[] = [
                [
                    'label'   => '',
                    'element' => Form::select('info_product[product_id][]',['null' => '-- Chọn thuốc -- '] + $itemsProduct,$product['product_id'], array_merge($formSelect2Attr,['style' =>'width:100%','data-href' => $linkGetProduct])),
                    'widthElement' => 'col-5'
                 ],[
                    'label'   => '',
                    'element' => Form::text('info_product[discount][]', $product['discount'], array_merge($formNumberAttr,['placeholder'=>'chiết khấu(%)'])),
                    'widthElement' => 'col-2 text-right'
                ],[
                    'label'   => '',
                    'element' => Form::text('info_product[link_affiliate][]', $linkAffiliate, array_merge($formInputAttr,['placeholder'=>'link affiliate','readonly'=>true])),
                    'widthElement' => 'col-4',
                    'type' => 'input-has-copy'
                ],[
                    'label'   => '',
                    'element' => Form::button("<i class='fa fa-plus'></i>",['class'=>'btn btn-sm btn-primary btn-add-row']) . " " . Form::button("<i class='fa fa-times'></i>",['class'=>'btn btn-sm btn-danger btn-delete-row']),
                    'widthElement' => 'col-1 text-right'
                ]
            ];
        }
    }else{
        $elementsDetails[] = [
            [
                'label'   => '',
                'element' => Form::select('info_product[product_id][]',['null' => '-- Chọn thuốc -- '] + $itemsProduct,null, array_merge($formSelect2Attr,['style' =>'width:100%','data-href' => $linkGetProduct])),
                'widthElement' => 'col-5'
            ],[
                'label'   => '',
                'element' => Form::text('info_product[discount][]', 0, array_merge($formNumberAttr,['placeholder'=>'chiết khấu(%)'])),
                'widthElement' => 'col-2 text-right'
            ],[
                'label'   => '',
                'element' => Form::text('info_product[link_affiliate][]', '', array_merge($formInputAttr,['placeholder'=>'link affiliate','readonly'=>true])),
                'widthElement' => 'col-4',
                'type' => 'input-has-copy'
            ],[
                'label'   => '',
                'element' => Form::button("<i class='fa fa-plus'></i>",['class'=>'btn btn-sm btn-primary btn-add-row']) . " " . Form::button("<i class='fa fa-times'></i>",['class'=>'btn btn-sm btn-danger btn-delete-row']),
                'widthElement' => 'col-1 text-right'
            ]
        ];
    }

    
    $elementsBtn  = [
            [
            'element' => $inputHiddenID .Form::submit('Lưu', ['class'=>'btn btn-primary']),
            'type'    => "btn-submit-center"
        ]
    ];
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
                            'id'             => 'main-form' ])  }}
                            <div class="row">
                                {!! FormTemplate::show($elements,$formInputWidth)  !!}
                            </div>
                            @foreach($elementsDetails as $element)
                                <div class="row row-detail">
                                    {!! FormTemplate::show($element,$formInputWidth)  !!}
                                </div>
                            @endforeach
                            <div class="row">
                                {!! FormTemplate::show($elementsBtn,$formInputWidth)  !!}
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection