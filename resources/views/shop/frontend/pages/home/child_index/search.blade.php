@php
 use App\Model\Shop\SearchModel;
 $params['limit']=6;
 $listKeywordHight=(new SearchModel)->listItems($params, ['task'=>'list-keyword-search-most']);
@endphp
<div class="form-search-inner">
    <h1>Tra Cứu Thuốc, TPCN, Bệnh lý...</h1>
    <form action="{{route('fe.search.saveHome')}}" method="POST">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <div class="position-relative">
            <input type="search" name="keyword" class="input-search-info" value="" placeholder="Nhập từ khóa...">
            <button type="submit" class="btn-search-home" name="btn_search" value="1" disabled="disabled">
                <img src="{{asset('images/shop/icon-search.png')}}" alt="">
            </button>
        </div>
    </form>
    <h5 class="mt-3 mb-2">Tra cứu hàng đầu</h5>
    @if(isset($listKeywordHight))
        <ul class="d-flex justify-content-between">
            @foreach($listKeywordHight as $val)
                <li>
                    <a>{{$val['keyword']}}</a>
                </li> 
            @endforeach     
        </ul>
    @endif
</div>