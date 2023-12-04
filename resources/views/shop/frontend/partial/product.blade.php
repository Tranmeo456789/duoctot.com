@foreach($items as $val)
    <li class="position-relative">
        <a href="{{route('fe.product.detail',$val['id'])}}" class="d-block">
            <div class="wp-img-thumb-product mb-2">
                <img src="{{asset($val['image'])}}">
            </div>
            <div class="pl-1">
                <div class="d-flex align-items-center wp-name-product">
                    <p class="truncate3">{{$val['name']}}</p>
                </div>
                <span class="text-info">{{ number_format( $val['price'], 0, "" ,"." )}}đ / {{$val->unitProduct->name}}</span></span>
            </div>
        </a>
        <div class="unit-top">{{$val->unitProduct->name}}</div>
        <div class="wp-discount">-10%</div>
    </li>
@endforeach