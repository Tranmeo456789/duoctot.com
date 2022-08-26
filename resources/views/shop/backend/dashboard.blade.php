@extends('shop.layouts.backend')

@section('title', 'Thống kê bán hàng')

@section('header_title', 'Tổng quan')

@section('body_content')
<div class="card mb-3">
    <div class="card-header font-weight-bold">
        <h6>KẾT QUẢ KINH DOANH TRONG NGÀY</h6>
    </div>
    <div class="card-body p-0">
        <div class="set-withscreen">
            <ul class="business-results">
                <li class="item">
                    <a href="" style="color:black">
                        <div class="icon"><i class="fas fa-hand-holding-usd"></i></div>
                        <div>
                            <h6>Doanh thu</h6>
                            <h5>0</h5>
                        </div>
                    </a>
                </li>
                <li class="item">
                    <a href="" style="color:black">
                        <div class="icon"><i class="far fa-newspaper"></i></i></div>
                        <div>
                            <h6>Đơn hàng mới</h6>
                            <h5>0</h5>
                        </div>
                    </a>
                </li>
                <li class="item">
                    <a href="" style="color:black">
                        <div class="icon"><i class="fas fa-outdent"></i></div>
                        <div>
                            <h6>Đơn hàng trả</h6>
                            <h5>0</h5>
                        </div>
                    </a>
                </li>
                <li class="item">
                    <a href="" style="color:black">
                        <div class="icon"><i class="fas fa-times"></i></div>
                        <div>
                            <h6>Đơn hàng hủy</h6>
                            <h5>0</h5>
                        </div>
                    </a>
                </li>
            </ul>
        </div>

    </div>
</div>
<div class="card mb-3">
    <div class="card-header font-weight-bold d-flex justify-content-between align-item-center">
        <h6>ĐƠN HÀNG CHỜ XỬ LÝ</h6>
        <div class="header-content-left">
            <div class="btn-group">
                <button style="font-size:14px" type="button" class="btn dropdown-toggle p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Hôm nay
                </button>
                <div style="font-size:14px;width:6rem;min-width: 65px;margin-top:4px;" class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item pl-2 m-0" href="#">Hôm qua</a>
                    <a class="dropdown-item pl-2 m-0" href="#">7 ngày qua</a>
                    <a class="dropdown-item pl-2 m-0" href="#">30 ngày qua</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="set-withscreen">
            <ul class="order-wait mb-0">
                <li class="">
                    <a href="" style="color:black">
                        <div class="icon"><i class="fas fa-business-time"></i></div>
                        <div>
                            <p>Chờ duyệt</p>
                            <h6>0</h6>
                        </div>
                    </a>
                </li>
                <li class="">
                    <a href="" style="color:black">
                        <div class="icon"><i class="fas fa-business-time"></i></div>
                        <div>
                            <p>Chờ thanh toán</p>
                            <h6>0</h6>
                        </div>
                    </a>
                </li>
                <li class="">
                    <a href="" style="color:black">
                        <div class="icon"><i class="fab fa-accusoft"></i></div>
                        <div>
                            <p>Chờ đóng gói</p>
                            <h6>0</h6>
                        </div>
                    </a>
                </li>
                <li class="">
                    <a href="" style="color:black">
                        <div class="icon"><i class="fas fa-archway"></i></div>
                        <div>
                            <p>Chờ lấy hàng</p>
                            <h6>0</h6>
                        </div>
                    </a>
                </li>
                <li class="">
                    <a href="" style="color:black">
                        <div class="icon"><i class="fas fa-shuttle-van"></i></div>
                        <div>
                            <p>Đang giao hàng</p>
                            <h6>0</h6>
                        </div>
                    </a>
                </li>
                <li class="">
                    <a href="" style="color:black">
                        <div class="icon"><i class="fas fa-shopping-bag"></i></div>
                        <div>
                            <p>Hủy giao - chờ nhận</p>
                            <h6>0</h6>
                        </div>
                    </a>
                </li>
            </ul>
        </div>

    </div>
</div>
<div class="card mb-3">
    <div class="card-header font-weight-bold d-flex justify-content-between align-item-center">
        <h6>DOANH THU BÁN HÀNG</h6>
        <div class="header-content-left">
            <div class="btn-group">
                <button style="font-size:14px" type="button" class="btn dropdown-toggle p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Hôm nay
                </button>
                <div style="font-size:14px;width:6rem;min-width: 65px;margin-top:4px;" class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item pl-2 m-0" href="#">Hôm qua</a>
                    <a class="dropdown-item pl-2 m-0" href="#">7 ngày qua</a>
                    <a class="dropdown-item pl-2 m-0" href="#">30 ngày qua</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body p-5" style="margin: auto">
        <div>
            <img src="{{asset('shop/images/productnull.PNG')}}" alt="" srcset="">
            <h6 class="text-center">Chưa có dữ liệu</h6>
        </div>

    </div>
</div>
<div class="card">
    <div class="card-header font-weight-bold d-flex justify-content-between align-item-center">
        <h6>THÔNG TIN KHO</h6>
    </div>
    <div class="card-body p-0">
        <ul class="warehouse">
            <li class="">
                <a href="" style="color:black">
                    <h6>Số tồn kho</h6>
                    <span>666</span>
                </a>
            </li>
            <li class="">
                <a href="" style="color:black">
                    <h6>Giá trị tồn kho</h6>
                    <span>666,888</span>
                </a>
            </li>
        </ul>
    </div>
</div>
@endsection