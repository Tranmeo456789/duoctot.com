@php
use App\Helpers\MyFunction;
use App\Model\Shop\CatProductModel;
$listCatLevel1=(new CatProductModel())->listItems(['parent_id' => 1],['task'=>'frontend-list-items-by-parent-id']);
$listCatAll=(new CatProductModel())->listItems(null, ['task' => 'list-items-front-end']);
$iconZalo=asset('images/shop/zalo-2.png');
$iconCall=asset('images/shop/icon-call.png');
$phoneContact=$phoneContact??'0393167234';
@endphp
<h3>
    <div class="container-menures"><a href="{{route('home')}}">Trang chủ</a></div>
</h3>
<ul>
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
                <a>Danh Mục Shop</a>
            </div>
            <div class="iconmnrhv"><img src="{{asset('images/shop/arrowd.png')}}" alt=""></div>
            <div class="submenu1res">
                <ul>
                    <li><a href="{{route('fe.product.listDrugstore')}}">Danh mục Nhà Thuốc Online</a></li>
                    <li><a href="{{route('fe.product.listShop')}}">Danh mục Shop chung</a></li>
                    <li><a href="{{route('fe.product.listShopMomBaby')}}">Danh mục Shop Mẹ và Bé</a></li>
                    <li><a href="{{route('fe.product.listTrinhDuocVien')}}">Danh mục Shop Trình dược viên</a></li>
                    <li><a href="{{route('fe.product.listNhaCungCap')}}">Danh mục Nhà Cung Cấp</a></li>
                </ul>
            </div>
        </div>
    </li>
    <li class="">
        <div class="container-menures position-relative parentsmenu">
            <a href="https://tdoctor.vn/booking-online">@lang('lang.onlinebooking')</a>
        </div>
    </li>
    <li>
        <div class="container-menures position-relative parentsmenu">
            <div class="pr-4">
                <a href="{{route('fe.post')}}">Góc Sức Khỏe</a>
            </div>
        </div>
    </li>
    <li>
        <div class="container-menures position-relative parentsmenu">
            <div class=" pr-4">
                <a>Thương hiệu</a>
            </div>
            <div class="iconmnrhv"><img src="{{asset('images/shop/arrowd.png')}}" alt=""></div>
            <div class="submenu1res">
                <ul>
                    <li><a href="{{route('fe.search.viewHome', ['keyword' => 'pfizer'])}}">Pfizer</a></li>
                    <li><a href="{{route('fe.search.viewHome', ['keyword' => 'astrazeneca'])}}">Astrazeneca</a></li>
                    <li><a href="{{route('fe.search.viewHome', ['keyword' => 'sanofi'])}}">Sanofi</a></li>
                    <li><a href="{{route('fe.search.viewHome', ['keyword' => 'GSK'])}}">GSK</a></li>
                    <li><a href="{{route('fe.search.viewHome', ['keyword' => 'Mekophar'])}}">Mekophar</a></li>
                    <li><a href="{{route('fe.search.viewHome', ['keyword' => 'Novartis'])}}">Novartis</a></li>
                    <li><a href="{{route('fe.search.viewHome', ['keyword' => 'trungson'])}}">TRUNGSON HEALTHCARE</a></li>
                    <li><a href="{{route('fe.search.viewHome', ['keyword' => 'NOHTUS'])}}">NOHTUS</a></li>
                </ul>
            </div>
        </div>
    </li>
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
        <div class="container-menures parentsmenu pb-2">
            <p><small>Trải nghiệm tốt hơn với ứng dụng TDOCTOR</small></p>
            <div class="btn btn-primary btn-sm rounded m-0 p-1">
                <a href="{{route('fe.home.downloadAppTdoctor')}}" style="font-size: 14px;line-height: 10px;" class="text-light font-weight-bold px-2">↓ TẢI NGAY</a>
            </div>
        </div>
    </li>
    <li class="mt-3 pb-3">
        <p class='mb-2'>Nhận tư vấn miễn phí</p>
        <div>
            <a href='https://zalo.me/{{$phoneContact}}' target='_blank'>
                <div class='d-flex align-items-center'>
                    <div class='icon-contact'><img alt='Zalo' src='{{$iconZalo}}'></div>
                    <span>Liên hệ Zalo(<span class="font-weight-bold text-danger">0393.167.234</span>)</span>
                </div>
            </a>
            <a href='tel:{{$phoneContact}}'>
                <div class='d-flex align-items-center'>
                    <div class='icon-contact'><img alt='Zalo' src='{{$iconCall}}'></div>
                    <span>Gọi điện(<span class="font-weight-bold text-danger">0393.167.234</span>)</span>
                </div>
            </a>
        </div>
    </li>
</ul>