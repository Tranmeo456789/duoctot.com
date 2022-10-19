<div id="selling-product" class="viewnproduct">
    <h1 class="d-flex mb-3">
        <div class="align-self-center"><div class="icon-product-round"><img src="{{asset('images/shop/eye1.png')}}" alt="" srcset=""></div></div>
        <p>Vừa mới xem</p>
    </h1>
    
    @if(isset($_COOKIE['productNewView']))
    @php
        $product_new_views= json_decode($_COOKIE['productNewView'],true);
    @endphp
    <ul class="clearfix">
        @foreach($product_new_views as $key=>$product_new_view)     
        <li class="position-relative">
            <a href="{{route('fe.product.detail',$key)}}">
                <div class="d-flex justify-content-center h-60"><img src="{{asset($product_new_view['image'])}}" alt=""></div>
                <div class="mt-3 px-2">
                    <p class="truncate2">{{$product_new_view['name']}}</p>
                    <span class="text-info">{{ number_format( $product_new_view['price'], 0, "" ,"." )}}đ / {{$product_new_view['unit']}}</span>
                </div>
            </a>
            <div class="unit-top">{{$product_new_view['unit']}}</div>
            <div class="text-center slbuy"><a href="">Chọn mua</a></div>
        </li>
        @endforeach
    </ul>
    @endif
</div>