<div id="feature-product-wp">
    @include("$moduleName.templates.box_title_product",['title' => 'Sản phẩm mới','featured' => true])
    <div>
        <ul class="list-item">
            @include("$moduleName.partial.product",['items'=>$products])
        </ul>
    </div>
</div>