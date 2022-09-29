<a href="{{route('fe.product.detail',$item->id)}}" class="d-block">    
    <div class="img-around-180"><img src="{{asset($item['image'])}}"></div>
    <div class="px-2">
        <p class="truncate2">{{$item['name']}}</p>
        <span class="text-info">{{ number_format( $item['price'], 0, "" ,"." )}}đ / {{$item->unitProduct->name}}</span></span>
    </div>
</a>