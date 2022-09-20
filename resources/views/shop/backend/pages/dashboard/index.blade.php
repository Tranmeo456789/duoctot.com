@extends('shop.layouts.backend')
@section('title',$pageTitle)

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-primary">
                    @include("$moduleName.blocks.x_title", ['title' => 'KẾT QUẢ KINH DOANH TRONG NGÀY'])
                    <div class="card-body p-0">
                        <div class="row">
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
                <div class="card card-outline card-primary">
                    @include("$moduleName.blocks.x_title", ['title' => 'ĐƠN HÀNG CHỜ XỬ LÝ'])
                    <div class="card-body p-0">
                        <div class="row">
                            <ul class="order-wait mb-0">
                                <li class="">
                                    <a href="" style="color:black">
                                        <div class="icon">
                                            <i class="fas fa-business-time"></i>
                                        </div>
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
                <div class="card card-outline card-primary">
                    @include("$moduleName.blocks.x_title", ['title' => 'DOANH THU BÁN HÀNG'])
                    <div class="card-body p-5">
                        <div class="row">
                            <div class="col-12 text-center">
                                <img src="{{asset('shop/images/productnull.PNG')}}" alt="" >
                                <h6 class="text-center">Chưa có dữ liệu</h6>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card card-outline card-primary">
                    @include("$moduleName.blocks.x_title", ['title' => 'THÔNG TIN KHO'])
                    <div class="card-body">
                        <div class="row">
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
                </div>
            </div>
        </div>
    </div>
</section>
@endsection