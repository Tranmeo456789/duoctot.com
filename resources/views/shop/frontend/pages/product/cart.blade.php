@extends('shop.layouts.frontend')

@section('content')
<div class="cbr">
    <div class="wp-inner">
        @if(Session::has('cart'))
        @if(count(Session::get('cart')) > 0)
        <div class="cbh1"><a href="{{route('home')}}"><i class="fas fa-angle-left"></i> Tiếp tục mua hàng</a></div>
        <form action="{{route('fe.order.completed')}}" method="POST" id="order-complete">
            {!! csrf_field() !!}
            <div class="row ">
                <div class="col-xl-9 col-lg-12 mb-1 pd800-0">
                    <div class="wp-left-cart border-radius-800">
                        <div class="title-cart">
                            <h1>Có {{count(Session::get('cart'))}} sản phẩm trong giỏ hàng</h1>
                        </div>
                        <div class="info-product-cart">
                            <div class="table-responsive">
                                <div class="set-widthtable">
                                    <table class="table mb-0">
                                        <tbody>
                                            @php
                                            $total=0;
                                            @endphp
                                            @foreach( Session::get('cart') as $row )
                                            @php
                                            $total+=$row['price']*$row['qty'];
                                            @endphp
                                            <tr>
                                                <td style="width:10%">
                                                    <a href="" style="display:block; text-align:center"><img src="{{asset($row['image'])}}" alt="" style="width: 100px;"></a>
                                                </td>
                                                <td style="width:60%" class="text-left">
                                                    <div class="title-product-cart">
                                                        <a href="" class="truncate2">{{$row['name']}}</a>
                                                    </div>
                                                    <span>Đơn vị bán:</span><span class="font-weight-bold">{{$row['unit']}}</span>
                                                    <p class="font-weight-bold">* Giảm ngay 15%</p>
                                                </td>
                                                <td style="width:30%" class="text-right">
                                                    <div class="input-number intable">
                                                        <span class="pm11">
                                                            <span title="" class="minus1 minus2"><i class="fa fa-minus"></i></span>
                                                            <input type="number" max="999" min="1" value="{{$row['qty']}}" data-id="{{$row['id']}}" data-rowId="{{$row['rowId']}}" name="qty[{{$row['rowId']}}]" class="num-order number-ajax num-order{{$row['rowId']}}">
                                                            <span title="" class="plus1 plus2"><i class="fa fa-plus"></i></span>
                                                        </span>
                                                    </div>
                                                    <div class="price-new price-new{{$row['id']}}">{{number_format($row['price']*$row['qty'],0,',','.')}}<span>đ</span></div>
                                                    <div class="manipulation">
                                                        <a href="" class="buy-after"><img src="{{asset('images/shop/ct4.png')}}" alt="">Để mua sau</a>
                                                        <span> | </span>
                                                        <a href="{{route('fe.cart.delete',$row['rowId'])}}" class="delete-product"><img src="{{asset('images/shop/ct5.png')}}" alt="">Xóa</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="pay-cart">
                            <div class="position-relative titanh">
                                <h3>Áp dụng ưu đãi</h3>
                                <img src="{{asset('images/shop/ad1.png')}}" alt="">
                            </div>
                            @include("$moduleName.block.payment_vnpay")
                        </div>
                        <div class="info-customer-cart p-2">
                            <div class="row mx-0">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="status1" value="Nam" checked>
                                            <label class="form-check-label" for="status1">
                                                Anh
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="status2" value="Nữ">
                                            <label class="form-check-label" for="status2">
                                                Chị
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-5 col-lg-12">
                                    <div class="form-group">
                                        <input class="form-control name" type="text" name="name" value="{{$item->fullname??''}}" autocomplete="off" placeholder="Nhập họ tên">
                                    </div>
                                </div>
                                <div class="col-xl-5 col-lg-12">
                                    <div class="form-group">
                                        <input class="form-control phonecart1 phone" type="text" name="phone" value="{{$item->phone??''}}" id="phonecart1" autocomplete="off" placeholder="Nhập số điện thoại">
                                    </div>
                                </div>
                                <div class="col-xl-5 col-lg-12">
                                    <div class="form-group">
                                        <input class="form-control mailcart1 email" type="text" name="email" value="{{$item->email??''}}" autocomplete="off" placeholder="Nhập Email (Không bắt buộc)">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-0">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="req_export" value="Yêu cầu xuất hóa đơn" id="reqexport">
                                            <label class="form-check-label mb-0" for="">
                                                Yêu cầu xuất hóa đơn
                                            </label>
                                        </div>
                                    </div>
                                    <div class="hidden_noreqes row">
                                        <div class="form-group col-12">
                                            <div class="form-check">
                                                <input class="form-check-input identity" type="radio" name="identity" id="company" value="Công ty" checked="checked">
                                                <label class="form-check-label" for="company">
                                                    Công ty
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input identity" type="radio" name="identity" id="person" value="Cá nhân">
                                                <label class="form-check-label" for="person">
                                                    Cá nhân
                                                </label>
                                            </div>
                                        </div>
                                        <div class="company col-12">
                                            <div class="row">
                                                <div class="col-xl-5 col-lg-12">
                                                    <div class="form-group">
                                                        <input class="form-control" id="namecompany" type="text" name="namecompany" autocomplete="off" placeholder="Nhập tên công ty">
                                                    </div>
                                                </div>
                                                <div class="col-xl-5 col-lg-12">
                                                    <div class="form-group">
                                                        <input class="form-control" id="taxcode" type="text" name="taxcode" autocomplete="off" placeholder="Nhập mã số thuế">
                                                    </div>
                                                </div>
                                                <div class="col-xl-5 col-lg-12">
                                                    <div class="form-group">
                                                        <input class="form-control" type="text" id="addresscompany" name="addresscompany" autocomplete="off" placeholder="Nhập địa chỉ công ty">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="person col-12">
                                            <div class="row">
                                                <div class="col-xl-5 col-lg-12">
                                                    <div class="form-group">
                                                        <input class="form-control" type="text" id="name1" name="name1" autocomplete="off" placeholder="Nhập tên">
                                                    </div>
                                                </div>
                                                <div class="col-xl-5 col-lg-12">
                                                    <div class="form-group">
                                                        <input class="form-control phonecart2" type="text" id="phone1" name="phone1" autocomplete="off" placeholder="Nhập số điện thoại">

                                                    </div>
                                                </div>
                                                <div class="col-xl-5 col-lg-12">
                                                    <div class="form-group">
                                                        <input class="form-control" type="text" id="address1" name="address1" autocomplete="off" placeholder="Nhập địa chỉ">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="form-group">
                                        <p class="font-weight-bold chtnh">Chọn hình thức nhận hàng</p>
                                        <div class="form-check">
                                            <input class="form-check-input local-re" type="radio" name="local-re" id="re1" value="Nhận tại nhà thuốc">
                                            <label class="form-check-label" for="re1">
                                                Nhận tại nhà thuốc
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input local-re" type="radio" name="local-re" id="re2" value="Giao hàng tận nơi" checked>
                                            <label class="form-check-label" for="re2">
                                                Giao hàng tận nơi
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="de-home">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-xl-5 col-lg-12">
                                                <div class="form-group">
                                                    <input class="form-control name2" type="text" id="name2" name="name2" value="{{$item->fullname??''}}" autocomplete="off" placeholder="Nhập họ tên">
                                                </div>
                                            </div>
                                            <div class="col-xl-5 col-lg-12">
                                                <div class="form-group">
                                                    <input class="form-control phone2 phonecart3" type="text" id="phone2" name="phone2" value="{{$item->phone??''}}" autocomplete="off" placeholder="Nhập số điện thoại">
                                                </div>
                                            </div>
                                            <div class="col-xl-5 col-lg-12 marb-form">
                                                <div class="form-group form-position-relative">
                                                    <select name="city2" class="form-control choose city2 select2" id="city">
                                                        <option value="">Chọn Tỉnh/Thành phố</option>
                                                        @if(isset($item))
                                                        @foreach($itemsProvince as $key => $city)
                                                        <option value="{{$key}}" {{$item->province_id==$key? 'selected' : ''}}>{{$city}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-5 col-lg-12 marb-form">
                                                <div class="form-group form-position-relative">
                                                    <select name="district2" class="form-control choose district2 select2" id="district2">
                                                        <option value="">--Chọn quận huyện--</option>
                                                        @if(isset($item))
                                                        @foreach($itemsDistrict as $key => $district)
                                                        <option value="{{$key}}" {{$item->district_id==$key? 'selected' : ''}}>{{$district}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-10 col-lg-12 marb-form">
                                                <div class="form-group form-position-relative">
                                                    <select name="wards2" class="form-control wards2 select2" id="wards2">
                                                        <option value="">--Chọn xã phường--</option>
                                                        @if(isset($wardc))
                                                        @foreach($itemsWard as $key => $ward)
                                                        <option value="{{$key}}" {{$wardc==$key?'selected':''}}>{{$ward}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-10 col-lg-12">
                                                <div class="form-group">
                                                    <input class="form-control addressdetail2" type="text" id="addressdetail2" name="addressdetail2" autocomplete="off" placeholder="Nhập địa chỉ *">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="de-store col-12">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-xl-5 col-lg-12 marb-form">
                                                <div class="form-group">
                                                    <select name="city3" class="form-control choose city2 select2" id="city2">
                                                        <option value="">Chọn Tỉnh/Thành phố</option>
                                                        @foreach($itemsProvince as $key => $city)
                                                        <option value="{{$key}}">{{$city}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-5 col-lg-12 marb-form">
                                                <div class="form-group">
                                                    <select name="district3" class="form-control choose district2 select2" id="district3">
                                                        <option value="">Chọn Quận/Huyện</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-10">
                                                <div class="position-relative">
                                                    <p class="font-weight-bold mt-2">Có 2 nhà thuốc tại <span class="dcadrress">Hà Đông, Hà Nội</span></p>
                                                    <div class="local_drugstore d-flex justify-content-between flex-wrap">
                                                        <div class="">
                                                            <div class="form-group m-0">
                                                                <div class="form-check1 m-0">
                                                                    <input class="form-check-input dcshop" type="radio" name="dcshop" value="Tầng 01, Lô TM03, Tòa nhà CT6, Khu đô thị Văn Khê, P. La Khê,">
                                                                    <label class="form-check-label" for="">
                                                                        Tầng 01, Lô TM03, Tòa nhà CT6, Khu đô thị Văn Khê, P. La Khê, <span class="dcadrress">Hà Đông, Hà Nội</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <span class="text-success">Có hàng</span>
                                                        </div>
                                                        <div><a href="">Xem bản đồ</a></div>
                                                    </div>
                                                    <div class="local_drugstore d-flex justify-content-between flex-wrap">
                                                        <div class="">
                                                            <div class="form-group m-0">
                                                                <div class="form-check m-0">
                                                                    <input class="form-check-input dcshop" type="radio" name="dcshop" value="Tầng 01, Lô TM03, Tòa nhà CT6, Khu đô thị Văn Khê, P. La Khê,">
                                                                    <label class="form-check-label" for="">
                                                                        Số 33, Nguyễn Công Trứ <span class="dcadrress">Hà Đông, Hà Nội</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <span class="text-success">Có hàng</span>
                                                        </div>
                                                        <div><a href="">Xem bản đồ</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-12 pd800-0">
                    <div class="info-order border-radius-800">
                        <div class="title-order d-flex justify-content-center">
                            <img src="{{asset('images/shop/ode1.png')}}" alt="">
                            <h2 class="">THÔNG TIN ĐƠN HÀNG </h2>
                        </div>
                        <table>
                            <tbody>
                                <tr>
                                    <td class="pl-2 py-2">Tổng tiền</td>
                                    <td class="text-right pr-2 py-2"><span class="totalt">{{number_format($total,0,',','.')}}</span>đ</td>
                                </tr>
                                <tr>
                                    <td class="pl-2 py-2">Khuyến mãi giảm</td>
                                    <td class="text-right pr-2 py-2">10.000đ</td>
                                </tr>
                                <tr>
                                    <td class="pl-2 py-2">Phí giao dự kiến</td>
                                    <td class="text-right pr-2 py-2">0đ</td>
                                </tr>
                                <tr>
                                    <td class="pl-2 py-2 font-weight-bold">Cần thanh toán</td>
                                    <td class="text-right text-info pr-2 py-2"><span class="totaltg">{{number_format($total-10000,0,',','.')}}</span>đ</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="discount-code">
                            <h4 class="text-info d-flex justify-content-center py-2">
                                <img src="{{asset('images/shop/ode2.png')}}" alt="">
                                <a href="" class="">Sử dụng mã giảm giá</a>
                            </h4>
                            <!-- <small class="text-danger d-flex justify-content-center">
                                    <img src="{{asset('images/shop/gd1.png')}}" alt="">
                                    <span>Vui lòng nhập đầy đủ tên và số điện thoại mua hàng để áp dụng mã giảm giá</span>
                                </small> -->
                        </div>
                        <div class="cmoder">
                            @if(Session::has('user'))
                            <button value="1" class="complete_order">HOÀN TẤT ĐẶT HÀNG</button>
                            @else
                            <span class="order-noislogin">HOÀN TẤT ĐẶT HÀNG</span>
                            @endif
                            <p>Bằng cách đặt hàng, bạn đồng ý với
                                <span class="underline"> Điều khoản sử dụng </span>của T Doctor
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @else
        <div class="pt-3">
            <div class="wp-cart-null d-flex justify-content-center">
                <div class="cart-null text-center">
                    <div><img src="{{asset('images/shop/cn1.png')}}" alt=""></div>
                    <h1>Chưa có sản phẩm nào trong giỏ hàng</h1>
                    <a href="{{route('home')}}">TIẾP TỤC MUA SẮM</a>
                </div>
            </div>
        </div>
        @endif
        @else
        <div class="pt-3">
            <div class="wp-cart-null d-flex justify-content-center">
                <div class="cart-null text-center">
                    <div><img src="{{asset('images/shop/cn1.png')}}" alt=""></div>
                    <h1>Chưa có sản phẩm nào trong giỏ hàng</h1>
                    <a href="{{route('home')}}">TIẾP TỤC MUA SẮM</a>
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="new-view">
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