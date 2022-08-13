@extends('shop.layouts.backend')

@section('title', 'Tạo phiếu gửi hàng')

@section('header_title', 'Tạo phiếu gửi hàng')

@section('body_content')  
    <div class="card mt-2 ml-1">
        <div class="card-header font-weight-bold">
            Thông tin chung
        </div>
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="name">Mã phiếu gửi hàng</label>
                            <input class="form-control" type="text" name="" id="">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="name">Ngày gửi dự kiến</label>
                            <input class="form-control" type="date" name="" id="">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="intro">Kho gửi hàng<span class="text-danger" >*</span></label>
                            <select class="form-control" id="">
                                <option>Chọn kho gửi hàng</option>
                                <option>Kho Hà Nội</option>
                                <option>Kho Hồ Chí Minh</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="intro">Ghi chú</label>
                    <textarea name="" class="form-control" id="intro" cols="30" rows="3"></textarea>
                </div>
            </form>
        </div>
    </div>
    <div class="card mt-3 ml-2">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <div class=" form-inline">
                <p class="mb-0">Danh sách thêm vào phiếu gửi hàng</p>
            </div>
            <button id="btn-addfast-product" class="btn btn-primary">Thêm sản phẩm</button>
        </div>
        <div class="card-body">
            <table class="table table-striped table-checkall" style="font-size:13px!important; border: none; table-layout: auto;width: 100%">
                <thead style="">
                    <tr>
                        <th scope="col">Sản phẩm</th>
                        <th scope="col">Số lượng dự kiến</th>
                        <th scope="col">Số lượng cho phép</th>
                        <th scope="col">Lô</th>
                        <th scope="col">Hạn sử dụng</th>
                        <th scope="col">SP gần hết hạn</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="">
                        <td style="width: 35%">
                            <div style="" class="d-flex">
                                <img style="width:60px;height:60px" src="image/images.jpg" alt="">
                                <div style="" class="info-product ml-3">
                                    <p class="text-success font-weight-bold">Tăm Bông Ráy Tai Hoa Trà My(12g)</p>
                                    <p>ID: 8866</p>
                                    <p>Mã: TB11</p>
                                </div>
                            </div>
                        </td>
                        <td style="width: 15%">
                            <div class="d-flex align-items-center">
                                <input style="width:70%;" class="form-control mr-0" type="number" name="" id="">
                                <span class="">Hộp</span>
                            </div>
                        </td>
                        <td style="width: 10%">10</td>
                        <td style="width: 9%"><input class="form-control" type="text" name="" id=""></td>
                        <td style="width: 11%"><input class="form-control" type="date" name="" id=""></td>
                        <td style="width: 10%"><input class="" type="checkbox" name="" id=""></td>
                        <td style="width: 10%">
                            <a href="#" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                            <a href="#" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="tăng"><i class="fas fa-plus-circle"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
    <div id="modal-wrapper-product">
        <div id="modal-product">
            <div class="modal-header">
                <h5 class="mb-0">Thêm sản phẩm</h5>
                <button id="button-close"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-search form-inline mb-2">
                    <form action="#">
                        <input type="" id="input-search-after" style="width:300px" class="form-control form-search" placeholder="Nhập tên sản phẩm để tìm kiếm">
                        <button class="search-product" ><i class="fas fa-search"></i></button>
                    </form>
                </div>
                <table class="table table-striped table-checkall" style="font-size:14px!important; border: none; table-layout: auto;width: 100%">
                <thead style="">
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
                            <div style="" class="d-flex">
                                <img style="width:40px;height:40px" src="image/images.jpg" alt="">
                                <div style="" class="info-product ml-3">
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
@endsection