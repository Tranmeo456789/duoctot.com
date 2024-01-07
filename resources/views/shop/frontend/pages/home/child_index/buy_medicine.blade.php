@php
    use App\Model\Shop\ConfigModel;
@endphp
<h1 class="text-center">Mua thuốc dễ dàng tại TDoctor</h1>
<ul class="d-flex list-unstyled">
    <li>
        <a href="">
            <div class="d-flex justify-content-center rimg-center"><img src="{{asset('images/shop/buy1.png')}}" alt="" srcset=""></div>
            <h2>CHỤP TOA THUỐC</h1>
                <span>đơn giản & nhanh chóng</span>
        </a>
    </li>
    <li>
        <a href="">
            <div class="d-flex justify-content-center rimg-center"><img src="{{asset('images/shop/buy2.png')}}" alt="" srcset=""></div>
            <h2>NHẬP THÔNG TIN <span style="color: #375FBE;font-weight:bold;">LIÊN LẠC</span></h1>
                <span>để được tư vấn</span>
        </a>
    </li>
    <li>
        <a href="">
            <div class="d-flex justify-content-center rimg-center"><img src="{{asset('images/shop/buy3.png')}}" alt="" srcset=""></div>
            <h2>NHẬN BÁO GIÁ <span style="color: #375FBE;font-weight:bold;">TỪ DƯỢC SỸ</span></h1>
                <span>kèm theo báo giá miễn phí</span>
        </a>
    </li>
</ul>
@php
    $hotline = ConfigModel::where('name', 'hotline_duoc')->first()->content ?? '';
@endphp
<div class="text-center child_buy">
    <div class="text-center btn-buynn mb-3"><a href="{{route('fe.prescrip.index')}}">MUA THUỐC NGAY</a></div>
    <span>Hoặc mua qua hotline {{$hotline ?? '0393167234' }}</span>
</div>