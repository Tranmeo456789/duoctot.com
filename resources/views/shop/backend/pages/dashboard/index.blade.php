@extends('shop.layouts.backend')
@section('title','Quản lý nhà thuốc Tdoctor')

@section('content')
@php
use App\Model\Shop\OrderModel;
use App\Model\Shop\AffiliateModel;

use App\Helpers\MyFunction;
@endphp
<section class="content">
    <div class="card card-outline card-primary mb800-0">
        @include("$moduleName.blocks.x_title", ['title' => 'KẾT QUẢ KINH DOANH TRONG NGÀY'])
        <div class="card-body p-0">
            <ul class="business-results">
                <li class="item">
                    <div>
                        <a href="" style="color:black">
                            <div class="icon"><i class="fas fa-hand-holding-usd"></i></div>
                            <div>
                                <h6>Doanh thu</h6>
                                <h5>{{MyFunction::formatNumber($sum_money_day) . ' đ'}}</h5>
                            </div>
                        </a>
                    </div>
                </li>
                <li class="item">
                    <div>
                        <a href="{{route('order')}}" style="color:black">
                            <div class="icon"><i class="far fa-newspaper"></i></i></div>
                            <div>
                                <h6>Đơn hàng mới</h6>
                                <h5>{{count($order_day)}}</h5>
                            </div>
                        </a>
                    </div>
                </li>
                <li class="item">
                    <div>
                        <a href="{{route('order')}}" style="color:black">
                            <div class="icon"><i class="fas fa-outdent"></i></div>
                            <div>
                                <h6>Đơn hàng trả</h6>
                                <h5>0</h5>
                            </div>
                        </a>
                    </div>

                </li>
                <li class="item">
                    <div>
                        <a href="{{route('order')}}" style="color:black">
                            <div class="icon"><i class="fas fa-times"></i></div>
                            <div>
                                <h6>Đơn hàng hủy</h6>
                                <h5>0</h5>
                            </div>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="card card-outline card-primary mb800-0">
        @include("$moduleName.blocks.x_title", ['title' => 'ĐƠN HÀNG'])
        <div class="card-body p-0">
            @php
            $status_order=[
            ['name'=>'Đang xử lý','slug'=>'dangXuLy','icon'=>'fa-business-time'],
            ['name'=>'Đã xác nhận','slug'=>'daXacNhan','icon'=>'fa-business-time'],
            ['name'=>'Đang giao hàng','slug'=>'dangGiaoHang','icon'=>'fa-business-time'],
            ['name'=>'Đã giao hàng','slug'=>'daGiaoHang','icon'=>'fa-business-time'],
            ['name'=>'Đã hủy','slug'=>'daHuy','icon'=>'fa-business-time'],
            ['name'=>'Hoàn tất','slug'=>'hoanTat','icon'=>'fa-business-time'],
            ]
            @endphp
            <ul class="order-wait mb-0">
            @foreach($status_order as $item)
                @php
                    $itemStatus = collect($itemStatusOrderCount)->where('status_order', $item['slug'])->first();
                    $count = $itemStatus['count'] ?? 0;
                @endphp
                <li class="">
                    <a href="{{route('order')}}" style="color:black">
                        <div class="icon">
                            <i class="fas {{$item['icon']}}"></i>
                        </div>
                        <div>
                            <p>{{$item['name']}}</p>
                            <h6>{{$count}}</h6>
                        </div>
                    </a>
                </li>
            @endforeach
            </ul>
        </div>
    </div>
    <div class="data-revenue">
        @include("$moduleName.pages.$controllerName.child_index.revenue_sell")
    </div>
    @if ((Session::has('user') && Session::get('user')['is_admin'] == 1))
    <div class="card card-outline card-primary mb800-0">
        @include("$moduleName.blocks.x_title", ['title' => 'THÔNG TIN KHO'])
        <div class="card-body">
            <ul class="warehouse">
                <li class="">
                    <a href="" style="color:black">
                        <h6>Số tồn kho</h6>
                        <span>{{$sum_quantity}}</span>
                    </a>
                </li>
                <li class="">
                    <a href="" style="color:black">
                        <h6>Giá trị tồn kho</h6>
                        <span>{{MyFunction::formatNumber($sum_money) . ' đ'}}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    @endif
</section>
@endsection