@php
use App\Helpers\Template;
use App\Helpers\MyFunction;
use App\Helpers\Form as FormTemplate;
$formLabelAttr = MyFunction::array_fill_muti_values(array_merge_recursive(
config('myconfig.template.form_element.label'),
['class' => 'col-12 ']));
$date = isset($item['date'])?MyFunction::formatDateFrontend($item['date']):'';
$formDateMaskAttr = config('myconfig.template.form_element.input_datemask');
$formInputWidth['widthInput'] = 'col-12';
$elements =[
[
'label' => '',
'element' => Form::text('date_start', $date, array_merge($formDateMaskAttr,['placeholder'=>'Từ ngày'])),
'widthElement' => 'col-6'
],
[
'label' => '',
'element' => Form::text('date_end', $date, array_merge($formDateMaskAttr,['placeholder'=>'Đến ngày'])),
'widthElement' => 'col-6'
],

];
@endphp
@extends('shop.layouts.backend')
@section('title',$pageTitle)
@section('content')
@include ("$moduleName.blocks.page_header", ['pageIndex' => true,'hidePageIndex' => true])
<section class="content">
    <div class="container-fluid">
        @include("$moduleName.blocks.notify")
        <div class="card card-outline card-primary mb800-0">
            <div class="card-body my-card-filter">
                <div class="row">
                    <div class="col-12">
                        <h6>Thời gian:</h6>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="row">
                            {!! FormTemplate::show($elements,$formInputWidth) !!}
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <div class="text-center col-12"><button class="btn btn-primary filter-in-time" data-href="{{route('user.filterInDay')}}" data-controller="warehouse">Lọc theo thời gian</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-outline card-primary">
            @include("$moduleName.blocks.x_title", ['title' => 'Quản lý kho hàng'])
            <div class="card-body p-0">
                <div class="list-user-admin">
                    @include("$moduleName.pages.$controllerName.list_admin")
                </div>
            </div>
            <div class="card-footer my-card-pagination clearfix">
                @include("$moduleName.blocks.pagination",['paginator'=>$items])
            </div>
        </div>
    </div>
</section>
@endsection