@php
use App\Model\Shop\ConfigModel;
@endphp
<h6 class="text-center">Mua thuốc dễ dàng tại TDoctor</h6>
<ul class="d-flex list-unstyled">
    <li>
        <div class="d-flex justify-content-center rimg-center mb-1"><img src="{{asset('images/shop/buy1.png')}}" alt="tdoctor" srcset=""></div>
        <span>CHỤP TOA THUỐC</span>
    </li>
    <li>
        <div class="d-flex justify-content-center rimg-center mb-1"><img src="{{asset('images/shop/buy2.png')}}" alt="tdoctor"></div>
        <span>NHẬP THÔNG TIN LIÊN HỆ</span>
    </li>
    <li>
        <div class="d-flex justify-content-center rimg-center mb-1"><img src="{{asset('images/shop/buy3.png')}}" alt="tdoctor"></div>
        <span>NHẬN BÁO GIÁ TỪ DƯỢC SỸ</span>
    </li>
</ul>
@php
$hotline = ConfigModel::where('name', 'hotline_duoc')->first()->content ?? '';
@endphp
<div class="text-center child_buy">
    <div class="text-center btn-buynn mb-3"><a href="{{route('fe.prescrip.index')}}">MUA THUỐC NGAY</a></div>
    <span>Hoặc mua qua hotline <a href="tel:0349444164" class="font-weight-bold" style="font-size: 30px;">{{$hotline ?? '0393167234' }}</a></span>
</div>