@extends('shop.layouts.backend')

@section('title', 'Thêm khách hàng')

@section('header_title', 'Thêm khách hàng')

@section('body_content')
    <form>
        <div class="card mt-2 ml-1">
            <div class="card-header font-weight-bold">
                Thông tin chung
            </div>
            <div class="card-body">

                    <div class="form-group">
                        <label for="name">Tên khách hàng<span class="text-danger" >*</span></label>
                        <input class="form-control" type="text" name="" id="" placeholder="Nhập tên khách hàng" >
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Mã khách hàng</span></label>
                                <input class="form-control" type="text" name="" id="">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="intro">Nhóm khách hàng</label>
                                <select class="form-control" id="">
                                    <option>Chọn nhóm khách hàng</option>
                                    <option>Bán buôn</option>
                                    <option>Bán lẻ</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Số điện thoại</span></label>
                                <input class="form-control" type="text" name="" id="">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="intro">Email</label>
                                <input class="form-control" type="text" name="" id="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Địa chỉ</span></label>
                                <input class="form-control" type="text" name="" id="" placeholder="Số nhà,tên đường...">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="intro">Tỉnh/Thành phố</label>
                                <select class="form-control" id="">
                                    <option>Chọn Tỉnh/Thành phố</option>
                                    <option>Hà Nội</option>
                                    <option>TP Hồ Chí Minh</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Quận/huyện</span></label>
                                <select class="form-control" id="">
                                    <option>Chọn Quận/huyện</option>
                                    <option>Ba Đình</option>
                                    <option>Quận 8</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="intro">Phường xã</label>
                                <select class="form-control" id="">
                                    <option>Chọn Phường xã</option>
                                    <option>Phường 17</option>
                                    <option>Phường 22</option>
                                </select>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="card mt-2 ml-1">
            <div class="card-header font-weight-bold">
                Thông bổ sung
            </div>
            <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Ngày sinh</span></label>
                                <input class="form-control" type="date" name="" id="">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="intro">Giới tính</label>
                                <select class="form-control" id="">
                                    <option>Chọn giới tính</option>
                                    <option>Nam</option>
                                    <option>Nữ</option>
                                    <option>Khác</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="text-center"><button type="submit" class="btn btn-primary">Thêm mới</button></div>
            </div>
        </div>
    </form>
@endsection