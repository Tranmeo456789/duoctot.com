@php
 $iconZalo=asset('images/shop/zalo-2.png');
 $iconCall=asset('images/shop/icon-call.png');
 $phoneContact=$phoneContact??'0393167234';
@endphp
<div>
    <h6 class='mb-2'>Sđt liên hệ: {{implode('.', str_split($phoneContact, 4))}}</h6>
    <div>
        <a href='https://zalo.me/{{$phoneContact}}' target='_blank'>
            <div class='d-flex align-items-center'>
                <div class='icon-contact'><img alt='Zalo' src='{{$iconZalo}}' loading="lazy" width="30" height="30" decoding="async"></div>
                <span>Liên hệ Zalo</span>
            </div>
        </a>
        <a href='tel:{{$phoneContact}}'>
            <div class='d-flex align-items-center'>
                <div class='icon-contact'><img alt='Zalo' src='{{$iconCall}}' loading="lazy" width="30" height="30" decoding="async"></div>
                <span>Gọi điện</span>
            </div>
        </a>
    </div>
</div>