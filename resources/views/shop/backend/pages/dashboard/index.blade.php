@extends('shop.layouts.backend')
@section('title','Quản lý nhà thuốc Tdoctor')

@section('content')
@php
use App\Model\Shop\OrderModel;
use App\Helpers\MyFunction;
@endphp
<section class="content pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-primary">
                    @include("$moduleName.blocks.x_title", ['title' => 'KẾT QUẢ KINH DOANH TRONG NGÀY'])
                    <div class="card-body p-0">
                        <ul class="business-results">
                            <li class="item">
                                <a href="" style="color:black">
                                    <div class="icon"><i class="fas fa-hand-holding-usd"></i></div>
                                    <div>
                                        <h6>Doanh thu</h6>
                                        <h5>{{MyFunction::formatNumber($sum) . ' đ'}}</h5>
                                    </div>
                                </a>
                            </li>
                            <li class="item">
                                <a href="" style="color:black">
                                    <div class="icon"><i class="far fa-newspaper"></i></i></div>
                                    <div>
                                        <h6>Đơn hàng mới</h6>
                                        <h5>{{count($order_day)}}</h5>
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
                <div class="card card-outline card-primary">
                    @include("$moduleName.blocks.x_title", ['title' => 'ĐƠN HÀNG'])
                    <div class="card-body p-0">
                        @php
                        $status_oreder=[
                        ['name'=>'Đang xử lý','slug'=>'dangXuLy','icon'=>'fa-business-time'],
                        ['name'=>'Đã xác nhận','slug'=>'daXacNhan','icon'=>'fa-business-time'],
                        ['name'=>'Đang giao hàng','slug'=>'dangGiaoHang','icon'=>'fa-business-time'],
                        ['name'=>'Đã giao hàng','slug'=>'daGiaoHang','icon'=>'fa-business-time'],
                        ['name'=>'Đã hủy','slug'=>'daHuy','icon'=>'fa-business-time'],
                        ['name'=>'Hoàn tất','slug'=>'hoanTat','icon'=>'fa-business-time'],
                        ]
                        @endphp
                        <ul class="order-wait mb-0">
                            @foreach($status_oreder as $item)
                                @php                          
                                $params['status_order']=$item['slug'];
                                $itemStatus = (new OrderModel)->countItems($params, ['task' => 'admin-count-items-status-order']);
                                @endphp
                            <li class="">
                                <a href="" style="color:black">
                                    <div class="icon">
                                        <i class="fas {{$item['icon']}}"></i>
                                    </div>
                                    <div>
                                        <p>{{$item['name']}}</p>
                                        <h6>{{$itemStatus[0]['count']??0}}</h6>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="card card-outline card-primary">
                    @include("$moduleName.blocks.x_title", ['title' => 'DOANH THU BÁN HÀNG'])
                    <div class="card-body p-5">
                        <div class="row">
                            <div class="col-12 text-center">
                                <img src="{{asset('shop/images/productnull.PNG')}}" alt="">
                                <h6 class="text-center">Chưa có dữ liệu</h6>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card card-outline card-primary">
                    @include("$moduleName.blocks.x_title", ['title' => 'THÔNG TIN KHO'])
                    <div class="card-body">
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
</section>
@endsection