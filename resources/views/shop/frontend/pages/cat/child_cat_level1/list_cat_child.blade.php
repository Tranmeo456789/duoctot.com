@php
use App\Model\Shop\CatProductModel;
use App\Model\Shop\ProductModel;

$listCatAll=(new CatProductModel())->listItems(null, ['task'  => 'list-items-front-end']);
@endphp
<div class="title-cat d-flex">
    <div class="icon-cat-product">
        <img src="{{asset('images/shop/vuongwin.png')}}" alt="">
    </div>
    <h1>{{$itemCatCurent['name']}}</h1>
</div>
<div class="body-cat-product">
    <ul class="clearfix">
        @foreach($listCatAll as $itemLevel2)
        @if($itemCatCurent['id']==$itemLevel2['parent_id'])
        @php
            $countProduct=(new ProductModel())->countItems(['cat_product_id'=> $itemLevel2['id']],['task' => 'count-number-product-in-cat']);
        @endphp
        <li class="">
            <div class="d-flex">
                <div class="item-cat-left text-center">
                    <a href="{{route('fe.cat2',[$itemCatCurent['slug'],$itemLevel2['slug']])}}">
                        <div><img src="{{asset($itemLevel2['image'])}}" alt="" style="width:70%"></div>
                        <h3>{{$itemLevel2['name']}}</h3>
                        <span>{{$countProduct}} sản phẩm</span>
                    </a>
                </div>
                @php
                    $temp=0;
                @endphp
                @foreach($listCatAll as $itemLevel3)
                @if($itemLevel2['id'] == $itemLevel3['parent_id'])
                @php
                    $temp++;
                @endphp
                @endif
                @endforeach
                <div class="item-cat-right">
                    @if($temp < 6 )
                    <ul>
                        @foreach($listCatAll as $itemLevel3)
                        @if($itemLevel2['id'] == $itemLevel3['parent_id'])
                        <li><a href="{{route('fe.cat2',[$itemCatCurent['slug'],$itemLevel2['slug'],$itemLevel3['slug']])}}">{{$itemLevel3['name']}}</a></li>
                        @endif
                        @endforeach
                    </ul>
                    @else
                    <ul class="d-flex flex-wrap">
                        @foreach($listCatAll as $itemLevel3)
                        @if($itemLevel2['id'] == $itemLevel3['parent_id'])
                        <li style="width:48%"><a href="{{route('fe.cat2',[$itemCatCurent['slug'],$itemLevel2['slug'],$itemLevel3['slug']])}}">{{$itemLevel3['name']}}</a></li>
                        @endif
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </li>
        @endif
        @endforeach
    </ul>
</div>
