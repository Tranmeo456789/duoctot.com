<a href="{{route('fe.product.detail')}}">
    <div class="d-flex justify-content-center">
    <img src="{{asset('images/shop/' .  $item['image'] )}}" alt="" srcset=""></div>
    <div class="pl-3">
        <p>{{$item['name']}}</p>
        <span class="text-info">{{$item['price']}}/{{$item['unit']}}</span></span>
    </div>
</a>