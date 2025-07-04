@extends('shop.layouts.frontend')

@section('content')
<div class="wp-inner my-3" style="height: 600px;">
    <h5>Mỗi đơn hàng hoàn thành bạn nhận thêm được <span class="text-danger font-weight-bold">10k</span> điểm tích lũy</h5>
    <div class="text-center">
        <img src="{{asset('images/shop/vuilongdangnhap.jpg')}}" alt="Vui lòng đăng nhập" style="max-width: 200px;">
    </div>
    <div><p class="text-center">Vui lòng <span class="text-danger btn btn-login" style="font-size: 25px;">Đăng nhập</span> để sử dụng chức năng</p></div>
</div>
@endsection