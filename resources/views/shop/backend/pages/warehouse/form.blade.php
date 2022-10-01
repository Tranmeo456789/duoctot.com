@php
use App\Helpers\Form as FormTemplate;
$label = config('myconfig.template.label');
$formLabelAttr = config('myconfig.template.form_element.label');
$formInputAttr = config('myconfig.template.form_element.input');
$star = config('myconfig.template.star');
$formInputWidth['widthInput'] = 'col-12 p-0';
$inputHiddenID = Form::hidden('id', $item['id']??null);
$elements = [
[
'label' => HTML::decode(Form::label('name', 'Tên kho hàng' . $star, $formLabelAttr)),
'element' => Form::text('name', $item['name']??null, array_merge($formInputAttr,['placeholder'=>'Tên Nhà sản xuất'])),
'widthElement' => 'col-12'
],[
'element' => $inputHiddenID .Form::submit('Lưu', ['class'=>'btn btn-primary']),
'type' => "btn-submit-center"
]
];
$title = (!isset($item['id']) || $item['id'] == '') ?'Thêm mới':'Sửa thông tin';
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
                        <div class="form-group">
                            <label for="name">Tên kho hàng <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="name" id="" value="{{$item['name']??''}}" placeholder="Nhập tên kho hàng" autocomplete="off">
                            <span class='help-block'></span>
                        </div>
                        <div class="row">
                            <div class="col-12"><label for="intro">Vị trí kho hàng:</label></div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="form-group">
                                    <label for="intro">Chọn tỉnh thành phố<span class="text-danger">*</span></label>
                                    <select class="form-control choose1 city js-select2" id="city" name="local">
                                        <option value="">Chọn Tỉnh/Thành phố</option>
                                        @foreach($locals as $local)
                                        <option value="{{$local->matp}}">{{$local->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class='help-block'></span>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="form-group">
                                    <label for="name">Quận/huyện<span class="text-danger">*</span></label>
                                    <select class="form-control choose1 province js-select2" id="province" name="district">
                                        <option value="">Chọn Quận/huyện</option>
                                    </select>
                                    <span class='help-block'></span>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="form-group">
                                    <label for="intro">Phường xã<span class="text-danger">*</span></label>
                                    <select class="form-control wards js-select2" id="wards" name="wards">
                                        <option value="">Chọn Phường xã</option>
                                    </select>
                                    <span class='help-block'></span>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-5">
                            <input type="hidden" name="id" value="{{$item['id']??null}}">
                            <button type="submit" name="btn_save" class="btn btn-primary">
                                Thêm mới
                            </button>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection