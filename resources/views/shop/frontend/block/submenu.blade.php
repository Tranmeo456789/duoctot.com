@php
use App\Helpers\MyFunction;
$model = new \App\Model\Shop\CatProductModel();
$modelCatalog = new \App\Model\Shop\CatalogModel();
$listCatLevel1 = $model->getCatLevel1();
$listCatAll    = $model->getAllCats();
$listCatLieuThuocTay = $modelCatalog->getCatLieuThuocTay();
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
    <li class="catc1">
        <a href="{{route('fe.lieuThuocTay')}}" class="cat1name">
            Liều thuốc tây
            <i class="fas fa-chevron-down arrow"></i>
        </a>
        <div class="content-submenu">
            <div class="row mx-0">
                <div class="px-0 col-3 right-fol">
                    <ul class="sub-menu1">
                        @foreach ($listCatLieuThuocTay as $itemCatLieuThuocTay)
                        <li>
                            <div class="himg-menu">
                                <a href="{{route('fe.post.listPostOfCat',$itemCatLieuThuocTay['name_url'])}}" class="titlec2">{{$itemCatLieuThuocTay['name']}}</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </li>
    <li class="align-self-center">
        <div class="position-relative">
            <div class="dropdown">
                <button class="btn dropdown-toggle font-weight-bold text-secondary pl-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 15px;">Danh Mục Shop</button>
                <div class="dropdown-menu dropdown-menu-right bg-light" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{route('fe.product.listDrugstore')}}"><span class="pl-2">Danh mục Nhà Thuốc Online</span></a>
                    <a class="dropdown-item" href="{{route('fe.product.listShop')}}"><span class="pl-2">Danh mục Shop chung</span></a>
                    <a class="dropdown-item" href="{{route('fe.product.listShopMomBaby')}}"><span class="pl-2">Danh mục Shop Mẹ và Bé</span></a>
                    <a class="dropdown-item" href="{{route('fe.product.listTrinhDuocVien')}}"><span class="pl-2">Danh mục Shop Trình dược viên</span></a>
                    <a class="dropdown-item" href="{{route('fe.product.listNhaCungCap')}}"><span class="pl-2">Danh mục Nhà Cung Cấp</span></a>
                    <a class="dropdown-item" href="{{route('fe.product.listPhongKham')}}"><span class="pl-2">Danh mục Phòng Khám</span></a>
                    <a class="dropdown-item" href="{{route('fe.product.listThamMyVien')}}"><span class="pl-2">Danh mục Thẩm Mỹ Viện</span></a>
                    <a class="dropdown-item" href="{{route('fe.product.listBacSi')}}"><span class="pl-2">Danh mục Bác Sĩ</span></a>                
                </div>
            </div>
        </div>
    </li>
</ul>
