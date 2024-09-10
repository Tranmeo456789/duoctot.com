@php
use App\Helpers\MyFunction;
use App\Model\Shop\CatProductModel;

$listCatLevel1=(new CatProductModel())->listItems(['parent_id' => 1],['task'=>'frontend-list-items-by-parent-id']);
$listCatAll=(new CatProductModel())->listItems(null, ['task'  => 'list-items-front-end']);
@endphp
<ul id="main-menu" class="d-flex list-item">
    <li>
        <a href="{{route('home')}}" style="padding: 15px;font-size:20px">
            <i class="fas fa-home"></i>
        </a>
    </li>
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
    <li class="">
        <a href="https://tdoctor.vn/danh-sach-nha-thuoc" target="_blank">Nhà thuốc</a>
    </li>
    <li class="">
        <a href="{{route('fe.product.listShop')}}" target="_blank">Shop</a>
    </li>
    <li>
        <a href="{{route('fe.booking_online')}}">@lang('lang.onlinebooking')</a>
    </li>
</ul>