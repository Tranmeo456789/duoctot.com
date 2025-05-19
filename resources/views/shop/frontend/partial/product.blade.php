@foreach($items as $val)
    @php
        if(!empty($val['percent_discount'])){
            $priceOld=$val['price']*(1+$val['percent_discount']/100);
        }
    @endphp
    <li class="position-relative">
        <a href="{{route('fe.product.detail',$val['slug'])}}" class="d-block">
            <div class="wp-img-thumb-product mb-2">
                <img class="lazy" src="{{asset($val['image'])}}" alt="{{$val['name']}}">
            </div>
            <div class="pl-1">
                <div class="d-flex align-items-center wp-name-product">
                    <p class="truncate3">{{$val['name']}}</p>
                </div>
                @if($val['show_price'] == 1)
                <span class="text-info">{{ number_format( $val['price'], 0, "" ,"." )}}đ / {{$val->unitProduct->name}}</span>
                <div class="price-old">
                    @if(!empty($val['percent_discount']))
                        {{ number_format( $priceOld, 0, "" ,"." )}}đ
                    @endif
                </div>
                @else
                <span class="text-info">...</span>
                <div class="price-old">...</div>
                @endif
            </div>
        </a>
        <div class="d-inline-block pl-2">
            <div class="unit-top">
                <p class="truncate1 pt-0">{{ empty($val['specification']) ? $val->unitProduct->name : $val['specification'] }}</p>
            </div>
        </div>
        @if(!empty($val['percent_discount']))
            <div class="wp-discount">-{{$val['percent_discount']}}%</div>
        @endif
    </li>
@endforeach