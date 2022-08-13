@extends('shop.layouts.backend')

@section('title', 'Chi tiết đơn hàng')

@section('header_title', 'Chi tiết đơn hàng')

@section('body_content') 

    <div class="card mt-2 ml-1">
        <div class="card-header font-weight-bold bg-info text-light">
            Thông tin đơn hàng
        </div>
        <div class="card-body">
            <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="intro">Mã đơn hàng</label>
                            <input class="form-control" type="text" name="" id="" value="112345" disabled>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="intro">Trạng thái</label>
                            <input class="form-control" type="text" name="" id="" value="Đã xác nhận" disabled>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="intro">Tổng tiền</label>
                            <input class="form-control" type="text" name="" id="" value="112,335đ" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="intro">Số lượng sản phẩm</label>
                            <input class="form-control" type="text" name="" id="" value="11" disabled>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="intro">Số lượng mặt hàng</label>
                            <input class="form-control" type="text" name="" id="" value="1" disabled>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="intro">Hình thức thanh toán</label>
                            <input class="form-control" type="text" name="" id="" value="Thanh toán bằng tiền mặt khi nhận hàng" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="intro">Hình thức giao hàng</label>
                            <input class="form-control" type="text" name="" id="" value="Giao hàng tiêu chuẩn" disabled>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="intro">Ghi chú</label>
                            <input class="form-control" type="text" name="" id="" value="giao nhanh" disabled>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="intro">Ngày tạo</label>
                            <input class="form-control" type="text" name="" id="" value="23-07-2021 10:15:00" disabled>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <div class="card mt-2 ml-1">
        <div class="card-header font-weight-bold bg-info text-light">
            Sản phẩm đã đặt
        </div>
        <div class="card-body">
            <table class="table table-striped table-checkall" style="font-size:14px!important; border: none; table-layout: auto;width: 100%">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Mã sản phẩm</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Hình ảnh</th>
                        <th scope="col">Giá</th>
                        <th scope="col" >Số lượng đặt</th>
                        <th scope="col" >Số lượng giao</th>
                        <th scope="col" >Tổng doanh thu</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="">
                        <td style="width: 7%">7514</td>
                        <td style="width: 13%">ID132</td>
                        <td style="width: 20%">Thuốc ho bảo thanh</td>
                        <td style="width: 12%"><img style="width:50px" src="{{url('/public/images/shop/thuocho.jpg')}}" alt="" srcset=""></td>
                        <td style="width: 10%">112,435đ</td>
                        <td style="width: 12%">1</td>
                        <td style="width: 12%">0</td>
                        <td style="width: 14%">112,435đ</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


@endsection