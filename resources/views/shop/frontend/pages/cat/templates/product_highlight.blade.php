@php
$objectProducts=[
        ['name'=>'Hàng mới','slug'=>'hang_moi'],
        ['name'=>'Giá thấp','slug'=>'gia_thap'],
        ['name'=>'Giá cao','slug'=>'gia_cao']
    ];
    $urlAjax=route('fe.cat.filterProduct');
@endphp
<div id="wp-product-cat">
    <div class="title-product-out d-flex justify-content-between flex-wrap">
        @include("$moduleName.templates.box_title_product",['title' => 'Danh sách sản phẩm'])
        <div>
        <div class="fitter-wp d-flex">
            <div class="seclect_ol d-flex">
                <a class="ol1 activebtn"><img src="{{asset('images/shop/v4.png')}}" alt=""></a>
                <a class="ol2"><img src="{{asset('images/shop/3ngang.png')}}" alt=""></a>
            </div>
        </div>
    </div>
    </div>
    <div class="mb-2">
        @include("$moduleName.templates.select_filter_product",['items'=>$objectProducts,'typeOrderBy'=>'hang_moi','urlAjax'=>$urlAjax])
    </div>
    <div id="body-nbox" class="parent-btn-view-add">
        @include("$moduleName.pages.$controllerName.templates.list_product",['items'=>$products,'countProduct'=>$couterSumProduct,'idCat'=>$itemCatCurent['id']])
    </div>
</div>