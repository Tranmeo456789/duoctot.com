@php
    use App\Helpers\MyFunction;
    use App\Model\Shop\CatProductModel;
    $listCatLevel1=(new CatProductModel())->listItems(['parent_id' => 1],['task'=>'frontend-list-items-by-parent-id']);
    $listCatAll=(new CatProductModel())->listItems(null, ['task'  => 'list-items-front-end']);
@endphp
<h3>
    <div class="container-menures"><a href="">Trang chủ</a></div>
</h3>
<ul>
    @foreach ($listCatLevel1 as $itemLevel1)
    @if($itemLevel1['parent_id']==1)
    <li>
        <div class="container-menures position-relative parentsmenu">
            <div class=" pr-4">
                <a href="">{{$itemLevel1['name']}}</a>
            </div>
            <div class="iconmnrhv"><img src="{{asset('images/shop/arrowd.png')}}" alt=""></div>
            <div class="submenu1res">
                <ul>
                    @foreach ($listCatAll as $itemLevel2)
                    @if ($itemLevel2['parent_id'] == $itemLevel1['id'])
                    <li><a href="">{{$itemLevel2['name']}}</a></li>
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
                <a href="">Nhà thuốc</a>
            </div>
        </div>
    </li>
    @if(Session::has('user'))
    <li>
        <div class="container-menures position-relative parentsmenu">
            <div class=" pr-4">
                <a href="{{route('dashboard')}}">Tài khoản</a>
            </div>
        </div>
    </li>
    <li>
        <div class="container-menures position-relative parentsmenu">
            <div class=" pr-4">
                <a href="{{route('user.logout')}}">Đăng xuất</a>
            </div>
        </div>
    </li>
    @else
    <li>
        <div class="container-menures position-relative parentsmenu">
            <div class=" pr-4">
                <a class="btn-register-res">Đăng ký</a>
            </div>
        </div>
    </li>
    <li>
        <div class="container-menures position-relative parentsmenu">
            <div class=" pr-4">
                <a class="btn-login-res">Đăng nhập</a>
            </div>
        </div>
    </li>
    @endif
</ul>