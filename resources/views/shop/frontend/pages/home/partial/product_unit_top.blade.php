<a href="">
    <div class="d-flex justify-content-center">
        <img src="{{asset('images/shop/' .  $item['image'] )}}" alt="">
    </div>
    <div class="pl-3">
        <p>{{$item['name']}}</p>
        <span class="text-info">{{ number_format( $item['price'], 0, "" ,"." )}}đ / {{$item->unitProduct->name}}</span></span>
    </div>
</a>
<div class="unit-top">{{$item->unitProduct->name}}</div>