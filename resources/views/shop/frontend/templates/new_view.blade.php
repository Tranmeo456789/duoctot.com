@php
    use App\Helpers\MyFunction;
    $productViewed = [];
    if (isset($_COOKIE['productViewed'])){
        $productViewed = json_decode($_COOKIE['productViewed'],true);
        if ($params['id'] == array_key_first($productViewed)){
            unset($productViewed[$params['id']]);
        }
    }
@endphp
@if(count($productViewed) > 0)
    <div id="selling-product" class="viewnproduct">
        <h1 class="d-flex mb-3">
            <div class="align-self-center"><div class="icon-product-round"><img src="{{asset('images/shop/eye1.png')}}" alt="" srcset=""></div></div>
            <p>Vừa mới xem</p>
        </h1>
        <ul class="clearfix">
            @foreach($productViewed as $key=>$val)
            <li class="position-relative">
                <a href="{{route('fe.product.detail',$val['product_id'])}}">
                    <div class="d-flex justify-content-center h-60"><img src="{{asset($val['image'])}}" alt=""></div>
                    <div class="mt-3 px-2">
                        <p class="truncate2">{{$val['name']}}</p>
                        <span class="text-info">{{ MyFunction::formatNumber($val['price'])}}đ / {{$val['unit']}}</span>
                    </div>
                </a>
                <div class="unit-top">{{$val['unit']}}</div>
                <div class="text-center slbuy"><a href="">Chọn mua</a></div>
            </li>
            @endforeach
        </ul>
    </div>
@endif