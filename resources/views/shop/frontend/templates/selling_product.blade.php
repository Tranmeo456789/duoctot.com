<h1 class="d-flex mb-5">
    <div class="d-flex align-items-center">
        <div class="icon-product-round"><img src="{{asset('images/shop/selling1.png')}}" alt=""></div>
    </div>
    <p>Sản phẩm bán chạy nhất</p>
</h1>
<ul class="clearfix list-unstyled">
    @foreach($product_selling as $item)
    <li class="position-relative">
        <a href="{{route('fe.product.detail',$item['id'])}}" class="d-block">   
            <div class="seth-img"><img src="{{asset($item['image'])}}"></div>
            <div class="pl-3">
                <p class="truncate2">{{$item['name']}}</p>
                <span class="text-info">{{ number_format( $item['price'], 0, "" ,"." )}}đ / {{$item->unitProduct->name}}</span></span>
            </div>
        </a>
        <div class="unit-top">{{$item->unitProduct->name}}</div>
    </li>
    @endforeach
</ul>