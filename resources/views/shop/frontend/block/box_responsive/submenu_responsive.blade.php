@php
use App\Helpers\MyFunction;
use App\Model\Shop\CatProductModel;
$listCatLevel1=(new CatProductModel())->listItems(['parent_id' => 1],['task'=>'frontend-list-items-by-parent-id']);
$listCatAll=(new CatProductModel())->listItems(null, ['task' => 'list-items-front-end']);
$iconZalo=asset('images/shop/zalo-2.png');
$iconCall=asset('images/shop/icon-call.png');
$phoneContact=$phoneContact??'0349444164';
@endphp
<h3>
    <div class="container-menures"><a href="{{route('home')}}">Trang chủ</a></div>
</h3>
<ul>
    @if(Session::has('user') && isset(Session::get('user')['user_id']) && Session::get('user')['user_id'] != 1124149617)
        @foreach ($listCatLevel1 as $itemLevel1)
            @if($itemLevel1['parent_id']==1)
            <li>
                <div class="container-menures position-relative parentsmenu">
                    <div class=" pr-4">
                        <a href="{{route('fe.cat',$itemLevel1['slug'])}}">{{$itemLevel1['name']}}</a>
                    </div>
                    <div class="iconmnrhv"><img src="{{asset('images/shop/arrowd.png')}}" alt=""></div>
                    <div class="submenu1res">
                        <ul>
                            @foreach ($listCatAll as $itemLevel2)
                            @if ($itemLevel2['parent_id'] == $itemLevel1['id'])
                            <li><a href="{{route('fe.cat2',[$itemLevel1['slug'],$itemLevel2['slug']])}}">{{$itemLevel2['name']}}</a></li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </li>
            @endif
        @endforeach
        <li>
            <div class="container-menures position-relative parentsmenu">
                <div class=" pr-4">
                    <a href="{{route('fe.product.listDrugstore')}}">@lang('lang.pharmacy')</a>
                </div>
            </div>
        </li>
        <li>
            <div class="container-menures position-relative parentsmenu">
                <div class=" pr-4">
                    <a href="{{route('fe.product.listShop')}}">@lang('lang.shop')</a>
                </div>
            </div>
        </li>
        <li class="">
            <div class="container-menures position-relative parentsmenu">
                <a href="https://tdoctor.vn/booking-online">@lang('lang.onlinebooking')</a>
            </div>
        </li>
    @endif
    @if(Session::has('user'))
    <li>
        <div class="container-menures position-relative parentsmenu">
            <div class=" pr-4">
                <a href="{{route('dashboard')}}">@lang('lang.account')</a>
            </div>
        </div>
    </li>
    <li>
        <div class="container-menures position-relative parentsmenu">
            <div class=" pr-4">
                <a href="{{route('user.logout')}}">@lang('lang.log_out')</a>
            </div>
        </div>
    </li>
    @else
    <li>
        <div class="container-menures position-relative parentsmenu">
            <div class=" pr-4">
                <a class="btn-register-res">@lang('lang.register')</a>
            </div>
        </div>
    </li>
    <li>
        <div class="container-menures position-relative parentsmenu">
            <div class=" pr-4">
                <a class="btn-login-res">@lang('lang.login')</a>
            </div>
        </div>
    </li>
    @endif
    <li>
        <div class="container-menures position-relative parentsmenu">
            <div class="pr-4">
                <a href="{{route('fe.post')}}">Tin tức</a>
            </div>
        </div>
    </li>
    <li class="mt-3 pb-3">
        <p class='mb-2'>Nhận tư vấn miễn phí</p>
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
    </li>
</ul>