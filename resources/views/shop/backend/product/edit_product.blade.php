@extends('shop.layouts.backend')

@section('title', 'Sửa sản phẩm')

@section('header_title', 'Sửa sản phẩm')

@section('body_content')
<div class="card">
    <div class="card-header font-weight-bold">
        Sửa sản phẩm
    </div>
    <div class="card-body">
        <form action="{{route('product.update',$product['id'])}}" method="POST" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="name">Tên sản phẩm <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="name" value="{{$product['name']}}" id="" placeholder="Nhập tên sản phẩm">
                @if($errors->has('name'))
                <small class="text-danger">{{$errors->first('name')}}</small>
                @endif
            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="name">Loại sản phẩm<span class="text-danger">*</span></label>
                        <select class="form-control" name="type_product" id="">
                            <option value="">Chọn loại sản phẩm</option>
                            <option value="Sản phẩm loại thường" {{$product['type']=='Sản phẩm loại thường'?"selected='selected'":''}}>Sản phẩm loại thường</option>
                            <option value="Quà tặng" {{$product['type']=='Quà tặng'?"selected='selected'":''}}>Quà tặng</option>
                        </select>
                        @if($errors->has('type_product'))
                        <small class="text-danger">{{$errors->first('type_product')}}</small>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="intro">Mã sản phẩm<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="code_product" value="{{$product['code']}}" id="">
                        @if($errors->has('code_product'))
                        <small class="text-danger">{{$errors->first('code_product')}}</small>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="name">Danh mục sản phẩm<span class="text-danger">*</span></label>
                        <select id="" class="form-control" name="cat_product">
                            <option value="0">Chọn danh mục</option>
                            @foreach($product_cats as $catp1)
                                <option value="{{$catp1->id}}">{{ str_repeat('-', $catp1['level']) }}{{$catp1->name}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('cat_product'))
                        <small class="text-danger">{{$errors->first('cat_product')}}</small>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="intro">Nhà sản xuất<span class="text-danger">*</span></label>
                        <select class="form-control" name="producer" id="">
                            <option value="">Chọn nhà sản xuất</option>
                            @foreach ($producers as $producer)
                            <option value="{{$producer['id_producer']}}" {{$product['producer_id'] == $producer['id_producer']?"selected='selected'":''}}>{{$producer['name_producer']}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('producer'))
                        <small class="text-danger">{{$errors->first('producer')}}</small>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($sizes as $size)
                @if($size['id']==$product['size_id'])
                <div class="col-lg-3 col-sm-6">
                    <div class="form-group">
                        <label for="name">Chiều dài (mm)</label>
                        <input class="form-control" type="text" name="longs" value="{{$size['longs']}}" id="">
                        @if($errors->has('longs'))
                        <small class="text-danger">{{$errors->first('longs')}}</small>
                        @endif
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="form-group">
                        <label for="intro">Chiều rộng(mm)</label>
                        <input class="form-control" type="text" name="wides" value="{{$size['wides']}}" id="">
                        @if($errors->has('wides'))
                        <small class="text-danger">{{$errors->first('wides')}}</small>
                        @endif
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="form-group">
                        <label for="name">Chiều cao (mm)</label>
                        <input class="form-control" type="text" name="highs" value="{{$size['highs']}}" id="">
                        @if($errors->has('highs'))
                        <small class="text-danger">{{$errors->first('highs')}}</small>
                        @endif
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="form-group">
                        <label for="intro">Khối lượng (gram)</label>
                        <input class="form-control" type="text" name="mass" value="{{$size['mass']}}" id="">
                        @if($errors->has('mass'))
                        <small class="text-danger">{{$errors->first('mass')}}</small>
                        @endif
                    </div>
                </div>
                @endif
                @endforeach
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="form-group">
                        <input type="checkbox" name="proper" value="Hàng dễ vỡ">
                        <label for="name">Hàng dễ vỡ</label>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="form-group">
                        <input type="checkbox" name="proper" value="Hàng bảo quản lạnh">
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
                        <label for="intro">Giá bán sản phẩm(chưa VAT)<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="price" value="{{$product['price']}}" id="">
                        @if($errors->has('price'))
                        <small class="text-danger">{{$errors->first('price')}}</small>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="form-group">
                        <label for="intro">Hệ số VAT(%)</label>
                        <input class="form-control" type="text" name="coefficient" value="{{$product['coefficient']}}" id="">
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
                        <label for="intro">Giá bán sản phẩm(có VAT)<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="price_vat" value="{{$product['price_vat']}}" id="">
                        @if($errors->has('price_vat'))
                        <small class="text-danger">{{$errors->first('price_vat')}}</small>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="form-group">
                        <label for="intro">Quy cách đóng gói<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="packing" value="{{$product['packing']}}" id="">
                        @if($errors->has('packing'))
                        <small class="text-danger">{{$errors->first('packing')}}</small>
                        @endif
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="form-group">
                        <label for="intro">Đơn vị<span class="text-danger">*</span></label>
                        <select class="form-control" name="unit" id="">
                            @foreach($units as $unit)
                            <option value="{{$unit['name_unit']}}">{{$unit['name_unit']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="intro">Đăng ký bán sản phẩm tại<span class="text-danger">*</span></label>
                        <select id="choices-multiple-remove-button" name="listlocals[]" placeholder="Chọn khu vực" multiple>
                        <option value="Toàn quốc" selected>Toàn quốc</option>
                            @foreach($warehouses as $warehouse)
                                <option value="{{$warehouse['local']}}">{{$warehouse['local']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="intro">Số lượng đặt hàng tối đa</label>
                        <input class="form-control" type="number" id="" name="amout_max">

                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="intro">Tồn trong kho của tôi<span class="text-danger">*</span></label>
                        <input class="form-control" type="number" name="inventory" id="">
                        @if($errors->has('inventory'))
                        <small class="text-danger">{{$errors->first('inventory')}}</small>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="name">Hình ảnh sản phẩm<span class="text-danger">*</span></label>
                <input type="file" class="form-control" name="images" multiple />
                @if($errors->has('images'))
                    <small class="text-danger">{{$errors->first('images')}}</small>
                @endif
            </div>
            <input style="height:1px;border:none;background: white;" class="form-control" type="text" name="" id="" disabled>
            <label for="">Thông tin chung <span class="text-danger">*</span></label>
            <textarea name="info-general" class="form-control" id="intro" cols="30" rows="5">{{$product['general_info']}}</textarea>
            @if($errors->has('info-general'))
            <small class="text-danger">{{$errors->first('info-general')}}</small>
            @endif
            <div class="form-group">
                <label for="">Chỉ định</label>
                <textarea name="inherent" class="form-control" id="intro" cols="30" rows="5"></textarea>
            </div>
            <div class="form-group">
                <label for="">Liều lượng - Cách dùng</label>
                <textarea name="amout" class="form-control" id="intro" cols="30" rows="5"></textarea>
            </div>
            <div class="form-group">
                <label for="">Chống chỉ định</label>
                <textarea name="contraindications" class="form-control" id="intro" cols="30" rows="5"></textarea>
            </div>
            <div class="text-center"><button type="submit" name="btnupdate_product" value="1" class="btn btn-primary">Cập nhật</button></div>
        </form>
    </div>
</div>
@endsection