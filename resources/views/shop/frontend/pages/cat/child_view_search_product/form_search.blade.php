@php
    $dataHref = route('fe.product.searchListProductShort');
@endphp
<div class="wp-search pb-3 pb-lg-4">
    <div class="row">
        <h1 class="mb-2 mb-md-0 pr-4 col-12 col-md-3">Tra cứu SP</h1>
        <div class="search-product col-12 col-md-9">
            <div id="wp-search" class="wp-search-menu">
                <form action="{{route('fe.search.saveHome')}}" method="POST">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    @include("$moduleName.block.input_search",['dataHref'=>$dataHref])
                </form>
                <div class="wp-list-product-short">
                    @include("$moduleName.templates.list_product_short")
                </div>
            </div>
        </div>
    </div>
</div>