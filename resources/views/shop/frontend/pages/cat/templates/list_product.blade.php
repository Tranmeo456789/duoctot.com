<ul class="clearfix ls_product-view-add">
    @include("$moduleName.pages.cat.partial.product",['items'=>$items])
</ul>
@include("$moduleName.block.btn_view_add",['type'=>'product_cat','countProduct'=>$countProduct,'idCat'=>$idCat])