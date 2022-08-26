@extends('shop.layouts.frontend')

@section('content')
<div class="cbr">
    <div class="wp-inner mt-2">
        <div class="cbh1"><a href=""><i class="fas fa-angle-left"></i> Tiếp tục mua hàng</a></div>
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <div class="wp-left-cart">
                    <div class="title-cart">
                        <h1>Có 3 sản phẩm trong giỏ hàng</h1>
                    </div>
                    <div class="info-product-cart">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td style="width:20%">
                                            <a href=""><img src="{{asset('images/shop/ct1.png')}}" alt="" style="width: 100px;"></a>
                                        </td>
                                        <td style="width:50%" class="text-left">
                                            <div class="title-product-cart">
                                                <a href="">Viên Sủi Optimax Immunity Booster Vid - Fighter Tăng Sức Đề Kháng 20 Viên</a>
                                            </div>
                                            <span>Đơn vị bán:</span><span class="font-weight-bold">Tuýp</span>
                                            <p class="font-weight-bold">* Giảm ngay 15%</p>
                                        </td>
                                        <td style="width:30%" class="text-right">
                                            <div class="input-number intable">
                                                <span class="pm11">
                                                    <span title="" class="minus1"><i class="fa fa-minus"></i></span>
                                                    <input type="number" name="" min="0" value="1" class="num-order">
                                                    <span title="" class="plus1"><i class="fa fa-plus"></i></span>
                                                </span>
                                            </div>
                                            <div class="price-old"><s>115.000đ</s></div>
                                            <div class="price-new">97.750đ</div>
                                            <div class="manipulation">
                                                <a href="" class="buy-after"><img src="{{asset('images/shop/ct4.png')}}" alt="">Để mua sau</a>
                                                <span> | </span>
                                                <a href="" class="delete-product"><img src="{{asset('images/shop/ct5.png')}}" alt="">Xóa</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:25%">
                                            <a href=""><img src="{{asset('images/shop/ct1.png')}}" alt="" style="width: 100px;"></a>
                                        </td>
                                        <td style="width:45%" class="text-left">
                                            <div class="title-product-cart">
                                                <a href="">Viên Sủi Optimax Immunity Booster Vid - Fighter Tăng Sức Đề Kháng 20 Viên</a>
                                            </div>
                                            <span>Đơn vị bán:</span><span class="font-weight-bold">Tuýp</span>
                                            <p class="font-weight-bold">* Giảm ngay 15%</p>
                                        </td>
                                        <td style="width:30%" class="text-right">
                                            <div class="input-number intable">
                                                <span class="pm11">
                                                    <span title="" class="minus1"><i class="fa fa-minus"></i></span>
                                                    <input type="number" name="" min="0" value="1" class="num-order">
                                                    <span title="" class="plus1"><i class="fa fa-plus"></i></span>
                                                </span>
                                            </div>
                                            <div class="price-old"><s>115.000đ</s></div>
                                            <div class="price-new">97.750đ</div>
                                            <div class="manipulation">
                                                <a href="" class="buy-after"><img src="{{asset('images/shop/ct4.png')}}" alt="">Để mua sau</a>
                                                <span> | </span>
                                                <a href="" class="delete-product"><img src="{{asset('images/shop/ct5.png')}}" alt="">Xóa</a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="pay-cart">
                        <div class="position-relative titanh">
                            <h3>Áp dụng ưu đãi</h3>
                            <img src="{{asset('images/shop/ad1.png')}}" alt="">
                        </div>
                        <div class="payment position-relative">
                            <h2>Thanh toán VNPAY-QR</h2>
                            <p>Nhập mã VNPAYLC giảm ngay 3% tối đa 50,000đ khi thanh toán 100% qua VNPAY-QR <a href="">Xem chi tiết</a></p>
                            <div class="payment-img"><img src="{{asset('images/shop/vnpay.png')}}" alt=""></div>
                        </div>
                    </div>
                    <div class="wp-ttkh">
                        <div class="ttkh d-flex justify-content-between">
                            <p>Thông tin khách hàng</p>
                            <div>
                                <img src="{{asset('images/shop/ed1.png')}}" alt="">
                                <span>Chỉnh sửa</span>
                            </div>
                        </div>
                    </div>
                    <table class="table ttdd mb-0">
                        <tbody>
                            <tr>
                                <td style="width:30%">
                                    <p>Họ và tên</p>
                                </td>
                                <td style="width:70%" class="text-left">
                                    <span>Anh Nguyễn Xuân Quang</span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:30%">
                                    <p>Số điện thoại</p>
                                </td>
                                <td style="width:70%" class="text-left">
                                    <span>09736745678</span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:30%">
                                    <p>Email</p>
                                </td>
                                <td style="width:70%" class="text-left">
                                    <span>xuanquang2345@gmail.com</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="info-customer-cart p-2">
                        <div class="row mx-0">
                            <div class="col-12">
                                <div class="form-group">
                                    <p class="font-weight-bold">Chọn hình thức nhận hàng</p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="" value="Chờ duyệt" checked>
                                        <label class="form-check-label" for="status1">
                                            Nhận tại nhà thuốc
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="" value="Công khai">
                                        <label class="form-check-label" for="exampleRadios2">
                                            Giao hàng tận nơi
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="" autocomplete="off" placeholder="Nhập họ tên">
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="" autocomplete="off" placeholder="Nhập số điện thoại">
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <select name="product_cat" class="form-control choose" id="">
                                        <option value="">Hà Nội</option>
                                        <option value="">TP Hồ Chí Minh</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <select name="product_cat" class="form-control choose" id="">
                                        <option value="">Quận Hà Đông</option>
                                        <option value="">Ba Đình</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-10">
                                <p class="font-weight-bold">Có 1 nhà thuốc tại quận Hà Đông, Hà Nội</p>
                                <div class="local_drugstore d-flex justify-content-between flex-wrap">
                                    <div class="">
                                        <div class="form-group m-0">
                                            <div class="form-check m-0">
                                                <input class="form-check-input" type="radio" name="" id="" value="Chờ duyệt">
                                                <label class="form-check-label" for="">
                                                    Tầng 01, Lô TM03, Tòa nhà CT6, Khu đô thị Văn Khê, P. La Khê, Q. Hà Đông, TP. Hà Nội
                                                </label>
                                            </div>
                                        </div>
                                        <span class="text-info">Có hàng</span>
                                    </div>
                                    <a href="">Xem bản đồ</a>
                                </div>
                                <small class="text-danger d-flex">
                                    <div class="d-flex align-items-center"><img src="{{asset('images/shop/gd1.png')}}" alt=""></div>
                                    <span>Bạn chưa chọn cửa hàng</span>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 px-0">
                <div class="info-order">
                    <div class="title-order d-flex justify-content-center">
                        <img src="{{asset('images/shop/ode1.png')}}" alt="">
                        <h2 class="">THÔNG TIN ĐƠN HÀNG </h2>
                    </div>
                    <table>
                        <tbody>
                            <tr>
                                <td class="pl-2 py-2">Tổng tiền</td>
                                <td class="text-right pr-2 py-2">1.625.000đ</td>
                            </tr>
                            <tr>
                                <td class="pl-2 py-2">Khuyến mãi giảm</td>
                                <td class="text-right pr-2 py-2">17.250đ</td>
                            </tr>
                            <tr>
                                <td class="pl-2 py-2">Phí giao dự kiến</td>
                                <td class="text-right pr-2 py-2">0đ</td>
                            </tr>
                            <tr>
                                <td class="pl-2 py-2 font-weight-bold">Cần thanh toán</td>
                                <td class="text-right text-info pr-2 py-2">1.607.750đ</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="discount-code">
                        <h4 class="text-info d-flex justify-content-center py-2">
                            <img src="{{asset('images/shop/ode2.png')}}" alt="">
                            <a href="" class="">Sử dụng mã giảm giá</a>
                        </h4>
                        <small class="text-danger d-flex justify-content-center">
                            <img src="{{asset('images/shop/gd1.png')}}" alt="">
                            <span>Vui lòng nhập đầy đủ tên và số điện thoại mua hàng để áp dụng mã giảm giá</span>
                        </small>
                    </div>
                    <div class="cmoder">
                        <a href="">HOÀN TẤT ĐẶT HÀNG</a>
                        <p>Bằng cách đặt hàng, bạn đồng ý với
                            <span class="underline"> Điều khoản sử dụng </span>của T Doctor
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="new-view mt-5">
                    @include("$moduleName.pages.$controllerName.child_product.new_view")
                </div>
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