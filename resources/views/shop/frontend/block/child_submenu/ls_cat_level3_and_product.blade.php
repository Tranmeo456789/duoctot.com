@if(isset($listItemLevel3))
<ul class="body_catdetail clearfix">
    @foreach($listItemLevel3 as $val)
    <li>
        <a href="{{route('fe.cat3', [$slugCatLevel1, $slugCatLevel2, $val['slug']])}}">
            <div class="item_cat4 d-flex">
                <div class="aimg rimg-centerx mr-1">
                    <img src="{{asset($val['image'])}}">
                </div>
                <div class="align-self-center"><span>{{$val['name']}}</span></div>
            </div>
        </a>
    </li>
    @endforeach
</ul>
@endif
@if(isset($listProductCatLevel2))
@if(count($listProductCatLevel2) > 0)
<div class="list-productmn pt-3">
    @include("$moduleName.templates.box_title_product",['title' => 'Giá sốc','classBackground'=>'bg-danger'])
    <div class="productimenu">
        <ul>
            <div class="row">
                @foreach($listProductCatLevel2 as $product)
                <div class="col-3 pl-3">
                    <li>
                        <div class="bimgm"><div class="h-100"><a href="{{route('fe.product.detail', $product->slug)}}" class="h-100 d-flex align-items-center "><img src="{{asset($product->image)}}" alt="{{$product->name}}"></a></div></div>
                        <div class="">
                            <a href="{{route('fe.product.detail', $product->slug)}}" class="truncate2">{{$product->name}}</a>
                            @if($product['show_price'] == 1)
                            <p class="my-2">{{number_format($product['price'], 0, "", ".")}}đ /{{$product->unitProduct->name}}</p>
                            @endif
                        </div>
                    </li>
                </div>
                @endforeach
            </div>
        </ul>
    </div>
</div>
@endif
@endif