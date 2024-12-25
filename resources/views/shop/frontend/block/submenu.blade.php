@php
use App\Helpers\MyFunction;
use App\Model\Shop\CatProductModel;

$listCatLevel1=(new CatProductModel())->listItems(['parent_id' => 1],['task'=>'frontend-list-items-by-parent-id']);
$listCatAll=(new CatProductModel())->listItems(null, ['task'  => 'list-items-front-end']);
@endphp
<ul id="main-menu" class="d-flex list-item">
    @foreach ($listCatLevel1 as $itemLevel1)
    <li class="catc1" data-id="{{$itemLevel1['id']}}">
        <a href="{{route('fe.cat',$itemLevel1['slug'])}}" data-id="{{$itemLevel1['id']}}" data-href="{{route('ajaxHoverCatLevel1')}}" class="cat1name">
            {{$itemLevel1['name']}}
            <i class="fas fa-chevron-down arrow"></i>
        </a>
        <div class="content-submenu">
            <div class="row mx-0">
                <div class="px-0 col-3 right-fol">
                    <ul class="sub-menu1">
                        @foreach ($listCatAll as $itemLevel2)
                        @if ($itemLevel2['parent_id'] == (int)$itemLevel1['id'] )
                        <li data-id="{{$itemLevel2['id']}}" data-href="{{route('ajaxHoverCatLevel2')}}">
                            <div class="himg-menu">
                                <div class="d-flex">
                                    <div class="d-flex align-items-center pl-2">
                                        <div class="rdimg rimg-centerw"><img src="{{asset($itemLevel2['image'])}}" alt="tdoctor"></div>
                                    </div>
                                    <a href="{{route('fe.cat2',[$itemLevel1['slug'],$itemLevel2['slug']])}}" title="" class="titlec2">{{$itemLevel2['name']}}</a>
                                </div>
                            </div>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
                <div class="col-9 px-0 content-submenu-right">
                    <div class="sub-menu2 ">
                        <div class="cat_detail list_cat_level3_products">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>
    @endforeach
    <!-- <li class="">
        <a href="{{route('fe.product.listDrugstore')}}">@lang('lang.pharmacy')</a>
    </li>
    <li class="">
        <a href="{{route('fe.product.listShop')}}">@lang('lang.shop')</a>
    </li> -->
    <li>
        <a href="{{route('fe.booking_online')}}">@lang('lang.onlinebooking')</a>
    </li>
    <li>
        <a href="{{route('fe.post')}}">Góc Sức Khỏe</a>
    </li>
    <li class="align-self-center">
        <div class="position-relative">
            <div class="dropdown">
                <button class="btn dropdown-toggle font-weight-bold text-secondary pl-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Danh Mục Shop</button>
                <div class="dropdown-menu dropdown-menu-right bg-light" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{route('fe.product.listDrugstore')}}"><span class="pl-2">Danh mục Nhà Thuốc Online</span></a>
                    <a class="dropdown-item" href="{{route('fe.product.listShop')}}"><span class="pl-2">Danh mục Shop chung</span></a>
                    <a class="dropdown-item" href="{{route('fe.product.listShopMomBaby')}}"><span class="pl-2">Danh mục Shop Mẹ và Bé</span></a>
                    <a class="dropdown-item" href="{{route('fe.product.listTrinhDuocVien')}}"><span class="pl-2">Danh mục Shop Trình dược viên</span></a>
                </div>
            </div>
        </div>
    </li>
</ul>
