@extends('shop.layouts.backend')

@section('title', 'Chi tiết hóa đơn')

@section('header_title', 'Chi tiết hóa đơn')

@section('body_content') 
    <div class="row m-0 mt-2">
            <div class="col-6 pr-0">
                <div class="card">
                    <div class="card-header font-weight-bold bg-info text-light">
                        Thông tin hóa đơn
                    </div>
                    <div class="card-body">
                            <table class="table table-striped table-checkall" style="font-size:14px!important; border: none; table-layout: auto;width: 100%">
                                <tbody>
                                    <tr class="">
                                        <td style="">Mã hóa đơn</td>
                                        <td style="">K673DX</td>
                                    </tr>
                                    <tr class="">
                                        <td style="">Mã đơn  hàng</td>
                                        <td style="">112233</td>
                                    </tr>
                                    <tr class="">
                                        <td style="">Yêu cầu xuất hóa đơn</td>
                                        <td style="">Có</td>
                                    </tr>
                                    <tr class="">
                                        <td style="">Hạn gửi đơn  hàng</td>
                                        <td style="">04-10-2022</td>
                                    </tr>
                                    <tr class="">
                                        <td style="">Ngày gửi hóa đơn</td>
                                        <td style="">Chờ cập nhật</td>
                                    </tr>
                                    <tr class="">
                                        <td style="">Tổng tiền</td>
                                        <td style="">140500đ</td>
                                    </tr>
                                    <tr class="">
                                        <td style="">Số lượng sản phẩm</td>
                                        <td style="">14</td>
                                    </tr>
                                    <tr class="">
                                        <td style="">Số lượng mặt hàng</td>
                                        <td style="">14</td>
                                    </tr>
                                    <tr class="">
                                        <td style="">hình thức thanh toán</td>
                                        <td style="">Thanh toán tiền mặt khi nhận hàng</td>
                                    </tr>
                                    <tr class="">
                                        <td style="">Địa chỉ gửi hóa đơn</td>
                                        <td style="">....</td>
                                    </tr>
                                    <tr class="">
                                        <td style="">Ghi chú</td>
                                        <td style="">......</td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                        <div class="card-header font-weight-bold bg-info text-light">
                            Thông tin người mua
                        </div>
                        <div class="card-body">
                                <table class="table table-striped table-checkall" style="font-size:14px!important; border: none; table-layout: auto;width: 100%">
                                    <tbody>
                                        <tr class="">
                                            <td style="">Vai trò</td>
                                            <td style="">.....</td>
                                        </tr>
                                        <tr class="">
                                            <td style="">Tên công ty</td>
                                            <td style="">Công ty cổ phần</td>
                                        </tr>
                                        <tr class="">
                                            <td style="">Mã số thuế</td>
                                            <td style="">.....</td>
                                        </tr>
                                        <tr class="">
                                            <td style="">Địa chỉ</td>
                                            <td style="">Hà Tĩnh</td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                </div>
            </div>
    </div>





@endsection