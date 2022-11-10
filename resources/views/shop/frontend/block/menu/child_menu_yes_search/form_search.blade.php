
<form action="{{route('fe.search.saveHome')}}" method="POST">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <div class="d-flex">
        <div class="wp-input-search">
            <input type="text" name="keyword" class="input-search-info" value="{{$keyword??''}}" placeholder="Nhập tìm thuốc, TPCN, bệnh lý..." autocomplete="off">
        </div>
        <div class="wp-btn-search">
            <button type="submit" class="btn-search-home btn" name="btn_search" value="1" disabled="disabled">
                <img src="{{asset('images/shop/icon-search.png')}}" alt="">
            </button>
        </div>
    </div>
</form>
<div class="data-history">
@include("$moduleName.block.menu.child_menu_yes_search.list_history_keyword")
</div>
