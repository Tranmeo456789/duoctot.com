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
            <a href="" title="">Trang chủ</a>
        </li>
        @if ($itemCatParentLevel2)
        <li>
            <a href="" title="">{{$itemCatParentLevel2['name']}}</a>
        </li>
        @endif
        @if ($itemCatParentLevel1['parent_id'] != '')
        <li>
            <a href="" title="">{{$itemCatParentLevel1['name']}}</a>
        </li>
        @endif
        <li>
            <a href="" title="">{{$itemCatCurent['name']}}</a>
        </li>
    </ul>
</div>