<div class="">
    <ul class="list-item clearfix">
        <li>
            <a href="{{route('home')}}" title="">Trang chủ</a>
        </li>
        <li>
            <a href="{{route('fe.cat',$itemCatParentLevel2['slug'])}}">{{$itemCatParentLevel2['name']}}</a>
        </li>
        <li>
            <a href="{{route('fe.cat2',[$itemCatParentLevel2['slug'],$itemCatParentLevel1['slug']])}}">{{$itemCatParentLevel1['name']}}</a>
        </li>
        <li>
            <span>{{$itemCatCurent['name']}}</span>
        </li>
    </ul>
</div>