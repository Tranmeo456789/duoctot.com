@extends('shop.layouts.backend')

@section('title',$pageTitle)
@section('content')
@include ("$moduleName.blocks.page_header", ['pageIndex' => false])
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card card-primary">
                    @include("$moduleName.blocks.x_title", ['title' => (isset($item['id'])?"Chính sửa":"Thêm mới")])
                    <div class="card-body">
                        <div class="row"></div>
                        {{ Form::open([
                            'method'         => 'POST',
                            'url'            => route("$controllerName.save"),
                            'accept-charset' => 'UTF-8',
                            'class'          => 'form-horizontal form-label-left',
                            'id'             => 'main-form' ])  }}
                            <div class="form-group">
                                <label for="name">Tên nhà sản xuất <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="name" id="" value="{{$item['name']??''}}"
                                        placeholder="Nhập tên nhà sản xuất" autocomplete="off">
                                <span class='help-block'></span>
                            </div>
                            <div class="text-center">
                                <input type="hidden" name="id" value="{{$item['id']??null}}">
                                <button type="submit" name="btn_save" class="btn btn-primary">
                                    Lưu
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