@php
use App\Model\Shop\SearchModel;
$params['limit']=6;
$listKeywordHight=(new SearchModel)->listItems($params, ['task'=>'list-keyword-search-most']);
$dataHref = route('fe.product.searchListProductShort');

@endphp
<div class="form-search-inner">
    <!-- <h6>@lang('lang.search_for_drugs')...</h6> -->
    <div class="position-relative wp-search-list-product">
        <form action="{{route('fe.search.saveHome')}}" method="POST">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div class="position-relative">
                <div class="wp-input-search fc-search-js form-search-show-list form-search-scroll form-search-show-list">
                    <input type="text" name="keyword" class="input-search-info" data-href="{{$dataHref}}" value="" placeholder="@lang('lang.search_for_drugs')..." autocomplete="off">
                </div>
                <div class="btn-load-delete">
                    <i class="fas fa-spinner fa-spin" style="display: none;"></i>
                    <span class="clear-keyword" style="display: none;">X</span>
                </div>
                <button type="submit" class="btn-search-home" name="btn_search" value="1">
                    <img src="{{asset('images/shop/icon-search.png')}}" alt="tdoctor" loading="lazy" width="20" height="20" decoding="async">
                </button>
            </div>
        </form>
        <div class="data-history">
            @include("$moduleName.block.menu.child_menu_yes_search.list_history_keyword")
        </div>
    </div>


    <h5 class="mt-3 mb-2">@lang('lang.top_search')</h5>
    @if(isset($listKeywordHight))
    <ul class="d-flex justify-content-between list-hight-home">
        @foreach($listKeywordHight as $val)
        <li>
            <a href="{{route('fe.search.viewHome',$val['keyword'])}}">{{$val['keyword']}}</a>
        </li>
        @endforeach
    </ul>
    @endif
</div>