<style>
    .cat-level1-duoctot {
    position: relative; 
}
.cat-level1-duoctot .content-submenu-duoctot {
    display: none;
    position: absolute;
    top: 100%;     
    right: -400px;
    background: #faf8f8;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    z-index: 999;
    padding: 10px 0;
}
.cat-level1-duoctot:hover .content-submenu-duoctot {
    display: block;
}
.cat-level1-duoctot:hover > a {
    
}
.arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    right: 2px;
    font-size: 10px;
}
.content-submenu-duoctot a{
    font-size: 16px;
    line-height: 20px;
    color: #1E1E1E;
    padding: 5px;
    display: block;
}
</style>
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
    <li class="cat-level1-duoctot">
        <a href="{{route('fe.post')}}">
            Blog
            <i class="fas fa-chevron-down arrow"></i>
        </a>
        <div class="content-submenu-duoctot" style="width: 700px;">
            <div class="row mx-0">
                <div class="col-6 px-0">
                    <a class="" href="{{route('fe.lieuThuocTay')}}">
                        <span class="pl-2">Cắt liều thuốc tây</span>
                    </a>
                </div>
                @foreach ($listCatLieuThuocTay->chunk(2) as $pair)
                    @foreach ($pair as $item)
                    <div class="col-6 px-0">
                        <a class="" href="{{route('fe.post.listPostOfCat',$item['name_url'])}}">
                            <span class="pl-2">{{ $item['name'] }}</span>
                        </a>
                    </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </li>
    <!-- <li class="align-self-center">
        <div class="position-relative">
            <div class="dropdown">
                <button class="btn dropdown-toggle font-weight-bold text-secondary pl-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 15px;">Cắt Liều Thuốc Tây</button>
                <div class="dropdown-menu dropdown-menu-right bg-light" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item font-weight-bold" href="{{route('fe.lieuThuocTay')}}"><span class="pl-2">Cắt Liều Thuốc Tây</span></a>
                    @foreach ($listCatLieuThuocTay as $itemCatLieuThuocTay)
                        <a class="dropdown-item" href="{{route('fe.post.listPostOfCat',$itemCatLieuThuocTay['name_url'])}}"><span class="pl-2">{{$itemCatLieuThuocTay['name']}}</span></a>
                    @endforeach
                </div>
            </div>
        </div>
    </li> -->
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
                    <a class="dropdown-item" href="{{route('fe.product.listDuocSi')}}"><span class="pl-2">Danh mục Dược Sĩ</span></a>                
                    <a class="dropdown-item" href="{{route('fe.product.listBenhVien')}}"><span class="pl-2">Danh mục Bệnh Viện</span></a>                
                </div>
            </div>
        </div>
    </li>
</ul>
