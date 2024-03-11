@if(count($items)>0)
<ul class="clearfix ls_product-view-add">
    @include("$moduleName.pages.cat.partial.product",['items'=>$items])
</ul>
@include("$moduleName.block.btn_view_add",['type'=>'product_cat','countProduct'=>$countProduct,'idCat'=>$idCat])
@else
    <div class="text-center mt-5">Danh sách sản phẩm trống!</div>
@endif