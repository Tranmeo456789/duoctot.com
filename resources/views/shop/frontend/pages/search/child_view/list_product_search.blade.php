
<ul class="clearfix list-unstyled">
    @foreach($itemSearch as $val)
    <li class="position-relative">
        <a href="{{route('fe.product.detail',$val['id'])}}" class="d-block">   
            <div class="seth-img"><img src="{{asset($val['image'])}}"></div>
            <div class="pl-3">
                <p class="truncate2">{{$val['name']}}</p>
                <span class="text-info">{{ number_format( $val['price'], 0, "" ,"." )}}đ / {{$val->unitProduct->name}}</span></span>
            </div>
        </a>
        <div class="unit-top">{{$val->unitProduct->name}}</div>
    </li>
    @endforeach
</ul>