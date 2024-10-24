@php
    use App\Model\Shop\CatProductModel;
    use App\Model\Shop\ProductModel;

    $listCatAll=(new CatProductModel())->listItems(null, ['task'  => 'list-items-front-end']);
@endphp
<h1 class="text-center mb-5">Danh mục SP nổi bật</h1>
<ul class="clearfix list-unstyled">
    @foreach ($listCatAll as $itemLevel2)
    @if($itemLevel2['depth'] == 2)
    @php
        $catParent=(new CatProductModel())->getItem(['parent_id' => $itemLevel2['id']], ['task'  => 'get-item-parent']);
        $countProduct=(new ProductModel())->countItems(['cat_product_id'=> $itemLevel2['id']],['task' => 'count-number-product-in-cat']);
    @endphp
    <li>
        <a href="{{route('fe.cat2',[$catParent['slug'],$itemLevel2['slug']])}}">
            <div class="d-flex justify-content-center">
                <div class="image-60"><img src="{{asset($itemLevel2['image'])}}"></div>
            </div>
            <p class="truncate2">{{$itemLevel2['name']}}</p>
            <h2>{{$countProduct}} SẢN PHẨM</h2>
        </a>
    </li>
    @endif
    @endforeach
</ul>