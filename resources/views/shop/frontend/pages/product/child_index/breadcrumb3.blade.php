<div class="">
    <ul class="list-item clearfix">
        <li>
            <a href="{{route('home')}}" title="">Trang chủ</a>
        </li>
        <li>
            <a href="" title="">{{parent_cat($catc1->id)->name}}</a>
        </li>
        <li>
            <a href="" title="">{{$catc1['name']}}</a>
        </li>
    </ul>
</div>