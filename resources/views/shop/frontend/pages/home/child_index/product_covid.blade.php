<div id="feature-product-wp" class="product_sellhome">
    <div class="mb-3 headf d-flex">
        <div><img src="{{asset('images/shop/lua1.png')}}" alt=""></div>
        <h1>Sản phẩm hậu covid</h1>       
    </div>
    <div class="">
        <ul class="list-item list-unstyled">
            @foreach ($product_covid as $item)
            <li>
                @include("$moduleName.pages.$controllerName.partial.product",['item'=>$item])
            </li>
            @endforeach
        </ul>
    </div>
</div>