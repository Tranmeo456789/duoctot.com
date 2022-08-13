@extends('shop.layouts.backend')

@section('title', 'Quản lý kho hàng')

@section('header_title', 'Quản lý kho hàng')

@section('body_content') 
    <div class="card mt-3 ml-2">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Quản lý tồn kho</h5>
            <div class="form-search form-inline">
                <form action="#">
                    <input type="" id="input-search-after" style="width:300px" class="form-control form-search" placeholder="Nhập tên sản phẩm để tìm kiếm">
                    <button class="search-product" ><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
        <div class="card-body table-warehouse">
            <table class="table table-striped table-checkall" >
                <thead style="">
                    <tr>
                        <th scope="col" rowspan="2" class="text-center">Sản phẩm</th>
                        <th scope="col" colspan="2" class="text-center">KHO HỒ CHÍ MINH</th>
                        <th scope="col" colspan="2" class="text-center">KHO HÀ NỘI</th>
                    </tr>
                    <tr>
                        <th scope="col" class="text-center">TỒN KHO KHẢ DỤNG</th>
                        <th scope="col" class="text-center">SỐ LƯỢNG CẦN NHẬP</th>
                        <th scope="col" class="text-center">TỒN KHO KHẢ DỤNG</th>
                        <th scope="col" class="text-center">SỐ LƯỢNG CẦN NHẬP</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="">
                        <td style="width: 40%">
                            <div style="" class="d-flex">
                                <img style="width:60px;height:60px" src="image/images.jpg" alt="">
                                <div style="" class="info-product ml-3">
                                    <p class="text-success font-weight-bold">Tăm Bông Ráy Tai Hoa Trà My(12g)</p>
                                    <p>ID: 8866</p>
                                    <p>Mã: TB11</p>
                                </div>
                            </div>
                        </td>
                        <td style="width: 15%" class="text-center">1</td>
                        <td style="width: 15%" class="text-center">3</td>
                        <td style="width: 15%" class="text-center">2</td>
                        <td style="width: 15%" class="text-center">0</td>
                    </tr>
                    <tr class="">
                        <td style="width: 40%">
                            <div style="" class="d-flex">
                                <img style="width:60px;height:60px" src="image/images.jpg" alt="">
                                <div style="" class="info-product ml-3">
                                    <p class="text-success font-weight-bold">Tăm Bông Ráy Tai Hoa Trà My(12g)</p>
                                    <p>ID: 8866</p>
                                    <p>Mã: TB11</p>
                                </div>
                            </div>
                        </td>
                        <td style="width: 15%" class="text-center">1</td>
                        <td style="width: 15%" class="text-center">3</td>
                        <td style="width: 15%" class="text-center">2</td>
                        <td style="width: 15%" class="text-center">0</td>
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