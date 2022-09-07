@php
    $title = !isset($item['id'])?"Thêm mới ":"Sửa ";
    $title = $title . $pageTitle;
@endphp
@extends('shop.layouts.backend')

@section('title',  $title )

@section('header_title', $pageTitle)

@section('body_content')
<div class="card">
    @include("$moduleName.blocks.notify")
    @include("$moduleName.blocks.title",['pageTitle' =>  $title ])
    <div class="card-body">
        {{ Form::open([
            'method'         => 'POST',
            'url'            => route("$controllerName.save"),
            'accept-charset' => 'UTF-8',
            'class'          => 'form-horizontal form-label-left',
            'id'             => 'main-form' ])  }}
            <div class="form-group">
                <label for="name">Tên kho hàng <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="name" id="" value="{{$item['name']??''}}"
                        placeholder="Nhập tên kho hàng" autocomplete="off">
                <span class='help-block'></span>
            </div>
            <div class="col-lg-3 col-sm-6">
                    <div class="form-group">
                        <label for="intro">Vị trí kho hàng<span class="text-danger">*</span></label>
                        <select class="form-control" id="" name="local">
                            <option value="Hà Nội">Hà Nội</option>
                            <option value="Tp Hồ Chí Minh">Tp Hồ Chí Minh</option>
                            <option value="Đà Nẵng">Đà Nẵng</option>
                        </select>
                    </div>
                </div>
            <div class="text-center">
                <input type="hidden" name="id" value="{{$item['id']??null}}">
                <button type="submit" name="btn_save" class="btn btn-primary">
                    Thêm mới
                </button>
            </div>
        {{ Form::close() }}
    </div>
</div>

@endsection