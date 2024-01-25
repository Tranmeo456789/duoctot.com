@php
 $iconZalo=asset('images/shop/zalo-2.png');
 $iconCall=asset('images/shop/icon-call.png');
 $phoneContact=$phoneContact??'0349444164';
@endphp
<div>
    <h6 class='mb-2'>Sđt liên hệ: {{implode('.', str_split($phoneContact, 4))}}</h6>
    <div>
        <a href='https://zalo.me/{{$phoneContact}}' target='_blank'>
            <div class='d-flex align-items-center'>
                <div class='icon-contact'><img alt='Zalo' src='{{$iconZalo}}'></div>
                <span>Liên hệ Zalo</span>
            </div>
        </a>
        <a href='tel:{{$phoneContact}}'>
            <div class='d-flex align-items-center'>
                <div class='icon-contact'><img alt='Zalo' src='{{$iconCall}}'></div>
                <span>Gọi điện</span>
            </div>
        </a>
    </div>
</div>