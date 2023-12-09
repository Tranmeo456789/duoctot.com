@php
$objectProducts=[
    ['name'=>'Hàng mới','slug'=>'hang_moi'],
    ['name'=>'Bán chạy','slug'=>'ban_chay'],
    ['name'=>'Giá cao','slug'=>'gia_cao'],
    ['name'=>'Giá thấp','slug'=>'gia_thap']
]
@endphp
<div class="title-product-out d-flex justify-content-between flex-wrap">
    @include("$moduleName.templates.box_title_product",['title' => 'Sản phẩm nổi bật'])
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
    @include("$moduleName.templates.select_filter_product",['items'=>$objectProducts])
</div> 
<div class="body-nb wp_product-horizontal parent-btn-view-add">
    <ul class="ls_product-view-add">
        @include("$moduleName.pages.cat.partial.product_horizontal",['items'=>$products])
    </ul>
    @include("$moduleName.block.btn_view_add",['type'=>'product_cat_horizontal','countProduct'=>$couterSumProduct,'idCat'=>$itemCatCurent['id']])
</div>
<div id="body-nbox" class="parent-btn-view-add">
    <ul class="clearfix ls_product-view-add">
        @include("$moduleName.pages.cat.partial.product",['items'=>$products])
    </ul>
    @include("$moduleName.block.btn_view_add",['type'=>'product_cat','countProduct'=>$couterSumProduct,'idCat'=>$itemCatCurent['id']])
</div>

