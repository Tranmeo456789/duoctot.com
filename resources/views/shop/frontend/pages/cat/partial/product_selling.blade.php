<div id="feature-product-wp">
    <div class="product-backround">
        @include("$moduleName.templates.box_title_product",['title' => 'Sản phẩm mới','classBackground'=>'bg-danger'])
    </div>
    <div>
        <ul class="list-item">
            @include("$moduleName.partial.product",['items'=>$products])
        </ul>
    </div>
</div>