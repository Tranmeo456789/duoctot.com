@php
    use App\Model\Shop\CatProductModel;

    $itemCatCurent = $item->catProduct;

    $params['parent_id']=$itemCatCurent['parent_id'];
    $itemCatParentLevel1=(new CatProductModel)->getItem($params,['task'=>'get-item-parent']);

    $params['up_level']=2;
    $itemCatParentLevel2=(new CatProductModel)->getItem($params,['task'=>'get-item-parent']);
@endphp
<div class="">
    <ul class="list-item clearfix">
        <li>
            <a href="{{route('home')}}">Trang chủ</a>
        </li>
        @if ($itemCatParentLevel2['parent_id'] < 1)
            <li>
                <a href="{{route('fe.cat',$itemCatParentLevel1['slug'])}}">{{$itemCatParentLevel1['name']}}</a>
            </li>
            <li>
                <a href="{{route('fe.cat2',[$itemCatParentLevel1['slug'],$itemCatCurent['slug']])}}">{{$itemCatCurent['name']}}</a>
            </li>
        @else
            <li>
                <a href="{{route('fe.cat',$itemCatParentLevel2['slug'])}}">{{$itemCatParentLevel2['name']}}</a>
            </li>
            <li>
                <a href="{{route('fe.cat2',[$itemCatParentLevel2['slug'],$itemCatParentLevel1['slug']])}}">{{$itemCatParentLevel1['name']}}</a>
            </li>
            <li>
                <a href="{{route('fe.cat3',[$itemCatParentLevel2['slug'],$itemCatParentLevel1['slug'],$itemCatCurent['slug']])}}">{{$itemCatCurent['name']}}</a>
            </li>
        @endif
    </ul>
</div>