@extends('shop.layouts.backend')

@section('title', 'Danh sách khách hàng')

@section('header_title', 'Danh sách khách hàng')

@section('body_content')
<div class="card">
    <div class="card-header font-weight-bold">
        <div class="row">
            <div class="col-xl-6 col-lg-12">
                <div class="form-search form-inline">
                    <form action="#" style="width:100%">
                        <input type="" id="input-search-after" style="width:100%" class="form-control form-search" placeholder="Nhập tên sản phẩm để tìm kiếm">
                        <button class="search-product"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="set-withscreen">
        <div class="list_orderm">
            <div class="card-body">
                <table class="table table-striped table-checkall" style="font-size:14px!important; border: none; table-layout: auto;width: 100%">
                    <thead>
                        <tr>
                            <th scope="col">Mã khách hàng</th>
                            <th scope="col">Tên khách hàng</th>
                            <th scope="col">Số điện thoại</th>
                            <th scope="col">Nhóm khách hàng</th>
                            <th scope="col">Tổng chi tiêu</th>
                            <th scope="col">Tồn SL đơn hàng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="">
                            <td style="width: 15%">TD77788</td>
                            <td style="width: 20%">Nguyễn Thị Tình</td>
                            <td style="width: 15%">0987888777</td>
                            <td style="width: 15%">Mua lẻ</td>
                            <td style="width: 20%">568,000đ</td>
                            <td style="width: 15%">10</td>
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