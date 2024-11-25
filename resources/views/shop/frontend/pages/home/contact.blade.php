@extends('shop.layouts.frontend')

@section('content')
<div class="wp-inner mt-3 mt-lg-4">
    <div class="abu-cnt">
        <div class="" id="breadcrumb-wp">
            <ul class="list-item clearfix">
                <li>
                    <a href="{{route('home')}}" title="">Trang chủ</a>
                </li>
                <li>
                    <span>Liên hệ</span>
                </li>
            </ul>
        </div>
        <hr>
        <div class="contact-us">
            <h4 style="text-align: center;">Mọi chi tiết xin liên hệ</h4>
            <h6 style="text-align: center;"><strong>CÔNG TY CỔ PHẦN TDOCTOR PHARMA</strong></h6>
            <h6 style="text-align: center;"><strong>Trụ sở:</strong> Số 03, Đường Huỳnh Khương Ninh, Phường Đa Kao, Quận 1, Thành phố Hồ Chí Minh, Việt Nam</h6>
            <h6 style="text-align: center;"><strong>Văn phòng đại diện:</strong> Tầng 3, Tòa 35 Hùng Vương, P. Điện Biên, Q. Ba Đình, Hà Nội</h6>
            <h6 style="text-align: center;"><strong>Chi nhánh Cần Thơ:</strong> Số 209, Đường 30/4, Phường Xuân Khánh, Quận Ninh Kiều, Thành phố Cần Thơ</h6>
            <h6 style="text-align: center;"><strong>Email:</strong> tdoctorvn@gmail.com</h6>
            <h6 style="text-align: center;"><strong>Hotline:</strong> 0345488247 - 0393167234</h6>
            <hr>
        </div>
        <div class="info-bank">
            <div class="row">
                <div class="col-12 col-md-8">
                    <h6 style="text-align: center;"><strong>Ngân hàng Kỹ thương (Techcombank)</strong></h6>
                    <h6 style="text-align: center;"><strong>Số tài khoản: </strong>19040023026018</h6>
                    <h6 style="text-align: center;"><strong>Tên tài khoản: </strong>CONG TY CO PHAN TDOCTOR PHARMA</h6>
                </div>
                <div class="col-12 col-md-4">
                    <h6 class="text-center"><strong>Mã QR CODE</strong></h6>
                    <div class="text-center"><img style="width: 200px;" src="{{ asset('public/shop/frontend/images/shop/qrcode_techcombank.jpg') }}?v={{ time() }}"></div>
                </div>
            </div>


        </div>
    </div>
</div>
<br><br>
@endsection