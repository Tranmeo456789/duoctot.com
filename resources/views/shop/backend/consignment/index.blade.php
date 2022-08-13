@extends('shop.layouts.backend')

@section('title', 'Danh sách phiếu gửi hàng')

@section('header_title', 'Danh sách phiếu gửi hàng')

@section('body_content') 
    <div class="card mt-3 ml-2">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <div class="form-search form-inline">
                <form action="#">
                    <input type="" id="input-search-after" style="width:300px" class="form-control form-search" placeholder="Nhập mã phiếu gửi hàng">
                    <button class="search-product" ><i class="fas fa-search"></i></button>
                </form>
            </div>
            <div class="text-center"><a href="{{route('consignment.add')}}" type="" class="btn btn-primary">Tạo phiếu gửi hàng</a></div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-checkall" style="font-size:13px!important; border: none; table-layout: auto;width: 100%">
                <thead>
                    <tr>
                        <th scope="col">Mã phiếu gửi hàng</th>
                        <th scope="col">Kho</th>
                        <th scope="col">Ngày gửi hàng</th>
                        <th scope="col">SL dự kiến</th>
                        <th scope="col">SL thực nhận</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Ghi chú</th>
                        <th scope="col">Thời gian cập nhật</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="">
                        <td style="width: 15%">
                                <div style="" class="info-product ml-3">
                                    <p class="text-success font-weight-bold"><a href="{{route('consignment.detail')}}">PGH456789625</a></p>
                                    <p>ID: 8866</p>
                                </div>
                        </td>
                        <td style="width: 12%">Kho Hà Nội</td>
                        <td style="width: 13%">03-03-2022</td>
                        <td style="width: 7%">10</td>
                        <td style="width: 8%">0</td>
                        <td style="width: 10%"><span class="badge badge-success">Đã hoàn tất</span></td>
                        <td style="width: 10%"></td>

                        <td style="width: 15%">
                            <div>
                                <div>
                                    <span>Tạo:</span><span> 12-01-2022</span>
                                </div>
                                <div>
                                    <span>Cập nhật:</span><span> 12-01-2022</span>
                                </div>

                            </div>
                        </td>
                        <td style="width: 10%">
                            <a href="{{url('/shop/chi-tiet-phieu-gui-hang')}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Chi tiết"><i class="fa fa-edit"></i></a>
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
@endsection