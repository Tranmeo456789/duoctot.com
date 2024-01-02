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
    $userRef=$item->userRef??'';
    $fullname=$userRef['fullname']??'';
    $phone= $userRef['phone']??'';
    if(isset($item['id'])){
        $elements = [
                    [
                        'label'   => HTML::decode(Form::label('', 'Danh sách sản phẩm cho đại lý'  .  $star, $formLabelAttr)),
                        'element' => '',
                        'widthElement' => 'col-12'
                    ]
                ];
    }else{
        $elements = [
            [
                'label'   => HTML::decode(Form::label('code_ref', 'Mã đại lý' .  $star, $formLabelAttr)),
                'element' => Form::text('code_ref', $item['code_ref']??null, array_merge($formInputAttr,['placeholder'=>'Mã đại lý','readonly'=>true])),
                'widthElement' => 'col-6'
            ],
            [
                'label'   => HTML::decode(Form::label('user_id', 'Chọn User làm affiliate' .  $star , $formLabelAttr)),
                'element' => Form::select('user_id',$itemsUser, null, array_merge($formSelect2Attr,['style' =>'width:100%'])),
                'widthElement' => 'col-6'
            ],
            [
                'label'   => HTML::decode(Form::label('', 'Danh sách sản phẩm cho đại lý'  .  $star, $formLabelAttr)),
                'element' => '',
                'widthElement' => 'col-12'
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
                            <div>
                                @include("$moduleName.pages.$controllerName.child_form.table_products")
                            </div>
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