<ul class="clearfix list-unstyled">
    @foreach($items as $item)
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