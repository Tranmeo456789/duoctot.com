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

        <div class="card">
            <div class="card-header font-weight-bold">
                Thông tin chung
            </div>
            <div class="card-body">
                <label for="name">Tên khách hàng<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="name" id="" value="{{$item['name']??''}}" placeholder="Nhập tên khách hàng" autocomplete="off">
                <span class='help-block'></span>
                <div class="row">
                    <div class="col-xl-6 col-lg-12">
                        <div class="form-group">
                            <label for="name">Mã khách hàng<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="code_customer" value="{{$item['code_customer']??''}}" id="">
                            <span class='help-block'></span>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12">
                        <div class="form-group">
                            <label for="intro">Nhóm khách hàng</label>
                            <select class="form-control" id="" name="customer_group">
                                <option value="Nhà thuốc">Nhà thuốc</option>
                                <option value="Bệnh nhân">Bệnh nhân</option>
                                <option value="Phòng khám">Phòng khám</option>
                                <option value="Bệnh viện">Bệnh viện</option>
                                <option value="Trung tâm y tế">Trung tâm y tế</option>
                                <option value="Nha khoa">Nha khoa</option>
                                <option value="Thẩm mỹ viện">Thẩm mỹ viện</option>
                                <option value="Công ty dược">Công ty dược</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-12">
                        <div class="form-group">
                            <label for="name">Số điện thoại<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="phone" value="{{$item['phone']??''}}" id="">
                            <span class='help-block'></span>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12">
                        <div class="form-group">
                            <label for="name">Mật khẩu<span class="text-danger">*</span></label>
                            <input class="form-control" type="password" name="password" value="{{$item['password']??''}}" id="">
                            <span class='help-block'></span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="intro">Email</label>
                            <input class="form-control" type="text" name="email" value="{{$item['email']??''}}" id="">
                            <span class='help-block'></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-12">
                        <div class="form-group">
                            <label for="name">Địa chỉ<span class="text-danger">*</span></span></label>
                            <input class="form-control" type="text" name="address_detail" value="{{$item['address_detail']??''}}" id="" placeholder="Số nhà,tên đường...">
                            <span class='help-block'></span>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12">
                        <div class="form-group">
                            <label for="intro">Tỉnh/Thành phố<span class="text-danger">*</span></label>
                            <select class="form-control choose1 city js-select2" id="city" name="province">
                                <option value="">Chọn Tỉnh/Thành phố</option>
                                @foreach($locals as $local)
                                <option value="{{$local->matp}}">{{$local->name}}</option>
                                @endforeach
                            </select>
                            <span class='help-block'></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-12">
                        <div class="form-group">
                            <label for="name">Quận/huyện<span class="text-danger">*</span></label>
                            <select class="form-control choose1 province js-select2" id="province" name="district">
                                <option value="">Chọn Quận/huyện</option>
                            </select>
                            <span class='help-block'></span>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12">
                        <div class="form-group">
                            <label for="intro">Phường xã<span class="text-danger">*</span></label>
                            <select class="form-control wards js-select2" id="wards" name="wards">
                                <option value="">Chọn Phường xã</option>
                            </select>
                            <span class='help-block'></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-header font-weight-bold">
                Thông bổ sung
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-6 col-lg-12">
                        <div class="form-group">
                            <label for="intro">Giới tính</label>
                            <select class="form-control" id="" name="gender">
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                                <option value="Khác">Khác</option>
                            </select>
                        </div>
                    </div>
                </div>
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