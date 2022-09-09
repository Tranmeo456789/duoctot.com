@php
$title = !isset($item['id'])?"Thêm mới ":"Sửa ";
$title = $title . $pageTitle;
@endphp
@extends('shop.layouts.backend')

@section('title', $title )

@section('header_title', $pageTitle)

@section('body_content')
<div class="card">
    @include("$moduleName.blocks.notify")
    @include("$moduleName.blocks.title",['pageTitle' => $title ])
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

@endsection