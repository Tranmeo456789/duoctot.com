
<div class="position-relative">
<div class="d-flex header-box-search">
    <span class="icon-back-search"><i class="fas fa-arrow-left"></i></span>
    <div class="position-relative" style="flex: auto">
        <form action="{{route('fe.search.saveHome')}}" method="POST">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div class="d-flex">
                <div class="wp-input-search input-search-small">
                    <input type="text" name="keyword" class="input-search-info" value="{{$keyword??''}}" placeholder="Nhập tìm thuốc, TPCN, bệnh lý..." autocomplete="off">
                </div>
                <div class="wp-btn-search">
                    <button type="submit" class="btn-search-respon btn-search-home btn" name="btn_search" value="1" disabled="disabled">
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
