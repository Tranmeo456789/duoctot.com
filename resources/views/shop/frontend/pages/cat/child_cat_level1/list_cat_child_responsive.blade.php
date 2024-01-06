@php
use App\Model\Shop\CatProductModel;
use App\Model\Shop\ProductModel;

$listCatAll=(new CatProductModel())->listItems(null, ['task'  => 'list-items-front-end']);
@endphp
    <ul>
        @foreach($listCatAll as $itemLevel2)
            @if($itemCatCurent['id']==$itemLevel2['parent_id'])
                @php
                    $countProduct=(new ProductModel())->countItems(['cat_product_id'=> $itemLevel2['id']],['task' => 'count-number-product-in-cat']);
                @endphp
        <li>
            <div class=" position-relative catparentc">
                <div class="d-flex titlet">
                    <div class="rimg-center4"><img src="{{asset($itemLevel2['image'])}}" alt=""></div>
                    <div>
                        <h1>{{$itemLevel2['name']}}</h1>
                        <p>{{$countProduct}} sản phẩm</p>
                    </div>
                </div>
                <div class="vissubmenu"><img src="{{asset('images/shop/arrow.png')}}" alt=""></div>
                <div class="submenua1">
                    <ul>
                        @foreach($listCatAll as $itemLevel3)
                        @if($itemLevel2['id'] == $itemLevel3['parent_id'])
                            <li><a href="{{route('fe.cat3',[$itemCatCurent['slug'],$itemLevel2['slug'],$itemLevel3['slug']])}}">{{$itemLevel3['name']}}</a></li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </li>
        @endif
        @endforeach
    </ul>