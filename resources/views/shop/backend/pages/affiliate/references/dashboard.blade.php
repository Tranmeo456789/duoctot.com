@extends('shop.layouts.backend')
@section('title','Trang tổng quan Tdoctor')

@section('content')
@php
use App\Helpers\MyFunction;
@endphp
<section class="content">
    <div class="card card-outline card-primary mb800-0">
        @include("$moduleName.blocks.x_title", ['title' => 'Tổng quan tài khoản'])
        <div class="card-body p-0">
            <ul class="business-results">
                <li class="item">
                    <div>
                        <a href="" style="color:black">
                            <div class="icon"><i class="fas fa-hand-holding-usd"></i></div>
                            <div>
                                <h6>Tổng hoa hồng nhận</h6>
                                <h5>{{MyFunction::formatNumber($sumMoney) . ' đ'}}</h5>
                            </div>
                        </a>
                    </div>
                </li>
                <li class="item">
                    <div>
                        <a href="" style="color:black">
                            <div class="icon"><i class="far fa-newspaper"></i></i></div>
                            <div>
                                <h6>Đã nhận</h6>
                                <h5>0 đ</h5>
                            </div>
                        </a>
                    </div>
                </li>
                <li class="item">
                    <div>
                        <a href="" style="color:black">
                            <div class="icon"><i class="fas fa-outdent"></i></div>
                            <div>
                                <h6>SL sản phẩm đã bán</h6>
                                <h5>{{$sumQuantity??0}}</h5>
                            </div>
                        </a>
                    </div>

                </li>
                <li class="item">
                    <div>
                        <a href="" style="color:black">
                            <div class="icon"><i class="fas fa-times"></i></div>
                            <div>
                                <h6>SL tương tác vào link</h6>
                                <h5>{{$sumLinkCount??0}}</h5>
                            </div>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</section>
@endsection