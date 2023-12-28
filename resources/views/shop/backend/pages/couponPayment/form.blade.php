@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\MyFunction;

    $label            = config('myconfig.template.label');
    $formLabelAttr    = MyFunction::array_fill_muti_values(array_merge_recursive(
                            config('myconfig.template.form_element.label'),
                            ['class' => 'col-12 ']));
    $formInputAttr    = config('myconfig.template.form_element.input');
    $star             = config('myconfig.template.star');
    $formInputWidth['widthInput']  =  'col-12';
    $formDateMaskAttr = config('myconfig.template.form_element.input_datemask');
    $date = isset($item['date']) ? MyFunction::formatDateFrontend($item['date']) : (new DateTime())->format('d/m/Y');

    $inputHiddenID    = Form::hidden('id', $item['id']??null);
    $elements = [
        [
            'label'   => HTML::decode(Form::label('money', 'Số tiền thanh toán(vnđ)' .  $star, $formLabelAttr)),
            'element' => Form::text('money', $item['money']??0, array_merge($formInputAttr,['placeholder'=>'Số tiền'])),
            'widthElement' => 'col-6'
        ],
        [
            'label'   => HTML::decode(Form::label('date', 'Thời gian chuyển', $formLabelAttr)),
            'element' => Form::text('date', $date, array_merge($formDateMaskAttr,['placeholder'=>'Thời gian chuyển'])),
            'widthElement' => 'col-6'
        ],
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
                        <h5 class="mb-3">Phiếu thanh toán cho <span class="text-info font-weight-bold">{{$fullname??''}}</span></h5>
                        <h5 class="font-weight-bold">*Thông tin chuyển khoản:</h5>
                        <div class="col-6">
                            <h5><span class="font-weight-bold">Họ và tên: </span>{{$infoBank['fullname']??''}}</h5>
                        </div>
                        <div class="col-6">
                            <h5> <span class="font-weight-bold">STK: </span>{{$infoBank['stk_bank']??''}}</h5>
                        </div>
                        <div class="col-6">
                            <h5> <span class="font-weight-bold">Ngân hàng: </span>{{$infoBank['name_bank']??''}}</h5>
                        </div>
                        {{ Form::open([
                            'method'         => 'POST',
                            'url'            => route("$controllerName.save"),
                            'accept-charset' => 'UTF-8',
                            'class'          => 'form-horizontal form-label-left',
                            'id'             => 'main-form' ])  }}
                            <div class="container">
                                <div class="row">
                                    {!! FormTemplate::show($elements,$formInputWidth)  !!}
                                </div>
                            </div>
                            <input type="hidden" name="code_ref" value="{{$codeRef}}" class="border-0"/>
                            <input type="hidden" name="user_id" value="{{$userId}}" class="border-0"/>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection