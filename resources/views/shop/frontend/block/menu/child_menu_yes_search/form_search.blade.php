@php
    $dataHref = route('fe.product.searchListProductShort');
@endphp
<div class="position-relative wp-search-list-product">
    <form action="{{route('fe.search.saveHome')}}" method="POST">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <div class="d-flex">
            <div class="wp-input-search fc-search-js form-search-show-list input input-search-small">
                <input type="text" name="keyword" class="input-search-info" data-href="{{$dataHref}}" value="{{$keyword??''}}" placeholder="Nhập tìm thuốc, TPCN, bệnh lý..." autocomplete="off">
            </div>
            <div class="btn-load-delete">
                <i class="fas fa-spinner fa-spin" style="display: none;"></i>
                <span class="clear-keyword" style="display: none;">X</span>
            </div>
            <div class="wp-btn-search">
                <button type="submit" class="btn-search-home btn" name="btn_search" value="1">
                    <img src="{{asset('images/shop/icon-search.png')}}" alt="">
                </button>
            </div>
        </div>
    </form>
    <div class="data-history">
    @include("$moduleName.block.menu.child_menu_yes_search.list_history_keyword")
    </div>
</div>

