@php
use App\Model\Shop\SearchModel;
$params['limit']=6;
$listKeywordHight=(new SearchModel)->listItems($params, ['task'=>'list-keyword-search-most']);
$dataHref = route('fe.product.searchListProductShort');

@endphp
<div class="form-search-inner">
    <h1>Tra Cứu Thuốc, TPCN, Bệnh lý...</h1>
    <div class="position-relative">
        <form action="{{route('fe.search.saveHome')}}" method="POST">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div class="position-relative">
                <div class="wp-input-search">
                    <input type="text" name="keyword" class="input-search-info" data-href="{{$dataHref}}" value="" placeholder="Nhập từ khóa..." autocomplete="off">
                </div>
                <button type="submit" class="btn-search-home" name="btn_search" value="1" disabled="disabled">
                    <img src="{{asset('images/shop/icon-search.png')}}" alt="">
                </button>
            </div>
        </form>
        <div class="data-history">
            @include("$moduleName.block.menu.child_menu_yes_search.list_history_keyword")
        </div>
    </div>


    <h5 class="mt-3 mb-2">Tra cứu hàng đầu</h5>
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