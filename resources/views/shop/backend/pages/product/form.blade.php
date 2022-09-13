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
            <label for="name">Tên thuốc<span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="name" id="" value="{{$item['name']??''}}" placeholder="Nhập tên thuốc" autocomplete="off">
            <span class='help-block'></span>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="name">Loại thuốc<span class="text-danger">*</span></label>
                    <select class="form-control" name="type" id="">
                        <option value="Sản phẩm loại thường">Sản phẩm loại thường</option>
                        <option value="Quà tặng">Quà tặng</option>
                    </select>
                    <span class='help-block'></span>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="intro">Mã thuốc<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="code" value="{{$item['code']??''}}" id="">
                    <span class='help-block'></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="name">Danh mục thuốc<span class="text-danger">*</span></label>
                    <select id="" class="form-control js-select2" name="cat_id">
                        <option value="">Chọn danh mục</option>
                        @foreach($product_cats as $catp1)
                        @if($catp1['level'] == 2 )
                        <option value="{{$catp1->id}}">{{$catp1->name}}</option>
                        @endif
                        @endforeach
                    </select>
                    <span class='help-block'></span>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="intro">Nhà sản xuất<span class="text-danger">*</span></label>
                    <select class="form-control" name="producer_id" id="">
                        <option value="">Chọn nhà sản xuất</option>
                        @foreach($producers as $producer)
                        <option value="{{$producer->id}}">{{$producer->name}}</option>
                        @endforeach
                    </select>
                    <span class='help-block'></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="intro">Thương hiệu thuốc<span class="text-danger">*</span></label>
                    <select class="form-control" name="trademark" id="">
                        <option value="">Chọn thương hiệu</option>
                        @foreach($trademarks as $trademark)
                        <option value="{{$trademark->name}}">{{$trademark->name}}</option>
                        @endforeach
                    </select>
                    <span class='help-block'></span>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="intro">Dạng bào chế</label>
                    <input class="form-control" type="text" name="dosage_forms" value="{{$item['dosage_forms']??''}}" id="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="intro">Nước sản xuất<span class="text-danger">*</span></label>
                    <select class="form-control" name="made_country" id="">
                        <option value="Việt Nam">Việt Nam</option>
                        <option value="Nhật Bản">Nhật Bản</option>
                        <option value="Mỹ">Mỹ</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="intro">Quy cách</label>
                    <input class="form-control" type="text" name="specification" value="{{$item['specification']??''}}" id="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="form-group">
                    <label for="name">Chiều dài (mm)</label>
                    <input class="form-control" type="text" name="longs" value="" id="">
                    <span class='help-block'></span>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="form-group">
                    <label for="intro">Chiều rộng(mm)</label>
                    <input class="form-control" type="text" name="wides" value="" id="">
                    <span class='help-block'></span>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="form-group">
                    <label for="name">Chiều cao (mm)</label>
                    <input class="form-control" type="text" name="highs" value="" id="">
                    <span class='help-block'></span>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="form-group">
                    <label for="intro">Khối lượng (gram)</label>
                    <input class="form-control" type="text" name="mass" value="" id="">
                    <span class='help-block'></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="form-group">
                    <input type="checkbox" name="tick[]" value="Hàng dễ vỡ">
                    <label for="name">Hàng dễ vỡ</label>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="form-group">
                    <input type="checkbox" name="tick[]" value="Hàng bảo quản lạnh">
                    <label for="intro">Hàng bảo quản lạnh</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="name">Loại giá bán hàng<span class="text-danger">*</span></label>
                    <select class="form-control" name="type_price" id="">
                        <option value="Giá bán hàng niêm yết">Giá bán hàng niêm yết</option>
                        <option value="Giá bán hàng theo doanh thu">Giá bán hàng theo doanh thu</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="intro">Giá bán thuốc(chưa VAT)<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="price" value="{{$item['price']??''}}" id="">
                    <span class='help-block'></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="form-group">
                    <label for="intro">Hệ số VAT(%)</label>
                    <input class="form-control" type="text" name="coefficient" value="{{$item['coefficient']??''}}" id="">
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="form-group">
                    <label for="intro">Loại VAT</label>
                    <select class="form-control" id="" name="type_vat">
                        <option value="Có VAT">Có VAT</option>
                        <option value="a">a</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="intro">Giá bán thuốc(có VAT)<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="price_vat" value="{{$item['price_vat']??''}}" id="">
                    <span class='help-block'></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="form-group">
                    <label for="intro">Quy cách đóng gói</label>
                    <input class="form-control" type="text" name="packing" value="{{$item['packing']??''}}" id="">
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="form-group">
                    <label for="intro">Đơn vị<span class="text-danger">*</span></label>
                    <select class="form-control" name="unit" id="">
                    <option value="">Chọn đơn vị</option>
                        @foreach($units as $unit)
                        <option value="{{$unit->name}}">{{$unit->name}}</option>
                        @endforeach                     
                    </select>
                    <span class='help-block'></span>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="intro">Đăng ký bán thuốc tại<span class="text-danger">*</span></label>
                    <select id="choices-multiple-remove-button" name="local_buy[]" placeholder="Chọn khu vực" multiple>
                        <option value="Toàn quốc" selected>Toàn quốc</option>$warehouses
                        @foreach($warehouses as $warehouse)
                        <option value="{{$warehouse->name}}">{{$warehouse->name}}</option>
                        @endforeach 
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12"><label for="intro">Chọn đặc tính của sản phẩm</label></div>
            <div class="col-lg-3 col-sm-6">
                <div class="form-group">
                    <input type="checkbox" name="feature[]" value="sản phẩm hậu covid">
                    <label for="name">Sản phẩm Hậu covid</label>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="form-group">
                    <input type="checkbox" name="feature[]" value="sản phẩm nổi bật">
                    <label for="name">Sản phẩm nổi bật</label>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="form-group">
                    <input type="checkbox" name="feature[]" value="sản phẩm bán chạy nhất">
                    <label for="name">Sản phẩm bán chạy nhất</label>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="form-group">
                    <input type="checkbox" name="feature[]" value="trẻ em">
                    <label for="name">Trẻ em</label>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="form-group">
                    <input type="checkbox" name="feature[]" value="người cao tuổi">
                    <label for="intro">Người cao tuổi</label>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="form-group">
                    <input type="checkbox" name="feature[]" value="phụ nữ cho con bú">
                    <label for="intro">Phụ nữ cho con bú</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="intro">Số lượng đặt lớn nhất</label>
                    <input class="form-control" type="number" id="" name="amout_max" value="{{$item['amout_max']??''}}">
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="intro">Tồn trong kho của tôi<span class="text-danger">*</span></label>
                    <input class="form-control" type="number" name="inventory" value="{{$item['inventory']??''}}" id="">
                    <span class='help-block'></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="name">Hình ảnh sản phẩm</label>
            <input type="file" class="form-control" name="image" />
            <span class='help-block'></span>
        </div>
        <label for="">Thông tin chung <span class="text-danger">*</span></label>
        <textarea name="general_info" class="form-control" id="mytextarea" cols="30" rows="5">{{$item['general_info']??''}}</textarea>
        <span class='help-block'></span>
        <div class="form-group">
            <label for="">Công dụng <span class="text-danger">*</span></label>
            <textarea name="benefit" class="form-control" id="" cols="30" rows="5">{{$item['benefit']??''}}</textarea>
            <span class='help-block'></span>
        </div>
        <div class="form-group">
            <label for="">Chỉ định</label>
            <textarea name="point" class="form-control" id="" cols="30" rows="5">{{$item['point']??''}}</textarea>
        </div>
        <div class="form-group">
            <label for="">Liều lượng - Cách dùng</label>
            <textarea name="dosage" class="form-control" id="" cols="30" rows="5">{{$item['dosage']??''}}</textarea>
        </div>
        <div class="form-group">
            <label for="">Lưu ý</label>
            <textarea name="note" class="form-control" id="" cols="30" rows="5">{{$item['note']??''}}</textarea>
        </div>
        <div class="form-group">
            <label for="">Bảo quản</label>
            <textarea name="preserve" class="form-control" id="" cols="30" rows="5">{{$item['preserve']??''}}</textarea>
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