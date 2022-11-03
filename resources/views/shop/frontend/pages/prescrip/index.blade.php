@extends('shop.layouts.frontend')

@section('content')
<div class="position-relative" style="min-height: 600px;">
    <div class="bg-prescrip">
        <picture>
            <source media="(max-width: 992px)" srcset="{{asset('images/shop/bg-donthuoc-mb.png')}}">
            <img src="{{asset('images/shop/bg-donthuoc.png')}}" alt="">
        </picture>
    </div>
    <div class="wp-inner">
        <div class="header-prescrip">
            <h1>Mua Thuốc Dễ Dàng Tại Tdoctor</h1>
            <p>Đến với Tdoctor, bạn sẽ mua được đúng loại thuốc <br> theo đơn cùng dịch vụ tư vấn đến từ đội ngũ dược sĩ</p>
        </div>
        <div class="d-flex justify-content-center">
            <div class="prescrip-content">
                <div class="body-prescrip">
                    <h5 class="qprescrip">Bạn đã có đơn thuốc chưa ?</h5>
                    <ul class="nav nav-pills mb-3 header-tab" id="pills-tab" role="tablist">
                        <li class="nav-item wp-50" role="presentation">
                            <button class="nav-link active wp-100" id="pills-home-tab" data-toggle="pill" data-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Đã có đơn thuốc</button>
                        </li>
                        <li class="nav-item wp-50" role="presentation">
                            <button class="nav-link wp-100" id="pills-profile-tab" data-toggle="pill" data-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Chưa có cần tư vấn</button>
                        </li>
                    </ul>
                    <div class="form-buy">
                        @include("$moduleName.pages.$controllerName.child_index.form_buy")
                    </div>                   
                </div>
                <div class="footer-prescrip d-flex">
                    <div class="img-footer-prescrip">
                        <img src="{{asset('images/shop/prescrip3.png')}}" alt="">
                    </div>
                    <div class="footer-prescrip-content">
                        <h6>Quy trình xử lý thông tin</h6>
                        <ul>
                            <li><span class="f-w-600">Bước 1: </span>Quý khách vui lòng chọn và điền các thông tin mua thuốc bên trên</li>
                            <li><span class="f-w-600">Bước 2: </span>Dược sĩ chuyên môn của nhà thuốc sẽ gọi tư vấn cho Quý khách</li>
                            <li><span class="f-w-600">Bước 3: </span>Quý khách tới các Nhà thuốc Long Châu gần nhất để được hỗ trợ mua hàng</li>
                            <li><span class="f-w-600">Lưu ý: </span>Nếu mua thuốc kê đơn, vui lòng mang theo toa thuốc</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <div class="form-search-product" id="form-search-product">
            @include("$moduleName.pages.$controllerName.child_index.form_search_product")
        </div>
    </div>

    <div class="service-tdoctor mt-5">
        @include("$moduleName.templates.info_service")
    </div>
    <div class="local">
        @include("$moduleName.templates.local_drugstore")
    </div>
    <div class="wp-inner mt-5">
        <div class="feedback-customer">
            @include("$moduleName.templates.feedback_customer")
        </div>
    </div>

    @endsection