<h1 class="d-flex mb-5">
    <div class="d-flex align-items-center">
        <div class="icon-product-round"><img src="{{asset('images/shop/selling1.png')}}" alt="" srcset=""></div>
    </div>
    <p>Sản phẩm bán chạy nhất</p>
</h1>
<ul class="clearfix list-unstyled">
    @foreach($product_covids as $item)
    <li class="position-relative">
        <a href="{{route('fe.product.detail',$item['id'])}}">
            @php
            $img_product = explode(',', $item['image']);
            @endphp
            <div class="d-flex justify-content-center seth-img">
                <div class="d-flex">
                    <img src="{{asset('public/shop/uploads/images/product/'.$img_product[0])}}">
                </div>
            </div>
            <div class="pl-3">
                <p class="truncate2">{{$item['name']}}</p>
                <span class="text-info">{{$item['price']}}/{{$item['unit']}}</span></span>
            </div>
        </a>
        <div class="unit-top">{{$item['unit']}}</div>
    </li>
    @endforeach
</ul>