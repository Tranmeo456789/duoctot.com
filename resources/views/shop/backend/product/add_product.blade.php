@extends('shop.layouts.backend')

@section('title', 'Thêm thuốc')

@section('header_title', 'Thêm thuốc')

@section('body_content')
<div class="card">
    <div class="card-header font-weight-bold">
        Thêm thuốc
    </div>
    <div class="card-body">
        <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="name">Tên sản phẩm <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="name" value="{{old('name')}}" id="" placeholder="Nhập tên sản phẩm">
                @if($errors->has('name'))
                <small class="text-danger">{{$errors->first('name')}}</small>
                @endif
            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="name">Loại thuốc<span class="text-danger">*</span></label>
                        <select class="form-control" name="type_product" id="">
                            <option value="">Chọn loại thuốc</option>
                            <option value="Sản phẩm loại thường">Sản phẩm loại thường</option>
                            <option value="Quà tặng">Quà tặng</option>
                        </select>
                        @if($errors->has('type_product'))
                        <small class="text-danger">{{$errors->first('type_product')}}</small>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="intro">Mã thuốc<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="code_product" value="{{old('code_product')}}" id="">
                        @if($errors->has('code_product'))
                        <small class="text-danger">{{$errors->first('code_product')}}</small>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="name">Danh mục thuốc<span class="text-danger">*</span></label>
                        <select id="" class="form-control" name="cat_product">
                            <option value="0">Chọn danh mục</option>
                            @foreach($product_cats as $catp1)
                            @if($catp1['level'] == 2 )
                            <option value="{{$catp1->id}}">{{str_repeat('-',$catp1['level']) }}{{$catp1->name}}</option>
                            @endif
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
                            <option value="{{$producer['id_producer']}}">{{$producer['name_producer']}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('producer'))
                        <small class="text-danger">{{$errors->first('producer')}}</small>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="intro">Thương hiệu thuốc<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="trademark" value="{{old('trademark')}}" id="">
                        @if($errors->has('trademark'))
                        <small class="text-danger">{{$errors->first('trademark')}}</small>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="intro">Dạng bào chế</label>
                        <input class="form-control" type="text" name="dosage_forms" value="{{old('dosage_forms')}}" id="">
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
                        <input class="form-control" type="text" name="specification" value="{{old('specification')}}" id="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="form-group">
                        <label for="name">Chiều dài (mm)</label>
                        <input class="form-control" type="text" name="longs" value="{{old('longs')}}" id="">
                        @if($errors->has('longs'))
                        <small class="text-danger">{{$errors->first('longs')}}</small>
                        @endif
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="form-group">
                        <label for="intro">Chiều rộng(mm)</label>
                        <input class="form-control" type="text" name="wides" value="{{old('wides')}}" id="">
                        @if($errors->has('wides'))
                        <small class="text-danger">{{$errors->first('wides')}}</small>
                        @endif
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="form-group">
                        <label for="name">Chiều cao (mm)</label>
                        <input class="form-control" type="text" name="highs" value="{{old('highs')}}" id="">
                        @if($errors->has('highs'))
                        <small class="text-danger">{{$errors->first('highs')}}</small>
                        @endif
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="form-group">
                        <label for="intro">Khối lượng (gram)</label>
                        <input class="form-control" type="text" name="mass" value="{{old('mass')}}" id="">
                        @if($errors->has('mass'))
                        <small class="text-danger">{{$errors->first('mass')}}</small>
                        @endif
                    </div>
                </div>
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
                        <label for="intro">Giá bán thuốc(chưa VAT)<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="price" value="{{old('price')}}" id="">
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
                        <input class="form-control" type="text" name="coefficient" value="{{old('coefficient')}}" id="">
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
                        <input class="form-control" type="text" name="price_vat" value="{{old('price_vat')}}" id="">
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
                        <input class="form-control" type="text" name="packing" value="{{old('packing')}}" id="">
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
                        <label for="intro">Đăng ký bán thuốc tại<span class="text-danger">*</span></label>
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
                        <input class="form-control" type="number" id="" name="amout_max" value="{{old('amout_max')}}">
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="intro">Tồn trong kho của tôi<span class="text-danger">*</span></label>
                        <input class="form-control" type="number" name="inventory" value="{{old('inventory')}}" id="">
                        @if($errors->has('inventory'))
                        <small class="text-danger">{{$errors->first('inventory')}}</small>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="name">Hình ảnh sản phẩm<span class="text-danger">*</span></label>
                <input type="file" class="form-control" name="images" />
                @if($errors->has('images'))
                <small class="text-danger">{{$errors->first('images')}}</small>
                @endif
            </div>
            <input style="height:1px;border:none;background: white;" class="form-control" type="text" name="" id="" disabled>
            <label for="">Thông tin chung <span class="text-danger">*</span></label>
            <textarea name="info-general" class="form-control" id="mytextarea" cols="30" rows="5">{{old('info-general')}}</textarea>
            @if($errors->has('info-general'))
            <small class="text-danger">{{$errors->first('info-general')}}</small>
            @endif
            <div class="form-group">
                <label for="">Công dụng <span class="text-danger">*</span></label>
                <textarea name="benefit" class="form-control" id="" cols="30" rows="5">{{old('benefit')}}</textarea>
                @if($errors->has('benefit'))
                <small class="text-danger">{{$errors->first('benefit')}}</small>
                @endif
            </div>
            <div class="form-group">
                <label for="">Chỉ định</label>
                <textarea name="inherent" class="form-control" id="" cols="30" rows="5">{{old('inherent')}}</textarea>
            </div>
            <div class="form-group">
                <label for="">Liều lượng - Cách dùng</label>
                <textarea name="amout" class="form-control" id="" cols="30" rows="5">{{old('amout')}}</textarea>
            </div>
            <div class="form-group">
                <label for="">Lưu ý</label>
                <textarea name="note" class="form-control" id="" cols="30" rows="5">{{old('note')}}</textarea>
            </div>
            <div class="form-group">
                <label for="">Bảo quản</label>
                <textarea name="preserve" class="form-control" id="" cols="30" rows="5">{{old('preserve')}}</textarea>
            </div>
            <div class="form-group">
                <label for="">Chống chỉ định</label>
                <textarea name="contraindications" class="form-control" id="" cols="30" rows="5">{{old('contraindications')}}</textarea>
            </div>
            <div class="text-center"><button type="submit" name="btnadd_product" value="1" class="btn btn-primary">Thêm mới</button></div>
        </form>
    </div>
</div>
@endsection