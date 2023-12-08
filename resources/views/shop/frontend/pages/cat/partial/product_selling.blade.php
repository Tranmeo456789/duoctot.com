@php
 $products=$products->take(10);
@endphp
<div id="feature-product-wp">
    <div class="product-backround  mt-3 mt-lg-5 py-4">
        <div class="wp-inner">
            @include("$moduleName.templates.box_title_product",['title' => 'Sản phẩm mới','classBackground'=>'bg-danger'])
            <ul class="list-item">
                @include("$moduleName.partial.product",['items'=>$products])
            </ul>
        </div>
    </div>
</div>