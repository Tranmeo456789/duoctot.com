@php
    $dataHref = route('fe.product.searchListProductShort');
@endphp
<div class="position-relative wp-search-list-product size-mobile">
    <div class="d-flex header-box-search">
        <span class="icon-back-search"><i class="fas fa-arrow-left"></i></span>
        <div class="position-relative" style="flex: auto">
            <form action="{{route('fe.search.saveHome')}}" method="POST">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="d-flex">
                    <div class="wp-input-search fc-search-js input form-search-show-list input-search-small">
                        <input type="text" name="keyword" class="input-search-info" data-href="{{$dataHref}}" value="{{$keyword??''}}" placeholder="Nhập tìm kiếm theo tên hoặc công dụng..." autocomplete="off">
                    </div>
                    <div class="btn-load-delete">
                        <i class="fas fa-spinner fa-spin" style="display: none;"></i>
                        <span class="clear-keyword" style="display: none;">X</span>
                    </div>
                    <div class="wp-btn-search">
                        <button type="submit" class="btn-search-respon btn-search-home btn" name="btn_search" value="1">
                            <img src="{{asset('images/shop/icon-search.png')}}" alt="">
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="data-history">
        @include("shop.frontend.block.menu.child_menu_yes_search.list_history_keyword")
    </div>
</div>
