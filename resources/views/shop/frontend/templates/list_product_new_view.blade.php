@php
    use App\Helpers\MyFunction;
    $productViewed = [];
    if (isset($_COOKIE['productViewed'])){
        $productViewed = json_decode($_COOKIE['productViewed'],true);
        if (isset($params['id']) && $params['id'] == array_key_first($productViewed)){
            unset($productViewed[$params['id']]);
        }
    }
@endphp
@if(count($productViewed) > 0)
    <div class="viewnproduct">
        @include("$moduleName.templates.box_title_product",['title' => 'Vừa mới xem','featured' => false])
        <ul class="clearfix list-unstyled ls_product">
            @foreach($productViewed as $key=>$val)
            <li class="position-relative">
                <a href="{{route('fe.product.detail',$val['product_id'])}}">
                    <div class="d-flex justify-content-center wp-img-thumb-product"><img src="{{asset($val['image'])}}" alt=""></div>
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