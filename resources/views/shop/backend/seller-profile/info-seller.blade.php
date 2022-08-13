@extends('shop.layouts.backend')

@section('title', 'Thông tin người bán hàng')

@section('header_title', 'Thông tin người bán hàng')

@section('body_content') 
    <div class="card mt-2 ml-1">
        <div class="card-header font-weight-bold">
            Thông tin chi tiết
        </div>
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="name">Mã thành viên</label>
                            <input class="form-control" type="text" name="" id="" value="200033">
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="form-group">
                            <label for="intro">Tên người bán(tên hiển thị)</label>
                            <input class="form-control" type="text" name="" id="" value="ADMINTOR">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Số điện thoại</label>
                            <input class="form-control" type="text" name="" id="" value="0986777888">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="intro">Email</label>
                            <input class="form-control" type="text" name="" id="" value="nguoiban@gmail.com">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Địa chỉ<span class="text-danger" >*</span></label>
                    <input class="form-control" type="text" name="" id="" placeholder="Số nhà, tên đường" >
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="name">Tỉnh TP</label>
                            <select class="form-control" id="">
                                <option>Chọn tỉnh/thành phố</option>
                                <option>Thành phố Hồ Chí Minh</option>
                                <option>Hà Nội</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="intro">Quận/Huyện</label>
                            <select class="form-control" id="">
                                <option>Chọn quận/huyện</option>
                                <option>Quận Bình Thạnh</option>
                                <option>Quận Tân Bình</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="intro">Phường/Xã</label>
                            <select class="form-control" id="">
                                <option>Chọn phường/xã</option>
                                <option>Phường 28</option>
                                <option>Phường 11</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                <label for="name">Khu vực bán hàng</label>
                    <select id="choices-multiple-remove-button" placeholder="Chọn khu vực" multiple>
                        <option value="">Toàn quốc</option>
                        <option value="">Hà Nội</option>
                        <option value="">TP Hồ Chí Minh</option>
                        <option value="">Đà Nẵng</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Mã số thuế</label>
                            <input class="form-control" type="text" name="" id="" value="" placeholder="Nhập mã số thuế">
                        </div>
                    </div>
                    <div class="col-6">
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