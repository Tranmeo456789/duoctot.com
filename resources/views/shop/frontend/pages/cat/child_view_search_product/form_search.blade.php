<div class="wp-search pb-3 pb-lg-4">
    <div class="row">
        <h1 class="mb-2 mb-md-0 pr-4 col-12 col-md-3">Tra cứu thuốc</h1>
        <div class="search-product col-12 col-md-9">
            <div class="wp-search-menu">
                <form action="{{route('fe.search.saveHome')}}" method="POST">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <div class="d-flex">
                        <div class="wp-input-search-simple input-search-small">
                            <input type="text" name="keyword" class="input-search-info" data-href="{{route('fe.product.searchListProductShort')}}" value="{{$keyword??''}}" placeholder="Nhập tên thuốc cần tim..." autocomplete="off">
                        </div>
                        <div class="wp-btn-search">
                            <button type="submit" class="btn-search-home btn" name="btn_search" value="1" disabled="disabled">
                                <img src="{{asset('images/shop/search_blue.png')}}" alt="">
                            </button>
                        </div>
                    </div>
                </form>
                <div class="wp-list-product-short">
                    @include("$moduleName.templates.list_product_short")
                </div>
            </div>
        </div>
    </div>
</div>