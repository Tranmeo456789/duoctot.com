@extends('shop.layouts.frontend')

@section('content')
<div class="position-relative" style="min-height: 600px;">
    <div class="bg-prescrip">
        <picture>
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
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <div class="tcy">
                                    <p>Để dược sĩ có đầy đủ thông tin tư vấn & xác nhận đơn hàng của quý khách.</p>
                                    <strong>Vui lòng nhập theo tên thuốc hoặc gửi ảnh chụp đơn thuốc:</strong>
                                </div>
                                <div class="tcy-upload">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="text-center seth-img-100">
                                                <img src="{{asset('images/shop/prescrip1.png')}}" alt="">
                                            </div>
                                            <div class="tcy-upload-content text-center f-w-600">
                                                <p>Nhập theo tên thuốc</p>
                                                <a class="btn btn-primary btn-sm border-r-1000 addy-product">Thêm thuốc</a>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="text-center seth-img-100">
                                                <img src="{{asset('images/shop/prescrip2.png')}}" alt="">
                                            </div>
                                            <div class="tcy-upload-content text-center f-w-600">
                                                <p>Gửi ảnh chụp đơn thuốc</p>
                                                <a class="btn btn-primary btn-sm border-r-1000">Chọn ảnh tải lên</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="male" checked>
                                        <label class="form-check-label" for="inlineRadio1">Anh</label>
                                    </div>
                                    <div class="form-check form-check-inline mb-2">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="female">
                                        <label class="form-check-label" for="inlineRadio2">Chị</label>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12">
                                            <input class="input-prescrip" type="text" placeholder="Nhập họ và tên">
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <input class="input-prescrip" type="text" placeholder="Nhập số điện thoại">
                                        </div>
                                        <div class="col-12">
                                            <h6 class="mt-2">Địa chỉ nhận hàng</h6>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <select name="status_order" data-id="" class="label-order custom-select border-r-10">
                                                <option value="">Thành phố</option>

                                            </select>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <select name="status_order" data-id="" class="label-order custom-select border-r-10">
                                                <option value="">Quận huyện</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="text-center mt-2"><button class="btn-form-submit">GỬI CHO DƯỢC SĨ</button></div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <div class="tcy">
                                    <p>Vui lòng cung cấp thông tin để dược sĩ tư vấn và hỗ trợ tạo đơn hàng sớm nhất.</p>
                                </div>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="male" checked>
                                        <label class="form-check-label" for="inlineRadio1">Anh</label>
                                    </div>
                                    <div class="form-check form-check-inline mb-2">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="female">
                                        <label class="form-check-label" for="inlineRadio2">Chị</label>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12">
                                            <input class="input-prescrip" type="text" placeholder="Nhập họ và tên">
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <input class="input-prescrip" type="text" placeholder="Nhập số điện thoại">
                                        </div>
                                        <div class="col-12">
                                            <h6 class="mt-2">Địa chỉ nhận hàng</h6>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <select name="status_order" data-id="" class="label-order custom-select border-r-10">
                                                <option value="">Thành phố</option>

                                            </select>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <select name="status_order" data-id="" class="label-order custom-select border-r-10">
                                                <option value="">Quận huyện</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="text-center mt-2"><button class="btn-form-submit">GỬI CHO DƯỢC SĨ</button></div>
                                </div>
                            </div>
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
        <div class="form-search-product">
            <div class="header d-flex justify-content-between">
                <div class="tshorder">Nhập theo tên thuốc</div>
                <button class="btn-closenk rimg-center"><img src="{{asset('images/shop/dn4.png')}}" alt=""></button>
            </div>
            <div class="d-flex justify-content-center">
                <div class="wp-content">
                    <form action="" class="wp-content-shorder">
                        <div class="content text-center">
                        <div class=" position-relative mb-2">
                                <input class="input-prescrip pd-left-40" type="search" placeholder="Vui lòng nhập tên thuốc cần tìm">
                                <div class="img-person img-search-product"><img src="{{asset('images/shop/searchp.png')}}" alt=""></div>
                            </div>
                            <div class="mb-3 rimg-center"><img src="{{asset('images/shop/pescrip5.png')}}" alt="" style="display:block"></div>
                        </div>
                        <div class="text-center"><input type="submit" name="btn-searchorder" value="Hoàn tất" id="btn-searchorder"></div>
                    </form>
                </div>
            </div>

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