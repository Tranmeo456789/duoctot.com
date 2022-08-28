@extends('shop.layouts.backend')

@section('title', 'Danh sách đơn hàng')

@section('header_title', 'Danh sách đơn hàng')

@section('body_content')

<div class="card">
    <div class="card-header">
        <div class=" font-weight-bold">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 titlehearder">
                    <div class="form-search form-inline">
                        <form action="#" style="width:100%">
                            <input type="" id="input-search-after" style="width:100%" class="form-control form-search" placeholder="Nhập tên sản phẩm để tìm kiếm">
                            <button class="search-product"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12">
                    <div class="text-capitalize">
                        <label for="">Thời gian:</label>  
                        <input type="date" class="border-top-0 border-left-0 border-right-0"> ~ <input type="date" class="border-top-0 border-left-0 border-right-0">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="set-withscreen">
        <div class="list_orderm">
            <div class="card-body">
                <div class="analytic status-order status-product" style="font-size:14px">
                    <a class="text-primary active-status">Tất cả<span class="text-muted">(10)</span></a>
                    <a class="text-primary">Chờ xác nhận<span class="text-muted">(5)</span></a>
                    <a class="text-primary">Đã xác nhận<span class="text-muted">(20)</span></a>
                    <a class="text-primary">Đang xử lý<span class="text-muted">(20)</span></a>
                    <a class="text-primary">Chờ giao hàng<span class="text-muted">(20)</span></a>
                    <a class="text-primary">Đang giao hàng<span class="text-muted">(20)</span></a>
                    <a class="text-primary">Đã giao hàng<span class="text-muted">(20)</span></a>
                    <a class="text-primary">Hoàn tất<span class="text-muted">(20)</span></a>
                    <a class="text-primary">Đã hủy<span class="text-muted">(20)</span></a>
                    <a class="text-primary">Giỏ hàng<span class="text-muted">(20)</span></a>
                </div>
                <table class="table table-striped table-checkall" style="font-size:14px!important; border: none; table-layout: auto;width: 100%">
                    <thead>
                        <tr>
                            <th scope="col">Mã đơn hàng</th>
                            <th scope="col">Doanh thu</th>
                            <th scope="col">Ngày đặt hàng</th>
                            <th scope="col">Trạng thái đơn hàng</th>
                            <th scope="col">Trạng thái đối soát</th>
                            <th scope="col" class="text-center">Thao tác</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr class="">
                            <td style="width: 20%"><a href="{{route('order.detail')}}">112233</a></td>
                            <td style="width: 16%">3,435,333đ</td>
                            <td style="width: 16%">03-03-2022</td>
                            <td style="width: 16%"><span class="badge badge-success">Chờ xác nhận</span></td>
                            <td style="width: 16%" class="text-success">Đã thanh toán</td>
                            <td style="width: 16%" class="text-center">
                                <a href="{{url('shop/chi-tiet-don-hang')}}" class="btn btn-info btn-sm rounded-0 text-white " type="button" data-toggle="tooltip" data-placement="top" title="Xem chi tiết đơn hàng"><i class="fas fa-eye rounded-circle"></i></a>
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