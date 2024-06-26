
<div class="">
    <ul class="list-item clearfix">
        <li>
            <a href="{{route('home')}}">Trang chủ</a>
        </li>
        <li>
            <a href="{{route('fe.cat',$itemCatParent['slug'])}}">{{$itemCatParent['name']}}</a>
        </li>
        <li>
            <span>{{$itemCatCurent['name']}}</span>
        </li>
    </ul>
</div>