@php
    $dataHref = route('fe.product.searchListProductShort');
    use App\Model\Shop\SearchModel;
    $params['limit']=6;
    $listKeywordHight=(new SearchModel)->listItems($params, ['task'=>'list-keyword-search-most']);
    $listKeywordHistory=[];
    if(isset($_COOKIE["keywordHistory"])){
        $listKeywordHistory=json_decode($_COOKIE["keywordHistory"],true);
    }
@endphp
<div class="position-relative wp-search-list-product">
    <form action="{{route('fe.search.saveHome')}}" method="GET">
        <div class="d-flex">
            <div class="wp-input-search fc-search-js form-search-show-list input input-search-small">
                <input type="text" name="keyword" class="input-search-info" data-href="{{$dataHref}}" value="{{$keyword??''}}" placeholder="Nhập tìm theo tên hoặc công dụng..." autocomplete="off">
            </div>
            <div class="btn-load-delete">
                <i class="fas fa-spinner fa-spin" style="display: none;"></i>
                <span class="clear-keyword" style="display: none;">X</span>
            </div>
            <div class="wp-btn-search">
                <button type="submit" class="btn-search-home btn" name="btn_search" value="1">
                    <img src="{{asset('images/shop/icon-search.png')}}" alt="tdoctor" loading="lazy" width="52" height="52" decoding="async">
                </button>
            </div>
        </div>
    </form>
</div>
<div class="top-keyword">
    @if(isset($listKeywordHight))
    <div class="ls-top-keyword">
        @foreach($listKeywordHight as $val)
        <a href="{{route('fe.search.viewHome',$val['keyword'])}}">{{$val['keyword']}}</a>
        @endforeach
    </div>
    @endif
</div>

