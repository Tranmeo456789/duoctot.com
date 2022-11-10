@php
use App\Model\Shop\SearchModel;
$params['limit']=6;
$listKeywordHight=(new SearchModel)->listItems($params, ['task'=>'list-keyword-search-most']);
$listKeywordHistory=[];
if(isset($_COOKIE["keywordHistory"])){
    $listKeywordHistory=json_decode($_COOKIE["keywordHistory"],true);
}
@endphp
<form action="{{route('fe.search.saveHome')}}" method="POST">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <div class="d-flex">
        <div class="wp-input-search">
            <input type="text" name="keyword" class="input-search-info" value="{{$keyword??''}}" placeholder="Nhập tìm thuốc, TPCN, bệnh lý...">
        </div>
        <div class="wp-btn-search">
            <button type="submit" class="btn-search-home btn" name="btn_search" value="1" disabled="disabled">
                <img src="{{asset('images/shop/icon-search.png')}}" alt="">
            </button>
        </div>
    </div>
</form>
<div class="ls-history">
    @if(count($listKeywordHistory) >0)
    <div class="ls-historySuggest">
        <div class="title-history">
            <div class="font-weight-bold">Lịch sử tìm kiếm</div>
            <span class="font-weight-bold text-primary delete-history-keyword" data-href="{{route('fe.deleteHistory')}}">Xóa tất cả</span>
        </div>
        <ul class="ls-history-search">
            @foreach($listKeywordHistory as $val)
             <li><a href="">{{$val['keyword']}}</a></li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="top-keyword">
        <div class="title-top-keyword d-flex">
            <div class="font-weight-bold">Tìm Kiếm Hàng Đầu</div>
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