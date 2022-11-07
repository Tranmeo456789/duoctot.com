<div id="feature-product-wp">
    <div class="mb-3 headf d-flex">
        <div><img src="{{asset('images/shop/lua1.png')}}" alt=""></div>
        <h1>Bán chạy nhất</h1>      
    </div>
    <div class="">
        <ul class="list-item">
            @foreach($products as $product)
            <li>
                <a href="{{route('fe.product.detail',$product['id'])}}">
                    <div class="rdimg"><img src="{{asset($product->image)}}"></div>
                    <div class="pl-3">
                        <p class="truncate2">{{$product->name}}</p>
                        <span class="text-info">{{ number_format( $product['price'], 0, "" ,"." )}}đ / {{$product->unitProduct->name}}</span>
                    </div>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>