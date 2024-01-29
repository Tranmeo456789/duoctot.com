@php
use App\Model\Shop\SearchModel;
$params['limit']=6;
$listKeywordHight=(new SearchModel)->listItems($params, ['task'=>'list-keyword-search-most']);
$listKeywordHistory=[];
if(isset($_COOKIE["keywordHistory"])){
    $listKeywordHistory=json_decode($_COOKIE["keywordHistory"],true);
}
@endphp
<div class="ls-history">
    <div class="wp-list-product-short">
        @include("$moduleName.templates.list_product_short")
    </div>
    @if(count($listKeywordHistory) >0)
    <div class="ls-historySuggest">
        <div class="title-history">
            <div class="font-weight-bold pl-1"><span class="mr-1 text-secondary"><i class="fas fa-history"></i></span> Lịch sử tìm kiếm</div>
            <span class="font-weight-bold text-primary delete-history-keyword" data-href="{{route('fe.deleteHistory')}}">Xóa tất cả</span>
        </div>
        <ul class="ls-history-search">
            @foreach($listKeywordHistory as $val)
             <li><a href="{{route('fe.search.viewHome',$val['keyword'])}}">{{$val['keyword']}}</a></li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="top-keyword">
        <div class="title-top-keyword d-flex">
            <div class="font-weight-bold pl-1"><span class="mr-1 text-danger"><i class="fas fa-paper-plane"></i></span>Tìm Kiếm Hàng Đầu</div>
            <p class="line-horizontal"></p>
        </div>
        @if(isset($listKeywordHight))
        <div class="ls-top-keyword">
            @foreach($listKeywordHight as $val)
            <a href="{{route('fe.search.viewHome',$val['keyword'])}}">{{$val['keyword']}}</a>
            @endforeach
        </div>
        @endif
    </div>
</div>