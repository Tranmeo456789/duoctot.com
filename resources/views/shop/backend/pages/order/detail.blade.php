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
    $statusOrderValue = array_combine(array_keys(config("myconfig.template.column.status_order")),array_column(config("myconfig.template.column.status_order"),'name'));
    unset($statusOrderValue['all']);
    $statusControlOrderValue = array_combine(array_keys(config("myconfig.template.column.status_control")),array_column(config("myconfig.template.column.status_control"),'name'));
    $total=0;
    if (!empty($item['info_product']) && is_array($item['info_product'])) {
        foreach ($item['info_product'] as $product) {
            $quantity = isset($product['quantity']) ? (float)$product['quantity'] : 0;
            $price = isset($product['price']) ? (float)$product['price'] : 0;
            $total += $quantity * $price;
        }
    } 
    $ngayDatHang = MyFunction::formatDateFrontend($item['created_at']);
    $payment = $item['payment']==2 ? 'Thanh toán ngay(ck)' : 'Thanh toán tại nhà';
    $elements = [
        [
            'label'   => HTML::decode(Form::label('code_order', $label['code_order'], $formLabelAttr)),
            'element' => Form::text('code_order', $item['code_order']??null, array_merge($formInputAttr,['placeholder'=>$label['code_order'],'readonly' =>true])),
            'widthElement' => 'col-12 col-lg-4'
        ],[
            'label'   => HTML::decode(Form::label('', $label['status_order'], $formLabelAttr)),
            'element' => Form::select('status_order',$statusOrderValue, $item['status_order']??null, array_merge($formSelect2Attr,['style' =>'width:100%'])),
            'widthElement' => 'col-12 col-lg-4'
        ],[
            'label'   => HTML::decode(Form::label('total', 'Tổng tiền đơn hàng' , $formLabelAttr)),
            'element' => Form::text('total', MyFunction::formatNumber($total??0) . ' đ', array_merge($formInputAttr,['readonly' =>true,'style'=>'text-align:right'])),
            'widthElement' => 'col-12 col-lg-4'
        ],[
            'label'   => HTML::decode(Form::label('total_product', 'Số lượng sản phẩm', $formLabelAttr)),
            'element' => Form::text('total_product', $item['total_product']??null, array_merge($formInputAttr,['readonly' =>true])),
            'widthElement' => 'col-12 col-lg-4'
        ],[
            'label'   => HTML::decode(Form::label('', 'Phí giao hàng', $formLabelAttr)),
            'element' => Form::text('',MyFunction::formatNumber($item['money_ship']??0) . ' đ', array_merge($formInputAttr,['readonly' =>true])),
            'widthElement' => 'col-12 col-lg-4'
        ],[
            'label'   => HTML::decode(Form::label('', 'Hình thức thanh toán', $formLabelAttr)),
            'element' => Form::text('', $payment, array_merge($formInputAttr,['readonly' =>true])),
            'widthElement' => 'col-12 col-lg-4'
        ],[
            'label'   => HTML::decode(Form::label('', $label['status_control'], $formLabelAttr)),
            'element' => Form::select('status_control',$statusControlOrderValue, $item['status_control']??null, array_merge($formSelect2Attr,['style' =>'width:100%'])),
            'widthElement' => 'col-12 col-lg-4'
        ],[
            'label'   => HTML::decode(Form::label('', $label['warehouse_id'], $formLabelAttr)),
            'element' => Form::select('warehouse_id',$itemsWarehouse, null, array_merge($formSelect2Attr,['style' =>'width:100%'])),
            'widthElement' => 'col-12 col-lg-4'
        ],[
            'label'   => HTML::decode(Form::label('', 'Thời gian đặt hàng', $formLabelAttr)),
            'element' => Form::text('created_at', $ngayDatHang, array_merge($formInputAttr,['style' =>'width:100%'])),
            'widthElement' => 'col-12 col-lg-4'
        ]
    ];
    $elementSubmits=[];
    if(Session::has('user') && Session::get('user')['is_admin'] == 1){
        $elementSubmits = [
        [
            'element' => $inputHiddenID  .Form::submit('Cập nhật', ['class'=>'btn btn-primary']),
            'type'    => "btn-submit-center"
        ]
    ];
    }
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
                    @include("$moduleName.blocks.x_title", ['title' => 'Thông tin đơn hàng'])
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
                                {!! FormTemplate::show($elementSubmits,$formInputWidth)  !!}
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
            @if(Session::has('user') && Session::get('user')['is_admin'] == 1)
            <div class="col-12">
                @include("$moduleName.pages.$controllerName.child_detail.info_customer",['item' => $item->userBuy])
            </div>
            @endif
            <div class="col-12">
                @include("$moduleName.pages.$controllerName.child_detail.list_product",['infoProduct' => $item['info_product']])
            </div>
        </div>
    </div>
</section>
@endsection