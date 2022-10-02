
@extends('shop.layouts.backend')

@section('title',$pageTitle)
@section('content')

<section class="content">
    @include("$moduleName.blocks.notify")
    <div class="card">
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="name">Yêu cầu xuất hóa đơn</label>
                            <select class="form-control" id="">
                                <option>Có</option>
                                <option>không</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="name">Mã hóa đơn</label>
                            <input class="form-control" type="text" name="" id="">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="name">Mã đơn hàng</label>
                            <input class="form-control" type="text" name="" id="">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="intro">Ngày hoàn thành</label>
                            <div class="d-flex">
                                <input class="form-control mr-4" style="width:45%" type="date" name="" id="">
                                <input class="form-control mr-0" style="width:45%" type="date" name="" id="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center my-2">
                    <button id="" class="btn btn-primary">Áp dụng</button>
                </div>
            </form>
            <div class="card">
                <div class="set-withscreen">
                    <div class="list_orderm">
                        <div class="card-body">
                            <div class="analytic status-order status-product" style="font-size:14px">
                                <a class="text-primary active-status">Tất cả<span class="text-muted">(10)</span></a>
                                <a class="text-primary">Chờ gửi hóa đơn<span class="text-muted">(5)</span></a>
                                <a class="text-primary">Đã gửi hóa đơn<span class="text-muted">(20)</span></a>
                                <a class="text-primary">Quá hạn gửi hóa đơn<span class="text-muted">(20)</span></a>
                            </div>
                            <table class="table table-striped table-checkall" style="font-size:13px!important; border: none; table-layout: auto;width: 100%">
                                <thead>
                                    <tr>
                                        <th scope="col">Mã hóa đơn</th>
                                        <th scope="col">Mã đơn hàng</th>
                                        <th scope="col">Ngày hoàn tất đơn hàng</th>
                                        <th scope="col">Hạn gửi hóa đơn</th>
                                        <th scope="col">Ngày gửi hóa đơn</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">YC xuất hóa đơn</th>
                                        <th scope="col">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="">
                                        <td><a href="{{route('invoice.detail')}}">112233</a></td>
                                        <td>345626</td>
                                        <td>24-09-2022 <p>20/:10:30</p>
                                        </td>
                                        <td>04-10-2022 <p>20/:10:30</p>
                                        </td>
                                        <td>
                                            <p>chờ cập nhật</p>
                                        </td>
                                        <td>
                                            <p>chờ gửi</p>
                                        </td>
                                        <td class="text-center"><input class="" type="checkbox" name="" id=""></td>
                                        <td>
                                            <a href="#" class="btn btn-info btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="xem chi tiết"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Tải xuống"><i class="fas fa-download"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="modal-wrapper-product">
                <div id="modal-product">
                    <div class="modal-header">
                        <h5 class="mb-0">Thêm sản phẩm</h5>
                        <!-- <button id="button-close"><i class="fas fa-times"></i></button> -->
                    </div>
                    <div class="modal-body">
                        <div class="form-search form-inline mb-2">
                            <form action="#">
                                <input type="" id="input-search-after" style="width:300px" class="form-control form-search" placeholder="Nhập tên sản phẩm để tìm kiếm">
                                <!-- <button class="search-product"><i class="fas fa-search"></i></button> -->
                            </form>
                        </div>
                        <table class="table table-striped table-checkall" style="font-size:14px!important; border: none; table-layout: auto;width: 100%">
                            <thead>
                                <tr>
                                    <th scope="col">Sản phẩm</th>
                                    <th scope="col">SL cho phép</th>
                                    <th scope="col">Kho của tôi</th>
                                    <th scope="col">Đơn vị</th>
                                    <th scope="col">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="">
                                    <td style="width: 40%">
                                        <div class="d-flex">
                                            <img style="width:40px;height:40px" src="image/images.jpg" alt="">
                                            <div class="info-product ml-3">
                                                <p class="text-success font-weight-bold">Tăm Bông Ráy Tai Hoa Trà My(12g)</p>
                                                <p>ID: 8866</p>
                                                <p>Mã: TB11</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 15%">Không giới hạn</td>
                                    <td style="width: 15%">5</td>
                                    <td style="width: 10%">Hộp</td>
                                    <td style="width: 20%">
                                        <a href="#" class="btn btn-info btn-sm rounded-0 text-white " type="button" data-toggle="tooltip" data-placement="top" title="giảm"><i class="fas fa-minus-circle"></i></a>
                                        <a href="#" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="tăng"><i class="fas fa-plus-circle"></i></i></a>

                                        <span>Đã thêm 2</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <div class="text-center align-items-center">
                            <span class="btn btn-success">Thoát</span>
                            <button type="submit" class="btn btn-primary ml-2">Thêm</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection