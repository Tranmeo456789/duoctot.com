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
    $itemsTypeProduct = config('myconfig.template.type_product');
    $randomNumber = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
    $codeProduct = 'SP' . $randomNumber;
    $elements = [
        [
            'label'   => HTML::decode(Form::label('code', 'Mã thuốc' .  $star, $formLabelAttr)),
            'element' => Form::text('code', $item['code']??$codeProduct, array_merge($formInputAttr,['placeholder'=>'Mã thuốc'])),
            'widthElement' => 'col-3'
        ],[
            'label'   => HTML::decode(Form::label('name', 'Tên thuốc' .  $star, $formLabelAttr)),
            'element' => Form::text('name', $item['name']??null, array_merge($formInputAttr,['placeholder'=>'Tên thuốc'])),
            'widthElement' => 'col-9'
        ],[
            'label'   => HTML::decode(Form::label('type', 'Loại thuốc' .  $star , $formLabelAttr)),
            'element' => Form::select('type',$itemsTypeProduct, $item['type']??null, array_merge($formSelect2Attr,['style' =>'width:100%'])),
            'widthElement' => 'col-6'
        ],[
            'label'   => HTML::decode(Form::label('cat_product_id', $label['cat_product_id'] .  $star , $formLabelAttr)),
            'element' => Form::select('cat_product_id',$itemsCatProduct, $item['cat_product_id']??null, array_merge($formSelect2Attr,['style' =>'width:100%'])),
            'widthElement' => 'col-6'
        ],[
            'label'   => HTML::decode(Form::label('producer_id', $label['producer_id'] .  $star , $formLabelAttr)),
            'element' => Form::select('producer_id',$itemsProducer, $item['producer_id']??null, array_merge($formSelect2Attr,['style' =>'width:100%'])),
            'widthElement' => 'col-6'
        ],[
            'label'   => HTML::decode(Form::label('trademark_id', $label['trademark_id'] .  $star , $formLabelAttr)),
            'element' => Form::select('trademark_id',[null=>"-- Chọn thương hiệu --"]+$itemsTrademark, $item['trademark_id']??null, array_merge($formSelect2Attr,['style' =>'width:100%'])),
            'widthElement' => 'col-6'
        ],[
            'label'   => HTML::decode(Form::label('dosage_forms',$label['dosage_forms'] .  $star, $formLabelAttr)),
            'element' => Form::text('dosage_forms', $item['dosage_forms']??null, array_merge($formInputAttr,['placeholder'=>$label['dosage_forms']])),
            'widthElement' => 'col-4'
        ],[
            'label'   => HTML::decode(Form::label('country_id', $label['country_id'] .  $star , $formLabelAttr)),
            'element' => Form::select('country_id',$itemsCountry, $item['country_id']??null, array_merge($formSelect2Attr,['style' =>'width:100%'])),
            'widthElement' => 'col-4'
        ],[
            'label'   => HTML::decode(Form::label('specification',$label['specification'] .  $star, $formLabelAttr)),
            'element' => Form::text('specification', $item['specification']??null, array_merge($formInputAttr,['placeholder'=>$label['specification']])),
            'widthElement' => 'col-4'
        ],[
            'label'   => HTML::decode(Form::label('long',$label['long'], $formLabelAttr)),
            'element' => Form::text('long', $item['long']??null, array_merge($formInputAttr,['placeholder'=>$label['long']])),
            'widthElement' => 'col-3'
        ],[
            'label'   => HTML::decode(Form::label('wide',$label['wide'], $formLabelAttr)),
            'element' => Form::text('wide', $item['wide']??null, array_merge($formInputAttr,['placeholder'=>$label['wide']])),
            'widthElement' => 'col-3'
        ],[
            'label'   => HTML::decode(Form::label('high',$label['high'], $formLabelAttr)),
            'element' => Form::text('high', $item['high']??null, array_merge($formInputAttr,['placeholder'=>$label['high']])),
            'widthElement' => 'col-3'
        ],[
            'label'   => HTML::decode(Form::label('mass',$label['mass'], $formLabelAttr)),
            'element' => Form::text('mass', $item['mass']??null, array_merge($formInputAttr,['placeholder'=>$label['mass']])),
            'widthElement' => 'col-3'
        ]
    ];
    $arrTick = config('myconfig.template.tick');
    foreach($arrTick as $key_tick => $type_tick){
        $elements[] = [
            'label'   => Form::label('', $type_tick, $formLabelAttr),
            'element' => Form::checkbox('tick[]', $key_tick,isset($item['tick']) && in_array($key_tick,$item['tick']) ,array_merge($formInputAttr)),
            'type' =>'inline-text-right',
            'widthElement' => 'col-3',
            'styleFormGroup' => 'mb-1',
        ];
    }

    $itemsTypeVAT = config("myconfig.template.yes_no");
    $itemsTypePrice = config("myconfig.template.type_price");

    $elements = array_merge($elements,
        [
            [
                'label' => '',
                'element' =>'',
                'widthElement' => 'col-12',
            ],[
                'label'   => HTML::decode(Form::label('coefficient',$label['coefficient'], $formLabelAttr)),
                'element' => Form::text('coefficient', $item['coefficient']??null, array_merge($formInputAttr,['placeholder'=>$label['coefficient']])),
                'widthElement' => 'col-3'
            ],[
                'label'   => HTML::decode(Form::label('type_vat', $label['type_vat'], $formLabelAttr)),
                'element' => Form::select('type_vat',$itemsTypeVAT, $item['type_vat']??null, array_merge($formInputAttr,['style' =>'width:100%'])),
                'widthElement' => 'col-3'
            ],[
                'label'   => HTML::decode(Form::label('price',$label['price'] .  $star, $formLabelAttr)),
                'element' => Form::text('price', $item['price']??null, array_merge($formInputAttr,['placeholder'=>$label['price']])),
                'widthElement' => 'col-3'
            ],[
                'label'   => HTML::decode(Form::label('price_vat',$label['price_vat'] .  $star, $formLabelAttr)),
                'element' => Form::text('price_vat', $item['price_vat']??null, array_merge($formInputAttr,['placeholder'=>$label['price_vat']])),
                'widthElement' => 'col-3'
            ],
            [
                'label'   => HTML::decode(Form::label('percent_discount',$label['percent_discount'], $formLabelAttr)),
                'element' => Form::text('percent_discount', $item['percent_discount']??2, array_merge($formInputAttr,['placeholder'=>$label['percent_discount']])),
                'widthElement' => 'col-3'
            ],
            [
                'label'   => HTML::decode(Form::label('expiration_date',$label['expiration_date'], $formLabelAttr)),
                'element' => Form::text('expiration_date', $item['expiration_date']??'Xem trên bao bì sản phẩm', array_merge($formInputAttr,['placeholder'=>$label['expiration_date']])),
                'widthElement' => 'col-3'
            ],[
                'label'   => HTML::decode(Form::label('unit_id', $label['unit_id'] .  $star , $formLabelAttr)),
                'element' => Form::select('unit_id',$itemsUnit, $item['unit_id']??null, array_merge($formSelect2Attr,['style' =>'width:100%'])),
                'widthElement' => 'col-3'
            ],[
                'label'   => HTML::decode(Form::label('amout_max',$label['amout_max'], $formLabelAttr)),
                'element' => Form::text('amout_max', $item['amout_max']??10, array_merge($formInputAttr,['placeholder'=>$label['amout_max']])),
                'widthElement' => 'col-3'
            ],[
                'label'   => HTML::decode(Form::label('inventory_min',$label['inventory_min'], $formLabelAttr)),
                'element' => Form::text('inventory_min', $item['inventory_min']??10, array_merge($formInputAttr,['placeholder'=>$label['inventory_min']])),
                'widthElement' => 'col-3'
            ],[
                'label'   => HTML::decode(Form::label('type_price', $label['type_price'] .  $star , $formLabelAttr)),
                'element' => Form::select('type_price',$itemsTypePrice, $item['type_price']??null, array_merge($formSelect2Attr,['style' =>'width:100%'])),
                'widthElement' => 'col-3'
            ],
            [
                'label'   => HTML::decode(Form::label('discount_tdoctor',$label['discount_tdoctor'], $formLabelAttr)),
                'element' => Form::text('discount_tdoctor', $item['discount_tdoctor']??30, array_merge($formInputAttr,['placeholder'=>$label['discount_tdoctor']])),
                'widthElement' => 'col-3'
            ],
            [
                'label'   => HTML::decode(Form::label('discount_ref',$label['discount_ref'], $formLabelAttr)),
                'element' => Form::text('discount_ref', $item['discount_ref']??33, array_merge($formInputAttr,['placeholder'=>$label['discount_ref']])),
                'widthElement' => 'col-3'
            ],
            [
                'label'   => HTML::decode(Form::label('sell_area', $label['sell_area'], $formLabelAttr)),
                'element' => Form::select('sell_area',$itemsProvince, $item['sell_area']??null, array_merge($formSelect2Attr,['data-placeholder'=>"Mặc định(Cả nước)",'style' =>'width:100%','multiple' => 'multiple'])),
                'widthElement' => 'col-6'
            ],
            [
                'label'   => HTML::decode(Form::label('contact','SĐT liên hệ', $formLabelAttr)),
                'element' => Form::text('contact', $item['contact']??'0349444164', array_merge($formInputAttr,['placeholder'=>'SĐT liên hệ'])),
                'widthElement' => 'col-6'
            ],
            [
                'label' => HTML::decode(Form::label('', 'Chọn đặc tính sản phẩm' , $formLabelAttr)),
                'element' =>'',
                'widthElement' => 'col-12',
            ]
        ]
    );
    $arrFeaturer = config('myconfig.template.type_featurer');
    foreach($arrFeaturer as $key_featurer => $type_featurer){
        $elements[] = [
            'label'   => Form::label('', $type_featurer, $formLabelAttr),
            'element' => Form::checkbox('featurer[]', $key_featurer,isset($item['featurer']) && in_array($key_featurer,$item['featurer']??'') ,array_merge($formInputAttr)),
            'type' =>'inline-text-right',
            'widthElement' => 'col-3',
            'styleFormGroup' => 'mb-1',
        ];
    }
    $elements = array_merge($elements,
        [
            [
                'label'   => Form::label('','Ảnh đại diện', ['class' => 'col-1 col-form-label']),
                'element' => Form::label('','Chọn ảnh', ['class' => 'btn btn-primary label-select-image']),
                'widthInput' => '',
            ],
            [
                'label'   => '',
                'element' => Template::showImageAndInputSingle('image', $item['image']?? null),
                'widthInput' => 'col-11',
            ],[
                'label'   => Form::label('albumImage', 'Album ảnh', ['class' => 'col-1 col-form-label']),
                'element' => Form::file('albumImage[]', array_merge($formInputAttr,['multiple'=>'multiple','accept'=>'image/*'])),
                'fileAttach'   => (!empty($item['id'])) ? Template::showImageAttachPreview($controllerName, $item['albumImage'],$item['albumImageHash'], $item['id'],['btn' => 'delete']) : null ,
                'type'    => "fileAttachPreview",
                'widthInput' => 'col-11' . (Session::get('user')['user_id'] == 864108238 ? '' : ' d-none'),
            ],[
                'label'   => HTML::decode(Form::label('general_info', $label['general_info'] .  $star, $formLabelAttr)),
                'element' => Form::textarea('general_info', $item['general_info']?? null, array_merge($formEditorAttr,['placeholder'=>$label['general_info'],'id'=>'general_info']))
            ],[
                'label'   =>  HTML::decode(Form::label('benefit', $label['benefit'] .  $star, $formLabelAttr)),
                'element' => Form::textarea('benefit', $item['benefit']?? null, array_merge($formInputAttr,['placeholder'=>$label['benefit'],"rows"=>"5"]))
            ],
            [
                'label'   => Form::label('elements', $label['elements'], $formLabelAttr),
                'element' => Form::textarea('elements', $item['elements']?? null, array_merge($formInputAttr,['placeholder'=>$label['elements'],"rows"=>"5"]))
            ],
            [
                'label'   => Form::label('prescribe', $label['prescribe'], $formLabelAttr),
                'element' => Form::textarea('prescribe', $item['prescribe']?? null, array_merge($formInputAttr,['placeholder'=>$label['prescribe'],"rows"=>"5"]))
            ],[
                'label'   => Form::label('dosage', $label['dosage'], $formLabelAttr),
                'element' => Form::textarea('dosage', $item['dosage']?? null, array_merge($formInputAttr,['placeholder'=>$label['dosage'],"rows"=>"5"]))
            ],[
                'label'   => Form::label('note', $label['note'], $formLabelAttr),
                'element' => Form::textarea('note', $item['note']?? 'Đọc kĩ hướng dẫn sử dụng trước khi dùng.', array_merge($formInputAttr,['placeholder'=>$label['note'],"rows"=>"5"]))
            ],[
                'label'   => Form::label('preserve', $label['preserve'], $formLabelAttr),
                'element' => Form::textarea('preserve', $item['preserve']?? 'Bảo quản nơi khô mát, tránh ánh sáng trực tiếp và nhiệt độ cao.', array_merge($formInputAttr,['placeholder'=>$label['preserve'],"rows"=>"5"]))
            ],[
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
@if ((Session::has('user') && Session::get('user')['is_admin'] == 1))
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <h1>{{ $pageTitle }}</h1>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <a href='{{route("admin.product.list")}}' class="btn btn-primary float-right">Quay về</a>                   
                </div>
            </div>
        </div>
    </div>
@else
  @include ("$moduleName.blocks.page_header", ['pageIndex' => false])
@endif
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
                            'id'             => 'main-form' ])  }}
                            <div class="row">
                                {!! FormTemplate::show($elements,$formInputWidth)  !!}
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
        @include ("$moduleName.pages.product.child_form.modal_img")
    </div>
</section>
@endsection