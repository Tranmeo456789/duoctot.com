@extends('shop.layouts.backend')

@section('title', 'Danh sách sản phẩm')

@section('header_title', 'Danh sách sản phẩm')

@section('body_content')
<div class="card mt-3 ml-2">
    <div class="set-withscreen ">
        <div class="list-productwp">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">Danh sách sản phẩm</h5>
                <div class="form-search form-inline">
                    <form action="#">
                        <input type="" id="input-search-after" style="width:300px" class="form-control form-search" placeholder="Nhập tên sản phẩm để tìm kiếm">
                        <button class="search-product"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="analytic status-product">
                    <a class="text-primary active-status">Tất cả<span class="text-muted">(10)</span></a>
                    <a class="text-primary">Đang bán<span class="text-muted">(5)</span></a>
                    <a class="text-primary">Ngừng bán<span class="text-muted">(20)</span></a>
                    <a class="text-primary">Tạm hết hàng<span class="text-muted">(20)</span></a>
                    <a class="text-primary">Gần hết hàng<span class="text-muted">(20)</span></a>
                    <a class="text-primary">Chờ kiểm duyệt<span class="text-muted">(20)</span></a>
                    <a class="text-primary">Từ chối<span class="text-muted">(20)</span></a>
                </div>
                <table class="table table-striped table-checkall" style="font-size:14px!important; border: none; table-layout: auto;width: 100%">
                    <thead>
                        <tr>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Đơn vị</th>
                            <th scope="col">Cập bậc</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Tổng đơn đặt hàng</th>
                            <th scope="col">Tồn trong kho của tôi</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="">
                            <td style="width: 35%">
                                <div class="d-flex">
                                    <img style="width:60px;height:60px" src="image/images.jpg" alt="">
                                    <div class="info-product ml-3">
                                        <p class="text-success font-weight-bold">Tăm Bông Ráy Tai Hoa Trà My(12g)</p>
                                        <p>ID: 8866</p>
                                        <p>Mã: TB11</p>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 5%">Gói</td>
                            <td style="width: 7%">Cấp bậc 3</td>
                            <td style="width: 10%">03-03-2022</td>
                            <td style="width: 10%">0</td>
                            <td style="width: 10%">10000</td>
                            <td style="width: 8%"><span class="badge badge-success">Còn hàng</span></td>
                            <td style="width: 15%">
                                <a href="#" class="btn btn-info btn-sm rounded-0 text-white " type="button" data-toggle="tooltip" data-placement="top" title="Xem sản phẩm trên web"><i class="fas fa-eye rounded-circle"></i></a>
                                <a href="#" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Sửa sản phẩm"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <tr class="">
                            <td style="width: 35%">
                                <div class="d-flex">
                                    <img style="width:60px;height:60px" src="image/images.jpg" alt="">
                                    <div class="info-product ml-3">
                                        <p class="text-success font-weight-bold">Tăm Bông Ráy Tai Hoa Trà My(12g)</p>
                                        <p>ID: 8866</p>
                                        <p>Mã: TB11</p>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 5%">Gói</td>
                            <td style="width: 7%">Cấp bậc 3</td>
                            <td style="width: 10%">03-03-2022</td>
                            <td style="width: 10%">0</td>
                            <td style="width: 10%">10000</td>
                            <td style="width: 8%"><span class="badge badge-success">Còn hàng</span></td>
                            <td style="width: 15%">
                                <a href="#" class="btn btn-info btn-sm rounded-0 text-white " type="button" data-toggle="tooltip" data-placement="top" title="Xem sản phẩm trên web"><i class="fas fa-eye rounded-circle"></i></a>
                                <a href="#" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Sửa sản phẩm"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <tr class="">
                            <td style="width: 35%">
                                <div class="d-flex">
                                    <img style="width:60px;height:60px" src="image/images.jpg" alt="">
                                    <div class="info-product ml-3">
                                        <p class="text-success font-weight-bold">Tăm Bông Ráy Tai Hoa Trà My(12g)</p>
                                        <p>ID: 8866</p>
                                        <p>Mã: TB11</p>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 5%">Gói</td>
                            <td style="width: 7%">Cấp bậc 3</td>
                            <td style="width: 10%">03-03-2022</td>
                            <td style="width: 10%">0</td>
                            <td style="width: 10%">10000</td>
                            <td style="width: 8%"><span class="badge badge-success">Còn hàng</span></td>
                            <td style="width: 15%">
                                <a href="#" class="btn btn-info btn-sm rounded-0 text-white " type="button" data-toggle="tooltip" data-placement="top" title="Xem sản phẩm trên web"><i class="fas fa-eye rounded-circle"></i></a>
                                <a href="#" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Sửa sản phẩm"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">Trước</span>
                                <span class="sr-only">Sau</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

</div>
@endsection