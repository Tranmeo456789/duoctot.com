<div class="">
    <ul class="list-item clearfix">
        <li>
            <a href="" title="">Trang chủ</a>
        </li>
        <li>
            <a href="" title="">{{parent_cat($item->catProduct->id,2)->name}}</a>
        </li>
        <li>
            <a href="" title="">{{parent_cat($item->catProduct->id)->name}}</a>
        </li>
        <li>
            <a href="" title="">{{$item->catProduct->name}}</a>
        </li>
    </ul>
</div>