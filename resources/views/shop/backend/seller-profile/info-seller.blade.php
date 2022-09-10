@extends('shop.layouts.backend')

@section('title', 'Thông tin người bán hàng')

@section('header_title', 'Thông tin người bán hàng')

@section('body_content')
<div class="card">
    <div class="card-header font-weight-bold">
        Thông tin chi tiết
    </div>
    <div class="card-body">
        <form action="{{route('seller.save')}}" method="POST">
            {!! csrf_field() !!}
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <div class="form-group">
                        <label for="name">Mã thành viên</label>
                        <input class="form-control" type="text" name="code_customer" id="" value="{{$customer['code_customer']??''}}">
                    </div>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <div class="form-group">
                        <label for="intro">Tên người bán(tên hiển thị)</label>
                        <input class="form-control" type="text" name="name" id="" value="{{$customer['name']??''}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="name">Số điện thoại</label>
                        <input class="form-control" type="text" name="phone" id="" value="{{$customer['phone']??''}}">
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="intro">Email</label>
                        <input class="form-control" type="text" name="email" id="" value="{{$customer['email']??''}}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="name">Địa chỉ<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="address_detail" value="{{$customer->address_detail??''}}" id="" placeholder="Số nhà, tên đường">
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-6">
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
                <div class="col-lg-4 col-sm-6">
                    <div class="form-group">
                        <label for="name">Quận/huyện<span class="text-danger">*</span></label>
                        <select class="form-control choose1 province js-select2" id="province" name="district">
                            <option value="">Chọn Quận/huyện</option>
                        </select>
                        <span class='help-block'></span>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="form-group">
                        <label for="intro">Phường xã<span class="text-danger">*</span></label>
                        <select class="form-control wards js-select2" id="wards" name="wards">
                            <option value="">Chọn Phường xã</option>
                        </select>
                        <span class='help-block'></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div><label for="name">Khu vực bán hàng</label></div>
                <select id="" class="form-control js-select2" placeholder="Chọn khu vực" multiple="multiple">
                    @foreach($locals as $local)
                    <option value="{{$local->name}}">{{$local->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="name">Mã số thuế</label>
                        <input class="form-control" type="text" name="" id="" value="" placeholder="Nhập mã số thuế">
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="name">Người đại diện pháp luật</label>
                        <input class="form-control" type="text" name="" id="" value="" placeholder="Nhập người đại diện pháp luật">
                    </div>
                </div>
            </div>
            <div class="text-center"><button type="submit" class="btn btn-primary">Cập nhật</button></div>
        </form>
    </div>
</div>
@endsection