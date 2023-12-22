@foreach($items as $val)
    @php
        if(!empty($val['percent_discount'])){
            $priceOld=$val['price']*(1+$val['percent_discount']/100);
        }
    @endphp
    <li class="position-relative">
        <a href="{{route('fe.product.detail',$val['slug'])}}" class="d-block">
            <div class="wp-img-thumb-product mb-2">
                <img src="{{asset($val['image'])}}">
            </div>
            <div class="pl-1">
                <div class="d-flex align-items-center wp-name-product">
                    <p class="truncate3">{{$val['name']}}</p>
                </div>
                <span class="text-info">{{ number_format( $val['price'], 0, "" ,"." )}}đ / {{$val->unitProduct->name}}</span></span>
                <div class="price-old">
                    @if(!empty($val['percent_discount']))
                        {{ number_format( $priceOld, 0, "" ,"." )}}đ
                    @endif
                </div>
            </div>
        </a>
        <div class="unit-top">{{$val->unitProduct->name}}</div>
        @if(!empty($val['percent_discount']))
            <div class="wp-discount">-{{$val['percent_discount']}}%</div>
        @endif
    </li>
@endforeach